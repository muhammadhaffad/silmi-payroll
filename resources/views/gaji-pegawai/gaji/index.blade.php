@extends('gaji-pegawai.layout.app', ['title' => 'Gaji'])
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header bg-primary py-3">
            <h4 class="text-white">Data Gaji</h4>
            <div class="card-header-action">
            </div>
        </div>
        <form action="" method="get" onchange="return this.submit()">
            <div class="d-flex px-4 pt-2">
                <div class="form-group mr-2">
                    <label for="year">Tahun:</label>
                    <select class="form-control" name="year" id="year">
                      @for ($year = 2010; $year <= (int) date('Y'); $year++)
                      <option value="{{$year}}" @selected($year == (request()->year ?? date('Y')))>{{$year}}</option>
                      @endfor
                    </select>
                </div>
                @php
                    $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustur', 'September', 'Oktober', 'November', 'Desember']
                @endphp
                <div class="form-group">
                    <label for="month">Bulan:</label>
                    <select class="form-control" name="month" id="month">
                      @foreach ($months as $key => $month)
                      <option value="{{$key+1}}" @selected($key+1 == (request()->month ?? date('m')))>{{$month}}</option>
                      @endforeach
                    </select>
                </div>
            </div>
        </form>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th class="text-nowrap">Nama Karyawan</th>
                            <th>Devisi</th>
                            <th>T. Tetap</th>
                            <th class="text-nowrap">T. Tidak Tetap</th>
                            <th>Take Home</th>
                            <th>Copy Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody> 
                        @forelse ($salaries as $salary)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$salary->nama}}</td>
                                <td>{{$salary->devisi}}</td>
                                <td>{{Helper::rupiah($salary->tunjangan_keahlian + $salary->tunjangan_kepala_keluarga + $salary->tunjangan_masa_kerja + $salary->lembur + $salary->reward - $salary->infaq - $salary->cicilan)}}</td>
                                @if ($salary->is_khusus)
                                <td>{{Helper::rupiah($salary->gaji_pokok + $salary->tunjangan_jabatan)}}</td>
                                <td>{{Helper::rupiah($salary->take_home)}}</td>
                                @else
                                <td>{{Helper::rupiah($salary->perjam * $salary->total_jam)}}</td>
                                <td>{{Helper::rupiah($salary->take_home)}}</td>
                                @endif
                                <td>
                                    @if (!$salary->is_khusus)
                                    <form target="_blank" action="{{url()->to("gaji-pegawai/gaji-perjam/gambar/$salary->nip")}}" method="post">
                                        @csrf
                                        <input type="hidden" name="year" value="{{request()->year}}">
                                        <input type="hidden" name="month" value="{{request()->month}}">
                                        <button class="btn btn-primary btn-xs mb-1 mr-1 text-nowrap" title="Per Jam"><i class="fa fa-image"></i>&nbsp;Perjam
                                        </button>
                                    </form>
                                    @endif
                                    <form target="_blank" action="{{url()->to("gaji-pegawai/gaji/gambar/$salary->nip")}}" method="post">
                                        @csrf
                                        <input type="hidden" name="year" value="{{request()->year}}">
                                        <input type="hidden" name="month" value="{{request()->month}}">
                                        <button class="btn btn-info btn-xs mr-1 text-nowrap" title="Cetak"><i class="fa fa-image"></i>&nbsp;Gaji
                                        </button>
                                    </form>
                                    {{-- <a href="bagikan.php?id=" class="btn mt-1 btn-info btn-xs mr-1" title="copygaji">
                                        <i class="fas fa-images"></i>&nbsp;Copy Gaji
                                    </a> --}}
                                    {{-- <a href="bagikanperjam.php?id=" class="btn btn-primary btn-xs mr-1 mt-2" title="copyperjam">
                                        <i class="fas fa-images"></i>&nbsp;Copy Perjam
                                    </a> --}}
                                </td>
                                <td>
                                    <form target="_blank" action="{{url()->to("gaji-pegawai/gaji/print/$salary->nip")}}" method="post">
                                        @csrf
                                        <input type="hidden" name="year" value="{{request()->year}}">
                                        <input type="hidden" name="month" value="{{request()->month}}">
                                        <button class="btn btn-danger btn-xs mr-1 text-nowrap" title="Cetak"><i class="fa fa-file-pdf-o"></i>&nbsp;Print
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" align="center">Data Kosong, Silahkan buat laporan bulan ini</td>
                            </tr>
                        @endforelse
                        {{-- <tr>
                            <td>1</td>
                            <td>Karyawan 1</td>
                            <td class="text-nowrap">IT Support</td>
                            <td>{{ Helper::rupiah(200000) }}</td>
                            <td>{{ Helper::rupiah(200000) }}</td>
                            <td>{{ Helper::rupiah(1500000) }}</td>
                            <td>
                                <a href="bagikan.php?id=" class="btn btn-info btn-xs mr-1"
                                    title="copygaji"><i class="fas fa-images"></i>&nbsp;Copy Gaji</a>
                                <a href="bagikanperjam.php?id="
                                    class="btn btn-primary btn-xs mr-1 mt-2" title="copyperjam"><i
                                        class="fas fa-images"></i>&nbsp;Copy Perjam</a>
                            </td>
                            <td>
                                <a href="cetak.php?id=" class="btn btn-danger btn-xs mr-1 text-nowrap"
                                    title="Cetak"><i class="fa fa-file-pdf-o"></i>&nbsp;Print</a>
                            </td>
                        </tr> --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
