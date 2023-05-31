@extends('gaji-penjahit.layout.app', ['title' => 'Dashboard'])
@push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endpush
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush
@section('content')
    <div class="card text-center">
        <div class="card-header d-flex">
            <h5 class="font-weight-bold w-100 mb-0 p-2 d-block">Grafik Gaji Penjahit Tahun
                {{ request()->tahun ?? date('Y') }}</h5>
            <form action="" method="get" onchange="return this.submit()">
                <select class="selectpicker w-100" name="tahun" data-live-search="true" data-style="btn-primary">
                    <option value="" disabled selected>Pilih Tahun</option>
                    @for ($year = (int) date('Y'); $year >= 2018; $year--)
                        <option value="{{ $year }}" @selected(request()->tahun == $year)>{{ $year }}</option>
                    @endfor
                </select>
            </form>
        </div>
        <div class="card-body">
            <canvas id="chartGajiPenjahit"></canvas>
        </div>
    </div>
@endsection
@push('script')
    <script>
        const ctx = document.getElementById('chartGajiPenjahit');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
                    'Oktober', 'November', 'Desember'
                ],
                datasets: [{
                    label: 'Total Gaji',
                    data: [0, 0, 1000000, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                    borderColor: '#000',
                }]
            },
            options: {
                scales: {
                    y: {
                        min: 0,
                        max: 2000000,
                    }
                }
            }
        });
    </script>
@endpush
