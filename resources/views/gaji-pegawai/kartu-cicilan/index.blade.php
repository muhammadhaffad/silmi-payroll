@extends('gaji-pegawai.layout.app', ['title' => 'Kartu Cicilan'])
@push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endpush
@section('content')
    <h1 class="h3 mb-2 text-gray-800">Data Kartu Cicilan</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="card-header-action">
                <button class="btn btn-primary btn-action btn-xs mr-1" data-toggle="modal" data-target="#exampleModal"
                    data-toggle="tooltip" title="Tambah Data"><span>Tambah Data</span></button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Karyawan</th>
                            <th>Tanggal</th>
                            <th>Hutang</th>
                            <th>Sisa Piutang</th>
                            <th>Status</th>
                            <th>Action Pembayaran</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($debts as $debt)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$debt->employee->nama}}</td>
                                <td>{{$debt->tanggal}}</td>
                                <td>{{Helper::rupiah($debt->hutang)}}</td>
                                <td>{{Helper::rupiah($debt->sisa_hutang)}}</td>
                                <td>
                                    @if ($debt->sisa_hutang == 0)
                                    <h5>
                                        <span class="text-white badge bg-success">Sudah Lunas</span>
                                    </h5>
                                    @else
                                    <h5>
                                        <span class="text-white badge bg-danger">Belum Lunas</span>
                                    </h5>
                                    @endif
                                </td>
                                <td>
                                    <a class=" btn btn-success btn-xs btn-action" data-toggle="modal"
                                        data-target="#lunasi-{{$debt->id}}"><i class="fas fa-money-bill-wave"></i>
                                        &nbsp; Lunasi
                                    </a>
                                    <div class="modal fade" id="lunasi-{{$debt->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Cicilan</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{url()->to('gaji-pegawai/kartu-cicilan/bayar-cicilan')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="debt_id" value="{{$debt->id}}">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="exampleFormControlInput1">NIP Karyawan</label>
                                                            <input type="text" class="form-control" name="nip"
                                                                value="{{$debt->employee->nip}}" readonly>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="exampleFormControlInput1">Sisa Hutang</label>
                                                            <input type="text" class="form-control" id="hutang"
                                                                name="hutang" value="{{Helper::rupiah($debt->sisa_hutang)}}" readonly>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="exampleFormControlInput1">Tanggal</label>
                                                            <input type="date" class="form-control" id="tanggal"
                                                                name="tanggal" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="exampleFormControlTextarea1">Cicilan</label>
                                                            <input class="form-control" id="cicilan" name="cicilan" autofocus required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary"
                                                            name="submitcicilan">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="" class="mt-2 btn btn-primary btn-xs btn-action" data-toggle="modal"
                                        data-target="#detail-cicilan-{{$debt->id}}"><i class="fas fa-eye"></i>
                                        &nbsp; Detail
                                    </a>
                                    <div class="modal fade" id="detail-cicilan-{{$debt->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Detail Cicilan</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="col-lg-12">
                                                    <span style='font-size:10pt'><b>Detail Karyawan</b></span><br>
                                                    <span>Nama Karyawan : {{$debt->employee->nama}}</span><br>
                                                    <span>Jabatan : {{$debt->employee->jabatan}}</span>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="">
                                                        <table class="table table-bordered"
                                                            cellspacing="0">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Tanggal</th>
                                                                    <th>Cicilan</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse ($debt->debtPayments as $debtPayment)
                                                                <tr>
                                                                    <td>{{$loop->iteration}}</td>
                                                                    <td>{{$debtPayment->tanggal}}</td>
                                                                    <td>{{ Helper::rupiah($debtPayment->cicilan) }}</td>
                                                                    <td>
                                                                        <form action="{{url()->to("gaji-pegawai/kartu-cicilan/hapus-cicilan/$debtPayment->id")}}" method="POST">
                                                                            @csrf
                                                                            <button type="submit" name="submit" class="btn btn-danger btn-xs mr-1" title="Hapus">
                                                                                <i class="fas fa-trash-alt"></i>
                                                                            </button>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                                @empty
                                                                    <tr>
                                                                        <td colspan="4" align="center">Belum bayar cicilan</td>
                                                                    </tr>
                                                                @endforelse
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="">
                                        {{-- <div class="form-group mb-0">
                                            <label for="unduh-cicilan">Unduh:</label>
                                            <form action="" onchange="return this.submit()">
                                                <input type="hidden" name="nip" value="207">
                                                <select class="form-control selectpicker" data-container="body" name="tahun" id="unduh-cicilan">
                                                    <option disabled selected>Pilih Tahun</option>
                                                    @for ($year = (int)date('Y'); $year >= 2010; $year--)
                                                    <option value="{{$year}}">{{ $year }}</option>
                                                    @endfor
                                                </select>
                                            </form>
                                        </div> --}}
                                        <form target="_blank" action="{{ url()->to("gaji-pegawai/kartu-cicilan/download/image/$debt->id") }}" method="post">
                                            @csrf
                                            <button class="btn btn-primary btn-xs mr-1" title="Gambar"><i
                                                    class="fas fa-image"></i>   Copy
                                            </button>
                                        </form>
                                        <form action="{{ url()->to("gaji-pegawai/kartu-cicilan/download/$debt->id") }}" method="post">
                                            @csrf
                                            <button class="btn btn-success btn-xs mr-1 my-2" title="Cetak"><i
                                                    class="fas fa-print"></i>Unduh
                                            </button>
                                        </form>
                                        <form action="{{url()->to("gaji-pegawai/kartu-cicilan/hapus-hutang/$debt->id")}}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus hutang ini?')" method="post">
                                            @csrf
                                            <button class="btn btn-danger btn-xs delete-data mr-1"
                                                title="Hapus"><i class="fas fa-trash-alt"></i>Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">Data Kosong</td>
                            </tr>
                        @endforelse
                        {{-- <tr>
                            <td>1</td>
                            <td>Karyawan 1</td>
                            <td>2023-05-21</td>
                            <td>{{ Helper::rupiah(200000) }}</td>
                            <td>{{ Helper::rupiah(200000) }}</td>
                            <td>
                                <h5>
                                    <span class="text-white badge bg-success">Sudah Lunas</span>
                                </h5>
                            </td>
                            <td>
                                <a href="" class=" btn btn-success btn-xs btn-action" data-toggle="modal"
                                    data-target="#lunasi-207"><i class="fas fa-money-bill-wave"></i>
                                    &nbsp; Lunasi
                                </a>
                                <div class="modal fade" id="lunasi-207" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Tambah Cicilan</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form name="autoSumForm" method="post">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput1">Nama Karyawan</label>
                                                        <input type="text" class="form-control" name="nip"
                                                            value="207" readonly>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput1">Sisa Hutang</label>
                                                        <input type="text" class="form-control" id="hutang"
                                                            name="hutang" value="200000" readonly>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput1">Tanggal</label>
                                                        <input type="date" class="form-control" id="tanggal"
                                                            name="tanggal">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleFormControlTextarea1">Cicilan</label>
                                                        <input class="form-control" id="cicilan" name="cicilan"
                                                            onFocus="startCalc()" onBlur="stopCalc()" autofocus>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary"
                                                        name="submitcicilan">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <a href="" class="mt-2 btn btn-primary btn-xs btn-action" data-toggle="modal"
                                    data-target="#detail-cicilan-207"><i class="fas fa-eye"></i>
                                    &nbsp; Detail
                                </a>
                                <div class="modal fade" id="detail-cicilan-207" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Detail Cicilan</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="col-lg-12">
                                                <span style='font-size:10pt'><b>Detail Karyawan</b></span><br>
                                                <span>Nama Karyawan : Karyawan 1 </span><br>
                                                <span>Jabatan : IT Support </span>
                                            </div>
                                            <div class="modal-body">
                                                <div class="">
                                                    <table class="table table-bordered"
                                                        cellspacing="0">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Tanggal</th>
                                                                <th>Cicilan</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>1</td>
                                                                <td>2023-05-19</td>
                                                                <td>{{ Helper::rupiah(200000) }}</td>
                                                                <td>
                                                                    <form action="delete.php" method="GET">
                                                                        <input type="text" hidden name="nip"
                                                                            value="207">
                                                                        <input type="text" hidden name="id"
                                                                            value="1">
                                                                        <button type="submit" name="submit"
                                                                            class="btn btn-danger btn-xs mr-1"
                                                                            title="Hapus">
                                                                            <i class="fas fa-trash-alt"></i>
                                                                        </button>
                                                                    </form>
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
                            <td>
                                <div class="">
                                    <div class="form-group mb-0">
                                        <label for="unduh-cicilan">Unduh:</label>
                                        <form action="" onchange="return this.submit()">
                                            <input type="hidden" name="nip" value="207">
                                            <select class="form-control selectpicker" data-container="body" name="tahun" id="unduh-cicilan">
                                                <option disabled selected>Pilih Tahun</option>
                                                @for ($year = (int)date('Y'); $year >= 2010; $year--)
                                                <option value="{{$year}}">{{ $year }}</option>
                                                @endfor
                                            </select>
                                        </form>
                                    </div>
                                    <a href="cetak.php?id=" class="btn btn-success btn-xs mr-1 my-2" title="Cetak"><i
                                            class="fas fa-print"></i> &nbsp; Print
                                    </a>
                                    <a href="delete.php?nip=" class="btn btn-danger btn-xs delete-data mr-1"
                                        title="Hapus"><i class="fas fa-trash-alt"></i> &nbsp; Hapus
                                    </a>
                                </div>
                            </td>
                        </tr> --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- MODAL -->

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url()->to('gaji-pegawai/kartu-cicilan/add') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="section-title mt-0">Nama Karyawan </div>
                        <div class="input-group mb-2">
                            <select class="selectpicker form-control" id="karyawan1" name="nip"
                                data-live-search="true" required>
                                @php
                                    $employees = App\Models\Employee::all();
                                @endphp
                                <option disabled selected>Pilih Karyawan</option>
                                @foreach ($employees as $employee)
                                <option value="{{$employee->nip}}">{{$employee->nama}} - {{$employee->jabatan}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="section-title mt-0">Tanggal</div>
                            <div class="input-group mb-2">
                                <input type="date" class="form-control" name="tanggal" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="section-title mt-0">Hutang</div>
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" id="rupiahhutang" name="hutang" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary mr-1" type="submit" name="submit">Simpan</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
@endpush
