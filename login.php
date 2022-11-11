<?php require_once "core/base.php"; ?>
<?php require_once "core/functions.php"; ?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="<?php echo $url; ?>/assets/vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo $url; ?>/assets/vendor/feather-icons-web/feather.css">
    <link rel="stylesheet" href="<?php echo $url; ?>/assets/css/style.css">
</head>
<body style="background-color: skyblue">

<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-4">
            <div class="card border-1 border-primary">
                <div class="card-body">
                    <h4 class="text-center">
                        <i class="feather-users"></i>
                        Users Login
                    </h4>
                    <hr>

                    <?php
                    if(isset($_POST['login'])){
                        echo login();
                    }

                    ?>

                    <form action="" method="post">
                        <div class="form-group">
                            <label for="">
                                <i class="feather-mail"></i>
                                Email
                            </label>
                            <input type="email" name="email" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">
                                <i class="feather-lock"></i>
                                Password
                            </label>
                            <input type="password" name="password" class="form-control" min="8">
                        </div>

                        <div class="form-group mb-0">
                            <button name="login" class="btn btn-outline-primary px-3">Sign In</button>
                            <a href="register.php" class="btn btn-primary ">Register</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




</div>
</div>
</section>
<script src="<?php echo $url; ?>/assets/vendor/jquery.min.js"></script>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="<?php echo $url; ?>/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo $url; ?>/assets/js/app.js"></script>
<script>

</script>

</body>
</html>