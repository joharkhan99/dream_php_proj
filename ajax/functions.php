<?php session_start(); ?>
<?php include "db.php"; ?>
<?php
function sanitize($str)
{
  global $connection;

  if (empty($str)) {
    return $str;
  } else {
    $str = mysqli_real_escape_string($connection, trim(stripslashes(htmlentities(strip_tags($str), ENT_QUOTES, "UTF-8"))));
    return $str;
  }
}

function emailExists($email)
{
  global $connection;
  if ($stmt = $connection->prepare('SELECT email FROM users WHERE email = ?')) {
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
      return true;
    } else {
      return false;
    }
    $stmt->close();
  }
}

function userKeyExists($key)
{
  global $connection;
  if ($stmt = $connection->prepare('SELECT userkey FROM users WHERE userkey = ?')) {
    $stmt->bind_param('s', $key);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
      return true;
    } else {
      return false;
    }
    $stmt->close();
  }
}

function IsEmptyString($str)
{
  $str = sanitize($str);
  if (!isset($str) || empty($str)) {
    return true;
  } else {
    return false;
  }
}

function generate_key($email)
{
  if (!empty($email)) {

    $key = md5(uniqid($email, true));
    return $key;
  }
}

function GetUserRole($userkey)
{
  global $connection;
  $userkey = sanitize($userkey);
  $query = "SELECT roles.role FROM user_roles INNER JOIN roles ON roles.id=user_roles.roleId WHERE user_roles.userkey='$userkey'";
  $row = mysqli_query($connection, $query);

  return mysqli_fetch_assoc($row)['role'];
}

function MakeUserRole($userkey)
{
  global $connection;
  $userkey = sanitize($userkey);
  $query = "INSERT INTO user_roles(userkey,roleId) VALUES('$userkey',2)";
  $result = mysqli_query($connection, $query);
  if (!$result) {
    return false;
  } else {
    return true;
  }
}

function loginUser($email, $password)
{
  global $connection;
  if (!IsEmptyString($email) && !IsEmptyString($password)) {

    $email = sanitize($email);
    $password = sanitize($password);

    if (!emailExists($email)) {
      return false;
    } else {

      $stmt = $connection->prepare('SELECT userkey,email,password FROM users WHERE email = ?');
      $stmt->bind_param('s', $email);
      $stmt->execute();
      $stmt->store_result();

      $stmt->bind_result($userkey, $dbemail, $dbpassword);
      $stmt->fetch();
      if (password_verify($password, $dbpassword) && $email == $dbemail) {
        setcookie("_uacct_", $userkey, time() + 1 * 30 * 24 * 3600, "/");
        return true;
      } else {
        return false;
      }

      $stmt->close();
    }

    // 
  } else {
    return false;
  }
}

function AddUser($name, $email, $password, $about, $image)
{
  global $connection;
  if (!IsEmptyString($name) && !IsEmptyString($email) && !IsEmptyString($password) && !IsEmptyString($about) && !IsEmptyString($image)) {

    $name = sanitize($name);
    $email = sanitize($email);
    $password = sanitize($password);
    $about = sanitize($about);
    $image = sanitize($image);

    if (emailExists($email)) {
      return false;
    } else {

      if (!empty($email) && !empty($password)) {
        $userkey = generate_key($email);
        $hashedpassword = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);

        $stmt = $connection->prepare("INSERT INTO users(userkey, name, email,password,profile_pic,user_description) VALUES (?,?,?,?,?,?)");
        $stmt->bind_param("ssssss", $userkey, $name, $email, $hashedpassword, $image, $about);

        if ($stmt->execute()) {
          setcookie("_uacct_", $userkey, time() + 1 * 30 * 24 * 3600, "/");
          return true;
        } else {
          return false;
        }

        $stmt->close();
      }
    }
  } else {
    return false;
  }
}

