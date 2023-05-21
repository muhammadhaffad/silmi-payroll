@extends('gaji-pegawai.layout.app', ['title' => 'Tunjangan Tidak Tetap'])
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <div>
                <span class="d-block" style='font-size:20pt'><b>Detail Karyawan</b></span>
                <span class="d-block" style="font-size:15pt">Nama Karyawan : Karyawan 1</span>
                <span class="d-block" style="font-size:15pt"> Jabatan : IT Support </span>    
            </div>
            <div class="card-header-action text-right">
                <a href="cetak.php?id=207" class="btn btn-primary btn-action btn-xs mr-1"
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
                        <tr>
                            <td>1</td>
                            <td>Senin</td>
                            <td>2023-05-19</td>
                            <td>7:30:15</td>
                            <td>16:05:15</td>
                            <td>00:00:00</td>
                            <td>00:00:00</td>
                            <td>7 Jam 25 Menit 0 Detik</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>
                                Total Keseluruhan
                            </td>
                            <td colspan="7" class="text-success text-right">{{ Helper::rupiah(200000) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
