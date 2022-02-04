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

function getuserinfo($id, $col)
{
  global $connection;
  $stmt = $connection->prepare('SELECT ' . $col . ' FROM users WHERE userkey = ?');
  $stmt->bind_param('s', $id);
  $stmt->execute();
  $result = $stmt->get_result();
  $output = $result->fetch_assoc()[$col];
  echo $output;
}

function getusertotalposts($id, $post_status = 'publish')
{
  global $connection;
  $stmt = $connection->prepare('SELECT COUNT(*) as total FROM posts WHERE post_status = ? AND post_author=?');
  $stmt->bind_param('ss', $post_status, $id);
  $stmt->execute();
  $result = $stmt->get_result();
  $output = $result->fetch_assoc()['total'];
  echo $output;
}

function getusertotalviews($id)
{
  global $connection;
  $post_status = 'publish';
  $stmt = $connection->prepare('SELECT SUM(post_views) as total FROM posts WHERE post_status = ? AND post_author=?');
  $stmt->bind_param('ss', $post_status, $id);
  $stmt->execute();
  $result = $stmt->get_result();
  $output = $result->fetch_assoc()['total'];
  echo empty($output) ? 0 : $output;
}

function getusertotalcomments($id)
{
  global $connection;
  $post_status = 'publish';
  $stmt = $connection->prepare('SELECT COUNT(*) as total FROM comments INNER JOIN posts ON comments.post_id=posts.id INNER JOIN users ON users.userkey=posts.post_author WHERE post_status = ? AND post_author=?');
  $stmt->bind_param('ss', $post_status, $id);
  $stmt->execute();
  $result = $stmt->get_result();
  $output = $result->fetch_assoc()['total'];
  echo $output;
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

    $name = str_replace("-", " ", sanitize($name));
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

  // global $connection;
  // $author = sanitize($_SESSION['userkey']);
  // $draft_id = sanitize($draft_id);

  // $query = "DELETE FROM drafts WHERE id='$draft_id' AND post_author='$author'";
  // $result = mysqli_query($connection, $query);
  // if ($result) {
  //   return true;
  // } else {
  //   return false;
  // }
}

