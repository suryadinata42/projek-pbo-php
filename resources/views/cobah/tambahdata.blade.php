@extends('layout.menu1')
@section('konten')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Tambah Mahasiswa</h5>
        <a href="{{ route('cobah.index') }}" class="btn btn-secondary btn-sm">
            Kembali
        </a>
    </div>

    <div class="card-body">
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('cobah.simpandata') }}">
            @csrf

            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" class="form-control" id="nim" name="nim"
                       value="{{ old('nim') }}" required>
            </div>

            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama"
                       value="{{ old('nama') }}" required>
            </div>

            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="L" @selected(old('jenis_kelamin') == 'L')>L</option>
                    <option value="P" @selected(old('jenis_kelamin') == 'P')>P</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                       value="{{ old('tanggal_lahir') }}" required>
            </div>

            <div class="mb-3">
                <label for="telpon" class="form-label">Telpon</label>
                <input type="text" class="form-control" id="telpon" name="telpon"
                       value="{{ old('telpon') }}" required>
            </div>

            <div class="mb-3">
                <label for="prodi" class="form-label">Prodi</label>
                <input type="text" class="form-control" id="prodi" name="prodi"
                       value="{{ old('prodi') }}" required>
            </div>

            <div class="mb-3">
                <label for="kelas" class="form-label">Kelas</label>
                <input type="text" class="form-control" id="kelas" name="kelas"
                       value="{{ old('kelas') }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection