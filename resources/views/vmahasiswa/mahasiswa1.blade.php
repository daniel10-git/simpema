<!DOCTYPE html>
<html lang="en">

<head>
    @include('header')

    <style>
        /* Additional Styles */
        .card {
            transition: transform 0.3s ease-in-out;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .btn {
            transition: background-color 0.3s ease;
        }
        
        .btn:hover {
            background-color: #4f8eff;
        }
    </style>
</head>

<body class="bg-gradient-to-r from-blue-50 via-blue-100 to-blue-200">
    @include('navbar')

    <div class="flex min-h-screen">
        <!-- Title Section -->
        <div class="flex-1 p-4 overflow-y-auto pt-1">
            <div class="flex justify-center my-6">
                <h2 class="text-2xl font-bold text-gray-700">Data Mahasiswa</h2>
            </div>

            @foreach ($mahasiswa as $mhs)
                <!-- Profile Section -->
                <div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-6 mb-4 card">
                    <div class="flex flex-col justify-between h-full">
                        <div>
                            <div class="flex items-center mb-6">
                                <div class="ml-6">
                                    <!-- Displaying Mahasiswa Information -->
                                    <h3 class="text-xl font-semibold text-gray-800">{{ $mhs->nama }}</h3>
                                    <p class="text-gray-600">NIM: {{ $mhs->nim }}</p>
                                    @if ($mhs->kelas_id != null)
                                        <p class="text-gray-600">Kelas: {{ $mhs->kelas->nama }}</p>
                                    @else
                                        <p class="text-gray-600">Kelas: -</p>
                                    @endif
                                    <p class="text-gray-600">Tempat Lahir: {{ $mhs->tempat_lahir }}</p>
                                    <p class="text-gray-600">Tanggal Lahir: {{ $mhs->tanggal_lahir }}</p>
                                </div>
                            </div>
                        </div>
                        @if ($mhs->kelas_id)
                            @if (!$requestEditExists)
                                <div class="mt-auto flex justify-end">
                                    @if ($mhs->edit == '0')
                                        <form action="{{ route('minta.akses') }}" method="get">
                                            <input type="hidden" name="id" value="{{ $mhs->id }}">
                                            <button id="defaultModalButton" data-modal-target="defaultModal"
                                                data-modal-toggle="defaultModal"
                                                class="text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                                type="button">
                                                Request Edit
                                            </button>
                                        </form>
                                    @elseif ($mhs->edit == '1')
                                        <form action="{{ route('edit.data') }}" method="get">
                                            <input type="hidden" name="id" value="{{ $mhs->id }}">
                                            <button id="updateProductButton" data-modal-target="updateProductModal"
                                                data-modal-toggle="updateProductModal"
                                                class="bg-yellow-300 text-white ml-1 px-3 py-1 rounded-md hover:bg-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-300"
                                                type="button">
                                                Edit
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            @endif
                        @else
                            <div class="mt-auto">
                                <p class="text-red-600 font-medium">Jika terjadi kesalahan data, Anda dapat meminta
                                    akses edit setelah mendapat kelas.</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
            @if ($requestEditExists)
                <div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-6 mb-4 border border-gray-200">
                    <div class="flex flex-col justify-between h-full">
                        <div class="mt-auto">
                            <p class="text-lg font-semibold text-gray-800 mb-4">Permohonan Akses Edit</p>
                            <p class="text-gray-600 mb-4">Anda sedang meminta akses edit. Silakan tunggu informasi
                                selanjutnya.</p>
                            <ul class="list-disc list-inside text-gray-700">
                                <li class="mb-2"><span class="font-medium text-blue-600">Request Edit</span>:
                                    Jika tombol berubah menjadi 'Request Edit', maka akses Anda ditolak.</li>
                                <li><span class="font-medium text-yellow-300">Edit</span>: Jika tombol berubah
                                    menjadi 'Edit', maka permintaan Anda diterima.</li>
                            </ul>
                            <p class="mt-4 text-red-600 font-medium">Harap diperhatikan bahwa Anda hanya dapat melakukan
                                edit sekali.</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    @include('vmahasiswa.editMahasiswa')
    @include('vmahasiswa.requestedit')
    @include('footer')
</body>

</html>