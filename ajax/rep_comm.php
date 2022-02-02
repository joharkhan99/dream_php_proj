<?php include "functions.php" ?>
<?php
if (($_SERVER['REQUEST_METHOD'] == 'POST') && !empty($_COOKIE["_uacct_"]) && isset($_COOKIE["_uacct_"])) {
  if (userKeyExists($_COOKIE["_uacct_"])) {
    if (!IsEmptyString($_POST['comment_text'])   && !IsEmptyString($_POST['p_id']) && !IsEmptyString($_POST['c_i_u-d'])) {

      $comment_text = sanitize($_POST['comment_text']);
      $p_id = sanitize($_POST['p_id']);
      $comment_id = sanitize($_POST['c_i_u-d']);
      $author = $_COOKIE["_uacct_"];

      if (AddReply($author, $comment_id, $p_id, $comment_text)) {
        echo "Reply Added";
      } else {
        echo "Oops! Something went wrong0";
      }

      // -------------
    } else {
      echo "Please provide comment/message0";
    }

    // ---------cookie
  } else {
    echo "Oops! Something went wrong0";
  }
}
