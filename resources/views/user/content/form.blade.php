@extends('user.layout.template')
@section('content')
    <header class="py-5">
        <div class="container px-5 pb-5">
            <div class="row gx-5 align-items-center">
                <div class="col-xxl-5">
                    <!-- Header text content-->
                    <div class="text-center text-xxl-start">
                        <h1 class="display-5 fw-bolder"><span class="text-primary d-inline">Peminjaman Online
                                Inventaris</span></h1>
                        <div class="fs-6 text-muted mb-3">Himpunan Mahasiswa Teknologi Informasi <br> Politeknik
                            Negeri Malang</div>
                    </div>
                </div>
                <div class="col-xxl-7">
                    <!-- Header profile picture-->
                    <div class="d-flex justify-content-center mt-5 mt-xxl-0">
                        <div class="card shadow border-0 rounded-4 mb-5">
                            <div class="card-body p-5">
                                <form action="/peminjaman" method="post" enctype="multipart/form-data" id="myForm">
                                    @csrf
                                    <div class="row align-items-center gx-5">
                                        <div class="row">
                                            <h2 class="text-primary fw-bolder">
                                                Form Peminjaman
                                            </h2>
                                            <div class="col-6">
                                                <label for="nama" class="small text-muted fw-bolder">Nama</label>
                                                <input type="text" name="nama_peminjam"
                                                    class="form-control @error('nama_peminjam') is-invalid @enderror"
                                                    value="{{ old('nama_peminjam') }}">
                                                @error('nama_peminjam')
                                                    <span style="font-size:13px; color: red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-6">
                                                <label for="nama" class="small text-muted fw-bolder">Organisasi</label>
                                                <input type="text" name="oki"
                                                    class="form-control @error('oki') is-invalid @enderror"
                                                    value="{{ old('oki') }}">
                                                @error('oki')
                                                    <span style="font-size:13px; color: red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-4" style="margin-top: 20px">
                                                <label for="tanggal_pinjam" class="small text-muted fw-bolder">Tanggal
                                                    Pinjam</label>
                                                <input type="date" name="tanggal_pinjam"
                                                    class="form-control @error('tanggal_pinjam') is-invalid @enderror"
                                                    value="{{ old('tanggal_pinjam') }}">
                                                @error('tanggal_pinjam')
                                                    <span style="font-size:13px; color: red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-4" style="margin-top: 20px">
                                                <label for="tanggal_kembalo" class="small text-muted fw-bolder">Tanggal
                                                    Kembali</label>
                                                <input type="date" name="tanggal_kembali"
                                                    class="form-control @error('tanggal_kembali') is-invalid @enderror"
                                                    value="{{ old('tanggal_kembali') }}">
                                                @error('tanggal_kembali')
                                                    <span style="font-size:13px; color: red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-4" style="margin-top: 20px">
                                                <label for="jaminan" class="small text-muted fw-bolder">Jaminan</label>
                                                <select name="jaminan"
                                                    class="form-select @error('jaminan') is-invalid @enderror">
                                                    <option value=""></option>
                                                    <option value="KTM" {{ old('jaminan') == 'KTM' ? 'selected' : '' }}>
                                                        KTM
                                                    </option>
                                                    <option value="KTP" {{ old('jaminan') == 'KTP' ? 'selected' : '' }}>
                                                        KTP
                                                    </option>
                                                </select>
                                                @error('jaminan')
                                                    <span style="font-size:13px; color: red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-6" style="margin-top: 20px">
                                                <label for="surat" class="small text-muted fw-bolder">Surat</label>
                                                <input type="file" name="surat"
                                                    class="form-control @error('surat') is-invalid @enderror">
                                                @error('surat')
                                                    <span style="font-size:13px; color: red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-6" style="margin-top: 20px">
                                                <label for="telp" class="small text-muted fw-bolder">No
                                                    Telepon</label>
                                                <input type="tel" name="telp"
                                                    class="form-control @error('telp') is-invalid @enderror"
                                                    value="{{ old('telp') }}">
                                                @error('telp')
                                                    <span style="font-size:13px; color: red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 20px">
                                            <div class="col-12">
                                                <label for="table" class="small text-muted fw-bolder">Barang</label>
                                                <table id="table" name="table">
                                                    <tr>
                                                        <td>
                                                            <div class="input-group">
                                                                <select name="barang[]" class="form-control"
                                                                    style="width: 50%">
                                                                    <option value="">Pilih Barang</option>
                                                                    @foreach ($barang as $b)
                                                                        <option value="{{ $b->id }}">
                                                                            {{ $b->nama }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <input type="number" class="form-control" name="qty[]"
                                                                    placeholder="Jumlah" min="0"
                                                                    value="{{ old('qty[]') }}"
                                                                    style="margin-right: 10px; flex-grow: 1">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-outline-primary"
                                                                id="add"><i class="bi bi-plus-lg"></i></button>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <table>
                                                    <tr>
                                                        <td>
                                                            <button type="submit" class="btn btn-primary"
                                                                style="margin-top:10px">
                                                                Submit
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </table>
                                                @if (session('message'))
                                                    <div class="alert alert-danger" style="margin-top: 20px">
                                                        <li>{{ session('message') }}</li>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </header>
    <!-- About Section-->
    <section class="bg-light py-5">
        <div class="container px-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-xxl-8">
                    <div class="text-center my-5">
                        <h2 class="display-5 fw-bolder"><span class="text-gradient d-inline">About</span></h2>
                        <p class="lead fw-light mb-4">Peminjaman Online Inventaris HMTI Polinema</p>
                        <p class="text-muted">Website ini berfungsi untuk menampung informasi data berikut:<br>
                            1. Informasi Data Barang dan Inventaris Himpunan Mahasiswa Teknologi Informasi<br>
                            2. Informasi Data Peminjam Barang dan Inventaris Himpunan Mahasiswa Teknologi Informasi<br>
                            3. Informasi Peminjaman Barang dan Inventaris Himpunan Mahasiswa Teknologi Informasi<br>

                            Dengan adanya website ini, mempermudah dalam proses penambahan, update, dan edit data barang dan
                            inventaris yang ada di
                            Himpunan Mahasiswa Teknologi Informasi</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('script')
    <script>
        $('#add').click(function() {
            $('#table').append(
                `<tr>` +
                `<td>` +
                `<div class="input-group" style="margin-top:10px">` +
                `<select name="barang[]" class="form-control" style="width: 50%">` +
                `<option value="{{ old('barang[]') }}">Pilih Barang </option>` +
                `@foreach ($barang as $b)` +
                `<option value="{{ $b->id }}">{{ $b->nama }}</option>` +
                `@endforeach` +
                `</select>` +
                `<input type="number" class="form-control" name="qty[]" placeholder="Jumlah" min="0" value="{{ old('qty[]') }}" style="margin-right: 10px; flex-grow: 1">` +
                `</div>` +
                `</td>` +
                `<td>` +
                `<button type="button" class="btn btn-outline-danger" id="remove" style="margin-top: 10px"><i class="bi bi-dash-lg"></i></button>` +
                `</td>` +
                `</tr>`
            )
        })

        $(document).on('click', '#remove', function() {
            $(this).closest('tr').remove()
        })
    </script>
@endpush
