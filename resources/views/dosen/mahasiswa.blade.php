<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sipema</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-white">
    <!-- Sidebar -->
    @include('sidebardosen')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Daftar Mahasiswa') }}
        </h2>
    </x-slot>

    <!-- Main Content -->
    <div class="ml-60 p-2">
        <div class="py-8 px-8 text-gray-100">
            <div class="max-w-full mx-auto sm:px-6 lg:px-4">
                <div class="bg-gray-800 dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                    <div class="p-6">
                        <h1 class="text-3xl font-extrabold mb-4 text-indigo-100">Daftar Mahasiswa</h1>

                        <!-- Add Search Form -->
                        <div
                            class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between mx-4 py-4 border-t dark:border-gray-700">
                            <form method="GET" action="{{ route('dosen.mahasiswa') }}" class="mb-4">
                                <div class="flex items-center">
                                    <input type="text" name="search" value="{{ $search }}"
                                        placeholder="Search Mahasiswa..."
                                        class="border-gray-700 dark:bg-gray-800 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 w-full">
                                    <button type="submit"
                                        class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                                        Search
                                    </button>
                                </div>
                            </form>
                        </div>

                        <table
                            class="min-w-full divide-y divide-gray-700 dark:divide-gray-700 bg-gray-800 dark:bg-gray-800 shadow-md rounded-lg">
                            <thead class="bg-gray-700 dark:bg-gray-700">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-300 dark:text-gray-300 uppercase tracking-wider">
                                        Nama</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-300 dark:text-gray-300 uppercase tracking-wider">
                                        Kelas</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-300 dark:text-gray-300 uppercase tracking-wider">
                                        NIM</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-300 dark:text-gray-300 uppercase tracking-wider">
                                        Tempat Lahir</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-300 dark:text-gray-300 uppercase tracking-wider">
                                        Tanggal Lahir</th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray-800 dark:bg-gray-800 divide-y divide-gray-700 dark:divide-gray-700">
                                @foreach ($mahasiswa as $m)
                                    <tr>
                                        <td class="px-6 py-4 text-gray-100 dark:text-gray-100 whitespace-nowrap">
                                            {{ $m->nama }}</td>
                                        <td class="px-6 py-4 text-gray-100 dark:text-gray-100 whitespace-nowrap">
                                            {{ $m->kelas ? $m->kelas->nama : 'Belum Ditempatkan' }}</td>
                                        <td class="px-6 py-4 text-gray-100 dark:text-gray-100 whitespace-nowrap">
                                            {{ $m->nim }}</td>
                                        <td class="px-6 py-4 text-gray-100 dark:text-gray-100 whitespace-nowrap">
                                            {{ $m->tempat_lahir }}</td>
                                        <td class="px-6 py-4 text-gray-100 dark:text-gray-100 whitespace-nowrap">
                                            {{ $m->tanggal_lahir }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>
