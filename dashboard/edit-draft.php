<?php ob_start(); ?>
<?php include "../ajax/functions.php" ?>
<?php
if (!isset($_SESSION['userkey']) || !isset($_SESSION['role'])) {
  header("Location: ../login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Summernote</title>

  <!-- texxt editor -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="../js/summernote.js"></script>
  <link rel="stylesheet" href="../css/style.css">
  <!-- ./texxt editor -->

</head>

<body>

  <div class="spin_overlay">
    <div class="loader"></div>
  </div>

  <?php if (isset($_GET['id']) && !empty($_GET['id'])) { ?>
    <div class="container write_a_blog">

      <?php
      $post_id = sanitize($_GET['id']);
      $query = mysqli_query($connection, "SELECT * FROM drafts WHERE id='$post_id' LIMIT 1");
      $row = mysqli_fetch_assoc($query);
      ?>

      <div class="row back_to_site">
        <div class="col-md-12">
          <a href="index.php" class="btn btn-primary">&larr; Back To Dashboard</a>
        </div>
      </div>

      <form name="a_b" id="a_b" onsubmit="event.preventDefault();A_B();" class="a_b" method="POST" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md-6 _mb">
            <label for="blog_seo_words">SEO Keywords <small>(seperated by ,)</small></label>
            <input type="text" name="blog_seo_words" id="blog_seo_words" class="form-control" placeholder="pakistan,danger,etc..." value="<?php echo $row['post_keywords'] ?>">
          </div>
          <div class="col-md-6 _mb">
            <label for="blog_meta_desc">Blog Meta Description</label>
            <input type="text" name="blog_meta_desc" id="blog_meta_desc" class="form-control" placeholder="meta description" value="<?php echo $row['post_meta_descp'] ?>">
          </div>
          <div class="col-md-6 _mb">
            <label for="blog_title">Blog Title</label>
            <input type="text" name="blog_title" id="blog_title" class="form-control" placeholder="Blog Title" value="<?php echo $row['post_title'] ?>">
          </div>
          <div class="col-md-6 _mb">
            <label for="blog_tagline">Blog Tag Line</label>
            <input type="text" name="blog_tagline" id="blog_tagline" class="form-control" placeholder="Blog Tag Line" value="<?php echo $row['post_tag'] ?>">
          </div>
          <div class="col-md-6 _mb">
            <label for="blog_category">Blog Category</label>
            <select name="blog_category" class="form-control" id="blog_category">
              <option value="" selected>Select Blog Category</option>
              <?php G_Cat() ?>
            </select>
          </div>
          <div class="col-md-6 _mb">
            <label for="blog_feature_image">Blog Feature Image</label>
            <small>(<?php echo $row["post_feature_image"] ?>)</small>
            <input type="file" name="blog_feature_image" id="blog_feature_image" class="form-control">
          </div>

          <div class="col-md-6 _mb">
            <label for="comment_status">Allow Comments On this Blog?</label>
            <div style="padding-left: 10px;">
              <input class="form-check-input" type="radio" name="comment_status" id="inlineRadio1" value="open" <?php echo ($row['comment_status'] == 'open') ? 'checked' : '' ?>>
              <label class="form-check-label" for="inlineRadio1">Yes</label>
              <input class="form-check-input" type="radio" name="comment_status" id="inlineRadio2" value="close" style="margin-left: 10px;" <?php echo ($row['comment_status'] == 'close') ? 'checked' : '' ?>>
              <input type="hidden" name="draft_id" id="draft_id" value="<?php echo $row['id'] ?>">
              <label class="form-check-label" for="inlineRadio2">No</label>
            </div>
          </div>

        </div>

        <div class="row">
          <div class="col-md-12">
            <label for="summernote">Blog Body</label>
            <textarea id="summernote"></textarea>
          </div>
        </div>

        <script>
          let value = <?php echo json_encode($row['post_content']) ?>;
          $("#summernote").summernote('code', value);
        </script>

        <button type="submit" class="_b_b btn btn-success">Publish Blog</button>
        <button type="button" id="draft" onclick="S_D()" class="_b_b btn btn-primary">Update Draft</button>
      </form>

      <div class="row result">
        <div class="col-md-12">
          <h1 class="_heading">Preview</h1>
          <div class="res" style="margin-bottom: 100px;"></div>
        </div>
      </div>

    </div>

  <?php } else {
    header("Location: index.php");
  } ?>

  <script src="../js/app.js"></script>
  <script>
    $(document).ready(function() {

      $('#summernote').summernote({
        height: 300,
        callbacks: {
          onImageUpload: function(files, editor, welEditable) {
            sendFile(files[0], editor, welEditable);
          },
          onMediaDelete: function(target) {
            deleteFile(target[0].src);
          },
        },
        // 'code': value
      });

      function deleteFile(src) {
        $.ajax({
          data: {
            src: src
          },
          type: "POST",
          url: "../ajax/d_img.php",
          cache: false,
          success: function(resp) {}
        });
      }

      function sendFile(file, editor, welEditable) {
        var data = new FormData();
        data.append("file", file);
        $.ajax({
          url: "../ajax/u_img.php",
          data: data,
          cache: false,
          contentType: false,
          processData: false,
          type: 'POST',
          success: function(url) {
            if (url.includes('0_e_0')) {
              showAlert(url.replace('0_e_0', ''));
            } else {
              var alt = prompt("Enter Alt text for this image");
              while (alt == null || alt == "") {
                alt = prompt("Enter Alt text for this image");
              }
              if (alt != null) {
                var image = $('<img>').attr({
                  'src': url,
                  'alt': alt,
                  'title': alt
                });
                $('#summernote').summernote("insertNode", image[0]);
              }
            }
          },
          error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus + " " + errorThrown);
          }
        });
      }

      $(".note-editable").on("input", function() {
        $(".res").html($("#summernote").val());
      });
    });


    function A_B() {
      var formData = new FormData();
      formData.append('body', $(".note-editable").html());
      formData.append('draft_id', $(".draft_id").val());
      formData.append('blog_seo_words', $("#blog_seo_words").val());
      formData.append('blog_meta_desc', $("#blog_meta_desc").val());
      formData.append('blog_title', $("#blog_title").val());
      formData.append('blog_tagline', $("#blog_tagline").val());
      formData.append('blog_category', $("#blog_category").val());
      formData.append('comment_status', $("input[name='comment_status']:checked").val());
      formData.append('blog_feature_image', document.getElementById('blog_feature_image').files[0]);

      $.ajax({
        type: "post",
        url: "../ajax/ab.php",
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function() {
          $(".spin_overlay").css("display", "flex");
        },
        success: function(response) {
          if (response.includes('0_e_0')) {
            showAlert(response.replace('0_e_0', ''));
            $(".spin_overlay").css("display", "none");
          } else {
            showAlert(response);
            $(".spin_overlay").css("display", "none");
            setTimeout(() => {
              window.location.href = "view-your-drafts.php";
            }, 3000);
          }
        }
      });
    };

    function S_D() {
      var formData = new FormData();
      formData.append('body', $(".note-editable").html());
      formData.append('blog_seo_words', $("#blog_seo_words").val());
      formData.append('blog_meta_desc', $("#blog_meta_desc").val());
      formData.append('blog_title', $("#blog_title").val());
      formData.append('blog_tagline', $("#blog_tagline").val());
      formData.append('blog_category', $("#blog_category").val());
      formData.append('comment_status', $("input[name='comment_status']:checked").val());
      formData.append('blog_feature_image', document.getElementById('blog_feature_image').files[0]);

      $.ajax({
        type: "post",
        url: "../ajax/draft.php",
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function() {
          $(".spin_overlay").css("display", "flex");
        },
        success: function(response) {
          if (response.includes('0_e_0')) {
            showAlert(response.replace('0_e_0', ''));
            $(".spin_overlay").css("display", "none");
          } else {
            showAlert(response);
            $(".spin_overlay").css("display", "none");
            setTimeout(() => {
              window.location.reload();
            }, 3000);
          }
        }
      });
    };
  </script>
</body>

</html>