<?php
$filter_param = $_GET['filter'];

//Delete artists (if necessary) before querying artists
$artist_id = $_GET['artist_id'];
$file_ext = $_GET['file_ext'];

if (isset($artist_id) && isset($file_ext)) {
  //Delete File
  $file_name = $artist_id.(".").($file_ext);
  $path_to_file = "public/uploads/artists/";
  $path = $path_to_file.($file_name);
  unlink($path);

  //Delete tag relations associated with artist
  $id_param = array(":artist_id" => $artist_id);
  $delete_relation_query = exec_sql_query($db, "DELETE FROM artist_tags WHERE artist_id = :artist_id", $id_param);

  //Finally, delete artist
  $delete_artist_query = exec_sql_query($db, "DELETE FROM artists WHERE id = :artist_id", $id_param);
}

$artist_query = null;

//Change SQL Query if filtering
$param_marker = array(":filter" => $filter_param);
if (isset($filter_param)) {
    //Using GROUP_CONCAT in order to grab associated tags for each artist with just one query
    $filtered_artist_sql = "SELECT artists.*, GROUP_CONCAT(tags.title, ', ') AS tag_titles FROM artists INNER JOIN artist_tags ON artists.id = artist_tags.artist_id INNER JOIN tags ON artist_tags.tag_id = tags.id WHERE artist_tags.tag_id = :filter GROUP BY artists.id";

    $artist_query = exec_sql_query($db, $filtered_artist_sql, $param_marker);

} else {
    $artist_sql = "SELECT artists.*, GROUP_CONCAT(tags.title, ', ') AS tag_titles FROM artists LEFT JOIN artist_tags ON artists.id = artist_tags.artist_id LEFT JOIN tags ON artist_tags.tag_id = tags.id GROUP BY artists.id";
    $artist_query = exec_sql_query($db, $artist_sql);
}

$artists = $artist_query->fetchAll();

//Artists are split into two arrays for two different columns
$len_artists = count($artists);
$artists_1 = array_slice($artists, 0, ceil($len_artists/2));
$artists_2 = array_slice($artists, ceil($len_artists/2), $len_artists);

$tags_query = exec_sql_query($db, "SELECT * from tags");
$tags = $tags_query->fetchAll();

//For organizational purposes, Country and Tags define the first 8 tags, the rest are arbitrary
$country_tags = array_slice($tags, 0, 3);
$rating_tags = array_slice($tags, 3, 5);
$other_tags = array_slice($tags, 8, count($tags));

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
                  <?php foreach($country_tags as $tag) { ?>
                      <li><a class="dropdown-item" href="?<?php echo http_build_query(array("filter" => $tag['id']))?>"><?php echo htmlspecialchars($tag['title'])?></a></li>
                  <?php }?>
              </ul>
            </div>

            <!-- Rating -->
            <div class="dropdown">
              <button class="btn btn-dark dropdown-toggle rounded-pill m-1" type="button" id="rating" data-bs-toggle="dropdown" aria-expanded="false">Rating</button>
              <ul class="dropdown-menu" aria-labelledby="rating">
                  <?php foreach($rating_tags as $tag) { ?>
                      <li><a class="dropdown-item" href="?<?php echo http_build_query(array("filter" => $tag['id']))?>"><?php echo htmlspecialchars($tag['title'])?></a></li>
                  <?php }?>
              </ul>
            </div>

             <!-- Other Tags -->
             <div class="dropdown">
              <button class="btn btn-dark dropdown-toggle rounded-pill m-1" type="button" id="other" data-bs-toggle="dropdown" aria-expanded="false">Other Tags</button>
              <ul class="dropdown-menu" aria-labelledby="other">
                <?php foreach($other_tags as $tag) { ?>
                    <li><a class="dropdown-item" href="?<?php echo http_build_query(array("filter" => $tag['id']))?>"><?php echo htmlspecialchars($tag['title'])?></a></li>
                <?php }?>
              </ul>
            </div>

        </div>
      </div>

      <div class="row">
          <!-- Column 1 -->
              <div class="col-6">
                <?php
                  foreach ($artists_1 as $artist) {?>
                        <div class="card shadow mb-4 bg-white rounded p-3 bg-white rounded anim">
                            <a class="stretched-link card-link" href="/detail?<?php echo http_build_query(array("artist_id" => $artist['id'])); ?>">
                                <img class="card-img-top" src="../public/uploads/artists/<?php echo htmlspecialchars($artist['id'])?>.<?php echo $artist['file_ext']?>" alt="<?php echo htmlspecialchars($artist['name'])?>">
                                <hr>
                                <div class="card-body">
                                  <h5 class="card-title"> <?php echo htmlspecialchars($artist['name']) ?></h5>

                                  <p class="card-text">
                                    <?php echo htmlspecialchars($artist['tag_titles']) ?>
                                  </p>
                                  <span class="form-text"> <?php echo htmlspecialchars($artist['citation'])?> </span>
                                </div>
                            </a>
                        </div>

                  <?php }?>
              </div>


          <!-- Column 2 -->
          <div class="col-6">
                <?php
                  foreach ($artists_2 as $artist) {?>
                        <div class="card shadow mb-4 bg-white rounded p-3 bg-white rounded anim">
                            <a class="stretched-link card-link" href="/detail?<?php echo http_build_query(array("artist_id" => $artist['id'])); ?>">
                                <img class="card-img-top" src="../public/uploads/artists/<?php echo htmlspecialchars($artist['id'])?>.<?php echo $artist['file_ext']?>" alt="<?php echo htmlspecialchars($artist['name'])?>">
                                <hr>
                                <div class="card-body">
                                  <h5 class="card-title"> <?php echo htmlspecialchars($artist['name']) ?></h5>

                                  <p class="card-text">
                                    <?php echo htmlspecialchars($artist['tag_titles']) ?>
                                  </p>
                                  <span class="form-text"> <?php echo htmlspecialchars($artist['citation'])?> </span>
                                </div>
                            </a>
                        </div>
                  <?php }?>
              </div>


      </div>
    </div>




</body>

</html>
