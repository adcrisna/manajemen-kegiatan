@extends('layouts.admin')
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
            <li><a href="{{ route('admin.index') }}"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Data Instansi</li>
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
                        <h3 class="box-title">Data Instansi</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-info btn-md" data-toggle="modal"
                                data-target="#modal-form-tambah-kegiatan"><i class="fa fa-plus"> Tambah Data
                                </i></button>
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        <table class="table table-bordered table-striped" id="data-kegiatan">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Instansi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (@$instansi as $key => $value)
                                    <tr>
                                        <td>{{ @$value->id }}</td>
                                        <td>{{ @$value->name }}</td>
                                        <td>
                                            <button class="btn btn-xs btn-success btn-edit-kegiatan"><i class="fa fa-edit">
                                                    Ubah</i></button> &nbsp;
                                            <a href="{{ route('admin.deleteInstansi', $value->id) }}"><button
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
    <div class="modal fade" id="modal-form-tambah-kegiatan" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Form Tambah Data Instansi</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.addInstansi') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group has-feedback">
                            <label>Nama Instansi:</label>
                            <input type="text" name="name" class="form-control" placeholder="Nama Instansi" required>
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
    <div class="modal fade" id="modal-form-edit-kegiatan" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Form Ubah Data Instansi</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.updateInstansi') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group has-feedback">
                            <input type="hidden" name="id" readonly class="form-control" placeholder="ID" required>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Nama Instansi:</label>
                            <input type="text" name="name" class="form-control" placeholder="Nama Instansi" required>
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

        $('#data-kegiatan').on('click', '.btn-edit-kegiatan', function() {
            row = table.row($(this).closest('tr')).data();
            console.log(row);
            $('input[name=id]').val(row[0]);
            $('input[name=name]').val(row[1]);
            $('#modal-form-edit-kegiatan').modal('show');
        });
        $('#modal-form-tambah-kegiatan').on('show.bs.modal', function() {
            $('input[name=id]').val('');
            $('input[name=name]').val('');
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
