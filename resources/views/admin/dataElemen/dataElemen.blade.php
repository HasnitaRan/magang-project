@include('layouts.main.navbar')
@include('layouts.sidebar.admin')

<div id="layoutSidenav_content">
    <main>
        <div class="px-4 container-fluid">

            <h1 class="mt-4">Data Elemen</h1>
            <ol class="mb-4 breadcrumb">
                <h3 class="breadcrumb-item active">SMAN 1 TEGAL</h3>
            </ol>

            <div class="container mt-5">
                <div class="card">
                    <div class="card-header">Tabel Elemen</div>
                    <div class="card-body">
                        <button class="mb-2 btn btn-primary" onclick="showModal()">Tambah Elemen</button>
                        <table class="table table-bordered table-striped" id="tableElemen">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Elemen</th>
                                    <th>Dimensi</th>
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
    @include('admin.dataelemen.modal')
    @include('layouts.main.footer')
    <script>
        let elemenId; // Variabel global untuk menyimpan elemen ID

        $(document).ready(function() {
            elemenTable();
        });

        function elemenTable() {
            $('#tableElemen').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '/elemen',
                columns: [{
                    data: 'DT_RowIndex',
                    nama: 'DT_RowIndex',
                }, {
                    data: 'elemen',
                    nama: 'elemen',
                }, { 
                    data: 'id_dimensi',
                    nama: 'id_dimensi',
                },
                
                {
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
            $('#elemenForm')[0].reset();
            resetValidation();
            $('#elemenModal').modal('show');

            save_method = 'create';
            $('.modal-title').text('Tambah data Elemen');
            $('.btnSubmit').text('Simpan');
            elemenId = null; // Hapus elemen ID dari variabel jika tambah data baru
        }

        //untuk store dan update
        $('#elemenForm').on('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this)

            var url = 'elemen',
                method = 'POST'; // Default untuk POST (tambah elemen)

            if (save_method == 'update') {
                url = 'elemen/' + elemenId; // Gunakan elemenId dari variabel untuk update
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
                    $('#tableElemen').DataTable().ajax.reload();
                    Swal.fire({
                        title: "Good job!",
                        text: response.message,
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#elemenModal').modal('hide');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR.responseText);
                }
            });
        });

        //show edited elemen
        function editModal(e) {
            elemenId = e.getAttribute('data-id'); // Simpan elemenId di variabel
            save_method = 'update';

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                url: "elemen/" + elemenId,
                success: function(response) {
                    let result = response.data;
                    $('#elemen').val(result.elemen);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR.responseText);
                }
            });

            resetValidation();
            $('#elemenModal').modal('show');
            $('.modal-title').text('Update data elemen');
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
                        url: "elemen/" + id,
                        dataType: 'json',
                        success: function(response) {
                            $('#elemenModal').modal('hide');
                            $('#tableelemen').DataTable().ajax.reload();
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
    {!! JsValidator::formRequest('App\Http\Requests\ElemenRequest', '#dlemenForm') !!}