function a_c($catg)
{
  global $connection;

  $query = "INSERT INTO categories(cat_name) VALUES('$catg')";
  $result = mysqli_query($connection, $query);
  if (!$result) {
    return false;
  } else {
    return true;
  }
}

function G_Cat()
{
  global $connection;
  $output = "";
  $query = "SELECT * FROM categories";
  $result = mysqli_query($connection, $query);
  while ($row = mysqli_fetch_assoc($result)) {
    $output .= '<option value="' . $row['cat_id'] . '">' . $row['cat_name'] . '</option>';
  }
  echo $output;
}

function AddArticle($article_title, $article_tags, $image, $article_category, $article_body)
{
  global $connection;
  if (!IsEmptyString($article_title) && !IsEmptyString($article_tags) && !IsEmptyString($image) && !IsEmptyString($article_category) && !IsEmptyString($article_body)) {
    $author_key = $_COOKIE['_uacct_'];
    if (!userKeyExists($author_key)) {
      return false;
    } else {
      $catg_id = getPostCategoryID($article_category);
      $stmt = $connection->prepare("INSERT INTO posts(post_author, post_content, post_title, post_categoryID, post_tags, post_feature_image) VALUES (?,?,?,?,?,?)");
      $stmt->bind_param("ssssss", $author_key, $article_body, $article_title, $catg_id, $article_tags, $image);
      if ($stmt->execute()) {
        return true;
      } else {
        return false;
      }
      $stmt->close();
    }
  } else {
    return false;
  }
}

function getPostCategoryID($article_category)
{
  $id = "";
  $article_category = strtolower($article_category);
  if (postCategoryExists($article_category)) {
    $id = getcatid($article_category);
  } else {
    if (addcat($article_category)) {
      $id = getcatid($article_category);
    }
  }

  return $id;
}

function addcat($article_category)
{
  global $connection;
  $stmt = $connection->prepare('INSERT INTO categories(cat_name) VALUES(?)');
  $stmt->bind_param('s', $article_category);
  if ($stmt->execute()) {
    return true;
  } else {
    return false;
  }
}

function getcatid($article_category)
{
  global $connection;
  $stmt = $connection->prepare('SELECT cat_id FROM categories WHERE cat_name = ?');
  $stmt->bind_param('s', $article_category);
  $stmt->execute();
  $result = $stmt->get_result();
  $id = $result->fetch_assoc()['cat_id'];
  return $id;
}

function getcatname($catid)
{
  global $connection;
  $stmt = $connection->prepare('SELECT cat_name FROM categories WHERE cat_id = ?');
  $stmt->bind_param('s', $catid);
  $stmt->execute();
  $result = $stmt->get_result();
  $id = $result->fetch_assoc()['cat_name'];
  return $id;
}

function postCategoryExists($article_category)
{
  global $connection;
  if ($stmt = $connection->prepare('SELECT cat_name FROM categories WHERE cat_name = ?')) {
    $stmt->bind_param('s', $article_category);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
      return true;
    } else {
      return false;
    }
    $stmt->close();
  }
}

function AddDraft($article_title, $article_tags, $image, $article_category, $article_body)
{

  global $connection;
  $author_key = $_COOKIE['_uacct_'];
  $catg_id = "0";

  if (!userKeyExists($author_key)) {
    return false;
  } else {
    $post_status = 'draft';
    if (!IsEmptyString($article_category) && strlen($article_category) > 0) {
      $catg_id = getPostCategoryID($article_category);
    }
    $stmt = $connection->prepare("INSERT INTO posts(post_author, post_content, post_title,post_status, post_categoryID, post_tags, post_feature_image) VALUES (?,?,?,?,?,?,?)");
    $stmt->bind_param("sssssss", $author_key, $article_body, $article_title, $post_status, $catg_id, $article_tags, $image);
    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
    $stmt->close();
  }
}

function DeleteFromDraft($draft_id)
{

  global $connection;
  $author = sanitize($_SESSION['userkey']);
  $draft_id = sanitize($draft_id);

  $query = "DELETE FROM drafts WHERE id='$draft_id' AND post_author='$author'";
  $result = mysqli_query($connection, $query);
  if ($result) {
    return true;
  } else {
    return false;
  }
}

