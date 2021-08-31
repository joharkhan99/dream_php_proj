<!-- head -->
<?php include "sections/header.php" ?>
<!-- head -->

<main>

  <?php include "sections/nav.php" ?>

  <?php
  // $query = "SELECT * FROM test";
  // $result = mysqli_query($connection, $query);

  // while ($row = mysqli_fetch_assoc($result)) {
  //   $t = str_replace('../', '', $row['test']);
  //   echo $t;
  // }
  ?>

  <div class="container-lg single_blog">

    <?php
    include "ajax/functions.php";

    if (isset($_GET['i'])) {

      $p_id = sanitize($_GET['i']);
      $query = mysqli_query($connection, "SELECT * FROM posts INNER JOIN categories ON posts.post_categoryID=categories.cat_id INNER JOIN users ON posts.post_author=users.userkey WHERE posts.id='$p_id'");
      $row = mysqli_fetch_assoc($query);
      print_r($row);
    ?>

      <div class="blog_category">
        <a href="javascript:void(0)">
          <div>Space</div>
        </a>
      </div>

      <div class="blog_heading">
        <h1>Astronauts Give Us a Delightful Look at What the Olympics Would Be Like in
          Space
        </h1>
        <h2 class="tagline">
          The unofficial Space Olympics featured four events: “lack-of-floor routine,” “no-handball,” “synchronized
          space swimming,” and “weightless sharpshooting.”
        </h2>
      </div>

      <div class="row body">

        <div class="col-md-9 blog_content">

          <div class="bio">
            <span class="author">By <a href="javascript:void(0)">Ammar Khan</a></span>
            <span class="date">7/19/21 9:01PM</span>
            <a class="comment_link" href="#comments_section">Comments (12)</a>
            <a href="javascript:void(0)" class="share_btn">
              <span class="share" title="Share"><i class="fas fa-share-alt"></i></span><span class="text">Share</span>
            </a>
          </div>

          <div class="main-content">
            <div class="row">
              <div class="col-md-12">
                <div class="feature-image">
                  <figure>
                    <img src="img/test.png" alt="">
                    <figcaption>Fig.1 - Trulli, Puglia, Italy.</figcaption>
                  </figure>
                </div>
              </div>
            </div>

            <div class="row body_content">
              <div class="col-md-12">
                <p>
                  Add “extreme heat” to the growing list of plagues facing this year’s Summer Olympics, an event I’m
                  <a href="javascript:void(0)">
                    starting
                  </a>
                  to suspect I would very much not enjoy participating in, even if they asked nicely.
                </p>
                <p>
                  According to the <a href="javascript:void(0)">Washington Post</a>, in addition to being derailed by a
                  global pandemic that forced a
                  full year’s postponement as well as a ban on all spectators, this year’s Summer Games are also set to
                  be roiled by devastating July temperatures in Tokyo that have some officials worried for the safety of
                  the competing athletes.
                </p>

                <p>
                  “The rainy season is over in Tokyo, and the hot summer has come!” Tokyo 2020 organizers declared
                  during a news conference on Sunday amid temperatures in the low 90s and air that the Post describes as
                  “so thick it felt as if you had to chew it before you could breathe it.”
                </p>
                <p>
                  Although the summer heat always poses a risk to athletes, who are competing at a level of exertion
                  that could put even the most physiological sound human in danger of heat stroke or illness, the Tokyo
                  Games are poised to become the hottest in more than 35 years of recorded temperatures, a circumstance
                  that we can be attributed at least in part to the creep of climate change and global warming.
                </p>

                <div class="related_story">
                  <div class="content">
                    <div class="box">
                      <div class="head">
                        <h4>Related Stories</h4>
                      </div>

                      <div class="body">
                        <ul>
                          <li>
                            <a href="javascript:void(0)">Astronauts Give Us a Delightful Look at What the Olympics
                              Would Be Like in Space</a>
                          </li>
                          <li>
                            <a href="javascript:void(0)">Astronauts Give Us a Delightful Look at What the Olympics
                              Would Be Like in Space</a>
                          </li>
                        </ul>
                      </div>

                    </div>
                  </div>
                </div>

                <p>
                  In a cruel twist of fate, the weather in Tokyo last year was unseasonably cool, owing largely to the
                  fact that the region’s rainy season <a href="">stretched longer</a> than usual. Those conditions still
                  would have posed challenges to athletes — as will this year’s typhoons, which are still projected to
                  take place right on schedule — but the cooler temperatures would have helped to offset some of the
                  more immediate physical concerns of overexertion and heat stroke.
                </p>
                <p>
                  In their efforts to prepare for the extreme temperatures, organizers have taken steps to accommodate
                  athletes that might suffer in the heat, including installing shade tents, portable air conditioners,
                  ice baths, coolers packed.
                </p>

              </div>
            </div>


          </div>

          <!-- comments -->
          <div class="comments_section" id="comments_section">
            <div class="container">
              <div class="row c_row_form">
                <div class="col-12">

                  <div class="head">
                    <h4>Comments</h4>
                  </div>

                  <div class="comments">
                    <div class="comments-details">
                      <span class="total-comments comments-sort">117 Comments</span>

                      <div class="dropdown">
                        <button class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                          Sort By
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                          <li><a class="dropdown-item" href="#">Action</a></li>
                          <li><a class="dropdown-item" href="#">Another action</a></li>
                        </ul>
                      </div>

                    </div>

                    <div class="comment-box">
                      <span class="commenter-pic">
                        <img src="img/test2.png" class="img-fluid">
                      </span>
                      <span class="commenter-name">
                        <span>Happy markuptag</span> <span class="comment-time">2 hours ago</span>
                      </span>
                      <p class="comment-txt more">Suspendisse massa enim, condimentum sit amet maximus quis, pulvinar
                        sit
                        amet ante. Fusce eleifend dui mi, blandit vehicula orci iaculis ac.</p>
                      <div class="comment-meta">
                        <button class="comment-like"><i class="far fa-thumbs-up"></i> 99</button>
                        <button class="comment-dislike"><i class="far fa-thumbs-down"></i>
                          149</button>
                        <button class="comment-reply" onclick="ToggleForm(this)"><i class="fa fa-reply-all" aria-hidden="true"></i>
                          Reply</button>
                      </div>
                    </div>

                    <div class="comment-box">
                      <span class="commenter-pic">
                        <img src="img/test4.png" class="img-fluid">
                      </span>
                      <span class="commenter-name">
                        <span>Happy markuptag</span> <span class="comment-time">2 hours ago</span>
                      </span>
                      <p class="comment-txt more">Suspendisse massa enim, condimentum sit amet maximus quis, pulvinar
                        sit
                        amet ante. Fusce eleifend dui mi, blandit vehicula orci iaculis ac.</p>
                      <div class="comment-meta">
                        <button class="comment-like"><i class="far fa-thumbs-up"></i> 99</button>
                        <button class="comment-dislike"><i class="far fa-thumbs-down"></i>
                          149</button>
                        <button class="comment-reply" onclick="ToggleForm(this)"><i class="fa fa-reply-all" aria-hidden="true"></i> Reply</button>
                      </div>

                      <div class="comment-box replied">
                        <span class="commenter-pic">
                          <img src="img/test.png" class="img-fluid">
                        </span>
                        <span class="commenter-name">
                          <span>Happy markuptag</span> <span class="comment-time">2 hours ago</span>
                        </span>
                        <p class="comment-txt more">Suspendisse massa enim, condimentum sit amet maximus quis, pulvinar
                          sit amet ante. Fusce eleifend dui mi, blandit vehicula orci iaculis ac.</p>
                      </div>

                      <div class="comment-box replied">
                        <span class="commenter-pic">
                          <img src="img/test.png" class="img-fluid">
                        </span>
                        <span class="commenter-name">
                          <span>Happy markuptag</span> <span class="comment-time">2 hours ago</span>
                        </span>
                        <p class="comment-txt more">Suspendisse massa enim, condimentum sit amet maximus quis, pulvinar
                          sit amet ante. Fusce eleifend dui mi, blandit vehicula orci iaculis ac.</p>
                      </div>


                    </div>

                  </div>

                </div>

                <div class="comment_form">
                  <div class="row">
                    <div class="col-md-12">
                      <h3>LEAVE A REPLY</h3>
                      <button class="cancel_reply" onclick="CancelReply(this)">Cancel Reply</button>

                      <form>
                        <div class="mb-3">
                          <textarea name="comment_text" id="comment_text" cols="30" rows="10" class="form-control" placeholder="Comment: *"></textarea>
                        </div>
                        <div class="mb-3">
                          <input type="name" class="form-control" placeholder="Name: *">
                        </div>
                        <div class="mb-3">
                          <input type="email" class="form-control" placeholder="Email: *">
                        </div>
                        <div class="form-check mb-3">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
                          <label class="form-check-label" for="flexCheckDefault">
                            Save my name and email in this browser for the next time I comment.
                          </label>
                        </div>

                        <button type="submit" class="btn btn-primary px-lg-5">Post Comment</button>
                      </form>

                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
          <!-- ./comments -->

        </div>

        <div class="col-md-3 recommended">
          <div class="head">
            <h4>Recommended Blogs</h4>
          </div>

          <div class="row blogs">

            <div class="col-md-12">
              <div class="row">
                <div class="col-md-5">
                  <div class="blog_img">
                    <a href="javascript:void(0)">
                      <img src="img/test4.png" class="img-fluid" alt="">
                    </a>
                  </div>
                </div>
                <div class="col-md-7">
                  <div class="category">
                    <a href="javascript:void(0)">Internet</a>
                  </div>
                  <div class="blog-link">
                    <a href="javascript:void(0)" class="title">
                      <h4>
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit
                      </h4>
                    </a>
                  </div>
                  <div class="date">7/19/21 9:01PM</div>
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <div class="row">
                <div class="col-md-5">
                  <div class="blog_img">
                    <a href="javascript:void(0)">
                      <img src="img/test2.png" class="img-fluid" alt="">
                    </a>
                  </div>
                </div>
                <div class="col-md-7">
                  <div class="category">
                    <a href="javascript:void(0)">Internet</a>
                  </div>
                  <div class="blog-link">
                    <a href="javascript:void(0)" class="title">
                      <h4>
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit
                      </h4>
                    </a>
                  </div>
                  <div class="date">7/19/21 9:01PM</div>
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <div class="row">
                <div class="col-md-5">
                  <div class="blog_img">
                    <a href="javascript:void(0)">
                      <img src="img/test3.png" class="img-fluid" alt="">
                    </a>
                  </div>
                </div>
                <div class="col-md-7">
                  <div class="category">
                    <a href="javascript:void(0)">Internet</a>
                  </div>
                  <div class="blog-link">
                    <a href="javascript:void(0)" class="title">
                      <h4>
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit
                      </h4>
                    </a>
                  </div>
                  <div class="date">7/19/21 9:01PM</div>
                </div>
              </div>
            </div>


          </div>


          <div class=".col-md-3 categories">
            <div class="head">
              <h4>Categories</h4>
            </div>

            <ul>
              <li>
                <a href="javascript:void(0)">
                  <span class="name">HTML and CSS</span>
                  <span class="count">90</span>
                </a>
              </li>
              <li>
                <a href="javascript:void(0)">
                  <span class="name">HTML and CSS</span>
                  <span class="count">90</span>
                </a>
              </li>
            </ul>
          </div>

          <div class=".col-md-3 recent_posts">
            <div class="head">
              <h4>Recent Posts</h4>
            </div>

            <ul>
              <li>
                <a href="javascript:void(0)">Astronauts Give Us a Delightful Look </a>
              </li>
              <li>
                <a href="javascript:void(0)">Astronauts Give Us a Delightful Look </a>
              </li>
              <li>
                <a href="javascript:void(0)">Astronauts Give Us a Delightful Look </a>
              </li>
            </ul>

          </div>

        </div>

      </div>

    <?php
    } else {
      echo "<h3 style='text-align: center;
      width: 100%;
      height: 100%;
      margin: auto;
      color: #929698;margin-top: 73px;'>Post Not Found!</h3>";
    }
    ?>

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