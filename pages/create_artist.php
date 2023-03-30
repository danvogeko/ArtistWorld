<?php
$artist_query = exec_sql_query($db, "SELECT * from artists WHERE Name = ");
?>

<!-- Detail View for Artists -->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Attaching Bootstrap 4 script, see Bootstrap 4 documentation (https://getbootstrap.com/docs/4.3/getting-started/download/) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

  <title>ArtistWorld</title>
</head>

<!-- To be implemented as a partial later -->
<nav class="navbar bg-light">
  <ul class="navbar-nav">
    <li class="nav-item">
          <a class="btn btn-dark" href="#">Create a Post+</a>
    </li>
  </ul>
</nav>

<body>
    <div class="container">
      <!-- Filtering (must be fixed) -->
      <div class="row">
        <div class="col-8">
            <div class="card">
                Artist title
            </div>

        </div>

        <div class="col-4">
            <div class="card">
                (insert embedded spotify album recommendation here)
            </div>

        </div>
      </div>
    </div>
</body>

</html>
