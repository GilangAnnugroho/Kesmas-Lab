<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KesmasRegistration;
use App\Models\KesmasVerification;
use Illuminate\Http\Request;

class KesmasVerificationController extends Controller
{
    public function verifyForm(KesmasRegistration $registration)
    {
        $registration->load([
            'client',
            'items.parameter',
            'items.result',
            'verification',
        ]);

        return view('kesmas.admin.verification.form', compact('registration'));
    }

    public function verify(Request $request, KesmasRegistration $registration)
    {
        $request->validate([
            'jabatan'      => 'required|string|max:255',
            'nama_pejabat' => 'required|string|max:255',
            'nip'          => 'nullable|string|max:100',
        ]);

        KesmasVerification::updateOrCreate(
            ['registration_id' => $registration->id],
            [
                'verified_by'  => auth()->id(),
                'verified_at'  => now(),
                'jabatan'      => $request->jabatan,
                'nama_pejabat' => $request->nama_pejabat,
                'nip'          => $request->nip,
            ]
        );

        foreach ($registration->results as $result) {
            $result->update([
                'status_hasil'   => 'terverifikasi',
                'verifikator_id' => auth()->id(),
                'verified_at'    => now(),
            ]);
        }

        $registration->update([
            'status_proses' => 'selesai',
        ]);

        return redirect()
            ->route('admin.kesmas.registrations.show', $registration)
            ->with('success', 'Hasil pemeriksaan berhasil diverifikasi.');
    }
}
