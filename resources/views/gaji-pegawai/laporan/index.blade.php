@extends('gaji-pegawai.layout.app', ['title' => 'Laporan'])
@push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
@endpush
@section('content')
    <div class="card-body mx-auto">
        <div class="row ">
            <div class="col-12">
                <div class="card">
                    <div class="card-header py-3 d-flex align-items-center justify-content-between">
                        <div class="">
                            <h6 class="m-0 font-weight-bold text-primary">Rekap Laporan Gaji Bulan ini</h6>
                            {{-- <form action="" method="get" onchange="return this.submit()">
                                <div class="d-flex py-2">
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
                            </form> --}}
                        </div>
                        <div>
                            <a href="{{ url()->to('gaji-pegawai/laporan/make-report') }}" role="button" id="dropdownMenuLink"
                                class="btn btn-primary" aria-expanded="false">
                                Buat Laporan Bulan Ini
                            </a>
                            {{-- <a href="cetakgajidevisi.php" role="button" id="dropdownMenuLink" class="btn btn-success"
                                aria-expanded="false">
                                <i class="fas fa-print"></i> &nbsp; Cetak Gaji Bulan Ini
                            </a> --}}
                        </div>
                    </div>
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="card-body row">
                                    <div class="table-responsive mt-3">
                                        <table class="table table-bordered" width="100%" cellspacing="0">
                                            <thead>
                                                <tr class="bg-dark text-white">
                                                    <th>No</th>
                                                    <th>Devisi</th>
                                                    <th>Total Gaji</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $allTotal = 0;
                                                @endphp
                                                <tr>
                                                    <td>1</td>
                                                    <td>DIREKSI</td>
                                                    <td>
                                                        @php
                                                            $total = 0;
                                                            $directors = App\Models\Director::all();
                                                            foreach ($directors as $director) {
                                                                $total += $director->gaji + $director->gaji_tambahan;
                                                            }
                                                            $allTotal += $total;
                                                        @endphp
                                                        {{ Helper::rupiah($total) }}
                                                    </td>
                                                </tr>
                                                @foreach ($salaries as $devision)
                                                    <tr>
                                                        <td>{{ $loop->iteration + 1 }}</td>
                                                        <td>{{ $devision->nama }}</td>
                                                        <td>
                                                            @php
                                                                $total = 0;
                                                                foreach ($devision->employees as $employee) {
                                                                    if ($employee->is_khusus) {
                                                                        $tunjanganTidakTetap = $employee->variableAllowance->gaji_pokok + $employee->variableAllowance->tunjangan_jabatan;
                                                                        $tunjanganTetap = $employee->fixedAllowance?->total ?? 0;
                                                                        $total += $tunjanganTetap + $tunjanganTidakTetap;
                                                                        // dump($tunjanganTetap);
                                                                    } else {
                                                                        $tunjanganTidakTetap = $employee->variableAllowance->perjam * $employee->attendance_logs_sum_total_jam;
                                                                        $tunjanganTetap = $employee->fixedAllowance?->total ?? 0;
                                                                        $total += $tunjanganTetap + $tunjanganTidakTetap;
                                                                        // dump($tunjanganTetap);
                                                                    }
                                                                }
                                                                $allTotal += $total;
                                                            @endphp
                                                            {{ Helper::rupiah($total) }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tr class="bg-danger text-white">
                                                    <td colspan="2">Total Keseluruhan</td>
                                                    <td class="text-right">{{ Helper::rupiah($allTotal) }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h4>LAPORAN GAJI DEVISI PER BULAN DAN TAHUN </h4>
                            <div class="card-header-action text-right">
                            </div>
                        </div>
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="card-body">
                                        <form action="{{ url()->to('gaji-pegawai/laporan/print-full') }}" method="POST">
                                            @csrf
                                            <div class="widget-body mt-3">
                                                <div class="form-group">
                                                    <select class="form-control selectpicker" name="devision"
                                                        id="devisi" data-live-search="true" required>
                                                        <option disabled selected value="">Pilih Devisi</option>
                                                        @foreach (App\Models\Devision::all() as $devision)
                                                            <option value="{{ $devision->nama }}">{{ $devision->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="widget-body mt-3">
                                                    <div class="form-group">
                                                        <select class="form-control selectpicker" name="month"
                                                            data-live-search="true" required>
                                                            <option disabled selected value="">Pilih Bulan </option>
                                                            @php
                                                                $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustur', 'September', 'Oktober', 'November', 'Desember'];
                                                            @endphp
                                                            @foreach ($months as $k => $month)
                                                                <option value="{{ $k + 1 }}">{{ $month }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="widget-body mt-3">
                                                    <div class="form-group">
                                                        <select class="form-control selectpicker" name="year"
                                                            data-live-search="true" required>
                                                            <option disabled selected value="">Pilih Tahun </option>
                                                            @for ($year = (int) date('Y'); $year >= 2010; $year--)
                                                                <option value="{{ $year }}">{{ $year }}
                                                                </option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-danger mr-1" type="submit" name="pdf">
                                                        <i class="fa fa-file-pdf-o"></i>&nbsp;Cetak PDF
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
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
