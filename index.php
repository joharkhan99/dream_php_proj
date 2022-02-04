<!-- head -->
<?php include "sections/header.php" ?>
<!-- head -->
<?php include "ajax/functions.php" ?>

<main>
  <?php include "sections/nav.php" ?>
  <!-- top content -->
  <div class="container-lg top-blogs-sect">
    <div class="row pb-4 left_blog">
      <!-- top blog -->
      <div class="col-md-6 mb-4">
        <div class="row">
          <div class="col-md-12 top-blog-img">
            <a href="article.php?i=<?php echo getTopBlog()[0]['post_id'] ?>&article=<?php echo slugify(getTopBlog()[0]['post_title']); ?>">
              <img src="feature/<?php echo getTopBlog()[0]['post_feature_image'] ?>" class="h-100 img-fluid w-100" alt="<?php echo getTopBlog()[0]['post_title']; ?>">
            </a>
          </div>
          <div class="col-md-12">
            <div class="category">
              <a href="categories.php?category=<?php echo categoryURL(getTopBlog()[0]['cat_name']) ?>"><?php echo getTopBlog()[0]['cat_name'] ?></a>
            </div>
            <a href="article.php?i=<?php echo getTopBlog()[0]['post_id'] ?>&article=<?php echo slugify(getTopBlog()[0]['post_title']); ?>" class="blog-link">
              <div class="title">
                <h1><?php echo getTopBlog()[0]['post_title'] ?></h1>
              </div>
            </a>
            <div class="author">
              <a href="author.php?author=<?php echo slugify(getTopBlog()[0]['name']); ?>&i=<?php echo substr(getTopBlog()[0]['userkey'], 0, 7) ?>"><?php getTopBlog()[0]['name'] ?>By <?php echo getTopBlog()[0]['name'] ?></a>
            </div>
          </div>
        </div>
        <div class="row mt-5">
          <div class="col-md-12 top-blog-img">
            <a href="article.php?i=<?php echo getTopBlog()[1]['post_id'] ?>&article=<?php echo slugify(getTopBlog()[1]['post_title']); ?>">
              <img src="feature/<?php echo getTopBlog()[1]['post_feature_image'] ?>" class="h-100 img-fluid w-100" alt="<?php echo getTopBlog()[1]['post_title']; ?>">
            </a>
          </div>
          <div class="col-md-12">
            <div class="category">
              <a href="categories.php?category=<?php echo categoryURL(getTopBlog()[1]['cat_name']) ?>"><?php echo getTopBlog()[1]['cat_name'] ?></a>
            </div>
            <a href="article.php?i=<?php echo getTopBlog()[1]['post_id'] ?>&article=<?php echo slugify(getTopBlog()[1]['post_title']); ?>" class="blog-link">
              <div class="title">
                <h1><?php echo getTopBlog()[1]['post_title'] ?></h1>
              </div>
            </a>
            <div class="author">
              <a href="author.php?author=<?php echo slugify(getTopBlog()[1]['name']); ?>&i=<?php echo substr(getTopBlog()[1]['userkey'], 0, 7) ?>"><?php getTopBlog()[1]['name'] ?>By <?php echo getTopBlog()[1]['name'] ?></a>
            </div>
          </div>
        </div>
      </div>
      <!-- ./top blog -->

      <!-- side-blogs -->
      <div class="col-md-6 px-4 four_grids_blog">
        <div class="row row-cols-2">
          <?php for ($i = 2; $i <= 3; $i++) : ?>
            <div class="col">
              <div class="blog_card">
                <div class="blog_img">
                  <a href="article.php?i=<?php echo getTopBlog()[$i]['post_id'] ?>&article=<?php echo slugify(getTopBlog()[$i]['post_title']); ?>">
                    <img src="feature/<?php echo getTopBlog()[$i]['post_feature_image'] ?>" alt="<?php echo getTopBlog()[$i]['post_title']; ?>" class="img-fluid">
                  </a>
                </div>
                <div class="category">
                  <a href="categories.php?category=<?php echo categoryURL(getTopBlog()[$i]['cat_name']) ?>"><?php echo getTopBlog()[$i]['cat_name'] ?></a>
                </div>
                <a href="article.php?i=<?php echo getTopBlog()[$i]['post_id'] ?>&article=<?php echo slugify(getTopBlog()[$i]['post_title']); ?>" class="blog-link">
                  <div class="title">
                    <h4><?php echo getTopBlog()[$i]['post_title'] ?></h4>
                  </div>
                </a>
                <div class="author">
                  <a href="author.php?author=<?php echo slugify(ucwords(getTopBlog()[$i]['name'])); ?>&i=<?php echo substr(getTopBlog()[$i]['userkey'], 0, 7) ?>">By <?php echo ucwords(getTopBlog()[$i]['name']) ?></a>
                </div>
              </div>
            </div>
          <?php endfor; ?>
        </div>

        <div class="row row-cols-2">
          <?php for ($i = 4; $i <= 5; $i++) : ?>
            <div class="col">
              <div class="blog_card">
                <div class="blog_img">
                  <a href="article.php?i=<?php echo getTopBlog()[$i]['post_id'] ?>&article=<?php echo slugify(getTopBlog()[$i]['post_title']); ?>">
                    <img src="feature/<?php echo getTopBlog()[$i]['post_feature_image'] ?>" alt="<?php echo getTopBlog()[$i]['post_title']; ?>" class="img-fluid">
                  </a>
                </div>
                <div class="category">
                  <a href="categories.php?category=<?php echo categoryURL(getTopBlog()[$i]['cat_name']) ?>"><?php echo getTopBlog()[$i]['cat_name'] ?></a>
                </div>
                <a href="article.php?i=<?php echo getTopBlog()[$i]['post_id'] ?>&article=<?php echo slugify(getTopBlog()[$i]['post_title']); ?>" class="blog-link">
                  <div class="title">
                    <h4><?php echo getTopBlog()[$i]['post_title'] ?></h4>
                  </div>
                </a>
                <div class="author">
                  <a href="author.php?author=<?php echo slugify(ucwords(getTopBlog()[$i]['name'])); ?>&i=<?php echo substr(getTopBlog()[$i]['userkey'], 0, 7) ?>">By <?php echo ucwords(getTopBlog()[$i]['name']) ?></a>
                </div>
              </div>
            </div>
          <?php endfor; ?>
        </div>
      </div>
      <!-- ./side-blogs -->

    </div>

    <div class="row pt-4 sect-2-blogs px-2">

      <?php for ($i = 6; $i <= 13; $i++) : ?>
        <div class="col-sm-3 col-md-3">
          <div class="blog_card">
            <div class="blog_img">
              <a href="article.php?i=<?php echo getTopBlog()[$i]['post_id'] ?>&article=<?php echo slugify(getTopBlog()[$i]['post_title']); ?>">
                <img src="feature/<?php echo getTopBlog()[$i]['post_feature_image'] ?>" alt="<?php echo getTopBlog()[$i]['post_title']; ?>" class="img-fluid">
              </a>
            </div>
            <div class="category">
              <a href="categories.php?category=<?php echo categoryURL(getTopBlog()[$i]['cat_name']) ?>"><?php echo getTopBlog()[$i]['cat_name'] ?></a>
            </div>
            <a href="article.php?i=<?php echo getTopBlog()[$i]['post_id'] ?>&article=<?php echo slugify(getTopBlog()[$i]['post_title']); ?>" class="blog-link">
              <div class="title">
                <h4><?php echo getTopBlog()[$i]['post_title'] ?></h4>
              </div>
            </a>
            <div class="author">
              <a href="author.php?author=<?php echo slugify(ucwords(getTopBlog()[$i]['name'])); ?>&i=<?php echo substr(getTopBlog()[$i]['userkey'], 0, 7) ?>">By <?php echo ucwords(getTopBlog()[$i]['name']) ?></a>
            </div>
          </div>
        </div>
      <?php endfor; ?>

    </div>

    <div class="row mt-5 mb-5">
      <a href="explore.php" class="view_more">View More</a>
    </div>
  </div>

  <!-- most popular -->
  <div class="container-lg most_popular">
    <h3>Most Popular</h3>
    <div class="row">
      <ol>
        <?php getMostPopular() ?>
      </ol>
    </div>
  </div>
  <!-- ./most popular -->

  <!-- recent comments -->
  <div class="container-lg most_recent">
    <h3>Recent Comments</h3>
    <div class="row">
      <ol>
        <?php getRecentComments() ?>
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