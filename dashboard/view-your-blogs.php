<?php ob_start(); ?>
<?php include "../ajax/functions.php" ?>
<?php
if (!isset($_SESSION['userkey']) || !isset($_SESSION['role'])) {
  header("Location: ../login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Summernote</title>

  <!-- texxt editor -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="../js/summernote.js"></script>
  <link rel="stylesheet" href="../css/style.css">
  <!-- ./texxt editor -->

</head>

<body>

  <div class="container view-blog ">
    <div class="row">
      <div class="col-md-12">


        <table class="table table-hover table-responsive table-borderless">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Author</th>
              <th scope="col">Blog</th>
              <th scope="col">Feature Image</th>
              <th scope="col">Blog Status</th>
              <th scope="col">Comment Status</th>
              <th scope="col">Total Comments</th>
              <th scope="col">Total Views</th>
              <th scope="col">Total Likes</th>
              <th scope="col">Total Dislikes</th>
            </tr>
          </thead>
          <tbody>

            <tr>
              <th scope="row">1</th>
              <td>Mark</td>
              <td>Otto</td>
              <td>Otto</td>
              <td>Otto</td>
              <td>@mdo</td>
            </tr>

          </tbody>
        </table>


      </div>
    </div>
  </div>



  <script src="../js/app.js"></script>
</body>

</html>