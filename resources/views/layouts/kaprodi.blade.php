<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sipema</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <x-tambah-kaprodi />
    <x-edit-kaprodi />
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
                    <div class="mx-auto max-w-screen-2xl px-4 lg:px-12">
                        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                            <div
                                class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                                <div class="flex-1 flex items-center space-x-2">
                                    <h5>
                                        <span class="text-gray-500">Data Kaprodi</span>
                                    </h5>
                                </div>
                            </div>
                            <div
                                class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between mx-4 py-4 border-t dark:border-gray-700">
                                <div class="w-full md:w-1/2">
                                    <form class="flex items-center">
                 
                                        <div class="relative w-full">
                                            <div
                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                    fill="currentColor" viewbox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    
                                                </svg>
                                            </div>
                                            
                                        </div>
                                    </form>
                                </div>
                                
                                <div
                                    class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                                    <div id="filterDropdown"
                                        class="z-10 hidden px-3 pt-1 bg-white rounded-lg shadow w-80 dark:bg-gray-700 right-0">
                                        <div class="pt-3 pb-2">
                    
                                            <div class="relative">
                                                <div
                                                    class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400"
                                                        aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
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
                                        <div id="accordion-flush" data-accordion="collapse"
                                            data-active-classes="text-black dark:text-white"
                                            data-inactive-classes="text-gray-500 dark:text-gray-400">

                                            <div id="category-body" class="hidden" aria-labelledby="category-heading">
                                                <div
                                                    class="py-2 font-light border-b border-gray-200 dark:border-gray-600">
                                                </div>
                                            </div>

                                            <div id="worldwide-shipping-body" class="hidden"
                                                aria-labelledby="worldwide-shipping-heading">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-3 w-full md:w-auto">
                                    </div>
                                </div>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead
                                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="p-4">
                                                <div class="flex items-center">

                                                </div>
                                            </th>
                                            <th scope="col" class="p-4">Kaprodi ID</th>
                                            <th scope="col" class="p-4">User ID</th>
                                            <th scope="col" class="p-4">Kode Dosen</th>
                                            <th scope="col" class="p-4">NIP</th>
                                            <th scope="col" class="p-4">Nama</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kaprodi as $k)
                                            <tr
                                                class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                <td class="p-4 w-4">

                                                </td>
                                                <td
                                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    <div class="flex items-center">
                                                        {{ $k->id }}
                                                    </div>
                                                </td>
                                                <td
                                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    <div class="flex items-center">
                                                        {{ $k->id_user }}
                                                    </div>
                                                </td>
                                                <td
                                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    <div class="flex items-center">
                                                        {{ $k->kode_dosen }}
                                                    </div>
                                                </td>
                                                <th scope="row"
                                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    <div class="flex items-center mr-3">
                                                        {{ $k->nip }}
                                                    </div>
                                                </th>
                                                <th scope="row"
                                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    <div class="flex items-center mr-3">
                                                        {{ $k->nama }}
                                                    </div>
                                                </th>
                                                
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4"
                                aria-label="Table navigation">
                               
                            </nav>
                        </div>
                    </div>
                </section>
                <!-- End block -->

                </form>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>
                @include('footer')
</html>
