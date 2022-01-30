<?php include "includes/header.php" ?>
<div id="wrapper">

  <?php include "includes/sidebar.php" ?>

  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

      <?php include "includes/topbar.php" ?>


      <!-- Begin Page Content -->
      <div class="container-fluid publish_page">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4 border-bottom py-3">
          <h1 class="h3 mb-0 text-gray-800">Your Published Articles</h1>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table table-hover bg-white shadow rounded">
                <thead class="thead-primary ">
                  <tr>
                    <th colspan="9">
                      <input type="text" class="form-control w-25 custom_input" id="search-publish" placeholder="Search...">
                    </th>
                  </tr>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Publish Date</th>
                    <th scope="col">Feature Image</th>
                    <th scope="col">Category</th>
                    <th scope="col">Tags</th>
                    <th scope="col">Views</th>
                    <th scope="col">Comments</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  <?php getPublishArticles() ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
      <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->


    <?php include "includes/footer.php" ?>
  </div>
  <!-- End of Content Wrapper -->

</div>


<?php include "includes/scripts.php" ?>

<script>
  $("#search-publish").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $(".publish_page table tbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
</script>