<?php
session_start();
if(isset($_SESSION['username'])){
    header("location: beranda.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Rukun Warga 09</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md" style="background: #fcf2dd;">
        <div class="container-fluid"><a class="navbar-brand" href="#"><img class="img-fluid" src="assets/img/_a38dcd53-a043-4c4f-9374-60b093f1fa30.jpg" width="55px"></a></div>
    </nav>
    <section class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 offset-lg-4">
                    <div class="card" style="background: rgb(252,242,221);">
                        <div class="card-body">
                            <h2 class="text-center pb-3 pt-3">Login</h2>
                            <p style="text-align: center;"><img class="img-fluid" src="assets/img/_a38dcd53-a043-4c4f-9374-60b093f1fa30.jpg" width="40%"></p>
                                    <?php
                                    if(isset($_SESSION['login_error'])) {
                                        echo $_SESSION['login_error'];
                                        unset($_SESSION['login_error']);
                                    }
                                    ?>
                            <form action="action.php" method="post" class="p-3">
                                <label class="form-label">Username :</label>
                                <input class="form-control" type="text" name="username" placeholder="Username" required="">
                                <label class="form-label mt-2">Password :</label>
                                <input class="form-control" type="password" name="password" placeholder="Password" required="">
                                <p class="text-center mt-3">
                                    <button class="btn btn-success link-light" name="masuk" type="submit">Simpan</button>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col">
                    <h6 class="text-center">Hak Cipta&nbsp;<i class="far fa-copyright"></i>&nbsp;Rukun Warga 09</h6>
                </div>
            </div>
        </div>
    </section>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>