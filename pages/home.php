<?php


$filter = $_GET['filter'];
$artist_sql = "SELECT * from artists";

if (!$filter == "") {
    $artist_sql = "SELECT * from artists INNER JOIN artist_tags ON artists.id = artist_tags.artist_id WHERE artist_tags.tag_id = ".($filter);
}

$artist_query = exec_sql_query($db, $artist_sql);
$artists = $artist_query->fetchAll();



//Artists are split into two arrays for two different columns

$len_artists = count($artists);
$artists_1 = array_slice($artists, 0, ceil($len_artists/2));
$artists_2 = array_slice($artists, ceil($len_artists/2), $len_artists);

$tags_query = exec_sql_query($db, "SELECT * from tags");
$tags = $tags_query->fetchAll();



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Attaching Bootstrap 4 script, see Bootstrap 5 documentation (https://getbootstrap.com/docs/4.3/getting-started/download/) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <link rel="icon" type="image/x-icon" href="../public/images/favicon.png">
  <link rel="stylesheet" type="text/css" href="../public/styles/styles.css">


  <title>ArtistWorld</title>
</head>


<body>
<?php
  include 'includes/navbar.php';
?>

    <div class="container">
      <div class="row">
        <div class="btn-group">
            <!-- Country -->
            <div class="dropdown">
              <button class="btn btn-dark dropdown-toggle rounded-pill m-1" type="button" id="country" data-bs-toggle="dropdown" aria-expanded="false">Country</button>
              <ul class="dropdown-menu" aria-labelledby="country">
                <li><a class="dropdown-item" href="?<?php echo http_build_query(array("filter" => "0"))?>">United States</a></li>
                <li><a class="dropdown-item" href="?<?php echo http_build_query(array("filter" => "1"))?>">Canada</a></li>
                <li><a class="dropdown-item" href="?<?php echo http_build_query(array("filter" => "7"))?>">United Kingdom</a></li>
              </ul>
            </div>

            <!-- Release -->
            <div class="dropdown">
              <button class="btn btn-dark dropdown-toggle rounded-pill m-1" type="button" id="rating" data-bs-toggle="dropdown" aria-expanded="false">Rating</button>
              <ul class="dropdown-menu" aria-labelledby="country">
                <li><a class="dropdown-item" href="?<?php echo http_build_query(array("filter" => "2"))?>">★ (1)</a></li>
                <li><a class="dropdown-item" href="?<?php echo http_build_query(array("filter" => "3"))?>">★★ (2)</a></li>
                <li><a class="dropdown-item" href="?<?php echo http_build_query(array("filter" => "4"))?>">★★★ (3)</a></li>
                <li><a class="dropdown-item" href="?<?php echo http_build_query(array("filter" => "5"))?>">★★★★ (4)</a></li>
                <li><a class="dropdown-item" href="?<?php echo http_build_query(array("filter" => "6"))?>">★★★★★ (5)</a></li>
              </ul>
            </div>

        </div>
      </div>

      <div class="row">
          <!-- Column 1 -->
              <div class="col-6">
                <?php
                  foreach ($artists_1 as $artist) { ?>
                        <div class="card shadow mb-4 bg-white rounded p-3 bg-white rounded anim">
                            <a class="stretched-link card-link" href="/detail?<?php echo http_build_query(array("artist_id" => $artist['id'])); ?>">
                                <img class="card-img-top" src="../public/uploads/artists/<?php echo $artist['id']?>.<?php echo $artist['file_ext']?>" alt="<?php echo htmlspecialchars($artist['name'])?>">
                                <hr>
                                <div class="card-body">
                                  <h5 class="card-title"> <?php echo htmlspecialchars($artist['name']) ?></h5>
                                  <p class="card-text">
                                    <?php echo htmlspecialchars($artist['country'])?>
                                  </p>
                                </div>
                            </a>
                        </div>

                  <?php }?>
              </div>


          <!-- Column 2 -->
          <div class="col-6">
                <?php
                  foreach ($artists_2 as $artist) { ?>
                        <div class="card shadow mb-4 bg-white rounded p-3 bg-white rounded anim">
                            <a class="stretched-link card-link" href="/detail?<?php echo http_build_query(array("artist_id" => $artist['id'])); ?>">
                                <img class="card-img-top" src="../public/uploads/artists/<?php echo $artist['id']?>.<?php echo $artist['file_ext']?>" alt="<?php echo htmlspecialchars($artist['name'])?>">
                                <hr>
                                <div class="card-body">
                                  <h5 class="card-title"> <?php echo htmlspecialchars($artist['name']) ?></h5>
                                  <p class="card-text">
                                    <?php echo htmlspecialchars($artist['country'])?>
                                  </p>
                                </div>
                            </a>
                        </div>
                  <?php }?>
              </div>



      </div>
    </div>




</body>

</html>
