<?php
    //Logged_in users don't need acess to login page
    if (is_user_logged_in()) {
        header("Location: /");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <link rel="icon" type="image/x-icon" href="../public/images/favicon.png">

  <title> Login | ArtistWorld </title>
</head>

<body>
<?php
  include 'includes/navbar.php';
?>
    <div class="container">
        <div class="row">

        <!-- Login Form Column -->
        <div class="col-md-6 py-5">
            <h1>Admin Login</h1>
            <?php echo login_form("/login", $session_messages) ?>
        </div>

        <!-- Vertical Divider -->
        <div class="col-md-6 border-start py-5">
            <div class="d-flex flex-column justify-content-between h-100">
                <div>
                    <h1>Guest Users</h1>
                    <p> You may also access ArtistWorld without logging in. Press the button below to continue. </p>
                    <a href="/" class="btn btn-primary">Continue as Guest</a>
                </div>
            </div>
        </div>

        </div>
    </div>
</body>

</html>
