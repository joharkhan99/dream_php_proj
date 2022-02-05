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

        <div class="row">

          <div class="col-md-8 mx-auto bg-white px-4 py-5 shadow">

            <div class="d-sm-flex align-items-center justify-content-between mb-4 border-bottom">
              <h1 class="h3 mb-0 text-gray-800">Profile</h1>
            </div>


            <form method="post" id="update_profile_form" onsubmit="event.preventDefault();U_P()">
              <div class="row">
                <div class="col-md-6 mb-2">
                  <label class="mb-0">Profile Bio</label>
                  <textarea name="profile_bio" class="form-control custom_input" id="profile_bio" cols="30" rows="10"><?php echo getuserinfo($_COOKIE['_uacct_'], 'user_description') ?></textarea>
                </div>
                <div class="col-md-6 mb-2">
                  <label class="mb-0">Profile Image</label>
                  <div class="my-auto text-center py-3">
                    <div class="img mx-auto" style="width: 150px;height: 150px;">
                      <img src="../users/<?php echo getuserinfo($_COOKIE['_uacct_'], 'profile_pic') ?>" id="imageResult" class="rounded-circle w-100 h-100" style="object-fit: cover;">
                      <input type='file' id="updated_profile_pic" name="profile_image" class="d-none" onchange="readURL(this)">
                    </div>
                    <button class="btn btn-sm btn-secondary mt-1" data-toggle="modal" type="button" data-target="#imageModal">Change</button>

                    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Choose a profile Image</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                          </div>
                          <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <a class="btn btn-primary text-white" type="button" onclick="document.getElementById('updated_profile_pic').click()">Choose Image</a>
                          </div>
                        </div>
                      </div>
                    </div>


                  </div>
                </div>
                <div class="col-md-6 mb-2">
                  <label class="mb-0">Profile Name</label>
                  <input type="text" class="form-control custom_input" name="profile_name" id="profile_name" value="<?php echo getuserinfo($_COOKIE['_uacct_'], 'name') ?>">
                </div>
              </div>
              <div class="row border-top mt-5">
                <div class="col-md-6 mb-2 mx-auto mt-3">
                  <button type="submit" class="btn btn-primary btn-block">Update Profile</button>
                </div>
              </div>
            </form>


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
<script>
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        document.querySelector("#imageResult").setAttribute('src', e.target.result);
      };
      reader.readAsDataURL(input.files[0]);
      $('#imageModal').modal('hide');
    }
  }

  (function() {
    document.getElementById("updated_profile_pic").onchange = function() {
      readURL(input);
    }
  });
  var input = document.getElementById('updated_profile_pic');

  input.addEventListener('change', showFileName);

  function showFileName(event) {
    var input = event.srcElement;
    var fileName = input.files[0].name;
  }
</script>

<?php include "includes/scripts.php" ?>