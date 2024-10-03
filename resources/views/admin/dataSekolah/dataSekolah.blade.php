<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    @include('layouts.main.navbar')
    @include('layouts.sidebar.admin')

    <!-- Alert Success -->
    @if (session('success'))
        <div id="success-alert" class="bg-green-500 text-white p-4 rounded-lg absolute top-10 left-0 right-0 mx-auto z-50"
            style="max-width: 800px;">
            {{ session('success') }}
        </div>
    @endif


    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-6">Data Sekolah</h1>
                <ol class="breadcrumb mb-6">
                    <li class="breadcrumb-item active">SMAN 01 Tegal</li>
                </ol>
                <div class="flex justify-end mb-2 mr-8">
                    <a href="{{ route('sekolah.edit', ['id' => $sekolah[0]->id]) }}"
                        class="bg-gray-500 text-white px-2 py-2 rounded hover:bg-gray-600">
                        <i class="fa-solid fa-pen-to-square mr-2"></i>Perbarui Data Sekolah
                    </a>
                </div>

                <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach ($sekolah as $s)
                            <div class="flex flex-col items-center bg-gray-100 p-4 rounded-md">
                                <img src="{{ asset('storage/' . $s->logo_sekolah) }}" alt="logo_sekolah"
                                    class="w-30 h-30 object-contain">

                                <h3 class="text-xl font-bold mt-4">{{ $s->nama_sekolah }}</h3>
                                <p class="text-gray-600">2024/2025</p>
                            </div>

                            <table class="table-auto w-full">
                                <tbody>
                                    <tr class="border-b">
                                        <td class="py-2 font-bold">Nama Sekolah</td>
                                        <td class="py-2">: {{ $s->nama_sekolah }}</td>
                                    </tr>
                                    <tr class="border-b">
                                        <td class="py-2 font-bold">NPSN</td>
                                        <td class="py-2">: {{ $s->npsn }}</td>
                                    </tr>
                                    <tr class="border-b">
                                        <td class="py-2 font-bold">Jalan</td>
                                        <td class="py-2">: {{ $s->jalan }}</td>
                                    </tr>
                                    <tr class="border-b">
                                        <td class="py-2 font-bold">Desa/Kelurahan</td>
                                        <td class="py-2">: {{ $s->desa_kelurahan }}</td>
                                    </tr>
                                    <tr class="border-b">
                                        <td class="py-2 font-bold">Kecamatan</td>
                                        <td class="py-2">: {{ $s->kecamatan }}</td>
                                    </tr>
                                    <tr class="border-b">
                                        <td class="py-2 font-bold">Kab/Kota</td>
                                        <td class="py-2">: {{ $s->kabupaten }}</td>
                                    </tr>
                                    <tr class="border-b">
                                        <td class="py-2 font-bold">Provinsi</td>
                                        <td class="py-2">: {{ $s->provinsi }}</td>
                                    </tr>
                                    <tr class="border-b">
                                        <td class="py-2 font-bold">Kode Pos</td>
                                        <td class="py-2">: {{ $s->kode_pos }}</td>
                                    </tr>
                                    <tr class="border-b">
                                        <td class="py-2 font-bold">No Telepon</td>
                                        <td class="py-2">: {{ $s->no_telp }}</td>
                                    </tr>
                                    <tr class="border-b">
                                        <td class="py-2 font-bold">Email</td>
                                        <td class="py-2">: {{ $s->email }}</td>
                                    </tr>
                                    <tr class="border-b">
                                        <td class="py-2 font-bold">Website</td>
                                        <td class="py-2">: <a href="#"
                                                class="text-blue-600">{{ $s->website }}</a></td>
                                    </tr>
                                    <tr class="border-b">
                                        <td class="py-2 font-bold">Kepala Sekolah</td>
                                        <td class="py-2">: {{ $s->kepala_sekolah }}</td>
                                    </tr>
                                    <tr class="border-b">
                                        <td class="py-2 font-bold">NIP Kepsek</td>
                                        <td class="py-2">: {{ $s->nip_kepsek }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        @endforeach
                    </div>
                </div>

            </div>
            @include('layouts.main.footer')
        </main>
    </div>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- JavaScript to auto-hide the alert after 3 seconds -->
    <script>
        $(document).ready(function() {
            if ($('#success-alert').length) {
                setTimeout(function() {
                    $('#success-alert').fadeOut('slow');
                }, 3000); // 3 seconds
            }
        });
    </script>
</body>
