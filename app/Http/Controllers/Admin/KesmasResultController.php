<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KesmasRegistration;
use App\Models\KesmasResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KesmasResultController extends Controller
{
    public function edit(KesmasRegistration $registration)
    {
        $registration->load([
            'items.parameter',
            'items.result',
        ]);

        return view('kesmas.admin.results.edit', compact('registration'));
    }

    public function update(Request $request, KesmasRegistration $registration)
    {
        $dataResults = $request->input('results', []);
        $catatanPetugas = $request->input('catatan_petugas');

        DB::beginTransaction();

        try {
            $adaHasilDiisi = false;

            foreach ($dataResults as $itemId => $row) {
                $result = KesmasResult::firstOrNew([
                    'examination_item_id' => $itemId,
                ]);

                $nilaiAngka   = $row['nilai_angka'] ?? null;
                $hasilText    = $row['hasil_text'] ?? null;
                $nilaiRujukan = $row['nilai_rujukan'] ?? null;
                $keterangan   = $row['keterangan'] ?? null;

                $result->fill([
                    'nilai_angka'   => $nilaiAngka,
                    'hasil_text'    => $hasilText,
                    'satuan'        => $row['satuan'] ?? null, 
                    'nilai_rujukan' => $nilaiRujukan,
                    'keterangan'    => $keterangan,
                ]);

                if ($catatanPetugas !== null && $catatanPetugas !== '') {
                    $result->catatan_petugas = $catatanPetugas;
                } else {
                    $result->catatan_petugas = null;
                }

                $hasContent = !is_null($nilaiAngka) || !is_null($hasilText) || !is_null($keterangan);
                if ($hasContent) {
                    $result->status_hasil = 'draft';
                    $adaHasilDiisi        = true;
                } else {
                    $result->status_hasil = null;
                }

                if (!$result->analis_id) {
                    $result->analis_id = auth()->id();
                }

                $result->save();
            }

            if ($adaHasilDiisi && $registration->status_proses !== 'selesai') {
                $registration->status_proses = 'sedang_diperiksa';
                $registration->updated_by    = auth()->id();
                $registration->save();
            }
            $registration->load(['items.result']);
            $allFilled = $registration->items->every(function ($item) {
                $r = $item->result;
                if (!$r) {
                    return false;
                }

                return !is_null($r->nilai_angka)
                    || !is_null($r->hasil_text)
                    || !is_null($r->keterangan);
            });

            if ($allFilled) {
                foreach ($registration->results as $res) {
                    if (!is_null($res->nilai_angka)
                        || !is_null($res->hasil_text)
                        || !is_null($res->keterangan)) {
                        $res->status_hasil = 'menunggu_verifikasi';
                        $res->save();
                    }
                }
            }

            DB::commit();

            return redirect()
                ->route('admin.kesmas.registrations.show', $registration)
                ->with('success', 'Hasil pemeriksaan berhasil disimpan.');

        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()
                ->withErrors('Terjadi kesalahan saat menyimpan hasil.')
                ->withInput();
        }
    }
}
