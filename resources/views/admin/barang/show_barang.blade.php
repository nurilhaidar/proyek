@extends('admin.layout.template')
@section('content')
    <div id="content">
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h4>Form Tambah Barang</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            @csrf
                            <div class="form-group">
                                <label>No Inventaris</label>
                                <input class="form-control" value="{{ $data->no_inventaris }}" name="no_inventaris"
                                    type="text" disabled />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nama Barang</label>
                                <input class="form-control @error('nama') is-invalid @enderror" value="{{ $data->nama }}"
                                    name="nama" type="text" disabled />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Jumlah</label>
                                <input class="form-control" value="{{ $data->jumlah_awal }}" name="jumlah_awal"
                                    type="number" disabled />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Stok</label>
                                <input class="form-control" value="{{ $data->stok }}" name="stok" type="number"
                                    disabled />
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Sumber Dana</label>
                                <select name="sumber_dana" class="form-control" disabled>
                                    <option>{{ $data->sumber_dana }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Kondisi</label>
                                <select name="kondisi" class="form-control" disabled>
                                    <option>{{ $data->kondisi }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Satuan</label>
                                <select name="satuan" class="form-control" disabled>
                                    <option>{{ $data->satuan }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h4>Riwayat Peminjaman</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        @if ($pinjam->count() == 0)
                            <div class="col-md-12 d-flex justify-content-center align-items-center">
                                <h6 style="text-align: center">--No Data--</h6>
                            </div>
                        @endif
                        @foreach ($pinjam as $p)
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Nama Peminjam</label>
                                    <input class="form-control" value="{{ $p->nama_peminjam }}" type="text" disabled />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Asal Oki</label>
                                    <input class="form-control" value="{{ $p->asal_oki }}" type="text" disabled />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tanggal Pinjam</label>
                                    <input class="form-control" value="{{ $p->tanggal_pinjam }}" type="date" disabled />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tanggal Kembali</label>
                                    <input class="form-control" value="{{ $p->tanggal_kembali }}" type="date"
                                        disabled />
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
