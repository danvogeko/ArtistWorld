<?php
$RATING = array(
  1 => '★',
  2 => "★★",
  3 => "★★★",
  4 => "★★★★",
  5 => "★★★★★",
);
?>

<?php
define("MAX_FILE_SIZE", 1000000);

$tags_query = exec_sql_query($db, "SELECT * from tags");
$tags = $tags_query->fetchAll();

$form_values = array(
    "bio" => "",
    "name" => "",
    "file_ext" => "",
    "embedded_album_url" => "",
    "review_content" => "",
    "tags" => ""
);

// Users must be logged in to upload files!
if (is_user_logged_in() && isset($_POST["artist"])) {
  // get the info about the uploaded files.
  $upload = $_FILES['file'];

  // Assume the form is valid...
  $form_valid = True;

  // file is required
  if ($upload['error'] == UPLOAD_ERR_OK) {
    // The upload was successful!

    // Get the name of the uploaded file without any path
    $upload_file_name = basename($upload['name']);

    // Get the file extension of the uploaded file and convert to lowercase for consistency in DB
    $upload_file_ext = strtolower(pathinfo($upload_file_name, PATHINFO_EXTENSION));

  } else if (($upload['error'] == UPLOAD_ERR_INI_SIZE) || ($upload['error'] == UPLOAD_ERR_FORM_SIZE)) {
    // file was too big, let's try again
    $form_valid = False;
    $upload_feedback['too_large'] = True;
  } else {
    // upload was not successful
    $form_valid = False;
    $upload_feedback['general_error'] = True;
  }

  if ($form_valid) {
    // insert upload into DB
    $form_values['bio'] = trim($_POST['bio']);
    $form_values['name'] = trim($_POST['artist']);
    $form_values['file_ext'] = $upload_file_ext;
    $form_values['embedded_album_url'] = trim($_POST['album']);
    $form_values['review_content'] = trim($_POST['review_content']);

    $form_values['tags'] = $_POST['tags']; //This is an array, doesn't require trimming

    $artist_sql = 'INSERT INTO artists (bio, name, file_ext, embedded_album_url, review_content) VALUES (:bio, :name,  :file_ext, :embedded_album_url, :review_content)';

    $artist_result = exec_sql_query($db, $artist_sql,
    array(
        ":bio" => $form_values['bio'],
        ":name" => $form_values['name'],
        ":file_ext" => $form_values['file_ext'],
        ":embedded_album_url" => $form_values['embedded_album_url'],
        ":review_content" => $form_values['review_content'],
      )
    );

    if ($artist_result) {
      // get the newly inserted record's id
      $artist_id = $db->lastInsertId('id');

      //Relate all tags to artist upon creation
      $tags = $form_values['tags'];
      $relation_sql = "INSERT INTO artist_tags (artist_id, tag_id) VALUES (:artist_id, :tag_id)";
      foreach ($tags as $tag_id) {
        $params = array(
          ":artist_id" => $artist_id,
          ":tag_id" => $tag_id,
        );
        $relation_result = exec_sql_query($db, $relation_sql, $params);
      }

      // uploaded file should be in folder with same name as table with the primary key as the filename.
      // Note: THIS IS NOT A URL; this is a FILE PATH on the server!
      //       Do NOT include / at the beginning of the path; path should be a relative path.
      //          NO: /public/...
      //         YES: public/...
      $upload_storage_path = 'public/uploads/artists/' . $artist_id . '.' . $upload_file_ext;

      // Move the file to the public/uploads/clipart folder
      // Note: THIS FUNCTION REQUIRES A PATH. NOT A URL!
      if (move_uploaded_file($upload["tmp_name"], $upload_storage_path) == False) {
          error_log("Failed to permanently store the uploaded file on the file server. Please check that the server folder exists.");
      }

    }
  }
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

  <title> Create a Post + | ArtistWorld </title>
</head>


<body>

<?php
  include 'includes/navbar.php';
?>

    <div class="container">
        <div class="col-8 offset-2">
            <form method="POST" enctype="multipart/form-data" action="/new_artist">
                <!-- MAX_FILE_SIZE (hidden) -->
                <input type="hidden" value="1000000">

                 <!-- Name -->
                <div class="form-group col-6 m-1">
                    <label for="artist">Name:</label>
                    <input type="text" name="artist" class="form-control" id="artist">
                </div>

                <!-- Tags -->
                <div class="form-group col-8 m-1">
                    <label for="tags[]">Tags (select all that apply): </label>
                    <select multiple name="tags[]" id="tags[]" class="form-select">
                        <?php foreach($tags as $tag) { ?>
                          <option value=<?php echo htmlspecialchars($tag['id'])?>> <?php echo htmlspecialchars($tag['title']) ?></option>

                        <?php } ?>
                    </select>
                </div>

                <!-- Biography -->
                <div class="form-group m-1 col-10">
                    <label for="bio"> Bio: </label>
                    <textarea class="form-control" id="bio" name="bio"></textarea>
                </div>

                <!-- Review Content -->
                <div class="form-group m-1 col-10">
                    <label for="review_content"> Review: </label>
                    <textarea class="form-control" id="review_content" name="review_content"></textarea>
                </div>

                <!-- Album Rec Url -->
                <div class="form-group m-1">
                    <label for="album"> Spotify Album Recommendation URL: </label>
                    <input type="text" class="form-control" id="album" name="album">
                </div>

                <!-- Image Upload -->
                <div class="form-group mt-1">
                  <label for="file"> Image Upload: </label>
                  <input type="file" id="file" name="file" accept=".svg,.png,.jpg">
                </div>


                <div class="mt-1 float-end">
                    <button class="btn btn-primary ms-10" type="submit">Create New Artist</button>
                </div>
            </form>

        </div>
    </div>
</body>

</html>
