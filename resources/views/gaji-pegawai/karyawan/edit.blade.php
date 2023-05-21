@extends('gaji-pegawai.layout.app', ['title' => 'Karyawan'])
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
                                        <form action="" enctype="multipart/form-data" method="post">
                                            <div class="form-group">
                                                <div class="section-title mt-0">Nip</div>
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" value="207" name="nip"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="section-title mt-0">Nama Karyawan</div>
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" value="Karyawan 1"
                                                        name="nama_karyawan" required>
                                                </div>
                                            </div>
                                            <div class="widget-body mt-3">
                                                <div class="form-group">
                                                    <select class="custom-select" name="jenis_kelamin">
                                                        <option value="L" selected>Laki - Laki</option>
                                                        <option value="P">Perempuan</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="section-title mt-0">Tanggal Lahir</div>
                                                <div class="input-group mb-2">
                                                    <input type="date" class="form-control" value="2000-04-03"
                                                        name="ttl" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="section-title mt-0">Devisi</div>
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" value="IT Support"
                                                        name="devisi" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="section-title mt-0">Jabatan</div>
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" value="IT Support"
                                                        name="jabatan" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="section-title mt-0">Tangal Masuk</div>
                                                <div class="input-group mb-2">
                                                    <input type="date" class="form-control" value="2023-05-18"
                                                        name="tgl_masuk" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="section-title mt-0">Alamat</div>
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" value="Lamongan"
                                                        name="alamat" required>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary mr-1" type="submit" name="submit">Submit</button>
                            <!-- <button class="btn btn-danger" type="reset">Reset</button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
