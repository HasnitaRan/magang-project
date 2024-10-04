@include('layouts.main.navbar')
@include('layouts.sidebar.admin')

<div id="layoutSidenav_content">
    <main>
        <div class="px-4 container-fluid">

            <h1 class="mt-4">Data Dimensi</h1>
            <ol class="mb-4 breadcrumb">
                <h3 class="breadcrumb-item active">SMAN 1 TEGAL</h3>
            </ol>

            <div class="container mt-5">
                <div class="card">
                    <div class="card-header">Tabel Dimensi</div>
                    <div class="card-body">
                        <button class="mb-2 btn btn-primary" onclick="showModal()">Tambah Dimensi</button>
                        <table class="table table-bordered table-striped" id="tableDimensi">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>dimensi</th>
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
    @include('admin.datadimensi.modal')
    @include('layouts.main.footer')
    <script>
        let dimensiId; // Variabel global untuk menyimpan dimensi ID

        $(document).ready(function() {
            dimensiTable();
        });

        function dimensiTable() {
            $('#tableDimensi').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '/dimensi',
                columns: [{
                    data: 'DT_RowIndex',
                    nama: 'DT_RowIndex',
                }, {
                    data: 'dimensi',
                    nama: 'dimensi',
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
            $('#dimensiForm')[0].reset();
            resetValidation();
            $('#dimensiModal').modal('show');

            save_method = 'create';
            $('.modal-title').text('Tambah data Dimensi');
            $('.btnSubmit').text('Simpan');
            dimensiId = null; // Hapus dimensi ID dari variabel jika tambah data baru
        }

        //untuk store dan update
        $('#dimensiForm').on('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this)

            var url = 'dimensi',
                method = 'POST'; // Default untuk POST (tambah dimensi)

            if (save_method == 'update') {
                url = 'dimensi/' + dimensiId; // Gunakan dimensiId dari variabel untuk update
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
                    $('#tableDimensi').DataTable().ajax.reload();
                    Swal.fire({
                        title: "Good job!",
                        text: response.message,
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#dimensiModal').modal('hide');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR.responseText);
                }
            });
        });

        //show edited dimensi
        function editModal(e) {
            dimensiId = e.getAttribute('data-id'); // Simpan dimensiId di variabel
            save_method = 'update';

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                url: "dimensi/" + dimensiId,
                success: function(response) {
                    let result = response.data;
                    $('#dimensi').val(result.dimensi);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR.responseText);
                }
            });

            resetValidation();
            $('#dimensiModal').modal('show');
            $('.modal-title').text('Update data dimensi');
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
                        url: "dimensi/" + id,
                        dataType: 'json',
                        success: function(response) {
                            $('#dimensiModal').modal('hide');
                            $('#tableDimensi').DataTable().ajax.reload();
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
    {!! JsValidator::formRequest('App\Http\Requests\DimensiRequest', '#dimensiForm') !!}
