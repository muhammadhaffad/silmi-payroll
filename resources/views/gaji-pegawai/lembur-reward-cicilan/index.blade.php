@extends('gaji-pegawai.layout.app', ['title' => 'Lembur Reward Cicilan'])
@push('style')
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endpush
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 ">
            <div class="card-header-action">
                <h3>Data Lembur Reward Cicilan</h3>
                <!-- <button class="btn btn-info text-right btn-action btn-xs mr-1" data-toggle="modal" data-target="#exampleModal" data-toggle="tooltip" title="Tambah Data"><i class="fas fa-plus"></i> &nbsp; <span>Tambah Data</span></button> -->
                <div class="d-flex">
                    <button class="btn btn-success btn-action btn-xs mr-1" data-toggle="modal" data-target="#exampleModal3"
                        data-toggle="tooltip" title="Tambah Data"><i class="fas fa-upload"></i> &nbsp; <span>Upload File
                            Excel</span></button>
                    <form action="{{ url()->to('/gaji-pegawai/tunjangan/lembur-reward-cicilan/remove-all') }}" onsubmit="return confirm('Apakah Anda yakin menghapus semua data ini?')" method="post">
                        @csrf
                        <button class="btn btn-danger btn-xs delete-data mr-1" title="hapus">
                            <i class="fas fa-trash-alt"></i> &nbsp; Hapus Semua
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nip</th>
                            <th>Nama Karyawan</th>
                            <th>Jabatan</th>
                            <th>Lembur</th>
                            <th>Reward</th>
                            <th>Cicilan</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($employees as $employee)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $employee->nip }}</td>
                                <td>{{ $employee->nama }}</td>
                                <td>{{ $employee->jabatan }}</td>
                                <td>{{ Helper::rupiah($employee->overtimes_sum_jumlah) }}</td>
                                <td>{{ Helper::rupiah($employee->rewards_sum_jumlah) }}</td>
                                <td>{{ Helper::rupiah($employee->installments_sum_jumlah) }}</td>
                                <td class="d-flex">
                                    {{-- <a href="{{ url()->to('/gaji-pegawai/tunjangan/lembur-reward-cicilan/207/edit') }}" class="btn btn-primary btn-xs btn-action mr-1"
                                        title="Edit"><i class="fas fa-edit"></i></a> --}}
                                    <form action="{{ url()->to("/gaji-pegawai/tunjangan/lembur-reward-cicilan/$employee->nip/remove") }}" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        @csrf
                                        <button class="btn btn-danger btn-xs delete-data mr-1" title="hapus">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" align="center">Data Kosong</td>
                            </tr>
                        @endforelse
                    </tbody>

                    <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel3" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel1">Upload Data Lewat Excel</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ url()->to('gaji-pegawai/tunjangan/lembur-reward-cicilan/upload-excel') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <div class="section-title">Upload File Excel</div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file form-control" name="file">
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button class="btn btn-primary mr-1" type="submit"
                                                name="uploadexcel">Simpan</button>
                                            <button type="button" class="btn btn-danger"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
    @if (session()->has('error'))
        <script type='text/javascript'>
            setTimeout(function() {
                swal({
                    title: 'warning',
                    text: '{{ session()->get('error') }}',
                    type: 'warning',
                    icon: 'warning',
                    timer: 3000,
                    buttons: false
                });
            }, 10);
        </script>
    @endif
    @if (session()->has('success'))
        <script type='text/javascript'>
            setTimeout(function() {
                swal({
                    title: 'success',
                    text: '{{ session()->get('success') }}',
                    type: 'success',
                    icon: 'success',
                    timer: 3000,
                    buttons: false
                });
            }, 10);
        </script>
    @endif
@endpush
