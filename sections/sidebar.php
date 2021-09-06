<div class="col-md-3 recommended">
  <div class="head">
    <h4>Recommended Blogs</h4>
  </div>

  <div class="row blogs">

    <?php
    $recommended_query = mysqli_query($connection, "SELECT * FROM posts ORDER BY post_views DESC LIMIT 3");
    while ($row = mysqli_fetch_assoc($recommended_query)) {

      $cat_query = mysqli_query($connection, "SELECT * FROM categories INNER JOIN posts ON posts.post_categoryID=categories.cat_id WHERE posts.id=" . $row['id'] . "");
      $catg_row = mysqli_fetch_assoc($cat_query);
      $cat_url = strtolower(str_replace(" ", "-", $catg_row['cat_name']));

      $post_url = strtolower(str_replace(" ", "-", $row['post_title']));
    ?>

      <div class="col-md-12">
        <div class="row">
          <div class="col-md-5">
            <div class="blog_img">
              <a href="blog.php?i=<?php echo $row['id'] ?>&post=<?php echo $post_url ?>">
                <img src="<?php echo explode("../", $row['post_feature_image'])[1] ?>" class="img-fluid" alt="">
              </a>
            </div>
          </div>
          <div class="col-md-7">
            <div class="category">
              <a href="categories.php?category=<?php echo $cat_url ?>"><?php echo strtoupper($catg_row['cat_name']) ?></a>
            </div>
            <div class="blog-link">
              <a href="blog.php?i=<?php echo $row['id'] ?>&post=<?php echo $post_url ?>" class="title">
                <h4>
                  <?php echo $row['post_title'] ?>
                </h4>
              </a>
            </div>
            <div class="date"><?php echo date("F jS, Y", strtotime($row['post_date'])); ?></div>
          </div>
        </div>
      </div>

    <?php } ?>

  </div>


  <div class=".col-md-3 categories">
    <div class="head">
      <h4>Categories</h4>
    </div>

    <ul>
      <?php
      $catg_query = mysqli_query($connection, "SELECT cat_name,COUNT(*) AS total FROM posts INNER JOIN categories ON posts.post_categoryID=categories.cat_id GROUP BY posts.post_categoryID ORDER BY total DESC");

      while ($row = mysqli_fetch_assoc($catg_query)) :
        $cat_url = strtolower(str_replace(" ", "-", $row['cat_name']));
      ?>
        <li>
          <a href="categories.php?category=<?php echo $cat_url ?>">
            <span class="name"><?php echo strtoupper($row['cat_name']) ?></span>
            <span class="count"><?php echo $row['total'] ?></span>
          </a>
        </li>
      <?php endwhile; ?>

    </ul>
  </div>

  <div class=".col-md-3 recent_posts">
    <div class="head">
      <h4>Recent Posts</h4>
    </div>

    <ul>

      <?php
      $recent_query = mysqli_query($connection, "SELECT * FROM posts ORDER BY post_date DESC LIMIT 10");
      while ($row = mysqli_fetch_assoc($recent_query)) :
        $post_url = strtolower(str_replace(" ", "-", $row['post_title']));
      ?>
        <li>
          <a href="blog.php?i=<?php echo $row['id'] ?>&post=<?php echo $post_url ?>"><?php echo $row['post_title'] ?></a>
        </li>
      <?php endwhile; ?>

    </ul>

  </div>

  <div class=".col-md-3 recent_comments">
    <div class="head">
      <h4>Recent Comments</h4>
    </div>

    <ul>

      <?php
      $recent_comment_query = mysqli_query($connection, "SELECT posts.id,post_title,username,text FROM comments INNER JOIN posts ON comments.post_id=posts.id ORDER BY comment_date DESC LIMIT 12");
      while ($comm_row = mysqli_fetch_assoc($recent_comment_query)) :
        $comm_blog_url = strtolower(str_replace(" ", "-", $comm_row['post_title']));

        if (strlen($comm_row['post_title']) > 30) {
          $comm_title = substr($comm_row['post_title'], 0, 30) . "...";
        } else {
          $comm_title = $comm_row['post_title'];
        }

        if (strlen($comm_row['text']) > 35) {
          $comm_text = substr($comm_row['text'], 0, 35) . "...";
        } else {
          $comm_text = $comm_row['text'];
        }

      ?>

        <li>
          <i class="fas fa-user"></i>
          <span class="name"><?php echo $comm_row['username'] ?></span> on
          <a href="blog.php?i=<?php echo $comm_row['id'] ?>&post=<?php echo $comm_blog_url ?>"><?php echo $comm_title; ?></a>
          <p><?php echo $comm_text ?></p>
        </li>

      <?php endwhile; ?>

    </ul>

  </div>

</div>