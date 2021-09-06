<!-- head -->
<?php include "sections/header.php" ?>
<!-- head -->
<!-- db -->
<?php include "ajax/db.php" ?>
<!-- ./db -->

<main>

  <?php include "sections/nav.php" ?>

  <!-- top content -->
  <div class="container-lg top-blogs-sect">

    <div class="row pb-4 left_blog">

      <!-- top blog -->
      <?php
      function getTagValue($string, $tag)
      {
        $pattern = "/<{$tag}>(.*?)<\/{$tag}>/s";
        preg_match($pattern, $string, $matches);
        return isset($matches[1]) ? $matches[1] : '';
      }

      $top_blog_query = mysqli_query($connection, "SELECT * FROM posts INNER JOIN categories ON categories.cat_id=posts.post_categoryID INNER JOIN users ON users.userkey=posts.post_author ORDER BY posts.post_date DESC LIMIT 1");
      $top_blog_row = mysqli_fetch_assoc($top_blog_query);

      $top_blog_url = strtolower(str_replace(" ", "-", $top_blog_row['post_title']));
      $top_blog_cat_url = strtolower(str_replace(" ", "-", $top_blog_row['cat_name']));
      $top_blog_author_url = strtolower(str_replace(" ", "-", $top_blog_row['name']));
      ?>
      <div class="col-md-6">
        <div class="row top-blog-img">
          <div class="col-md-12 p-0">
            <a href="blog.php?i=<?php echo $top_blog_row['id'] ?>&post=<?php echo $top_blog_url ?>">
              <img src="<?php echo explode("../", $top_blog_row['post_feature_image'])[1] ?>" class="img-fluid w-100">
            </a>
          </div>
        </div>
        <div class="row top-blog-content">
          <div class="col-md-12 px-1">
            <div class="category">
              <a href="categories.php?category=<?php echo $top_blog_cat_url ?>"><?php echo $top_blog_row['cat_name'] ?></a>
            </div>
            <a href="blog.php?i=<?php echo $top_blog_row['id'] ?>&post=<?php echo $top_blog_url ?>" class="blog-link">
              <div class="title">
                <h4><?php echo $top_blog_row['post_title'] ?></h4>
              </div>
              <div class="short-descp">
                <p class="mb-2">
                  <?php
                  $p = getTagValue($top_blog_row['post_content'], "p");
                  if (empty($p)) {
                    echo $top_blog_row['post_tag'];
                  } else {
                    if (strlen($p) > 300) {
                      echo substr(trim(html_entity_decode($p)), 0, 300) . "...";
                    } else {
                      echo trim(html_entity_decode($p));
                    }
                  }
                  ?>
                </p>
              </div>
            </a>
            <div class="author">
              <a href="author.php?k=<?php echo substr($top_blog_row['userkey'], 0, 5) ?>&author=<?php echo $top_blog_author_url ?>"><?php echo ucwords($top_blog_row['name']); ?></a>
            </div>
          </div>
        </div>
      </div>
      <!-- ./top blog -->

      <!-- side-blogs -->
      <div class="col-md-6 px-3 four_grids_blog">

        <?php
        $side_blog_query = mysqli_query($connection, "SELECT * FROM posts INNER JOIN categories ON categories.cat_id=posts.post_categoryID INNER JOIN users ON users.userkey=posts.post_author ORDER BY posts.post_date DESC LIMIT 1,12");
        ?>

        <div class="row row-cols-2">

          <!-- 1st -->
          <?php
          $first_row = mysqli_fetch_assoc($side_blog_query);
          if (!empty($first_row)) {
            $side_blog_url = strtolower(str_replace(" ", "-", $first_row['post_title']));
            $side_blog_cat_url = strtolower(str_replace(" ", "-", $first_row['cat_name']));
            $side_blog_author_url = strtolower(str_replace(" ", "-", $first_row['name']));
          ?>
            <div class="col">
              <div class="blog_card">
                <div class="blog_img">
                  <a href="blog.php?i=<?php echo $first_row['id'] ?>&post=<?php echo $side_blog_url ?>">
                    <img src="<?php echo explode("../", $first_row['post_feature_image'])[1] ?>" alt="" class="img-fluid">
                  </a>
                </div>
                <div class="category">
                  <a href="categories.php?category=<?php echo $side_blog_cat_url ?>"><?php echo $first_row['cat_name'] ?></a>
                </div>
                <a href="blog.php?i=<?php echo $first_row['id'] ?>&post=<?php echo $side_blog_url ?>" class="blog-link">
                  <div class="title">
                    <h4><?php echo $first_row['post_title'] ?></h4>
                  </div>
                </a>
                <div class="author">
                  <a href="author.php?k=<?php echo substr($first_row['userkey'], 0, 5) ?>&author=<?php echo $side_blog_author_url ?>"><?php echo ucwords($first_row['name']); ?></a>
                </div>
              </div>
            </div>
          <?php } ?>

          <!-- 2nd -->
          <?php
          $second_row = mysqli_fetch_assoc($side_blog_query);
          if (!empty($second_row)) {
            $side_blog_url = strtolower(str_replace(" ", "-", $second_row['post_title']));
            $side_blog_cat_url = strtolower(str_replace(" ", "-", $second_row['cat_name']));
            $side_blog_author_url = strtolower(str_replace(" ", "-", $second_row['name']));
          ?>
            <div class="col">
              <div class="blog_card">
                <div class="blog_img">
                  <a href="blog.php?i=<?php echo $second_row['id'] ?>&post=<?php echo $side_blog_url ?>">
                    <img src="<?php echo explode("../", $second_row['post_feature_image'])[1] ?>" alt="" class="img-fluid">
                  </a>
                </div>
                <div class="category">
                  <a href="categories.php?category=<?php echo $side_blog_cat_url ?>"><?php echo $second_row['cat_name'] ?></a>
                </div>
                <a href="blog.php?i=<?php echo $second_row['id'] ?>&post=<?php echo $side_blog_url ?>" class="blog-link">
                  <div class="title">
                    <h4><?php echo $second_row['post_title'] ?></h4>
                  </div>
                </a>
                <div class="author">
                  <a href="author.php?k=<?php echo substr($second_row['userkey'], 0, 5) ?>&author=<?php echo $side_blog_author_url ?>"><?php echo ucwords($second_row['name']); ?></a>
                </div>
              </div>
            </div>
          <?php } ?>

        </div>

        <div class="row row-cols-2">

          <!-- 3rd -->
          <?php
          $third_row = mysqli_fetch_assoc($side_blog_query);
          if (!empty($third_row)) {

            $side_blog_url = strtolower(str_replace(" ", "-", $third_row['post_title']));
            $side_blog_cat_url = strtolower(str_replace(" ", "-", $third_row['cat_name']));
            $side_blog_author_url = strtolower(str_replace(" ", "-", $third_row['name']));
          ?>
            <div class="col">
              <div class="blog_card">
                <div class="blog_img">
                  <a href="blog.php?i=<?php echo $third_row['id'] ?>&post=<?php echo $side_blog_url ?>">
                    <img src="<?php echo explode("../", $third_row['post_feature_image'])[1] ?>" alt="" class="img-fluid">
                  </a>
                </div>
                <div class="category">
                  <a href="categories.php?category=<?php echo $side_blog_cat_url ?>"><?php echo $third_row['cat_name'] ?></a>
                </div>
                <a href="blog.php?i=<?php echo $third_row['id'] ?>&post=<?php echo $side_blog_url ?>" class="blog-link">
                  <div class="title">
                    <h4><?php echo $third_row['post_title'] ?></h4>
                  </div>
                </a>
                <div class="author">
                  <a href="author.php?k=<?php echo substr($third_row['userkey'], 0, 5) ?>&author=<?php echo $side_blog_author_url ?>"><?php echo ucwords($third_row['name']); ?></a>
                </div>
              </div>
            </div>

          <?php } ?>

          <!-- 4th -->
          <?php
          $fourth_row = mysqli_fetch_assoc($side_blog_query);
          if (!empty($fourth_row)) {

            $side_blog_url = strtolower(str_replace(" ", "-", $fourth_row['post_title']));
            $side_blog_cat_url = strtolower(str_replace(" ", "-", $fourth_row['cat_name']));
            $side_blog_author_url = strtolower(str_replace(" ", "-", $fourth_row['name']));
          ?>
            <div class="col">
              <div class="blog_card">
                <div class="blog_img">
                  <a href="blog.php?i=<?php echo $fourth_row['id'] ?>&post=<?php echo $side_blog_url ?>">
                    <img src="<?php echo explode("../", $fourth_row['post_feature_image'])[1] ?>" alt="" class="img-fluid">
                  </a>
                </div>
                <div class="category">
                  <a href="categories.php?category=<?php echo $side_blog_cat_url ?>"><?php echo $fourth_row['cat_name'] ?></a>
                </div>
                <a href="blog.php?i=<?php echo $fourth_row['id'] ?>&post=<?php echo $side_blog_url ?>" class="blog-link">
                  <div class="title">
                    <h4><?php echo $fourth_row['post_title'] ?></h4>
                  </div>
                </a>
                <div class="author">
                  <a href="author.php?k=<?php echo substr($fourth_row['userkey'], 0, 5) ?>&author=<?php echo $side_blog_author_url ?>"><?php echo ucwords($fourth_row['name']); ?></a>
                </div>
              </div>
            </div>

          <?php } ?>

        </div>


      </div>
      <!-- ./side-blogs -->

    </div>

    <div class="row pt-4 sect-2-blogs px-1">

      <?php
      while ($four_grids_row = mysqli_fetch_assoc($side_blog_query)) {


        if (!empty($four_grids_row)) {

          $_url = strtolower(str_replace(" ", "-", $four_grids_row['post_title']));
          $_cat_url = strtolower(str_replace(" ", "-", $four_grids_row['cat_name']));
          $_author_url = strtolower(str_replace(" ", "-", $four_grids_row['name']));
      ?>
          <div class="col-sm-3 col-md-3">
            <div class="blog_card">
              <div class="blog_img">
                <a href="blog.php?i=<?php echo $four_grids_row['id'] ?>&post=<?php echo $_url ?>">
                  <img src="<?php echo explode("../", $four_grids_row['post_feature_image'])[1] ?>" alt="" class="img-fluid">
                </a>
              </div>
              <div class="category">
                <a href="categories.php?category=<?php echo $_cat_url ?>"><?php echo $four_grids_row['cat_name'] ?></a>
              </div>
              <a href="blog.php?i=<?php echo $four_grids_row['id'] ?>&post=<?php echo $_url ?>" class="blog-link">
                <div class="title">
                  <h4><?php echo $four_grids_row['post_title'] ?></h4>
                </div>
              </a>
              <div class="author">
                <a href="author.php?k=<?php echo substr($four_grids_row['userkey'], 0, 5) ?>&author=<?php echo $_author_url ?>"><?php echo ucwords($four_grids_row['name']); ?></a>
              </div>
            </div>
          </div>
      <?php

        }
      }
      ?>

    </div>
    <div class="row mt-5 mb-5">
      <a href="posts.php" class="view_more">View More</a>
    </div>
  </div>

  <!-- most popular -->
  <div class="container-lg most_popular">
    <h3>Most Popular</h3>
    <div class="row">
      <ol>

        <?php
        $popular_query = mysqli_query($connection, "SELECT * FROM posts ORDER BY post_views DESC LIMIT 5");
        ?>
        <?php while ($popular_row = mysqli_fetch_assoc($popular_query)) :
          $pop_url = strtolower(str_replace(" ", "-", $popular_row['post_title']));
        ?>
          <li>
            <a href="blog.php?i=<?php echo $popular_row['id'] ?>&post=<?php echo $pop_url ?>" class="blog-link">
              <div class="title">
                <h4><?php echo ucwords($popular_row['post_title']); ?></h4>
              </div>
            </a>
          </li>
        <?php endwhile; ?>

      </ol>
    </div>
  </div>
  <!-- ./most popular -->

  <!-- recent comments -->
  <div class="container-lg most_recent">
    <h3>Recent Comments</h3>
    <div class="row">
      <ol>

        <?php
        $recent_comment_query = mysqli_query($connection, "SELECT posts.id,post_title,userimg,username,text FROM comments INNER JOIN posts ON comments.post_id=posts.id ORDER BY comment_date DESC LIMIT 10");
        while ($comm_row = mysqli_fetch_assoc($recent_comment_query)) :
          $comm_blog_url = strtolower(str_replace(" ", "-", $comm_row['post_title']));
          if (empty($comm_row['userimg'])) {
            $image = "profiles/default.png";
          } else {
            $image = explode("../", $comm_row['userimg'])[1];
          }

          if (strlen($comm_row['post_title']) > 90) {
            $comm_title = substr($comm_row['post_title'], 0, 85) . "...";
          } else {
            $comm_title = $comm_row['post_title'];
          }

          if (strlen($comm_row['text']) > 100) {
            $comm_text = substr($comm_row['text'], 0, 100) . "...";
          } else {
            $comm_text = $comm_row['text'];
          }

        ?>

          <li>
            <div class="img">
              <img src="<?php echo $image; ?>" alt="<?php echo $comm_row['username'] ?>">
            </div>
            <div class="content">
              <i class="fas fa-user"></i>
              <span class="name"><?php echo $comm_row['username'] ?></span> on
              <a href="blog.php?i=<?php echo $comm_row['id'] ?>&post=<?php echo $comm_blog_url ?>"><?php echo $comm_title; ?></a>
              <p><?php echo $comm_text ?></p>
            </div>
          </li>

        <?php endwhile; ?>

      </ol>
    </div>
  </div>
  <!-- ./recent comments -->

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