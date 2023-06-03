@extends('gaji-penjahit.layout.app', ['title' => 'Entri Data Gaji'])
@section('content')
    <h3>Entri Data Gaji</h3>
    <div class="card">
        <div class="card-header d-flex">
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Penjahit</th>
                            <th>Total Jahit</th>
                            <th>Kompensasi (%)</th>
                            <th>Kompensasi Total Jahit</th>
                            <th>Total Kebutuhan Jahit</th>
                            <th>Cacat (%)</th>
                            <th>Kompensasi Cacat (%)</th>
                            <th>Kompensasi Cacat</th>
                            <th>Cicilan</th>
                            <th>infaq</th>
                            <th>Bubut</th>
                            <th>Gaji Final</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($employees as $employee)
                        @php
                            $finalSalary = $employee->sewing_tasks_sum_total 
                                + (($employee->sewingCompensation->kompensasi_persen ?? 0)*$employee->sewing_tasks_sum_total/100)
                                + (($employee->sewingDefect->kompensasi_persen ?? 0)*$employee->sewing_tasks_sum_total/100)
                                + $employee->trimming->jumlah
                                - $employee->sewing_needs_sum_total
                                - $employee->installment->jumlah
                                - $employee->infaq->jumlah;
                        @endphp
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>
                                {{$employee->nama}}
                            </td>
                            <td>{{Helper::rupiah($employee->sewing_tasks_sum_total)}}</td>
                            <td>{{$employee->sewingCompensation->kompensasi_persen ?? 0}}%</td>
                            <td>{{Helper::rupiah(($employee->sewingCompensation->kompensasi_persen ?? 0)*$employee->sewing_tasks_sum_total/100)}}</td>
                            <td>{{Helper::rupiah($employee->sewing_needs_sum_total)}}</td>
                            <td>{{$employee->sewingDefect->cacat_persen ?? 0}}%</td>
                            <td>{{$employee->sewingDefect->kompensasi_persen ?? 0}}%</td>
                            <td>{{Helper::rupiah(($employee->sewingDefect->kompensasi_persen ?? 0)*$employee->sewing_tasks_sum_total/100)}}</td>
                            <td>{{Helper::rupiah($employee->installment->jumlah)}}</td>
                            <td>{{Helper::rupiah($employee->infaq->jumlah)}}</td>
                            <td>{{Helper::rupiah($employee->trimming->jumlah)}}</td>
                            <td>{{Helper::rupiah($finalSalary)}}</td>
                            <td class="d-flex">
                                <a href="{{route('entri-data-gaji.show', ['id' => $employee->id])}}" class="btn btn-primary btn-xs btn-action mr-1" title="Entri/Edit">
                                    <i class="fas fa-edit">
                                    </i>
                                </a>
                                <button class="btn btn-danger btn-xs delete-data mr-1" title="hapus">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                <div class="modal fade" id="editDataJahit-1" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Data Jahit</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group w-100 pr-2">
                                                    <label for="inputNamaModal">Nama</label>
                                                    <input type="text" class="form-control" id="inputNamaModal" placeholder="Masukan nama">
                                                </div>
                                                <div class="form-group w-100 pr-2">
                                                    <label for="inputHargaModal">Harga</label>
                                                    <input type="number" class="form-control" id="inputHargaModal" placeholder="Nominal harga">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Tutup</button>
                                                <button type="button" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                            
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
