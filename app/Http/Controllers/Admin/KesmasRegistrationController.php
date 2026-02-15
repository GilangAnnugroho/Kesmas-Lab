<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KesmasRegistration;
use Illuminate\Http\Request;

class KesmasRegistrationController extends Controller
{
    public function index(Request $request)
    {
        $query = KesmasRegistration::with('client')->latest();

        if ($request->filled('status_pembayaran')) {
            $query->where('status_pembayaran', $request->status_pembayaran);
        }

        if ($request->filled('status_proses')) {
            $query->where('status_proses', $request->status_proses);
        }

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('no_registrasi', 'like', "%{$q}%")
                    ->orWhere('nama_sampel', 'like', "%{$q}%")
                    ->orWhere('identitas_pengirim', 'like', "%{$q}%");
            });
        }

        $registrations = $query->paginate(20);

        return view('kesmas.admin.registrations.index', compact('registrations'));
    }

    public function show(KesmasRegistration $registration)
    {
        $registration->load(['client', 'items.parameter', 'results']);

        return view('kesmas.admin.registrations.show', compact('registration'));
    }

    public function updateStatus(Request $request, KesmasRegistration $registration)
    {
        $request->validate([
            'status_proses'     => 'nullable|in:baru,sedang_diperiksa,selesai',
            'status_pembayaran' => 'nullable|in:lunas,belum_lunas',
        ]);

        if ($request->filled('status_proses')) {
            $registration->status_proses = $request->status_proses;
        }
        if ($request->filled('status_pembayaran')) {
            $registration->status_pembayaran = $request->status_pembayaran;
        }

        $registration->updated_by = auth()->id();
        $registration->save();

        return back()->with('success', 'Status berhasil diperbarui.');
    }

    public function destroy(KesmasRegistration $registration)
    {
        $registration->delete();

        return redirect()
            ->route('admin.kesmas.registrations.index')
            ->with('success', 'Registrasi berhasil dihapus.');
    }

    public function print(KesmasRegistration $registration)
    {
        $registration->load(['client', 'items.parameter', 'results']);
        return view('kesmas.admin.registrations.print', compact('registration'));
    }
}
