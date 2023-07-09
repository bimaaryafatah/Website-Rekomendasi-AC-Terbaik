<!-- resources/views/acs/index.blade.php -->

@extends('backend.layouts.app')

@section('content')

<div class="content-wrapper">
    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <section class="content-header">
        <div class="container-fluid">
            <h1 class="m-0">Data Alternatif</h1>

            <a href="{{route('create')}}" class="btn btn-primary my-3">Tambah data AC</a>
            <a href="{{route('showform')}}" class="btn btn-success my-3">Perhitungan SPK</a>
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Product</h3>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
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
                                        <td>{{ $ac->id }}</td>
                                        <td>{{ $ac->nama }}</td>
                                        <td>{{ $ac->harga }}</td>
                                        <td>{{ $ac->daya }}</td>
                                        <td>{{ $ac->konsumsi_listrik }}</td>
                                        <td>{{ $ac->tingkat_kebisingan }}</td>
                                        <td>{{ $ac->garansi }}</td>

                                        <td>
                                            <a href="{{ route('edit', ['id' => $ac->id]) }}" class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('delete', ['id' => $ac->id]) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button id="deleteButton" class="deleteButton btn btn-sm btn-danger" type="submit">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </section>
</div>

<!-- /.container-fluid -->
</section>
</div>

<script>
    // Menangkap elemen tombol Hapus
    var deleteButtons = document.querySelectorAll('.deleteButton');

    // Menambahkan acara klik pada setiap tombol Hapus
    deleteButtons.forEach(function(deleteButton) {
        deleteButton.addEventListener('click', function(event) {
            // Menghentikan tindakan bawaan dari tombol (submit form)
            event.preventDefault();

            // Menampilkan Sweet Alert konfirmasi
            swal({
                title: "Apakah kamu yakin?",
                text: "Data akan dihapus secara permanen!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then(function(willDelete) {
                // Jika tombol Hapus di Sweet Alert diklik, lanjutkan dengan penghapusan
                if (willDelete) {
                    // Menampilkan Sweet Alert setelah data dihapus
                    swal("Data telah dihapus!", {
                        icon: "success",
                    }).then(function() {
                        // Cari elemen form terdekat dan submit form
                        var form = deleteButton.parentElement;
                        form.submit();
                    });
                } else {
                    swal("Data tidak dihapus!");
                }
            });
        });
    });
</script>


@endsection