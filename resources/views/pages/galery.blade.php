@extends('app')

@section('title', 'Galery')

@section('style')
<style>

        .carousel-item {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: transparent;
            background-image: none;
        }
        .carousel-control-prev-icon::after {
            content: '‹';
            font-size: 55px;
            color: black;
        }
        .carousel-control-next-icon::after {
            content: '›';
            font-size: 55px;
            color: black;
        }
</style>
@endsection
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Album</h1>
        <button id="openModalAlbum" type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-edit fa-sm text-white-50" data-toggle="modal" data-target="#myModal"></i> Tambah Album</a>
    </div>


    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-warning">
            <h6 class="m-0 font-weight-bold text-primary">Table Album</h6>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>

                        </tr>
                    </thead>
                    <tbody>
                        @if($albums->isNotEmpty())
                        @foreach ($albums as $data)
                            <tr>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->description }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-edit-album"
                                        data-id-album="{{ $data->id }}"
                                        data-nama-album="{{ $data->name }}"
                                        data-deskripsi="{{ $data->description }}"
                                        data-toggle="modal"
                                        data-target="#editModalAlbum">
                                        Edit
                                    </button>

                                    <button class="btn btn-danger btn-delete-album" type="button"
                                        data-id="{{ $data->id }}"
                                        data-nama="{{ $data->name }}"
                                        data-toggle="modal"
                                        data-target="#deleteModalAlbum">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                    @else
                        <tr>
                            <td colspan="6" align="center">Tidak ada data album</td>
                        </tr>
                    @endif
                    </tbody>

                </table>
                <div class="d-flex justify-content-end">

            </div>

        </div>
    </div>
    </div>

 <!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Galeri</h1>
    <button id="openModalGaleri" type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-edit fa-sm text-white-50" data-toggle="modal" data-target="#myModal"></i> Tambah Foto</a>
</div>


<div class="card shadow mb-4">
    <div class="card-header py-3 bg-warning">
        <h6 class="m-0 font-weight-bold text-primary">Table Galery</h6>
    </div>

    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Gambar</th>
                        <th>Album</th>
                        <th>Aksi</th>

                    </tr>
                </thead>
                <tbody>
                    @if($galery->isNotEmpty())
                    @foreach ($galery as $data)
                    <tr>
                        <td>{{ $data->nama }}</td>
                        <td><img src="{{ $data->gambar }}" alt="{{ $data->nama }}" style="width: 100px; height: auto;"></td>
                        <td>{{ $data->album->name }}</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-edit-galery"
                                data-edit-id="{{ $data->id }}"
                                data-edit-nama="{{ $data->nama }}"
                                data-toggle="modal"
                                data-target="#editModalGalery">
                                Edit
                            </button>

                            <button class="btn btn-danger btn-delete-galery" type="button"
                                data-id="{{ $data->id }}"
                                data-galery="{{ $data->nama }}"
                                data-toggle="modal"
                                data-target="#deleteModalGalery">
                                Hapus
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

                @else
                    <tr>
                        <td colspan="6" align="center">Tidak ada data album</td>
                    </tr>
                @endif
                </tbody>

            </table>
            <div class="d-flex justify-content-end">

        </div>

    </div>
</div>
</div>

    </div>
    @if(session('success'))
    <div class="alert alert-success mt-5">
        {{ session('success') }}
    </div>
@endif
     <!-- Menampilkan Pesan Error -->
@if($errors->any())
<div class="alert alert-danger mt-5">
    <p>Pastikan semua form sudah diisi</p>
</div>
@endif



{{-- Modal Tambah Album --}}

<div class="modal fade" id="modalTambahAlbum" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Tambah Album </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('createalbum') }}" id="formTambahAlbum" method="POST" >
                    @csrf
                    <div class="mb-3">
                    <label for="nama" class="form-label">Nama Album</label>
                   <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Masukan Nama Album" required>
                   @error('name')
                   <div class="invalid-feedback">{{ $message }}</div>
               @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nama" class="form-label">Deskripsi</label>
                       <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" id="description" placeholder="Masukan Deskripsi Album" required>
                       @error('description')
                       <div class="invalid-feedback">{{ $message }}</div>
                   @enderror
                        </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" id="submitButtonAlbum" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>

