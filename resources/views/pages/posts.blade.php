@extends('app')

@section('title', 'Blog')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Blog</h1>
        <button id="openModal" type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-edit fa-sm text-white-50" data-toggle="modal" data-target="#myModal"></i> Tambah Blog</a>
    </div>


        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Content</th>
                        <th>Gambar</th>
                        <th>Aksi</th>

                    </tr>
                </thead>
                <tbody>
                    @if($posts->isNotEmpty())
                    @foreach ($posts as $data)
                        <tr>
                            <td>{{ $data->judul }}</td>
                            <td>{{ $data->excerpt }}</td>
                            <td><img src="{{ $data->image }}" alt="" height="70px" width="70px"></td>
                            <td>
                                <button type="button" class="btn btn-primary btn-edit"
                                    data-id="{{ $data->id }}"
                                    data-judul="{{ $data->judul }}"
                                    data-body="{{ $data->excerpt }}"
                                    data-image="{{ $data->image }}"
                                    data-toggle="modal"
                                    data-target="#editModal">
                                    Edit
                                </button>

                                <button class="btn btn-danger btn-delete" type="button"
                                    data-id="{{ $data->id }}"
                                    data-nama="{{ $data->judul }}"
                                    data-toggle="modal"
                                    data-target="#deleteModal">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    @endforeach

                @else
                    <tr>
                        <td colspan="6" align="center">Tidak ada postingan</td>
                    </tr>
                @endif
                </tbody>

            </table>
            <div class="d-flex justify-content-end">

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
</div>

<!-- Modal Edit -->

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

                <div class="modal-body">
                    <form id="editForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul Blog</label>
                           <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" id="edit_judul" placeholder="Masukan Judul" required>
                           @error('judul')
                           <div class="invalid-feedback">{{ $message }}</div>
                       @enderror
                            </div>
                            <div class="form-label mb-3">
                                <label class="form-label" for="image">Upload Gambar</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                                <img src="" id="edit_image" alt="">
                                @error('image')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                            <label for="body" class="form-label required">Body</label>
                            <textarea id="editor1" name="body"></textarea>
                           @error('body')
                           <div class="invalid-feedback">{{ $message }}</div>
                       @enderror
                        </div>


                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" id="submitEditButton" class="btn btn-primary">Simpan Perubahan</button>
                </div>

        </div>
    </div>
</div>
{{-- Modal Tambah --}}
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Tambah Blog </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('postscreate') }}" id="formTambah" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                    <label for="judul" class="form-label">Judul Blog</label>
                   <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" id="judul" placeholder="Masukan Judul" required>
                   @error('judul')
                   <div class="invalid-feedback">{{ $message }}</div>
               @enderror
                    </div>
                    <div class="form-label mb-3">
                        <label class="form-label" for="image">Upload Gambar</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                        @error('image')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                    <label for="body" class="form-label required">Body</label>
                    <textarea id="editor" name="body"></textarea>
                   @error('body')
                   <div class="invalid-feedback">{{ $message }}</div>
               @enderror
                </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" id="submitButton" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>

{{-- Modal Delete --}}

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data <strong id="deleteNama"></strong>?
            </div>
            <div class="modal-footer">
                <form id="deleteForm" method="POST" action="">
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

document.getElementById('openModal').addEventListener('click', function() {
    $('#myModal').modal('show')
})
        $('#myModal').on('show.bs.modal', function (e) {

        });

        // Event listener untuk saat modal ditutup
        $('#myModal').on('hidden.bs.modal', function (e) {

        });


</script>

<script>
    document.getElementById('submitButton').addEventListener('click', function() {
        document.getElementById('formTambah').submit()
    })


    document.addEventListener('DOMContentLoaded', function () {
    // Handle edit button click
    document.querySelectorAll('.btn-edit').forEach(button => {
        button.addEventListener('click', function () {
            const Id = this.getAttribute('data-id');
            const judul = this.getAttribute('data-judul');
            const body = this.getAttribute('data-body');
            const image = this.getAttribute('data-image');


            // Set form action
            const form = document.getElementById('editForm');
            form.action = `/posts/${Id}`;

            // Fill form inputs
            document.getElementById('edit_judul').value = judul;
            document.getElementById('body').value = body;
            document.getElementById('edit_image').src = image;
            // Show the modal
            $('#editModal').modal('show');
        });
    });

    // Handle form submission
    document.getElementById('submitEditButton').addEventListener('click', function () {
        document.getElementById('editForm').submit();
    });

    })

    // Modal Delete
    document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.btn-delete');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const nama = this.getAttribute('data-nama');

                    const deleteForm = document.getElementById('deleteForm');
                    const deleteNama = document.getElementById('deleteNama');

                    deleteForm.action = '/posts/' + id;
                    deleteNama.textContent = nama;

                    const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
                    deleteModal.show();
                });
            });


        });
    </script>
 <script src="{{ asset('assets/vendor/ckeditor5/ckeditor.js') }}"></script>
 <script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
 <script>
    ClassicEditor
        .create( document.querySelector( '#editor1' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection
