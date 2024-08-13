        <head>
        @vite('resources/css/app.css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    </head>
    <body class="bg-gray-100 dark:bg-gray-900 text-white">
        <!-- Sidebar -->
        @include('sidebardosen')
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Mahasiswa') }}
        </h2>
    </x-slot>
    {{-- @include('sidebardosen') --}}
    <div class="py-4 px-8 bg-gray-100 dark:bg-gray-900">
        <div class="max-w-full mx-auto sm:px-6 lg:px-64">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-800 shadow-md rounded-lg">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Kelas</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">NIM</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tempat Lahir</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tanggal Lahir</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($mahasiswa as $m)
                            <tr>
                                <td class="px-6 py-4 text-gray-900 dark:text-gray-100 whitespace-nowrap">{{ $m->nama }}</td>
                                <td class="px-6 py-4 text-gray-900 dark:text-gray-100 whitespace-nowrap">{{ $m->kelas ? $m->kelas->nama : 'Belum Ditempatkan' }}</td>
                                <td class="px-6 py-4 text-gray-900 dark:text-gray-100 whitespace-nowrap">{{ $m->nim }}</td>
                                <td class="px-6 py-4 text-gray-900 dark:text-gray-100 whitespace-nowrap">{{ $m->tempat_lahir }}</td>
                                <td class="px-6 py-4 text-gray-900 dark:text-gray-100 whitespace-nowrap">{{ $m->tanggal_lahir }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    

