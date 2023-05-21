@extends('gaji-pegawai.layout.app', ['title' => 'Tunjangan Tetap'])
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header bg-primary py-3">
            <h1 class="h3 mb-2 text-white"> Detail Tunjangan Tidak Tetap</h1>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div>
                    <span class="d-block" style='font-size:20pt'>
                        <b>Detail Karyawan</b>
                    </span>
                    <span class="d-block" style="font-size:15pt">Nama Karyawan : Karyawan 1 </span>
                    <span class="d-block" style="font-size:15pt"> Jabatan : IT Support </span>
                </div>
                <div>
                    <span class="d-block font-weight-bold" style='font-size:15pt'>Tunjangan (T. Keahlian, T. Kepala
                        Keluarga, T.
                        Masa Kerja)</span>
                    <span class="d-block text-success" style="font-size:15pt">
                        {{ Helper::rupiah(200000) }}
                    </span>
                    <hr>
                    <span class="d-block fontfont-weight-bold" style='font-size:15pt'>Reward & Lembur</span>
                    <span class="d-block text-success" style="font-size:15pt">
                        {{ Helper::rupiah(200000) }}
                    </span>

                    <hr>
                    <span class="d-block font-weight-bold" style='font-size:15pt'>Cicilan & Infaq</span>
                    <span class="d-block text-danger" style="font-size:15pt">
                        {{ Helper::rupiah(200000) }}
                    </span>
                </div>
            </div>

            <h4>Tunjangan Kehalian</h4>
            <div class="modal-dialog mw-100" role="document" id="keahlian-form">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" id="exampleModalLabel" class="close btn-danger" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="width: 100%;">
                        <form action="index.php" method="POST">
                            <div class="control-group after-add-more" id="dynamic_field">
                                <div class="control-group after-add-more" id="dynamic_field">
                                    <label>Tunjangan Keahlian</label>
                                    <input type="text" name="tunjungankeahlian[]" class="form-control" required>
                                    <label>Jumlah Tunjangan</label>
                                    <input type="text" name="jmlh_tunjangan[]" class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer mt-3">
                                <button class="btn btn-primary mr-1" type="submit" name="submitkeahlian">Simpan</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal"
                                    id="send">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="datatable table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Tunjangan Keahlian</th>
                            <th>Jumlah Tunjangan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Ngodonf</td>
                            <td>{{ Helper::rupiah(200000) }}</td>
                            <td>
                                <button class="keahlian btn btn-success btn-action btn-xs mr-1">
                                    <i class="fas fa-plus"></i>
                                </button>
                                <a href="{{ url()->to("gaji-pegawai/tunjangan/tetap/207/keahlian/1/edit") }}" class="btn btn-primary btn-xs btn-action mr-1" id="edit" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="deletedetail.php?idkeahlian=<?= '' ?>" class="btn btn-danger btn-xs delete-data mr-1" id="hapus" title="hapus">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>
                                Total Keseluruhan
                            </td>
                            <td colspan="2" class="text-success" align="right">
                                {{ Helper::rupiah(200000) }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <h4>Tunjangan Kepala Keluarga</h4>
            <div class="modal-dialog mw-100" role="document" id="kepala-keluarga-form">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" id="exampleModalLabel2" class="close btn-danger" data-dismiss="modal"
                            aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="width: 100%;">
                        <form action="" method="POST">
                            <div class="form-group">
                                <div class="section-title mt-0">Jumlah</div>
                                <div class="input-group mb-2">
                                    <input type="number" class="form-control" name="jmlh_tunjangan" required>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-primary mr-1" type="submit" name="submit2">Simpan</button>

                                <button type="button" class="btn btn-danger" data-dismiss="modal"
                                    id="send2">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="datatable table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Tunjangan</th>
                            <th>Jumlah Tunjangan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Tunjangan Kepala Keluarga</td>
                            <td>{{ Helper::rupiah(200000) }}</td>
                            <td>
                                <button class="kepala-keluarga btn btn-success btn-action btn-xs mr-1" id="tampil2"><i
                                        class="fas fa-plus"></i></button>

                                <a href="{{ url()->to("gaji-pegawai/tunjangan/tetap/207/kepala-keluarga/1/edit") }}"
                                    class="btn btn-primary btn-xs btn-action mr-1" title="Edit"><i
                                        class="fas fa-edit"></i></a>

                                <a href="deletedetail.php?idkepalakeluarga=<?= '' ?>"
                                    class="btn btn-danger btn-xs delete-data mr-1" title="hapus"><i
                                        class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>
                                Total Keseluruhan
                            </td>
                            <td colspan="2" class="text-success text-right">
                                {{ Helper::rupiah(200000) }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <h4>Tunjangan Masa Kerja</h4>
            <div class="modal-dialog mw-100" role="document" id="masa-kerja-form">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" id="exampleModalLabel3" class="close btn-danger" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="width: 100%;">
                        <form action="" method="POST">
                            <div class="form-group">
                                <div class="section-title mt-0">Jumlah Tunjangan Masa Kerja</div>
                                <div class="input-group mb-2">
                                    <input type="number" class="form-control" name="jmlh_tunjangan" required>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-primary mr-1" type="submit" name="submit3">Simpan</button>

                                <button type="button" class="btn btn-danger" data-dismiss="modal"
                                    id="send3">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="datatable table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Tunjangan</th>
                            <th>Jumlah Tunjangan</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Tunjangan Masa Kerja</td>
                            <td>{{ Helper::rupiah(200000) }}</td>
                            <td>
                                <button class="masa-kerja btn btn-success btn-action btn-xs mr-1" id="tampil3"><i
                                        class="fas fa-plus"></i>
                                </button>

                                <a href="{{ url()->to("gaji-pegawai/tunjangan/tetap/207/masa-kerja/1/edit") }}"
                                    class="btn btn-primary btn-xs btn-action mr-1" title="Edit"><i
                                        class="fas fa-edit"></i>
                                </a>

                                <a href="deletedetail.php?idmasakerja=<?= '' ?>"
                                    class="btn btn-danger btn-xs delete-data mr-1" title="hapus">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>
                                Total Keseluruhan
                            </td>
                            <td colspan="2" class="text-success text-right">
                                {{ Helper::rupiah(200000) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <h4>Reward</h4>
            <div class="modal-dialog mw-100" role="document" id="reward-form">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" id="exampleModalLabel4" class="close btn-danger" data-dismiss="modal"
                            aria-label="Close"><span aria-hidden="true">&times;</span></button>

                    </div>
                    <div class="modal-body" style="width: 100%;">
                        <form action="" method="POST">
                            <div class="form-group">
                                <div class="section-title mt-0">Jumlah Reward</div>
                                <div class="input-group mb-2">
                                    <input type="number" class="form-control" name="jmlh_tunjangan" required>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-primary mr-1" type="submit" name="submit4">Simpan</button>

                                <button type="button" class="btn btn-danger" data-dismiss="modal"
                                    id="send4">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="datatable table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jumlah Reward</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Reward</td>
                            <td>{{ Helper::rupiah(200000) }}</td>
                            <td>
                                <button class="reward btn btn-success btn-action btn-xs mr-1" id="tampil4"><i
                                        class="fas fa-plus"></i></button>
    
                                <a href="{{ url()->to("gaji-pegawai/tunjangan/tetap/207/reward/1/edit") }}" class="btn btn-primary btn-xs btn-action mr-1"
                                    title="Edit"><i class="fas fa-edit"></i></a>
    
                                <a href="deletedetail.php?idreward=<?= '' ?>" class="btn btn-danger btn-xs delete-data mr-1"
                                    title="hapus"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>
                                Total Keseluruhan
                            </td>
                            <td colspan="2" class="text-right text-success">
                                {{ Helper::rupiah(200000) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <h4>Lembur</h4>
            <div class="modal-dialog mw-100" role="document" id="lembur-form">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" id="exampleModalLabel5" class="close btn-danger"
                            data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="width: 100%;">
                        <form action="" method="POST">
                            <div class="form-group">
                                <div class="section-title mt-0">Jumlah</div>
                                <div class="input-group mb-2">
                                    <input type="number" class="form-control" name="jmlh" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary mr-1" type="submit"
                                    name="submit5">Simpan</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal"
                                    id="send5">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="datatable table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jumlah Lembur</th>
                            <th>Action</th>
                        </tr>
                    </thead>
    
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Lembur</td>
                            <td>{{ Helper::rupiah(200000) }}</td>
                            <td>
                                <button class="lembur btn btn-success btn-action btn-xs mr-1" id="tampil5"><i
                                        class="fas fa-plus"></i></button>
    
                                <a href="{{ url()->to("gaji-pegawai/tunjangan/tetap/207/lembur/1/edit") }}" class="btn btn-primary btn-xs btn-action mr-1"
                                    title="Edit"><i class="fas fa-edit"></i></a>
    
                                <a href="deletedetail.php?idlembur=<?= '' ?>" class="btn btn-danger btn-xs delete-data mr-1"
                                    title="hapus"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>
                                Total Keseluruhan
                            </td>
                            <td colspan="2" class="text-right text-success">
                                {{ Helper::rupiah(200000) }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <h4>Infaq</h4>
            <div class="modal-dialog mw-100" role="document" id="infaq-form">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" id="exampleModalLabel6" class="close btn-danger"
                            data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>

                    </div>
                    <div class="modal-body" style="width: 100%;">
                        <form action="" method="POST">
                            <div class="form-group">
                                <div class="section-title mt-0">Jumlah Infaq</div>
                                <div class="input-group mb-2">
                                    <input type="number" class="form-control" name="jmlh_infaq" required>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-primary mr-1" type="submit"
                                    name="submit6">Simpan</button>


                                <button type="button" class="btn btn-danger" data-dismiss="modal"
                                    id="send6">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="datatable table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jumlah Infaq</th>
                            <th>Action</th>
                        </tr>
                    </thead>
    
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Infaq</td>
                            <td>{{ Helper::rupiah(200000) }}</td>
                            <td>
                                <button class="infaq btn btn-success btn-action btn-xs mr-1" id="tampil6"><i
                                        class="fas fa-plus"></i></button>
    
                                <a href="{{ url()->to("gaji-pegawai/tunjangan/tetap/207/infaq/1/edit") }}" class="btn btn-primary btn-xs btn-action mr-1"
                                    title="Edit"><i class="fas fa-edit"></i></a>
    
                                <a href="deletedetail.php?idinfaq=<?= '' ?>" class="btn btn-danger btn-xs delete-data mr-1"
                                    title="hapus"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>
                                Total Keseluruhan
                            </td>
                            <td colspan="2" class="text-right text-danger">
                                {{ Helper::rupiah(200000) }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <h4>Cicilan</h4>
            <div class="modal-dialog mw-100" role="document" id="cicilan-form">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" id="exampleModalLabel7" class="close btn-danger"
                            data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>

                    </div>
                    <div class="modal-body" style="width: 100%;">
                        <form action="" method="POST">
                            <div class="form-group">
                                <div class="section-title mt-0">Jumlah Cicilan</div>
                                <div class="input-group mb-2">
                                    <input type="number" class="form-control" name="jmlh_cicilan" required>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-primary mr-1" type="submit"
                                    name="submit7">Simpan</button>

                                <button type="button" class="btn btn-danger" data-dismiss="modal"
                                    id="send7">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="datatable table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jumlah Cicilan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
    
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Cicilan</td>
                            <td>{{ Helper::rupiah(200000) }}</td>
                            <td>
                                <button class="cicilan btn btn-success btn-action btn-xs mr-1" id="tampil7"><i
                                        class="fas fa-plus"></i></button>
    
                                <a href="{{ url()->to("gaji-pegawai/tunjangan/tetap/207/cicilan/1/edit") }}" class="btn btn-primary btn-xs btn-action mr-1"
                                    title="Edit"><i class="fas fa-edit"></i></a>
    
                                <a href="deletedetail.php?idcicilan=<?= '' ?>" class="btn btn-danger btn-xs delete-data mr-1"
                                    title="hapus"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>
                                Total Keseluruhan
                            </td>
                            <td colspan="2" class="text-right text-danger">
                                {{ Helper::rupiah(200000) }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(() => {
            $('#keahlian-form').hide();
            $('#kepala-keluarga-form').hide();
            $('#masa-kerja-form').hide();
            $('#reward-form').hide();
            $('#lembur-form').hide();
            $('#infaq-form').hide();
            $('#cicilan-form').hide();
            $('.keahlian').click(function() {
                $('#keahlian-form').show('fade');
                $('.close').click(function() {
                    $('#keahlian-form').hide('fade');
                });
            });
            $('.kepala-keluarga').click(function() {
                $('#kepala-keluarga-form').show('fade');
                $('.close').click(function() {
                    $('#kepala-keluarga-form').hide('fade');
                });
            });
            $('.masa-kerja').click(function() {
                $('#masa-kerja-form').show('fade');
                $('.close').click(function() {
                    $('#masa-kerja-form').hide('fade');
                });
            });
            $('.reward').click(function() {
                $('#reward-form').show('fade');
                $('.close').click(function() {
                    $('#reward-form').hide('fade');
                });
            });
            $('.lembur').click(function() {
                $('#lembur-form').show('fade');
                $('.close').click(function() {
                    $('#lembur-form').hide('fade');
                });
            });
            $('.infaq').click(function() {
                $('#infaq-form').show('fade');
                $('.close').click(function() {
                    $('#infaq-form').hide('fade');
                });
            });
            $('.cicilan').click(function() {
                $('#cicilan-form').show('fade');
                $('.close').click(function() {
                    $('#cicilan-form').hide('fade');
                });
            });
        })
    </script>
@endpush
