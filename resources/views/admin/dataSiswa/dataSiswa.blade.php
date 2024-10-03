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
                                    <th>NIS</th>
                                    <th>NISN</th>
                                    <th>Email</th>
                                    <th>Tahun Masuk</th>
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
        let userId;
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
                        data: 'nis',
                        nama: 'nis',
                    },
                    {
                        data: 'nisn',
                        nama: 'nisn',
                    }, {
                        data: 'email',
                        nama: 'email',
                    }, {
                        data: 'tahun_masuk',
                        nama: 'tahun_masuk',
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

        function resetValidation() {
            $('.is-invalid').removeClass('is-invalid');
            $('.is-valid').removeClass('is-valid');
            $('span.invalid-feedback').remove();
        }

        function showModal() {
            $('#siswaForm')[0].reset();
            resetValidation();
            $('#siswaModal').modal('show');

            $('.modal-title').text('Tambah data Siswa');
            $('.btnSubmit').text('Simpan');
            save_method = 'create';
            $('#statusAkunContainer').hide();
            userId = null; // Hapus user ID dari variabel jika tambah data baru
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

        function editModal(e) {
            userId = e.getAttribute('data-id'); // Simpan userId di variabel
            save_method = 'update';

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                url: "siswa/" + userId,
                success: function(response) {
                    let result = response.data;


                    $('#nama_siswa').val(result.nama_siswa);
                    $('#nis').val(result.nis);
                    $('#nisn').val(result.nisn);
                    $('#tempat_lahir').val(result.tempat_lahir);
                    $('#tgl_lahir').val(result.tgl_lahir);
                    $('#jenis_kelamin').val(result.jenis_kelamin);
                    $('#agama').val(result.agama ? result.agama.id : '');
                    $('#alamat').val(result.alamat);
                    $('#email').val(response.email);
                    $('#no_hp').val(result.no_hp);
                    $('#status_dalam_keluarga').val(result.status_dalam_keluarga);
                    $('#anak_ke').val(result.anak_ke);
                    $('#tahun_masuk').val(result.tahun_masuk);
                    $('#asal_sekolah').val(result.asal_sekolah);
                    $('#status_aktif').val(response.status_aktif); // Set status_akun

                    $('#statusAkunContainer').show(); // Show status_akun when editing

                    $('#siswaModal').modal('show'); // Show the modal
                    $('.modal-title').text('Update Data Siswa');
                    $('.btnSubmit').text('Perbarui');
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
                        url: "siswa/" + id,
                        dataType: 'json',
                        success: function(response) {
                            $('#siswaModal').modal('hide');
                            $('#tableSiswa').DataTable().ajax.reload();
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
    {!! JsValidator::formRequest('App\Http\Requests\SiswaRequest', '#siswaForm') !!}
