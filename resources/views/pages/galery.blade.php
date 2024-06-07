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
        <h1 class="h3 mb-0 text-gray-800">Galeri Dokumentasi</h1>
        <button id="openModal" type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-edit fa-sm text-white-50" data-toggle="modal" data-target="#myModal"></i> Tambah Foto</a>
    </div>


        <div id="galeryCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              @if ($galery->isNotEmpty())
                @foreach ($galery->chunk(3) as $index => $chunk)
                <div class="carousel-item @if($index == 0) active @endif">
                  <div class="row">
                    @foreach ($chunk as $item)
                    <div class="col-3 m-8">
                      <div class="card" style="width: 18rem; margin: auto;">
                        <img src="{{ $item->gambar }}" class="card-img-top" alt="image" height="150px" width="200px">
                        <div class="card-body bg-warning">
                          <h2 class="card-title text-dark fw-bold">{{ $item->nama }}</h2>
                          <p class="card-text text-dark">{{ $item->deskripsi }}</p>
                          <h5 class="card-title text-dark">{{ $item->jadwal }}</h5>

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
                  </div>
                </div>
                @endforeach
              @else
                <div class="carousel-item active">
                  <div class="col align-self-center">
                    <h4 class="text-center">Tidak ada data yang tersedia</h4>
                  </div>
                </div>
              @endif
            </div>
            <a class="carousel-control-prev" href="#galeryCarousel" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#galeryCarousel" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true" style="color: "></span>
              <span class="sr-only">Next</span>
            </a>
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



{{-- Modal Tambah --}}

<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Tambah Galeri Foto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('creategalery') }}" id="formTambah" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                    <label for="nama" class="form-label">Nama Kegiatan</label>
                   <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Masukan Nama Kegiatan" required>
                   @error('nama')
                   <div class="invalid-feedback">{{ $message }}</div>
               @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Pilih Extrakurikuler</label>
                        <select name="id_extrakurikuler" class="form-select form-control form-select-lg mb-3 @error('id_extrakurikuler')
                            is-invalid
                        @enderror" aria-label="Large select example">
                        <option selected>Pilih Extrakurikuler</option>
                        @foreach ($extrakurikuler as $class )
                        <option value="{{ $class->id }}">{{ $class->nama }}</option>
                        @endforeach
                          </select>
                          @error('id_extrakurikuler')
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
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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


@endsection
