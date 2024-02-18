<?php
session_start();

include '../include/db_conn.php';

// if(isset($_POST['email']) && isset($_POST['password'])){
//     function validate($data){
//         // $data = trim($data);
//         // $data = stripslashes($data);
//         // $data = htmlspecialchars($data);
//         return $data;
//     }
// }

// $email = validate($_POST['email']);
// $pass = validate($_POST['password']);

$email = $_POST['email'];
$pass = $_POST['password'];

if(empty($email)){
    header ("Location: ../index.php?error= Email is required!");
    exit();
}
else if(empty($pass)){
    header ("Location: ../index.php?error= Password is required!");
    exit();
}

    $sql = "SELECT * FROM tbl_user WHERE email='$email' AND password='$pass'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result)=== 1){
        $row = mysqli_fetch_assoc($result);
        echo "Logged In !";
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['type'] = $row['type'];
            $_SESSION['id'] = $row['userid'];
            header("Location: ../home.php");
        
    }
    else{
        header("Location: ../index.php");
        exit();
    }
    

?>