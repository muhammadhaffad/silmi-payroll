@extends('gaji-penjahit.layout.app', ['title' => 'Take Home'])
@section('content')
    <h3>Take Home</h3>
    <div class="card">
        <div class="card-header d-flex">
        </div>
        <div class="card-body">
            <form action="" method="get" onchange="return this.submit()">
                <div class="d-flex">
                    <div class="form-group mr-2">
                        <label for="year">Tahun:</label>
                        <select class="form-control" name="year" id="year">
                          @for ($year = 2023; $year <= (int) date('Y'); $year++)
                          <option value="{{$year}}" @selected($year == (request()->year ?? date('Y')))>{{$year}}</option>
                          @endfor
                        </select>
                    </div>
                    @php
                        $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustur', 'September', 'Oktober', 'November', 'Desember']
                    @endphp
                    <div class="form-group">
                        <label for="month">Bulan:</label>
                        <select class="form-control" name="month" id="month">
                          @foreach ($months as $key => $month)
                          <option value="{{$key+1}}" @selected($key+1 == (request()->month ?? date('m')))>{{$month}}</option>
                          @endforeach
                        </select>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Penjahit</th>
                            <th>Total Jahit</th>
                            <th>Kompensasi (%)</th>
                            <th>Kompensasi Total Jahit</th>
                            <th>Total Kebutuhan Jahit</th>
                            <th>Cacat (%)</th>
                            <th>Kompensasi Cacat (%)</th>
                            <th>Kompensasi Cacat</th>
                            <th>Cicilan</th>
                            <th>infaq</th>
                            <th>Bubut</th>
                            <th>Gaji Final</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>
                                AZIZAH
                            </td>
                            <td>{{Helper::rupiah(2000000)}}</td>
                            <td>10%</td>
                            <td>{{Helper::rupiah(200000)}}</td>
                            <td>{{Helper::rupiah(100000)}}</td>
                            <td>1%</td>
                            <td>5%</td>
                            <td>{{Helper::rupiah(100000)}}</td>
                            <td>{{Helper::rupiah(10000)}}</td>
                            <td>{{Helper::rupiah(10000)}}</td>
                            <td>{{Helper::rupiah(10000)}}</td>
                            <td>{{Helper::rupiah(2200000)}}</td>
                            <td class="d-flex">
                                <button class="btn btn-primary btn-xs btn-action mr-1 text-nowrap" title="Buka sebagai gambar" data-toggle="modal" data-target="#editDataJahit-1">
                                    <i class="fas fa-image">
                                    </i> Gaji
                                </button>
                                <button class="btn btn-danger btn-xs delete-data mr-1 text-nowrap" title="Buka sebagai file">
                                    <i class="fas fa-file-pdf"></i> Gaji
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
