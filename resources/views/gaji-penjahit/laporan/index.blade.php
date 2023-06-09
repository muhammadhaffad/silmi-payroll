@extends('gaji-penjahit.layout.app', ['title' => 'Dashboard'])
@push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endpush
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
@endpush
@section('content')
    <form action="{{route('laporan.buat-laporan')}}" method="post">
        @csrf
        <div class="d-flex mb-4">
            <h3>Laporan Gaji Penjahit</h3>
            <button type="submit" class="ml-auto btn btn-success text-nowrap">
                <i class="fas fa-file"></i> Buat Laporan Bulan Ini
            </button>
        </div>
    </form>
    <div class="card">
        <div class="card-header d-flex justify-content-end">
            <form target="_blank" action="{{route('laporan.get-laporan')}}" method="post">
            @csrf
            <button type="submit" class="ml-auto btn btn-danger text-nowrap">
                <i class="fas fa-file-pdf"></i> Cetak Bulan Ini
            </button>
            </form>
        </div>
        <form target="_blank" action="{{route('laporan.get-laporan')}}" method="post">
            @csrf
            <div class="card-body">
                <div class="widget-body">
                    <div class="form-group">
                        <select class="form-control selectpicker" name="tahun"
                            data-live-search="true" data-style="border-dark" required>
                            <option disabled selected value="">Pilih Tahun </option>
                            @for ($year = (int) date('Y'); $year >= 2010; $year--)
                                <option value="{{ $year }}">{{ $year }}
                                </option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="widget-body">
                    <div class="form-group">
                        <select class="form-control selectpicker" name="bulan"
                            data-live-search="true" data-style="border-dark" required>
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
                <div class="d-flex">
                    <button type="submit" class="ml-auto btn btn-primary text-nowrap">
                        <i class="fas fa-file-pdf"></i> Cetak Laporan
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
