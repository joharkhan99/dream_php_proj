<!-- head -->
<?php include "sections/header.php" ?>
<!-- head -->

<main>

  <?php include "sections/nav.php" ?>

  <div class="container-lg single_blog">

    <?php
    include "ajax/functions.php";

    if (isset($_GET['i']) && !empty($_GET['i'])) {

      $p_id = sanitize($_GET['i']);
      ADDVIEW($p_id);
      $query = mysqli_query($connection, "SELECT * FROM posts INNER JOIN categories ON posts.post_categoryID=categories.cat_id INNER JOIN users ON posts.post_author=users.userkey WHERE posts.id='$p_id'");

      if (mysqli_num_rows($query) <= 0) {
        echo "<h3 style='text-align: center;
        width: 100%;
        height: 100%;
        margin: auto;
        color: #929698;margin-top: 73px;'>Post Not Found!</h3>";
      } else {

        $row = mysqli_fetch_assoc($query);

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
              <button class="comment_link" onclick="location.href='#comments_section'">Comments</button>

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


              <?php
              $post_title = $row['post_title'];

              $related_query = "SELECT * FROM posts WHERE post_categoryID = " . $row['cat_id'] . " AND id != " . $_GET['i'] . " ORDER BY RAND() LIMIT 0,10";

              $related_result = mysqli_query($connection, $related_query);

              if (mysqli_num_rows($related_result) > 0) {
              ?>

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

                              <?php
                              while ($related_row = mysqli_fetch_assoc($related_result)) :
                                $url = strtolower(str_replace(" ", "-", $related_row['post_title']));
                              ?>

                                <li>
                                  <a href="blog.php?i=<?php echo $related_row['id'] ?>&post=<?php echo $url ?>"><?php echo $related_row['post_title'] ?></a>
                                </li>
                              <?php endwhile; ?>

                            </ul>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              <?php
              } else {
                // echo mysqli_error($connection);
              }

              ?>



            </div>

            <!-- comments -->
            <div class="comments_section" id="comments_section">
              <div class="container">
                <div class="row c_row_form">
                  <div class="col-12">

                    <div class="head">
                      <h4>Comments</h4>
                    </div>

                    <div class="before">

                      <div class="comment_form">
                        <div class="row">
                          <div class="col-md-12">
                            <h3>LEAVE A COMMENT</h3>

                            <form name="comm_form" id="comm_form" method="POST" onsubmit="Su_Cm(event)">
                              <div class="mb-3">
                                <textarea name="comment_text" id="comment_text" cols="30" rows="10" class="form-control" placeholder="Comment: *"></textarea>
                              </div>

                              <?php
                              $s = "";
                              $checkbox = "save";
                              if (isset($_COOKIE['uuid'])) {
                                $s = "style='display:none'";
                                $checkbox = "";
                              }
                              ?>

                              <div class="s" <?php echo $s ?>>
                                <div class="mb-3">
                                  <input type="name" name="name" class="form-control" placeholder="Name: *">
                                </div>
                                <div class="mb-3">
                                  <input type="email" name="email" class="form-control" placeholder="Email: *">
                                </div>
                                <input type="hidden" name="comm" id="c_scrt_p_j" value="<?php echo uniqid("c") ?>">
                                <input type="hidden" name="c_i_u-d" id="c_i_u-d" value="">
                                <div class="form-check mb-3">
                                  <input class="form-check-input" name="<?php echo $checkbox; ?>" type="checkbox" id="<?php echo $checkbox; ?>">
                                  <label class="form-check-label" for="save">
                                    Save my name and email in this browser for the next time I comment.
                                  </label>
                                </div>
                              </div>


                              <input type="hidden" name="p_id" value="<?php echo $p_id ?>">
                              <button type="submit" class="btn btn-primary px-lg-5">Post Comment</button>

                            </form>

                          </div>
                        </div>
                      </div>
                    </div>

                    <div id="comm">
                    </div>

                  </div>

                </div>
              </div>
            </div>
            <!-- ./comments -->

          </div>

        <?php       } ?>

        <?php include "sections/sidebar.php" ?>

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

  function COMM(type = "default", p_id) {
    $.ajax({
      method: "POST",
      url: "ajax/comm.php",
      data: {
        type: type,
        p_id: p_id
      },
      success: function(response) {
        $("#comm").html(response);
      }
    });
  };

  // $(document).ready(function() {
  COMM("recent", <?php echo $_GET['i'] ?>);

  $('.blog_content img,.comments_section img').click(function(e) {
    $(this).toggleClass('fullscreen');
  });

  function Su_Cm(event) {
    event.preventDefault();
    var f = new FormData($('#comm_form')[0]);

    $.ajax({
      type: "post",
      url: "ajax/add_comm.php",
      data: f,
      processData: false,
      contentType: false,
      success: function(response) {

        if (response.includes("0")) {
          showAlert(response.replace('0', ''));
        } else {
          showAlert(response);

          if (typeof(document.getElementById('save')) != 'undefined' && document.getElementById('save') != null && document.getElementById('save').checked) {
            setTimeout(() => {
              window.location.reload();
            }, 2000);
          } else {
            setTimeout(() => {
              COMM("recent", <?php echo $_GET['i'] ?>);
            }, 2000);
          }
          $("#comm_form").trigger("reset");
        }
      }
    });
  };

  function Rp_Cm(event) {
    event.preventDefault();
    var f = new FormData($('#reply_form')[0]);

    $.ajax({
      type: "post",
      url: "ajax/rep_comm.php",
      data: f,
      processData: false,
      contentType: false,
      success: function(response) {

        if (response.includes("0")) {
          showAlert(response.replace('0', ''));
        } else {
          showAlert(response);

          if (typeof(document.getElementById('save')) != 'undefined' && document.getElementById('save') != null && document.getElementById('save').checked) {
            setTimeout(() => {
              window.location.reload();
            }, 2000);
          } else {
            setTimeout(() => {
              COMM("recent", <?php echo $_GET['i'] ?>);

              $($(".before")).append($(".comment_form"));
              $("#reply_form").attr({
                "id": "comm_form",
                "name": "comm_form",
                "onsubmit": "Su_Cm(event)"
              });
              $(".comment_form h3").text("LEAVE A COMMENT");
              $("#c_scrt_p_j").attr("name", "comm");
              $(".comment_form button[type='submit']").text("Post Comment");
              $("#c_i_u-d").val("");

            }, 2000);
          }
          $("#reply_form").trigger("reset");
        }
      }
    });
  };

  // });
</script>

</body>

</html>