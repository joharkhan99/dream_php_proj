<!-- head -->
<?php include "sections/header.php" ?>
<!-- head -->
<?php include "ajax/functions.php" ?>

<main>

  <?php include "sections/nav.php" ?>

  <div class="container-lg author_info">

    <div class="row">


      <div class="col-md-9">

        <?php
        $author_id = "";
        $author_name = "";
        if (!isset($_GET['i']) || empty($_GET['i'])) {
          $author_id = "";
        } else {
          $author_id = sanitize($_GET['i']);
        }
        if (!isset($_GET['author']) || empty($_GET['author'])) {
          $author_name = "";
        } else {
          $author_name = str_replace("-", " ", sanitize($_GET['author']));
        }

        $query = mysqli_query($connection, "SELECT profile_pic,name,user_description FROM posts INNER JOIN users ON users.userkey=posts.post_author WHERE SUBSTRING(users.userkey,1,7) LIKE '%$author_id%' AND users.name LIKE '%$author_name%'");

        if (mysqli_num_rows($query) > 0) {

          $row = mysqli_fetch_assoc($query);
        ?>

          <div class="row bio text-center">
            <div class="col-md-8 mx-auto">
              <div class="image">
                <img src="users/<?php echo $row['profile_pic'] ?>" alt="" class="w-100 h-100">
              </div>
              <div class="name">
                <h1>
                  <?php echo ucwords($row['name']) ?>
                </h1>
                <p>
                  <?php echo ucwords($row['user_description']) ?>
                </p>
              </div>
            </div>
          </div>

          <div class="author_posts pt-4">
            <h2>The Latest from <?php echo ucwords($row['name']) ?></h2>

            <div class="row posts">
              <?php getUserArticles($author_id, $author_name); ?>

            </div>


          </div>

        <?php } else {
          echo "<h5 class='text-center text-muted mt-5 mb-5 pb-5'>😔  Nothing Found For This Author!</h5>";
        } ?>


      </div>



      <?php include "sections/sidebar.php" ?>

    </div>


  </div>

  <!-- newsletter -->
  <?php include "sections/newsletter.php" ?>
  <!-- ./newsletter -->

  <!-- footer -->
  <?php include "sections/footer.php" ?>
  <!-- ./footer -->

</main>

<!-- scripts -->
<?php include "sections/scripts.php" ?>
<!-- scripts -->

</body>

</html>