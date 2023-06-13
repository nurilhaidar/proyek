<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\PeminjamanModel;
use App\Models\StatusModel;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $barang = BarangModel::all();
        return view('admin.barang.barang')
            ->with('br', $barang);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kondisi = ['Baik', 'Rusak'];
        $satuan = ['Buah', 'Gulung', 'Kantong', 'Pack'];
        $sumber = ['Swadana', 'Hibah'];

        return view('admin.barang.create_barang', compact('kondisi', 'satuan', 'sumber'))
            ->with('url_form', url('/administrator/inventaris'));
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
                'no_inventaris' => 'required|string|unique:barang,no_inventaris',
                'nama' => 'required|string|max:50',
                'jumlah_awal' => 'required|integer',
                'stok' => 'required|integer',
                'sumber_dana' => 'required|string',
                'kondisi' => 'required|string',
                'satuan' => 'required|string'
            ]
        );

        $id = rand(10000, 99999);

        $barang = new BarangModel;
        $barang->id = $id;
        $barang->nama = $request->get('nama');
        $barang->no_inventaris = $request->get('no_inventaris');
        $barang->sumber_dana = $request->get('sumber_dana');
        $barang->jumlah_awal = $request->get('jumlah_awal');
        $barang->stok = $request->get('stok');
        $barang->kondisi = $request->get('kondisi');
        $barang->satuan = $request->get('satuan');
        $barang->save();

        return redirect('administrator/inventaris');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sc  $sc
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = BarangModel::find($id);
        $pinjam = PeminjamanModel::whereHas('detail', function ($d) use ($id) {
            $d->where('id_barang', $id);
        })->get();

        return view('admin.barang.show_barang', compact('data', 'pinjam'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sc  $sc
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kondisi = ['Baik', 'Rusak'];
        $satuan = ['Buah', 'Gulung', 'Kantong', 'Pack'];
        $sumber = ['Swadana', 'Hibah'];
        $barang = BarangModel::find($id);
        return view('admin.barang.create_barang', compact('kondisi', 'satuan', 'sumber'))
            ->with('br', $barang)
            ->with('url_form', url('administrator/inventaris/' . $id));
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
        $request->validate(
            [
                'no_inventaris' => 'required|string',
                'nama' => 'required|string|max:50',
                'jumlah_awal' => 'required|integer',
                'stok' => 'required|integer',
                'sumber_dana' => 'required|string',
                'kondisi' => 'required|string',
                'satuan' => 'required|string'
            ]
        );

        $data = BarangModel::where('id', '=', $id)->update($request->except(['_token', '_method', 'submit']));
        return redirect('administrator/inventaris');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sc  $sc
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        BarangModel::where('id', '=', $id)->delete();
        return redirect('administrator/inventaris')
            ->with('success', 'Data barang Berhasil Dihapus');
    }
}
