@include('layouts.main.navbar')
@include('layouts.sidebar.admin')

<div id="layoutSidenav_content">
    <main>
        <div class="px-4 container-fluid">

            <h1 class="mt-4">Data Guru</h1>
            <ol class="mb-4 breadcrumb">
                <h3 class="breadcrumb-item active">SMAN 1 TEGAL</h3>
            </ol>

            <div class="container mt-5">
                <div class="card">
                    <div class="card-header">Tabel Data Guru</div>
                    <div class="card-body">
                        <button class="mb-2 btn btn-primary" onclick="showModal()">Tambah Guru</button>
                        <table class="table table-bordered table-striped" id="tableGuru">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>L/P</th>
                                    <th>NIP</th>
                                    <th>Email</th>
                                    <th>No Hp</th>
                                    <th>Status Guru</th>
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
    @include('admin.dataGuru.modal')
    @include('layouts.main.footer')
    <script>
        let userId; // Variabel global untuk menyimpan user ID
        $(document).ready(function() {
            usersTable();
        });

        function usersTable() {
            $('#tableGuru').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '/gurus',
                columns: [{
                        data: 'DT_RowIndex',
                        nama: 'DT_RowIndex',
                    }, {
                        data: 'nama_guru',
                        nama: 'nama_guru',
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

        function resetValidation() {
            $('.is-invalid').removeClass('is-invalid');
            $('.is-valid').removeClass('is-valid');
            $('span.invalid-feedback').remove();
        }

        function showModal() {
            $('#guruForm')[0].reset();
            resetValidation();
            $('#guruModal').modal('show');

            $('.modal-title').text('Tambah data Guru');
            $('.btnSubmit').text('Simpan');
            save_method = 'create';
            $('#statusAkunContainer').hide();
            userId = null; // Hapus user ID dari variabel jika tambah data baru
        }
        //untuk store dan update
        $('#guruForm').on('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this)

            var url = 'guru',
                method = 'POST'; // Default untuk POST (tambah user)

            if (save_method == 'update') {
                url = 'guru/' + userId; // Gunakan userId dari variabel untuk update
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
                    $('#tableGuru').DataTable().ajax.reload();
                    Swal.fire({
                        title: "Good job!",
                        text: response.message,
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#guruModal').modal('hide');
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
                url: "guru/" + userId,
                success: function(response) {
                    let result = response.data;


                    $('#nama_guru').val(result.nama_guru);
                    $('#nip').val(result.nip);
                    $('#tempat_lahir').val(result.tempat_lahir);
                    $('#tgl_lahir').val(result.tgl_lahir);
                    console.log('Sebelum set:', $('#jenis_kelamin').val()); // Nilai sebelum diset
                    $('#jenis_kelamin').val(result.jenis_kelamin);
                    console.log('Setelah set:', $('#jenis_kelamin').val()); // Nilai setelah diset

                    $('#agama').val(result.agama ? result.agama.id : '');
                    $('#alamat').val(result.alamat);
                    $('#email').val(response.email);
                    $('#no_hp').val(result.no_hp);
                    $('#status_aktif').val(response.status_aktif); // Set status_akun

                    $('#statusAkunContainer').show(); // Show status_akun when editing

                    $('#guruModal').modal('show'); // Show the modal
                    $('.modal-title').text('Update Data Guru');
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
                        url: "guru/" + id,
                        dataType: 'json',
                        success: function(response) {
                            $('#guruModal').modal('hide');
                            $('#tableGuru').DataTable().ajax.reload();
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
    {!! JsValidator::formRequest('App\Http\Requests\GuruRequest', '#guruForm') !!}
