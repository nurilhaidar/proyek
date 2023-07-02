@extends('admin.layout.template')
@section('content')
    <div id="content">
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- DataTales Example -->
            <form method="POST" action="{{ $url_form }}" enctype="multipart/form-data">
                <div class="col-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h4>Form Peminjaman</h4>
                        </div>
                        <div class="card-body">
                            @csrf
                            {!! isset($data) ? method_field('PUT') : '' !!}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input class="form-control @error('nama_peminjam') is-invalid @enderror"
                                            value="{{ isset($data) ? $data->nama_peminjam : old('nama_peminjam') }}"
                                            name="nama_peminjam" type="text" {{ isset($data) ? 'disabled' : '' }} />
                                        @error('nama_peminjam')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Asal OKI</label>
                                        <input class="form-control @error('oki') is-invalid @enderror"
                                            value="{{ isset($data) ? $data->asal_oki : old('oki') }}" name="oki"
                                            type="text" {{ isset($data) ? 'disabled' : '' }} />
                                        @error('oki')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Tanggal Pinjam</label>
                                        <input class="form-control @error('tanggal_pinjam') is-invalid @enderror"
                                            value="{{ isset($data) ? $data->tanggal_pinjam : old('tanggal_pinjam') }}"
                                            name="tanggal_pinjam" type="date" {{ isset($data) ? 'disabled' : '' }} />
                                        @error('tanggal_pinjam')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Tanggal Kembali</label>
                                        <input class="form-control @error('tanggal_kembali') is-invalid @enderror"
                                            value="{{ isset($data) ? $data->tanggal_kembali : old('tanggal_kembali') }}"
                                            name="tanggal_kembali" type="date" {{ isset($data) ? 'disabled' : '' }} />
                                        @error('tanggal_kembali')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Surat</label><br>
                                        <input class=" @error('surat') is-invalid @enderror" value="" name="surat"
                                            type="file"{{ isset($data) ? 'disabled' : '' }} />
                                        <br>
                                        @isset($data)
                                            <span><a href="{{ url('administrator/download/' . $data->surat) }}">Download
                                                    Surat</a></span>
                                        @endisset
                                        @error('surat')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Jaminan</label>
                                        <div class="form-check form-check-solid">
                                            <input class="form-check-input" id="ktm" type="radio" name="jaminan"
                                                value="KTM"
                                                {{ old('jaminan') == 'KTM' || (isset($data) ? $data->jaminan == 'KTM' : '') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="ktm">KTM</label>
                                        </div>
                                        <div class="form-check form-check-solid">
                                            <input class="form-check-input" id="ktp" type="radio" name="jaminan"
                                                value="KTP"
                                                {{ old('jaminan') == 'KTP' || (isset($data) ? $data->jaminan == 'KTP' : '') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="ktp">KTP</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <label>No Telepon</label><br>
                                    <input class="form-control @error('telp') is-invalid @enderror" name="telp"
                                        type="text" value="{{ isset($data) ? $data->telp : '' }}"
                                        {{ isset($data) ? 'disabled' : '' }} />
                                    <br>
                                    @error('telp')
                                        <span>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h4>Form Barang</h4>
                            </div>
                            <div class="card-body">
                                @if (session('message'))
                                    <div class="alert alert-danger" role="alert">
                                        <ul>
                                            @foreach (session('message') as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="form-group">
                                    @if (isset($data))
                                        @foreach ($data->detail as $d)
                                            <div class="form-group input-group">
                                                <input type="text" class="form-control" value="{{ $d->nama }}"
                                                    disabled>
                                                <input type="number" class="form-control col-3" name="qty[]"
                                                    placeholder="Jumlah" min="0" value="{{ $d->pivot->qty }}"
                                                    disabled>
                                            </div>
                                        @endforeach
                                    @else
                                        <table id="table">
                                            <tr>
                                                <td>
                                                    <div class="input-group">
                                                        <select name="barang[]" class="form-control"
                                                            style="margin-bottom: 5px">
                                                            <option value="{{ old('barang[]') }}">Pilih Barang</option>
                                                            @foreach ($barang as $b)
                                                                <option value="{{ $b->id }}">{{ $b->nama }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <input type="number" class="form-control col-3" name="qty[]"
                                                            placeholder="Jumlah" min="0"
                                                            value="{{ old('qty[]') }}">
                                                    </div>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary" id="add"
                                                        style="margin-bottom: 5px">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </table>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
            </form>
            <div class="col-6">
                <form action="{{ $form_status }}" method="POST">
                    @csrf
                    {!! isset($data) ? method_field('PUT') : '' !!}
                    <div class="form-group">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h4>Form Peminjaman</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label>Status</label><br>
                                        <select name="status" class="form-control">
                                            <option value=""></option>
                                            <option value="Belum Dikonfirmasi"
                                                {{ isset($data) ? ($data->status->status == 'Belum Dikonfirmasi' ? 'selected' : '') : '' }}>
                                                Belum Dikonfirmasi </option>
                                            <option
                                                {{ isset($data) ? ($data->status->status == 'Dikonfirmasi' ? 'selected' : '') : '' }}
                                                value="Dikonfirmasi">Dikonfirmasi</option>
                                            <option
                                                {{ isset($data) ? ($data->status->status == 'Diterima' ? 'selected' : '') : '' }}
                                                value="Diterima">Diterima</option>
                                            <option
                                                {{ isset($data) ? ($data->status->status == 'Dikembalikan' ? 'selected' : '') : '' }}
                                                value="Dikembalikan">Dikembalikan</option>
                                            <option
                                                {{ isset($data) ? ($data->status->status == 'Dibatalkan' ? 'selected' : '') : '' }}
                                                value="Dibatalkan">Dibatalkan</option>
                                        </select>
                                        @error('status')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Keterangan</label><br>
                                        <textarea name="keterangan" class="form-control" rows="3" id="myText"></textarea>
                                        @error('keterangan')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-6">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('custom_js')
    <script>
        document.getElementById('myText').value = "{{ isset($data) ? $data->status->keterangan : '' }}";
    </script>
@endpush

@if (isset($data))
    @push('custom_js')
        <script>
            $('#add').click(function() {
                $('#table').append(
                    '<tr>' +
                    '<td>' +
                    '<div class="input-group">' +
                    '<select name="barang[]" class="form-control" style="margin-bottom: 5px">' +
                    '<option value="">Pilih Barang</option>' +
                    '@foreach ($barang as $b)' +
                    '<option value="{{ $b->id }}">{{ $b->nama }}</option>' +
                    '@endforeach' +
                    '</select>' +
                    '<input type="number" class="form-control col-3" name="qty[]" placeholder="Jumlah">' +
                    '</div>' +
                    '</td>' +
                    '<td>' +
                    '<button type="button" class="btn btn-danger" id="remove" style="margin-bottom: 5px">' +
                    '<i class="fa fa-minus"></i>' +
                    '</button>' +
                    '<tr>'
                )
            })

            $(document).on('click', '#remove', function() {
                $(this).closest('tr').remove()
            })
        </script>
    @endpush
@endif
