<head>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-white">
    <!-- Sidebar -->
    @include('sidebardosen')

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Daftar Dosen') }}
    </h2>
</x-slot>
{{-- @include('sidebardosen') --}}
<div class="py-12 px-8 bg-gray-100 dark:bg-gray-900">
    <div class="max-w-full mx-auto sm:px-12 lg:px-64">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <!-- Tabel Dosen -->
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-800 shadow-md rounded-lg">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">NIP</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Kode Dosen</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Kelas ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        <tr>
                            <td class="px-6 py-4 text-gray-900 dark:text-gray-100 whitespace-nowrap">{{ $dosen->nama }}</td>
                            <td class="px-6 py-4 text-gray-900 dark:text-gray-100 whitespace-nowrap">{{ $dosen->nip }}</td>
                            <td class="px-6 py-4 text-gray-900 dark:text-gray-100 whitespace-nowrap">{{ $dosen->kode_dosen }}</td>
                            <td class="px-6 py-4 text-gray-900 dark:text-gray-100 whitespace-nowrap">
                                {{ $dosen->kelas ? $dosen->kelas->nama : '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($dosen->kelas_id != null)
                                <a href="{{ route('dosen.show', $dosen->id) }}" class="text-blue-500 hover:text-blue-700 mx-2">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