function getPublishArticles()
{
  global $connection;
  $output = "";
  $post_author = $_COOKIE['_uacct_'];
  $stmt = $connection->prepare('SELECT * FROM posts INNER JOIN categories ON posts.post_categoryID=cat_id WHERE post_status="publish" AND post_author=? ORDER BY post_date DESC');
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
      <td><a href="../article.php?i=' . $row['id'] . '&article=' . slugify($row['post_title']) . '" target="_blank" class="btn text-xs btn-primary">View</a></td>
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

function AddComment($author, $p_id, $comment_text)
{
  global $connection;
  $stmt = $connection->prepare("INSERT INTO comments(text,post_id,author) VALUES (?,?,?)");
  $stmt->bind_param("sss", $comment_text, $p_id, $author);
  if ($stmt->execute()) {
    return true;
  } else {
    return false;
  }
  $stmt->close();
}

function AddReply($author, $comment_id, $p_id, $comment_text)
{
  global $connection;
  $stmt = $connection->prepare("INSERT INTO comment_replies(comment_id,post_id,text,author_id) VALUES (?,?,?,?)");
  $stmt->bind_param("ssss", $comment_id, $p_id, $comment_text, $author);
  if ($stmt->execute()) {
    return true;
  } else {
    return false;
  }
  $stmt->close();
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

function getTopBlog()
{
  global $connection;
  $query = mysqli_query($connection, "SELECT posts.id as post_id,post_feature_image,post_title,cat_name,name,userkey FROM posts INNER JOIN categories ON posts.post_categoryID=categories.cat_id INNER JOIN users ON posts.post_author=users.userkey WHERE post_status='publish' ORDER BY post_date DESC LIMIT 15");
  $rows = array();
  while ($res = mysqli_fetch_assoc($query)) {
    $rows[] = $res;
  }
  return $rows;
}

function getMostPopular()
{
  global $connection;
  $popular_query = mysqli_query($connection, "SELECT id,post_title FROM posts WHERE post_status='publish' ORDER BY post_views DESC LIMIT 5");
  $output = "";
  while ($popular_row = mysqli_fetch_assoc($popular_query)) {
    $pop_url = slugify($popular_row['post_title']);
    $output .= '
    <li>
      <a href="article.php?i=' . $popular_row['id'] . '&article=' . $pop_url . '" class="blog-link">
        <div class="title">
          <h4>' . ucwords($popular_row['post_title']) . '</h4>
        </div>
      </a>
    </li>';
  }
  echo $output;
}

function getRecentComments()
{
  global $connection;
  $recent_comment_query = mysqli_query($connection, "SELECT posts.id,post_title,profile_pic,name,text FROM comments INNER JOIN posts ON comments.post_id=posts.id INNER JOIN users ON users.userkey=comments.author ORDER BY comment_date DESC LIMIT 10");
  $out = "";
  while ($comm_row = mysqli_fetch_assoc($recent_comment_query)) {
    if (empty($comm_row['profile_pic'])) {
      $image = "users/default.png";
    } else {
      $image = 'users/' . $comm_row['profile_pic'];
    }

    if (strlen($comm_row['post_title']) > 90) {
      $comm_title = substr($comm_row['post_title'], 0, 85) . "...";
    } else {
      $comm_title = $comm_row['post_title'];
    }

    if (strlen($comm_row['text']) > 100) {
      $comm_text = substr($comm_row['text'], 0, 100) . "...";
    } else {
      $comm_text = $comm_row['text'];
    }

    $out .= '
    <li>
      <div class="img">
        <img src="' . $image . '" alt="' . $comm_row['name'] . '">
      </div>
      <div class="content">
        <i class="fas fa-user"></i>
        <span class="name">' . $comm_row['name'] . '</span> on
        <a href="article.php?i=' . $comm_row['id'] . '&article=' . slugify($comm_row['post_title']) . '">' . $comm_title . '</a>
        <p>' . $comm_text . '</p>
      </div>
    </li>
    ';
  }
  echo $out;
}

function slugify($text, string $divider = '-')
{
  $text = preg_replace('~[^\pL\d]+~u', $divider, $text);
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
  $text = preg_replace('~[^-\w]+~', '', $text);
  $text = trim($text, $divider);
  $text = preg_replace('~-+~', $divider, $text);
  $text = strtolower($text);
  if (empty($text)) {
    return 'n-a';
  }
  return $text;
}

function categoryURL($text)
{
  return strtolower(str_replace(" ", "--", $text));
}

function categoryURLUnslug($text)
{
  return strtolower(str_replace("--", " ", $text));
}

function getCategoryPosts($category)
{
  global $connection;
  $out = '';

  $query = mysqli_query($connection, "SELECT posts.id AS post_id,post_feature_image,post_title,userkey,users.name,post_date FROM posts INNER JOIN categories ON categories.cat_id=posts.post_categoryID INNER JOIN users ON users.userkey=posts.post_author WHERE categories.cat_name LIKE '%$category%' AND posts.post_status='publish' ORDER BY post_date DESC");

  while ($row = mysqli_fetch_assoc($query)) {
    $out .= '
    <div class="col-md-4">
    <div class="image">
      <a href="article.php?i=' . $row['post_id'] . '&article=' . slugify($row['post_title']) . '">
        <img src="feature/' . $row['post_feature_image'] . '" alt="">
      </a>
    </div>
    <div class="content">
      <a href="article.php?i=' . $row['post_id'] . '&article=' . slugify($row['post_title']) . '" class="title">' . $row['post_title'] . '</a>
      <div>
      <span class="_a">
        <a href="author.php?author=' . slugify(ucwords($row['name'])) . '&i=' . substr($row['userkey'], 0, 7) . '" class="author">By' . ucwords($row['name']) . '</a>
      </span>
      <span class="date">' . date("F jS, Y", strtotime($row['post_date'])) . '</span>
      </div>
    </div>
    </div>';
  }
  echo $out;
}

function getUserArticles($author_id, $author_name)
{
  global $connection;
  $out = '';

  $query = mysqli_query($connection, "SELECT posts.id AS post_id,post_feature_image,post_title,userkey,users.name,post_date FROM posts INNER JOIN categories ON categories.cat_id=posts.post_categoryID INNER JOIN users ON users.userkey=posts.post_author WHERE SUBSTRING(users.userkey,1,7) LIKE '%$author_id%' AND users.name LIKE '%$author_name%' AND posts.post_status='publish' ORDER BY post_date DESC");

  while ($row = mysqli_fetch_assoc($query)) {
    $out .= '
    <div class="col-md-4">
    <div class="image">
      <a href="article.php?i=' . $row['post_id'] . '&article=' . slugify($row['post_title']) . '">
        <img src="feature/' . $row['post_feature_image'] . '" alt="">
      </a>
    </div>
    <div class="content">
      <a href="article.php?i=' . $row['post_id'] . '&article=' . slugify($row['post_title']) . '" class="title">' . $row['post_title'] . '</a>
      <div>
      <span class="_a">
        <a href="author.php?author=' . slugify(ucwords($row['name'])) . '&i=' . substr($row['userkey'], 0, 7) . '" class="author">By ' . ucwords($row['name']) . '</a>
      </span>
      <span class="date">' . date("F jS, Y", strtotime($row['post_date'])) . '</span>
      </div>
    </div>
    </div>';
  }
  echo $out;
}

function getRecommendedPosts()
{
  global $connection;
  $output = "";
  $stmt = $connection->prepare('SELECT posts.id AS post_id,post_title,post_feature_image,cat_name,post_date FROM posts INNER JOIN categories ON posts.post_categoryID=cat_id WHERE post_status="publish" ORDER BY post_views DESC LIMIT 3');
  $stmt->execute();
  $result = $stmt->get_result();
  while ($row = $result->fetch_assoc()) {
    $output .= '
    <div class="col-md-12">
    <div class="row">
      <div class="col-md-5">
        <div class="blog_img">
          <a href="article.php?i=' . $row['post_id'] . '&article=' . slugify($row['post_title']) . '">
          <img src="feature/' . $row['post_feature_image'] . '" alt="" class="img-fluid">
          </a>
        </div>
      </div>
      <div class="col-md-7">
        <div class="category">
          <a href="categories.php?category=' . categoryURL($row['cat_name']) . '">' . strtoupper($row['cat_name']) . '</a>
        </div>
        <div class="blog-link">
          <a href="article.php?i=' . $row['post_id'] . '&article=' . slugify($row['post_title']) . '" class="title">
            <h4>' . $row['post_title'] . '</h4>
          </a>
        </div>
        <div class="date">' . date("F jS, Y", strtotime($row['post_date'])) . '</div>
      </div>
    </div>
  </div>
    ';
  }
  echo $output;
}

function getSidebarCategories()
{
  global $connection;
  $catg_query = mysqli_query($connection, "SELECT cat_name,COUNT(*) AS total FROM posts INNER JOIN categories ON posts.post_categoryID=categories.cat_id GROUP BY posts.post_categoryID ORDER BY total DESC");

  $out = "";
  while ($row = mysqli_fetch_assoc($catg_query)) {
    $out .= '
      <li>
        <a href="categories.php?category=' . categoryURL($row['cat_name']) . '">
          <span class="name">' . strtoupper($row['cat_name']) . '</span>
          <span class="count">' . $row['total'] . '</span>
        </a>
      </li>
    ';
  }
  echo $out;
}

function getSidebarRecent()
{
  global $connection;
  $catg_query = mysqli_query($connection, "SELECT id AS post_id,post_title FROM posts WHERE post_status='publish' ORDER BY post_date DESC LIMIT 10");

  $out = "";
  while ($row = mysqli_fetch_assoc($catg_query)) {
    $out .= '
    <li>
      <a href="article.php?i=' . $row['post_id'] . '&article=' . slugify($row['post_title']) . '">' . $row['post_title'] . '</a>
    </li>
    ';
  }
  echo $out;
}

function getSidebarComments()
{
  global $connection;
  $catg_query = mysqli_query($connection, "SELECT posts.id AS post_id,post_title,name,text FROM comments INNER JOIN posts ON comments.post_id=posts.id INNER JOIN users ON users.userkey=comments.author ORDER BY comment_date DESC LIMIT 12");

  $out = "";
  while ($row = mysqli_fetch_assoc($catg_query)) {
    if (strlen($row['post_title']) > 30) {
      $comm_title = substr($row['post_title'], 0, 30) . "...";
    } else {
      $comm_title = $row['post_title'];
    }

    if (strlen($row['text']) > 35) {
      $comm_text = substr($row['text'], 0, 35) . "...";
    } else {
      $comm_text = $row['text'];
    }

    $out .= '
    <li>
      <i class="fas fa-user"></i>
      <span class="name">' . $row['name'] . '</span> on
      <a href="article.php?i=' . $row['post_id'] . '&article=' . slugify($row['post_title']) . '">' . $comm_title . '</a>
      <p>' . $comm_text . '</p>
    </li>
    ';
  }
  echo $out;
}

function postExists($p_id)
{
  global $connection;
  if ($stmt = $connection->prepare('SELECT posts.id FROM posts WHERE id = ?')) {
    $stmt->bind_param('s', $p_id);
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

function getarticleinfo($id, $col)
{
  global $connection;
  $stmt = $connection->prepare('SELECT ' . $col . ' FROM posts INNER JOIN categories ON posts.post_categoryID=categories.cat_id INNER JOIN users ON posts.post_author=users.userkey WHERE posts.id = ?');
  $stmt->bind_param('s', $id);
  $stmt->execute();
  $result = $stmt->get_result();
  $output = $result->fetch_assoc()[$col];
  return $output;
}

function getRelatedPosts($cat_id, $p_id)
{
  global $connection;
  $query = mysqli_query($connection, "SELECT id AS post_id,post_title FROM posts WHERE post_categoryID = " . $cat_id . " AND id != " . $p_id . " ORDER BY RAND() LIMIT 0,10");

  $out = "";
  while ($row = mysqli_fetch_assoc($query)) {
    $out .= '
    <li>
      <a href="article.php?i=' . $row['post_id'] . '&article=' . slugify($row['post_title']) . '">' . $row['post_title'] . '</a>
    </li>
    ';
  }
  echo $out;
}

function getDashboardComments($author)
{
  global $connection;

  $comment_query = mysqli_query($connection, "SELECT * FROM comments INNER JOIN users ON users.userkey=comments.author INNER JOIN posts ON comments.post_id=posts.id WHERE posts.post_author='$author' ORDER BY comment_date DESC LIMIT 5");
  $out = '';
  while ($row = mysqli_fetch_assoc($comment_query)) {
    $out .= '
    <div class="comment-box bg-light rounded">
      <span class="commenter-pic">
        <img src="../users/' . $row['profile_pic'] . '" class="img-fluid" alt="' . $row['name'] . '">
      </span>
      <span class="commenter-name">
        <span class="username">' . ucwords($row['name']) . '</span> <span class="comment-time">' . timeAgo($row['comment_date']) . '</span>
      </span>
      <p class="comment-txt more mb-0 pb-3">' . $row['text'] . '</p>
    </div>
    ';
  }
  echo $out;
}

?>