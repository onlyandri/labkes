<?php
require_once 'koneksi.php';
require_once 'config.php';
require_once 'lib/function.php';
session_start();

$msg = '';
/* ======================================================================
[Cek login] */
if (isset($_SESSION['id_user'])) {
  header('Location: user');
}

$display = 'dis-none';
$error = "";
$error2 = "";
$halaman = "./";

/* ======================================================================
[Proses login] */

if (isset($_POST['submit']) && $_POST['submit'] == 'login') {

  $username = htmlspecialchars($_POST['username']);
  $password = htmlspecialchars($_POST['password']);

  $sql = $con->query("SELECT * FROM user WHERE id_user = '$username' AND password = md5('$password') OR username = '$username' AND password = md5('$password') ");
  $row = $sql->fetch(PDO::FETCH_LAZY);
  $trow = $sql->rowCount();

  // Jika user ada
  if (!empty($trow)) {

    if ($row->status == 'Y') {
      $_SESSION['id_user']    = $row->id_user;
      $_SESSION['user_level'] = $row->user_level;
      if ($_SESSION['user_level'] == 'Admin') {
        header('Location: user');
      } else {
        header('Location: pj');
      }
    } else {
      $display = 'dis-block';
      $msg = 'Saat ini akun Anda dalam keadaan nonaktif';
    }

    // User tidak ada
  } else {
    $display = 'dis-block';
    $msg = 'Username atau password yang Anda masukkan salah';
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title></title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="assets/css/util.css">
  <link rel="stylesheet" type="text/css" href="assets/css/login.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="assets/bower_components/validetta/validetta.min.css">
  <!--===============================================================================================-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body>

  <div class="container-login">

    <div class="panel panel-default p-b-164 p-l-30 p-r-30">
      <div class="panel-body">
        <div class="row">

          <div class="col-xs-6">
            <h3 class="text-center">
              Laboratorium Kesehatan Daerah
            </h3>
            <p class="text-center fs-14">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae suscipit eaque, deleniti expedita soluta nam aliquid porro consectetur, sit quia incidunt.
            </p>

          </div>
          <div class="col-xs-6 p-l-40">
            <h2 class="text-center m-t-70 m-b-60 center-block">Login Pengguna</h2>

            <!-- Form login -->
            <form id="form-login" method="POST">

              <div class="alert alert-danger text-center p-t-5 p-b-5 fs-13 <?php echo $display; ?>">
                <?php echo $msg; ?>
              </div>

              <div class="wrap-sliding-input m-b-26" data-validate="Username harus diisi">
                <i class="fa fa-user fa-2x"></i>
                <input class="sliding-input" type="text" name="username" placeholder="Masukkan Username" autocomplete="off" data-validetta="required">
                <span class="focus-sliding-input"></span>
              </div>

              <div class="wrap-sliding-input m-b-26" data-validate="Password harus diisi">
                <i class="fa fa-lock fa-2x"></i>
                <input class="sliding-input" type="password" name="password" placeholder="Masukkan Password" data-validetta="required">
                <span class="focus-sliding-input"></span>
              </div>

              <div class="container-login100-form-btn">
                <button class="login100-form-btn" type="submit" name="submit" value="login">
                  Login
                </button>
              </div>

            </form>
          </div>

        </div>
      </div>
    </div> <!--  /Panel -->

    <p class="text-footer text-center">Copyright © <?php echo date("Y"); ?> Laboratorium Kesehatan Daerah | STMIK WIDYA PRATAMA PEKALONGAN. </p>

  </div>

  <!--===============================================================================================-->
  <script src="assets/bower_components/jquery/dist/jquery.min.js"></script>
  <!--===============================================================================================-->
  <script src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!--===============================================================================================-->
  <script src="assets/bower_components/validetta/validetta.min.js"></script>
  <script>
    $(document).ready(function() {
      $("#form-login").validetta({
        errorTemplateClass: 'validetta-bubble',
        bubblePosition: 'bottom', // Bubble position: right / bottom
        // errorTemplateClass : 'validetta-inline',
        // bubblePosition: 'inline',
        realTime: true
      });
    });
  </script>
  <!--===============================================================================================-->

</body>

</html>