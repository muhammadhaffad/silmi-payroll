@extends('gaji-pegawai.layout.app', ['title' => 'Dashboard'])
@section('content')
    <div class="fixed-notification top-right-corner">
        <div class="info info--success bg-white flex-row p-4 mb-3 shadow d-flex justify-content-between align-items-center">
            <div class="d-block">
                <a href="#!" class="close">x</a>
                <div class="row container">
                    <div class="center mt-4">
                        <img class="img-profile rounded-circle img-fluid" width="100px" height="100px"
                            src="{{ asset('assets/img/undraw_profile.svg') }}">
                    </div>
                    <div class="col-lg-6 text-left ml-4">
                        <h4 class="font-weight-bold">INFORMASI</h4>
                        <h5> Anda Terakhir Login</h5>
                        <span>( {{ date('Y-m-d H:i:s') }} )</span><br><br>
                        <span class="font-weight-bold">Ip Anda : </span> {{ '127.0.0.1' }} </span> <br>
                        <span class="font-weight-bold">Device Anda : </span> <span> {{ 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                jumlah Karyawan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ 48 }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Jumlah Tunjangan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">4</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Jam Kerja Karyawan
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">7 Jam</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Online</div>
                            <div class="h5 mb-0 font-weight-bold text-success-800">1</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg-6 mb-4">
            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Grafik Gaji Karyawan <br>
                    </h6>
                    <div class="dropdown no-arrow">
                        {{ request()->get('tahun') ?? date('Y') }}
                    </div>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <button name="pilih2" id="pilih2" class="form-control btn btn-primary rounded px-3">Pilih Tahun</button>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Tahun</div>
                            @for ($year = 2010; $year <= date('Y'); $year++)
                                <form action="" method="get">
                                    <button class="dropdown-item" type="submit" id="tahun" name="tahun" value="{{ $year }}">
                                        {{ $year }}
                                    </button>
                                </form>
                            @endfor
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <canvas id="chartGajiPerdevisi"></canvas>
                    <input id="data-gaji-perdevisi" type="hidden" value="{{ '[40000000, 60000000, 39000000, 150000000, 39000000, 10000000]' }}">
                </div>
            </div>
        </div>


        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Grafik Data Karyawan 
                        <br>
                        @if(request()->get('devisi') !== null)
                            {{ 'Devisi '.request()->get('devisi') }}
                        @endif
                    </h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <button name="pilih2" id="pilih2" class="form-control btn btn-primary rounded px-3">Pilih Devisi</button>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Devisi</div>
                            <a class="dropdown-item" href="">Tampilkan Semua</a>
                            @php
                                $devisions = ['Manajemen', 'MARKOM', 'PRODUKSI', 'RND', 'SALES', 'TOKO'];
                            @endphp
                            @foreach ($devisions as $devision)
                                <form action="" method="get">
                                    <button class="dropdown-item" type="submit" name="devisi"
                                        value="{{ $devision }}" href="#">{{ $devision }}
                                    </button>
                                </form>    
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="card-body" id="hasil">
                    <canvas id="chartJumlahGender"></canvas>
                    <input type="hidden" id="data-jumlah-gender" value="{{ '[17, 31]' }}">
                    <span class="text-bold"> 
                        <i class="fas fa-male"></i>
                        Laki - Laki : 17
                    </span>
                    <br>
                    <span> 
                        <i class="fas fa-female"></i> 
                        Perempuan : 31
                    </span>
                    <br><br>
                    <span class="text-bold"> 
                        Total : 48
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4 " id="evaluasi">
        <div class="card-header py-3">
            <div class="card-header-action">
                <h5>Evaluasi Karyawan</h5>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nip</th>
                            <th class="text-center">Nama Karyawan</th>
                            <th class="text-center">Jabatan / Devisi</th>
                            <th class="text-center">Tanggal Masuk</th>
                            <th class="text-center">Waktu Bekerja</th>
                            <th class="text-center">Status Karyawan</th>
                            <th class="text-center">Keterangan</th>
                            <th class="text-center">Evaluasi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            @php
                                $diffDate = Carbon\Carbon::parse('2023-04-25')->diff(Carbon\Carbon::now());
                                $year = $diffDate->format('%y');
                                $month = $diffDate->format('%m');
                                $day = $diffDate->format('%d');
                            @endphp
                            <td>1</td>
                            <td>207</td>
                            <td>Karyawan 1</td>
                            <td>IT Support</td>
                            <td>{{ Carbon\Carbon::parse('2023-04-25')->format('Y-m-d') }}</td>
                            <td>
                                {{ "$year Tahun, $month Bulan, $day Hari" }}
                            </td>
                            <td>
                                <span>
                                    @if ($year >= 1)
                                        Karyawan Tetap
                                    @else
                                        Karyawan Kontrak
                                    @endif
                                </span>
                            </td>
                            <td>
                                @if ($year < 1 && $month < 6 && $day > 23)
                                    <span>
                                        Mau {{$month + 1}} bulan 
                                    </span>
                                @else
                                    <span>
                                        -
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if ($year < 1 && $month < 6 && $day > 23)
                                    <h5> 
                                        <span class="badge bg-danger text-white">Perlu Evaluasi Bulan Ini</span> 
                                    </h5>
                                @else
                                    <span>
                                        -
                                    </span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $(".info .daftar").click(function() {
                $(this).closest(".info").remove();
            })

            $(".info .close").click(function() {
                $(this).closest(".info").remove();
            })
        })
    </script>
    <script>
        const dataGajiPerdevisi = JSON.parse($('#data-gaji-perdevisi').val());
        const chartGajiPerdevisi = new Chart(document.getElementById("chartGajiPerdevisi").getContext('2d'), {
            type: 'bar',
            data: {
                labels: ["SALES", "MANAJEMEN", "RND", "PRODUKSI", 'MARKOM', 'TOKO'],
                datasets: [{
                    label: 'Data Gaji Karyawan Per Devisi',
                    data: dataGajiPerdevisi,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
    <script type="text/javascript">
        const dataJumlahGender = JSON.parse($('#data-jumlah-gender').val());
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#292b2c';
        // Pie Chart Example
        const chartJumlahGender = new Chart(document.getElementById("chartJumlahGender"), {
            type: 'pie',
            data: {
                labels: ["Laki laki", "Perempuan"],
                datasets: [{
                    label: '',
                    data: dataJumlahGender,
                    backgroundColor: ['#007bff', '#dc3545'],
                }],
            },
        });
    </script>
@endpush