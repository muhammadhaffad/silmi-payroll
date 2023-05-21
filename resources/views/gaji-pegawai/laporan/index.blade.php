@extends('gaji-pegawai.layout.app', ['title' => 'Laporan'])
@push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endpush
@section('content')
    <div class="card-body mx-auto">
        <div class="row ">
            <div class="col-12">
                <div class="card">
                    <div class="card-header py-3 d-flex align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Rekap Laporan Gaji Bulan ini</h6>
                        <a href="cetakgajidevisi.php" role="button" id="dropdownMenuLink" class="btn btn-success" aria-expanded="false">
                            <i class="fas fa-print"></i> &nbsp; Cetak Gaji Bulan Ini
                        </a>
                    </div>
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="card-body row">
                                    <div class="table-responsive mt-3">
                                        <table class="table table-bordered" width="100%" cellspacing="0">
                                            <thead>
                                                <tr class="bg-dark text-white">
                                                    <th>No</th>
                                                    <th>Devisi</th>
                                                    <th>Total Gaji</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Direksi</td>
                                                    <td>{{ Helper::rupiah(80000000) }}</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>IT Support</td>
                                                    <td>{{ Helper::rupiah(40000000) }}</td>
                                                </tr>
                                                <tr class="bg-danger text-white">
                                                    <td colspan="2">Total Keseluruhan</td>
                                                    <td class="text-right">{{ Helper::rupiah(120000000) }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h4>LAPORAN GAJI DEVISI PER BULAN DAN TAHUN </h4>
                            <div class="card-header-action text-right">
                            </div>
                        </div>
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="card-body">
                                        <form action="cetak.php" method="POST">
                                            <div class="widget-body mt-3">
                                                <div class="form-group">
                                                    <select class="form-control selectpicker" name="devisi" id="devisi" data-live-search="true">
                                                        <option disabled selected>Pilih Devisi</option>
                                                        <option value="IT Support">IT Support
                                                        </option>
                                                    </select>
                                                </div>

                                                <div class="widget-body mt-3">
                                                    <div class="form-group">
                                                        <select class="form-control selectpicker" name="bulan" data-live-search="true">
                                                            <option disabled selected>Pilih Bulan </option>
                                                            @php
                                                                $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustur', 'September', 'Oktober', 'November', 'Desember']
                                                            @endphp
                                                            @foreach ($months as $k => $month)
                                                                <option value="{{ $k + 1 }}">{{ $month }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="widget-body mt-3">
                                                    <div class="form-group">
                                                        <select class="form-control selectpicker" name="tahun" data-live-search="true">
                                                            <option disabled selected>Pilih Tahun </option>
                                                            @for ($year = (int)date('Y'); $year >= 2010; $year--)
                                                            <option value="{{ $year }}">{{ $year }}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-danger mr-1" type="submit" name="pdf">
                                                        <i class="fa fa-file-pdf-o"></i>&nbsp;Cetak PDF
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
@endpush
