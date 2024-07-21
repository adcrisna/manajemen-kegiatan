@extends('layouts.user')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/morris/morris.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
    <style>
        img.zoom {
            width: 130px;
            height: 100px;
            -webkit-transition: all .2s ease-in-out;
            -moz-transition: all .2s ease-in-out;
            -o-transition: all .2s ease-in-out;
            -ms-transition: all .2s ease-in-out;
        }

        .transisi {
            -webkit-transform: scale(1.8);
            -moz-transform: scale(1.8);
            -o-transform: scale(1.8);
            transform: scale(1.8);
        }
    </style>
@endsection

@section('content')
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="{{ route('user.index') }}"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Detail</li>
        </ol>
    </section>
    <br />
    <br />
    <section class="content">
        @if (\Session::has('msg_success'))
            <h5>
                <div class="alert alert-warning">
                    {{ \Session::get('msg_success') }}
                </div>
            </h5>
        @endif
        @if (\Session::has('msg_error'))
            <h5>
                <div class="alert alert-danger">
                    {{ \Session::get('msg_error') }}
                </div>
            </h5>
        @endif
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Detail Kegiatan</h3>
                        <div class="box-tools pull-right">
                            @if ($detail->jenis_kegiatan == 'Penegakan Hukum')
                                <a href="{{ route('user.penegakan_hukum') }}" class="btn btn-sm btn-warning">
                                    Kembali</a>
                            @elseif ($detail->jenis_kegiatan == 'Pendampingan Hukum')
                                <a href="{{ route('user.pendampingan_hukum') }}" class="btn btn-sm btn-warning">
                                    Kembali</a>
                            @elseif ($detail->jenis_kegiatan == 'Bantuan Hukum Litigasi')
                                <a href="{{ route('user.bantuan_hukum_litigasi') }}" class="btn btn-sm btn-warning">
                                    Kembali</a>
                            @elseif ($detail->jenis_kegiatan == 'Bantuan Hukum Non Litigasi')
                                <a href="{{ route('user.bantuan_hukum_non_litigasi') }}" class="btn btn-sm btn-warning">
                                    Kembali</a>
                            @elseif ($detail->jenis_kegiatan == 'Pendapat Hukum')
                                <a href="{{ route('user.pendapat_hukum') }}" class="btn btn-sm btn-warning">
                                    Kembali</a>
                            @elseif ($detail->jenis_kegiatan == 'Pelayanan Hukum')
                                <a href="{{ route('user.pelayanan_hukum') }}" class="btn btn-sm btn-warning">
                                    Kembali</a>
                            @elseif ($detail->jenis_kegiatan == 'Audit Hukum')
                                <a href="{{ route('user.audit_hukum') }}" class="btn btn-sm btn-warning">
                                    Kembali</a>
                            @elseif ($detail->jenis_kegiatan == 'Bantuan Hukum Lainnya')
                                <a href="{{ route('user.bantuan_hukum_lainnya') }}" class="btn btn-sm btn-warning">
                                    Kembali</a>
                            @elseif ($detail->jenis_kegiatan == 'Perjanjian Kerjasama')
                                <a href="{{ route('user.perjanjian_kerjasama') }}" class="btn btn-sm btn-warning">
                                    Kembali</a>
                            @endif
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        <form action="{{ route('user.update_kegiatan') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group has-feedback">
                                <label>Nama Kegiatan:</label>
                                <input type="text" name="name" class="form-control" value="{{ $detail->name }}"
                                    required>
                                <input type="hidden" name="id" class="form-control" value="{{ $detail->id }}"
                                    readonly>
                            </div>
                            <div class="form-group has-feedback">
                                <label>Instansi:</label>
                                <select name="instansi" class="form-control" required>
                                    <option value="">Pilih</option>
                                    @foreach ($instansi as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $detail->instansi_id == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group has-feedback">
                                <label>Tanggal:</label>
                                <input type="date" name="tanggal" class="form-control" value="{{ $detail->tanggal }}"
                                    required>
                            </div>
                            <div class="form-group has-feedback">
                                <label>Tempat:</label>
                                <input type="text" name="tempat" class="form-control" value="{{ $detail->tempat }}"
                                    required>
                            </div>
                            <div class="form-group has-feedback">
                                <label>Deskripsi:</label>
                                <textarea name="deskripsi" class="form-control" cols="3" rows="1" required>{{ $detail->deskripsi }}</textarea>
                            </div>
                            <div class="form-group has-feedback">
                                <label>Foto Kegiatan(PDF) Baru:</label>
                                <input type="file" name="pdf" class="form-control" placeholder="Foto">
                            </div>
                            <div class="row">
                                <div class="col-xs-2 col-xs-offset-5">
                                    <button type="submit" class="btn btn-primary btn-block btn-flat">Update</button>
                                </div>
                            </div>
                        </form>
                        <br>
                        <br>
                        @if (!empty(@$detail->pdf))
                            <embed type="application/pdf" src="{{ asset('pdf/' . @$detail->pdf) }}" width="100%"
                                height="700px"></embed>
                        @else
                            <p>PDF tidak ditemukan, Silahkan Upload Ulang PDF</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <br />
    </section>
@endsection

@section('javascript')
    <script src="{{ asset('adminlte/plugins/morris/morris.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/raphael/raphael-min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.zoom').hover(function() {
                $(this).addClass('transisi');
            }, function() {
                $(this).removeClass('transisi');
            });
        });
    </script>
@endsection
