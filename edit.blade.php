@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3>Edit Buku</h3>
        </div>
        <div class="card-body">
            <form action="{{ url('/buku/' . $data->BukuID) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="judul" class="form-label"><strong>Judul Buku</strong></label>
                    <input type="text" name="judul" id="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ $data->Judul  }}">
                    @error('judul')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="penulis" class="form-label"><strong>Penulis</strong></label>
                    <input type="text" name="penulis" id="penulis" class="form-control @error('penulis') is-invalid @enderror" value="{{ $data->Penulis }}">
                    @error('penulis')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="penerbit" class="form-label"><strong>Penerbit</strong></label>
                    <input type="text" name="penerbit" id="penerbit" class="form-control @error('penerbit') is-invalid @enderror" value="{{ $data->Penerbit }}">
                    @error('penerbit')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tahunTerbit" class="form-label"><strong>Tahun Terbit</strong></label>
                    <input type="number" name="tahunTerbit" id="tahunTerbit" class="form-control @error('tahunTerbit') is-invalid @enderror" value="{{ $data->TahunTerbit }}">
                    @error('tahunTerbit')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Edit Buku</button>
                <a href="/buku" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
