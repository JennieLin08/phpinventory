<?php

include('db_conn.php');

// if (isset($_POST['save_cat'])){
//     session_start();
//     $user_name=$_SESSION['user_name'];
//     $user_id=$_SESSION['id'];

//     $cat_name =$_POST['cat_name'];
//     $conn->query("INSERT INTO tbl_user (cat_name,status) VALUES('$cat_name','Active')") or die ($conn->error);

//     $audit_qry = $conn->query("INSERT INTO tbl_audittail (trans_type,desc,action,user_id,user_name) 
//     VALUES('CATEGORY','$cat_name','CREATED','$user_id','$user_name')") or die ($conn->error);
   
//     if($conn->error){
//         $_SESSION['message']=$conn->error;
//         $_SESSION['msg_type']="warning";

//     }else{
//         $_SESSION['message']=" Category has been saved!";
//         $_SESSION['msg_type']="success";
//     }
//     header ("Location:../user.php");
      
// }


// if(isset($_GET['delete'])){
//     session_start();
//     $id = $_GET['delete'];
//     $conn->query("UPDATE tbl_user SET status='deleted' WHERE cat_id=$id ") or die ($conn->error);
    
//     if($conn->error){
//         $_SESSION['message']=$conn->error;
//         $_SESSION['msg_type']="warning";

//     }else{
//         $_SESSION['message']=" Category has been delete!";
//         $_SESSION['msg_type']="danger";
//     }
//     header ("Location:../user.php");
// }

if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update_user = true;

    $result = $conn->query("SELECT * FROM tbl_user WHERE userid =$id ");
    // echo $result->num_rows;
    // $divModal = " class='modal fade show' aria-modal='true' role='dialog' style='display:block;' ";
    if($result->num_rows == 1) {
        $row = $result->fetch_array();
        $name = $row['name'];
        $email = $row['email'];
        // $type = $row['type'];
        $type = '<option value="'.$row['type'].'"> '.$row['type'].'</option>';
        $divModal = " class='modal fade show' aria-modal='true' role='dialog' style='display:block;' ";
    }

}

if(isset($_GET['changepassword'])){
    $id = $_GET['changepassword'];
    $update_user = true;

    $result = $conn->query("SELECT * FROM tbl_user WHERE userid =$id ");
    $passModal = " class='modal fade show' aria-modal='true' role='dialog' style='display:block;' ";
    // echo $result->num_rows;
    // $divModal = " class='modal fade show' aria-modal='true' role='dialog' style='display:block;' ";
    // if($result->num_rows == 1) {
    //     $row = $result->fetch_array();
    //     $name = $row['name'];
    //     $email = $row['email'];
    //     // $type = $row['type'];
    //     $type = '<option value="'.$row['type'].'"> '.$row['type'].'</option>';
    //     $divModal = " class='modal fade show' aria-modal='true' role='dialog' style='display:block;' ";
    // }

}

if(isset($_POST['update_user'])){
    $id= $_POST['cat_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $type = $_POST['type'];
   

    $conn->query("UPDATE tbl_user SET name='$name',email='$email',type='$type' WHERE userid=$id ");
    session_start();
    if($conn->error){
        $_SESSION['message']=$conn->error;
        $_SESSION['msg_type']="warning";
    
    }else{
        $_SESSION['message']=" User has been updated!";
        $_SESSION['msg_type']="success";
    }
    header ("Location:../user.php");
}

if(isset($_POST['update_pass'])){
    $id= $_POST['id'];
    $newpass = $_POST['password']; 

    $conn->query("UPDATE tbl_user SET password='$newpass' WHERE userid=$id ");
    session_start();
    if($conn->error){
        $_SESSION['message']=$conn->error;
        $_SESSION['msg_type']="warning";
    
    }else{
        $_SESSION['message']=" Password has been updated!";
        $_SESSION['msg_type']="success";
    }
    header ("Location:../user.php");
}

if(isset($_GET['close'])){

        $divModal = "class='modal fade' style='display:none;' aria-hidden='true'  ";
        $passModal = "class='modal fade' style='display:none;' aria-hidden='true'  ";
        header ("Location:../user.php");

}


