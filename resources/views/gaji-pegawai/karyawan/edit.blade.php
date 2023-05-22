@extends('gaji-pegawai.layout.app', ['title' => 'Karyawan'])
@push('style')
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
@endpush
@section('content')
    <div class="card">
        <!-- <img src="images/img-1.jpg" class="img-fluid"> -->
        <div class="card-body">
            <div class="row ">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>Update Data Karyawan</h4>
                            <div class="card-header-action text-right">
                                <a class="btn btn-primary btn-action btn-xs mr-1" title="kembali"><span>Kembali</span></a>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="card-body">
                                        <form id="update-employee" action="{{ url()->to("gaji-pegawai/data-master/karyawan/$employee->nip/update") }}" enctype="multipart/form-data" method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <div class="section-title mt-0">NIP</div>
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" value="{{ $employee->nip }}" name="nip" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="section-title mt-0">Nama Karyawan</div>
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" value="{{ $employee->nama }}" name="nama" required>
                                                </div>
                                            </div>
                                            <div class="widget-body mt-3">
                                                <div class="form-group">
                                                    <select class="custom-select" name="jenis_kelamin">
                                                        <option value="Laki-laki" @selected($employee->jenis_kelamin === 'Laki-laki')>Laki-laki</option>
                                                        <option value="Perempuan" @selected($employee->jenis_kelamin === 'Perempuan')>Perempuan</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="section-title mt-0">Tanggal Lahir</div>
                                                <div class="input-group mb-2">
                                                    <input type="date" class="form-control" value="{{ $employee->tanggal_lahir }}" name="tanggal_lahir" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="section-title mt-0">Devisi</div>
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" value="{{ $employee->devisi }}" name="devisi" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="section-title mt-0">Jabatan</div>
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" value="{{ $employee->jabatan }}" name="jabatan" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="section-title mt-0">Tangal Masuk</div>
                                                <div class="input-group mb-2">
                                                    <input type="date" class="form-control" value="{{ $employee->tanggal_masuk }}" name="tanggal_masuk" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="section-title mt-0">Alamat</div>
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" value="{{ $employee->alamat }}" name="alamat" required>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button form="update-employee" class="btn btn-primary mr-1" type="submit" name="submit">Submit</button>
                            <!-- <button class="btn btn-danger" type="reset">Reset</button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
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
