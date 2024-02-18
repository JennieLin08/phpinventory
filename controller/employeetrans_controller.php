<?php

include('db_conn.php');

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

    public function getItem(){
        $sqlQuery ="SELECT * FROM tbl_item WHERE status='Active' ORDER BY item_name ASC";
        $result= mysqli_query($this->dbConnect, $sqlQuery);	
        $itemHTML = '';
        while( $item = mysqli_fetch_assoc($result)) {
			$itemHTML .= '<option value="'.$item["item_id"].'#'.$item["item_name"].'">'.$item["item_name"].'</option>';	
		}
        return $itemHTML;
    }

    public function getEmp(){
        $sqlQuery ="SELECT * FROM tbl_employee WHERE status='Active' ORDER BY name ASC";
        $result= mysqli_query($this->dbConnect, $sqlQuery);	
        $empHTML = '';
        while( $emp = mysqli_fetch_assoc($result)) {
			$empHTML .= '<option value="'.$emp["emp_id"].'#'.$emp["name"].'">'.$emp["name"].'</option>';	
		}
        return $empHTML;
    }

    public function getcategoryId(){
        $sqlQuery ="SELECT * FROM tbl_category WHERE status='Active' ORDER BY name ASC";
        $result= mysqli_query($this->dbConnect, $sqlQuery);	
        $empHTML = '';
        while( $emp = mysqli_fetch_assoc($result)) {
			$empHTML .= '<option value="'.$emp["emp_id"].'">'.$emp["name"].'</option>';	
		}
        return $empHTML;
    }
}

