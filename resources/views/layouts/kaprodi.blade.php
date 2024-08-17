<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sipema</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <x-tambah-kaprodi />
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
        <div class="container mx-auto p-4">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <!-- Start block -->
                <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 antialiased">
                    <div class="py-8 px-8 text-gray-900 dark:text-gray-100">
                        <div class="max-w-full mx-auto sm:px-6 lg:px-4">
                            <div
                                class="bg-gradient-to-r from-indigo-100 to-blue-100 dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                                <div class="p-6">
                                    <h1 class="text-3xl font-extrabold mb-4 text-indigo-400 dark:text-indigo-100">Profil
                                        Kaprodi</h1>
                                    @if (session('success'))
                                        <div class="p-4 mb-4 px-4 py-3 font-medium text-gray-900 whitespace-nowrap  dark:bg-gray-700  bg-green-100 rounded-lgdark:bg-green-200 dark:text-green-800"
                                            role="alert">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    <div class="bg-white dark:bg-gray-900 p-4 rounded-lg shadow-md">
                                        <div class="flex items-center mb-4">
                                            <div class="text-gray-900 dark:text-gray-100">
                                                <h1 class="text-2xl font-bold mb-6">{{ $kaprodi->nama }}</h1>
                                                <p class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">
                                                    Email :
                                                    {{ $kaprodi->user->email }}</p>
                                                <p class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">NIP
                                                    :
                                                    {{ $kaprodi->nip }}</p>
                                                <p class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">
                                                    Kode
                                                    Dosen :
                                                    {{ $kaprodi->kode_dosen }}</p>
                                                <button type="button" id="updateProductButton"
                                                    data-modal-target="updateProductModal{{ $kaprodi->id }}"
                                                    data-modal-toggle="updateProductModal{{ $kaprodi->id }}"
                                                    class="block text-white bg-yellow-500 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
                                                    Edit
                                                </button>
                                                @include('components.edit-kaprodi')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var selectElement = document.getElementById('id_user');
                        if (selectElement) {
                            selectElement.addEventListener('change', function() {
                                var selectedOption = this.options[this.selectedIndex];
                                var userName = selectedOption.text;
                                document.getElementById('nama').value = userName;
                            });
                        }
                    });
                </script>
                @include('footer')

</html>
