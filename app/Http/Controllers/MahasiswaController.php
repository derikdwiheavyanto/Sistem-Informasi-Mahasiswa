<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $mahasiswas = Mahasiswa::when($search, function ($query) use ($search) {
            $query->where('nama', 'like', "%$search%")
                ->orWhere('nim', 'like', "%$search%")
                ->orWhere('prodi', 'like', "%$search%");
        })
            ->orderBy('nama')
            ->paginate(10)->onEachSide(1)
            ->withQueryString();

        return view('mahasiswa.index', compact('mahasiswas', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $validated = $request->validate(
            [
                'nim' => 'required|unique:mahasiswas,nim',
                'nama' => 'required',
                'prodi' => 'required',
                'sex' => 'required|in:L,P',
                'tanggal_masuk' => 'required|date'
            ],
            [
                'nim.unique' => 'NIM Sudah Terdaftar',
            ]
        );

        Mahasiswa::create($validated);

        return redirect('/')->with('success', 'Data Mahasiswa Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    // FORM EDIT
    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        $request->validate([
            'nim' => 'required|unique:mahasiswas,nim,' . $mahasiswa->id,
            'nama' => 'required',
            'sex' => 'required|in:L,P',
            'prodi' => 'required',
            'tanggal_masuk' => 'required|date'
        ]);

        $mahasiswa->update($request->all());

        return redirect('/')->with('success', 'Data mahasiswa berhasil diupdate');
    }

    // DELETE
    public function destroy($id)
    {
        Mahasiswa::findOrFail($id)->delete();
        return redirect('/')->with('success', 'Data mahasiswa berhasil dihapus');
    }
}
