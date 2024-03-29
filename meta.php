<!-- <title>How to write your first Medium post… | by Cooper Smith | Medium</title>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1,maximum-scale=1" />
<meta name="theme-color" content="#3158c9" />
<meta property="og:site_name" content="Likhdy" />
<meta property="og:type" content="article" />
<meta property="article:published_time" content="ARTICLEPULISHTIME" />
<meta name="title" content="How to write your first Medium post… | by Cooper Smith | Medium" />
<meta property="og:title" content="How to write your first Medium post…" />
<meta name="description" content="Well, it’s time. You’ve joined Medium. You’ve applauded, commented, and highlighted. You may have even paid for premium membership so that you can support the community. Now, it is time for you to…" />
<meta property="og:description" content="Or, at least, how I did it" />
<meta property="og:url" content="https://medium.com/@cooperwrites/how-to-write-your-first-medium-post-or-at-least-how-i-did-it-c350001ca8ed" />
<meta property="al:web:url" content="https://medium.com/@cooperwrites/how-to-write-your-first-medium-post-or-at-least-how-i-did-it-c350001ca8ed" />
<meta property="og:image" content="https://miro.medium.com/max/1200/0*8L5Mt5W0ZkomKpeE" />
<meta property="article:author" content="https://medium.com/@cooperwrites" />
<meta name="author" content="Cooper Smith" />
<meta name="robots" content="index,follow,max-image-preview:large" />
<meta name="referrer" content="unsafe-url" />
<link rel="search" type="application/opensearchdescription+xml" title="Medium" href="/osd.xml" />
<link rel="apple-touch-icon" sizes="152x152" href="https://miro.medium.com/fit/c/152/152/1*sHhtYhaCe2Uc3IU0IgKwIQ.png" />
<link rel="preconnect" href="https://glyph.medium.com" crossOrigin="" />
<link rel="author" href="https://medium.com/@cooperwrites" />
<link rel="canonical" href="https://medium.com/@cooperwrites/how-to-write-your-first-medium-post-or-at-least-how-i-did-it-c350001ca8ed" /> -->


<?php
$pagename = basename($_SERVER['PHP_SELF']);
switch ($pagename) {
  case "index.php":
    getIndexMeta();
    break;
  case "categories.php":
    if (isset($_GET['category']) && !empty($_GET['category'])) {
      $category = categoryURLUnslug($_GET['category']);
      getCategoryMeta(sanitize($category));
    }
    break;
  case "tag.php":
    if (isset($_GET['tag']) && !empty($_GET['tag'])) {
      $tag = categoryURLUnslug($_GET['tag']);
      getTagMeta($tag);
    }
    break;
  case "author.php":
    if (isset($_GET['author']) && !empty($_GET['author']) && isset($_GET['i']) && !empty($_GET['i'])) {
      $authorname = $_GET['author'];
      $userkey = $_GET['i'];
      getAuthorMeta($authorname, $userkey);
    }
    break;
  case "login.php":
    getLoginMeta();
    break;
  case "signup.php":
    getSignUpMeta();
    break;
  case "explore.php":
    getExploreMeta();
    break;
  case "article.php":
    if (isset($_GET['i']) && !empty($_GET['i'])) {
      $p_id = sanitize($_GET['i']);
      getArticleMeta($p_id);
      break;
    }
  default:
    getIndexMeta();
    break;
}
?>