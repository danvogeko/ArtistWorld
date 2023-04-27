<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">ArtistWorld</a>

    <!-- Right Aligned Elements -->
    <div class="ms-auto d-flex align-items-center">

    <?php if (is_user_logged_in()) { ?>
        <a href="new_artist" class="btn btn-secondary">Add an Artist + </a>
    <?php } ?>

    <?php if (is_user_logged_in()) { ?>
        <a class="btn btn-danger ms-3" href="<?php echo logout_url() ?>">Logout</a>

    <!-- Don't Show login button on login page -->
    <?php } else if (!is_user_logged_in() && $_SERVER['PHP_SELF'] != "/login") { ?>
        <a class="btn btn-primary ms-3" href="login">Login</a>

    <?php } ?>

    </div>
  </div>
</nav>
