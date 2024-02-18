<?php
  if(!isset($_SESSION['user_name']) && empty($_SESSION['user_name'])){
    header("Location:index.php");
}
