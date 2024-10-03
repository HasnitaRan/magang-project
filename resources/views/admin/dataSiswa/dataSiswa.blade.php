@include('layouts.main.navbar')
@include('layouts.sidebar.admin')

<div id="layoutSidenav_content">
    <main>
        <div class="px-4 container-fluid">

            <h1 class="mt-4">Data Siswa</h1>
            <ol class="mb-4 breadcrumb">
                <h3 class="breadcrumb-item active">SMAN 1 TEGAL</h3>
            </ol>

            <div class="container mt-5">
                <div class="card">
                    <div class="card-header">Tabel Data Siswa</div>
                    <div class="card-body">
                        <button class="mb-2 btn btn-primary" onclick="showModal()">Tambah Siswa</button>
                        <table class="table table-bordered table-striped" id="tableSiswa">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>L/P</th>
                                    <th>NIP</th>
                                    <th>Email</th>
                                    <th>No Hp</th>
                                    <th>Status Siswa</th>
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
    @include('admin.dataSiswa.modal')
    @include('layouts.main.footer')
    <script>
        $(document).ready(function() {
            usersTable();
        });

        function usersTable() {
            $('#tableSiswa').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '/siswas',
                columns: [{
                        data: 'DT_RowIndex',
                        nama: 'DT_RowIndex',
                    }, {
                        data: 'nama_siswa',
                        nama: 'nama_siswa',
                    }, {
                        data: 'jenis_kelamin',
                        nama: 'jenis_kelamin',
                    }, {
                        data: 'nip',
                        nama: 'nip',
                    }, {
                        data: 'email',
                        nama: 'email',
                    }, {
                        data: 'no_hp',
                        nama: 'no_hp',
                    },
                    {
                        data: 'status_aktif',
                        nama: 'user.status_aktif',
                    },
                    {
                        data: 'aksi',
                        nama: 'aksi',
                    }
                ]
            });
        }

        function showModal() {
            $('#siswaModal').modal('show');
            $('.modal-title').text('Tambah data Siswa');
            $('.btnSubmit').text('Simpan');
            save_method = 'create';
        }
        //untuk store dan update
        $('#siswaForm').on('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this)

            var url = 'siswa',
                method = 'POST'; // Default untuk POST (tambah user)

            if (save_method == 'update') {
                url = 'siswa/' + userId; // Gunakan userId dari variabel untuk update
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
                    $('#tableSiswa').DataTable().ajax.reload();
                    Swal.fire({
                        title: "Good job!",
                        text: response.message,
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#siswaModal').modal('hide');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR.responseText);
                }
            });
        });
    </script>
    <!-- Laravel Javascript Validation -->
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\SiswaRequest', '#siswaForm') !!}
