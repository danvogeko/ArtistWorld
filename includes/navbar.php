<nav class="navbar navbar-expand navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">ArtistWorld</a>

    <!-- Right Aligned Elements -->
    <div class="ms-auto d-flex align-items-center">

    <?php if (is_user_logged_in()) { ?>
        <span class="h5 text-light me-3">Welcome, <b><?php echo htmlspecialchars($current_user[1])?></b></span>
        <a href="new_artist" class="btn btn-secondary">Add an Artist + </a>

        <!-- Don't show log out button on restricted page to avoid exposure -->
        <?php if ($_SERVER['PHP_SELF'] != "/new_artist") { ?>
          <a class="btn btn-danger ms-3" href="<?php echo logout_url() ?>">Logout</a>
        <?php }?>

    <!-- Don't Show login button on login page -->
    <?php } else if (!is_user_logged_in() && $_SERVER['PHP_SELF'] != "/login") { ?>
        <a class="btn btn-primary ms-3" href="login">Login</a>
    <?php } ?>

    </div>
  </div>
</nav>