{{-- Modal Tambah Galeri --}}
<div class="modal fade" id="modalTambahGaleri" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Tambah Galeri Foto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('creategalery') }}" id="formTambahGaleri" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                    <label for="nama" class="form-label">Nama Kegiatan</label>
                   <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Masukan Nama Kegiatan" required>
                   @error('nama')
                   <div class="invalid-feedback">{{ $message }}</div>
               @enderror
                    </div>

                  <div class="mb-3">
                            <label for="siswa"> Pilih Album </label>
                            <select name="album_id" class="form-control mb-3" aria-label="Large select example" >
                                @foreach ($albums as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                              </select>
                               @error('album_id')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>

                    <div class=" mb-3">
                        <label class="form-label" for="inputGroupFile01">Upload Gambar</label>
                        <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror" id="inputGroupFile01">
                        @error('gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" id="submitButtonGaleri" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>

{{-- Edit Galery --}}

<div class="modal fade" id="editModalGalery" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Galery</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

                <div class="modal-body">
                    <form id="editFormGalery" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Kegiatan</label>
                           <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="edit_nama" placeholder="Masukan Nama Kegiatan" required>
                           @error('nama')
                           <div class="invalid-feedback">{{ $message }}</div>
                       @enderror
                            </div>

                          <div class="mb-3">
                                    <label for="siswa"> Pilih Album </label>
                                    <select name="album_id" class="form-control mb-3"  aria-label="Large select example" >
                                        @foreach ($albums as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                      </select>
                                       @error('album_id')
                                      <div class="invalid-feedback">{{ $message }}</div>
                                  @enderror
                                </div>

                            <div class=" mb-3">
                                <label class="form-label" for="inputGroupFile01">Upload Gambar</label>
                                <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror" id="inputGroupFile01">
                                @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" id="submitEditGalery" class="btn btn-primary">Simpan Perubahan</button>
                </div>

        </div>
    </div>
</div>
{{-- Edit Album --}}

<div class="modal fade" id="editModalAlbum" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Album</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

                <div class="modal-body">
                    <form id="editFormAlbum" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Kegiatan</label>
                           <input type="text" name="name" class="form-control @error('nama') is-invalid @enderror" id="edit_nama_album" placeholder="Masukan Nama Kegiatan" required>
                           @error('nama')
                           <div class="invalid-feedback">{{ $message }}</div>
                       @enderror
                            </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                           <input type="text" name="decription" class="form-control @error('description') is-invalid @enderror" id="edit_deskripsi" placeholder="Masukan Deskripsi" required>
                           @error('description')
                           <div class="invalid-feedback">{{ $message }}</div>
                       @enderror
                            </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" id="submitEditAlbum" class="btn btn-primary">Simpan Perubahan</button>
                </div>

        </div>
    </div>
</div>


<!-- Delete Modal Album -->
<div class="modal fade" id="deleteModalAlbum" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data <strong id="deleteNama"></strong>?
            </div>
            <div class="modal-footer">
                <form id="deleteFormAlbum" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Delete Modal Galeri -->
<div class="modal fade" id="deleteModalGalery" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data <strong id="deleteNamaGalery"></strong>?
            </div>
            <div class="modal-footer">
                <form id="deleteFormGalery" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>

document.getElementById('openModalAlbum').addEventListener('click' , function() {
    $('#modalTambahAlbum').modal('show')
})

$("#modalTambahAlbum").on('show.bs.modal', function(e) {

})
$("#modalTambahAlbum").on('hidden.bs.modal', function(e) {

})

</script>
<script>
    document.getElementById('openModalGaleri').addEventListener('click' , function() {
    $('#modalTambahGaleri').modal('show')
})

$("#modalTambahGaleri").on('show.bs.modal', function(e) {

})
$("#modalTambahGaleri").on('hidden.bs.modal', function(e) {

})
</script>

<script>
document.getElementById('submitButtonGaleri').addEventListener('click', function() {
    document.getElementById('formTambahGaleri').submit()
})
document.getElementById('submitButtonAlbum').addEventListener('click', function() {
    document.getElementById('formTambahAlbum').submit()
})
</script>

<script>
// Modal Delete

document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.btn-delete-galery');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const nama = this.getAttribute('data-galery');

                const deleteForm = document.getElementById('deleteFormGalery');
                const deleteNama = document.getElementById('deleteNamaGalery');

                deleteForm.action = '/galery/' + id;
                deleteNama.textContent = nama;

                const deleteModal = new bootstrap.Modal(document.getElementById('deleteModalGalery'));
                deleteModal.show();
            });
        });
    });

document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.btn-delete-album');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const nama = this.getAttribute('data-nama');

                const deleteForm = document.getElementById('deleteFormAlbum');
                const deleteNama = document.getElementById('deleteNama');

                deleteForm.action = '/album/' + id;
                deleteNama.textContent = nama;

                const deleteModal = new bootstrap.Modal(document.getElementById('deleteModalAlbum'));
                deleteModal.show();
            });
        });
    });
</script>


<script>

    // Edit Galery

document.addEventListener('DOMContentLoaded', function () {
    // Handle edit button click
    document.querySelectorAll('.btn-edit-galery').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-edit-id');
            const nama = this.getAttribute('data-edit-nama');



            // Set form action
            const form = document.getElementById('editFormGalery');
            form.action = `/galery/${id}`;

            // Fill form inputs
            document.getElementById('edit_nama').value = nama;

            // Show the modal
            $('#editModalGalery').modal('show');
        });
    });

    // Handle form submission
    document.getElementById('submitEditGalery').addEventListener('click', function () {
        document.getElementById('editFormGalery').submit();
    });

    })
    // Edit Album
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Handle edit button click
    document.querySelectorAll('.btn-edit-album').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id-album');
            const nama = this.getAttribute('data-nama-album');
            const deskripsi = this.getAttribute('data-deskripsi');



            // Set form action
            const form = document.getElementById('editFormAlbum');
            form.action = `/album/${id}`;

            // Fill form inputs
            document.getElementById('edit_nama_album').value = nama;
            document.getElementById('edit_deskripsi').value = deskripsi;

            // Show the modal
            $('#editModalAlbum').modal('show');
        });
    });

    // Handle form submission
    document.getElementById('submitEditAlbum').addEventListener('click', function () {
        document.getElementById('editFormAlbum').submit();
    });

    })

</script>
@endsection
