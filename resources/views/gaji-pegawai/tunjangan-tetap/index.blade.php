@extends('gaji-pegawai.layout.app', ['title' => 'Tunjangan Tetap'])
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="container-fluid">
            <h1 class="h3 mb-2 text-gray-800">Data Tunjungan Tetap</h1>
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-3">
                <button class="btn btn-primary btn-action btn-xs mr-1" data-toggle="modal" data-target="#exampleModal1" data-toggle="tooltip" title="Tambah Data">
                    <i class="fas fa-plus"></i>
                    <span>Tambah Tunjangan</span>
                </button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" cellspacing="0">
                <thead class="thead-info">
                    <tr>
                        <th>No</th>
                        <th>NIP</th>
                        <th>Nama Karyawan</th>
                        <th>Waktu Bekerja</th>
                        <th>Jabatan</th>
                        <th>Tunjangan Keahlian</th>
                        <th>Tunjangan Keapala Keluarga</th>
                        <th>Tunjangan Masa Kerja</th>
                        <th>Reward</th>
                        <th>Lembur</th>
                        <th>Infaq</th>
                        <th>Cicilan</th>
                        <th>Jumlah Tunjangan Tetap</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody id="data">
                    @php
                        $diffDate = Carbon\Carbon::parse('2023-04-25')->diff(Carbon\Carbon::now());
                        $year = $diffDate->format('%y');
                        $month = $diffDate->format('%m');
                        $day = $diffDate->format('%d');
                    @endphp
                    <tr>
                        <td>1</td>
                        <td>207</td>
                        <td>Yojiro</td>
                        <td>{{ "$year Tahun, $month Bulan, $day Hari" }}</td>
                        <td>IT Support</td>
                        <td>{{ 'Rp.' . number_format(200000, 2, ",", ".") }}</td>
                        <td>{{ 'Rp.' . number_format(0, 2, ",", ".") }}</td>
                        <td>{{ 'Rp.' . number_format(200000, 2, ",", ".") }}</td>
                        <td>{{ 'Rp.' . number_format(100000, 2, ",", ".") }}</td>
                        <td>{{ 'Rp.' . number_format(50000, 2, ",", ".") }}</td>
                        <td>{{ 'Rp.' . number_format(0, 2, ",", ".") }}</td>
                        <td>{{ 'Rp.' . number_format(1000000, 2, ",", ".") }}</td>
                        <td>
                            <a href="detail.php?id=<?= $row['nip'] ?>" class="btn btn-success btn-xs btn-action mr-1" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
                <!-- MODAL -->

                <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Tambah Tunjangan Tidak Tetap</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">


                                <div class="input-group mb-2">
                                    <select class="form-control selectpicker" data-live-search="true" id="tunjangan" name="tunjangan" required>
                                        <option disabled selected> Pilih Tunjangan</option>
                                        <option value="t_keahlian">Tunjangan Keahlian</option>
                                        <option value="t_kepalakeluarga">Tunjangan Kepala Keluarga</option>
                                        <option value="t_masakerja">Tunjangan Masa Kerja</option>
                                        <option value="reward">Reward</option>
                                        <option value="lembur">Lembur</option>
                                        <option value="infaq">Infaq</option>
                                        <option value="cicilan">Cicilan</option>
                                    </select>
                                </div>
                                <script>
                                    $("#tunjangan").change(function() {
                                        // variabel dari nilai combo box
                                        var tunjangan = $("#tunjangan").val();

                                        // Menggunakan ajax untuk mengirim dan dan menerima data dari server
                                        $.ajax({
                                            type: "GET",
                                            dataType: "html",
                                            url: "datatunjangan.php",
                                            data: "tunjangan=" + tunjangan,
                                            success: function(data) {
                                                $("#data_tunjangantetap").html(data);
                                            }
                                        });
                                    });
                                </script>

                                <form id="data_tunjangantetap" action="" method="POST">
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

        </div> <?php
                if (isset($_POST['submitkeahlian'])) {
                    $id = $_POST["id"];
                    $number = count($_POST["tunjungankeahlian"]);
                    $tgl = date('Y-m-d');

                    if ($number > 0) {
                        for ($i = 0; $i < $number; $i++) {
                            if (trim($_POST["tunjungankeahlian"][$i] != '')) {

                                $save = mysqli_query($con, "INSERT INTO t_keahlian VALUES ('', '$id', '" . $_POST['tunjungankeahlian'][$i] . "' , '" . $_POST['jmlh_tunjangan'][$i] . "', '$tgl' )") or die(mysqli_error($con));
                            }
                        }
                        //jika berhasil input

                        echo "<script type='text/javascript'>
                  setTimeout(function () { 
                      swal({ 
                          title: 'Suksess', 
                          text: 'Data Berhasil Disimpan', 
                          type: 'success',
                          icon: 'success',
                          timer: 3000,
                          buttons: false });
                  },10);  
                  window.setTimeout(function(){ 
                  window.location.replace('detail.php?id=$id');
                  } ,3000); 
                  </script>";
                    } else {
                        //jika tidak berhasil
                        echo "Data Tidak Berhasil Di Inputkan";
                    }
                }
                if (isset($_POST['submit1'])) {
                    $karyawan = $_POST['karyawan'];
                    $number = count($_POST["tunjungankeahlian"]);
                    $tgl = date('Y-m-d');

                    if ($number > 0) {
                        for ($i = 0; $i < $number; $i++) {
                            if (trim($_POST["tunjungankeahlian"][$i] != '')) {

                                $save = mysqli_query($con, "INSERT INTO t_keahlian VALUES ('', '$karyawan', '" . $_POST['tunjungankeahlian'][$i] . "' , '" . $_POST['jmlh_tunjangan'][$i] . "', '$tgl' )") or die(mysqli_error($con));
                            }
                        }
                        //jika berhasil input

                        echo "<script type='text/javascript'>
                        setTimeout(function () { 
                            swal({ 
                                title: 'Suksess', 
                                text: 'Data Berhasil Disimpan', 
                                type: 'success',
                                icon: 'success',
                                timer: 3000,
                                buttons: false });
                        },10);  
                        window.setTimeout(function(){ 
                        window.location.replace('index.php');
                        } ,3000); 
                        </script>";
                    } else {
                        //jika tidak berhasil
                        echo "Data Tidak Berhasil Di Inputkan";
                    }
                } else    if (isset($_POST['submit2'])) {
                    $karyawan = $_POST['karyawan1'];
                    $jmlh_tunjangan = $_POST['jmlh_tunjangan'];

                    $tgl = date('Y-m-d');
                    $save = mysqli_query($con, "INSERT INTO t_kepalakeluarga VALUES ('', '$karyawan', '$jmlh_tunjangan', '$tgl')") or die(mysqli_error($con));

                    echo "<script type='text/javascript'>
                    setTimeout(function () { 
                        swal({ 
                            title: 'Suksess', 
                            text: 'Data Berhasil Disimpan', 
                            type: 'success',
                            icon: 'success',
                            timer: 3000,
                            buttons: false });
                    },10);  
                    window.setTimeout(function(){ 
                    window.location.replace('index.php');
                    } ,3000); 
                    </script>";
                } else    if (isset($_POST['submit3'])) {
                    $karyawan = $_POST['karyawan1'];
                    $jmlh_tunjangan = $_POST['jmlh_tunjangan'];
                    $tgl = date('Y-m-d');

                    $save = mysqli_query($con, "INSERT INTO t_masakkerja VALUES ('', '$karyawan', '$jmlh_tunjangan', '$tgl')") or die(mysqli_error($con));

                    echo "<script type='text/javascript'>
                    setTimeout(function () { 
                        swal({ 
                            title: 'Suksess', 
                            text: 'Data Berhasil Disimpan', 
                            type: 'success',
                            icon: 'success',
                            timer: 3000,
                            buttons: false });
                    },10);  
                    window.setTimeout(function(){ 
                    window.location.replace('index.php');
                    } ,3000); 
                    </script>";
                } else    if (isset($_POST['submit4'])) {
                    $karyawan = $_POST['karyawan1'];
                    $jmlh_tunjangan = $_POST['jmlh_tunjangan'];
                    $tgl = date('Y-m-d');

                    $save = mysqli_query($con, "INSERT INTO reward VALUES ('', '$karyawan', '$jmlh_tunjangan', '$tgl')") or die(mysqli_error($con));

                    echo "<script type='text/javascript'>
                    setTimeout(function () { 
                        swal({ 
                            title: 'Suksess', 
                            text: 'Data Berhasil Disimpan', 
                            type: 'success',
                            icon: 'success',
                            timer: 3000,
                            buttons: false });
                    },10);  
                    window.setTimeout(function(){ 
                    window.location.replace('index.php');
                    } ,3000); 
                    </script>";
                } else    if (isset($_POST['submit5'])) {
                    $karyawan = $_POST['karyawan'];

                    $jumlah = $_POST['jmlh'];
                    $tgl = date('Y-m-d');

                    $save = mysqli_query($con, "INSERT INTO lembur VALUES ('', '$karyawan', '$jumlah', '$tgl')") or die(mysqli_error($con));

                    echo "<script type='text/javascript'>
                        setTimeout(function () { 
                            swal({ 
                                title: 'Suksess', 
                                text: 'Data Berhasil Disimpan', 
                                type: 'success',
                                icon: 'success',
                                timer: 3000,
                                buttons: false });
                        },10);  
                        window.setTimeout(function(){ 
                        window.location.replace('index.php');
                        } ,3000); 
                        </script>";
                } else    if (isset($_POST['submit6'])) {
                    $karyawan = $_POST['karyawan1'];
                    $jmlh_infaq = $_POST['jmlh_infaq'];
                    $tgl = date('Y-m-d');

                    $save = mysqli_query($con, "INSERT INTO infaq VALUES ('', '$karyawan', '$jmlh_infaq', '$tgl')") or die(mysqli_error($con));

                    echo "<script type='text/javascript'>
                    setTimeout(function () { 
                        swal({ 
                            title: 'Suksess', 
                            text: 'Data Berhasil Disimpan', 
                            type: 'success',
                            icon: 'success',
                            timer: 3000,
                            buttons: false });
                    },10);  
                    window.setTimeout(function(){ 
                    window.location.replace('index.php');
                    } ,3000); 
                    </script>";
                } else    if (isset($_POST['submit7'])) {
                    $karyawan = $_POST['karyawan1'];
                    $jmlh_cicilan = $_POST['jmlh_cicilan'];
                    $tgl = date('Y-m-d');

                    $save = mysqli_query($con, "INSERT INTO cicilan VALUES ('', '$karyawan', '$jmlh_cicilan', '$tgl')") or die(mysqli_error($con));

                    echo "<script type='text/javascript'>
                        setTimeout(function () { 
                        swal({ 
                            title: 'Suksess', 
                            text: 'Data Berhasil Disimpan', 
                            type: 'success',
                            icon: 'success',
                            timer: 3000,
                            buttons: false });
                        },10);  
                        window.setTimeout(function(){ 
                        window.location.replace('index.php');
                        } ,3000); 
                        </script>";
                }
                ?>




        </section>
    </div>



</div>
@endsection