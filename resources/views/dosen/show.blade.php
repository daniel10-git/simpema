<!DOCTYPE html>
<html lang="en">

<head>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Sipema</title>
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-white">
    <!-- Sidebar -->
    @include('sidebardosen')

    <!-- Main Content -->
    <div class="ml-60 p-2">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Dosen Wali') }}
            </h2>
        </x-slot>

        <div class="py-8 px-8 text-gray-900 dark:text-gray-100">
            <div class="max-w-full mx-auto sm:px-6 lg:px-4">
                <div
                    class="bg-gradient-to-r from-indigo-100 to-blue-100 dark:bg-gray-700 dark:from-gray-800 dark:to-gray-900 overflow-hidden shadow-lg sm:rounded-lg">
                    <div class="p-6">
                        <h1 class="text-3xl font-extrabold mb-4 text-indigo-400 dark:text-indigo-200">Profil Dosen</h1>

                        <!-- Success/Error Messages -->
                        @if (session('success'))
                            <div id="successMessage" class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div id="errorMessage" class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="bg-white dark:bg-gray-900 p-4 rounded-lg shadow-md">
                            <div class="flex items-center mb-4">
                                <div class="text-gray-900 dark:text-gray-100">
                                    <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-2">
                                        {{ $dosen->nama }}</h2>
                                    <p class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-1">NIP :
                                        {{ $dosen->nip }}</p>
                                    <p class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-1">Kode Dosen :
                                        {{ $dosen->kode_dosen }}</p>
                                    <p class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-4">Wali Kelas :
                                        {{ $dosen->kelas->nama ?? 'Belum Ditentukan' }}</p>
                                    <button type="button" id="updateProductButton"
                                        data-modal-target="updateProductModal{{ $dosen->id }}"
                                        data-modal-toggle="updateProductModal{{ $dosen->id }}"
                                        class="block text-white bg-yellow-500 hover:bg-yellow-700 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-yellow-400 dark:hover:bg-yellow-500 dark:focus:ring-yellow-600">
                                        <i class="fas fa-edit"></i>
                                        Edit
                                    </button>

                                    @include('dosen.editdosen')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($dosen->kelas_id != null)
            <div class="py-4 px-4 bg-gray-100 dark:bg-gray-900">
                <div class="max-w-full mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                                {{ __('Daftar Mahasiswa') }}
                                <br>
                                <br>
                            </h2>
                            <div
                                class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between mx-4 py-4 border-t dark:border-gray-700">
                                <form method="GET" action="{{ route('dosen.show', ['id' => Auth::user()->id]) }}"
                                    class="mb-4">
                                    <div class="flex items-center">
                                        <input type="text" name="search" value="{{ request('search') }}"
                                            placeholder="Search Mahasiswa..."
                                            class="border-gray-300 dark:border-gray-700 dark:bg-gray-800 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 w-full">
                                        <button type="submit"
                                            class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                                            Search
                                        </button>
                                    </div>
                                </form>
                                <div class="flex justify-center m-5">
                                    <button id="defaultModalButton" data-modal-target="defaultModal"
                                        data-modal-toggle="defaultModal"
                                        class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                        type="button">
                                        + Tambah
                                    </button>
                                </div>
                            </div>

                            @include('dosen.create')

                            <table
                                class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-800 shadow-md rounded-lg">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Nama</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Kelas</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            NIM</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Tempat Lahir</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Tanggal Lahir</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($mahasiswa as $m)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $m->nama }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $m->kelas->nama ?? 'Belum Ditentukan' }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $m->nim }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $m->tempat_lahir }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $m->tanggal_lahir }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <!-- Add your actions here -->
                                                <button type="button" id="updateProductButton"
                                                    data-modal-target="updateProductModal{{ $m->id }}"
                                                    data-modal-toggle="updateProductModal{{ $m->id }}"
                                                    class="text-yellow-500 hover:text-yellow-700 mx-2">
                                                    <i class="fas fa-edit"></i>
                                                </button>

                                                @include('dosen.editmhs', ['mahasiswa' => $m])

                                                <!-- Delete Mahasiswa -->
                                                <button type="button"
                                                    data-modal-target="delete-modal-{{ $m->id }}"
                                                    data-modal-toggle="delete-modal-{{ $m->id }}"
                                                    class="text-red-500 hover:text-red-700 mx-2">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>

                                                <!-- Delete Modal -->
                                                <div id="delete-modal-{{ $m->id }}" tabindex="-1"
                                                    class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 bg-black bg-opacity-50 justify-center items-center">
                                                    <div class="relative w-full h-auto max-w-md max-h-full">
                                                        <div
                                                            class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                            <button type="button"
                                                                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                                                                data-modal-toggle="delete-modal-{{ $m->id }}">
                                                                <svg aria-hidden="true" class="w-5 h-5"
                                                                    fill="currentColor" viewbox="0 0 20 20"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path fill-rule="evenodd"
                                                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                        clip-rule="evenodd" />
                                                                </svg>
                                                                <span class="sr-only">Close modal</span>
                                                            </button>
                                                            <div class="p-6 text-center">
                                                                <svg aria-hidden="true"
                                                                    class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200"
                                                                    fill="none" stroke="currentColor"
                                                                    viewbox="0 0 24 24"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                </svg>
                                                                <h3
                                                                    class="mb-5 text-l font-normal text-gray-500 dark:text-gray-400">
                                                                    Apakah kamu yakin ingin mengeluarkan mahasiswa ini?
                                                                </h3>

                                                                <!-- Form for Deletion -->
                                                                <form
                                                                    action="{{ route('dosen.destroy', ['id' => $m->id]) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                                        Ya, saya yakin
                                                                    </button>
                                                                    <button
                                                                        data-modal-toggle="delete-modal-{{ $m->id }}"
                                                                        type="button"
                                                                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                                        Tidak
                                                                    </button>
                                                                </form>
                                                            </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <script>
        // Menghilangkan pesan setelah 3 detik dan memastikan scroll normal
        setTimeout(function() {
            const successMessage = document.getElementById('successMessage');
            const errorMessage = document.getElementById('errorMessage');

            if (successMessage) {
                successMessage.style.display = 'none';
            }

            if (errorMessage) {
                errorMessage.style.display = 'none';
            }

            // Mengaktifkan kembali scroll pada body jika sebelumnya terganggu
            document.body.style.overflow = 'auto';
        }, 3000);
    </script>
</body>

</html>
