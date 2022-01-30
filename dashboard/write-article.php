<?php include "includes/header.php" ?>
<style>
  body {
    color: black;
  }
</style>
<div id="wrapper">

  <?php include "includes/sidebar.php" ?>

  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

      <?php include "includes/topbar.php" ?>


      <!-- Begin Page Content -->
      <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4 border-bottom py-3">
          <h1 class="h3 mb-0 text-gray-800">Write An Article</h1>
        </div>

        <div class="row">
          <div class="col-md-12">
            <form method="post" id="add_form" onsubmit="event.preventDefault();A_B();">

              <div class="row mb-4">
                <div class="col-md-6 mt-3">
                  <label>Article Title<i class="align-middle fas fa-info-circle help-tool ml-3 text-muted" data-toggle="tooltip" data-placement="top" title="subject of the article; whatever the topic of the article is."></i></label>
                  <input type="text" class="form-control custom_input" name="article_title" id="article-title" placeholder="Enter article title">
                </div>
                <div class="col-md-6 mt-3">

                  <div class="row">
                    <div class="col-md-6">
                      <label>Article Feature Image<i class="align-middle fas fa-info-circle help-tool ml-3 text-muted" data-toggle="tooltip" data-placement="top" title="Featured image represent the contents, mood, or theme of a post or article. Usually the big picture that you see at the top of an article/post/page."></i></label>
                      <button class="btn btn-block btn-primary" type="button" onclick="document.getElementById('article_file').click()">Choose Image</button>
                      <input type='file' id="article_file" class="d-none" onchange="readURL(this)">
                    </div>
                    <div class="col-md-6">
                      <div class="feat_img_cont">
                        <img src="" id="imageResult" alt="">
                      </div>
                    </div>
                  </div>

                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mt-3">
                  <label>Article Tags <small>(seperated by <b>,</b>)</small><i class="align-middle fas fa-info-circle help-tool ml-3 text-muted" data-toggle="tooltip" data-placement="top" title="Tags help people identify what an article's about and present better results to your users."></i></label>
                  <div class="article-tags" id="article-tags">
                    <input name="tag" id="tag" class="form-control custom_input" placeholder="add atleast 3 tags" />
                  </div>
                </div>
                <div class="col-md-6 mt-3">
                  <label>Article Category<i class="align-middle fas fa-info-circle help-tool ml-3 text-muted" data-toggle="tooltip" data-placement="top" title="Categories organize site and allow readers to find the information they want. Like news, sports or food, etc"></i></label>
                  <div class="form-row">
                    <div class="form-group col-md-5">
                      <select class="form-select form-control" name="article-category-select" id="article-category-select">
                        <option selected value="">Choose from list</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                      </select>
                    </div>
                    <div class="form-group col-md-2 text-center badge badge-light">or</div>
                    <div class="form-group col-md-5">
                      <input type="text" class="form-control custom_input add_cat d-inline-block w-80" name="article-category-input" id="article-category-input" placeholder="add new Category">
                      <i class="align-middle fas fa-info-circle help-tool d-inline text-muted" data-toggle="tooltip" data-placement="top" title="Add new category only if it's not available in the list."></i>
                    </div>
                  </div>

                </div>
              </div>

              <div class="row mt-5">
                <div class="col-md-12">
                  <label class="mb-0">Article Body/Content<i class="align-middle fas fa-info-circle help-tool ml-3 text-muted" data-toggle="tooltip" data-placement="top" title="The main body of the article is where the writer presents the central idea in greater detail."></i></label>
                  <small class="text-muted d-block mb-3">click <i class=" fas fa-expand-arrows-alt"></i> and then write (recommended but not necessary)</small>
                  <textarea id="summernote" name="editordata"></textarea>
                </div>
              </div>

              <div class="row mt-4 border-top py-4">
                <div class="col-md-3 mt-2">
                  <button type="submit" class="form_btn btn btn-block btn-success py-2">Publish Article<i class="align-middle fas fa-info-circle help-tool ml-3 text-light" data-toggle="tooltip" data-placement="top" title="A Publish Article means it is launched on site and can be seen or read by people and is added to published articles."></i></button>
                </div>
                <div class="col-md-3 mt-2">
                  <button type="button" onclick="S_D();" class="form_btn draftbtn btn btn-block btn-outline-dark py-2">Save Article to Draft<i class="align-middle fas fa-info-circle help-tool ml-3 text-muted" data-toggle="tooltip" data-placement="top" title="A Draft Article is simply an unpublished article and is added to drafts articles."></i></button>
                </div>
              </div>

            </form>
          </div>
        </div>

      </div>
      <!-- /.container-fluid -->

      <script>
        function readURL(input) {
          if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
              document.querySelector("#imageResult").setAttribute('src', e.target.result);
              document.querySelector("#imageResult").setAttribute('alt', "Article Feature Image");
              document.querySelector("#imageResult").classList.add('w-100', 'h-100');
            };
            reader.readAsDataURL(input.files[0]);
          }
        }

        (function() {
          document.getElementById("article_file").onchange = function() {
            readURL(input);
          }
        });
        var input = document.getElementById('article_file');

        input.addEventListener('change', showFileName);

        function showFileName(event) {
          var input = event.srcElement;
          var fileName = input.files[0].name;
        }
      </script>

    </div>
    <!-- End of Main Content -->


    <?php include "includes/footer.php" ?>
  </div>
  <!-- End of Content Wrapper -->

</div>


<?php include "includes/scripts.php" ?>

<script>
  $(function() {
    $('[data-toggle="tooltip"]').tooltip()
  });
</script>