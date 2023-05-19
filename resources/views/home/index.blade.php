<!doctype html>
<html lang="en">

<head>
    <title>Masuk</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<style>
    body {
        letter-spacing: 0.7px;
        background-color: #eee;
    }

    .container {
        margin-top: 100px;
        margin-bottom: 100px;
    }

    p {
        font-size: 14px;
    }

    .btn-primary {
        background-color: #42A5F5 !important;
        border-color: #42A5F5 !important;
    }

    .cursor-pointer {
        cursor: pointer;
        color: #42A5F5;
    }

    .pic {
        margin-top: 30px;
        margin-bottom: 20px;
    }

    .card-block {
        width: 200px;
        border: 1px solid lightgrey;
        border-radius: 5px !important;
        background-color: #FAFAFA;
        margin-bottom: 30px;
    }

    .card-body.show {
        display: block;
    }

    .card {
        padding-bottom: 20px;
        box-shadow: 2px 2px 6px 0px rgb(200, 167, 216);
    }

    .radio {
        display: inline-block;
        border-radius: 0;
        box-sizing: border-box;
        cursor: pointer;
        color: #000;
        font-weight: 500;
        -webkit-filter: grayscale(100%);
        -moz-filter: grayscale(100%);
        -o-filter: grayscale(100%);
        -ms-filter: grayscale(100%);
        filter: grayscale(100%);
    }

    .radio:hover {
        box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.1);
    }

    .radio.selected {
        box-shadow: 0px 8px 16px 0px #EEEEEE;
        -webkit-filter: grayscale(0%);
        -moz-filter: grayscale(0%);
        -o-filter: grayscale(0%);
        -ms-filter: grayscale(0%);
        filter: grayscale(0%);
    }

    .selected {
        background-color: #E0F2F1;
    }

    .a {
        justify-content: center !important;
    }

    .btn {
        border-radius: 0px;
    }

    .btn,
    .btn:focus,
    .btn:active {
        outline: none !important;
        box-shadow: none !important;
    }
</style>

<body style="background-image: url({{ asset('assets/img/bg-01.png') }});   background-repeat: no-repeat;
    background-size: cover;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card text-center justify-content-center shaodw-lg  card-1 border-0 bg-white px-sm-2">
                    <div class="card-body show  ">
                        <div class="row">
                            <div class="col">
                                <h5><b>Pilih Salah Satu</b></h5>
                                <p> Gaji Karyawan Atau Gaji Penjahit </p>
                            </div>
                        </div>
                        <div class="radio-group row justify-content-between px-3 text-center a">
                            <a href="{{url()->to('/gaji-pegawai/dashboard')}}" id="a">
                                <script>
                                    setTimeout(function() {
                                        document.getElementById('a');
                                    }, 10000);
                                </script>
                                <div class="col-auto mr-sm-2 mx-1 card-block py-0 text-center radio selected"
                                    id="pilih" value="karyawan">
                                    <div class="flex-row">
                                        <div class="col">
                                            <div class="pic"> <img class="irc_mut img-fluid"
                                                    src="{{asset('assets/img/karyawan.png')}}" width="150" height="150">
                                            </div>
                                            <p>Gaji Karyawan</p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <a href="#penjahit" id="a">
                                <div class="col-auto ml-sm-2 mx-1 card-block py-0 text-center radio selected"
                                    id="pilih" value="gajipenjahit">
                                    <div class="flex-row">
                                        <div class="col">
                                            <div class="pic"> <img class="irc_mut img-fluid"
                                                    src="{{ asset('assets/img/penjahit.png') }}" width="90" height="90">
                                            </div>
                                            <p>Gaji Penjahit</p>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        </a>
                        <div class="row justify-content-center">
                            <div class="col">
                                <p class="text-muted">Pilih Salah Satu Diatas Maka Akan Otomatis Ke <br> Halaman Sesuai
                                    Dengan Pilihan</p>

                                <p> by <a href="https://www.instagram.com/aris.wahyudi86">Author</a> Since &copy; <a
                                        href="#">{{ Carbon\Carbon::now()->format('Y') }}</a> </p>
                            </div>
                        </div>
                        <div class="row justify-content-between">
                            <div class="col-auto">
                                <a href="#logout" type="button" class="btn btn-outline-secondary"> <span
                                        class="mr-2"><i class="fa fa-angle-left" aria-hidden="true"></i></span>
                                    Keluar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
