<?php
if (!isset($_SESSION[""])) {
  session_start();
}
if (isset($_SESSION['data-user'])) {
  header("Location: ../superadmin/");
  exit();
}
error_reporting(~E_NOTICE & ~E_DEPRECATED);
include '../superadmin/konektor.php';
if (isset($_SESSION["time-message"])) {
  if ((time() - $_SESSION["time-message"]) > 2) {
    if (isset($_SESSION["message-success"])) {
      unset($_SESSION["message-success"]);
    }
    if (isset($_SESSION["message-info"])) {
      unset($_SESSION["message-info"]);
    }
    if (isset($_SESSION["message-warning"])) {
      unset($_SESSION["message-warning"]);
    }
    if (isset($_SESSION["message-danger"])) {
      unset($_SESSION["message-danger"]);
    }
    if (isset($_SESSION["message-dark"])) {
      unset($_SESSION["message-dark"]);
    }
    unset($_SESSION["time-alert"]);
  }
}

if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $checkAccount = "SELECT * FROM admin WHERE email='$email'";
  $account = mysqli_query($konektor, $checkAccount);
  if (mysqli_num_rows($account) > 0) {
    $row = mysqli_fetch_assoc($account);
    if (password_verify($password, $row['password'])) {
      $_SESSION['data-user'] = [
        'id' => $row['id_admin'],
        'username' => $row['username'],
        'email' => $row['email'],
      ];
      header("Location: ../superadmin/");
      exit();
    } else {
      $_SESSION["message-danger"] = "Maaf, kata sandi yang anda masukan salah.";
      $_SESSION["time-message"] = time();
      header("Location: ./");
      return false;
    }
  } else {
    $_SESSION["message-danger"] = "Maaf, akun yang anda masukan tidak terdaftar.";
    $_SESSION["time-message"] = time();
    header("Location: ./");
    return false;
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Tambal Ban Online</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="shortcut icon" href="../image/logo.png">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
  <script type="text/javascript" src="chartjs294/Chart.js"></script>
  <script src="../assets/sweetalert/dist/sweetalert2.all.min.js"></script>

<body style="background-image: url(../image/1.png);">
  <?php if (isset($_SESSION["message-success"])) { ?>
    <div class="message-success" data-message-success="<?= $_SESSION["message-success"] ?>"></div>
  <?php }
  if (isset($_SESSION["message-info"])) { ?>
    <div class="message-info" data-message-info="<?= $_SESSION["message-info"] ?>"></div>
  <?php }
  if (isset($_SESSION["message-warning"])) { ?>
    <div class="message-warning" data-message-warning="<?= $_SESSION["message-warning"] ?>"></div>
  <?php }
  if (isset($_SESSION["message-danger"])) { ?>
    <div class="message-danger" data-message-danger="<?= $_SESSION["message-danger"] ?>"></div>
  <?php } ?>
  <nav class="navbar navbar-expand-md bg-info navbar-info">
    <img src="../image/logo.png" width="20px" height="20px">
    <a class="navbar-brand text-light font-weight-bolder " href="./">Tambal Ban Online</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
  </nav>
  <div class="container">
    <div class="row">
      <div class="col-lg-4 mt-5 p-4 mx-auto shadow">

        <h1 class="mb-3">Masuk</h1>
        <!-- Form login -->
        <form method="post" action="">
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
          </div>
          <div class="mb-3">
            <button type="submit" name="login" class="btn btn-primary ">Login</button>
          </div>
        </form>
        <!-- End Form login -->

        <hr>
        <p><a href="../">Kembali ke Beranda</a></p>
      </div>
    </div>
  </div>
  <script>
    const messageSuccess = $('.message-success').data('message-success');
    const messageInfo = $('.message-info').data('message-info');
    const messageWarning = $('.message-warning').data('message-warning');
    const messageDanger = $('.message-danger').data('message-danger');

    if (messageSuccess) {
      Swal.fire({
        icon: 'success',
        title: 'Berhasil Terkirim',
        text: messageSuccess,
      })
    }

    if (messageInfo) {
      Swal.fire({
        icon: 'info',
        title: 'For your information',
        text: messageInfo,
      })
    }
    if (messageWarning) {
      Swal.fire({
        icon: 'warning',
        title: 'Peringatan!!',
        text: messageWarning,
      })
    }
    if (messageDanger) {
      Swal.fire({
        icon: 'error',
        title: 'Kesalahan',
        text: messageDanger,
      })
    }
  </script>
</body>

</html>