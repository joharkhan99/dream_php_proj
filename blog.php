<!-- head -->
<?php include "sections/header.php" ?>
<!-- head -->

<main>

  <?php include "sections/nav.php" ?>

  <?php
  // $query = "SELECT * FROM test";
  // $result = mysqli_query($connection, $query);

  // while ($row = mysqli_fetch_assoc($result)) {
  //   $t = str_replace('../', '', $row['test']);
  //   echo $t;
  // }
  ?>

  <div class="container-lg single_blog">

    <?php
    include "ajax/functions.php";

    if (isset($_GET['i']) && !empty($_GET['i'])) {

      $p_id = sanitize($_GET['i']);
      ADDVIEW($p_id);
      $query = mysqli_query($connection, "SELECT * FROM posts INNER JOIN categories ON posts.post_categoryID=categories.cat_id INNER JOIN users ON posts.post_author=users.userkey WHERE posts.id='$p_id'");
      $row = mysqli_fetch_assoc($query);
      // print_r($row);

      $cat_url = strtolower(str_replace(" ", "-", $row['cat_name']));
      $author_url = strtolower(str_replace(" ", "-", $row['name']));
    ?>

      <div class="blog_category">
        <a href="categories.php?category=<?php echo $cat_url ?>">
          <div><?php echo strtoupper($row['cat_name']) ?></div>
        </a>
      </div>

      <div class="blog_heading">
        <h1><?php echo ucwords($row['post_title']) ?></h1>
        <h2 class="tagline"><?php echo $row['post_tag'] ?></h2>
      </div>

      <div class="row body">

        <div class="col-md-9 blog_content">

          <div class="bio">
            <span class="author">By <a href="author.php?k=<?php echo substr($row['userkey'], 0, 5) ?>&author=<?php echo $author_url ?>"><?php echo ucwords($row['name']) ?></a></span>
            <span class="date"><?php echo date("m/d/y", strtotime($row['post_date'])) . " at " . date("g:i A", strtotime($row['post_date'])) ?></span>
            <a class="comment_link" href="#comments_section">Comments (12)</a>

            <?php
            $url_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            ?>
            <button type="button" class="ccb">
              <input type="text" style="visibility: hidden;width:0;visibility: hidden;padding: 0;margin: 0;height: 0;" value="<?php echo $url_link; ?>" id="url_link">
              <span class="share" title="Share"><i class="fas fa-share-alt"></i></span><span class="text">Share</span>
            </button>

          </div>

          <div class="main-content">
            <div class="row">
              <div class="col-md-12">
                <div class="feature-image">
                  <figure>
                    <img src="<?php echo explode("../", $row['post_feature_image'])[1] ?>" alt="">
                    <!-- <figcaption>Fig.1 - Trulli, Puglia, Italy.</figcaption> -->
                  </figure>
                </div>
              </div>
            </div>

            <div class="row body_content">
              <div class="col-md-12">

                <?php
                $body_content = $row['post_content'];
                $body_content = str_replace('<img src="../posts', '<img src="posts', $body_content);

                ?>

                <?php echo $body_content ?>

              </div>
            </div>

            <div class="row likes">
              <div class="col-md-12">
                <div class="mx-auto">
                  <button title="Like this post" onclick="LikePost(<?php echo $p_id; ?>)" class="like-btn"><i class="far fa-thumbs-up"></i></button>
                  <button title="Dislike this post" onclick="DislikePost(<?php echo $p_id; ?>)" class="dislike-btn"><i class="far fa-thumbs-down"></i></button>
                </div>
              </div>
            </div>

            <div class="row body_content mt-5">
              <div class="col-md-12">
                <div class="related_story">
                  <div class="content">
                    <div class="box">
                      <div class="head">
                        <h4>Related Stories</h4>
                      </div>

                      <div class="body">
                        <ul>
                          <li>
                            <a href="javascript:void(0)">Astronauts Give Us a Delightful Look at What the Olympics
                              Would Be Like in Space</a>
                          </li>
                          <li>
                            <a href="javascript:void(0)">Astronauts Give Us a Delightful Look at What the Olympics
                              Would Be Like in Space</a>
                          </li>
                        </ul>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>


          </div>

          <!-- comments -->
          <div class="comments_section" id="comments_section">
            <div class="container">
              <div class="row c_row_form">
                <div class="col-12">

                  <div class="head">
                    <h4>Comments</h4>
                  </div>

                  <div class="comments">
                    <div class="comments-details">
                      <span class="total-comments comments-sort">117 Comments</span>

                      <div class="dropdown">
                        <button class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                          Sort By
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                          <li><a class="dropdown-item" href="#">Action</a></li>
                          <li><a class="dropdown-item" href="#">Another action</a></li>
                        </ul>
                      </div>

                    </div>

                    <div class="comment-box">
                      <span class="commenter-pic">
                        <img src="img/test2.png" class="img-fluid">
                      </span>
                      <span class="commenter-name">
                        <span>Happy markuptag</span> <span class="comment-time">2 hours ago</span>
                      </span>
                      <p class="comment-txt more">Suspendisse massa enim, condimentum sit amet maximus quis, pulvinar
                        sit
                        amet ante. Fusce eleifend dui mi, blandit vehicula orci iaculis ac.</p>
                      <div class="comment-meta">
                        <button class="comment-like"><i class="far fa-thumbs-up"></i> 99</button>
                        <button class="comment-dislike"><i class="far fa-thumbs-down"></i>
                          149</button>
                        <button class="comment-reply" onclick="ToggleForm(this)"><i class="fa fa-reply-all" aria-hidden="true"></i>
                          Reply</button>
                      </div>
                    </div>

                    <div class="comment-box">
                      <span class="commenter-pic">
                        <img src="img/test4.png" class="img-fluid">
                      </span>
                      <span class="commenter-name">
                        <span>Happy markuptag</span> <span class="comment-time">2 hours ago</span>
                      </span>
                      <p class="comment-txt more">Suspendisse massa enim, condimentum sit amet maximus quis, pulvinar
                        sit
                        amet ante. Fusce eleifend dui mi, blandit vehicula orci iaculis ac.</p>
                      <div class="comment-meta">
                        <button class="comment-like"><i class="far fa-thumbs-up"></i> 99</button>
                        <button class="comment-dislike"><i class="far fa-thumbs-down"></i>
                          149</button>
                        <button class="comment-reply" onclick="ToggleForm(this)"><i class="fa fa-reply-all" aria-hidden="true"></i> Reply</button>
                      </div>

                      <div class="comment-box replied">
                        <span class="commenter-pic">
                          <img src="img/test.png" class="img-fluid">
                        </span>
                        <span class="commenter-name">
                          <span>Happy markuptag</span> <span class="comment-time">2 hours ago</span>
                        </span>
                        <p class="comment-txt more">Suspendisse massa enim, condimentum sit amet maximus quis, pulvinar
                          sit amet ante. Fusce eleifend dui mi, blandit vehicula orci iaculis ac.</p>
                      </div>

                      <div class="comment-box replied">
                        <span class="commenter-pic">
                          <img src="img/test.png" class="img-fluid">
                        </span>
                        <span class="commenter-name">
                          <span>Happy markuptag</span> <span class="comment-time">2 hours ago</span>
                        </span>
                        <p class="comment-txt more">Suspendisse massa enim, condimentum sit amet maximus quis, pulvinar
                          sit amet ante. Fusce eleifend dui mi, blandit vehicula orci iaculis ac.</p>
                      </div>


                    </div>

                  </div>

                </div>

                <div class="comment_form">
                  <div class="row">
                    <div class="col-md-12">
                      <h3>LEAVE A REPLY</h3>
                      <button class="cancel_reply" onclick="CancelReply(this)">Cancel Reply</button>

                      <form>
                        <div class="mb-3">
                          <textarea name="comment_text" id="comment_text" cols="30" rows="10" class="form-control" placeholder="Comment: *"></textarea>
                        </div>
                        <div class="mb-3">
                          <input type="name" class="form-control" placeholder="Name: *">
                        </div>
                        <div class="mb-3">
                          <input type="email" class="form-control" placeholder="Email: *">
                        </div>
                        <div class="form-check mb-3">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
                          <label class="form-check-label" for="flexCheckDefault">
                            Save my name and email in this browser for the next time I comment.
                          </label>
                        </div>

                        <button type="submit" class="btn btn-primary px-lg-5">Post Comment</button>
                      </form>

                    </div>
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

    <?php
    } else {
      echo "<h3 style='text-align: center;
      width: 100%;
      height: 100%;
      margin: auto;
      color: #929698;margin-top: 73px;'>Post Not Found!</h3>";
    }
    ?>

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

<script>
  $(".ccb").click(function() {

    var input = document.createElement('textarea');
    input.innerHTML = $("#url_link").val();
    document.body.appendChild(input);
    input.select();
    var result = document.execCommand('copy');
    document.body.removeChild(input);

    showAlert("Link copied to clipboard");
  });
</script>

</body>

</html>