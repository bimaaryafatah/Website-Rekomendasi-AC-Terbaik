
@extends('backend.layouts.app')
@section('content')

<!-- resources/views/acs/index.blade.php -->

<div class="container">
    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h1>Rekomendasi Pemilihan AC</h1>

    <a href="/create" class="btn btn-primary mb-3">Tambah data AC</a>
    <a href="/showform" class="btn btn-danger mb-3">Perhitungan SPK</a>

    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Harga</th>
                <th>Daya</th>
                <th>Konsumsi Listrik</th>
                <th>Tingkat Kebisingan</th>
                <th>Garansi</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($acs as $ac)
            <tr>
                <td>{{ $ac->nama }}</td>
                <td>{{ $ac->harga }}</td>
                <td>{{ $ac->daya }}</td>
                <td>{{ $ac->konsumsi_listrik }}</td>
                <td>{{ $ac->tingkat_kebisingan }}</td>
                <td>{{ $ac->garansi }}</td>

                <td>
                    <a href="/edit/{{ $ac->id }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="/delete/{{ $ac->id }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
