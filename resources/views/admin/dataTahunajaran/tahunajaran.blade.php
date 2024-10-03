@include('layouts.main.navbar')
@include('layouts.sidebar.admin')

<div id="layoutSidenav_content">
    <main>
        <div class="px-4 container-fluid">

            <h1 class="mt-4">Data tahun ajaran</h1>
            <ol class="mb-4 breadcrumb">
                <h3 class="breadcrumb-item active">SMAN 1 TEGAL</h3>
            </ol>

            <div class="container mt-5">
                <div class="card">
                    <div class="card-header">Tabel tahun ajaran</div>
                    <div class="card-body">
                        <button class="mb-2 btn btn-primary" onclick="showModal()">Tambah tahun ajaran</button>
                        <table class="table table-bordered table-striped" id="tableTahunajaran">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Semester</th>
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
    @include('admin.dataTahunajaran.modal')
    @include('layouts.main.footer')
    <script>
        let Idta; // Variabel global untuk menyimpan tahunajaran ID

        $(document).ready(function() {
            tahunajaransTable();
        });

        function tahunajaransTable() {
            $('#tableTahunajaran').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '/tahunajarans',
                columns: [{
                    data: 'DT_RowIndex',
                    nama: 'DT_RowIndex',
                }, {
                    data: 'tahun_ajaran',
                    nama: 'tahun_ajaran',
                }, {
                    data: 'semester',
                    nama: 'semester',
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
            $('#tahunajaranForm')[0].reset();
            resetValidation();
            $('#tahunajaranModal').modal('show');

            save_method = 'create';
            $('.modal-title').text('Tambah data tahun ajaran');
            $('.btnSubmit').text('Simpan');
            Idta = null;
        }

        //untuk store dan update
        $('#tahunajaranForm').on('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this)

            var url = 'tahunajaran',
                method = 'POST'; // Default untuk POST (tambah tahunajaran)

            if (save_method == 'update') {
                url = 'tahunajaran/' + Idta; // Gunakan Idta dari variabel untuk update
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
                    $('#tableTahunajaran').DataTable().ajax.reload();
                    Swal.fire({
                        title: "Good job!",
                        text: response.message,
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#tahunajaranModal').modal('hide');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR.responseText);
                }
            });
        });

        //show edited tahun ajaran
        function editModal(e) {
            Idta = e.getAttribute('data-id'); // Simpan Idta di variabel
            save_method = 'update';

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                url: "tahunajaran/" + Idta,
                success: function(response) {
                    let result = response.data;
                    $('#tahun_ajaran').val(result.tahun_ajaran);
                    $('#semester').val(result.semester);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR.responseText);
                }
            });

            resetValidation();
            $('#tahunajaranModal').modal('show');
            $('.modal-title').text('Update data tahunajaran');
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
                        url: "tahunajaran/" + id,
                        dataType: 'json',
                        success: function(response) {
                            $('#tahunajaranModal').modal('hide');
                            $('#tableTahunajaran').DataTable().ajax.reload();
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
    {!! JsValidator::formRequest('App\Http\Requests\TahunAjaranRequest', '#tahunajaranForm') !!}
