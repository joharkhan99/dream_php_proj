<!-- head -->
<?php include "sections/header.php" ?>
<!-- head -->
<!-- db -->
<?php include "ajax/functions.php" ?>
<!-- ./db -->

<main>

  <?php include "sections/nav.php" ?>

  <div class="container-lg categories">

    <?php
    $tag = "";
    if (isset($_GET['tag'])) {
      $tag = categoryURLUnslug(sanitize($_GET['tag']));
    } else {
      $tag = "news";
    }
    ?>

    <div class="row">
      <div class="col-md-12 head">
        <h1>#<?php echo ucwords($tag) ?></h1>
      </div>
    </div>

    <div class="row cat_card">

      <div class="col-md-9">

        <div class="row">
          <?php getTagsPosts($tag); ?>
        </div>

      </div>

      <?php include "sections/sidebar.php" ?>

    </div>


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

</body>

</html>