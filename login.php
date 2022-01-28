<?php session_start(); ?>
<!-- head -->
<?php include "sections/header.php" ?>
<!-- head -->

<?php
// if (isset($_SESSION['role']) && isset($_SESSION['userkey'])) {
//   header("Location: dashboard/");
// }
?>

<main>

  <?php include "sections/nav.php" ?>

  <!-- content -->
  <div class="h-100 d-flex justify-content-center align-items-center login mt-5">
    <div>
      <div class="form">
        <h1>Sign In</h1>
        <form onsubmit="event.preventDefault();Login()" method="POST" id="login_form">
          <div class="input">
            <input type="text" name="email" id="email" placeholder="Email" autocomplete="off">
          </div>
          <div class="input">
            <input type="password" name="password" id="password" placeholder="Password">
            <div class="hide_show" onclick="hideShowPass(this,'password')">Show</div>
          </div>
          <div class="input">
            <button type="submit">Sign In</button>
            <span>Don't have an account? <a href="signup.php">Sign Up</a></span>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- footer -->
  <?php include "sections/footer.php" ?>
  <!-- ./footer -->

</main>

<!-- scripts -->
<?php include "sections/scripts.php" ?>
<!-- scripts -->

</body>

</html>