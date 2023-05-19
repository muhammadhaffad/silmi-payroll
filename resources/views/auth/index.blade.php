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

<body
    style="background-image: url({{ asset('assets/img/bg-01.png') }});   background-repeat: no-repeat;
    background-size: cover;">
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-5">
                    <div class="wrap">
                        <div class="img" style="background-image: url({{ asset('assets/img/bg-1.png') }});"></div>
                        <div class="login-wrap p-4 p-md-5">
                            <div class="mt-3">
                                <div class="alert alert-danger alert-dismissable" role="alert">
                                    <center>
                                        <strong>Login Gagal</strong> <br>
                                        Username Dan Password salah, Silahkan Masukan Lagi
                                    </center>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="w-100">
                                    <h4 class="mb-4 text-center">Aplikasi Payroll</h4>
                                </div>
                            </div>
                            <form method="POST" action="#" class="needs-validation signin-form" novalidate="">
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control" required>
                                    <label class="form-control-placeholder" name for="username">Username</label>
                                </div>
                                <div class="form-group mt-6">
                                    <input id="password-field" name="password" type="password" class="form-control"
                                        required>
                                    <label class="form-control-placeholder" for="password">Password</label>
                                    <span toggle="#password-field"
                                        class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="login"
                                        class="form-control btn btn-primary rounded px-3">Masuk</button>
                                </div>
                                <div class="form-group d-md-flex">
                                    <div class="w-50 text-left">
                                        <label class="checkbox-wrap checkbox-primary mb-0">Ingatkan Saya
                                            <input type="checkbox" name="remember" value="1" id="rmb">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <?php
                                    $date = Carbon\Carbon::now()->format('Y') /* date('Y') */
                                    ?>
                                    <div class="w-50 text-md-right">
                                        Copyright &copy; <a href="#"><?= $date ?></a>
                                    </div>
                                </div>
                                <div class="w-100 text-md-center">
                                    Initial By @<a href="https://www.instagram.com/aris.wahyudi86">Aris</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Karyawan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
