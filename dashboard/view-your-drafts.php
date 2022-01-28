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

  <div class="container view-blog">

    <div class="row back_to_site" style="margin-bottom: 30px;">
      <div class="col-md-12">
        <a href="index.php" class="btn btn-primary">&larr; Back To Dashboard</a>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">


        <table class="table table-hover table-responsive table-borderless table-striped">

          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Draft Date</th>
              <th scope="col">Blog Title</th>
              <th scope="col">Feature Image</th>
              <th scope="col">Comment Status</th>
              <th scope="col">Edit</th>
            </tr>
          </thead>

          <tbody>

            <?php
            $authorkey = sanitize($_SESSION['userkey']);
            $query = mysqli_query($connection, "SELECT * FROM drafts WHERE post_author='$authorkey' ORDER BY draft_date DESC");
            $i = 0;
            while ($row = mysqli_fetch_assoc($query)) :
              $i++;
              $url = strtolower(str_replace(" ", "-", $row['post_title']));
            ?>
              <tr>
                <th scope="row"><?php echo $i; ?></th>
                <td><?php echo $row['draft_date']; ?></td>
                <td>
                  <?php if (!empty($row['post_title'])) {
                    echo $row['post_title'];
                  } else {
                    echo "-";
                  }
                  ?>
                </td>
                <td>
                  <?php if (!empty($row['post_feature_image'])) {
                  ?>
                    <img src="<?php echo $row['post_feature_image']; ?>" alt="" style="width: 100%;height: 60px;object-fit: cover;">
                  <?php
                  } else {
                    echo "-";
                  } ?>
                </td>
                <td><?php
                    if (!empty($row['comment_status'])) {
                      echo $row['comment_status'];
                    } else {
                      echo "-";
                    }
                    ?>
                </td>
                <td>
                  <a style="font-size: 22px;" href="edit-draft.php?id=<?php echo $row['id'] ?>">✎</a>
                </td>
              </tr>

            <?php endwhile; ?>


          </tbody>

        </table>


      </div>
    </div>
  </div>



  <script src="../js/app.js"></script>
</body>

</html>