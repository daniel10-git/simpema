<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        .flex-grow {
            flex: 1;
        }
    </style>
</head>

<body class="bg-gray-50 font-sans leading-normal tracking-normal flex flex-col">

    <!-- Navbar -->
    <nav class="bg-blue-200 shadow-md">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between h-16">
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                    <button type="button"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:text-gray-800 hover:bg-blue-300 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500"
                        aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>
                <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="flex items-center space-x-3 rtl:space-x-reverse">
                        <img src="{{ asset('images/logopnc.png') }}" class="h-8" alt="Flowbite Logo" />
                        <span class="self-center text-2xl font-semibold text-gray-800">SIPEMA</span>
                    </div>
                </div>
                <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    @if (Route::has('login'))
                        @auth
                            @if (Auth::user()->role == 'mahasiswa')
                                <a href="{{ route('tampil.mahasiswa') }}"
                                    class="font-semibold text-gray-600 hover:text-gray-800 focus:outline focus:outline-2 focus:rounded-sm focus:outline-blue-500">Dashboard</a>
                            @elseif (Auth::user()->role == 'dosen')
                                <a href="{{ route('dosen.index') }}"
                                    class="font-semibold text-gray-600 hover:text-gray-800 focus:outline focus:outline-2 focus:rounded-sm focus:outline-blue-500">Dashboard</a>
                            @elseif (Auth::user()->role == 'kaprodi')
                                <a href="{{ route('layouts.kelas') }}"
                                    class="font-semibold text-gray-600 hover:text-gray-800 focus:outline focus:outline-2 focus:rounded-sm focus:outline-blue-500">Dashboard</a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}" class="ml-4">
                                @csrf
                                <button type="submit"
                                    class="font-semibold text-gray-600 hover:text-gray-800 focus:outline focus:outline-2 focus:rounded-sm focus:outline-blue-500">Log
                                    out</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}"
                                class="font-semibold text-gray-600 hover:text-gray-800 focus:outline focus:outline-2 focus:rounded-sm focus:outline-blue-500">Log
                                in</a>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="bg-blue-100 text-gray-800 py-16 flex-grow">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-4xl font-extrabold mb-4">Selamat Datang di Sistem Informasi Mahasiswa</h2>
            <p class="text-lg mb-8">Sistem Informasi Mahasiswa (SIPEMA) adalah platform digital yang dirancang untuk
                mempermudah pengelolaan data mahasiswa secara efisien dan terintegrasi. Dengan SIPEMA, mahasiswa dapat
                mengakses informasi akademis mereka, memantau progres studi, serta berinteraksi dengan dosen dan pihak
                administrasi dengan mudah. Sistem ini menyediakan fitur untuk memantau jadwal, nilai, dan informasi
                penting lainnya, sambil memastikan keamanan data dan kemudahan akses melalui antarmuka yang ramah
                pengguna.</p>
        </div>
    </header>

    <!-- Footer -->
    <footer class="bg-blue-100 text-gray-800 py-4">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p>&copy; 2024 Sipema. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>
