<!DOCTYPE html>
<html lang="en">

<head>
    @include('header')
</head>

<body>
    <!-- Main modal -->
    <div id="updateProductModal" tabindex="-1" aria-hidden="true"
        class="fixed inset-0 z-50 hidden items-center justify-center w-full h-full overflow-y-auto">
        <div class="relative p-4 w-full max-w-4xl h-auto rounded-lg shadow">
            <!-- Modal content -->
            <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <!-- Modal header -->
                <div class="flex justify-between items-center pb-4 mb-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Edit Data {{ Auth::user()->name }}
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="updateProductModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                @if ($mahasiswa->isNotEmpty())
                    @php $mahasiswaItem = $mahasiswa->first(); @endphp
                    <form action="{{ route('update.data') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="id" value="{{ $mahasiswaItem->id }}" />
                        <input type="hidden" name="id_user" value="{{ $mahasiswaItem->id_user }}" />
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- kolom kiri --}}
                            <div>
                                <div class="mb-6">
                                    <label for="name"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                                    <input type="text" id="name" name="name"
                                        value="{{ $mahasiswaItem->user->name }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                                </div>
                                <div class="mb-6">
                                    <label for="password"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                    <input type="password" id="password" name="password"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                                    <p class="text-gray-500 text-xs mt-1">Kosongkan jika tidak ingin mengubah password
                                    </p>

                                </div>
                                <div class="mb-6">
                                    <label for="email"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                    <input type="email" id="email" name="email"
                                        value="{{ $mahasiswaItem->user->email }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                                </div>
                            </div>

                            {{-- Kolom kanan --}}
                            <div>
                                <div class="mb-6">
                                    <label for="nim"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIM</label>
                                    <input type="number" id="nim" name="nim"
                                        value="{{ $mahasiswaItem->nim }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                                </div>
                                <div class="mb-6">
                                    <label for="nama"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                                    <input type="text" id="nama" name="nama"
                                        value="{{ $mahasiswaItem->nama }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                                </div>
                                <div class="mb-6">
                                    <label for="tanggal_lahir"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal
                                        Lahir</label>
                                    <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                                        value="{{ $mahasiswaItem->tanggal_lahir }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                                </div>
                                <div class="mb-6">
                                    <label for="tempat_lahir"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tempat
                                        Lahir</label>
                                    <input type="text" id="tempat_lahir" name="tempat_lahir"
                                        value="{{ $mahasiswaItem->tempat_lahir }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="edit" name="edit" value="0" />
                        <div class="flex justify-end mt-6 space-x-4">
                            <!-- Save Button -->
                            <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                SIMPAN
                            </button>

                            <!-- Back Button -->
                            <a href="{{ route('tampil.mahasiswa') }}" class="ml-4">
                                <button type="button"
                                    class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                                    Kembali
                                </button>
                            </a>
                        </div>
                    </form>
                @else
                    <p>Data mahasiswa tidak ditemukan.</p>
                @endif
            </div>
        </div>
    </div>



    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var updateButton = document.getElementById('updateProductButton');
            var modal = document.getElementById('updateProductModal');

            if (updateButton) {
                updateButton.addEventListener('click', function() {
                    modal.classList.toggle('hidden');
                });
            }

            var closeButton = modal.querySelector('[data-modal-toggle="updateProductModal"]');
            if (closeButton) {
                closeButton.addEventListener('click', function() {
                    modal.classList.add('hidden');
                });
            }
        });
    </script>

    @include('footer')
</body>

</html>
