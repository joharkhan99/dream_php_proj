<!-- head -->
<?php include "sections/header.php" ?>
<!-- head -->
<!-- db -->
<?php include "ajax/db.php" ?>
<!-- ./db -->

<main>

  <?php include "sections/nav.php" ?>


  <!-- form -->
  <div class="h-100 d-flex justify-content-center align-items-center login mt-5">
    <div>
      <div class="form">
        <h1>Register</h1>
        <form onsubmit="event.preventDefault();Signup()" method="POST" id="signup_form">

          <div class="input">
            <div class="image-area">
              <input id="upload" type="file" name="image" onchange="readURL(this);" class="form-control border-0" title="Choose Profile Image">
              <img id="imageResult" src="profiles/default.png" alt="" class="img-fluid rounded shadow-sm mx-auto d-block">
            </div>
          </div>

          <div class="input">
            <input type="text" name="full_name" id="full_name" placeholder="Enter full name" autocomplete="off">
          </div>

          <div class="input">
            <textarea name="about" id="about" cols="30" rows="10" placeholder="Tell us something about yourself"></textarea>
          </div>

          <div class="input">
            <input type="email" name="email" id="email" placeholder="Email" autocomplete="off">
          </div>

          <div class="input">
            <input type="password" name="password" id="password" placeholder="Password">
          </div>

          <div class="input">
            <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm password">
          </div>

          <div class="input">
            <button type="submit">Sign Up</button>
            <span>Already have an account? <a href="login.php">Login</a></span>
          </div>

        </form>
      </div>
    </div>
  </div>
  <!-- ./form -->



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
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        document.querySelector(".image-area").style.display = "block";
        document.querySelector("#imageResult").setAttribute('src', e.target.result);
      };
      reader.readAsDataURL(input.files[0]);
    }
  }

  (function() {
    document.getElementById("upload").onchange = function() {

      readURL(input);
    }
  });
  var input = document.getElementById('upload');

  input.addEventListener('change', showFileName);

  function showFileName(event) {
    var input = event.srcElement;
    var fileName = input.files[0].name;
  }
</script>

</body>

</html>