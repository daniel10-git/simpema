<head>
    @include('navbar')
</head>
<aside id="logo-sidebar"
    class="fixed left-0 z-40 w-64 h-screen transition-transform-translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidebar">
    <div class="h-full top-0 px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            <li>
                <a href="{{ route('dosen.show', ['id' => Auth::user()->id]) }}"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a1 1 0 0 0-1 1v1H5a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h4v1a1 1 0 0 0 2 0v-1h4a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1h-4V3a1 1 0 0 0-1-1Z" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dosen.mahasiswa') }}"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M7 2a5 5 0 0 0-5 5v6a5 5 0 0 0 5 5h6a5 5 0 0 0 5-5V7a5 5 0 0 0-5-5H7zm0 2h6a3 3 0 0 1 3 3v6a3 3 0 0 1-3 3H7a3 3 0 0 1-3-3V7a3 3 0 0 1 3-3z" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Daftar Mahasiswa</span>
                </a>
            </li>

            @php
                $user = Auth::user();
                $dosen = App\Models\Dosen::where('id_user', $user->id)->first();
            @endphp

            @if ($dosen && $dosen->kelas_id)
                <li>
                    <a href="{{ route('dosen.show2') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path d="M5 4h10a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Request Mahasiswa</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</aside>

@include('footer')
