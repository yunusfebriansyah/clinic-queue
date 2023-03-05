<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Halaman Pendaftaran</title>

    <!-- Custom fonts for this template-->
    <link href="<?= url('') ?>/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= url('') ?>/admin/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-success">

    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center mt-5">

            <div class="col-12 col-md-10 col-lg-7">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Registrasi Akun!</h1>
                            </div>
                                <form class="user mb-3" action="/register" method="post">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" placeholder="Isi nama anda" name="name" id="name" value="{{ old('name') }}" required>
                                    @error('name')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user @error('username') is-invalid @enderror" placeholder="Isi username anda" name="username" id="username" value="{{ old('username') }}" required>
                                    @error('username')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input rows="text" class="form-control form-control-user @error('address') is-invalid @enderror" placeholder="Isi alamat anda" name="address" id="address" value="{{ old('address') }}" required>
                                    @error('address')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" placeholder="Isi password anda" name="password" id="password" required>
                                    @error('password')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user @error('confirm_password') is-invalid @enderror" placeholder="Konfirmasi password anda" name="confirm_password" id="confirm_password" required>
                                    @error('confirm_password')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-success btn-user btn-block">
                                    Daftar
                                </button>
                            </form>
                        <a href="/login" class="text-success d-block text-center text-decoration-none">sudah punya akun pasien?</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= url('') ?>/admin/vendor/jquery/jquery.min.js"></script>
    <script src="<?= url('') ?>/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= url('') ?>/admin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= url('') ?>/admin/js/sb-admin-2.min.js"></script>

</body>

</html>