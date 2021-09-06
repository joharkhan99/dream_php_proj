<?php include "functions.php" ?>
<?php
if (!IsEmptyString($_POST['reply'])) {

  if (isset($_COOKIE['uuid'])) {

    if (!IsEmptyString($_POST['c_i_u-d']) && !IsEmptyString($_POST['comment_text']) && !IsEmptyString($_POST['p_id']) && !empty($_COOKIE['uuid'])) {

      $user_unique_id = sanitize($_COOKIE['uuid']);
      $comment_text = sanitize($_POST['comment_text']);
      $p_id = sanitize($_POST['p_id']);
      $comment_id = sanitize($_POST['c_i_u-d']);

      $userinfo = new GetSavedUserReplyInfo($user_unique_id);
      $userinfo2 = new GetSavedUserCommentInfo($user_unique_id);

      // 
      $name = $userinfo->name;
      $email = $userinfo->email;

      if (empty($name) || empty($email)) {
        $name = $userinfo2->name;
        $email = $userinfo2->email;
      }

      if (AddReply($comment_id, $name, $email, $p_id, $comment_text, $user_unique_id)) {
        echo "Reply Added";
      } else {
        echo "Oops! Something went wrong0";
      }

      // ------
    } else {
      echo "Oops! Something went wrong0";
    }

    // ==============
  } else {

    if (!IsEmptyString($_POST['comment_text']) && !IsEmptyString($_POST['name']) && !IsEmptyString($_POST['email'])  && !IsEmptyString($_POST['p_id']) && !IsEmptyString($_POST['c_i_u-d'])) {

      $comment_text = sanitize($_POST['comment_text']);
      $name = sanitize($_POST['name']);
      $email = sanitize($_POST['email']);
      $p_id = sanitize($_POST['p_id']);
      $comment_id = sanitize($_POST['c_i_u-d']);

      // -----if save on--------
      if (isset($_POST['save'])) {
        if ($_POST['save'] == 'on') {

          $save = sanitize($_POST['save']);
          $user_unique_id = generate_key($_POST['email']);
          setcookie("uuid", $user_unique_id, time() + 90 * 24 * 60 * 60, "/");
          if (AddReply($comment_id, $name, $email, $p_id, $comment_text, $user_unique_id)) {
            echo "Reply Added";
          } else {
            echo "Oops! Something went wrong0";
          }
        }
        // -----if save on--------
      } else {

        if (AddReply($comment_id, $name, $email, $p_id, $comment_text)) {
          echo "Reply Added";
        } else {
          echo "Oops! Something went wrong0";
        }
      }

      // -------------
    } else {
      echo "Please provide name, email and comment.0";
    }

    // ---------cookie
  }
} else {
  echo "Oops! Something went wrong0";
}
