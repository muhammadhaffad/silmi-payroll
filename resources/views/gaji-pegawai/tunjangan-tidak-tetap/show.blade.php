@extends('gaji-pegawai.layout.app', ['title' => 'Tunjangan Tidak Tetap'])
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <div>
                @php
                    $employee = App\Models\Employee::where('nip', $nip)->first()->load('variableAllowance');
                @endphp
                <span class="d-block" style='font-size:20pt'><b>Detail Karyawan</b></span>
                <span class="d-block" style="font-size:15pt">Nama Karyawan : {{$employee->nama}}</span>
                <span class="d-block" style="font-size:15pt">Jabatan : {{$employee->jabatan}}</span>    
            </div>
            <div class="card-header-action text-right">
                <a href="{{ url()->to("gaji-pegawai/tunjangan/tidak-tetap/$nip/print") }}" class="btn btn-primary btn-action btn-xs mr-1"
                    title="CETAK"><i class="fas fa-print"></i>
                    <span> &nbsp; CETAK </span>
                </a>
                <a href="index.php" class="btn btn-outline-primary btn-action btn-xs mr-1" title="kembali"><span>Kembali</span></a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Hari</th>
                            <th>Tanggal</th>
                            <th>Scan 1</th>
                            <th>Scan 2</th>
                            <th>Scan 3</th>
                            <th>Scan 4</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($attendances as $attendance)   
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{\Carbon\Carbon::parse($attendance->tanggal)->format('l')}}</td>
                                <td>{{$attendance->tanggal}}</td>
                                <td>{{$attendance->scan_1}}</td>
                                <td>{{$attendance->scan_2}}</td>
                                <td>{{$attendance->scan_3}}</td>
                                <td>{{$attendance->scan_4}}</td>
                                <td>{{Helper::rupiah($attendance->total_jam * $employee->variableAllowance->perjam)}}</td>
                            </tr>
                        @empty
                            
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>
                                Total Keseluruhan
                            </td>
                            <td colspan="7" class="text-success text-right">{{ Helper::rupiah($attendances->sum('total_jam') * $employee->variableAllowance->perjam) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
