<?php
$db = init_sqlite_db("secure/site.sqlite", "db/init.sql");

$artist_query = exec_sql_query($db, "SELECT * from artists");
$artists = $artist_query->fetchAll();

//Artists are split into two arrays for two different columns

$len_artists = count($artists);
$artists_1 = array_splice($artists, 0, ceil($len_artists/2));
$artists_2 = array_splice($artists, ceil($len_artists/2), $len_artists);

$review_query = exec_sql_query($db, "SELECT * from reviews");
$reviews = $review_query->fetchAll();
?>



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
        <div class="input-group">
          <div class="input-group-prepend">
            <!-- Country -->
            <button class="btn btn-outline-dark dropdown-toggle" type="button" aria-haspopup="true" data-toggle="dropdown">Country</button>
            <div class="dropdown-menu">
              <a class="dropdown-item">(to be implemented)</a>
            </div>

            <!-- Rating -->
            <button class="btn btn-outline-dark dropdown-toggle" aria-haspopup="true" data-toggle="dropdown">Rating</button>
            <div class="dropdown-menu">
                <a class="dropdown-item">(to be implemented)</a>
            </div>

          </div>
        </div>
      </div>

      <div class="row">
          <!-- Column 1 -->
          <div class="col-6">
            <div class="list-group">
            <?php
              foreach ($artists_1 as $artist) { ?>
                <li class="list-group-item" style="height:300px">
                  <div class="card">
                    <img class="card-img-top" src="../public/images/pfp.png" alt="<?php echo htmlspecialchars($artist['title'])?>"> </img>

                    <hr>
                    <div class="card-body">
                      <div class="card-title"> <?php echo htmlspecialchars($artist['title']) ?></div>
                      <p class="card-text">
                        <?php echo htmlspecialchars($artist['bio'])?>
                      </p>
                    </div>
                  </div>
                </li>
              <?php }?>
            </div>
          </div>

          <!-- Column 2 -->
          <div class="col-6">
            <div class="list-group">
              <?php
                foreach ($artists_2 as $artist) { ?>
                  <li class="list-group-item">
                    <div class="card">
                      <img class="card-img-thumbnail" src="../public/images/pfp.png" alt="<?php echo htmlspecialchars($artist['title'])?>"> </img>
                      <hr>
                      <div class="card-body">
                        <div class="card-title"> <?php echo htmlspecialchars($artist['title']) ?></div>
                        <p class="card-text">
                          <?php echo htmlspecialchars($artist['bio'])?>
                        </p>
                      </div>
                    </div>
                  </li>
                <?php }?>
              </div>
          </div>

      </div>
    </div>




</body>

</html>
