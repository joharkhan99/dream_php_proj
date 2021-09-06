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
        <h1>Sign Up</h1>
        <form onsubmit="event.preventDefault();Signup()" method="POST" id="signup_form">
          <div class="input">
            <input type="text" name="email" id="email" placeholder="Email" autocomplete="off">
          </div>
          <div class="input">
            <input type="password" name="password" id="password" placeholder="Password" onkeyup="CheckPass(this.value)">
            <small class="help-block" id="password-text"></small>
          </div>
          <div class="input">
            <button type="submit">Sign In</button>
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

</body>

</html>