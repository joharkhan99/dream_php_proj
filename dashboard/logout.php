<?php
if (isset($_COOKIE['_uacct_'])) {
  unset($_COOKIE['_uacct_']);
  setcookie('_uacct_', '', time() - 3600, '/');
  header('Location:../');
} else {
  header('Location:../');
}
