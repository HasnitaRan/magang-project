<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    @include('layouts.main.navbar')
    @include('layouts.sidebar.admin')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <h1 class="mt-6">Data Sekolah</h1>
                <ol class="breadcrumb mb-6">
                    <li class="breadcrumb-item active">SMAN 01 Tegal</li>
                </ol>
                <div class="flex justify-end mb-2 mr-8">
                    <a href="#" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Perbarui Data Sekolah
                    </a>
                </div>
                
                <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($sekolah as $s)
                        <div class="flex flex-col items-center bg-gray-100 p-4 rounded-md">
                            <img src="{{ asset('image/school.png') }}" alt="logo_sekolah" class="w-30 h-30 object-contain">


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
                                    <td class="py-2">: <a href="#" class="text-blue-600">{{ $s->website }}</a></td>
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
                    @include('layouts.main.footer')
                </div>
            </div>
        </main>
    </div>
</body>

