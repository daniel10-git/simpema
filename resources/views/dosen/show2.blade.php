<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-white">
    <!-- Sidebar -->
    @include('sidebardosen')

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Dosen Wali') }}
    </h2>
</x-slot>

{{-- @include('sidebardosen') --}}

<div class="py-12 px-8">
    <div class="max-w-full mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h2 class="text-2xl font-bold mb-4 text-center">Request Edit</h2>
                
                <div class="flex justify-center">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-800 shadow-md rounded-lg">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nama Mahasiswa</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Kelas</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Keterangan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tanggal Permintaan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($editRequests as $request)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $request->mahasiswa->nama }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $request->kelas->nama }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $request->keterangan }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $request->created_at->format('d M Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <form action="{{ route('dosen.approveEditRequest', $request->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('POST')
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit" class="text-green-500 hover:text-green-700 mx-2">
                                                <i class="fas fa-check"></i> <!-- Approve Icon -->
                                            </button>
                                        </form>
                                        <form action="{{ route('request.edit.destroy', ['id' => $request->id]) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to reject this request?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 mx-2">
                                                <i class="fas fa-times"></i> <!-- Reject Icon -->
                                            </button>
                                        </form>
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
