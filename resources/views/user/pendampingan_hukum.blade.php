@extends('layouts.user')
@section('css')
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables/dataTables.bootstrap.css') }}">
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
            <li class="active">Data Kegiatan</li>
        </ol>
        <br />
    </section>
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
                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title">Data Pendampingan Hukum</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-info btn-md" data-toggle="modal"
                                data-target="#modal-form-tambah-kegiatan"><i class="fa fa-plus"> Tambah Data
                                </i></button>
                            <button type="button" class="btn btn-warning btn-md" data-toggle="modal"
                                data-target="#modal-form-cetak-kegiatan"><i class="fa fa-download"> Laporan Kegiatan
                                </i></button>
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        <table class="table table-bordered table-striped" id="data-kegiatan">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Kegiatan</th>
                                    <th style="display: none">ID Instansi</th>
                                    <th>Instansi</th>
                                    <th>Tanggal</th>
                                    <th>Tempat</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (@$kegiatan as $key => $value)
                                    <tr>
                                        <td>{{ @$value->id }}</td>
                                        <td>{{ @$value->name }}</td>
                                        <td style="display: none">{{ @$value->instansi_id }}</td>
                                        <td>{{ @$value->Instansi->name }}</td>
                                        <td>{{ @$value->tanggal }}</td>
                                        <td>{{ @$value->tempat }}</td>
                                        <td>{{ @$value->deskripsi }}</td>
                                        <td>
                                            <a href="{{ route('user.detail_kegiatan', $value->id) }}"><button
                                                    class=" btn btn-xs btn-warning"><i class="fa fa-eye">
                                                        Detail</i></button></a> &nbsp;
                                            <a href="{{ route('user.delete_kegiatan', $value->id) }}"><button
                                                    class=" btn btn-xs btn-danger"
                                                    onclick="return confirm('Apakah anda ingin menghapus data ini ?')"><i
                                                        class="fa fa-trash"> Hapus</i></button></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="modal-form-cetak-kegiatan" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Form Laporan Data Kegiatan</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('user.laporanKegiatan') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group has-feedback">
                            <label>Tanggal Awal:</label>
                            <input type="date" name="tanggalAwal" class="form-control" placeholder="No Register"
                                required>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Tanggal Akhir:</label>
                            <input type="date" name="tanggalAkhir" class="form-control" placeholder="Tanggal" required>
                        </div>
                        <input type="hidden" name="jenisKegiatan" class="form-control" value="Pendampingan Hukum">
                        <div class="row">
                            <div class="col-xs-4 col-xs-offset-8">
                                <button type="submit" target="_blank"
                                    class="btn btn-primary btn-block btn-flat">Laporan</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-form-tambah-kegiatan" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Form Tambah Data Pendampingan Hukum</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('user.add_kegiatan') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group has-feedback">
                            <label>Nama Kegiatan:</label>
                            <input type="text" name="name" class="form-control" placeholder="Nama Instansi" required>
                            <input type="hidden" name="jenis_kegiatan" value="Pendampingan Hukum" readonly>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Instansi:</label>
                            <select name="instansi" class="form-control" required>
                                <option value="">Pilih</option>
                                @foreach ($instansi as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Tanggal:</label>
                            <input type="date" name="tanggal" class="form-control" placeholder="Tanggal" required>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Tempat:</label>
                            <input type="text" name="tempat" class="form-control" placeholder="Tempat" required>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Deskripsi:</label>
                            <textarea name="deskripsi" class="form-control" cols="3" rows="1" required></textarea>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Foto Kegiatan(PDF):</label>
                            <input type="file" name="pdf" class="form-control" placeholder="Foto" required>
                        </div>
                        <div class="row">
                            <div class="col-xs-4 col-xs-offset-8">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">
        var table = $('#data-kegiatan').DataTable();

        $('#modal-form-tambah-kegiatan').on('show.bs.modal', function() {
            $('input[name=id]').val('');
            $('input[name=name]').val('');
            $('input[name=tanggal]').val('');
            $('select[name=instansi]').val('');
            $('input[name=tempat]').val('');
            $('textarea[name=deskripsi]').val('');
        });

        $(document).ready(function() {
            $('.zoom').hover(function() {
                $(this).addClass('transisi');
            }, function() {
                $(this).removeClass('transisi');
            });
        });
    </script>
@endsection
