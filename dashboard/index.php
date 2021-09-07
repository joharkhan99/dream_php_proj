<?php session_start(); ?>
<?php ob_start(); ?>
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
  <title>Dashboard</title>
  <link href="../css/style.css" rel="stylesheet">
  <link href="../css/bootstrap.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>

<body>
  <div class="container pt-5">
    <div class="row mb-4">
      <div class="col-md-12 text-center mb-5">
        <?php include "../ajax/db.php" ?>
        <?php
        $userkey = $_SESSION['userkey'];
        $query = mysqli_query($connection, "SELECT name,profile_pic FROM users WHERE userkey='$userkey'");
        $row = mysqli_fetch_assoc($query);
        ?>
        <img src="../users/<?php echo $row['profile_pic'] ?>" class="rounded-circle mb-3" width="150px" height="150px" alt="" style="object-fit: cover;">
        <h5 class="text-muted">Hello, <?php echo strtoupper($row['name']) ?></h5>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4 mb-3">
        <a href="write-blog.php" class="btn btn-primary w-100">Write A Blog</a>
      </div>
      <div class="col-md-4 mb-3">
        <a href="view-your-blogs.php" class="btn btn-primary w-100">View Your Blogs</a>
      </div>
      <div class="col-md-4 mb-3">
        <a href="view-your-drafts.php" class="btn btn-primary w-100">View Drafts</a>
      </div>
    </div>

    <div class="row mt-5">
      <div class="col-md-4">
        <form name="a_c" onsubmit="event.preventDefault();A_C()" id="a_c" class="rounded border py-3 px-3">
          <label for="catg">Add Category</label>
          <input type="text" name="catg" id="catg" placeholder="Enter Category" class="form-control mt-2" required>
          <button type="submit" name="submit_catg" id="submit_catg" class="btn btn-success w-100 mt-3">Add</button>
        </form>
      </div>
    </div>

  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="../js/app.js"></script>
</body>

</html>