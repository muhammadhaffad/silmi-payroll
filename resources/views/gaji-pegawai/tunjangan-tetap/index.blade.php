@extends('gaji-pegawai.layout.app', ['title' => 'Tunjangan Tetap'])
@push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endpush
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header">
            <div class="w-100 my-2">
                <h1 class="h3 text-gray-800">Data Tunjungan Tetap</h1>
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between">
                    <button class="btn btn-primary btn-action btn-xs mr-1" data-toggle="modal" data-target="#exampleModal1"
                        data-toggle="tooltip" title="Tambah Data">
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
                            <td>Karyawan 1</td>
                            <td>{{ "$year Tahun, $month Bulan, $day Hari" }}</td>
                            <td>IT Support</td>
                            <td>{{ Helper::rupiah(200000) }}</td>
                            <td>{{ Helper::rupiah(0) }}</td>
                            <td>{{ Helper::rupiah(200000) }}</td>
                            <td>{{ Helper::rupiah(200000) }}</td>
                            <td>{{ Helper::rupiah(200000) }}</td>
                            <td>{{ Helper::rupiah(200000) }}</td>
                            <td>{{ Helper::rupiah(0) }}</td>
                            <td>{{ Helper::rupiah(200000) }}</td>
                            <td>
                                <a href="{{ url()->to('/gaji-pegawai/tunjangan/tetap/207/show') }}" class="btn btn-success btn-xs btn-action mr-1"
                                    title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- MODAL -->

                <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel1" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Tambah Tunjangan Tidak Tetap</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="input-group my-3">
                                    <select class="form-control selectpicker" data-live-search="true" id="tunjangan"
                                        name="tunjangan" onchange="getTunjangan()" required>
                                        <option disabled selected>Pilih Tunjangan</option>
                                        <option value="keahlian">Tunjangan Keahlian</option>
                                        <option value="kepala-keluarga">Tunjangan Kepala Keluarga</option>
                                        <option value="masa-kerja">Tunjangan Masa Kerja</option>
                                        <option value="reward">Reward</option>
                                        <option value="lembur">Lembur</option>
                                        <option value="infaq">Infaq</option>
                                        <option value="cicilan">Cicilan</option>
                                    </select>
                                </div>
                                <div class="input-group my-3">
                                    <select class="form-control selectpicker" data-live-search="true" name="karyawan" required>
                                        <option disabled selected> Pilih Karyawan</option>
                                        <option value="207">Karyawan 1</option>
                                        <option value="208">Karyawan 2</option>
                                        <option value="209">Karyawan 3</option>
                                    </select>
                                </div>
                                <div class="tunjangan control-group after-add-more mb-2" id="keahlian">
                                    <div class="form-group">
                                        <label>Tunjangan Keahlian</label>
                                        <input type="text" name="tunjungankeahlian[]" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Jumlah Tunjangan</label>
                                        <input type="text" name="jmlh_tunjangan[]" class="form-control" required>
                                    </div>
                                    <button type="button" name="add" id="add" class="btn btn-success mb-3">Tambah Tunjangan Lain</button>
                                </div>
                                <div class="tunjangan form-group" id="kepala-keluarga">
                                    <div class="section-title mt-0">Jumlah Tunjangan Keluarga</div>
                                    <div class="input-group mb-2">
                                        <input type="number" class="form-control" name="jmlh_tunjangan" required>
                                    </div>
                                </div>
                                <div class="tunjangan form-group" id="masa-kerja">
                                    <div class="section-title mt-0">Jumlah Tunjangan Masa Kerja</div>
                                    <div class="input-group mb-2">
                                        <input type="number" class="form-control" name="jmlh_tunjangan" required>
                                    </div>
                                </div>
                                <div class="tunjangan form-group" id="reward">
                                    <div class="section-title mt-0">Jumlah Reward</div>
                                    <div class="input-group mb-2">
                                        <input type="number" class="form-control" name="jmlh_tunjangan" required>
                                    </div>
                                </div>
                                <div class="tunjangan form-group" id="lembur">
                                    <div class="section-title mt-0">Jumlah Lembur</div>
                                    <div class="input-group mb-2">
                                        <input type="number" class="form-control" name="jmlh" required>
                                    </div>
                                </div>
                                <div class="tunjangan form-group" id="infaq">
                                    <div class="section-title mt-0">Jumlah Infaq</div>
                                    <div class="input-group mb-2">
                                        <input type="number" class="form-control" name="jmlh_infaq" required>
                                    </div>
                                </div>
                                <div class="tunjangan form-group" id="cicilan">
                                    <div class="section-title mt-0">Jumlah Cicilan</div>
                                    <div class="input-group mb-2">
                                        <input type="number" class="form-control" name="jmlh_cicilan" required>
                                    </div>
                                </div>
                                <div class="modal-footer mt-3" id="modal-footer-tunjangan">
                                    <button class="btn btn-primary mr-1" type="submit" name="submit1">Simpan</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
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
                    text: 'Data Berhasil Disimpan',
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
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script>
        $(document).ready(function() {
            var i = 1;
            $('#add').click(function() {
                i++;
                let form = `<div class="control-group my-3" id="row${i}">
                        <div class="form-group">
                            <label>Tunjangan Keahlian</label>
                            <input type="text" name="tunjungankeahlian[]" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Jumlah Tunjangan</label>
                            <input type="text" name="jmlh_tunjangan[]" class="form-control" required>
                        </div>
                        <button type="button" name="remove" id="${i}" class="btn btn-danger btn_remove mb-3">Hapus</button>
                    </div>`;
                $('#keahlian').append(form);
            });
            $(document).on('click', '.btn_remove', function() {
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
            });
            $('#submit').click(function() {
                $.ajax({
                    url: "index.php",
                    method: "POST",
                    data: $('#add_name').serialize(),
                    success: function(data) {
                        alert(data);
                        $('#add_name')[0].reset();
                    }
                });
            });
        });
    </script>
    <script>
        $('.tunjangan').hide();
        $('.tunjangan input').val('');
        $('#modal-footer-tunjangan').hide();
        function getTunjangan() {
            let tunjangan = $('#tunjangan').find(':selected').val();
            $('.tunjangan').hide();
            $('.tunjangan input').val('');
            $(`.tunjangan#${tunjangan}`).show();
            $('#modal-footer-tunjangan').show();
        }
    </script>
@endpush
