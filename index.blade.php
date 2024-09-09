@extends('layouts.app')

@section('content')
<div>
<a href="/buku/create" class="btn btn-primary">+ Tambah Data</a>
</div>
<br>
<div>
    @if (Session('pesan'))
    <div class="alert alert-success" role="alert">{{Session('pesan')}}</div>
    @endif
</div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Tahun Terbit</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <th>{{$loop->iteration}}</th>
                    <td>{{$item->Judul}}</td>
                    <td>{{$item->Penulis}}</td>
                    <td>{{$item->Penerbit}}</td>
                    <td>{{$item->TahunTerbit}}</td>
                    <td><a class="btn btn-secondary btn-sm" href="/buku/{{$item->BukuID}}">Detail</a>
                    <a class="btn btn-warning btn-sm" href="/buku/{{$item->BukuID}}/edit">Edit</a>
                    <form class="d-inline" action="{{'/buku/'.$item->BukuID}}" method="post">
                     @csrf
                     @method('DELETE')
                     <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
                    </form></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection