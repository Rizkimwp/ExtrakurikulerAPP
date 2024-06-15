@extends('app')

@section('title', 'Manajemen Akun')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data User</h1>
        <button id="openModal" type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-edit fa-sm text-white-50" data-toggle="modal" data-target="#myModal"></i> Tambah User</a>
    </div>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Table Data User Admin</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Hak Akses</th>
                            <th>Aksi</th>


                        </tr>
                    </thead>

                    <tbody>

                        @if($user->isNotEmpty())
                        @foreach ($user as $data)
                            <tr>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->email }}</td>
                                <td>  @foreach ($data->roles as $role)
                                    {{ $role->name }}
                                @endforeach</td>

                                <td>
                                    <button type="button" class="btn btn-primary btn-edit"
                                    data-id="{{ $data->id }}"
                                    data-nama="{{ $data->name }}"
                                    data-email="{{ $data->email }}"
                                    @foreach ($data->roles as $role)
                                    data-role="{{ $role->name }}"
                                @endforeach
                                    data-toggle="modal"
                                    data-target="#editModal">
                                Edit
                            </button>
                            <button class="btn btn-danger btn-delete" type="button"
                    data-id="{{ $data->id }}"
                    data-nama="{{ $data->name }}"
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
                <p>{{ $errors }}</p>
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
                    <form id="myForm"  class="user" method="POST" action="{{ route('user.create') }}">
                        @csrf
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nama</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="exampleFormControlInput1" placeholder="Masukan Nama">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="exampleFormControlInput1" placeholder="Masukan Email">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Masukan Password">
                            <div class="input-group-append">
                                <span id="togglePassword" class="input-group-text" style="cursor: pointer;">
                                    <i class="far fa-eye"></i>
                                </span>
                            </div>
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select id="role" class="form-control  @error('role') is-invalid @enderror" name="role" required>
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('role')
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
                            <label for="edit_nama" class="form-label  @error('name') is-invalid @enderror" >Nama</label>
                            <input type="text" class="form-control" id="edit_nama" name="name">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="mb-3">
                            <label for="edit_alamat" class="form-label @error('email') is-invalid @enderror">Email</label>
                            <input type="text" class="form-control" id="edit_email" name="email">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select id="edit_role" class="form-control  @error('role') is-invalid @enderror" name="role" required>
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('role')
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
            var email = this.getAttribute('data-email');
            var role = this.getAttribute('data-role');


            // Isi input di dalam modal dengan data siswa yang sesuai
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_nama').value = nama;
            document.getElementById('edit_email').value = email;
            document.getElementById('edit_role').value = role;

            // Update action attribute of the form with the correct route
            document.getElementById('editForm').setAttribute('action', '/akun/' + id);

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

                deleteForm.action = '/akun/' + id;
                deleteNama.textContent = nama;

                const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
                deleteModal.show();
            });
        });
    });


</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
  const passwordField = document.getElementById('password');
  const togglePassword = document.getElementById('togglePassword');
  const eyeIcon = togglePassword.querySelector('i');

  togglePassword.addEventListener('click', function() {
      const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordField.setAttribute('type', type);
      eyeIcon.classList.toggle('fa-eye');
      eyeIcon.classList.toggle('fa-eye-slash');
  });
});
  </script>
@endsection
