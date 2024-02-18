<?php

include('db_conn.php');

if (isset($_POST['save_cat'])){
    session_start();
    $user_name=$_SESSION['user_name'];
    $user_id=$_SESSION['id'];
    $order_list = $_POST['order_no'];

    $cat_name =$_POST['cat_name'];

    $conn->query("INSERT INTO tbl_category (cat_name,status,order_list) VALUES('$cat_name','Active','$order_list')") or die ($conn->error);
    $audit_qry = $conn->query("INSERT INTO tbl_audittrail (trans_type,descs,action,user_id,user_name) 
    VALUES('CATEGORY','$cat_name','CREATED','$user_id','$user_name')") or die ($conn->error);
   
    if($conn->error){
        $_SESSION['message']=$conn->error;
        $_SESSION['msg_type']="warning";

    }else{
        $_SESSION['message']=" Category has been saved!";
        $_SESSION['msg_type']="success";
    }
    header ("Location:../category.php");
      
}


if(isset($_GET['delete'])){
    session_start();
    $id = $_GET['delete'];
    $conn->query("UPDATE tbl_category SET status='deleted' WHERE cat_id=$id ") or die ($conn->error);
    
    if($conn->error){
        $_SESSION['message']=$conn->error;
        $_SESSION['msg_type']="warning";

    }else{
        $_SESSION['message']=" Category has been delete!";
        $_SESSION['msg_type']="danger";
    }
    header ("Location:../category.php");
}

if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update_cat = true;

    $result = $conn->query("SELECT * FROM tbl_category WHERE cat_id =$id ");
    if($result->num_rows == 1) {
        $row = $result->fetch_array();
        $cname = $row['cat_name'];
        $order_no = $row['order_list'];
        $divModal = " class='modal fade show' aria-modal='true' role='dialog' style='display:block;' ";
    }

}

if(isset($_POST['update_cat'])){
    $id= $_POST['cat_id'];
    $cat_name = $_POST['cat_name'];
    $order_list = $_POST['order_no'];

    $conn->query("UPDATE tbl_category SET cat_name='$cat_name', order_list='$order_list' WHERE cat_id=$id ");
    session_start();
    if($conn->error){
        $_SESSION['message']=$conn->error;
        $_SESSION['msg_type']="warning";
    
    }else{
        $_SESSION['message']=" Category has been updated!";
        $_SESSION['msg_type']="success";
 
    }

    header ("Location:../category.php");



}

if(isset($_GET['close'])){

        $divModal = "class='modal fade' style='display:none;' aria-hidden='true'  ";
        header ("Location:../category.php");

}

