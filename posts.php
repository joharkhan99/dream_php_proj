<!-- head -->
<?php include "sections/header.php" ?>
<!-- head -->
<!-- db -->
<?php include "ajax/db.php" ?>
<!-- ./db -->

<main>

  <?php include "sections/nav.php" ?>

  <div class="container-lg all_posts">

    <div class="row posts_title pb-3 mb-5 mt-3">
      <div class="col-md-12 text-center">
        <h1>All Blogs</h1>
      </div>
    </div>

    <div class="row body">

      <div class="col-md-9 blog_content">

        <div class="posts">
          <div class="row">

            <?php
            $results_per_page = 10;
            $query = "SELECT * FROM posts ORDER BY post_date DESC";
            $result = mysqli_query($connection, $query);
            $number_of_result = mysqli_num_rows($result);

            $number_of_page = ceil($number_of_result / $results_per_page);
            if (!isset($_GET['page'])) {
              $page = 1;
            } else {
              $page = $_GET['page'];
            }

            $page_first_result = ($page - 1) * $results_per_page;

            $query = "SELECT * FROM posts ORDER BY post_date DESC LIMIT " . $page_first_result . ',' . $results_per_page;
            $result = mysqli_query($connection, $query);

            function getTagValue($string, $tag)
            {
              $pattern = "/<{$tag}>(.*?)<\/{$tag}>/s";
              preg_match($pattern, $string, $matches);
              return isset($matches[1]) ? $matches[1] : '';
            }

            while ($row = mysqli_fetch_assoc($result)) :
            ?>

              <div class="col-md-4">
                <div class="image">
                  <?php
                  $url = strtolower(str_replace(" ", "-", $row['post_title']));
                  ?>
                  <a href="blog.php?i=<?php echo $row['id'] ?>&post=<?php echo $url ?>">
                    <?php
                    $img = explode("../", $row['post_feature_image']);
                    ?>
                    <img src="<?php echo $img[1]; ?>" alt="<?php echo $img[1]; ?>">
                  </a>
                </div>
                <div class="category">
                  <?php
                  $query = "SELECT cat_name FROM categories WHERE categories.cat_id=" . $row['post_categoryID'] . "";
                  $catg = mysqli_fetch_assoc(mysqli_query($connection, $query));
                  $cat_url = strtolower(str_replace(" ", "-", $catg['cat_name']));
                  ?>

                  <a href="categories.php?category=<?php echo $cat_url ?>"><?php echo $catg['cat_name'] ?></a>
                </div>
                <div class="title">
                  <a href="blog.php?i=<?php echo $row['id'] ?>&post=<?php echo $url ?>"><?php echo $row['post_title'] ?></a>
                </div>

                <p class="text">
                  <?php
                  $p = getTagValue($row['post_content'], "p");

                  if (strlen($p) > 130) {
                    echo substr(trim(html_entity_decode($p)), 0, 130) . "...";
                  } else {
                    echo trim(html_entity_decode($p));
                  }
                  ?>
                </p>

                <?php
                $query = "SELECT name,userkey FROM users WHERE users.userkey='" . $row['post_author'] . "' LIMIT 1";
                $author_result = mysqli_query($connection, $query);
                $author = mysqli_fetch_assoc($author_result);
                $author_url = strtolower(str_replace(" ", "-", $author['name']));
                ?>

                <span class="_a">
                  By
                  <a href="author.php?k=<?php echo substr($author['userkey'], 0, 5) ?>&author=<?php echo $author_url ?>" class="author"><?php echo $author['name']; ?></a>
                </span>
                <span class="date"><?php echo date("F jS, Y", strtotime($row['post_date'])) ?></span>
              </div>

            <?php endwhile; ?>

          </div>
        </div>


        <!-- comments -->
        <div class="pagination" id="pagination">
          <div class="container">
            <div class="row mb-5">
              <div class="col-md-12">
                <div>
                  <ul>

                    <?php
                    for ($i = 1; $i <= $number_of_page; $i++) {
                      if ($page == $i) {
                        echo '<li><a href="posts.php?page=' . $i . '" class="active">' . $i . '</a></li>';
                      } else {
                        echo '<li><a href="posts.php?page=' . $i . '">' . $i . '</a></li>';
                      }
                    }

                    ?>

                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- ./comments -->

      </div>

      <div class="col-md-3 recommended">
        <div class="head">
          <h4>Recommended Blogs</h4>
        </div>

        <div class="row blogs">

          <div class="col-md-12">
            <div class="row">
              <div class="col-md-5">
                <div class="blog_img">
                  <a href="javascript:void(0)">
                    <img src="img/test4.png" class="img-fluid" alt="">
                  </a>
                </div>
              </div>
              <div class="col-md-7">
                <div class="category">
                  <a href="javascript:void(0)">Internet</a>
                </div>
                <div class="blog-link">
                  <a href="javascript:void(0)" class="title">
                    <h4>
                      Lorem ipsum dolor sit, amet consectetur adipisicing elit
                    </h4>
                  </a>
                </div>
                <div class="date">7/19/21 9:01PM</div>
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="row">
              <div class="col-md-5">
                <div class="blog_img">
                  <a href="javascript:void(0)">
                    <img src="img/test2.png" class="img-fluid" alt="">
                  </a>
                </div>
              </div>
              <div class="col-md-7">
                <div class="category">
                  <a href="javascript:void(0)">Internet</a>
                </div>
                <div class="blog-link">
                  <a href="javascript:void(0)" class="title">
                    <h4>
                      Lorem ipsum dolor sit, amet consectetur adipisicing elit
                    </h4>
                  </a>
                </div>
                <div class="date">7/19/21 9:01PM</div>
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="row">
              <div class="col-md-5">
                <div class="blog_img">
                  <a href="javascript:void(0)">
                    <img src="img/test3.png" class="img-fluid" alt="">
                  </a>
                </div>
              </div>
              <div class="col-md-7">
                <div class="category">
                  <a href="javascript:void(0)">Internet</a>
                </div>
                <div class="blog-link">
                  <a href="javascript:void(0)" class="title">
                    <h4>
                      Lorem ipsum dolor sit, amet consectetur adipisicing elit
                    </h4>
                  </a>
                </div>
                <div class="date">7/19/21 9:01PM</div>
              </div>
            </div>
          </div>


        </div>


        <div class=".col-md-3 categories">
          <div class="head">
            <h4>Categories</h4>
          </div>

          <ul>
            <li>
              <a href="javascript:void(0)">
                <span class="name">HTML and CSS</span>
                <span class="count">90</span>
              </a>
            </li>
            <li>
              <a href="javascript:void(0)">
                <span class="name">HTML and CSS</span>
                <span class="count">90</span>
              </a>
            </li>
          </ul>
        </div>

        <div class=".col-md-3 recent_posts">
          <div class="head">
            <h4>Recent Posts</h4>
          </div>

          <ul>
            <li>
              <a href="javascript:void(0)">Astronauts Give Us a Delightful Look </a>
            </li>
            <li>
              <a href="javascript:void(0)">Astronauts Give Us a Delightful Look </a>
            </li>
            <li>
              <a href="javascript:void(0)">Astronauts Give Us a Delightful Look </a>
            </li>
          </ul>

        </div>

      </div>

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