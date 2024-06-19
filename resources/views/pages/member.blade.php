@extends('app')

@section('title', 'Pendaftaran')

@section('content')
<div class="container-fluid">
     <!-- Page Heading -->
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pendaftaran Extrakurikuler</h1>
    </div>

    <div class="card shadow  mb-4">
        <div class="card-header bg-warning">  <h6 class="m-0 font-weight-bold text-primary">Form Pendaftaran</h6></div>
        <div class="card-body">
            <form action="{{ route('membercreate') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="siswa"> Pilih Siswa </label>
                    <select name="id_siswa" class="form-control mb-3" aria-label="Large select example" required>
                        <option selected>Pilih Siswa</option>
                        @if($siswa->isNotEmpty())
                        @foreach ($siswa as $item )
                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                        @else
                        <option selected>Semua Siswa Telah Terdaftar</option>
                        @endif
                      </select>
                      @error('id_siswa')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-3">
                    <label for="siswa"> Pilih Ekstrakurikuler </label>
                    <select name="id_extrakurikuler" class="form-control mb-3" aria-label="Large select example" required>
                        <option selected>Pilih Extrakurikuler</option>
                        @foreach ($extra as $item )
                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                      </select>
                       @error('id_extrakurikuler')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                   <div class="d-flex justify-content-end">
                    @if (request()->has('search'))
                    <a type="submit" id="submitButton" href="{{ route('member') }}" class="btn btn-success text-end">
                        <i class="fas fa-arrow-alt-circle-left fa-sm text-white-50" data-toggle="modal" data-target="#myModal"></i> Kembali Untuk Mendaftar</a>
                    @else
                    <button type="submit" id="submitButton" class="btn btn-primary text-end ">Daftar</button>
                    @endif
                </div>
            </form>
        </div>
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
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
         <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-warning">
            <h6 class="m-0 font-weight-bold text-primary">Table Data Member</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('member') }}" method="GET" id="formSearch">
                <div class=" mb-3">
                    <label for="search">Cari Berdasarkan Ekstrakurikuler</label>
                    <select name="search" class="form-control mb-3" aria-label="Large select example" id="selectSearch">
                        <option selected disabled>Pilih Extrakurikuler</option>
                        @foreach ($extra as $item)
                    <option value="{{ $item->id }}" {{ request('search') == $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
                @endforeach
                      </select>

                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Nomor Hp</th>
                            <th>Jenis Eskul</th>
                            <th>Aksi</th>

                        </tr>
                    </thead>
                    <tbody>
                        @if($member->isNotEmpty())
                        @foreach ($member as $data)
                            <tr>
                                <td>{{ $data->nama }}</td>
                                <td>{{ $data->nomor_hp }}</td>
                                <td>
                                    @foreach($data->extrakurikulers as $extra)
                                        {{ $extra->nama }}<br>
                                    @endforeach
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-edit"
                                        data-id="{{ $data->id }}"
                                        data-nama="{{ $data->nama }}"
                                        data-ekstrakurikuler-ids="{{ $data->extrakurikulers->pluck('id')->implode(',') }}"
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
                <div class="d-flex justify-content-end">

            </div>

        </div>
    </div>
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
                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="edit_id" name="id">
                        <div class="mb-2">
                            <label for="edit_nama">Nama</label>
                            <input type="text" class='form-control' id="edit_nama" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="siswa"> Pilih Ekstrakurikuler </label>
                            <select name="id_ekstrakurikuler" class="form-control mb-3" aria-label="Large select example" >




                                @foreach ($update as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->nama }}
                                    </option>
                                @endforeach


                              </select>
                               @error('id_extrakurikuler')
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

@endsection


@section('script')

<script>
// Modal Update
document.addEventListener('DOMContentLoaded', function () {
        // Handle edit button click
        document.querySelectorAll('.btn-edit').forEach(button => {
            button.addEventListener('click', function () {
                const memberId = this.getAttribute('data-id');
                const memberName = this.getAttribute('data-nama');
                const extraIds = this.getAttribute('data-ekstrakurikuler-ids').split(',');

                // Set form action
                const form = document.getElementById('editForm');
                form.action = `/member/${memberId}`;

                // Fill form inputs
                document.getElementById('edit_id').value = memberId;
                document.getElementById('edit_nama').value = memberName;

                // Set selected options in the multi-select
                const select = document.getElementById('edit_extra');
                for (let option of select.options) {
                    option.selected = extraIds.includes(option.value);
                }

                // Show the modal
                $('#editModal').modal('show');
            });
        });

        // Handle form submission
        document.getElementById('submitEditButton').addEventListener('click', function () {
            document.getElementById('editForm').submit();
        });
    });


// Delete

document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.btn-delete');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const nama = this.getAttribute('data-nama');

                const deleteForm = document.getElementById('deleteForm');
                const deleteNama = document.getElementById('deleteNama');

                deleteForm.action = '/member/' + id;
                deleteNama.textContent = nama;

                const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
                deleteModal.show();
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const selectSearch = document.getElementById('selectSearch');
        selectSearch.addEventListener('change', function() {
            document.getElementById('formSearch').submit();
        });
    });
</script>
@endsection
