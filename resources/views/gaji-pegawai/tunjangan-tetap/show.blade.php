@extends('gaji-pegawai.layout.app', ['title' => 'Tunjangan Tetap'])
@push('style')
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
@endpush
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header bg-primary py-3 d-flex justify-content-between">
            <h1 class="h3 mb-2 text-white"> Detail Tunjangan Tetap</h1>
            <a href="{{ url()->to('gaji-pegawai/tunjangan/tetap') }}" class="btn btn-outline-light btn-action btn-xs mr-1" title="kembali"><span>Kembali</span></a>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div>
                    <span class="d-block" style='font-size:20pt'>
                        <b>Detail Karyawan</b>
                    </span>
                    <span class="d-block" style="font-size:15pt">Nama Karyawan : {{ $allowance->nama }}</span>
                    <span class="d-block" style="font-size:15pt">Jabatan : {{ $allowance->jabatan }}</span>
                </div>
                <div>
                    <span class="d-block font-weight-bold" style='font-size:15pt'>Tunjangan (T. Keahlian, T. Kepala
                        Keluarga, T. Masa Kerja)</span>
                    <span class="d-block text-success" style="font-size:15pt">
                        @php
                            $total = $allowance->expertise_allowances_sum_jumlah + $allowance->household_allowances_sum_jumlah + $allowance->seniority_allowances_sum_jumlah;
                        @endphp
                        {{ Helper::rupiah($total) }}
                    </span>
                    <hr>
                    <span class="d-block fontfont-weight-bold" style='font-size:15pt'>Reward & Lembur</span>
                    <span class="d-block text-success" style="font-size:15pt">
                        @php
                            $total = $allowance->rewards_sum_jumlah + $allowance->overtimes_sum_jumlah;
                        @endphp
                        {{ Helper::rupiah($total) }}
                    </span>

                    <hr>
                    <span class="d-block font-weight-bold" style='font-size:15pt'>Cicilan & Infaq</span>
                    <span class="d-block text-danger" style="font-size:15pt">
                        @php
                            $total = $allowance->infaqs_sum_jumlah + $allowance->installments_sum_jumlah;
                        @endphp
                        {{ Helper::rupiah($total) }}
                    </span>
                </div>
            </div>

            <h4>Tunjangan Keahlian</h4>
            <div class="modal-dialog mw-100" role="document" id="keahlian-form">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" id="exampleModalLabel" class="close btn-danger" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="width: 100%;">
                        <form action="{{ url()->to('gaji-pegawai/tunjangan/tetap/add') }}" method="POST">
                            @csrf
                            <div class="control-group after-add-more" id="dynamic_field">
                                <div class="control-group after-add-more" id="dynamic_field">
                                    <input type="hidden" name="nip" value="{{ $allowance->nip }}">
                                    <input type="hidden" name="tunjangan" value="keahlian">
                                    <label>Tunjangan Keahlian</label>
                                    <input type="text" name="nama[]" class="form-control" required>
                                    <label>Jumlah Tunjangan</label>
                                    <input type="text" name="jumlah[]" class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer mt-3">
                                <button class="btn btn-primary mr-1" type="submit" name="submitkeahlian">Simpan</button>
                                <button type="button" class="close-btn btn btn-danger" data-dismiss="modal"
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
                        @forelse ($allowance->expertiseAllowances as $expertiseAllowance)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $expertiseAllowance->nama }}</td>
                                <td>{{ Helper::rupiah($expertiseAllowance->jumlah) }}</td>
                                <td class="d-flex">
                                    <button class="keahlian btn btn-success btn-action btn-xs mr-1">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                    <a href="{{ url()->to("gaji-pegawai/tunjangan/tetap/$allowance->nip/keahlian/$expertiseAllowance->id/edit") }}"
                                        class="btn btn-primary btn-xs btn-action mr-1" id="edit" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form
                                        action="{{ url()->to("gaji-pegawai/tunjangan/tetap/$allowance->nip/keahlian/$expertiseAllowance->id/remove") }}"
                                        method="post">
                                        @csrf
                                        <button class="btn btn-danger btn-xs delete-data mr-1">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" align="center">
                                    Data kosong
                                </td>
                                <td>
                                    <button class="keahlian btn btn-success btn-action btn-xs mr-1">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>
                                Total Keseluruhan
                            </td>
                            <td colspan="2" class="text-success" align="right">
                                {{ Helper::rupiah($allowance->expertise_allowances_sum_jumlah) }}
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
                        <form action="{{ url()->to('gaji-pegawai/tunjangan/tetap/add') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="tunjangan" value="kepala-keluarga">
                                <input type="hidden" name="nip" value="{{ $allowance->nip }}">
                                <div class="section-title mt-0">Jumlah</div>
                                <div class="input-group mb-2">
                                    <input type="number" class="form-control" name="jumlah[]" required>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-primary mr-1" type="submit" name="submit2">Simpan</button>
                                <button type="button" class="close-btn btn btn-danger" data-dismiss="modal"
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
                        @forelse ($allowance->householdAllowances as $householdAllowance)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $householdAllowance->nama }}</td>
                                <td>{{ Helper::rupiah($householdAllowance->jumlah) }}</td>
                                <td class="d-flex">
                                    <a href="{{ url()->to("gaji-pegawai/tunjangan/tetap/$allowance->nip/kepala-keluarga/$householdAllowance->id/edit") }}"
                                        class="btn btn-primary btn-xs btn-action mr-1" id="edit" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form
                                        action="{{ url()->to("gaji-pegawai/tunjangan/tetap/$allowance->nip/kepala-keluarga/$householdAllowance->id/remove") }}"
                                        method="post">
                                        @csrf
                                        <button class="btn btn-danger btn-xs delete-data mr-1">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" align="center">
                                    Data kosong
                                </td>
                                <td>
                                    <button class="kepala-keluarga btn btn-success btn-action btn-xs mr-1">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>
                                Total Keseluruhan
                            </td>
                            <td colspan="2" class="text-success text-right">
                                {{ Helper::rupiah($allowance->household_allowances_sum_jumlah) }}
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
                        <form action="{{ url()->to('gaji-pegawai/tunjangan/tetap/add') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="nip" value="{{ $allowance->nip }}">
                                <input type="hidden" name="tunjangan" value="masa-kerja">
                                <div class="section-title mt-0">Jumlah Tunjangan Masa Kerja</div>
                                <div class="input-group mb-2">
                                    <input type="number" class="form-control" name="jumlah[]" required>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-primary mr-1" type="submit" name="submit3">Simpan</button>

                                <button type="button" class="close-btn btn btn-danger" data-dismiss="modal"
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
                        @forelse ($allowance->seniorityAllowances as $seniorityAllowance)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $seniorityAllowance->nama }}</td>
                                <td>{{ Helper::rupiah($seniorityAllowance->jumlah) }}</td>
                                <td class="d-flex">
                                    <a href="{{ url()->to("gaji-pegawai/tunjangan/tetap/$allowance->nip/masa-kerja/$seniorityAllowance->id/edit") }}"
                                        class="btn btn-primary btn-xs btn-action mr-1" id="edit" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form
                                        action="{{ url()->to("gaji-pegawai/tunjangan/tetap/$allowance->nip/masa-kerja/$seniorityAllowance->id/remove") }}"
                                        method="post">
                                        @csrf
                                        <button class="btn btn-danger btn-xs delete-data mr-1">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" align="center">
                                    Data kosong
                                </td>
                                <td>
                                    <button class="masa-kerja btn btn-success btn-action btn-xs mr-1">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>
                                Total Keseluruhan
                            </td>
                            <td colspan="2" class="text-success text-right">
                                {{ Helper::rupiah($allowance->seniority_allowances_sum_jumlah) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <h4>Tunjangan Operasional</h4>
            <div class="modal-dialog mw-100" role="document" id="operasional-form">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" id="exampleModalLabel3" class="close btn-danger" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="width: 100%;">
                        <form action="{{ url()->to('gaji-pegawai/tunjangan/tetap/add') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="nip" value="{{ $allowance->nip }}">
                                <input type="hidden" name="tunjangan" value="operasional">
                                <div class="section-title mt-0">Jumlah Tunjangan Operasional</div>
                                <div class="input-group mb-2">
                                    <input type="number" class="form-control" name="jumlah[]" required>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-primary mr-1" type="submit" name="submit3">Simpan</button>
                                <button type="button" class="close-btn btn btn-danger" data-dismiss="modal"
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
                        @forelse ($allowance->operationalAllowances as $operationalAllowance)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $operationalAllowance->nama }}</td>
                                <td>{{ Helper::rupiah($operationalAllowance->jumlah) }}</td>
                                <td class="d-flex">
                                    <a href="{{ url()->to("gaji-pegawai/tunjangan/tetap/$allowance->nip/operasional/$operationalAllowance->id/edit") }}"
                                        class="btn btn-primary btn-xs btn-action mr-1" id="edit" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form
                                        action="{{ url()->to("gaji-pegawai/tunjangan/tetap/$allowance->nip/operasional/$operationalAllowance->id/remove") }}"
                                        method="post">
                                        @csrf
                                        <button class="btn btn-danger btn-xs delete-data mr-1">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" align="center">
                                    Data kosong
                                </td>
                                <td>
                                    <button class="operasional btn btn-success btn-action btn-xs mr-1">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>
                                Total Keseluruhan
                            </td>
                            <td colspan="2" class="text-success text-right">
                                {{ Helper::rupiah($allowance->operational_allowances_sum_jumlah) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <h4>Tunjangan Lain-lain</h4>
            <div class="modal-dialog mw-100" role="document" id="lain-lain-form">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" id="exampleModalLabel3" class="close btn-danger" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="width: 100%;">
                        <form action="{{ url()->to('gaji-pegawai/tunjangan/tetap/add') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="nip" value="{{ $allowance->nip }}">
                                <input type="hidden" name="tunjangan" value="lain-lain">
                                <div class="section-title mt-0">Jumlah Tunjangan Lain-lain</div>
                                <div class="input-group mb-2">
                                    <input type="number" class="form-control" name="jumlah[]" required>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-primary mr-1" type="submit" name="submit3">Simpan</button>
                                <button type="button" class="close-btn btn btn-danger" data-dismiss="modal"
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
                        @forelse ($allowance->etcAllowances as $etcAllowance)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $etcAllowance->nama }}</td>
                                <td>{{ Helper::rupiah($etcAllowance->jumlah) }}</td>
                                <td class="d-flex">
                                    <a href="{{ url()->to("gaji-pegawai/tunjangan/tetap/$allowance->nip/lain-lain/$etcAllowance->id/edit") }}"
                                        class="btn btn-primary btn-xs btn-action mr-1" id="edit" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form
                                        action="{{ url()->to("gaji-pegawai/tunjangan/tetap/$allowance->nip/lain-lain/$etcAllowance->id/remove") }}"
                                        method="post">
                                        @csrf
                                        <button class="btn btn-danger btn-xs delete-data mr-1">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" align="center">
                                    Data kosong
                                </td>
                                <td>
                                    <button class="lain-lain btn btn-success btn-action btn-xs mr-1">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>
                                Total Keseluruhan
                            </td>
                            <td colspan="2" class="text-success text-right">
                                {{ Helper::rupiah($allowance->seniority_allowances_sum_jumlah) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <h4>Reward</h4>
            <div class="modal-dialog mw-100" role="document" id="reward-form">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" id="exampleModalLabel4" class="close btn-danger" data-dismiss="modal"
                            aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="width: 100%;">
                        <form action="{{ url()->to('gaji-pegawai/tunjangan/tetap/add') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="nip" value="{{ $allowance->nip }}">
                                <input type="hidden" name="tunjangan" value="reward">
                                <div class="section-title mt-0">Jumlah Reward</div>
                                <div class="input-group mb-2">
                                    <input type="number" class="form-control" name="jumlah[]" required>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-primary mr-1" type="submit" name="submit4">Simpan</button>

                                <button type="button" class="close-btn btn btn-danger" data-dismiss="modal"
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
                        @forelse ($allowance->rewards as $reward)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $reward->nama }}</td>
                                <td>{{ Helper::rupiah($reward->jumlah) }}</td>
                                <td class="d-flex">
                                    <a href="{{ url()->to("gaji-pegawai/tunjangan/tetap/$allowance->nip/reward/$reward->id/edit") }}"
                                        class="btn btn-primary btn-xs btn-action mr-1" id="edit" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form
                                        action="{{ url()->to("gaji-pegawai/tunjangan/tetap/$allowance->nip/reward/$reward->id/remove") }}"
                                        method="post">
                                        @csrf
                                        <button class="btn btn-danger btn-xs delete-data mr-1">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" align="center">
                                    Data kosong
                                </td>
                                <td>
                                    <button class="reward btn btn-success btn-action btn-xs mr-1">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>
                                Total Keseluruhan
                            </td>
                            <td colspan="2" class="text-right text-success">
                                {{ Helper::rupiah($allowance->rewards_sum_jumlah) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <h4>Lembur</h4>
            <div class="modal-dialog mw-100" role="document" id="lembur-form">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" id="exampleModalLabel5" class="close btn-danger" data-dismiss="modal"
                            aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="width: 100%;">
                        <form action="{{ url()->to('gaji-pegawai/tunjangan/tetap/add') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="nip" value="{{ $allowance->nip }}">
                                <input type="hidden" name="tunjangan" value="lembur">
                                <div class="section-title mt-0">Jumlah</div>
                                <div class="input-group mb-2">
                                    <input type="number" class="form-control" name="jumlah[]" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary mr-1" type="submit" name="submit5">Simpan</button>
                                <button type="button" class="close-btn btn btn-danger" data-dismiss="modal"
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
                        @forelse ($allowance->overtimes as $overtime)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $overtime->nama }}</td>
                                <td>{{ Helper::rupiah($overtime->jumlah) }}</td>
                                <td class="d-flex">
                                    <a href="{{ url()->to("gaji-pegawai/tunjangan/tetap/$allowance->nip/lembur/$overtime->id/edit") }}"
                                        class="btn btn-primary btn-xs btn-action mr-1" id="edit" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form
                                        action="{{ url()->to("gaji-pegawai/tunjangan/tetap/$allowance->nip/lembur/$overtime->id/remove") }}"
                                        method="post">
                                        @csrf
                                        <button class="btn btn-danger btn-xs delete-data mr-1">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" align="center">
                                    Data kosong
                                </td>
                                <td>
                                    <button class="lembur btn btn-success btn-action btn-xs mr-1">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>
                                Total Keseluruhan
                            </td>
                            <td colspan="2" class="text-right text-success">
                                {{ Helper::rupiah($allowance->overtimes_sum_jumlah) }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <h4>Infaq</h4>
            <div class="modal-dialog mw-100" role="document" id="infaq-form">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" id="exampleModalLabel6" class="close btn-danger" data-dismiss="modal"
                            aria-label="Close"><span aria-hidden="true">&times;</span></button>

                    </div>
                    <div class="modal-body" style="width: 100%;">
                        <form action="{{ url()->to('gaji-pegawai/tunjangan/tetap/add') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="nip" value="{{ $allowance->nip }}">
                                <input type="hidden" name="tunjangan" value="infaq">
                                <div class="section-title mt-0">Jumlah Infaq</div>
                                <div class="input-group mb-2">
                                    <input type="number" class="form-control" name="jumlah[]" required>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-primary mr-1" type="submit" name="submit6">Simpan</button>
                                <button type="button" class="close-btn btn btn-danger" data-dismiss="modal"
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
                        @forelse ($allowance->infaqs as $infaq)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $infaq->nama }}</td>
                                <td>{{ Helper::rupiah($infaq->jumlah) }}</td>
                                <td class="d-flex">
                                    <a href="{{ url()->to("gaji-pegawai/tunjangan/tetap/$allowance->nip/infaq/$infaq->id/edit") }}"
                                        class="btn btn-primary btn-xs btn-action mr-1" id="edit" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form
                                        action="{{ url()->to("gaji-pegawai/tunjangan/tetap/$allowance->nip/infaq/$infaq->id/remove") }}"
                                        method="post">
                                        @csrf
                                        <button class="btn btn-danger btn-xs delete-data mr-1">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" align="center">
                                    Data kosong
                                </td>
                                <td>
                                    <button class="infaq btn btn-success btn-action btn-xs mr-1">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>
                                Total Keseluruhan
                            </td>
                            <td colspan="2" class="text-right text-danger">
                                {{ Helper::rupiah($allowance->infaqs_sum_jumlah) }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <h4>Cicilan</h4>
            <div class="modal-dialog mw-100" role="document" id="cicilan-form">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" id="exampleModalLabel7" class="close btn-danger" data-dismiss="modal"
                            aria-label="Close"><span aria-hidden="true">&times;</span></button>

                    </div>
                    <div class="modal-body" style="width: 100%;">
                        <form action="{{ url()->to('gaji-pegawai/tunjangan/tetap/add') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="nip" value="{{ $allowance->nip }}">
                                <input type="hidden" name="tunjangan" value="cicilan">
                                <div class="section-title mt-0">Jumlah Cicilan</div>
                                <div class="input-group mb-2">
                                    <input type="number" class="form-control" name="jumlah[]" required>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-primary mr-1" type="submit" name="submit7">Simpan</button>

                                <button type="button" class="close-btn btn btn-danger" data-dismiss="modal"
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
                        @forelse ($allowance->installments as $installment)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $installment->nama }}</td>
                                <td>{{ Helper::rupiah($installment->jumlah) }}</td>
                                <td class="d-flex">
                                    <a href="{{ url()->to("gaji-pegawai/tunjangan/tetap/$allowance->nip/cicilan/$installment->id/edit") }}"
                                        class="btn btn-primary btn-xs btn-action mr-1" id="edit" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form
                                        action="{{ url()->to("gaji-pegawai/tunjangan/tetap/$allowance->nip/cicilan/$installment->id/remove") }}"
                                        method="post">
                                        @csrf
                                        <button class="btn btn-danger btn-xs delete-data mr-1">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" align="center">
                                    Data kosong
                                </td>
                                <td>
                                    <button class="cicilan btn btn-success btn-action btn-xs mr-1">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>
                                Total Keseluruhan
                            </td>
                            <td colspan="2" class="text-right text-danger">
                                {{ Helper::rupiah($allowance->installments_sum_jumlah) }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(() => {
            $('#keahlian-form').hide();
            $('#kepala-keluarga-form').hide();
            $('#masa-kerja-form').hide();
            $('#operasional-form').hide();
            $('#lain-lain-form').hide();
            $('#reward-form').hide();
            $('#lembur-form').hide();
            $('#infaq-form').hide();
            $('#cicilan-form').hide();
            $('.keahlian').click(function() {
                $('#keahlian-form').show('fade');
                $('.close').click(function() {
                    $('#keahlian-form').hide('fade');
                });
                $('.close-btn').click(function() {
                    $('#keahlian-form').hide('fade');
                });
            });
            $('.kepala-keluarga').click(function() {
                $('#kepala-keluarga-form').show('fade');
                $('.close').click(function() {
                    $('#kepala-keluarga-form').hide('fade');
                });
                $('.close-btn').click(function() {
                    $('#kepala-keluarga-form').hide('fade');
                });
            });
            $('.masa-kerja').click(function() {
                $('#masa-kerja-form').show('fade');
                $('.close').click(function() {
                    $('#masa-kerja-form').hide('fade');
                });
                $('.close-btn').click(function() {
                    $('#masa-kerja-form').hide('fade');
                });
            });
            $('.operasional').click(function() {
                $('#operasional-form').show('fade');
                $('.close').click(function() {
                    $('#operasional-form').hide('fade');
                });
                $('.close-btn').click(function() {
                    $('#operasional-form').hide('fade');
                });
            });
            $('.lain-lain').click(function() {
                $('#lain-lain-form').show('fade');
                $('.close').click(function() {
                    $('#lain-lain-form').hide('fade');
                });
                $('.close-btn').click(function() {
                    $('#lain-lain-form').hide('fade');
                });
            });
            $('.reward').click(function() {
                $('#reward-form').show('fade');
                $('.close').click(function() {
                    $('#reward-form').hide('fade');
                });
                $('.close-btn').click(function() {
                    $('#reward-form').hide('fade');
                });
            });
            $('.lembur').click(function() {
                $('#lembur-form').show('fade');
                $('.close').click(function() {
                    $('#lembur-form').hide('fade');
                });
                $('.close-btn').click(function() {
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
