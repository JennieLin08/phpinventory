<?php


include('db_conn.php');

if (isset($_POST['save_emp'])){
    session_start();
    $user_name=$_SESSION['user_name'];
    $user_id=$_SESSION['id'];

    $emp_name =$_POST['emp_name'];
    $mobile =$_POST['mobile'];
    $address =$_POST['address'];
    $office =$_POST['office'];
    $section =$_POST['section'];

    $conn->query("INSERT INTO tbl_employee (name,mobile,address,section,office,status) VALUES('$emp_name','$mobile',' $address','$section','$office','Active')");
    if($conn->error){
        $_SESSION['message']=$conn->error;
        $_SESSION['msg_type']="warning";
        header ("Location:../employee.php");

    }else{
    $save_autrail = $conn->query("INSERT INTO tbl_audittrail (trans_type,descs,action,user_id,user_name)
     VALUES('Employee','$emp_name','Add','$user_id','$user_name')");
    //  echo $emp_name;
    $_SESSION['message']=" Employee has been saved!";
    $_SESSION['msg_type']="success";
    header ("Location:../employee.php");
    }
    
}

if(isset($_GET['delete'])){
    session_start();
    $user_name=$_SESSION['user_name'];
    $user_id=$_SESSION['id'];
    $id = $_GET['delete'];
    $conn->query("UPDATE tbl_employee SET status='deleted' WHERE emp_id=$id ");

    $get_nameqry = $conn->query("SELECT * FROM tbl_employee WHERE emp_id=$id ");
    $row = $get_nameqry->fetch_array();
    $emp_name = $row['name'];
   
    if($conn->error){
        $_SESSION['message']=$conn->error;
        $_SESSION['msg_type']="warning";
        header ("Location:../employee.php");

    }else{
        $save_autrail = $conn->query("INSERT INTO tbl_audittrail (trans_id,trans_type,descs,action,user_id,user_name)
            VALUES('$id','Employee','$emp_name','delete','$user_id','$user_name')");
        $_SESSION['message']=" Employee has been delete!";
        $_SESSION['msg_type']="danger";
        header ("Location:../employee.php");
    }

}

if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update_emp = true;

    $result = $conn->query("SELECT * FROM tbl_employee WHERE emp_id =$id ");
    if($result->num_rows == 1) {
        $row = $result->fetch_array();
        $emp_name = $row['name'];
        $mobile = $row['mobile'];
        $address = $row['address'];
        $office = $row['office'];
        $section = $row['section'];
        $divModal = " class='modal fade show' aria-modal='true' role='dialog' style='display:block;' ";
    }

}

if(isset($_POST['update_emp'])){
    session_start();
    $user_name=$_SESSION['user_name'];
    $user_id=$_SESSION['id'];
    $id= $_POST['emp_id'];
    $emp_name = $_POST['emp_name'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $office = $_POST['office'];
    $section = $_POST['section'];

        $conn->query("UPDATE tbl_employee SET name='$emp_name',mobile='$mobile',address='$address',section='$section',office='$office' WHERE emp_id=$id ");
        

        if($conn->error){
            $_SESSION['message']=$conn->error;
            $_SESSION['msg_type']="warning";
            header ("Location:../employee.php");
        }else{

            $save_autrail = $conn->query("INSERT INTO tbl_audittrail (trans_id,trans_type,descs,action,user_id,user_name)
            VALUES('$id','Employee','$emp_name','update','$user_id','$user_name')");

            $_SESSION['message']=" Employee has been updated!";
            $_SESSION['msg_type']="success";
            header ("Location:../employee.php");
        }
}

if(isset($_GET['close'])){

        $divModal = "class='modal fade' style='display:none;' aria-hidden='true'  ";
        header ("Location:../employee.php");

}

