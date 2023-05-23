@extends('gaji-pegawai.layout.app', ['title' =>  'Tunjangan Tetap'])
@push('style')
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
@endpush
@section('content')
    <div class="card">
        <!-- <img src="images/img-1.jpg" class="img-fluid"> -->
        <div class="card-body">
            <div class="row ">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>Update Data {{ $title }}</h4>
                            <div class="card-header-action text-right">
                                <a href="" class="btn btn-primary btn-action btn-xs mr-1"
                                    title="kembali">
                                    <span>Kembali</span>
                                </a>
                            </div>
                        </div>
                        <div class="container">
                            <form action="{{ url()->to("/gaji-pegawai/tunjangan/tetap/$nip/$tunjangan/$id/update") }}" enctype="multipart/form-data" method="post">
                                @method('PUT')
                                @csrf
                                <div class="row align-items-center">
                                    <div class="col">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <div class="section-title mt-0">Nama</div>
                                                <div class="input-group mb-2">
                                                    <input @disabled($title !== 'Tunjangan Keahlian') type="text" class="form-control" value="{{ $data->nama }}" name="nama"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="section-title mt-0">Jumlah</div>
                                                <div class="input-group mb-2">
                                                    <input type="number" class="form-control" value="{{ $data->jumlah }}"
                                                        name="jumlah" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer text-right">
                                    <button class="btn btn-primary mr-1" type="submit" name="submit">Submit</button>
                                    <!-- <button class="btn btn-danger" type="reset">Reset</button> -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (false)
        <script type='text/javascript'>
            setTimeout(function() {
                swal({
                    title: 'success',
                    text: 'Berhasil Di Update',
                    type: 'success',
                    icon: 'success',
                    timer: 3000,
                    buttons: false
                });
            }, 10);
            window.setTimeout(function() {
                window.location.replace('detail.php');
            }, 3000);
        </script>
    @endif
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