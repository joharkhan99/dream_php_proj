<div class="col-md-3 recommended">
  <div class="head">
    <h4>Recommended Articles</h4>
  </div>

  <div class="row blogs">
    <?php getRecommendedPosts(); ?>
  </div>


  <div class=".col-md-3 categories">
    <div class="head">
      <h4>🔥 Categories</h4>
    </div>
    <ul>
      <?php getSidebarCategories() ?>
    </ul>
  </div>

  <div class=".col-md-3 recent_posts">
    <div class="head">
      <h4>Recent Posts</h4>
    </div>
    <ul>
      <?php getSidebarRecent() ?>
    </ul>

  </div>

  <div class=".col-md-3 recent_comments">
    <div class="head">
      <h4>Recent Comments</h4>
    </div>

    <ul>
      <?php getSidebarComments() ?>
    </ul>

  </div>

</div>