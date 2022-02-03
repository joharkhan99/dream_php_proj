<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js/bootstrap.js?v=<?php echo time() ?>"></script>
<script src="js/app.js?v=<?php echo time() ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/lozad/dist/lozad.min.js"></script>
<script>
  const el = document.querySelector('img');
  const observer = lozad(el);
  observer.observe();
</script>