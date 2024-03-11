@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex">
                    <h3 class="card-title">User</h3>
                    <div class="ml-auto">
                        <button type="button" class="btn btn-sm btn-primary mt-2" data-toggle="modal" data-target="#modalUser"
                            id="btn-addUser">Tambah</button>
                    </div>
                </div>

                <div class="card-body">
                    <table id="dtUser" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- //modal default --}}
    <div class="modal fade" id="modalUser" aria-labelledby="modalUserLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalUserLabel">User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formUser">
                        <div class="card-body">
                            <input type="hidden" id="id" name="id">
                            <div class="form-group">
                                <label>Role</label>
                                <select class="form-control select2bs4" id="role" name="role" style="width: 100%;">
                                    <option value="" disabled selected>- Pilih Role-</option>
                                    @foreach ($role as $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter Name">
                                <p class="text-xs text-danger err" id="name_error"></p>
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    placeholder="Enter Username">
                                <p class="text-xs text-danger err" id="username_error"></p>

                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter Email">
                                <p class="text-xs text-danger err" id="email_error"></p>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Enter Password">
                                <p class="text-xs text-danger err" id="password_error"></p>
                            </div>
                            <div class="form-group">
                                <label for="confirmation_password">Confirmation Password</label>
                                <input type="password" class="form-control" id="confirmation_password"
                                    name="confirmation_password" placeholder="Enter Password">
                                <p class="text-xs text-danger err" id="confirmation_password_error"></p>
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

    {{-- //modal set permission --}}
    <div class="modal fade" id="modalSetUserPermission" aria-labelledby="modalUserPermissionLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalUserPermissionLabel">Set User Permissions</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formSetUserPermissions">
                        <div class="card-body">
                            <input type="hidden" id="id_set_permission" name="id_set_permission">

                            <div class="form-group">
                                <label for="permissions">Permissions:</label>
                                <div class="checkbox">
                                    @foreach ($permissions as $permission)
                                        <label>
                                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}">
                                            {{ $permission->name }}
                                        </label><br>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="btn-save-set-permission">Save</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>

    <!-- /.modal-dialog -->
    </div>
    <script>
        $(document).ready(function() {

            var SITEURL = "{{ route('user') }}";

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#dtUser').DataTable({
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
                    url: "{{ route('user-list') }}"
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
                    }, {
                        name: 'username',
                        data: 'username',
                        className: 'text-center'
                    }, {
                        name: 'email',
                        data: 'email',
                        className: 'text-center'
                    }, {
                        data: 'action',
                        orderable: false,
                        width: '80px',
                        className: 'text-center'
                    },
                ]
            });

            // create
            $('#formUser').submit(function(e) {
                e.preventDefault();
                formData = new FormData($('#formUser')[0]);
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
                            $('#modalUser').modal('hide');
                            $('#dtUser').DataTable().ajax.reload(null, false);
                            reset()
                        }
                    }
                });
            });

            // delete
            $(document).on('click', '#btn-deleteUser', function() {
                id = $(this).data('id')
                $.ajax({
                    type: "delete",
                    url: SITEURL + "/" + id,
                    dataType: "json",
                    success: function(response) {
                        $('#dtUser').DataTable().ajax.reload(null, false);
                        Toast.fire({
                            icon: 'success',
                            title: 'Data Berhasil di hapus!.'
                        })
                    }
                });
            });

            // edit
            $(document).on('click', '#btn-editUser', function() {
                id = $(this).data('id')
                $.ajax({
                    type: "get",
                    url: SITEURL + "/" + id + "/edit",
                    dataType: "json",
                    success: function(response) {
                        if (response.status) {
                            $('#modalUser').modal('show');
                            $('#id').val(response.data.id)
                            $('#role').val(response.data.role)
                            $('#name').val(response.data.name)
                            $('#username').val(response.data.username)
                            $('#email').val(response.data.email)
                            $('#password').val(response.data.password)
                            $('#confirmation_password').val(response.data.confirmation_password)
                        } else {
                            console.error('Data tidak ditemukan.');
                        }
                    }
                });
            });

            // set Permission
            $(document).on('click', '#btn-setAccesUser', function() {
                console.log('sampai');
                id = $(this).data('id')
                $.ajax({
                    type: "get",
                    url: SITEURL + "/" + id + "/edit",
                    dataType: "json",
                    success: function(response) {
                        if (response.status) {
                            $('#modalSetUserPermission').modal('show');
                            $('#id_set_permission').val(response.data.id)
                            $('#role').val(response.data.role)
                            $('#name').val(response.data.name)
                            $('#username').val(response.data.username)
                            $('#email').val(response.data.email)
                            $('#password').val(response.data.password)
                            $('#confirmation_password').val(response.data.confirmation_password)
                        } else {
                            console.error('Data tidak ditemukan.');
                        }
                    }
                });
            });

            $('#formSetUserPermissions').on('submit', function(e) {
                e.preventDefault(); // Mencegah perilaku default formulir
                // Ambil data formulir
                var formData = $(this).serialize();
                // Kirim data ke server menggunakan AJAX
                $.ajax({
                    type: 'POST',
                    url: '/set-user-permissions', // Ganti dengan URL yang sesuai di controller Anda
                    data: formData,
                    success: function(response) {
                        // Tampilkan pesan atau lakukan tindakan lain sesuai kebutuhan
                        console.log(response);
                        // Misalnya, tutup modal setelah berhasil disimpan
                        $('#modalSetUserPermission').modal('hide');
                    },
                    error: function(xhr, status, error) {
                        // Tangani kesalahan jika terjadi
                        console.error(xhr.responseText);
                    }
                });
            });

            $('#btn-addUser').click(function(e) {
                e.preventDefault();
                reset();
            });

            $('.cancel').click(function(e) {
                e.preventDefault();
                reset();
            });

            function reset() {
                $("input[type=hidden]").val('');
                $('#formUser').trigger('reset');
                $('.err').empty();
            }
        });
    </script>
@endsection
