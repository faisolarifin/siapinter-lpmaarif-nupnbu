@extends('template.layout', [
    'title' => 'Siapinter - Dashboard Operator'
])

@section('navbar')
    @include('template.nav')
@endsection

@section('container')

<nav class="mt-2 mb-4" aria-label="breadcrumb">
    <ul id="breadcrumb" class="mb-0">
        <li><a href="#"><i class="ti ti-home"></i></a></li>
        <li><a href="#"><span class=" fa fa-info-circle"> </span> Home</a></li>
        <li><a href="#"><span class="fa fa-snowflake-o"></span> Dashboard</a></li>
    </ul>
</nav>

@include('template.alert')

@if($usingVNPSN > 0)

    <!-- Modal -->
    <div class="modal fade" id="toggleMyModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger mb-0">
                        <div class="d-flex align-items-center">
                            <i class="ti ti-alert-circle fs-6"></i>
                            <div class=" ms-2">
                                <p class="mb-0">Satuan pendidikan anda masih menggunakan NPSN Virtual. Silahkan perbaharui NPSN satuan pendidikan anda menggunakan nomor nasional !</p>
                                <p class="mb-0">Untuk pembaharuan NPSN satuan pendidikan dapat dilakukan <a href="{{ route('mysatpen')."#changenpsn" }}"><span class="badge bg-primary">disini</span></a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            let myModal = new bootstrap.Modal(document.getElementById('toggleMyModal'), {})
            myModal.toggle()
        </script>
    @endsection
@endif

<div class="row">
    <div class="col-lg-8 d-flex align-items-strech">
        <div class="card w-100 shadow-none">
            <div class="card-body py-3">
                <p class="mb-2">Halo,</p>
                <h4>Operator {{ $mySatpen->nm_satpen }}</h4>
            </div>
        </div>
    </div>
    <div class="col-lg-4 d-flex align-items-strech">
        <div class="card w-100 shadow-none">
            <div class="card-body py-3">
                <p class="mb-2">Tanggal Registrasi</p>
                <h4>{{ Date::tglMasehi($mySatpen->tgl_registrasi) }}</h4>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12 d-flex align-items-strech">
        <div class="card w-100 shadow-none">
            <div class="card-body py-4 text-center">
                <div class="row short-profile">
                    <div class="col-sm-4">
                        <i class="ti ti-number"></i>
                        <p class="mb-2">Nomor Registrasi</p>
                        <h5>{{ $mySatpen->no_registrasi }}</h5>
                    </div>
                    <div class="col-sm-4">
                        <i class="ti ti-building"></i>
                        <p class="mb-2">Nama Satpen</p>
                        <h5>{{ $mySatpen->nm_satpen }}</h5>
                    </div>
                    <div class="col-sm-4">
                        <i class="ti ti-category"></i>
                        <p class="mb-2">Kategori</p>
                        <h5>{{ $mySatpen->kategori->nm_kategori }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!--  Row 1 -->
<div class="row mb-sm-4">
    <div class="col-lg-4">
        <div class="card overflow-hidden">
            <div class="card-body p-4">
                <h5 class="card-title mb-9 fw-semibold">Piagam Registrasi</h5>
                <div class="d-flex py-3 px-2 col-file-dash">
                    @if($mySatpen->status == "setujui")
                    <h6>{{ $mySatpen->file[0]->nm_file }}</h6>
                    <div class="ms-sm-2">
                        <a href="{{ route('download', 'piagam') }}" class="btn btn-primary"><i class="ti ti-download"></i></a>
                    </div>
                    @else
                        <h6 class="mb-0">File not found!</h6>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card overflow-hidden">
            <div class="card-body p-4">
                <h5 class="card-title mb-9 fw-semibold">SK Satuan Pendidikan</h5>
                <div class="d-flex py-3 px-2 col-file-dash">
                    @if($mySatpen->status == "setujui")
                    <h6>{{ $mySatpen->file[1]->nm_file }}</h6>
                    <div class="ms-sm-2">
                        <a href="{{ route('download', 'sk') }}" class="btn btn-primary"><i class="ti ti-download"></i></a>
                    </div>
                    @else
                        <h6 class="mb-0">File not found!</h6>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card overflow-hidden">
            <div class="card-body p-4">
                <h5 class="card-title mb-9 fw-semibold text-center">Status Registrasi</h5>
                <div class="row text-center">
                    <div class="col-12 py-3">
                        <h6 class="text-uppercase mb-1">{{ $mySatpen->timeline[sizeof($mySatpen->timeline) - 1]->status_verifikasi }}</h6>
                        <p class="mb-0">{{ Date::tglMasehi($mySatpen->timeline[sizeof($mySatpen->timeline) - 1]->tgl_status) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
