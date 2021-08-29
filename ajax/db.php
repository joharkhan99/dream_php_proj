<?php
$host = "localhost";
$db = "dream";
$user = "root";
$pass = "";

$connection = @mysqli_connect($host, $user, $pass, $db);
if (!$connection) {
  die("
  <!DOCTYPE html>
<html lang='en'>

<head>
<meta charset='UTF-8'>
<meta http-equiv='X-UA-Compatible' content='IE=edge'>
<meta name='viewport' content='width=device-width, initial-scale=1'>
  <title>Blog</title>
<style>
html,body{
  height: 100%;
  margin:0
}
div{
  text-align: center;
  width: 100%;
  height: 100%;
  margin: auto;
  display: flex;
  justify-content: center;
  align-items: center;
  font-family: cursive;
  color: #484848;
  flex-direction: column;
}
h3{
  margin: 0;margin-bottom: 10px;
}
a{
  text-decoration: none;background: dodgerblue;color: white;padding: 5px 20px;border-radius: 23px;
}
</style>
  </head>
  <body>


  <div>  
  <h3>Unexpected Error !</h3>
  <a href='../' rel='noopener noreferrer'>Back to Site</a>
  </div>


  </body>
  </html>
  ");
}
