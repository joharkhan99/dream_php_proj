<!-- head -->
<?php include "sections/header.php" ?>
<!-- head -->

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
          </div>
          <div class="input">
            <button type="submit">Sign In</button>
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