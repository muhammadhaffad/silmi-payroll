@extends('gaji-pegawai.layout.app', ['title' => 'Gaji'])
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header bg-primary py-3">
            <h4 class="text-white">Data Gaji</h4>
            <div class="card-header-action">
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Karyawan</th>
                            <th>Devisi</th>
                            <th>T. Tidak Tetap</th>
                            <th>T. Tetap</th>
                            <th>Take Home</th>
                            <th>Copy Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Karyawan 1</td>
                            <td>IT Support</td>
                            <td>{{ Helper::rupiah(200000) }}</td>
                            <td>{{ Helper::rupiah(200000) }}</td>
                            <td>{{ Helper::rupiah(1500000) }}</td>
                            <td>
                                <a href="bagikan.php?id=" class="btn btn-info btn-xs mr-1"
                                    title="copygaji"><i class="fas fa-images"></i>&nbsp;Copy Gaji</a>
                                <a href="bagikanperjam.php?id="
                                    class="btn btn-primary btn-xs mr-1 mt-2" title="copyperjam"><i
                                        class="fas fa-images"></i>&nbsp;Copy Perjam</a>
                            </td>
                            <td>
                                <a href="cetak.php?id=" class="btn btn-danger btn-xs mr-1 text-nowrap"
                                    title="Cetak"><i class="fa fa-file-pdf-o"></i>&nbsp;Print</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
