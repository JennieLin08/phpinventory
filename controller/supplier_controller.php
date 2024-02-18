<?php

include('db_conn.php');

if (isset($_POST['save_sup'])){
    session_start();
    $sup_name =$_POST['sup_name'];
    $mobile =$_POST['mobile'];
    $address =$_POST['address'];
    $tin = $_POST['tin'];
    $user_name=$_SESSION['user_name'];
    $user_id=$_SESSION['id'];
    $conn->query("INSERT INTO tbl_supplier (supplier_name,mobile,address,tin,user_id,user_name,status) 
                    VALUES('".addslashes($sup_name)."','$mobile',' $address','$tin','$user_id','$user_name','Active')");

    if($conn->error){
        $_SESSION['message']=$conn->error;
        $_SESSION['msg_type']="warning";
        header ("Location:../supplier.php");

    }else{
        $save_autrail = $conn->query("INSERT INTO tbl_audittrail (trans_type,descs,action,user_id,user_name)
     VALUES('Supplier','".addslashes($sup_name)."','Add','$user_id','$user_name')");
    $_SESSION['message']=" Supplier has been saved!";
    $_SESSION['msg_type']="success";
    header ("Location:../supplier.php");

    }
    
}

if(isset($_GET['delete'])){
    session_start();
    date_default_timezone_set('Asia/Manila');
    $update_date = date("Y-m-d h:i:sa");
    $user_name=$_SESSION['user_name'];
    $user_id=$_SESSION['id'];

    $id = $_GET['delete'];
    $conn->query("UPDATE tbl_supplier SET status='deleted',user_id='$user_id',user_name='$user_name',date_update='$update_date' WHERE sup_id=$id ") or die ($conn->error);
    
    $get_nameqry = $conn->query("SELECT * FROM tbl_supplier WHERE sup_id=$id ");
    $row = $get_nameqry->fetch_array();
    $sup_name = $row['supplier_name'];

    $save_autrail = $conn->query("INSERT INTO tbl_audittrail (trans_id,trans_type,descs,action,user_id,user_name)
            VALUES('$id','Supplier','$sup_name','delete','$user_id','$user_name')");

    $_SESSION['message']=" Supplier has been delete!";
    $_SESSION['msg_type']="danger";
    header ("Location:../supplier.php");

}

if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update_sup = true;

    $result = $conn->query("SELECT * FROM tbl_supplier WHERE sup_id =$id ");
    if($result->num_rows == 1) {
        $row = $result->fetch_array();
        $sname = $row['supplier_name'];
        $mobile = $row['mobile'];
        $address = $row['address'];
        $tin = $row['tin'];
        $divModal = " class='modal fade show' aria-modal='true' role='dialog' style='display:block;' ";
    }

}

if(isset($_POST['update_sup'])){
    session_start();
    date_default_timezone_set('Asia/Manila');
    $update_date = date("Y-m-d h:i:sa");
    $user_name=$_SESSION['user_name'];
    $user_id=$_SESSION['id'];

    $id= $_POST['sup_id'];
    $sup_name = $_POST['sup_name'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $tin = $_POST['tin'];
    

        $conn->query("UPDATE tbl_supplier SET supplier_name='".addslashes($sup_name)."',mobile='$mobile',address='$address',date_update='$update_date',tin='$tin',user_id='$user_id',user_name='$user_name' WHERE sup_id=$id ");
        
        $save_autrail = $conn->query("INSERT INTO tbl_audittrail (trans_id,trans_type,descs,action,user_id,user_name)
        VALUES('$id','Supplier','".addslashes($sup_name)."','update','$user_id','$user_name')");

        $_SESSION['message']=" Supplier has been updated!";
        $_SESSION['msg_type']="success";
        header ("Location:../supplier.php");
}

if(isset($_GET['close'])){

        $divModal = "class='modal fade' style='display:none;' aria-hidden='true'  ";
        header ("Location:../supplier.php");

}
