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
                    <form method="POST" action="{{ $url_form }}">
                        <div class="row">
                            <div class="col-md-4">
                                @csrf
                                {!! isset($br) ? method_field('PUT') : '' !!}
                                <div class="form-group">
                                    <label>No Inventaris</label>
                                    <input class="form-control @error('no_inventaris') is-invalid @enderror"
                                        value="{{ isset($br) ? $br->no_inventaris : old('no_inventaris') }}"
                                        name="no_inventaris" type="text" />
                                    @error('no_inventaris')
                                        <span>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nama Barang</label>
                                    <input class="form-control @error('nama') is-invalid @enderror"
                                        value="{{ isset($br) ? $br->nama : old('nama') }}" name="nama" type="text" />
                                    @error('nama')
                                        <span>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Jumlah</label>
                                    <input class="form-control @error('jumlah_awal') is-invalid @enderror"
                                        value="{{ isset($br) ? $br->jumlah_awal : old('jumlah_awal') }}" name="jumlah_awal"
                                        type="number" />
                                    @error('jumlah_awal')
                                        <span>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Stok</label>
                                    <input class="form-control @error('stok') is-invalid @enderror"
                                        value="{{ isset($br) ? $br->stok : old('stok') }}" name="stok" type="number" />
                                    @error('stok')
                                        <span>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Sumber Dana</label>
                                    <select name="sumber_dana" class="form-control">
                                        <option></option>
                                        @foreach ($sumber as $a)
                                            <option value="{{ $a }}"
                                                {{ isset($br) && $br->sumber_dana == $a ? 'selected' : '' }}>
                                                {{ $a }}
                                            </option>
                                        @endforeach

                                    </select>
                                    @error('sumber_dana')
                                        <span class="text">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Kondisi</label>
                                    <select name="kondisi" class="form-control">
                                        <option></option>
                                        @foreach ($kondisi as $a)
                                            <option value="{{ $a }}"
                                                {{ isset($br) && $br->kondisi == $a ? 'selected' : '' }}>
                                                {{ $a }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kondisi')
                                        <span>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Satuan</label>
                                    <select name="satuan" class="form-control">
                                        <option></option>
                                        @foreach ($satuan as $a)
                                            <option value="{{ $a }}"
                                                {{ isset($br) && $br->satuan ? 'selected' : '' }}>
                                                {{ $a }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('satuan')
                                        <span>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
