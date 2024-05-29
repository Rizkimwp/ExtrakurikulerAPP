@extends('app')

@section('title', 'Data Siswa')

@section('style')

@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Siswa</h1>
        <button id="openModal" type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-edit fa-sm text-white-50" data-toggle="modal" data-target="#myModal"></i> Tambah Siswa</a>
    </div>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Table Data Siswa</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Nomor Hp</th>
                            <th>Nama Wali</th>
                            <th>Kelas</th>
                            <th>Aksi</th>

                        </tr>
                    </thead>

                    <tbody>

                        @if($siswa->isNotEmpty())
                        @foreach ($siswa as $data)
                            <tr>
                                <td>{{ $data->nama }}</td>
                                <td>{{ $data->alamat }}</td>
                                <td>{{ $data->nomor_hp }}</td>
                                <td>{{ $data->nama_wali }}</td>
                                <td>{{ $data->id_kelas }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-edit"
                                    data-id="{{ $data->id }}"
                                    data-nama="{{ $data->nama }}"
                                    data-alamat="{{ $data->alamat }}"
                                    data-nomorhp="{{ $data->nomor_hp }}"
                                    data-namawali="{{ $data->nama_wali }}"
                                    data-idkelas="{{ $data->id_kelas }}"
                                    data-toggle="modal"
                                    data-target="#editModal">
                                Edit
                            </button>
                            <button class="btn btn-danger btn-delete" type="button"
                    data-id="{{ $data->id }}"
                    data-nama="{{ $data->nama }}"
                    data-toggle="modal"
                    data-target="#deleteModal">
                    Hapus
                </button>
                                </td>
                            </tr>
                        @endforeach

                    @else
                        <tr>
                            <td colspan="6" align="center">Tidak ada data siswa</td>
                        </tr>
                    @endif
                    </tbody>

                </table>
                {{-- Paggination --}}
                <div class="d-flex justify-content-end">
                         {{ $siswa->links() }}
                </div>

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
    <!-- Modal Tambah-->
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
                    <form id="myForm"  class="user" method="POST" action="{{ route('createsiswa') }}">
                        @csrf
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="exampleFormControlInput1" placeholder="Masukan nama">
                        @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Alamat</label>
                        <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="exampleFormControlInput1" placeholder="Masukan alamat">
                        @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nomor Hp</label>
                        <input type="text" name="nomor_hp" class="form-control @error('nomor_hp') is-invalid
                        @enderror" id="exampleFormControlInput1" placeholder="Masukan nomor hp">
                        @error('nomor_hp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nama Wali</label>
                        <input type="text" name="nama_wali" class="form-control @error('nama_wali') is-invalid @enderror" id="exampleFormControlInput1" placeholder="Masukan nama wali">
                        @error('nama_wali')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Kelas</label>
                        <select name="id_kelas" class="form-select form-control form-select-lg mb-3 @error('kelas')
                            is-invalid
                        @enderror" aria-label="Large select example">
                        <option selected>Pilih Kelas</option>
                        @foreach ($kelas as $class )
                        <option value="{{ $class->id }}">{{ $class->nama_kelas }}</option>
                        @endforeach
                          </select>
                          @error('id_kelas')
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
    {{-- MODAL UPDATE --}}
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
                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="edit_id" name="id">
                        <div class="mb-3">
                            <label for="edit_nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="edit_nama" name="nama">
                        </div>
                        <div class="mb-3">
                            <label for="edit_alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="edit_alamat" name="alamat">
                        </div>
                        <div class="mb-3">
                            <label for="edit_nomorhp" class="form-label">Nomor HP</label>
                            <input type="text" class="form-control" id="edit_nomorhp" name="nomor_hp">
                        </div>
                        <div class="mb-3">
                            <label for="edit_namawali" class="form-label">Nama Wali</label>
                            <input type="text" class="form-control" id="edit_namawali" name="nama_wali">
                        </div>
                        <div class="mb-3">
                            <label for="edit_idkelas" class="form-label">ID Kelas</label>
                            <input type="text" class="form-control" id="edit_idkelas" name="id_kelas">
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

document.getElementById('submitEditButton').addEventListener('click', function() {
    document.getElementById('editForm').submit()
})

// Modal Update
document.addEventListener('DOMContentLoaded', function() {
    // Ambil semua tombol dengan class 'btn-edit'
    var editButtons = document.querySelectorAll('.btn-edit');

    editButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            // Ambil data dari atribut data-*
            var id = this.getAttribute('data-id');
            var nama = this.getAttribute('data-nama');
            var alamat = this.getAttribute('data-alamat');
            var nomorhp = this.getAttribute('data-nomorhp');
            var namawali = this.getAttribute('data-namawali');
            var idkelas = this.getAttribute('data-idkelas');

            // Isi input di dalam modal dengan data siswa yang sesuai
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_nama').value = nama;
            document.getElementById('edit_alamat').value = alamat;
            document.getElementById('edit_nomorhp').value = nomorhp;
            document.getElementById('edit_namawali').value = namawali;
            document.getElementById('edit_idkelas').value = idkelas;

            // Update action attribute of the form with the correct route
            document.getElementById('editForm').setAttribute('action', '/siswa/' + id);

            // Tampilkan modal edit
            var editModal = new bootstrap.Modal(document.getElementById('editModal'));
            editModal.show();
        });
    });
});

// Modal Delete

    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.btn-delete');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const nama = this.getAttribute('data-nama');

                const deleteForm = document.getElementById('deleteForm');
                const deleteNama = document.getElementById('deleteNama');

                deleteForm.action = '/siswa/' + id;
                deleteNama.textContent = nama;

                const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
                deleteModal.show();
            });
        });
    });


</script>
@endsection
