<?php
$RATING = array(
  1 => '★',
  2 => "★★",
  3 => "★★★",
  4 => "★★★★",
  5 => "★★★★★",
);
$db = init_sqlite_db("db/site.sqlite", "db/init.sql");


//Retrieve record from database based on query parameter
$id_param = $_GET['artist_id'] ?? NULL;

//Use SQL Query to retrieve record
$artist_query = exec_sql_query($db, "SELECT * FROM artists WHERE artists.id = ".($id_param));
$artist = $artist_query->fetchAll();

//Retrieve tags from specific artist
$artist_tag_query = exec_sql_query($db, "SELECT * FROM artist_tags INNER JOIN tags ON artist_tags.tag_id = tags.id WHERE artist_tags.artist_id = ".($id_param));
$artist_tags = $artist_tag_query->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <link rel="icon" type="image/x-icon" href="../public/images/favicon.png">

  <title><?php echo htmlspecialchars($artist[0]['name']);?> | ArtistWorld </title>
</head>

<nav class="navbar navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="/">ArtistWorld</a>
      <button class='btn btn-secondary'>Create a Post +</button>
    </div>
</nav>

<body>
  <div class="container">
    <!-- Image/Name -->
    <div class="border">
        <div class="row">
            <!-- image -->
            <div class="col-4">
                <div class="card">
                  <img src="../public/uploads/artists/<?php echo $artist[0]['id']?>.<?php echo $artist[0]['file_ext']?>" class="img-fluid rounded-start" alt="<?php echo $artist[0]['name']?>">
                </div>
            </div>

            <div class="col-8">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title text-center"> <?php echo htmlspecialchars($artist[0]['name']); ?></h4>
                  <!-- Taken directly from the corresponding artists wikipedia page (https://www.wikipedia.org/)-->
                  <p class="card-text"> <?php echo htmlspecialchars($artist[0]['bio']); ?>  </p>
                </div>
              </div>
            </div>

        </div>
    </div>

    <br>

    <!-- Tags -->
    <div class="border">
        <span class='text-bold'> Tags: </span>
          <?php foreach ($artist_tags as $tag) { ?>
            <button type="button" class="btn btn-dark rounded-pill m-1">
                <?php echo htmlspecialchars($tag['title']);?>
            </button>
          <?php } ?>
    </div>

    <!-- Analysis row -->
    <div class="row">
        <div class="col-8">

            <div class="card text-center">
                <div class="card-header">
                  <h3 class="card-title h3">Analysis: <?php echo $artist[0]['name']; ?></h3>
                </div>

                <div class="card-body">
                  <h5 class="card-title h5">Rating: <?php echo $RATING[$artist[0]['rating']];  ?></h5>
                  <p class="card-text"><?php echo $artist['review_content'];  ?></p>
                </div>

                <div class="card-footer text-muted">
                  Note: This analysis a mere opinion.
                </div>
            </div>

        </div>

        <!-- Album Recommendations -->
        <div class="col-4">
            <!-- HTML provided by Spotify API -->
            <iframe style="border-radius:12px" src="<?php echo htmlspecialchars($artist[0]['embedded_album_url']); ?>" width="100%" height="352" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy">
            </iframe>
        </div>


    </div>
  </div>

</body>

</html>
