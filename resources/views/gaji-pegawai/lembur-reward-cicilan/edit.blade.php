@extends('gaji-pegawai.layout.app', ['title' => 'Lembur Reward Cicilan'])
@section('content')
    <div class="card">
        <!-- <img src="images/img-1.jpg" class="img-fluid"> -->
        <div class="card-body">
            <div class="row ">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>Update Data</h4>
                            <div class="card-header-action text-right">
                                <a href="{{ url()->to('/gaji-pegawai/tunjangan/lembur-reward-cicilan') }}" class="btn btn-primary btn-action btn-xs mr-1"
                                    title="kembali"><span>Kembali</span></a>
                            </div>
                        </div>

                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="card-body">

                                        <form action="" enctype="multipart/form-data" method="post">
                                            <div class="form-group">
                                                <div class="section-title mt-0">Lembur</div>
                                                <div class="input-group mb-2">
                                                    <input type="text" id="rupiahlembur" value="100000"
                                                        class="form-control" name="lembur" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="section-title mt-0">Reward</div>
                                                <div class="input-group mb-2">
                                                    <input type="text" id="rupiahreward" value="50000"
                                                        class="form-control" name="reward" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="section-title mt-0">Cicilan</div>
                                                <div class="input-group mb-2">
                                                    <input type="text" id="rupiahcicilan"
                                                        value="0" class="form-control"
                                                        name="cicilan" required>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer text-right">
                                <button class="btn btn-primary mr-1" type="submit" name="submit">Edit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
