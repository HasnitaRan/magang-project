@include('layouts.main.navbar')
@include('layouts.sidebar.admin')

<div id="layoutSidenav_content">
    <main>
        <div class="px-4 container-fluid">

            <h1 class="mt-4">Data User</h1>
            <ol class="mb-4 breadcrumb">
                <h3 class="breadcrumb-item active">SMAN 1 TEGAL</h3>
            </ol>

            <div class="container mt-5">
                <div class="card">
                    <div class="card-header">Tabel User</div>
                    <div class="card-body">
                        <button class="mb-2 btn btn-primary" onclick="showModal()">Tambah User</button>
                        <table class="table table-bordered table-striped" id="tableUser">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status Akun</th>
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
    </main>
    @include('admin.dataUser.modal')
    @include('layouts.main.footer')
    <script>
        let userId; // Variabel global untuk menyimpan user ID

        $(document).ready(function() {
            usersTable();
        });

        function usersTable() {
            $('#tableUser').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '/users',
                columns: [{
                    data: 'DT_RowIndex',
                    nama: 'DT_RowIndex',
                }, {
                    data: 'username',
                    nama: 'username',
                }, {
                    data: 'email',
                    nama: 'email',
                }, {
                    data: 'role',
                    nama: 'role',
                }, {
                    data: 'status_aktif',
                    nama: 'status_aktif',
                }, {
                    data: 'aksi',
                    nama: 'aksi',
                }]
            });
        }

        function resetValidation() {
            $('.is-invalid').removeClass('is-invalid');
            $('.is-valid').removeClass('is-valid');
            $('span.invalid-feedback').remove();
        }

        function showModal() {
            $('#userForm')[0].reset();
            resetValidation();
            $('#userModal').modal('show');

            save_method = 'create';
            $('.modal-title').text('Tambah data User');
            $('.btnSubmit').text('Simpan');
            userId = null; // Hapus user ID dari variabel jika tambah data baru
        }

        //untuk store dan update
        $('#userForm').on('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this)

            var url = 'users',
                method = 'POST'; // Default untuk POST (tambah user)

            if (save_method == 'update') {
                url = 'users/' + userId; // Gunakan userId dari variabel untuk update
                formData.append('_method', 'PUT');
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: method,
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#tableUser').DataTable().ajax.reload();
                    Swal.fire({
                        title: "Good job!",
                        text: response.message,
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#userModal').modal('hide');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR.responseText);
                }
            });
        });

        //show edited user
        function editModal(e) {
            userId = e.getAttribute('data-id'); // Simpan userId di variabel
            save_method = 'update';

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                url: "users/" + userId,
                success: function(response) {
                    let result = response.data;
                    $('#username').val(result.username);
                    $('#email').val(result.email);
                    $('#password').val(result.password);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR.responseText);
                }
            });

            resetValidation();
            $('#userModal').modal('show');
            $('.modal-title').text('Update data User');
            $('.btnSubmit').text('Perbarui');
        }

        // destroy
        function deleteModal(e) {
            let id = e.getAttribute('data-id');
            Swal.fire({
                text: 'Apakah anda ingin menghapus data?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "DELETE",
                        url: "users/" + id,
                        dataType: 'json',
                        success: function(response) {
                            $('#userModal').modal('hide');
                            $('#tableUser').DataTable().ajax.reload();
                            Swal.fire({
                                title: "Good job!",
                                text: response.message,
                                icon: "success",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(jqXHR.responseText);
                            alert(jqXHR.responseText);
                        }
                    });
                }
            })
        }
    </script>
    <!-- Laravel Javascript Validation -->
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\UserRequest', '#userForm') !!}
