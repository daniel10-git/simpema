<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Di file Blade lain -->
    <x-tambah-kelas />
    <x-search />

</head>

<body class="bg-gray-100 dark:bg-gray-900 text-white">
    @include('components.navbar')
    <header class="antialiased">

    </header>

    <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar"
        type="button"
        class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd"
                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
            </path>
        </svg>
    </button>

    <div class="flex">
        @include('components.sidebar')

        <div class="container mx-auto p-2">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">

                <!-- Start block -->
                <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 antialiased">
                    <div class="p-2 mb-2">
                        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                            <div
                                class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-4 md:space-x-4 p-4">
                                <div class="flex-1 flex items-center space-x-2">
                                    <h5>
                                        <span class="text-blue-600 font-bold">Data Kelas</span>
                                    </h5>
                                </div>

                                <div class="w-full md:w-1/2">
                                </div>
                                <div class="relative m-2">
                                    <button id="tambah-dosenwaliModalButton" data-modal-target="tambah-dosenwali"
                                        data-modal-toggle="tambah-dosenwali"
                                        class="flex items-center text-blue-800 hover:text-white border border-white-400  hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-800 font-medium rounded-lg text-sm px-3 py-2 text-center dark:border-yellow-4400 dark:text-white-400 dark:hover:text-blue dark:hover:bg-blue-800 dark:focus:ring-blue-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-7 -ml-0.5"
                                            viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path
                                                d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                            <path fill-rule="evenodd"
                                                d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Tetapkan Dosen Wali
                                    </button>
                                </div>
                                <div class="relative m-2">
                                    <button id="tambah-mahasiswaModalButton" data-modal-target="tambah-mahasiswa"
                                        data-modal-toggle="tambah-mahasiswa"
                                        class="flex items-center text-blue-800 hover:text-white border border-white-400  hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-800 font-medium rounded-lg text-sm px-3 py-2 text-center dark:border-yellow-4400 dark:text-white-400 dark:hover:text-blue dark:hover:bg-blue-800 dark:focus:ring-blue-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-7 -ml-0.5"
                                            viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path
                                                d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                            <path fill-rule="evenodd"
                                                d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Tetapkan Mahasiswa
                                    </button>
                                </div>
                            </div>

                            @include('components.tambah-dosenwali')
                            @include('components.tambah-mahasiswa')

                            @foreach ($kelas as $k)
                                <section class="bg-gray-50 dark:bg-gray-900 p-1 sm:p-2 antialiased">
                                    <div class="p-4 mb-4">
                                        <div
                                            class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                                            <div
                                                class="flex flex-col md:flex-row md:items-start md:justify-between space-y-4 md:space-y-0 md:space-x-6 p-4">
                                                <div class="flex-1 flex flex-col items-start space-y-3">
                                         
                                                    
                                                    <div class="flex-1 flex items-center space-x-3">
                                                        <h5>
                                                            <span
                                                                class="text-blue-500 font-bold">{{ $k->nama }}</span>
                                                        </h5>
                                                    </div>
                                                    <div class="w-full md:w-1/1 mb-5">
                                                        <form class="flex items-center">
                                                            <label for="simple-search" class="sr-only">Search</label>
                                                            <div class="relative w-full">
                                                                <div
                                                                    class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                    <svg aria-hidden="true"
                                                                        class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                                        fill="currentColor" viewbox="0 0 20 20"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                    </svg>
                                                                </div>
                                                                
                                                         
                                                        </form>
                                                        <div class="flex-1 flex items-center space-x-2">
                                                            <h5>
                                                                <span class="text-blue-400 font-bold">Dosen Wali</span>
                                                            </h5>
                                                        </div>
                                                    </div>

                                                    <div class="w-full md:w-1/1 mb-5">
                                                        <div id="filterDropdown"
                                                            class="z-10 hidden px-3 pt-1 bg-white rounded-lg shadow w-80 dark:bg-gray-700 right-0">
                                                            <div class="flex items-center justify-between pt-2">
                                                            </div>
                                                            <div class="pt-3 pb-2">
                                                                <label for="input-group-search"
                                                                    class="sr-only">Search</label>
                                                                <div class="relative">
                                                                    <div
                                                                        class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400"
                                                                            aria-hidden="true" fill="currentColor"
                                                                            viewbox="0 0 20 20"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path fill-rule="evenodd"
                                                                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                                                clip-rule="evenodd" />
                                                                        </svg>
                                                                    </div>
                                                                    <input type="text" id="input-group-search"
                                                                        class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                                        placeholder="Search keywords...">
                                                                </div>
                                                            </div>

                                                            <div class="w-full md:w-1/1 mb-5">
                                                                <!-- Konten lain atau biarkan kosong jika tidak diperlukan -->
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div
                                                        class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between mx-4 py-4 border-t dark:border-gray-700">

                                                        <div
                                                            class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                                                            <div id="filterDropdown"
                                                                class="z-10 hidden px-3 pt-1 bg-white rounded-lg shadow w-80 dark:bg-gray-700 right-0">
                                                                <div class="flex items-center justify-between pt-2">
                                                                </div>
                                                                <div class="pt-3 pb-2">
                                                                  
                                                                    <div class="relative">
                                                                        <div
                                                                            class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                                                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400"
                                                                                aria-hidden="true" fill="currentColor"
                                                                                viewbox="0 0 20 20"
                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                <path fill-rule="evenodd"
                                                                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                                                    clip-rule="evenodd" />
                                                                            </svg>
                                                                        </div>
                                                                        <input type="text" id="input-group-search"
                                                                            class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                                            placeholder="Search keywords...">
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="flex items-center space-x-3 w-full md:w-auto">
                                                                <div id="actionsDropdown"
                                                                    class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                                                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                                                        aria-labelledby="actionsDropdownButton">
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="overflow-x-auto">
                                                        <table
                                                            class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                                            <thead
                                                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                                                <tr>
                                                                    <th scope="col" class="p-4">

                                                                    </th>
                                                                    <th scope="col" class="p-4">Dosen ID</th>
                                                                    <th scope="col" class="p-4">User ID</th>
                                                                    <th scope="col" class="p-4">Kelas ID</th>
                                                                    <th scope="col" class="p-4">Kode Dosen</th>
                                                                    <th scope="col" class="p-4">NIP</th>
                                                                    <th scope="col" class="p-4">Nama Dosen</th>
                                                                    <th scope="col" class="p-4">Action</th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                                @foreach ($dosenByKelas[$k->id] as $dosen)
                                                                    <tr
                                                                        class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                                        <td class="p-4 w-4">

                                                                        </td>
                                                                        <td
                                                                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                            <div class="flex items-center">
                                                                                {{ $dosen->id }}
                                                                            </div>
                                                                        </td>
                                                                        <td
                                                                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                            <div class="flex items-center">
                                                                                {{ $dosen->id_user }}
                                                                            </div>
                                                                        </td>
                                                                        <td
                                                                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                            <div class="flex items-center">
                                                                                {{ $dosen->kelas_id }}
                                                                            </div>
                                                                        </td>
                                                                        <td
                                                                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                            <div class="flex items-center">
                                                                                {{ $dosen->kode_dosen }}
                                                                            </div>
                                                                        </td>
                                                                        <th scope="row"
                                                                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                            <div class="flex items-center mr-3">
                                                                                {{ $dosen->nip }}
                                                                            </div>
                                                                        </th>
                                                                        <th scope="row"
                                                                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                            <div class="flex items-center mr-3">
                                                                                {{ $dosen->nama }}
                                                                            </div>
                                                                        </th>
                                                                        <td
                                                                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                            <div class="flex items-center space-x-4">


                                                                                <button type="button"
                                                                                    data-modal-target="keluarkandosen{{ $dosen->id }}"
                                                                                    data-modal-toggle="keluarkandosen{{ $dosen->id }}"
                                                                                    class="flex items-center text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                                        class="h-4 w-4 mr-2 -ml-0.5"
                                                                                        viewbox="0 0 20 20"
                                                                                        fill="currentColor"
                                                                                        aria-hidden="true">
                                                                                        <path fill-rule="evenodd"
                                                                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                                                            clip-rule="evenodd" />
                                                                                    </svg>
                                                                                    Keluarkan
                                                                                </button>
                                                                                @include('components.keluarkan')
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <div
                                                        class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                                                        <section
                                                            class="bg-gray-50 dark:bg-gray-900 p-1 sm:p-2 antialiased">
                                                            <div class="p-19.5 mb-4">

                                                                <div
                                                                    class="flex flex-col md:flex-row md:items-start md:justify-between space-y-0 md:space-y-0 md:space-x-12 p-4 mb-5">


                                                                    <div class="w-full md:w-1/1 mb-5">
                                                                        <form class="flex items-center">
                                                                          
                                                                            <div class="relative w-full">
                                                                                <div
                                                                                    class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                                                    <svg aria-hidden="true"
                                                                                        class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                                                        fill="currentColor"
                                                                                        viewbox="0 0 20 20"
                                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                                        
                                                                                    </svg>
                                                                                </div>

                                                                        </form>
                                                                            <div class="flex-1 flex items-center space-x-2">
                                                                                <h5>
                                                                                    <span class="text-blue-400 font-bold">Mahasiswa</span>
                                                                                </h5>
                                                                            </div>
                                                                        </div>
                                                     

                                                                    <div class="w-full md:w-1/1 mb-5">
                                                                        <div id="filterDropdown"
                                                                            class="z-10 hidden px-3 pt-1 bg-white rounded-lg shadow w-80 dark:bg-gray-700 right-0">
                                                                            <div
                                                                                class="flex items-center justify-between pt-2">
                                                                            </div>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between mx-4 py-4 border-t dark:border-gray-700">

                                                                        <div
                                                                            class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                                                                            <div id="filterDropdown"
                                                                                class="z-10 hidden px-3 pt-1 bg-white rounded-lg shadow w-80 dark:bg-gray-700 right-0">
                                                                                <div
                                                                                    class="flex items-center justify-between pt-2">
                                                                                </div>
                                                                                

                                                                            </div>
                                                                            <div
                                                                                class="flex items-center space-x-3 w-full md:w-auto">
                                                                                <div id="actionsDropdown"
                                                                                    class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                                                                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                                                                        aria-labelledby="actionsDropdownButton">
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="overflow-x-auto">
                                                                        <table
                                                                            class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                                                            <thead
                                                                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                                                                <tr>
                                                                                    <th scope="col" class="p-4">

                                                                                    </th>
                                                                                    <th scope="col" class="p-4">
                                                                                        Mahasiswa ID</th>
                                                                                    <th scope="col" class="p-4">
                                                                                        User ID</th>
                                                                                    <th scope="col" class="p-4">
                                                                                        Kelas ID</th>
                                                                                    <th scope="col" class="p-4">
                                                                                        NIM</th>
                                                                                    <th scope="col" class="p-4">
                                                                                        Nama Mahasiswa</th>
                                                                                    <th scope="col" class="p-4">
                                                                                        Tempat Lahir</th>
                                                                                    <th scope="col" class="p-4">
                                                                                        Tanggal Lahir</th>
                                                                                    <th scope="col" class="p-4">
                                                                                        Action</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach ($mahasiswaByKelas[$k->id] as $mahasiswa)
                                                                                    <tr
                                                                                        class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                                                        <td class="p-4 w-4">

                                                                                        </td>
                                                                                        <td
                                                                                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                                            <div
                                                                                                class="flex items-center">
                                                                                                {{ $mahasiswa->id }}
                                                                                            </div>
                                                                                        </td>
                                                                                        <td
                                                                                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                                            <div
                                                                                                class="flex items-center">
                                                                                                {{ $mahasiswa->id_user }}
                                                                                            </div>
                                                                                        </td>
                                                                                        <td
                                                                                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                                            <div
                                                                                                class="flex items-center">
                                                                                                {{ $mahasiswa->kelas_id }}
                                                                                            </div>
                                                                                        </td>
                                                                                        <td
                                                                                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                                            <div
                                                                                                class="flex items-center">
                                                                                                {{ $mahasiswa->nim }}
                                                                                            </div>
                                                                                        </td>
                                                                                        <td
                                                                                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                                            <div
                                                                                                class="flex items-center">
                                                                                                {{ $mahasiswa->nama }}
                                                                                            </div>
                                                                                        </td>
                                                                                        <td
                                                                                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                                            <div
                                                                                                class="flex items-center">
                                                                                                {{ $mahasiswa->tempat_lahir }}
                                                                                            </div>
                                                                                        </td>
                                                                                        <td
                                                                                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                                            <div
                                                                                                class="flex items-center">
                                                                                                {{ $mahasiswa->tanggal_lahir }}
                                                                                            </div>
                                                                                        </td>

                                                                                        <td
                                                                                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                                            <div
                                                                                                class="flex items-center space-x-4">

                                                                                            </div>

                                                                                            <button type="button"
                                                                                                data-modal-target="keluarkan-mahasiswa{{ $mahasiswa->id }}"
                                                                                                data-modal-toggle="keluarkan-mahasiswa{{ $mahasiswa->id }}"
                                                                                                class="flex items-center text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                    class="h-4 w-4 mr-2 -ml-0.5"
                                                                                                    viewbox="0 0 20 20"
                                                                                                    fill="currentColor"
                                                                                                    aria-hidden="true">
                                                                                                    <path
                                                                                                        fill-rule="evenodd"
                                                                                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                                                                        clip-rule="evenodd" />
                                                                                                </svg>
                                                                                                Keluarkan
                                                                                            </button>
                                                                                            @include('components.keluarkan-mahasiswa')
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </section>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        </div>
                </section>
                @endforeach
            </div>
        </div>
        </section>
    </div>
    </div>

    <!-- End block -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>
</body>
@include('footer')

</html>
