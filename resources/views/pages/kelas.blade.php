@extends('app')

@section('title', 'Kelas')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Kelas</h1>
        <button id="openModal" type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-edit fa-sm text-white-50" data-toggle="modal" data-target="#myModal"></i> Tambah Kelas</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Table Data Kelas</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Kelas</th>
                            <th>Aksi</th>


                        </tr>
                    </thead>

                    <tbody>

                        @if($kelas->isNotEmpty())
                        @foreach ($kelas as $data)
                            <tr>
                                <td>{{ $data->nama_kelas }}</td>
                                <td>

                            <button class="btn btn-danger btn-delete" type="button"
                    data-id="{{ $data->id }}"
                    data-nama="{{ $data->nama_kelas }}"
                    data-toggle="modal"
                    data-target="#deleteModal">
                    Hapus
                </button>
                                </td>
                            </tr>
                        @endforeach

                    @else
                        <tr>
                            <td colspan="6" align="center">Tidak ada data Kelas</td>
                        </tr>
                    @endif
                    </tbody>

                </table>



                {{-- Response Success --}}
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
                 <!-- Menampilkan Pesan Error -->
        @if($errors->any())
        <div class="alert alert-danger">
                <p>Pastikan semua form sudah diisi</p>
        </div>
    @endif
            </div>

        </div>
    </div>
</div>
{{-- Modal Tambah --}}
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="myForm"  class="user" method="POST" action="{{ route('createkelas') }}">
                        @csrf
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nama Kelas</label>
                        <input type="text" name="nama_kelas" class="form-control @error('nama_kelas') is-invalid @enderror" id="exampleFormControlInput1" placeholder="Masukan Nama Kelas">
                        @error('nama_kelas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" id="submitButton" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </div>
        </div>
    </div>
{{-- Delete Modal --}}
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

// Modal Tambah
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
   const inputs = document.querySelectorAll('#myForm input');
    inputs.forEach(input => {
    input.addEventListener('input', function() {
        if (this.classList.contains('is-invalid')) {
            this.classList.remove('is-invalid');
            this.nextElementSibling.style.display = 'none';
        }
    });
});

    document.getElementById('submitButton').addEventListener('click', function() {
    document.getElementById('myForm').submit()
})

</script>
<script>
// Modal Delete

    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.btn-delete');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const nama = this.getAttribute('data-nama');

                const deleteForm = document.getElementById('deleteForm');
                const deleteNama = document.getElementById('deleteNama');

                deleteForm.action = '/kelas/' + id;
                deleteNama.textContent = nama;

                const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
                deleteModal.show();
            });
        });
    });


</script>
</script>

@endsection
