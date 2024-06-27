@extends('app')


@section('title', 'List Extrakurikuler')

@section('style')
<style>
    .card-body-scrollable {
        max-height: 400px;
        overflow-y: auto;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    </style>
@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> List Extrakurikuler</h1>
        <button id="openModal" type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-edit fa-sm text-white-50" data-toggle="modal" data-target="#myModal"></i> Tambah Extrakurikuler</a>
    </div>

    <div class="container">
        <div class="card">
            <div class="card-body card-body-scrollable">

                <div class="row">

                @if ($extrakurikuler->isNotEmpty())
                    @foreach ($extrakurikuler as $item )
                    <div class="col-4 mb-4">
                        <div class="card" style="width: 18rem;">
                            <img src="{{ $item->gambar }}" class="card-img-top" alt="image" height="150px" width="200px">
                            <div class="card-body bg-warning">
                                <h5 class="card-title text-dark">{{ $item->nama }}</h5>
                                <p class="card-text text-dark">{{ $item->deskripsi }}</p>
                                <a href="#" class="btn btn-primary btn-detail" data-gambar="{{ $item->gambar }}" data-id="{{ $item->id }}" data-nama="{{ $item->nama }}" data-deskripsi="{{ $item->deskripsi }}" data-toggle="modal" data-target="#detail">Lihat Detail</a>
                                <button class="btn btn-danger btn-delete" type="button"
                                data-id="{{ $item->id }}"
                                    data-nama="{{ $item->nama }}"
                                data-toggle="modal"
                                data-target="#deleteModal">
                                Hapus
                            </button>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    @else
                    <div class="col align-self-center">
                    <h4 class="text-center">Tidak ada data yang tersedia</h4>
                </div>
                    @endif
                </div>
      <div>
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
    <p>{{ $errors }}</p>
</div>
@endif
</div>

{{-- Modal Detail --}}

<div class="modal fade" id="detail" tabindex="-1" aria-labelledby="detail" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailLabel"> Detail Extrakurikuler</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <h5 id="detailNama"></h5>
                <p id="detailDeskripsi"></p>
                <img id="detailGambar" src="" alt="image" style="width:100%; heigth:auto;">
            </div>
        </div>
    </div>
</div>
{{-- Modal Tambah --}}

<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Tambah Extrakurikuler</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('extracreate') }}" id="formTambah" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                    <label for="nama" class="form-label">Nama Extrakurikuler</label>
                   <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Masukan nama" required>
                   @error('nama')
                   <div class="invalid-feedback">{{ $message }}</div>
               @enderror
                    </div>
                    <div class="mb-3">
                    <label for="deskripsi" class="form-label required">Deskripsi</label>
                   <textarea type="text" name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" placeholder="Masukan Deskripsi" required>

                </textarea>
                   @error('deskripsi')
                   <div class="invalid-feedback">{{ $message }}</div>
               @enderror
                </div>
                    <div class="mb-3">
                    <label for="hari" class="form-label required">Hari Kegiatan</label>
                   <input type="text" name="hari" class="form-control @error('hari') is-invalid @enderror" id="hari" placeholder="Masukan Hari Kegiatan" required/>


                   @error('hari')
                   <div class="invalid-feedback">{{ $message }}</div>
               @enderror
                </div>
                    <div class="mb-3">
                    <label for="time" class="form-label required">Waktu Kegiatan</label>
                   <input type="time" name="time" class="form-control @error('time') is-invalid @enderror" id="time" placeholder="Masukan Waktu Kegiatan" required/>


                   @error('time')
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
                <button type="button" id="submitButton" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>
<!-- Delete Modal -->
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

document.getElementById('openModal').addEventListener('click' , function() {
    $('#modalTambah').modal('show')
})

$("#modalTambah").on('show.bs.modal', function(e) {

})
$("#modalTambah").on('hidden.bs.modal', function(e) {

})
</script>
<script>
document.getElementById('submitButton').addEventListener('click', function() {
    document.getElementById('formTambah').submit()
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

                deleteForm.action = '/extrakurikuler/' + id;
                deleteNama.textContent = nama;

                const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
                deleteModal.show();
            });
        });
    });
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const detailButton = document.querySelectorAll('.btn-detail');

        detailButton.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const nama = this.getAttribute('data-nama');
                const deskripsi = this.getAttribute('data-deskripsi');
                const gambar = this.getAttribute('data-gambar')

                document.getElementById('detailNama').textContent = nama;
                document.getElementById('detailDeskripsi').textContent = deskripsi;
                document.getElementById('detailGambar').src = gambar ;

                const detailModal = new bootstrap.Modal(document.getElementById('detail'))
                detailModal.show()
            })
    })
})

</script>

@endsection
