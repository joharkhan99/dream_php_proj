<!-- head -->
<?php include "sections/header.php" ?>
<!-- head -->
<!-- db -->
<?php include "ajax/functions.php" ?>
<!-- ./db -->

<main>

  <?php include "sections/nav.php" ?>

  <div class="container-lg author_info">

    <div class="row">


      <div class="col-md-9">

        <?php
        $author_id = "";
        $author_name = "";
        if (!isset($_GET['k']) || empty($_GET['k'])) {
          $author_id = "2fa9b";
        } else {
          $author_id = sanitize($_GET['k']);
        }
        if (!isset($_GET['author']) || empty($_GET['author'])) {
          $author_name = "ammar";
        } else {
          $author_name = explode("-", sanitize($_GET['author']))[0];
        }


        function getTagValue($string, $tag)
        {
          $pattern = "/<{$tag}>(.*?)<\/{$tag}>/s";
          preg_match($pattern, $string, $matches);
          return isset($matches[1]) ? $matches[1] : '';
        }

        $query = mysqli_query($connection, "SELECT profile_pic,name,user_description FROM posts INNER JOIN users ON users.userkey=posts.post_author WHERE SUBSTRING(users.userkey,1,5) LIKE '%$author_id%' AND users.name LIKE '%$author_name%'");

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

              <?php

              $query = mysqli_query($connection, "SELECT * FROM posts INNER JOIN categories ON categories.cat_id=posts.post_categoryID INNER JOIN users ON users.userkey=posts.post_author WHERE SUBSTRING(users.userkey,1,5) LIKE '%$author_id%' AND users.name LIKE '%$author_name%' ORDER BY post_date DESC");

              while ($posts = mysqli_fetch_assoc($query)) {
                $url = strtolower(str_replace(" ", "-", $posts['post_title']));
                $auth_cat_url = strtolower(str_replace(" ", "-", $posts['cat_name']));
              ?>

                <div class="col-md-4">
                  <div class="image">
                    <a href="blog.php?i=<?php echo $posts['id'] ?>&post=<?php echo $url ?>">
                      <img src="<?php echo explode("../", $posts['post_feature_image'])[1] ?>" alt="">
                    </a>
                  </div>
                  <div class="content">
                    <div class="category">
                      <a href="categories.php?category=<?php echo $auth_cat_url ?>"><?php echo $posts['cat_name'] ?></a>
                    </div>
                    <a href="blog.php?i=<?php echo $posts['id'] ?>&post=<?php echo $url ?>" class="title">
                      <?php echo $posts['post_title'] ?>
                    </a>
                    <p>
                      <?php
                      $p = getTagValue($posts['post_content'], "p");

                      if (strlen($p) > 130) {
                        echo substr(trim(html_entity_decode($p)), 0, 130) . "...";
                      } else {
                        echo trim(html_entity_decode($p));
                      }
                      ?>
                    </p>
                    <span class="date"><?php echo date("F jS, Y", strtotime($posts['post_date'])) ?></span>
                  </div>
                </div>

              <?php } ?>

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