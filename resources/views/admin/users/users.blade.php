@extends('template.layout', [
    'title' => 'Siapintar - Data Users'
])

@section('navbar')
    @include('template.navadmin')
@endsection

@section('container')
<!--  Row 1 -->
<div class="row container-begin">
    <div class="col-sm-12">

        <nav class="mt-2 mb-4" aria-label="breadcrumb">
            <ul id="breadcrumb" class="mb-0">
                <li><a href="#"><i class="ti ti-home"></i></a></li>
                <li><a href="#"><span class=" fa fa-info-circle"> </span> Manajemen User</a></li>
                <li><a href="#"><span class="fa fa-snowflake-o"></span> Users</a></li>
            </ul>
        </nav>

        @include('template.alert')

        <div class="card w-100">
            <div class="card-body pt-3">

                <div class="d-flex justify-content-between align-items-sm-center mt-2 mb-3">
                    <div>
                        <h5 class="mb-0">Data Users</h5>
                        <small>list akun admin</small>
                    </div>
                    <div>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalFormBackdrop">
                            <i class="ti ti-plus"></i> Admin Baru</button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover" id="mytable">
                        <thead>
                        <tr>
                            <th scope="col" width="40">#</th>
                            <th scope="col">Nama User</th>
                            <th scope="col">Username</th>
                            <th scope="col">Role</th>
                            <th scope="col">Status Akun</th>
                            <th scope="col" width="100">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($no=0)
                        @foreach($usersAdmin as $row)
                            <tr>
                                <td>{{ ++$no }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->username }}</td>
                                <td>{{ strtoupper($row->role) }}</td>
                                <td><span class="badge {{ $row->status_active == 'active' ? 'bg-success' : 'bg-danger' }}">{{ $row->status_active }}</span></td>
                                <td>
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalFormUpdateBackdrop" data-bs="{{ $row->id_user }}">
                                        <i class="ti ti-edit"></i></button>
                                    <form action="{{ route('users.destroy', $row->id_user) }}" method="post" class="d-inline deleteBtn">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="ti ti-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection


@section('modals')

    <!-- Modal Tambah -->
    <div class="modal fade" id="modalFormBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content rounded-2">
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title mb-0" id="exampleModalLabel">Buat Akun Admin</h5>
                        <small>tambahkan akun administrator baru</small>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('users.store') }}" method="post">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-2">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                            <div class="invalid-feedback">
                                @error('name') {{ $message }} @enderror
                            </div>
                        </div>
                        <div class="mb-2">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control form-control-sm @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}">
                            <div class="invalid-feedback">
                                @error('username') {{ $message }} @enderror
                            </div>
                        </div>
                        <div class="mb-2">
                            <label for="role" class="form-label">Role</label>
                            <select name="role" id="role" class="form-select form-select-sm @error('role') is-invalid @enderror">
                                <option value="super admin">Super Admin</option>
                                <option value="admin pusat">Admin Pusat</option>
                                <option value="admin wilayah">Admin Wilayah</option>
                                <option value="admin cabang">Admin Cabang</option>
                            </select>
                            <div class="invalid-feedback">
                                @error('role') {{ $message }} @enderror
                            </div>
                        </div>
                        <div class="mb-2">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password') }}">
                            <div class="invalid-feedback">
                                @error('password') {{ $message }} @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal Tambah -->

    <!-- Modal Edit -->
    <div class="modal fade" id="modalFormUpdateBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content rounded-2">
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title mb-0" id="exampleModalLabel">Ubah Propinsi</h5>
                        <small>koreksi kesalahan propinsi</small>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        @csrf
                        @method('PUT')
                        <div class="mb-2">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                            <div class="invalid-feedback">
                                @error('name') {{ $message }} @enderror
                            </div>
                        </div>
                        <div class="mb-2">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control form-control-sm @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}">
                            <div class="invalid-feedback">
                                @error('username') {{ $message }} @enderror
                            </div>
                        </div>
                        <div class="mb-2">
                            <label for="role" class="form-label">Role</label>
                            <select name="role" id="role" class="form-select form-select-sm @error('role') is-invalid @enderror">
                                <option value="super admin">Super Admin</option>
                                <option value="admin pusat">Admin Pusat</option>
                                <option value="admin wilayah">Admin Wilayah</option>
                                <option value="admin cabang">Admin Cabang</option>
                            </select>
                            <div class="invalid-feedback">
                                @error('role') {{ $message }} @enderror
                            </div>
                        </div>
                        <div class="mb-2">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" id="password" name="password" placeholder="kosongkan jika tidak ingin mengganti password" value="{{ old('password') }}">
                            <div class="invalid-feedback">
                                @error('password') {{ $message }} @enderror
                            </div>
                        </div>
                        <div class="mb-2">
                            <label for="status" class="form-label">Status Akun</label>
                            <select name="status" id="status" class="form-select form-select-sm @error('status') is-invalid @enderror">
                                <option value="active">Active</option>
                                <option value="block">Block</option>
                            </select>
                            <div class="invalid-feedback">
                                @error('status') {{ $message }} @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal Edit -->

@endsection


@section('scripts')
<script src="{{asset('assets/libs/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables/dataTables.bootstrap5.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('#mytable').DataTable();
    });

    $(".deleteBtn").on('click', function () {
        if (confirm("benar anda akan menghapus data?")) {
            return true;
        }
        return false;
    })

    let modalFormUpdateBackdrop = document.getElementById('modalFormUpdateBackdrop')
    modalFormUpdateBackdrop.addEventListener('show.bs.modal', function (event) {

        let userId = event.relatedTarget.getAttribute('data-bs')

        $("#modalFormUpdateBackdrop form").attr("action", "{{ route('users.update', ':param') }}".replace(':param', userId));
        $.ajax({
            url: "{{ route('users.show', ':param') }}".replace(':param', userId),
            type: "GET",
            dataType: 'json',
            success: function (res) {
                $("input[name='name']").val(res.name);
                $("input[name='username']").val(res.username);
                $("select[name='role']").val(res.role);
                $("select[name='status']").val(res.status_active);
            }
        });
    });

</script>
@endsection
