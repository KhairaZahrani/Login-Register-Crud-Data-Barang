<?php

namespace App\Http\Controllers;
use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index()
    {
        $data = Buku::all();
        return view('buku/index')->with('data',$data);
    }

    public function create()
    {
        return view('buku/create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahunTerbit' => 'required|integer|digits:4', // Validasi tahun terbit harus 4 digit
        ], 
        [
            'judul.required' => 'Judul wajib diisi',
            'judul.string' => 'Judul harus berupa teks',
            'judul.max' => 'Judul tidak boleh melebihi 255 karakter',
            'penulis.required' => 'Penulis wajib diisi',
            'penulis.string' => 'Penulis harus berupa teks',
            'penulis.max' => 'Penulis tidak boleh melebihi 255 karakter',
            'penerbit.required' => 'Penerbit wajib diisi',
            'penerbit.string' => 'Penerbit harus berupa teks',
            'penerbit.max' => 'Penerbit tidak boleh melebihi 255 karakter',
            'tahunTerbit.required' => 'Tahun terbit wajib diisi',
            'tahunTerbit.integer' => 'Tahun terbit harus berupa angka',
            'tahunTerbit.digits' => 'Tahun terbit harus terdiri dari 4 digit',
        ]);
    
        $buku =  Buku::create([
            'Judul' => $request->input('judul'),
            'Penulis' => $request->input('penulis'),
            'Penerbit' => $request->input('penerbit'),
            'TahunTerbit' => $request->input('tahunTerbit'),
        ]);

        $judul = $buku->Judul;
    
        return redirect('/buku')->with('pesan', "Buku dengan judul '{$judul}' berhasil ditambahkan!");
    }
    

    public function show($id)
    {
        $data = Buku::where('BukuID',$id)->first();
        return view('buku/show', compact('data'));
    }

    public function edit($id)
    {
        $data = Buku::where('BukuID',$id)->first();
        return view('buku/edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahunTerbit' => 'required|integer|digits:4', 
        ], 
        [
            'judul.required' => 'Judul wajib diisi',
            'judul.string' => 'Judul harus berupa teks',
            'judul.max' => 'Judul tidak boleh melebihi 255 karakter',
            'penulis.required' => 'Penulis wajib diisi',
            'penulis.string' => 'Penulis harus berupa teks',
            'penulis.max' => 'Penulis tidak boleh melebihi 255 karakter',
            'penerbit.required' => 'Penerbit wajib diisi',
            'penerbit.string' => 'Penerbit harus berupa teks',
            'penerbit.max' => 'Penerbit tidak boleh melebihi 255 karakter',
            'tahunTerbit.required' => 'Tahun terbit wajib diisi',
            'tahunTerbit.integer' => 'Tahun terbit harus berupa angka',
            'tahunTerbit.digits' => 'Tahun terbit harus terdiri dari 4 digit',
        ]);

        $buku = $data = [
            'Judul' => $request->input('judul'),
            'Penulis' => $request->input('penulis'),
            'Penerbit' => $request->input('penerbit'),
            'TahunTerbit' => $request->input('tahunTerbit'),
        ];

        $judul = $data['Judul'];

        // Update data buku di database
        Buku::where('BukuID', $id)->update($data);
    
        // Redirect dengan pesan
        return redirect('/buku')->with('pesan', "Buku dengan judul '{$judul}' berhasil di-edit");
    }

    public function destroy($id)
    {
        Buku::where('BukuID',$id)->delete();
        return redirect('/buku')->with('pesan', 'Buku berhasil dihapus');
    }
}
