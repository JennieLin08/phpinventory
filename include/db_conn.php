
<?php
$server_name = "localhost";
$user_name = "root";
$pass = "";
$db_name="db_ims_lgusol";

$conn = mysqli_connect($server_name,$user_name,$pass,$db_name);

if(!$conn){
    echo "Connection Failed";
}
?>