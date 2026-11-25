<table>
    <thead>
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Tanggal Lahir</th>
            <th>Telpon</th>
            <th>Prodi</th>
            <th>Kelas</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($data as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item['nim'] ?? '-' }}</td>
                <td>{{ $item['nama'] ?? '-' }}</td>
                <td>{{ $item['jenis_kelamin'] ?? '-' }}</td>
                <td>{{ $item['tanggal_lahir'] ?? '-' }}</td>
                <td>{{ $item['telpon'] ?? '-' }}</td>
                <td>{{ $item['prodi'] ?? '-' }}</td>
                <td>{{ $item['kelas'] ?? '-' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center">
                    Tidak ada data
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
