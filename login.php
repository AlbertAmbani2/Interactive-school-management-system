<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Management System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="source/js/loginValidate.js"></script>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">

                <?php
                $login_code = isset($_REQUEST['login']) ? $_REQUEST['login'] : '1';
                $login_message = '';
                $color = '';

                if ($login_code == "false") {
                    $login_message = "Wrong Credentials!";
                    $color = "text-danger";
                } else {
                    $login_message = "Please Login To Continue";
                    $color = "text-success";
                }
                ?>

                <div class="text-center mb-4">
                    <img src="source/goodtimes.jpg" alt="Logo" class="img-fluid" style="max-width: 50 0px;">
                </div> 

                <form action="service/check.access.php" onsubmit="return loginValidate();" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" id="myid" name="myid" placeholder="Login ID" autofocus />
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control" id="mypassword" name="mypassword" placeholder="Password" />
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-success btn-block" value="Login" />
                    </div>
                </form>
                <?php echo "<p class='$color'>$login_message</p>";?>
            </div>
        </div>
    </div>
</body>
</html>
