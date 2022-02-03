<!-- head -->
<?php include "sections/header.php" ?>
<!-- head -->
<!-- db -->
<?php include "ajax/functions.php" ?>
<!-- ./db -->

<main>

  <?php include "sections/nav.php" ?>

  <div class="container-lg all_posts">

    <div class="row posts_title pb-3 mb-5 mt-3">
      <div class="col-md-12 text-center">
        <h1>Explore Articles</h1>
      </div>
    </div>

    <div class="row body">

      <div class="col-md-9 blog_content">

        <div class="posts">
          <div class="row">

            <?php
            $results_per_page = 12;
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

            $query = mysqli_query($connection, "SELECT posts.id AS post_id,post_feature_image,post_title,userkey,users.name,post_date,cat_name FROM posts INNER JOIN categories ON categories.cat_id=posts.post_categoryID INNER JOIN users ON users.userkey=posts.post_author WHERE posts.post_status='publish' ORDER BY post_date DESC LIMIT " . $page_first_result . ',' . $results_per_page);
            while ($row = mysqli_fetch_assoc($query)) :
            ?>

              <div class="col-md-4">
                <div class="image">
                  <a href="article.php?i=<?php echo $row['post_id'] ?>&article=<?php echo slugify($row['post_title']); ?>">
                    <img src="feature/<?php echo $row['post_feature_image'] ?>" class="h-100 img-fluid w-100" alt="<?php echo $row['post_title']; ?>">
                  </a>
                </div>
                <div class="category">
                  <a href="categories.php?category=<?php echo categoryURL($row['cat_name']) ?>"><?php echo $row['cat_name'] ?></a>
                </div>
                <div class="title">
                  <a href="article.php?i=<?php echo $row['post_id'] ?>&article=<?php echo slugify($row['post_title']); ?>"><?php echo $row['post_title'] ?></a>
                </div>
                <span class="_a">
                  <a href="author.php?author=<?php echo slugify($row['name']); ?>&i=<?php echo substr($row['userkey'], 0, 7) ?>" class="author">By <?php echo $row['name'] ?></a>
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
                    for ($i = 1; $i < $number_of_page; $i++) {
                      if ($page == $i) {
                        echo '<li><a class="active">' . $i . '</a></li>';
                      } else {
                        echo '<li><a href="explore.php?page=' . $i . '">' . $i . '</a></li>';
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