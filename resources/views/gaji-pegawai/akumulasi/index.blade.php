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
                                                <tr>
                                                    <td>1</td>
                                                    <td>Direksi</td>
                                                    <td>2023</td>
                                                    <td>{{ Helper::rupiah(1500000) }}</td>
                                                    <td>
                                                        <a href="" class=" btn btn-success btn-xs btn-action mr-1" data-toggle="modal" data-target="#devisi-direksi">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <div class="modal fade" id="devisi-direksi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>No</th>
                                                                                        <th>Bulan</th>
                                                                                        <th>Total Gaji</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td>1</td>
                                                                                        <td>Januari</td>
                                                                                        <td>{{ Helper::rupiah(20000000) }}</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>2</td>
                                                                                        <td>Februari</td>
                                                                                        <td>{{ Helper::rupiah(20000000) }}</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>3</td>
                                                                                        <td>Maret</td>
                                                                                        <td>{{ Helper::rupiah(20000000) }}</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td colspan="2">Total</td>
                                                                                        <td>
                                                                                            {{ Helper::rupiah(60000000) }}
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>IT Support</td>
                                                    <td>2023</td>
                                                    <td>{{ Helper::rupiah(20000000) }}</td>
                                                    <td>
                                                        <a href="" class=" btn btn-success btn-xs btn-action mr-1" data-toggle="modal" data-target="#devisi-1">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <div class="modal fade" id="devisi-1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>No</th>
                                                                                        <th>Bulan</th>
                                                                                        <th>Total Gaji</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td>1</td>
                                                                                        <td>Januari</td>
                                                                                        <td>{{ Helper::rupiah(20000000) }}</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>2</td>
                                                                                        <td>Februari</td>
                                                                                        <td>{{ Helper::rupiah(20000000) }}</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>3</td>
                                                                                        <td>Maret</td>
                                                                                        <td>{{ Helper::rupiah(20000000) }}</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td colspan="2">Total</td>
                                                                                        <td>
                                                                                            {{ Helper::rupiah(60000000) }}
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="bg-danger text-white">
                                                    <td colspan="3">Total Keseluruhan</td>
                                                    <td class="text-right" colspan="1">
                                                        {{ Helper::rupiah(40000000) }}
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
