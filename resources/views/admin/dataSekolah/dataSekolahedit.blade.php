<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    @include('layouts.main.navbar')
    @include('layouts.sidebar.admin')

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-6">Edit Data Sekolah</h1>
                <ol class="breadcrumb mb-6">
                    <li class="breadcrumb-item active">Edit Data Sekolah - SMAN 01 Tegal</li>
                </ol>
                <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
                    <form id="editForm" action="{{ route('sekolah.update', $sekolah->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="nama_sekolah" class="block text-sm font-medium text-gray-700">Nama
                                Sekolah</label>
                            <input type="text" id="nama_sekolah" name="nama_sekolah"
                                value="{{ $sekolah->nama_sekolah }}"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="mb-4">
                            <label for="npsn" class="block text-sm font-medium text-gray-700">NPSN</label>
                            <input type="text" id="npsn" name="npsn" value="{{ $sekolah->npsn }}"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="mb-4">
                            <label for="jalan" class="block text-sm font-medium text-gray-700">Jalan</label>
                            <input type="text" id="jalan" name="jalan" value="{{ $sekolah->jalan }}"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="mb-4">
                            <label for="desa_kelurahan"
                                class="block text-sm font-medium text-gray-700">Desa/Kelurahan</label>
                            <input type="text" id="desa_kelurahan" name="desa_kelurahan"
                                value="{{ $sekolah->desa_kelurahan }}"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="mb-4">
                            <label for="kecamatan" class="block text-sm font-medium text-gray-700">Kecamatan</label>
                            <input type="text" id="kecamatan" name="kecamatan" value="{{ $sekolah->kecamatan }}"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="mb-4">
                            <label for="kabupaten" class="block text-sm font-medium text-gray-700">Kab/Kota</label>
                            <input type="text" id="kabupaten" name="kabupaten" value="{{ $sekolah->kabupaten }}"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="mb-4">
                            <label for="provinsi" class="block text-sm font-medium text-gray-700">Provinsi</label>
                            <input type="text" id="provinsi" name="provinsi" value="{{ $sekolah->provinsi }}"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="mb-4">
                            <label for="kode_pos" class="block text-sm font-medium text-gray-700">Kode Pos</label>
                            <input type="text" id="kode_pos" name="kode_pos" value="{{ $sekolah->kode_pos }}"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="mb-4">
                            <label for="no_telp" class="block text-sm font-medium text-gray-700">No Telepon</label>
                            <input type="text" id="no_telp" name="no_telp" value="{{ $sekolah->no_telp }}"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="text" id="email" name="email" value="{{ $sekolah->email }}"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="mb-4">
                            <label for="website" class="block text-sm font-medium text-gray-700">Website</label>
                            <input type="text" id="website" name="website" value="{{ $sekolah->website }}"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="mb-4">
                            <label for="kepala_sekolah" class="block text-sm font-medium text-gray-700">Kepala
                                Sekolah</label>
                            <input type="text" id="kepala_sekolah" name="kepala_sekolah"
                                value="{{ $sekolah->kepala_sekolah }}"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="mb-4">
                            <label for="nip_kepsek" class="block text-sm font-medium text-gray-700">NIP Kepsek</label>
                            <input type="text" id="nip_kepsek" name="nip_kepsek"
                                value="{{ $sekolah->nip_kepsek }}"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="mb-4">
                            <label for="logo_sekolah" class="block text-sm font-medium text-gray-700">Logo
                                Sekolah</label>
                            <input type="file" id="logo_sekolah" name="logo_sekolah"
                                value="{{ $sekolah->logo_sekolah }}"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Simpan</button>
                            <button type="button" id="closeModal"
                                class="ml-2 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600"
                                onclick="window.history.back();">Cancel</button>
                        </div>

                    </form>
                </div>
            </div>
        </main>
        @include('layouts.main.footer')
    </div>



    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- JavaScript to auto-hide the alert after 3 seconds -->
    <script>
        $(document).ready(function() {
            // Set timeout to hide the alert after 3 seconds (3000ms)
            setTimeout(function() {
                $('#success-alert').fadeOut('slow');
            }, 3000); // 3 seconds
        });

        // Hide the alert when cancel button is clicked
        $('#closeModal').on('click', function() {
            $('#success-alert').fadeOut('slow'); // Hide alert
        });
    </script>
</body>
