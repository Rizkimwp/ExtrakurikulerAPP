@extends('app')

@section('title', 'Event')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> List Event</h1>
        <button id="openModal" type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-edit fa-sm text-white-50" data-toggle="modal" data-target="#myModal"></i> Tambah Extrakurikuler</a>
    </div>

    <div class="container">
        <div class="card">
            <div class="card-body card-body-scrollable">

                <div class="row">

                @if ($event->isNotEmpty())
                    @foreach ($event as $item )
                    <div class="col-4 mb-4">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body bg-warning">
                                <h2 class="card-title text-dark fw-bold">{{ $item->nama }}</h5>
                                    <p class="card-text text-dark">{{ $item->deskripsi }}</p>
                                    <h5 class="card-title text-dark">{{ $item->jadwal }}</h5>
                                <a href="#" class="btn btn-primary">Lihat Detail</a>
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
    <p>Pastikan semua form sudah diisi</p>
</div>
@endif
</div>


{{-- Modal Tambah --}}
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Tambah Event </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('eventcreate') }}" id="formTambah" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                    <label for="nama" class="form-label">Nama Event</label>
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
                    <div class="mb-3">
                    <label for="hari" class="form-label required">Jadwal Event</label>
                   <input type="date" name="jadwal" class="form-control @error('jadwal') is-invalid @enderror" id="jadwal" placeholder="Masukan Jadwal" required/>
                   @error('jadwal')
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
