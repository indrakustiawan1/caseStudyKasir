@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex">
                    <h3 class="card-title">Permission</h3>
                    <div class="ml-auto">
                        <button type="button" class="btn btn-sm btn-primary mt-2" data-toggle="modal"
                            data-target="#modalPermission" id="btn-addPermission">Tambah</button>
                    </div>
                </div>

                <div class="card-body">
                    <table id="dtPermission" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Guard Name</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Guard Name</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- //modal default --}}
    <div class="modal fade" id="modalPermission" aria-labelledby="modalPermissionLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPermissionLabel">Permission</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formPermission">
                        <div class="card-body">
                            <input type="hidden" id="id" name="id">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter Name Permission">
                                <p class="text-xs text-danger err" id="name_error"></p>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Guard Name</label>
                                <input type="text" class="form-control" id="guard_name" name="guard_name"
                                    placeholder="Enter Guard Name Permission">
                                <p class="text-xs text-danger err" id="guard_name_error"></p>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> --}}
                            <button type="submit" class="btn btn-primary" id="btn-save">Save</button>
                        </div>
                    </form>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <script>
        $(document).ready(function() {

            var SITEURL = "{{ route('permission') }}";

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#dtPermission').DataTable({
                responsive: true,
                paging: true,
                bDestroy: true,
                searching: true,
                ordering: false,
                lengthChange: true,
                autoWidth: false,
                aaSorting: [],
                serverSide: true,
                processing: true,
                language: {
                    paginate: {
                        previous: "<i class='fa-solid fa-angle-left'>",
                        next: "<i class='fa-solid fa-angle-right'>"
                    }
                },

                ajax: {
                    type: 'POST',
                    url: "{{ route('permission-list') }}"
                },

                columns: [{
                        orderable: false,
                        className: 'text-center',
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        width: '20px'
                    },
                    {
                        name: 'name',
                        data: 'name',
                    },
                    {
                        name: 'guard_name',
                        data: 'guard_name',
                    }, {
                        data: 'action',
                        orderable: false,
                        width: '80px',
                        className: 'text-center'
                    },
                ]
            });

            // create
            $('#formPermission').submit(function(e) {
                e.preventDefault();
                formData = new FormData($('#formPermission')[0]);
                $.ajax({
                    type: 'POST',
                    url: SITEURL,
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('.err').empty();
                        $('#btn-save').attr('disabled', true).html(
                            '<i class="fas fa-spinner fa-spin"></i>');
                    },
                    success: function(response) {
                        console.log(response);
                        $('#btn-save').attr('disabled', false).html('Simpan');
                        if (response.status == false) {
                            $.each(response.error, function(i, val) {
                                $("#" + i + "_error").html(val[0])
                            });
                        } else {
                            $('#modalPermission').modal('hide');
                            $('#dtPermission').DataTable().ajax.reload(null, false);
                            reset()
                        }
                    }
                });
            });

            // delete
            $(document).on('click', '#btn-deletePermission', function() {
                id = $(this).data('id')
                $.ajax({
                    type: "delete",
                    url: SITEURL + "/" + id,
                    dataType: "json",
                    success: function(response) {
                        $('#dtPermission').DataTable().ajax.reload(null, false);
                        Toast.fire({
                            icon: 'success',
                            title: 'Data Berhasil di hapus!.'
                        })
                    }
                });
            });

            // edit
            $(document).on('click', '#btn-editPermission', function() {
                id = $(this).data('id')
                $.ajax({
                    type: "get",
                    url: SITEURL + "/" + id + "/edit",
                    dataType: "json",
                    success: function(response) {
                        if (response.status) {
                            $('#modalPermission').modal('show');
                            $('#id').val(response.data.id)
                            $('#permission').val(response.data.name)
                        } else {
                            console.error('Data tidak ditemukan.');
                        }
                    }
                });
            });

            $('#btn-addPermission').click(function(e) {
                e.preventDefault();
                reset();
            });

            $('.cancel').click(function(e) {
                e.preventDefault();
                reset();
            });

            function reset() {
                $("input[type=hidden]").val('');
                $('#formPermission').trigger('reset');
                $('.err').empty();
            }
        });
    </script>
@endsection
