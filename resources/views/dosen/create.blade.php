<!-- Tambah Modal -->
<div id="defaultModal" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 bg-black bg-opacity-50 justify-center items-center">
    <div class="relative w-full max-w-2xl max-h-full">
        <form action="{{ route('dosen.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Tambah Data Mahasiswa
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="defaultModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414 1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div>
                            <label for="id_user"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                Mahasiswa</label>

                            <!-- Select All Checkbox -->
                            <div class="flex items-center mb-2">
                                <input type="checkbox" id="select-all"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded focus:ring-primary-600 focus:border-primary-600 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <label for="select-all" class="ml-2 text-sm text-gray-900 dark:text-gray-300">Select
                                    All</label>
                            </div>

                            <!-- Mahasiswa Checkboxes -->
                            @foreach ($mahasiswanull as $m)
                                <div class="flex items-center">
                                    <input type="checkbox" name="mahasiswanull[]" value="{{ $m->id }}"
                                        class="mahasiswa-checkbox bg-gray-50 border border-gray-300 text-gray-900 rounded focus:ring-primary-600 focus:border-primary-600 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <label for="nama_dosen_1"
                                        class="ml-2 text-sm text-gray-900 dark:text-gray-300">{{ $m->nama }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tambah</button>
                    <button type="button"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600"
                        data-modal-hide="defaultModal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    // JavaScript to handle the "Select All" checkbox
    document.getElementById('select-all').addEventListener('click', function(event) {
        let checkboxes = document.querySelectorAll('.mahasiswa-checkbox');
        for (let i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = event.target.checked;
        }
    });
</script>
