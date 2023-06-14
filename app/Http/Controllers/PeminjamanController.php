<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\DetailModel;
use App\Models\PeminjamanModel;
use App\Models\StatusModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = PeminjamanModel::all();
        return view('admin.peminjaman.peminjaman')->with('data', $data);
    }

    public function blmKonfirm()
    {
        $data = PeminjamanModel::whereHas('status', function ($d) {
            $d->where('status', 'Belum Dikonfirmasi');
        })->get();
        return view('admin.peminjaman.peminjaman')->with('data', $data);
    }

    public function blmKembali()
    {
        $data = PeminjamanModel::whereHas('status', function ($d) {
            $d->where('status', 'Diterima');
        })->get();
        return view('admin.peminjaman.peminjaman')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barang = BarangModel::all()->sortBy('nama');
        return view('user.content.form')->with('url_form', url('peminjaman'))->with('barang', $barang);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $barang = $request->input('barang');
        $qty = $request->input('qty');
        $tgl = $request->input('tanggal_pinjam');

        $errors = [];

        foreach ($barang as $i => $b) {
            $qtyi = $qty[$i];
            $brg = BarangModel::where('id', $b)->first();
            $check = PeminjamanModel::where('tanggal_pinjam', $tgl)->whereHas('detail', function ($d) use ($b) {
                $d->where('id_barang', $b);
            })->first();

            if ($qtyi > $brg->stok) {
                $errors = "Stok " . $brg->nama . " tidak mencukupi";
            }

            if ($check != null) {
                foreach ($check->detail as $d) {
                    if ($qtyi + $d->pivot->qty > $brg->stok) {
                        $errors = "Stok " . $brg->nama . " tidak mencukupi";
                    }
                }
            }
        }

        if (empty($errors)) {
            $id = rand('100000', '999999');
            $request->validate([
                'nama_peminjam' => 'required|string',
                'oki' => 'required|string',
                'tanggal_pinjam' => 'required|date',
                'tanggal_kembali' => 'required|date',
                'jaminan' => 'required|string',
                'surat' => 'required|mimes:pdf',
                'telp' => 'required|numeric'
            ]);

            $surat = $request->file('surat');
            $nama_surat = $surat->store('surat', 'public');

            $peminjaman = new PeminjamanModel();
            $peminjaman->id = $id;
            $peminjaman->nama_peminjam = $request->nama_peminjam;
            $peminjaman->asal_oki = $request->oki;
            $peminjaman->tanggal_pinjam = Carbon::parse($request->tanggal_pinjam)->format('Y-m-d');
            $peminjaman->tanggal_kembali = $request->tanggal_kembali;
            $peminjaman->jaminan = $request->jaminan;
            $peminjaman->telp = $request->telp;
            $peminjaman->surat = $nama_surat;
            $peminjaman->save();

            foreach ($barang as $i => $b) {
                $a = $qty[$i];
                DetailModel::create([
                    'id_peminjaman' => $id,
                    'id_barang' => $b,
                    'qty' => $a,
                ]);
            }

            StatusModel::create([
                'id_peminjaman' => $id,
                'status' => 'Belum Dikonformasi',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            return redirect('peminjaman');
        } else {
            return back()->with('message', $errors)->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = PeminjamanModel::find($id);
        $barang = BarangModel::all()->sortBy('nama');
        return view('admin.peminjaman.create_peminjaman', compact('data', 'barang'))
            ->with('url_form', url('peminjaman/' . $id))
            ->with('form_status', url('administrator/status/' . $id));
    }

    public function status(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
            'keterangan' => 'nullable|string'
        ]);

        $data = StatusModel::where('id_peminjaman', $id)->update([
            'status' => $request->status,
            'keterangan' => $request->keterangan,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return redirect('administrator/peminjaman/' . $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = PeminjamanModel::find($id);
        $data2 = DetailModel::where('id_peminjaman', $id)->get();
        $data3 = StatusModel::where('id_peminjaman', $id)->get();
        if ($data->surat != null) {
            unlink(public_path('storage/' . $data->surat));
        }
        foreach ($data2 as $d) {
            $d->delete();
        }
        foreach ($data3 as $d) {
            $d->delete();
        }
        $data->delete();
        return redirect('administrator/peminjaman');
    }
}