function getPublishArticles()
{
  global $connection;
  $output = "";
  $post_author = $_COOKIE['_uacct_'];
  $stmt = $connection->prepare('SELECT * FROM posts INNER JOIN categories ON posts.post_categoryID=cat_id WHERE post_status="publish" AND post_author=?');
  $stmt->bind_param('s', $post_author);
  $stmt->execute();
  $result = $stmt->get_result();
  $i = 0;
  while ($row = $result->fetch_assoc()) {
    $i++;
    $catname = getcatname($row['post_categoryID']);
    $output .= '
    <tr>
      <th scope="row">' . $i . '</th>
      <td>' . $row['post_title'] . '</td>
      <td>' . $row['post_date'] . '</td>
      <td><img src="../feature/' . $row['post_feature_image'] . '" alt="' . $row['post_title'] . '"></td>
      <td>' . $catname . '</td>
      <td>' . $row['post_tags'] . '</td>
      <td>' . $row['post_views'] . '</td>
      <td>' . $row['post_comment_count'] . '</td>
      <td><a href="javascript:void(0)" class="btn text-xs btn-primary">View</a></td>
    </tr>
    ';
  }
  echo $output;
}

function getDraftArticles()
{
  global $connection;
  $output = "";
  $post_author = $_COOKIE['_uacct_'];
  $stmt = $connection->prepare('SELECT * FROM posts INNER JOIN categories ON posts.post_categoryID=cat_id WHERE post_status="draft" AND post_author=?');
  $stmt->bind_param('s', $post_author);
  $stmt->execute();
  $result = $stmt->get_result();
  $i = 0;
  while ($row = $result->fetch_assoc()) {
    $i++;
    $catname = getcatname($row['post_categoryID']);
    $image = !empty($row['post_feature_image']) ? '<img src="../feature/' . $row['post_feature_image'] . '" alt="' . $row['post_title'] . '">' : '';
    $output .= '
    <tr>
      <th scope="row">' . $i . '</th>
      <td>' . $row['post_title'] . '</td>
      <td>' . $row['post_date'] . '</td>
      <td>' . $image . '</td>
      <td>' . $catname . '</td>
      <td>' . $row['post_tags'] . '</td>
      <td>' . $row['post_views'] . '</td>
      <td>' . $row['post_comment_count'] . '</td>
      <td><a href="javascript:void(0)" class="btn text-xs btn-primary" title="Coming Soon please bear with us!">Edit</a></td>
    </tr>
    ';
  }
  echo $output;
}

function LIKE($id)
{
  global $connection;
  $id = sanitize($id);

  $query = "UPDATE posts SET post_likes=post_likes+1 WHERE id='$id'";
  $result = mysqli_query($connection, $query);
  if ($result) {
    return true;
  } else {
    return false;
  }
}

function DISLIKE($id)
{
  global $connection;
  $id = sanitize($id);

  $query = "UPDATE posts SET post_dislikes=post_dislikes+1 WHERE id='$id'";
  $result = mysqli_query($connection, $query);
  if ($result) {
    return true;
  } else {
    return false;
  }
}

