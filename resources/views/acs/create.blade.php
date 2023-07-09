<!-- resources/views/consoles/create.blade.php -->

@extends('backend.layouts.app')

@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <h1 class="my-3">Tambah Data AC</h1>
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                    
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{route('store')}}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>

                                <div class="form-group">
                                    <label for="price">Harga</label>
                                    <input type="text" class="form-control" id="harga" name="harga" required>
                                </div>

                                <div class="form-group">
                                    <label for="memory_capacity">Daya</label>
                                    <input type="text" class="form-control" id="daya" name="daya" required>
                                </div>

                                <div class="form-group">
                                    <label for="weight">Konsumsi Listrik</label>
                                    <input type="text" class="form-control" id="konsumsi_listrik" name="konsumsi_listrik" required>
                                </div>

                                <div class="form-group">
                                    <label for="cpu_speed">Tingkat Kebisingan</label>
                                    <input type="text" class="form-control" id="tingkat_kebisingan" name="tingkat_kebisingan" required>
                                </div>

                                <div class="form-group">
                                    <label for="power_consumption">Garansi</label>
                                    <input type="text" class="form-control" id="garansi" name="garansi" required>
                                </div>
                                <br>
                                <button id="createButton" type="submit" class="btn btn-primary">Tambahkan</button>
                                <a href="{{route('ac')}}" type="submit" class="btn btn-danger">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    // Menangkap elemen tombol Edit
    var editButton = document.getElementById('createButton');

    // Menambahkan acara klik pada tombol
    editButton.addEventListener('click', function(event) {
        // Menghentikan tindakan bawaan dari tombol (submit form)
        event.preventDefault();

        // Menampilkan Sweet Alert
        swal({
                title: "Mantul!",
                text: "Data berhasil ditambahkan",
                icon: "success",
                button: "Kembali",
            })
            .then((value) => {
                // Jika tombol OK di Sweet Alert diklik, lanjutkan submit form
                if (value) {
                    // Cari elemen form terdekat dan submit form
                    var form = editButton.closest('form');
                    form.submit();
                }
            });
    });
</script>
@endsection