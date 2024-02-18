<?php


include('db_conn.php');

$onch_item_id = 0;

$cat_select_id =0;
$cat_select_name ='All';

if(isset($_GET['category']) && $_GET['category'] !='All' ){ 
$category_select=explode("#",$_GET['category']);
$cat_select_id = $category_select[0];
$cat_select_name = $category_select[1];
}


if (isset($_POST['save_item'])){
    session_start();
    $user_name=$_SESSION['user_name'];
    $user_id=$_SESSION['id'];

    $item =explode ("#",$_POST['item_name']);
    $trans_id = $item[0];
    $total_release_qty = $item[2];

    $trans_val = $conn->query("SELECT * FROM tbl_itemtrans where id='$trans_id' LIMIT 1") or die ($conn->error);
    $row = $trans_val->fetch_array();
    $item_id = $row['item_id'];
    $item_name = $row['item_name'];
    $item_code =$row['item_code'];
    $cat_id = $row['cat_id'];
    $cat_name = $row['cat_name'];
    $description = $row['description'];
    $release_qty = $_POST['qty'];
    $unit = $row['unit'];
    $amount = $row['amount'];
    $rls_total = $row['rls_total'];
    $qty_rls_ind = $row['qty_rls_ind'];

    $trans_date = $_POST['date'];
    $remarks = $_POST['remarks'];
  

    $emp =explode ("#",$_POST['emp_name']);
    $emp_id = $emp[0];
    $emp_name = $emp[1];

    $from_id = $row['emp_id'];
    $from_name = $row['emp_name'];

    $update_remarks = $row['remarks'] . ' / (' . $release_qty . ') Transferred to ' . $emp_name; 
 
   $conn->query("INSERT INTO tbl_itemtrans(trans_type,emp_id,emp_name,item_id,item_name,item_code,cat_id,cat_name,description,qty_rls_ind,release_qty,unit,amount,rls_total,trans_date,remarks,status,user_name,user_id,ref_id,from_id,from_name) 
    VALUES('Transfer','$emp_id','$emp_name','$item_id','$item_name','$item_code','$cat_id','$cat_name','$description','$release_qty','$release_qty','$unit','$amount','$rls_total','$trans_date','$remarks','Active','$user_name','$user_id','$trans_id','$from_id','$from_name')")  
    or die ($conn->error);

    $update_release_qty = $total_release_qty - $release_qty;
   
    $update_trans = $conn->query("UPDATE tbl_itemtrans SET qty_rls_ind='$update_release_qty',release_qty='$update_release_qty', remarks='$update_remarks' WHERE id='$trans_id' ")  or die ($conn->error);
    if($conn->error){

        $_SESSION['message']=$conn->error;
        $_SESSION['msg_type']="warning";
        header ("Location:../mrtransfer.php");

    }else{
        $item_emp= $item_name .' / '. $emp_name;
        $save_autrail = $conn->query("INSERT INTO tbl_audittrail (trans_type,descs,action,user_id,user_name)
                VALUES('MR Transfer','$item_emp','Transfer','$user_id','$user_name')");
    $_SESSION['message']=" Transaction has been saved!";
    $_SESSION['msg_type']="success";
    header ("Location:../mrtransfer.php");

    }
    
}

if(isset($_GET['delete'])){
    session_start();
    $user_name=$_SESSION['user_name'];
    $user_id=$_SESSION['id'];

    date_default_timezone_set('Asia/Manila');
    $update_date = date("Y-m-d h:i:sa");

    $id = $_GET['delete'];
    $conn->query("UPDATE tbl_itemtrans SET status='deleted', user_id='$user_id', user_name='$user_name',date_update='$update_date' 
    WHERE id=$id ") or die ($conn->error);
    

    $get_nameqry = $conn->query("SELECT * FROM tbl_itemtrans WHERE id=$id ");
        $row = $get_nameqry->fetch_array();
        $item_name = $row['item_name'];
        $emp_name = $item_name .' / '. $row['emp_name'];
        $save_autrail = $conn->query("INSERT INTO tbl_audittrail (trans_id,trans_type,descs,action,user_id,user_name)
        VALUES('$id','Transfer transaction','$emp_name','delete','$user_id','$user_name')");

    $_SESSION['message']=" Transaction has been deleted!";
    $_SESSION['msg_type']="danger";
    header ("Location:../mrtransfer.php");

}

if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update_stock = true;


    

    $result = $conn->query("SELECT * FROM tbl_itemtrans WHERE id ='$id' ");

    if($result->num_rows == 1) {
        $row = $result->fetch_array();
        $cat_val = '<option value="'.$row["cat_id"].'#'.$row["cat_name"].'">'.$row["cat_name"].'</option>';
        $emp_val = '<option value="'.$row["emp_id"].'#'.$row["emp_name"].'">'.$row["emp_name"].'</option>';
        $item_id_val = $row['item_id'];
        $date = $row['trans_date'];
        $item_code = $row['item_code'];
        $description = $row['description'];
        $qty = $row['release_qty'];
        $unit = $row['unit'];
        $amount = $row['amount'];
        $remarks = $row['remarks'];

        $divModal = " class='modal fade show' aria-modal='true' role='dialog' style='display:block;' "; 
        
    }

    $get_itemval = $conn->query("SELECT i.item_id,i.item_name, t.avail_stocks FROM tbl_item as i 
        JOIN (SELECT id,item_id,cat_name,item_name,sum(qty) as total_qty,sum(total) as total,sum(release_qty) as release_qty,
         sum(qty-release_qty) as avail_stocks,  date_created FROM tbl_itemtrans WHERE status='Active' 
        GROUP BY item_id,item_name) as t WHERE t.item_id = i.item_id AND i.item_id='$item_id_val'") or die($conn->error);
    $row_itemval = $get_itemval->fetch_array();
    $item_val = '<option value="'.$row_itemval["item_id"].'#'.$row_itemval["item_name"].'#'.$row_itemval["avail_stocks"].'">'.$row_itemval["item_name"]. '</option>';	

}




if(isset($_POST['update_item'])){
    session_start();
    date_default_timezone_set('Asia/Manila');
    $update_date = date("Y-m-d h:i:sa");
    $id= $_POST['trans_id'];
    $item =explode ("#",$_POST['item_name']);
    $item_id = $item[0];
    $item_name = $item[1];

    $category_val = $conn->query("SELECT cat_id,cat_name FROM tbl_item where item_id='$item_id' LIMIT 1") or die ($conn->error);
    $cat_row = $category_val->fetch_array();
    $cat_id =$cat_row['cat_id'];
    $cat_name =$cat_row['cat_name'];

    $item_code =$_POST['item_code'];

    $employee =explode ("#",$_POST['emp_name']);
    $emp_id = $employee[0];
    $emp_name = $employee[1];

    $supplier =explode ("#",$_POST['sup_name']);
    $sup_id = $supplier[0];
    $sup_name = $supplier[1];
    $description = $_POST['description'];
    $release_qty = $_POST['qty'];
    $unit = $_POST['unit'];
    $amount = $_POST['amount'];
    $rls_total = $_POST['amount'] * $_POST['qty'];
    $trans_date = $_POST['date'];
    $remarks = $_POST['remarks'];
    $user_name=$_SESSION['user_name'];
    $user_id=$_SESSION['id'];

        $conn->query("UPDATE tbl_itemtrans SET emp_id='$emp_id',emp_name='$emp_name',item_id='$item_id',item_name='$item_name',item_code='$item_code',cat_id='$cat_id',
                    cat_name='$cat_name',description='$description',user_id='$user_id',user_name='$user_name',
                    release_qty='$release_qty',unit='$unit',amount='$amount',rls_total='$rls_total',trans_date='$trans_date',remarks='$remarks',date_update='$update_date'
                    WHERE id=$id ");

        if($conn->error){
            $_SESSION['message']=$conn->error;
            $_SESSION['msg_type']="warning";
            header ("Location:../mrtransfer.php");

        }else{
            $item_emp = $item_name . ' / '. $emp_name;
            $save_autrail = $conn->query("INSERT INTO tbl_audittrail (trans_id,trans_type,descs,action,user_id,user_name)
                            VALUES('$id','Transfer transaction','$item_emp','update','$user_id','$user_name')");


            $_SESSION['message']=" Transaction has been updated!";
            $_SESSION['msg_type']="success";
            header ("Location:../mrtransfer.php");

        }
        
}

if(isset($_GET['close'])){

        $divModal = "class='modal fade' style='display:none;' aria-hidden='true'  ";
        header ("Location:../mrtransfer.php");

}

if(isset($_GET['item_id'])){
    
    $onch_item_id = $_GET['item_id'];

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

    // public function getItem(){
    //     $sqlQuery ="SELECT * FROM tbl_item WHERE status='Active' ORDER BY item_name ASC";
    //     $result= mysqli_query($this->dbConnect, $sqlQuery);	
    //     $itemHTML = '';
    //     while( $item = mysqli_fetch_assoc($result)) {
	// 		$itemHTML .= '<option value="'.$item["item_id"].'#'.$item["item_name"].'">'.$item["item_name"].'</option>';	
	// 	}
    //     return $itemHTML;
    // }

    public function getEmp(){
        $sqlQuery ="SELECT * FROM tbl_employee WHERE status='Active' ORDER BY name ASC";
        $result= mysqli_query($this->dbConnect, $sqlQuery);	
        $empHTML = '';
        while( $emp = mysqli_fetch_assoc($result)) {
			$empHTML .= '<option value="'.$emp["emp_id"].'#'.$emp["name"].'">'.$emp["name"].'</option>';	
		}
        return $empHTML;
    }

    public function getStocksAvail(){

        $sqlQuery = "SELECT i.item_id,i.item_name, t.avail_stocks FROM tbl_item as i 
        JOIN (SELECT id,item_id,cat_name,item_name,sum(qty) as total_qty,sum(total) as total,
        sum(release_qty) as release_qty, sum(qty-release_qty) as avail_stocks,  date_created 
        FROM tbl_itemtrans WHERE status='Active' GROUP BY item_id,item_name) as t WHERE t.item_id = i.item_id";

        $result= mysqli_query($this->dbConnect, $sqlQuery);	
        $itemHTML = '';
        while( $item = mysqli_fetch_assoc($result)) {
			$itemHTML .= '<option value="'.$item["item_id"].'#'.$item["item_name"].'#'.$item["avail_stocks"].'">'.$item["item_name"]. '</option>';	
		}
        return $itemHTML;
    }

    public function itemandMR(){
        
        $sqlQuery = "SELECT * FROM `tbl_itemtrans` WHERE trans_type !='add' AND release_qty>0 AND status='Active'";

        $result= mysqli_query($this->dbConnect, $sqlQuery);	
        $itemHTML = '';
        while( $trans = mysqli_fetch_assoc($result)) {
			$itemHTML .= '<option value="'.$trans["id"].'#'.$trans["item_name"].'#'.$trans["release_qty"].'">'.$trans["item_name"].'/'. $trans["emp_name"] .'</option>';	
		}
        return $itemHTML;
    }
}

