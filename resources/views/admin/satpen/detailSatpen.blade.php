@extends('template.layout', [
    'title' => 'Sipinter Admin - Detail Satuan Pendidikan'
])

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/timeline.css') }}" />
@endsection

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
                    <li><a href="#"><span class="fa fa-snowflake-o"></span> Detail</a></li>
                </ul>
            </nav>

            @include('template.alert')

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title fw-semibold mb-1">DETAIL SATPEN</h5>
                            <small>detail profile satuan pendidikan</small>
                        </div>
                        <div>
                            <a href="{{ route('a.rekapsatpen') }}" class="btn btn-sm btn-info">back
                                <i class="ti ti-chevrons-right"></i></a>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-5" style="overflow-x:auto;">
                            <table>

                                <tbody>
                                <tr>
                                    <td width="140">NPSN</td>
                                    <td width="30">:</td>
                                    <td>{{ $satpenProfile->npsn }}</td>
                                </tr>
                                <tr>
                                    <td>No. Registrasi</td>
                                    <td>:</td>
                                    <td>{{ $satpenProfile->no_registrasi }}</td>
                                </tr>
                                <tr>
                                    <td>Nama Satpen</td>
                                    <td>:</td>
                                    <td>{{ $satpenProfile->nm_satpen }}</td>
                                </tr>
                                <tr>
                                    <td>Jenjang Pendidikan</td>
                                    <td>:</td>
                                    <td>{{ $satpenProfile->jenjang->nm_jenjang }}</td>
                                </tr>
                                <tr>
                                    <td>Kategori Satpen</td>
                                    <td>:</td>
                                    <td>{{ $satpenProfile->kategori?->nm_kategori }}</td>
                                </tr>
                                <tr>
                                    <td>Yayasan</td>
                                    <td>:</td>
                                    <td>{{ $satpenProfile->yayasan }}</td>
                                </tr>
                                <tr>
                                    <td>Kepala Sekolah</td>
                                    <td>:</td>
                                    <td>{{ $satpenProfile->kepsek }}</td>
                                </tr>
                                <tr>
                                    <td>Tahun Berdiri</td>
                                    <td>:</td>
                                    <td>{{ $satpenProfile->thn_berdiri }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>:</td>
                                    <td>{{ $satpenProfile->email }}</td>
                                </tr>
                                <tr>
                                    <td>Telpon</td>
                                    <td>:</td>
                                    <td>{{ $satpenProfile->telpon }}</td>
                                </tr>
                                <tr>
                                    <td>Fax</td>
                                    <td>:</td>
                                    <td>{{ $satpenProfile->fax }}</td>
                                </tr>
                                <tr>
                                    <td>Provinsi</td>
                                    <td>:</td>
                                    <td>{{ $satpenProfile->provinsi->nm_prov }}</td>
                                </tr>
                                <tr>
                                    <td>Kabupaten</td>
                                    <td>:</td>
                                    <td>{{ $satpenProfile->kabupaten->nama_kab }}</td>
                                </tr>
                                <tr>
                                    <td>Cabang</td>
                                    <td>:</td>
                                    <td>{{ $satpenProfile->cabang->nama_pc }}</td>
                                </tr>
                                <tr>
                                    <td>Kecamatan</td>
                                    <td>:</td>
                                    <td>{{ $satpenProfile->kecamatan }}</td>
                                </tr>
                                <tr>
                                    <td>Kelurahan/Desa</td>
                                    <td>:</td>
                                    <td>{{ $satpenProfile->kelurahan }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td>{{ $satpenProfile->alamat }}</td>
                                </tr>
                                <tr>
                                    <td>Aset Tanah</td>
                                    <td>:</td>
                                    <td>{{ $satpenProfile->aset_tanah }}</td>
                                </tr>
                                <tr>
                                    <td>Nama Pemilik</td>
                                    <td>:</td>
                                    <td>{{ $satpenProfile->nm_pemilik }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-7 d-flex flex-column justify-content-between">
                            <div class="row">
                                <div class="col-sm-6 px-3">
                                    <h5 class="mb-2 fs-4">File Pendukung</h5>
                                    @foreach($satpenProfile->filereg as $row)
                                    <div class="mb-3 px-3 py-2 card-box-detail">
                                        <h6 class="text-capitalize">{{$row->mapfile}}</h6>
                                        <p class="mb-1">{{$row->nm_lembaga}} {{$row->daerah}}</p>
                                        <p>Nomor : {{$row->nomor_surat}}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small>Tanggal {{\App\Helpers\Date::tglMasehi($row->tgl_surat)}}</small>
                                            <a href="{{route('viewerpdf', $row->filesurat)}}" target="_blank"><span class="badge fs-2 bg-primary">Lihat PDF</span></a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="col-sm-6 d-flex flex-column justify-content-between">
                                    <div style="max-height:35rem;overflow:auto;">
                                        <ul class="timeline">
                                            @foreach($satpenProfile->timeline as $row)
                                            <li>
                                                <a href="#" class="text-capitalize">{{ $row->status_verifikasi}}</a>
                                                <p class="mb-0">{{ $row->tgl_status }}</p>
                                                <small>{{ $row->keterangan }}</small>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @if(!in_array(auth()->user()->role, ["admin wilayah", "admin cabang"]))
                                    <div class="col px-5 py-2 text-end">
                                        <form class="d-inline extendBtn" action="{{ route('a.satpen.changestatus', $satpenProfile->id_satpen) }}"
                                              method="post">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status_verifikasi" value="perpanjangan">
                                            <button type="submit" class="btn btn-info mx-2"><i class="ti ti-explicit"></i> Perpanjangan</button>
                                        </form>

                                        <form class="d-inline usangBtn" action="{{ route('a.satpen.changestatus', $satpenProfile->id_satpen) }}"
                                              method="post">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status_verifikasi" value="expired">
                                            <button type="submit" class="btn btn-danger mx-2"><i class="ti ti-exchange"></i> Usangkan Dokumen</button>
                                        </form>

                                        <form action="{{ route('a.rekapsatpen.destroy', $satpenProfile->id_satpen ) }}" method="post" class="d-inline deleteBtn">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger mx-2"><i class="ti ti-trash"></i> Destroy Satpen</button>
                                        </form>
                                    </div>
                                @endif
                            </div>

                        </div>

                    </div>
                    <div class="row border-2 border-top pt-3 mt-2 mx-sm-2">
                        <div class="col-sm-5 d-flex justify-content-center align-items-md-center text-center">
                            <div class="file-download-box">
                                <p class="mb-3">Piagam LP Ma'arif</p>
                                <a href="{{ route('pdf.generated', ["type"=> $satpenProfile->file[0]->typefile, "fileName" => $satpenProfile->file[0]->nm_file]) }}" target="_blank" href="{{ route('pdf.generated', ["type"=> $satpenProfile->file[0]->typefile, "fileName" => $satpenProfile->file[0]->nm_file.".pdf"]) }}" target="_blank" class="btn btn-sm btn-primary"><i class="ti ti-eye"></i>
                                    tampil</a>
                            </div>
                            <div class="file-download-box">
                                <p class="mb-3">SK Satuan Pendidikan</p>
                                <a href="{{ route('pdf.generated', ["type"=> $satpenProfile->file[1]->typefile, "fileName" => $satpenProfile->file[1]->nm_file]) }}" target="_blank" class="btn btn-sm btn-primary"><i class="ti ti-eye"></i>
                                    tampil</a>
                            </div>
                        </div>
                        <div class="col-sm-7 d-flex justify-content-center align-items-md-end">
                            <table class="table table-bordered w-50 text-center my-0">
                                <thead>
                                <tr>
                                    <th>Status Registrasi</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="text-capitalize">{{ $satpenProfile->timeline[sizeof($satpenProfile->timeline) - 1]->status_verifikasi }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(".deleteBtn").on('click', function () {
            if (confirm("benar anda akan menghapus data?")) {
                return true;
            }
            return false;
        });

        $(".usangBtn").on('click', function () {
            if (confirm("benar anda akan mengusangkan dokumen?")) {
                return true;
            }
            return false;
        });

        $(".extendBtn").on('click', function () {
            if (confirm("benar anda akan memperpanjang dokumen?")) {
                return true;
            }
            return false;
        });
    </script>
@endsection