function ADDVIEW($id)
{
  global $connection;
  $id = sanitize($id);

  $query = "UPDATE posts SET post_views=post_views+1 WHERE id='$id'";
  $result = mysqli_query($connection, $query);
  if ($result) {
    return true;
  } else {
    return false;
  }
}
function timeAgo($time_ago)
{
  $time_ago = strtotime($time_ago);
  $cur_time   = time();
  $time_elapsed   = $cur_time - $time_ago;
  $seconds    = $time_elapsed;
  $minutes    = round($time_elapsed / 60);
  $hours      = round($time_elapsed / 3600);
  $days       = round($time_elapsed / 86400);
  $weeks      = round($time_elapsed / 604800);
  $months     = round($time_elapsed / 2600640);
  $years      = round($time_elapsed / 31207680);
  // Seconds
  if ($seconds <= 60) {
    return "just now";
  }
  //Minutes
  else if ($minutes <= 60) {
    if ($minutes == 1) {
      return "one minute ago";
    } else {
      return "$minutes minutes ago";
    }
  }
  //Hours
  else if ($hours <= 24) {
    if ($hours == 1) {
      return "an hour ago";
    } else {
      return "$hours hrs ago";
    }
  }
  //Days
  else if ($days <= 7) {
    if ($days == 1) {
      return "yesterday";
    } else {
      return "$days days ago";
    }
  }
  //Weeks
  else if ($weeks <= 4.3) {
    if ($weeks == 1) {
      return "a week ago";
    } else {
      return "$weeks weeks ago";
    }
  }
  //Months
  else if ($months <= 12) {
    if ($months == 1) {
      return "a month ago";
    } else {
      return "$months months ago";
    }
  }
  //Years
  else {
    if ($years == 1) {
      return "one year ago";
    } else {
      return "$years years ago";
    }
  }
}

function random_pic($dir = '../profiles')
{
  $files = glob($dir . '/*.*');
  $file = array_rand($files);
  return $files[$file];
}

function AddComment($name, $email, $userimg, $p_id, $comment_text, $user_unique_id = "none")
{
  global $connection;

  $query = "INSERT INTO comments(username,email,userimg,text,post_id,user_unique_id) VALUES('$name','$email','$userimg','$comment_text','$p_id','$user_unique_id')";
  $result = mysqli_query($connection, $query);

  if ($result) {
    return true;
  } else {
    return false;
  }
}

function AddReply($comment_id, $name, $email, $p_id, $comment_text, $user_unique_id = "none")
{
  global $connection;

  $query = "INSERT INTO comment_replies(comment_id,username,email,text,post_id,user_unique_id) VALUES('$comment_id','$name','$email','$comment_text','$p_id','$user_unique_id')";
  $result = mysqli_query($connection, $query);

  if ($result) {
    return true;
  } else {
    return false;
  }
}

function checkIfLogin()
{
  if (empty($_COOKIE["_uacct_"]) || !isset($_COOKIE["_uacct_"])) {
    header("Location: ../login.php");
    die();
  } elseif (isset($_COOKIE["_uacct_"])) {
    if (!userKeyExists($_COOKIE["_uacct_"])) {
      header("Location: ../login.php");
      die();
    }
  }
}

class GetSavedUserCommentInfo
{
  public $name = "", $email, $userimg, $user_unique_id;

  function __construct($user_unique_id)
  {
    $this->user_unique_id = $user_unique_id;
    $this->GetUserInfo();
  }

  public function GetUserInfo()
  {
    global $connection;
    $query = "SELECT username,email,userimg FROM comments WHERE user_unique_id='" . $this->user_unique_id . "' LIMIT 1";
    $result = mysqli_query($connection, $query);

    if ($result) {
      $row = mysqli_fetch_assoc($result);
      if (!empty($row)) {
        $this->name = $row['username'];
        $this->email = $row['email'];
        $this->userimg = $row['userimg'];
      }
    } else {
      return false;
    }
  }
}

class GetSavedUserReplyInfo
{
  public $name, $email, $user_unique_id;

  function __construct($user_unique_id)
  {
    $this->user_unique_id = $user_unique_id;
    $this->GetUserInfo();
  }

  public function GetUserInfo()
  {
    global $connection;
    $query = "SELECT username,email FROM comment_replies WHERE user_unique_id='" . $this->user_unique_id . "' LIMIT 1";
    $result = mysqli_query($connection, $query);

    if ($result) {

      $row = mysqli_fetch_assoc($result);
      if (!empty($row)) {
        $this->name = $row['username'];
        $this->email = $row['email'];
      }
    } else {
      return false;
    }
  }
}


?>