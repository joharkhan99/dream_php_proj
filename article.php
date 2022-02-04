<!-- head -->
<?php include "sections/header.php" ?>
<!-- head -->
<?php include "ajax/functions.php" ?>
<main>

  <?php include "sections/nav.php" ?>

  <div class="container-lg single_blog">

    <?php
    if (isset($_GET['i']) && !empty($_GET['i'])) {

      $p_id = sanitize($_GET['i']);

      if (!postExists($p_id)) {
        echo "<h3 style='text-align: center;
        width: 100%;
        height: 100%;
        margin: auto;
        color: #929698;margin-top: 73px;'>😔  Article Not Found!</h3>";
      } else {
        ADDVIEW($p_id);
    ?>
        <?php getarticleinfo($p_id, 'cat_name') ?>
        <div class="blog_category">
          <a href="categories.php?category=<?php echo categoryURL(getarticleinfo($p_id, 'cat_name')) ?>">
            <div><?php echo categoryURLUnslug(getarticleinfo($p_id, 'cat_name')) ?></div>
          </a>
        </div>

        <div class="row body">

          <div class="col-md-9">

            <div class="main-content">

              <div class="row">
                <div class="col-md-12">
                  <div class="feature-image">
                    <figure>
                      <img src="feature/<?php echo getarticleinfo($p_id, 'post_feature_image') ?>" alt="<?php echo getarticleinfo($p_id, 'post_title') ?>" class="fullscreen">
                    </figure>
                  </div>
                </div>
              </div>

              <div class="row mt-3">
                <div class="px-4 author-profile">
                  <div class="author-img">
                    <a href="author.php?author=<?php echo slugify(getarticleinfo($p_id, 'name')); ?>&i=<?php echo substr(getarticleinfo($p_id, 'userkey'), 0, 7); ?>">
                      <img src="users/<?php echo getarticleinfo($p_id, 'profile_pic') ?>" class="w-100 h-100" alt="<?php echo getarticleinfo($p_id, 'name') ?>">
                    </a>
                  </div>
                  <div class="author-bio d-inline-block">
                    <h4><a href="author.php?author=<?php echo slugify(getarticleinfo($p_id, 'name')); ?>&i=<?php echo substr(getarticleinfo($p_id, 'userkey'), 0, 7); ?>"><?php echo ucwords(getarticleinfo($p_id, 'name')) ?></a></h4>
                    <span>Posted on <?php echo date("F jS, Y", strtotime(getarticleinfo($p_id, 'post_date'))) ?></span>
                  </div>
                  <div class="share d-inline-block">
                    <?php
                    $url_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    ?>
                    <button type="button" class="ccb btn btn-outline-dark btn-sm">
                      <input type="text" class="d-none" id="url_link" value="<?php echo $url_link; ?>"><i class="fas fa-share-alt mx-1"></i>Share</button>
                  </div>
                </div>
              </div>

              <div class="row article-title mt-4">
                <div class="col-md-12 mb-2">
                  <h1><?php echo getarticleinfo($p_id, 'post_title') ?></h1>
                </div>
                <div class="col-md-12 article-tags">
                  <?php
                  $tags = explode(",", getarticleinfo($p_id, 'post_tags'));
                  foreach ($tags as $tag) :
                  ?>
                    <a href="javascript:void(0)" class="px-2 mb-1 py-1 mr-2">#<?php echo $tag ?></a>
                  <?php endforeach; ?>
                </div>
              </div>

              <div class="row body_content">
                <div class="col-md-12">
                  <?php
                  $body_content = getarticleinfo($p_id, 'post_content');
                  $body_content = str_replace('<img src="../posts', '<img src="posts', $body_content);
                  $body_content = str_replace('alt=""', getarticleinfo($p_id, 'post_title'), $body_content);
                  echo $body_content;
                  ?>
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
                          <h4>Related Articles</h4>
                        </div>

                        <div class="body">
                          <ul>
                            <?php getRelatedPosts(getarticleinfo($p_id, 'cat_id'), $p_id) ?>
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

                    <div class="before">
                      <div class="comment_form">
                        <div class="row">
                          <div class="col-md-12">
                            <h3>LEAVE A COMMENT</h3>

                            <?php if (!empty($_COOKIE["_uacct_"]) && isset($_COOKIE["_uacct_"])) : ?>
                              <form name="comm_form" id="comm_form" method="POST" onsubmit="Su_Cm(event)">
                                <textarea name="comment_text" id="comment_text" cols="30" rows="3" class="form-control mb-3" placeholder="Comment: *"></textarea>
                                <input type="hidden" name="p_id" id="p_id" value="<?php echo $p_id ?>">
                                <input type="hidden" name="c_i_u-d" id="c_i_u-d" value="<?php echo $p_id ?>">
                                <button type="submit" class="btn btn-primary px-lg-5">Post Comment</button>
                              </form>
                            <?php else : ?>
                              <form>
                                <textarea cols="30" rows="3" class="form-control mb-3" placeholder="Please Login or Signup to Comment" disabled title="Please Login or Signup to Comment"></textarea>
                                <button type="button" id="myBtn" class="btn btn-primary py-2" data-toggle="modal" data-target="#loginModal">Login or Signup to Comment</button>
                              </form>
                            <?php endif; ?>

                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- login/signup -->
                    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Login/Signup</h5>
                            <button class="close close-btn btn" type="button" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                          </div>
                          <div class="modal-body">Please choose login or Create an Account to continue.</div>
                          <div class="modal-footer">
                            <a class="btn btn-secondary" href="login.php">Login</a>
                            <a class="btn btn-primary" href="signup.php">Create an account</a>
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

        <?php       }
        ?>

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
  $("#myBtn").click(function() {
    $("#loginModal").modal("show");
  });
  $(".close-btn").click(function() {
    $("#loginModal").modal("hide");
  });
</script>
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
          setTimeout(() => {
            COMM("recent", <?php echo $_GET['i'] ?>);
          }, 2000);
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
    });
  };

  // });
</script>

</body>

</html>