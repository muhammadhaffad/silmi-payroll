@extends('gaji-pegawai.layout.app', ['title'=>'Karyawan'])
@push('style')
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
@endpush
@section('content')
    <h1 class="h3 mb-2 text-gray-800">Data Karyawan</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="card-header-action">
                <button class="btn btn-primary btn-action btn-xs mr-1" data-toggle="modal" data-target="#exampleModal"
                    data-toggle="tooltip" title="Tambah Data">
                    <span>Tambah Data Karyawan</span>
                </button>
                <span class="mt-3">
                    <br><br>
                    Catatan :
                    <br>
                    - Apabila Type Karyawan Centang <i class="far fa-check-square"></i> Maka Gaji Karyawan Tidak Ikut
                    Hitungan Perjam
                    <br>
                    - Apabila Type Karyawan Tidak Centang <input type="checkbox" disabled> Maka Gaji Karyawan Ikut Hitungan
                    Perjam
                    <br>
                </span>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nip</th>
                            <th>Nama Karyawan</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Lahir</th>
                            <th>Jabatan</th>
                            <th>Tanggal Masuk</th>
                            <th>Alamat</th>
                            <th>Type Karyawan</th>
                            <th>Status Karyawan</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>207</td>
                            <td>Karyawan 1</td>
                            <td class="text-center">Laki-laki</td>
                            <td>2000-04-03</td>
                            <td>IT Support</td>
                            <td>2023-04-25</td>
                            <td>Lamongan</td>
                            <td class="text-center">
                                <label class="switch">
                                    <form action="{{ url()->to('/gaji-pegawai/data-master/karyawan/207/ubah-tipe') }}"
                                        method="post">
                                        <input type="checkbox" name="nip" value="207" checked>
                                        <span class="slider round"></span>
                                    </form>
                                </label>
                            </td>
                            <td class="text-center">
                                <label class="switch">
                                    <form action="{{ url()->to('/gaji-pegawai/data-master/karyawan/207/ubah-status') }}"
                                        method="post">
                                        <input type="checkbox" name="nip" value="207" checked>
                                        <span class="slider round"></span>
                                    </form>
                                </label>
                                <div id="resultstatus"> <span class="text-white badge bg-success">Aktif</span></div>
                            </td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ url()->to('/gaji-pegawai/data-master/karyawan/207/edit') }}"
                                        class="btn btn-primary btn-xs btn-action mr-1" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ url()->to('/gaji-pegawai/data-master/karyawan/207/remove') }}"
                                        class="btn btn-danger btn-xs delete-data mr-1" title="hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Karyawan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="POST">
                                    <div class="form-group">
                                        <div class="section-title mt-0">Nip</div>
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="nip" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="section-title mt-0">Nama Karyawan</div>
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="nama_karyawan" required>
                                        </div>
                                    </div>
                                    <div class="widget-body mt-3">
                                        <div class="form-group">
                                            <div class="section-title mt-0">Jenis Kelamin</div>
                                            <select class="custom-select" name="jenis_kelamin">
                                                <option disabled selected>Pilih Jenis Kelamin</option>

                                                <option value="L">Laki - Laki</option>

                                                <option value="P">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="section-title mt-0">Tanggal Lahir</div>
                                        <div class="input-group mb-2">
                                            <input type="date" class="form-control" name="ttl" required>
                                        </div>
                                    </div>

                                    <div class="widget-body mt-3">
                                        <div class="form-group">
                                            <div class="section-title mt-0">Pilih Devisi</div>
                                            <select class="custom-select" name="devisi">
                                                <option disabled selected>Pilih Devisi</option>
                                                <option value="SALES">SALES</option>
                                                <option value="MANAJEMEN">MANAJEMEN</option>
                                                <option value="RND">RND</option>
                                                <option value="PRODUKSI">PRODUKSI</option>
                                                <option value="MARKOM">MARKOM</option>
                                                <option value="TOKO">TOKO</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="section-title mt-0">Jabatan</div>
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="jabatan" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="section-title mt-0">Tangal Masuk</div>
                                        <div class="input-group mb-2">
                                            <input type="date" class="form-control" name="tgl_masuk" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="section-title mt-0">Alamat</div>
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="alamat" required>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-primary mr-1" type="submit"
                                            name="submit">Simpan</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (false)
        <script type='text/javascript'>
            setTimeout(function() {
                swal({
                    title: 'Suksess',
                    text: 'Data Berhasil Disimpan $nama',
                    type: 'success',
                    icon: 'success',
                    timer: 3000,
                    buttons: false
                });
            }, 10);
            window.setTimeout(function() {
                window.location.replace('index.php');
            }, 3000);
        </script>
    @endif
@endsection
