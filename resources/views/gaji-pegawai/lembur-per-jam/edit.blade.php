@extends('gaji-pegawai.layout.app', ['title' => 'Data Lembur Sales'])
@section('content')
    <div class="card-body">
        <div class="row ">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Updhate Data</h4>
                        <div class="card-header-action text-right">
                            <a href="{{ url()->to('/gaji-pegawai/tunjangan/lembur-sales') }}" class="btn btn-primary btn-action btn-xs mr-1"
                                title="kembali"><span>Kembali</span></a>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col">
                                <form action="" enctype="multipart/form-data" method="post">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <div class="section-title mt-0">Nama</div>
                                            <div class="input-group mb-2">
                                                <input type="text" value="Karyawan 1"
                                                    class="form-control" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="section-title mt-0">Perjam</div>
                                            <div class="input-group mb-2" id="perjam">
                                                <input type="text" value="100000"
                                                    class="form-control" name="perjam" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="section-title mt-0">Jam Lembur</div>
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control"
                                                    value="7" name="jamlembur" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <button class="btn btn-primary mr-1" type="submit" name="submit">Edit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
