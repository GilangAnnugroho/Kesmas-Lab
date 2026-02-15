<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KesmasParameter;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KesmasParameterController extends Controller
{
    protected array $masterParameterNames = [
        'mikrobiologi' => [
            'Air Bersih',
            'Air Olahan',
            'E. Coli',
            'Salmonella Sp.',
            'E colli dan Total Coliform',
            'Angka Kuman (HPC)',
        ],
        'kimia' => [
            'Air Bersih',
            'Air Olahan',
            'Boraks',
            'Rodhamin',
            'Methyl Yellow',
            'Kandungan Babi',
        ],
    ];

    public function index()
    {
        $parameters = KesmasParameter::orderBy('kategori')
            ->orderBy('nama_parameter')
            ->paginate(50);

        return view('kesmas.admin.parameters.index', compact('parameters'));
    }

    public function create()
    {
        $parameterNames = $this->masterParameterNames;

        return view('kesmas.admin.parameters.create', compact('parameterNames'));
    }

    public function store(Request $request)
    {
        $kategori = $request->input('kategori');

        $messages = [
            'nama_parameter.unique' => 'Parameter dengan kombinasi jenis dan nama ini sudah ada. Silakan gunakan nama lain atau ubah jenisnya.',
        ];

        $validated = $request->validate([
            'kategori'       => 'required|in:mikrobiologi,kimia',
            'nama_parameter' => [
                'required',
                'string',
                'max:255',
                Rule::unique('kesmas_parameters', 'nama_parameter')
                    ->where(fn ($q) => $q->where('kategori', $kategori)),
            ],
            'nilai_rujukan'  => 'nullable|string|max:255',
            'aktif'          => 'nullable|boolean',
        ], $messages);

        KesmasParameter::create([
            'kategori'       => $validated['kategori'],
            'nama_parameter' => $validated['nama_parameter'],
            'nilai_rujukan'  => $validated['nilai_rujukan'] ?? null,
            'aktif'          => $request->boolean('aktif'),
        ]);

        return redirect()
            ->route('admin.kesmas.parameters.index')
            ->with('success', 'Parameter berhasil ditambahkan.');
    }

    public function edit(KesmasParameter $parameter)
    {
        $parameterNames = $this->masterParameterNames;

        return view('kesmas.admin.parameters.edit', compact('parameter', 'parameterNames'));
    }

    public function update(Request $request, KesmasParameter $parameter)
    {
        $kategori = $request->input('kategori');

        $messages = [
            'nama_parameter.unique' => 'Parameter dengan kombinasi jenis dan nama ini sudah ada. Silakan gunakan nama lain atau ubah jenisnya.',
        ];

        $validated = $request->validate([
            'kategori'       => 'required|in:mikrobiologi,kimia',
            'nama_parameter' => [
                'required',
                'string',
                'max:255',
                Rule::unique('kesmas_parameters', 'nama_parameter')
                    ->where(fn ($q) => $q->where('kategori', $kategori))
                    ->ignore($parameter->id),
            ],
            'nilai_rujukan'  => 'nullable|string|max:255',
            'aktif'          => 'nullable|boolean',
        ], $messages);

        $parameter->update([
            'kategori'       => $validated['kategori'],
            'nama_parameter' => $validated['nama_parameter'],
            'nilai_rujukan'  => $validated['nilai_rujukan'] ?? null,
            'aktif'          => $request->boolean('aktif'),
        ]);

        return redirect()
            ->route('admin.kesmas.parameters.index')
            ->with('success', 'Parameter berhasil diperbarui.');
    }

    public function destroy(KesmasParameter $parameter)
    {
        $parameter->delete();

        return redirect()
            ->route('admin.kesmas.parameters.index')
            ->with('success', 'Parameter berhasil dihapus.');
    }
}
