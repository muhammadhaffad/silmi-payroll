@extends('gaji-pegawai.layout.app', ['title' => 'Akumulasi Gaji'])
@section('content')
    <div class="card-body mx-auto">
        <div class="row ">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white d-flex justify-content-between">
                        <h4>Akumulasi Gaji Semua Devisi Tahun {{ request()->get('tahun') ?? date('Y') }}</h4>
                        <div class="card-header-action text-right">
                            <div class="card-header-action">
                                <a href="cetakgajidevisi.php?tahun={{ request()->get('tahun') }}" role="button" id="dropdownMenuLink"
                                    class="btn btn-success" aria-expanded="false"><i class="fas fa-print"></i> &nbsp; Cetak
                                    Gaji Tahun Ini
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="card-body row">
                                    <div>
                                        <form method="GET" action="" onchange="this.submit()">
                                            <span>Pilih Tahun</span>
                                            <div class="input-group form-group">
                                                <select class="custom-select" name="tahun">
                                                    <option disabled selected>Pilih Tahun </option>
                                                    @for ($year = (int)date('Y'); $year >= 2010; $year--)
                                                        <option value="{{ $year }}" @selected(request()->get('tahun') == $year)>{{ $year }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="table-responsive mt-3">
                                        <table class="table table-bordered" width="100%" cellspacing="0">
                                            <thead>
                                                <tr class="bg-dark text-white">
                                                    <th>No</th>
                                                    <th>Devisi</th>
                                                    <th>Tahun</th>
                                                    <th>Total Gaji</th>
                                                    <th>Detail</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $allTotal = 0;
                                                @endphp
                                                @foreach ($reports as $devision => $report)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$devision}}</td>
                                                    <td>{{request()->tahun}}</td>
                                                    <td>{{ Helper::rupiah($report->sum('jumlah')) }}</td>
                                                    @php
                                                        $allTotal += $report->sum('jumlah');
                                                    @endphp
                                                    <td>
                                                        <a href="" class="btn btn-success btn-xs btn-action mr-1" data-toggle="modal" data-target="#devisi-{{$devision}}">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <div class="modal fade" id="devisi-{{$devision}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            Detail Akumulasi Devisi Direksi</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="">
                                                                            <table class="table table-bordered" width="100%" cellspacing="0">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>No</th>
                                                                                        <th>Bulan</th>
                                                                                        <th>Total Gaji</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                @php
                                                                                    $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                                                                @endphp
                                                                                <tbody>
                                                                                    @foreach ($report as $row)
                                                                                    <tr>
                                                                                        <td>{{$loop->iteration}}</td>
                                                                                        <td>{{$bulan[$row->bulan-1]}}</td>
                                                                                        <td>{{ Helper::rupiah($row->jumlah) }}</td>
                                                                                    </tr>
                                                                                    @endforeach
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                <tr class="bg-danger text-white">
                                                    <td colspan="3">Total Keseluruhan</td>
                                                    <td class="text-right" colspan="1">
                                                        {{ Helper::rupiah($allTotal) }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
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
