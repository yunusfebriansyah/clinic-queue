<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Halaman Login</title>

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
                              <h1 class="h4 text-gray-900 mb-4">Login Akun</h1>
                          </div>
                          {{-- alert --}}
                          @if( session('success') )
                            {!! session('success') !!}
                          @endif
                          @if (session('message'))
                          <div class="alert alert-danger" role="alert">
                            <strong>Login gagal!</strong> Silahkan periksa data anda!
                          </div>
                          @endif
                          @if ($errors->any())
                          <div class="alert alert-danger" role="alert">
                            <strong>Login gagal!</strong> Silahkan periksa data anda!
                          </div>
                          @endif
                          {{-- end alert --}}
                          <form class="user mb-3" action="/login" method="post">
                            @csrf
                              <div class="form-group">
                                  <input type="text" class="form-control form-control-user" placeholder="Isi username anda" name="username" required>
                              </div>
                              <div class="form-group">
                                  <input type="password" class="form-control form-control-user" placeholder="Password" placeholder="Isi password anda" name="password" required>
                              </div>
                              <div class="form-group">
                                  <select name="role" id="role" class="form-control form-select-user rounded-pill">
                                    <option value="patient">Pasien</option>
                                    <option value="doctor">Dokter</option>
                                    <option value="administrator">Administrator</option>
                                  </select>
                              </div>
                              <button type="submit" class="btn btn-success btn-user btn-block">
                                  Login
                              </button>
                          </form>
                          <a href="/register" class="text-success d-block text-center text-decoration-none">belum punya akun?</a>
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
