<?php

namespace App\Http\Controllers;

use App\Models\KesmasClient;
use App\Models\KesmasRegistration;
use App\Models\KesmasParameter;
use App\Models\KesmasExaminationItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PublicKesmasController extends Controller
{
    public function create()
    {
        $mikrobiologi = KesmasParameter::where('kategori', 'mikrobiologi')
            ->where('aktif', true)
            ->get();

        $kimia = KesmasParameter::where('kategori', 'kimia')
            ->where('aktif', true)
            ->get();

        return view('kesmas.public.form', compact('mikrobiologi', 'kimia'));
    }

    public function store(Request $request)
    {
    
        $validated = $request->validate(
            [
                'nama_sampel'        => 'required|string|max:255',
                'identitas_pengirim' => 'required|string|max:255',
                'lokasi_pengambilan' => 'required|string|max:255',
                'jenis_sampel'       => 'required|string|max:255',
                'jenis_pemeriksaan'  => 'required|string|max:255',
                'petugas_sampling'        => 'nullable|string|max:255',
                'alamat_petugas_sampling' => 'nullable|string|max:255',
                'tgl_pengambilan' => 'required|date',
                'jam_pengambilan' => 'required',
                'tgl_permintaan'  => 'required|date',
                'tgl_penerimaan'  => 'required|date',
                'jam_penerimaan'  => 'required',
                'volume_sampel' => 'required|string|max:100',
                'status_pembayaran' => 'required|in:lunas,belum_lunas',
                'sumber' => 'nullable|string',
                'mikrobiologi' => 'nullable|array',
                'kimia'        => 'nullable|array',
            ],
            [
                'identitas_pengirim.required' => 'Identitas pengirim / No HP wajib diisi.',
                'lokasi_pengambilan.required' => 'Lokasi pengambilan wajib diisi.',
                'jenis_sampel.required'       => 'Jenis sampel wajib diisi.',
                'jenis_pemeriksaan.required'  => 'Jenis pemeriksaan wajib diisi.',
                'tgl_pengambilan.required'    => 'Tanggal pengambilan sampel wajib diisi.',
                'jam_pengambilan.required'    => 'Jam pengambilan sampel wajib diisi.',
                'tgl_permintaan.required'     => 'Tanggal permintaan wajib diisi.',
                'tgl_penerimaan.required'     => 'Tanggal penerimaan sampel wajib diisi.',
                'jam_penerimaan.required'     => 'Jam penerimaan sampel wajib diisi.',
                'volume_sampel.required'      => 'Volume sampel wajib diisi.',
                'status_pembayaran.required'  => 'Status pembayaran wajib dipilih.',
            ]
        );

        if (empty($validated['mikrobiologi']) && empty($validated['kimia'])) {
            return back()
                ->withErrors([
                    'mikrobiologi' =>
                        'Minimal satu parameter pemeriksaan harus dipilih (mikrobiologi atau kimia).',
                ])
                ->withInput();
        }

        DB::beginTransaction();

        try {
            $client = KesmasClient::firstOrCreate(
                [
                    'nama' => $validated['identitas_pengirim'] ?? $validated['nama_sampel'],
                ],
                [
                    'jenis'  => 'perorangan',
                    'alamat' => $validated['lokasi_pengambilan'] ?? null,
                ]
            );

            $noRegistrasi = $this->generateNoRegistrasi();
            $data = [
                'client_id'     => $client?->id,
                'no_registrasi' => $noRegistrasi,
                'nama_sampel'        => $validated['nama_sampel'],
                'identitas_pengirim' => $validated['identitas_pengirim'] ?? null,
                'lokasi_pengambilan' => $validated['lokasi_pengambilan'] ?? null,
                'jenis_sampel'       => $validated['jenis_sampel'] ?? null,
                'jenis_pemeriksaan'  => $validated['jenis_pemeriksaan'] ?? null,
                'petugas_sampling'        => $validated['petugas_sampling'] ?? null,
                'alamat_petugas_sampling' => $validated['alamat_petugas_sampling'] ?? null,
                'tgl_pengambilan' => $validated['tgl_pengambilan'] ?? null,
                'jam_pengambilan' => $validated['jam_pengambilan'] ?? null,
                'tgl_penerimaan' => $validated['tgl_penerimaan'] ?? null,
                'jam_penerimaan' => $validated['jam_penerimaan'] ?? null,
                'volume_sampel' => $validated['volume_sampel'] ?? null,
                'status_pembayaran' => $validated['status_pembayaran'],
                'status_proses'     => 'baru',
                'sumber' => $validated['sumber'] ?? null,
            ];

            if (Schema::hasColumn('kesmas_registrations', 'tgl_permintaan')) {
                $data['tgl_permintaan'] = $validated['tgl_permintaan'] ?? null;
            } elseif (Schema::hasColumn('kesmas_registrations', 'tgl_permintaaan')) {
                $data['tgl_permintaaan'] = $validated['tgl_permintaan'] ?? null;
            }

            $registration = KesmasRegistration::create($data);
            if (!empty($validated['mikrobiologi'])) {
                $paramsMikro = KesmasParameter::whereIn('id', $validated['mikrobiologi'])->get();

                foreach ($paramsMikro as $param) {
                    KesmasExaminationItem::create([
                        'registration_id' => $registration->id,
                        'parameter_id'    => $param->id,
                        'status'          => 'belum_diperiksa',
                    ]);
                }
            }

            if (!empty($validated['kimia'])) {
                $paramsKimia = KesmasParameter::whereIn('id', $validated['kimia'])->get();

                foreach ($paramsKimia as $param) {
                    KesmasExaminationItem::create([
                        'registration_id' => $registration->id,
                        'parameter_id'    => $param->id,
                        'status'          => 'belum_diperiksa',
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('kesmas.public.success', [
                'no_registrasi' => $registration->no_registrasi,
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()
                ->withErrors('Terjadi kesalahan saat menyimpan pendaftaran: '.$e->getMessage())
                ->withInput();
        }
    }

    public function success($no_registrasi)
    {
        $registration = KesmasRegistration::where('no_registrasi', $no_registrasi)->firstOrFail();

        return view('kesmas.public.success', compact('registration'));
    }

    protected function generateNoRegistrasi(): string
    {
        $prefix = 'KES-' . now()->format('Ym') . '-';

        $last = KesmasRegistration::where('no_registrasi', 'like', $prefix.'%')
            ->orderBy('no_registrasi', 'desc')
            ->first();

        if (!$last) {
            $number = 1;
        } else {
            $lastNumber = (int) substr($last->no_registrasi, strlen($prefix));
            $number     = $lastNumber + 1;
        }

        return $prefix.str_pad($number, 4, '0', STR_PAD_LEFT);
    }
}
