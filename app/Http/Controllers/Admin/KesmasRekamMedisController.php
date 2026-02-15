<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KesmasClient;
use Illuminate\Http\Request;

class KesmasRekamMedisController extends Controller
{
    public function index(Request $request)
    {
        $query = KesmasClient::query();

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('nama', 'like', "%{$q}%")
                    ->orWhere('nik', 'like', "%{$q}%")
                    ->orWhere('no_hp', 'like', "%{$q}%");
            });
        }

        $clients = $query->orderBy('nama')->paginate(20);

        return view('kesmas.admin.rekam_medis.index', compact('clients'));
    }

    public function show(KesmasClient $client)
    {
        $client->load([
            'registrations' => function ($q) {
                $q->orderByDesc('tgl_permintaan')
                  ->orderByDesc('created_at');
            },
            'registrations.items.parameter',
            'registrations.results',
        ]);

        return view('kesmas.admin.rekam_medis.show', compact('client'));
    }
}
