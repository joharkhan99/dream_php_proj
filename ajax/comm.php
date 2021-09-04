<?php include "functions.php" ?>
<?php
if (isset($_POST['type']) && !empty($_POST['type'])) {

  $type = sanitize($_POST['type']);
  $p_id = sanitize($_POST['p_id']);
  $output = "";
  $order_by = "";

  if ($type == "old") {
    $order_by = "ASC";
  } elseif ($type == "recent") {
    $order_by = "DESC";
  } else {
    $order_by = "";
  }

  if (empty($order_by)) {
    $comment_query = mysqli_query($connection, "SELECT * FROM comments WHERE post_id='$p_id'");
  } else {
    $comment_query = mysqli_query($connection, "SELECT * FROM comments WHERE post_id='$p_id' ORDER BY comment_date $order_by");
  }

  if (mysqli_num_rows($comment_query) > 0) {
    $output .= '
  <div class="comments">
  <div class="comments-details">
    <span class="total-comments comments-sort">' . mysqli_num_rows($comment_query) . ' Comment(s)</span>
    <div class="dropdown">
      <button class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
        Sort By
      </button>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
        <li>
          <button class="sort_btns" type="button" value="recent" onclick="COMM(\'recent\', ' . $p_id . ')">Recent Comments</button>
        </li>
        <li>
          <button class="sort_btns" type="button" value="old" onclick="COMM(\'old\', ' . $p_id . ')">Oldest Comments</button>
        </li>
      </ul>
    </div>
  </div>  
  ';
    while ($comments = mysqli_fetch_assoc($comment_query)) {
      $comm_image = explode("../", $comments['userimg'])[1];
      $output .= '
    <div class="comment-box">
    <span class="commenter-pic">
      <img src="' . $comm_image . '" class="img-fluid">
    </span>
    <span class="commenter-name">
      <span class="username">' . ucwords($comments['username']) . '</span> <span class="comment-time">' . timeAgo($comments['comment_date']) . '</span>
    </span>
    <p class="comment-txt more">' . $comments['text'] . '</p>
    <input type="hidden" name="c_id" id="c_id" value="' . $comments['comment_id'] . '">
    <div class="comment-meta">
      <button class="comment-reply" onclick="ToggleForm(this)"><i class="fa fa-reply-all" aria-hidden="true"></i>
        Reply</button>
    </div>';

      $reply_query = mysqli_query($connection, "SELECT * FROM comment_replies WHERE comment_id=" . $comments['comment_id'] . " AND post_id=" . $p_id . "");
      while ($replies = mysqli_fetch_assoc($reply_query)) {
        $reply_image = explode("../", $replies['userimg'])[1];
        $output .= '
      <div class="comment-box replied">
        <span class="commenter-pic">
          <img src="' . $reply_image . '" class="img-fluid">
        </span>
        <span class="commenter-name">
          <span>' . ucwords($replies['username']) . '</span> <span class="comment-time">' . timeAgo($replies['reply_date']) . '</span>
        </span>
        <p class="comment-txt more">' . $replies['text'] . '</p>
      </div>
      ';
      }

      $output .= "</div>";
    }

    echo $output;
  } else {
    echo "<h6 style='text-align: center;
      margin-top: 60px;
      margin-bottom: 70px;
      font-weight: 800;
      color: #8694a9;'>No Comments Yet</h6>";
  }
} else {
  echo "<h6 style='text-align: center;
  margin-top: 60px;
  margin-bottom: 70px;
  font-weight: 800;
  color: #8694a9;'>No Comments Yet</h6>";
}
