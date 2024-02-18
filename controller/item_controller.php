<?php

include('db_conn.php');


$cat_select_id =0;
$cat_select_name ='All';

if(isset($_GET['category']) && $_GET['category'] !='All' ){ 
$category_select=explode("#",$_GET['category']);
$cat_select_id = $category_select[0];
$cat_select_name = $category_select[1];
}


if (isset($_POST['save_itemtrans'])){
    // echo 'test';
    session_start();
    $user_name=$_SESSION['user_name'];
    $user_id=$_SESSION['id'];

    $item_name =$_POST['item_name'];
    $item_code =$_POST['item_code'];
    $category =explode ("#",$_POST['cat_name']);
    $cat_id =$category[0];
    $cat_name =$category[1];

    $supplier =explode ("#",$_POST['sup_name']);
    $sup_id = $supplier[0];
    $sup_name = $supplier[1];
    $description = $_POST['description'];
    // item qty and unit
    $iunit_package = $_POST['iunit_package'];
    $i_unit_ind = $_POST['i_unit_ind'];
    $i_qty = $_POST['i_qty'];

    // trans qty and unit 
    $t_qty1 = $_POST['t_qty'];
    $t_unit1 = $_POST['t_unit'];
    $t_amount1 = $_POST['t_amount'];

    $t_unit2 = $_POST['tunit_2'];
    $t_qty2 = $_POST['tqty_2'];
    $t_amount2 = $_POST['tamount_2'];

    if($iunit_package == $t_unit1){
        $qty_ind_1 = $_POST['t_qty'] * $i_qty;
                
    }else{
        $qty_ind_1 = $_POST['t_qty'];
    }

    if($iunit_package == $t_unit2){
        $qty_ind_2 = $_POST['tqty_2'] * $i_qty;
        
    }else{
        $qty_ind_2 = $_POST['tqty_2'];
    }

    $qty_ind = $qty_ind_1 + $qty_ind_2;
    $total = ($_POST['t_amount'] * $_POST['t_qty'] ) + ($_POST['tamount_2'] * $_POST['tqty_2'] );
 

    // $total = $_POST['amount'] * $_POST['qty'];
    $trans_date = $_POST['date'];
    $remarks = $_POST['remarks'];
    $eul = $_POST['eul'];

    $check_itemExist = $conn->query("SELECT * FROM tbl_item WHERE item_name='$item_name' ");
    $row_itemExist = $check_itemExist->fetch_assoc();
    // echo $check_itemExist->num_rows;
    if($check_itemExist->num_rows == 1){
        $_SESSION['message']='Item already exists';
        $_SESSION['msg_type']="danger";
        
        header ("Location:../item.php");

    }
    else{

        $save_item = $conn->query("INSERT INTO tbl_item (item_name,item_code,cat_id,cat_name,description,qty,unit,unit_group,remarks,status)
        VALUES('".addslashes($item_name)."','".addslashes($item_code)."','$cat_id','$cat_name','".addslashes($description)."','$i_qty','$i_unit_ind','$iunit_package','$remarks','Active')") or die($conn->error);

            $item_id_qry = $conn->query("SELECT item_id FROM tbl_item where item_name='$item_name' LIMIT 1 ");
            $row_itemid =$item_id_qry->fetch_assoc();
            
            $item_id = $row_itemid['item_id'];
            echo  $item_id;

            $save_itemtrans = $conn->query("INSERT INTO tbl_itemtrans(trans_type,item_id,item_name,item_code,
                        cat_name,sup_id,sup_name,description,qty,qty_2,qty_ind,unit,unit_2,amount,amount_2,total,trans_date,remarks,status,
                        eul,warehouse,user_name,user_id) VALUES('add','$item_id','".addslashes($item_name)."','".addslashes($item_code)."',
                        '$cat_name','$sup_id','".addslashes($sup_name)."','".addslashes($description)."','$t_qty1','$t_qty2','$qty_ind','$t_unit1','$t_unit2','$t_amount1','$t_amount2','$total',
                        '$trans_date','$remarks','Active','$eul','Main','$user_name','$user_id')") or die($conn->error);

            if($conn->error){
                $_SESSION['message']=$conn->error;
                $_SESSION['msg_type']="warning";
                header ("Location:../item.php");
            }else{
                $save_autrail = $conn->query("INSERT INTO tbl_audittrail (trans_type,descs,action,user_id,user_name)
                VALUES('Add item and transaction','$item_name','Add','$user_id','$user_name')");

                $_SESSION['message']=" Item has been saved!";
                $_SESSION['msg_type']="success";
                header ("Location:../item.php");
            }
    }
}

if (isset($_POST['save_item'])){
        session_start();
        $user_name=$_SESSION['user_name'];
        $user_id=$_SESSION['id'];

        $item_name =$_POST['item_name'];
        $item_code =$_POST['item_code'];
        $description =$_POST['description'];
        $category =explode ("#",$_POST['cat_name']);
        $cat_id =$category[0];
        $cat_name =$category[1];
        $remarks = $_POST['remarks'];
        $unit = $_POST['unit'];
        $unit_group = $_POST['unit_package'];
        $qty_ind = $_POST['qty_ind'];

        $check_itemExist = $conn->query("SELECT * FROM tbl_item WHERE item_name='$item_name' ");
        $row_itemExist = $check_itemExist->fetch_assoc();
        // echo $check_itemExist->num_rows;
        if($check_itemExist->num_rows == 1){
            // $_SESSION['message']=$conn->error;
            // $_SESSION['type']="warning";
    
            $_SESSION['item_name'] =$_POST['item_name'];
            $_SESSION['item_code'] =$_POST['item_code'];
            $_SESSION['description'] =$_POST['description'];
            $_SESSION['cat_val'] =$_POST['cat_name'];
            $_SESSION['unit'] = $_POST['unit'];
            $_SESSION['unit_package'] = $_POST['unit_package'];
            $_SESSION['qty_ind'] = $_POST['qty_ind'];
            $_SESSION['remarks'] = $_POST['remarks'];
    
            header ("Location:../item.php?status='duplicate'");
        }else{
            $conn->query("INSERT INTO tbl_item (item_name,item_code,description,qty,cat_id,cat_name,unit,unit_group,remarks,status)
            VALUES('".addslashes($item_name)."','$item_code','$description','$qty_ind','$cat_id','$cat_name','$unit','$unit_group','$remarks','Active')");
            if($conn->error){
                $_SESSION['message']=$conn->error;
                $_SESSION['msg_type']="danger";
                header ("Location:../item.php");
 
            }else{
                $save_autrail = $conn->query("INSERT INTO tbl_audittrail (trans_type,descs,action,user_id,user_name)
                        VALUES('Item','$item_name','Add','$user_id','$user_name')");
        
                $_SESSION['message']=" Item has been saved!";
                $_SESSION['msg_type']="success";
                header ("Location:../item.php");
            }

        }

}

if(isset($_GET['status'])){
    // session_start();
    $_SESSION['message']='<script> alert("Item name already exist!");</script>';

    $item_name =$_SESSION['item_name'];
    $item_code =$_SESSION['item_code'];
    $description = $_SESSION['description'];
    $cat_val = $_SESSION['cat_val'];
    $unit =  $_SESSION['unit'];
    $unit_package = $_SESSION['unit_package'];
    $qty_ind = $_SESSION['qty_ind'];
    $remarks = $_SESSION['remarks'];
    $divModalonly = " class='modal fade show' aria-modal='true' role='dialog' style='display:block;' ";
    

}

if(isset($_GET['delete'])){
    session_start();
    $user_name=$_SESSION['user_name'];
    $user_id=$_SESSION['id'];
    $id = $_GET['delete'];
    $conn->query("UPDATE tbl_item SET status='deleted' WHERE item_id=$id ") or die ($conn->error);
   
    $get_nameqry = $conn->query("SELECT * FROM tbl_item WHERE item_id=$id ");
    $row = $get_nameqry->fetch_array();
    $item_name = $row['item_name'];

    $save_autrail = $conn->query("INSERT INTO tbl_audittrail (trans_id,trans_type,descs,action,user_id,user_name)
            VALUES('$id','Item','$item_name','delete','$user_id','$user_name')");

    $_SESSION['message']=" Item has been delete!";
    $_SESSION['msg_type']="danger";
    header ("Location:../item.php");

}

if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update_item = true;

    $result = $conn->query("SELECT * FROM tbl_item WHERE item_id =$id ");
    if($result->num_rows == 1) {
        $row = $result->fetch_array();
        $item_name = $row['item_name'];
        $item_code = $row['item_code'];
        $unit = $row['unit'];
        $unit_package=$row['unit_group'];
        $qty_ind = $row['qty'];
        $description = $row['description'];
        $cat_val = '<option value="'.$row["cat_id"].'#'.$row["cat_name"].'"> '.$row["cat_name"].'</option>';
        $remarks = $row['remarks'];
        $divModalonly = " class='modal fade show' aria-modal='true' role='dialog' style='display:block;' ";
    }

}

if(isset($_POST['update_item'])){
    session_start();
    $user_name=$_SESSION['user_name'];
    $user_id=$_SESSION['id'];
    $id= $_POST['item_id'];
    $item_name = $_POST['item_name'];
    $item_code = $_POST['item_code'];
    $category =explode ("#",$_POST['cat_name']);
    $cat_id =$category[0];
    $cat_name =$category[1];
    $unit = $_POST['unit'];
    $qty_ind = $_POST['qty_ind'];
    $unit_package = $_POST['unit_package'];

    $description = $_POST['description'];
    $remarks = $_POST['remarks'];
    // $address = $_POST['address'];

        $conn->query("UPDATE tbl_item SET item_name='".addslashes($item_name)."',unit='$unit',qty='$qty_ind',cat_id='$cat_id',cat_name='$cat_name'
        ,description='$description',item_code='$item_code',unit_group='$unit_package',remarks='$remarks' WHERE item_id=$id ");

        if($conn->error){
            $_SESSION['message']=$conn->error;
            $_SESSION['msg_type']="danger";
            header ("Location:../item.php");

        }else{

            $save_autrail = $conn->query("INSERT INTO tbl_audittrail (trans_id,trans_type,descs,action,user_id,user_name)
            VALUES('$id','Item','".addslashes($item_name)."','update','$user_id','$user_name')");

            $_SESSION['message']=" Item has been updated!";
            $_SESSION['msg_type']="success";
            header ("Location:../item.php");
        }
        
}

if(isset($_GET['close'])){

        $divModal = "class='modal fade' style='display:none;' aria-hidden='true'  ";
        header ("Location:../item.php");

}

if(isset($_POST['submitDel'])){
    if(isset($_POST['id'])){
        
        foreach($_POST['id'] as $id ){
            // echo $id;
            session_start();
            $user_name=$_SESSION['user_name'];
            $user_id=$_SESSION['id'];

            date_default_timezone_set('Asia/Manila');
            $update_date = date("Y-m-d h:i:sa");

            $conn->query("UPDATE tbl_item SET status='deleted', user_id='$user_id',user_name='$user_name',trans_date='$update_date' WHERE item_id='$id' ") or die($conn->error);
            $_SESSION['message']=" Item/s has been delete!";
            $_SESSION['msg_type']="danger";
            header ("Location:../item.php");
        }
    }else{
        header ("Location:../item.php");
    }
}

class Item {
    private $server_name = "localhost";
    private $user_name = "root";
    private $pass = "";
    private $db_name="db_ims_lgusol";

    private $dbConnect = false;

    public function __construct(){
        if(!$this->dbConnect){ 
            $conn = new mysqli($this->server_name, $this->user_name, $this->pass, $this->db_name);
            if($conn->connect_error){
                die("Error failed to connect to MySQL: " . $conn->connect_error);
            }else{
                $this->dbConnect = $conn;
            }
        }
    }

    public function categoryDropdownList(){		
		$sqlQuery = "SELECT * FROM tbl_category 
			WHERE status = 'Active' 
			ORDER BY name ASC";	
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$categoryHTML = '';
		while( $category = mysqli_fetch_assoc($result)) {
			$categoryHTML .= '<option value="'.$category["cat_id"].'">'.$category["cat_name"].'</option>';	
		}
        echo 'test';
		return $categoryHTML;
	}

    public function getCategory(){
        $sqlQuery ="SELECT * FROM tbl_category WHERE status='Active' ORDER BY cat_name ASC";
        $result= mysqli_query($this->dbConnect, $sqlQuery);	
        $categoryHTML = '';
        while( $category = mysqli_fetch_assoc($result)) {
			$categoryHTML .= '<option value="'.$category["cat_id"].'#'.$category["cat_name"].'"> '.$category["cat_name"].'</option>';	
		}
        return $categoryHTML;
    }

    public function getSupplier(){
        $sqlQuery ="SELECT * FROM tbl_supplier WHERE status='Active' ORDER BY supplier_name ASC";
        $result= mysqli_query($this->dbConnect, $sqlQuery);	
        $supplierHTML = '';
        while( $supplier = mysqli_fetch_assoc($result)) {
			$supplierHTML .= '<option value="'.$supplier["sup_id"].'#'.$supplier["supplier_name"].'">'.$supplier["supplier_name"].'</option>';	
		}
        return $supplierHTML;
    }

  
}

