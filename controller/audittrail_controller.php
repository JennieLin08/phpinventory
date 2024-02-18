<?php

include('db_conn.php');

if (isset($_POST['save_cat'])){
    session_start();
    $user_name=$_SESSION['user_name'];
    $user_id=$_SESSION['id'];

    $cat_name =$_POST['cat_name'];
    $conn->query("INSERT INTO tbl_audittrail (cat_name,status) VALUES('$cat_name','Active')") or die ($conn->error);

    $audit_qry = $conn->query("INSERT INTO tbl_audittail (trans_type,desc,action,user_id,user_name) 
    VALUES('CATEGORY','$cat_name','CREATED','$user_id','$user_name')") or die ($conn->error);
   
    if($conn->error){
        $_SESSION['message']=$conn->error;
        $_SESSION['msg_type']="warning";

    }else{
        $_SESSION['message']=" audittrail has been saved!";
        $_SESSION['msg_type']="success";
    }
    header ("Location:../audittrail.php");
      
}


if(isset($_GET['delete'])){
    session_start();
    $id = $_GET['delete'];
    $conn->query("UPDATE tbl_audittrail SET status='deleted' WHERE cat_id=$id ") or die ($conn->error);
    
    if($conn->error){
        $_SESSION['message']=$conn->error;
        $_SESSION['msg_type']="warning";

    }else{
        $_SESSION['message']=" audittrail has been delete!";
        $_SESSION['msg_type']="danger";
    }
    header ("Location:../audittrail.php");
}

if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update_cat = true;

    $result = $conn->query("SELECT * FROM tbl_audittrail WHERE cat_id =$id ");
    if($result->num_rows == 1) {
        $row = $result->fetch_array();
        $cname = $row['cat_name'];
        $divModal = " class='modal fade show' aria-modal='true' role='dialog' style='display:block;' ";
    }

}

if(isset($_POST['update_cat'])){
    $id= $_POST['cat_id'];
    $cat_name = $_POST['cat_name'];

    $conn->query("UPDATE tbl_audittrail SET cat_name='$cat_name' WHERE cat_id=$id ");
    session_start();
    if($conn->error){
        $_SESSION['message']=$conn->error;
        $_SESSION['msg_type']="warning";
    
    }else{
        $_SESSION['message']=" audittrail has been updated!";
        $_SESSION['msg_type']="success";
 
    }

    header ("Location:../audittrail.php");



}

if(isset($_GET['close'])){

        $divModal = "class='modal fade' style='display:none;' aria-hidden='true'  ";
        header ("Location:../audittrail.php");

}

