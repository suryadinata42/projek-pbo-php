@extends('layout.menu1')

@section('konten')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Data Mahasiswa</h5>
        <a href="{{ route('cobah.tambahdata') }}" class="btn btn-primary btn-sm">
            + Tambah
        </a>
    </div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-sm table-bordered table-striped table-hover small">
                <thead class="table-light">
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
                    @forelse($mahasiswa as $i => $m)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $m['nim'] ?? '-' }}</td>
                            <td>{{ $m['nama'] ?? '-' }}</td>
                            <td>{{ $m['jenis_kelamin'] ?? '-' }}</td>
                            <td>{{ $m['tanggal_lahir'] ?? '-' }}</td>
                            <td>{{ $m['telpon'] ?? '-' }}</td>
                            <td>{{ $m['prodi'] ?? '-' }}</td>
                            <td>{{ $m['kelas'] ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Belum ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection