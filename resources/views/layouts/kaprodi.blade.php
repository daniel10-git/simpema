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

                                                <!-- Edit Modal -->
                                                <div id="updateProductModal{{ $kaprodi->id }}" tabindex="-1"
                                                    aria-hidden="true"
                                                    class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 bg-black bg-opacity-50 justify-center items-center">
                                                    <div class="relative w-full max-w-2xl max-h-full">
                                                        <form action="{{ route('kaprodi.update') }}" method="POST"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            @method('POST')
                                                            <input type="hidden" name="id"
                                                                value="{{ $kaprodi->id }}">
                                                            <input type="hidden" name="id_user"
                                                                value="{{ $kaprodi->id_user }}">
                                                            <!-- Modal content -->
                                                            <div
                                                                class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                                <!-- Modal header -->
                                                                <div
                                                                    class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                                                    <h3
                                                                        class="text-xl font-semibold text-gray-900 dark:text-white">
                                                                        Edit Data Dosen
                                                                    </h3>
                                                                    <button type="button"
                                                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                                        data-modal-hide="updateProductModal{{ $kaprodi->id }}">
                                                                        <svg aria-hidden="true" class="w-5 h-5"
                                                                            fill="currentColor" viewbox="0 0 20 20"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path fill-rule="evenodd"
                                                                                clip-rule="evenodd"
                                                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" />
                                                                        </svg>
                                                                        <span class="sr-only">Close modal</span>
                                                                    </button>
                                                                </div>

                                                                <!-- Modal body -->
                                                                <div class="p-6 space-y-6">
                                                                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                                                                        <div class="sm:col-span-2">
                                                                            <label for="nama"
                                                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                                                                            <input type="text" name="nama"
                                                                                id="nama"
                                                                                value="{{ $kaprodi->nama }}"
                                                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                                placeholder="Nama Dosen" required="">
                                                                        </div>
                                                                        <div class="w-full">
                                                                            <label for="nip"
                                                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIP</label>
                                                                            <input type="number" name="nip"
                                                                                id="nip"
                                                                                value="{{ $kaprodi->nip }}"
                                                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                                placeholder="NIP" required="">
                                                                        </div>
                                                                        <div class="w-full">
                                                                            <label for="kode_dosen"
                                                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode
                                                                                Dosen</label>
                                                                            <input type="number" name="kode_dosen"
                                                                                id="kode_dosen"
                                                                                value="{{ $kaprodi->kode_dosen }}"
                                                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                                placeholder="Kode Dosen" required="">
                                                                        </div>
                                                                        <div class="w-full">
                                                                            <label for="name"
                                                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                                                                            <input type="text" name="name"
                                                                                id="name"
                                                                                value="{{ $kaprodi->user->name }}"
                                                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                                placeholder="Email" required="">
                                                                        </div>
                                                                        <div class="w-full">
                                                                            <label for="email"
                                                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                                                            <input type="email" name="email"
                                                                                id="email"
                                                                                value="{{ $kaprodi->user->email }}"
                                                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                                placeholder="Email" required="">
                                                                        </div>
                                                                        <div class="w-full">
                                                                            <label for="password"
                                                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                                                            <input type="password" name="password"
                                                                                id="password"
                                                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                                placeholder="Password (Kosongkan jika tidak ingin mengubah)">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Modal footer -->
                                                                <div
                                                                    class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                                    <button type="submit"
                                                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan
                                                                        Perubahan</button>
                                                                    <button type="button"
                                                                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600"
                                                                        data-modal-hide="updateProductModal{{ $kaprodi->id }}">Batal</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
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
