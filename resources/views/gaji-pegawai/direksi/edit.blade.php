@extends('gaji-pegawai.layout.app', ['title' => 'Direksi'])
@push('style')
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
@endpush
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row ">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>Update Data</h4>
                            <div class="card-header-action text-right">
                                <a href="{{ url()->to('gaji-pegawai/data-master/direksi') }}" class="btn btn-primary btn-action btn-xs mr-1"
                                    title="kembali"><span>Kembali</span></a>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="card-body">
                                        <form id="edit-direksi" action="{{url()->to("/gaji-pegawai/data-master/direksi/$director->id/edit")}}" enctype="multipart/form-data" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <div class="form-group">
                                                <div class="section-title mt-0">Nama Direksi</div>
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" value="{{ $director->nama }}"
                                                        name="nama" required>
                                                </div>
                                            </div>
                                            <div class="widget-body mt-3">
                                                <div class="form-group">
                                                    <select class="custom-select" name="jenis_kelamin">
                                                        <option value="Laki-laki" @selected($director->jenis_kelamin === 'Laki-laki')>Laki-laki</option>
                                                        <option value="Perempuan" @selected($director->jenis_kelamin === 'Perempuan')>Perempuan</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="section-title mt-0">Gaji</div>
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" value="{{ $director->gaji }}"
                                                        name="gaji" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="section-title mt-0">Gaji Tambahan</div>
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" value="{{ $director->gaji_tambahan }}"
                                                        name="gaji_tambahan" required>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button form="edit-direksi" class="btn btn-primary mr-1" type="submit" name="submit">Submit</button>
                            <!-- <button class="btn btn-danger" type="reset">Reset</button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
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