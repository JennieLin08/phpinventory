<?php

include('db_conn.php');

$cat_select_id =0;
$cat_select_name ='All';

if(isset($_GET['category']) && $_GET['category'] !='All' ){ 
    $category_select=explode("#>",$_GET['category']);
    $cat_select_id = $category_select[0];
    $cat_select_name = $category_select[1];
}

if (isset($_POST['save_item'])){
    session_start();
    $item =explode ("#>",$_POST['item_name']);
    $item_id = $item[0];
    $item_name = $item[1];

    $category_val = $conn->query("SELECT cat_id,unit_group,qty,cat_name,item_code FROM tbl_item where item_id='$item_id' LIMIT 1") or die ($conn->error);
    $cat_row = $category_val->fetch_array();
    $cat_id =$cat_row['cat_id'];
    $cat_name =$cat_row['cat_name'];
    $item_code =$cat_row['item_code'];
    $get_unit_group = $cat_row['unit_group'];
    $get_qty_ind = $cat_row['qty'];

    $supplier =explode ("#>",$_POST['sup_name']);
    $sup_id = $supplier[0];
    $sup_name = $supplier[1];
    $description = $_POST['description'];
    $unit = $_POST['unit'];
    $qty = $_POST['qty'];
    $unit_2 = $_POST['unit_2'];
    $qty_2 = $_POST['qty_2'];
    
    if($get_unit_group == $unit){
        $qty_ind_1 = $_POST['qty'] * $get_qty_ind;
                
    }else{
        $qty_ind_1 = $_POST['qty'];
    }

    if($get_unit_group == $unit_2){
        $qty_ind_2 = $_POST['qty_2'] * $get_qty_ind;
        
    }else{
        $qty_ind_2 = $_POST['qty_2'];
    }

    $qty_ind = $qty_ind_1 + $qty_ind_2;
    $total = ($_POST['amount'] * $_POST['qty'] ) + ($_POST['amount_2'] * $_POST['qty_2'] );
    // echo $total;
    $amount = $_POST['amount'];
    $amount_2 =$_POST['amount_2'];

    $eul = $_POST['eul'];
    $trans_date = $_POST['date'];
    $remarks = $_POST['remarks'];
    $user_name=$_SESSION['user_name'];
    $user_id=$_SESSION['id'];
    
 
   $conn->query("INSERT INTO tbl_itemtrans(trans_type,item_id,item_name,item_code,cat_id,cat_name,sup_id,sup_name,description,qty,qty_ind,qty_2,unit,unit_2,amount,amount_2,total,trans_date,remarks,status,eul,warehouse,user_name,user_id) 
    VALUES('add','$item_id','".addslashes($item_name)."','$item_code','$cat_id','$cat_name','$sup_id','".addslashes($sup_name)."','".addslashes($description)."','$qty','$qty_ind','$qty_2','$unit','$unit_2','$amount','$amount_2','$total','$trans_date','$remarks','Active','$eul','Main','$user_name','$user_id')");

    if($conn->error){

        $_SESSION['message']=$conn->error;
        $_SESSION['msg_type']="warning";
        header ("Location:../addstock.php");

    }else{
        $save_autrail = $conn->query("INSERT INTO tbl_audittrail (trans_type,descs,action,user_id,user_name)
                VALUES('add transaction','".addslashes($item_name)."','Add','$user_id','$user_name')");

    $_SESSION['message']=" Transaction has been saved!";
    $_SESSION['msg_type']="success";
    header ("Location:../addstock.php");
    }
    
}

if(isset($_GET['delete'])){
    session_start();
    $user_name=$_SESSION['user_name'];
    $user_id=$_SESSION['id'];

    date_default_timezone_set('Asia/Manila');
    $update_date = date("Y-m-d h:i:sa");

    $id = $_GET['delete'];
    $conn->query("UPDATE tbl_itemtrans SET status='deleted',user_id='$user_id',
    user_name='$user_name',date_update='$update_date' WHERE id=$id ") or die ($conn->error);
    

    $get_nameqry = $conn->query("SELECT * FROM tbl_itemtrans WHERE id=$id ");
    $row = $get_nameqry->fetch_array();
    $item_name = $row['item_name'];
    $save_autrail = $conn->query("INSERT INTO tbl_audittrail (trans_id,trans_type,descs,action,user_id,user_name)
            VALUES('$id','add transaction','$item_name','delete','$user_id','$user_name')");

    $_SESSION['message']=" Transaction has been delete!";
    $_SESSION['msg_type']="danger";
    header ("Location:../addstock.php");

}

if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update_stock = true;
    

    $result = $conn->query("SELECT * FROM tbl_itemtrans WHERE id ='$id' ");
    if($result->num_rows == 1) {
        $row = $result->fetch_array();
        $item_val = '<option value="'.$row["item_id"].'#>'.$row["item_name"].'">'.$row["item_name"].'</option>';
        // $cat_val = '<option value="'.$row["cat_id"].'#>'.$row["cat_name"].'">'.$row["cat_name"].'</option>';
        $sup_val = '<option value="'.$row["sup_id"].'#>'.$row["sup_name"].'">'.$row["sup_name"].'</option>';
        $date = $row['trans_date'];
        $item_code = $row['item_code'];
        $description = $row['description'];
        $eul = $row['eul'];
        $qty = $row['qty'];
        $unit = $row['unit'];
        $amount = $row['amount'];
        $qty_2 = $row['qty_2'];
        $unit_2 = $row['unit_2'];
        $amount_2 = $row['amount_2'];
        $total_1 = $qty * $amount;
        $total_2 = $qty_2 * $amount_2;
        $gtotal = $total_1 +  $total_2;
        $remarks = $row['remarks'];

        $divModal = " class='modal fade show' aria-modal='true' role='dialog' style='display:block;' "; 
        
    }

}




if(isset($_POST['update_item'])){
    session_start();
    date_default_timezone_set('Asia/Manila');
    $update_date = date("Y-m-d h:i:sa");
    $user_name=$_SESSION['user_name'];
    $user_id=$_SESSION['id'];

    $id= $_POST['trans_id'];
    $item =explode ("#>",$_POST['item_name']);
    $item_id = $item[0];
    $item_name = $item[1];
    
    $supplier =explode ("#>",$_POST['sup_name']);
    $sup_id = $supplier[0];
    $sup_name = $supplier[1];
    $description = $_POST['description'];
    $trans_date = $_POST['date'];
    $remarks = $_POST['remarks'];
    $eul = $_POST['eul'];

    $item_unit = $conn->query("SELECT item_id,unit_group,qty FROM tbl_item where item_id='$item_id' LIMIT 1") or die ($conn->error);
    $item_unit_row = $item_unit->fetch_array();
    $unit_group = $item_unit_row['unit_group'];
    $get_qty_ind = $item_unit_row['qty'];
    $qty = $_POST['qty'];
    $unit = $_POST['unit'];
    $unit_2 = $_POST['unit_2'];
    $qty_2 = $_POST['qty_2'];

    if($unit_group == $unit){
        $qty_ind_1 = $_POST['qty'] * $get_qty_ind;
    }else{
        $qty_ind_1 = $_POST['qty'];
    }

    if($get_unit_group == $unit_2){
        $qty_ind_2 = $_POST['qty_2'] * $get_qty_ind;
        
    }else{
        $qty_ind_2 = $_POST['qty_2'];
    }

    $qty_ind = $qty_ind_1 + $qty_ind_2;
    $total = ($_POST['amount'] * $_POST['qty'] ) + ($_POST['amount_2'] * $_POST['qty_2'] );
    $amount = $_POST['amount'];
    $amount_2 =$_POST['amount_2'];

        $conn->query("UPDATE tbl_itemtrans SET item_id='$item_id',item_name='".addslashes($item_name)."',
                   sup_id='$sup_id',sup_name='".addslashes($sup_name)."',description='".addslashes($description)."',eul='$eul',
                    qty='$qty',qty_2='$qty_2',qty_ind='$qty_ind',unit='$unit',unit_2='$unit_2',amount='$amount',amount_2='$amount_2',total='$total',trans_date='$trans_date',remarks='$remarks',
                    user_name='$user_name',user_id='$user_id',date_update='$update_date' 
                    WHERE id=$id ");

                    if($conn->error){

                        $_SESSION['message']=$conn->error;
                        $_SESSION['msg_type']="warning";
                        header ("Location:../addstock.php");
                
                    }else{
                        $save_autrail = $conn->query("INSERT INTO tbl_audittrail (trans_id,trans_type,descs,action,user_id,user_name)
                            VALUES('$id','add transaction','$item_name','update','$user_id','$user_name')");

                        $_SESSION['message']=" Transaction has been updated!";
                        $_SESSION['msg_type']="success";
                        header ("Location:../addstock.php");

                    }
        
}

if(isset($_GET['close'])){

        $divModal = "class='modal fade' style='display:none;' aria-hidden='true'  ";
        header ("Location:../addstock.php");

}

if(isset($_POST['submitDel'])){
    if(isset($_POST['id'])){
        foreach($_POST['id'] as $id ){
            session_start();
            $user_name=$_SESSION['user_name'];
            $user_id=$_SESSION['id'];
        
            date_default_timezone_set('Asia/Manila');
            $update_date = date("Y-m-d h:i:sa");

            // $conn->query("UPDATE tbl_item SET status='deleted' WHERE item_id=$id ") or die($conn->error);

            // $conn->query("UPDATE tbl_itemtrans SET status='deleted',user_id='$user_id',
            //         user_name='$user_name',date_update='$update_date' WHERE id=$id "); or die ($conn->error);
            $conn->query("UPDATE tbl_itemtrans SET status='deleted',user_id='$user_id',
            user_name='$user_name',date_update='$update_date' WHERE id='$id' ") or die ($conn->error);
            $_SESSION['message']=" Transaction/s has been delete!";
            $_SESSION['msg_type']="danger";
            header ("Location:../addstock.php");
        }
    }else{
        header ("Location:../addstock.php");
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
			$categoryHTML .= '<option value="'.$category["cat_id"].'#>'.$category["cat_name"].'"> '.$category["cat_name"].'</option>';	
		}
        return $categoryHTML;
    }

    public function getSupplier(){
        $sqlQuery ="SELECT * FROM tbl_supplier WHERE status='Active' ORDER BY supplier_name ASC";
        $result= mysqli_query($this->dbConnect, $sqlQuery);	
        $supplierHTML = '';
        while( $supplier = mysqli_fetch_assoc($result)) {
			$supplierHTML .= '<option value="'.$supplier["sup_id"].'#>'.$supplier["supplier_name"].'">'.$supplier["supplier_name"].'</option>';	
		}
        return $supplierHTML;
    }

    public function getItem(){
        $sqlQuery ="SELECT * FROM tbl_item WHERE status='Active' ORDER BY item_name ASC";
        $result= mysqli_query($this->dbConnect, $sqlQuery);	
        $itemHTML = '';
        while( $item = mysqli_fetch_assoc($result)) {
			$itemHTML .= '<option value="'.$item["item_id"].'#>'. htmlspecialchars($item["item_name"]).'#>'.$item['unit'].'#>'.htmlspecialchars($item['description']).'#>'.$item['unit_group'].'#>'.$item['cat_id'].'">'.htmlspecialchars($item["item_name"]).'</option>';	
		}
        return $itemHTML;
    }
}

