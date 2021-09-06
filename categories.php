<!-- head -->
<?php include "sections/header.php" ?>
<!-- head -->
<!-- db -->
<?php include "ajax/functions.php" ?>
<!-- ./db -->

<main>

  <?php include "sections/nav.php" ?>

  <div class="container-lg categories">

    <?php
    $category = "";
    if (isset($_GET['category'])) {
      $category = sanitize($_GET['category']);
    } else {
      $category = "gaming";
    }

    function getTagValue($string, $tag)
    {
      $pattern = "/<{$tag}>(.*?)<\/{$tag}>/s";
      preg_match($pattern, $string, $matches);
      return isset($matches[1]) ? $matches[1] : '';
    }

    $query = mysqli_query($connection, "SELECT * FROM posts INNER JOIN categories ON categories.cat_id=posts.post_categoryID INNER JOIN users ON users.userkey=posts.post_author WHERE categories.cat_name LIKE '%$category%' ORDER BY post_date DESC");
    ?>

    <div class="row">
      <div class="col-md-12 head">
        <h1><?php echo ucwords($category) ?></h1>
      </div>
    </div>

    <div class="row cat_card">

      <div class="col-md-9">
        <div class="row">

          <?php
          while ($row = mysqli_fetch_assoc($query)) {
            $url = strtolower(str_replace(" ", "-", $row['post_title']));
            $author_url = strtolower(str_replace(" ", "-", $row['name']));
          ?>

            <div class="col-md-4">
              <div class="image">
                <a href="blog.php?i=<?php echo $row['id'] ?>&post=<?php echo $url ?>">
                  <img src="<?php echo explode("../", $row['post_feature_image'])[1] ?>" alt="">
                </a>
              </div>
              <div class="content">
                <a href="blog.php?i=<?php echo $row['id'] ?>&post=<?php echo $url ?>" class="title">
                  <?php echo $row['post_title'] ?>
                </a>
                <p>
                  <?php
                  $p = getTagValue($row['post_content'], "p");

                  if (strlen($p) > 130) {
                    echo substr(trim(html_entity_decode($p)), 0, 130) . "...";
                  } else {
                    echo trim(html_entity_decode($p));
                  }
                  ?>
                </p>
                <span class="_a">
                  By
                  <a href="author.php?k=<?php echo substr($row['userkey'], 0, 5) ?>&author=<?php echo $author_url ?>" class="author"><?php echo ucwords($row['name']); ?></a>
                </span>
                <span class="date"><?php echo date("F jS, Y", strtotime($row['post_date'])) ?></span>
              </div>
            </div>
          <?php } ?>

        </div>

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