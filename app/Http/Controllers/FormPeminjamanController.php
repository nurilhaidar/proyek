<?php

namespace App\Http\Controllers;

use App\Models\PeminjamanModel;
use App\Models\sc;
use Illuminate\Http\Request;

class Peminjaman extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $peminjaman = PeminjamanModel::where('nama_peminjam', 'LIKE', '%' . $request->search . '%')
                ->orWhere('nama_barang', 'LIKE', '%' . $request->search . '%')
                ->orWhere('asal_oki', 'LIKE', '%' . $request->search . '%')
                ->paginate(3)->withQueryString();
        } else {
            $peminjaman = PeminjamanModel::paginate(3);
        }
        return view('peminjaman.peminjaman')
            ->with('pj', $peminjaman);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('peminjaman.create_peminjaman')
            ->with('url_form', url('/peminjaman'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'nama_peminjam' => 'required|string|max:50|unique:peminjaman,nama_peminjam',
                'asal_oki' => 'required|string|max:50',
                'kode_barang' => 'required|string|max:4|unique:peminjaman,kode_barang',
                'nama_barang' => 'required|string|max:50',
                'jumlah_barang' => 'required|integer',
                'tanggal_pinjam' => 'required|date',
                'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
                'surat' => 'required|string|max:10',
                'jaminan' => 'required|string|max:10',
                'kondisi' => 'required|string|max:50',
                'status' => 'required|string|max:25',
            ],
            [
                'nama_peminjam.required' => 'Nama Peminjam tidak boleh kosong',
                'asal_oki.required' => 'Asal Oki tidak boleh kosong',
                'kode_barang.required' => 'Kode Barang tidak boleh kosong',
                'nama_barang.required' => 'Nama Barang tidak boleh kosong',
                'jumlah_barang.integer' => 'Jumlah Barang harus berupa angka',
                'tanggal_pinjam.date' => 'Tanggal Pinjam tidak boleh kosong',
                'tanggal_kembali.date' => 'Tanggal Kembali tidak boleh kosong',
                'surat.required' => 'Surat tidak boleh kosong',
                'jaminan.required' => 'Jaminan tidak boleh kosong',
                'kondisi.required' => 'Kondisi tidak boleh kosong',
                'status.required' => 'Status tidak boleh kosong'
            ]
        );



        $data = PeminjamanModel::create($request->except(['_token']));
        //jika data berhasil ditambahkan, akan kembali ke halaman utama
        return redirect('peminjaman')
            ->with('success', 'Data peminjaman Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sc  $sc
     * @return \Illuminate\Http\Response
     */
    public function show(sc $sc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sc  $sc
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $peminjaman = PeminjamanModel::find($id);
        return view('peminjaman.create_peminjaman')
            ->with('pj', $peminjaman)
            ->with('url_form', url('/peminjaman/' . $id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sc  $sc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_peminjam' => 'required|string|max:50|unique:peminjaman,nama_peminjam' . $id,
            'asal_oki' => 'required|string|max:50',
            'kode_barang' => 'required|string|max:4|unique:peminjaman,kode_barang',
            'nama_barang' => 'required|string|max:50',
            'jumlah_barang' => 'required|integer',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'surat' => 'required|string|max:10',
            'jaminan' => 'required|string|max:10',
            'kondisi' => 'required|string|max:50',
            'status' => 'required|string|max:25',
        ]);

        $data = PeminjamanModel::where('id', '=', $id)->update($request->except(['_token', '_method', 'submit']));
        return redirect('peminjaman')
            ->with('success', 'Data peminjaman Berhasil Diedit');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sc  $sc
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PeminjamanModel::where('id', '=', $id)->delete();
        return redirect('peminjaman')
            ->with('success', 'Data peminjaman Berhasil Dihapus');
    }
}
