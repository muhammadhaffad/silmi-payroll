@extends('gaji-pegawai.layout.app', ['title' => 'Tunjangan Tidak Tetap'])
@push('script')
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
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row ">
                <div class="col-12">
                    <form action="{{url()->to("gaji-pegawai/tunjangan/tidak-tetap/$nip/update")}}" enctype="multipart/form-data" method="post">
                        @method('PUT')
                        @csrf
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>Updhate Data Tunjangan Tidak Tetap</h4>
                                <div class="card-header-action text-right">
                                    <a href="{{ url()->to('gaji-pegawai/tunjangan/tidak-tetap') }}" class="btn btn-primary btn-action btn-xs mr-1"
                                        title="kembali"><span>Kembali</span>
                                    </a>
                                </div>
                            </div>
                            <div class="container">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <div class="section-title mt-0">Gaji Pokok</div>
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" value="{{ $allowance->gaji_pokok }}"
                                                        name="gaji_pokok" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="section-title mt-0">Tunjangan Jabatan</div>
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" value="{{ $allowance->tunjangan_jabatan }}"
                                                        name="tunjangan_jabatan" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary mr-1" type="submit" name="submit">Edit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('style')
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
@endpush
