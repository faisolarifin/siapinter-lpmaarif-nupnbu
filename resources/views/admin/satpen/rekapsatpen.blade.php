@extends('template.layout', [
    'title' => 'SIAPIN - Table'
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
                <li><a href="#"><span class=" fa fa-info-circle"> </span> Satpen</a></li>
                <li><a href="#"><span class="fa fa-snowflake-o"></span> Rekap Satpen</a></li>
            </ul>
        </nav>

        <div class="card w-100">
            <div class="card-body pt-3">

                <div class="d-flex justify-content-between align-items-center mt-2 mb-3">
                    <div>
                        <h5 class="mb-0">Rekap Satpen</h5>
                        <small>data satpen yang telah diterima</small>
                    </div>

                    <form class="d-flex align-items-end form-filter">
                        <div class="me-2">
                            <select class="form-select form-select-sm" name="provinsi">
                                <option value="">PROVINSI</option>
                                @foreach($propinsi as $row)
                                    <option value="{{ $row->id_prov }}" {{ $row->id_prov == request()->provinsi ? 'selected' : '' }}>{{ $row->nm_prov }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="me-2">
                            <select class="form-select form-select-sm" name="kabupaten">
                                <option value="">KABUPATEN</option>
                                @foreach($kabupaten as $row)
                                    <option value="{{ $row->id_kab }}" {{ $row->id_kab == request()->kabupaten ? 'selected' : '' }}>{{ $row->nama_kab }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="me-2">
                            <select class="form-select form-select-sm" name="jenjang">
                                <option value="">JENJANG</option>
                                @foreach($jenjang as $row)
                                    <option value="{{ $row->id_jenjang }}" {{ $row->id_jenjang == request()->jenjang ? 'selected' : '' }}>{{ $row->nm_jenjang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="me-2">
                            <select class="form-select form-select-sm" name="kategori">
                                <option value="">KATEGORI</option>
                                @foreach($kategori as $row)
                                    <option value="{{ $row->id_kategori }}" {{ $row->id_kategori == request()->kategori ? 'selected' : '' }}>{{ $row->nm_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                        </div>

                    </form>
                </div>

                <table class="table table-bordered" id="mytable">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">No. Registrasi</th>
                        <th scope="col">Nama Satpen</th>
                        <th scope="col">Yayasan</th>
                        <th scope="col">Jenjang</th>
                        <th scope="col">Provinsi</th>
                        <th scope="col">Kabupaten</th>
                        <th scope="col">Aktif</th>
                        <th scope="col">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($no=0)
                    @php($today=\Carbon\Carbon::now())
                    @foreach($satpenProfile as $row)
                        @php($diff = $today->diffInMonths(\Carbon\Carbon::parse($row->tgl_registrasi)))
                        <tr class="{{ $row->status == 'expired' ? 'expired' : '' }}">
                            <td>{{ ++$no }}</td>
                            <td>{{ $row->kategori->nm_kategori }}</td>
                            <td>{{ $row->no_registrasi }}</td>
                            <td>{{ $row->nm_satpen }}</td>
                            <td>{{ $row->yayasan }}</td>
                            <td>{{ $row->jenjang->nm_jenjang }}</td>
                            <td>{{ $row->provinsi->nm_prov }}</td>
                            <td>{{ $row->kabupaten->nama_kab }}</td>
                            <td>{{ $diff .' bln' }}</td>
                            <td>
                                <a href="{{ route('a.rekapsatpen.detail', $row->id_satpen) }}">
                                    <button class="btn btn-sm btn-info"><i class="ti ti-eye"></i></button></a>
                                <button class="btn btn-sm btn-danger"><i class="ti ti-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('assets/libs/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables/dataTables.bootstrap5.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('#mytable').DataTable();
    });
</script>
@endsection