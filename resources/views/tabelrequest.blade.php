<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Request Table</title>
    @vite('resources/css/app.css') <!-- Include Tailwind CSS or your preferred styling -->
</head>

<body class="bg-gray-100 p-4">
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Request Edit Table</h1>
        <table class="min-w-full bg-white border border-gray-200 rounded-md shadow-md">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="py-2 px-4 border-b">ID</th>
                    <th class="py-2 px-4 border-b">Nama</th>
                    <th class="py-2 px-4 border-b">Kelas</th>
                    <th class="py-2 px-4 border-b">Keterangan</th>
                    <th class="py-2 px-4 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($requestEdit as $a)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $a->id }}</td>
                        <td class="py-2 px-4 border-b">{{ $a->mahasiswa->nama }}</td>
                        <td class="py-2 px-4 border-b">{{ $a->kelas->nama }}</td>
                        <td class="py-2 px-4 border-b">{{ $a->keterangan }}</td>
                        <td class="py-2 px-4 border-b">
                            <form action="{{ route('update.request') }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="id" value="{{ $a->mahasiswa->id }}">
                                <input type="hidden" name="edit" value="1">
                                <button type="submit"
                                    class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">Terima</button>
                            </form>

                            <form action="{{ route('update.request') }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="id" value="{{ $a->mahasiswa->id }}">
                                <input type="hidden" name="edit" value="0">
                                <button type="submit"
                                    class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Tolak</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
