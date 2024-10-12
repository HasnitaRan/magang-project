@include('layouts.main.navbar')
@include('layouts.sidebar.admin')

<div id="layoutSidenav_content">
    <main>
        <div class="px-4 container-fluid">
            <h1 class="mt-4">Data Elemen</h1>
            <h3>Dimensi: {{ $dimensi->dimensi }}</h3>
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
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data akan diisi secara dinamis melalui DataTable -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('admin.dataElemen.modal')
    @include('layouts.main.footer')

    <script>
        let elemenId; // Variabel global untuk menyimpan elemen ID
        const dimensiId = '{{ $dimensi->id }}'; // Ambil dimensi ID dari variabel PHP

        $(document).ready(function() {
            elemenTable(dimensiId); // Panggil fungsi dengan dimensi ID yang benar
        });

        function elemenTable(dimensiId) {
            if ($.fn.dataTable.isDataTable('#tableElemen')) {
                $('#tableElemen').DataTable().clear().destroy();
            }
            $('#tableElemen').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: '/dimensi/' + dimensiId + '/elemens',
                    type: 'GET',
                    data: {
                        dimensi_id: dimensiId // Kirimkan dimensi_id ke server
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    }, {
                        data: 'elemen',
                        name: 'elemen',
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return `
                                <button class="btn btn-warning" data-id="${row.id}" onclick="editModal(this)">Edit</button>
                                <button class="btn btn-danger" data-id="${row.id}" onclick="deleteModal(this)">Hapus</button>
                            `;
                        }
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
            $('#elemenForm')[0].reset();
            resetValidation();
            $('#id_dimensi').val('{{ $dimensi->id }}');
            $('#elemenModal').modal('show');

            save_method = 'create';
            $('.modal-title').text('Tambah data Elemen');
            $('.btnSubmit').text('Simpan');
            elemenId = null; // Reset elemen ID
        }

        $('#elemenForm').on('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            formData.append('id_dimensi', dimensiId);

            let url = '/dimensi/' + dimensiId + '/elemen';
            let method = 'POST'; // Default untuk POST (tambah elemen)

            if (save_method === 'update') {
                url = '/dimensi/' + dimensiId + '/elemen/' + elemenId; // Gunakan elemenId untuk update
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
                error: function(jqXHR) {
                    console.log(jqXHR.responseText);
                }
            });
        });

        function editModal(e) {
            elemenId = e.getAttribute('data-id'); // Simpan elemenId di variabel
            save_method = 'update';

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                url: '/dimensi/' + dimensiId + '/elemen/' + elemenId, // Perbaiki URL
                success: function(response) {
                    let result = response.data;
                    $('#elemen').val(result.elemen);
                    $('#id_dimensi').val(result.id_dimensi);
                    $('#elemenModal').modal('show'); // Tampilkan modal
                    $('.modal-title').text('Update Data Elemen');
                    $('.btnSubmit').text('Perbarui');
                },
                error: function(jqXHR) {
                    console.log(jqXHR.responseText);
                }
            });
        }

        function deleteModal(e) {
            let id = e.getAttribute('data-id');
            let dimensiId = e.getAttribute('data-dimensi-id'); // Ambil dimensiId dari atribut data

            Swal.fire({
                text: 'Apakah anda ingin menghapus data?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "DELETE",
                        url: '/dimensi/' + dimensiId + '/elemen/' + id, // Gunakan dimensi_id di URL
                        dataType: 'json',
                        success: function(response) {
                            $('#tableElemen').DataTable().ajax.reload();
                            Swal.fire({
                                title: "Good job!",
                                text: response.message,
                                icon: "success",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        },
                        error: function(jqXHR) {
                            console.error(jqXHR.responseJSON.message || jqXHR.responseText);
                            Swal.fire({
                                title: "Error!",
                                text: jqXHR.responseJSON.message ||
                                    "Terjadi kesalahan saat menghapus data.",
                                icon: "error"
                            });
                        }
                    });
                }
            });
        }
    </script>
    <!-- Laravel Javascript Validation -->
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\ElemenRequest', '#elemenForm') !!}
</div>
