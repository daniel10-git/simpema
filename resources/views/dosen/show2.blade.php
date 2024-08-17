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

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dosen Wali') }}
        </h2>
    </x-slot>

    <div class="ml-60 p-2">
        <div class="py-8 px-8 bg-gray-100 dark:bg-gray-900">
            <div class="max-w-full mx-auto sm:px-6 lg:px-4">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h2 class="text-2xl font-bold mb-4 text-center">Request Edit</h2>
                        @if (session('success'))
                            <div id="successMessage" class="bg-green-500 text-white font-bold rounded-lg p-4 mb-4">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div id="errorMessage" class="bg-red-500 text-white font-bold rounded-lg p-4 mb-4">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="overflow-x-auto">
                            <table
                                class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-800 shadow-md rounded-lg">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Nama Mahasiswa</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Kelas</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Keterangan</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Tanggal Permintaan</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($editRequests as $request)
                                        <tr>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                {{ $request->mahasiswa->nama }}</td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                {{ $request->kelas->nama }}</td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                {{ $request->keterangan }}</td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                {{ $request->created_at->format('d M Y') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                <form action="{{ route('dosen.approveEditRequest', $request->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('POST')
                                                    <input type="hidden" name="status" value="approved">
                                                    <button type="submit"
                                                        class="text-green-500 hover:text-green-700 mx-2">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>
                                                <!-- Trigger button for delete modal -->
                                                <button type="button" class="text-red-500 hover:text-red-700 mx-2"
                                                    data-modal-toggle="delete-modal-{{ $request->id }}">
                                                    <i class="fas fa-times"></i>
                                                </button>

                                                <!-- Delete Modal -->
                                                <!-- Delete Modal -->
                                                <div id="delete-modal-{{ $request->id }}" tabindex="-1"
                                                    class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                                                    <div
                                                        class="relative w-full h-auto max-w-md max-h-full bg-white dark:bg-gray-700 rounded-lg shadow">
                                                        <button type="button"
                                                            class="absolute top-3 right-3 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                                                            data-modal-toggle="delete-modal-{{ $request->id }}">
                                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd"
                                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                            <span class="sr-only">Close modal</span>
                                                        </button>
                                                        <div class="p-6 text-center">
                                                            <svg aria-hidden="true"
                                                                class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200"
                                                                fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                            <h3
                                                                class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                                                                Apakah kamu yakin ingin menolak permintaan ini?
                                                            </h3>

                                                            <!-- Form for Deletion -->
                                                            <form
                                                                action="{{ route('request.edit.destroy', ['id' => $request->id]) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                                    Ya, saya yakin
                                                                </button>
                                                                <button type="button"
                                                                    data-modal-toggle="delete-modal-{{ $request->id }}"
                                                                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                                    Tidak
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
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
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Open modal
            document.querySelectorAll('[data-modal-toggle]').forEach(button => {
                button.addEventListener('click', function() {
                    const modalId = this.getAttribute('data-modal-toggle');
                    document.getElementById(modalId).classList.remove('hidden');
                });
            });

            // Close modal when clicking outside or on close button
            document.querySelectorAll('[data-modal-toggle]').forEach(button => {
                const modalId = button.getAttribute('data-modal-toggle');
                const modal = document.getElementById(modalId);

                button.addEventListener('click', function(event) {
                    if (event.target === button) {
                        modal.classList.add('hidden');
                    }
                });

                const closeButton = modal.querySelector('button[data-modal-toggle]');
                closeButton.addEventListener('click', function() {
                    modal.classList.add('hidden');
                });
            });
        });
    </script>
</body>

</html>
