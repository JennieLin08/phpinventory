<?php

include('db_conn.php');

if(isset($_GET['page_no']) && $_GET['page_no']!==""){
    $page_no=$_GET['page_no'];
}else{
    $page_no=1;
}



// $qry_res = $conn->query("SELECT id,item_id,cat_name,item_name,sum(qty) as total_qty,sum(total) as total,sum(release_qty) as release_qty, sum(qty-release_qty) as avail_stocks,  date_created FROM tbl_itemtrans WHERE status='Active' GROUP BY item_id,item_name;") or die($conn->error);
$qry_res = $conn->query("SELECT * FROM view_home_invlist;") or die($conn->error);
$total_records = mysqli_num_rows($qry_res);
// echo $total_records;
$records_page = $total_records;
$offset = ($page_no-1)*$records_page;
$prev_page = $page_no-1;
$next_page = $page_no+1; 

$total_pages = ceil($total_records/$records_page);

$cat_select_id =0;
$cat_select_name ='All';

if(isset($_GET['category']) && $_GET['category'] !='All' ){ 
$category_select=explode("#",$_GET['category']);
$cat_select_id = $category_select[0];
$cat_select_name = $category_select[1];
}


if(isset($_GET['close'])){

    $filterModal = "class='modal fade' style='display:none;' aria-hidden='true'  ";
    header ("Location:../home.php");

}

// if(isset($_GET['filter_inv'])){
    //     $col_name = $_GET['col_name'];
    //     $order = $_GET['order'];
    //     $date_from = $_GET['date_from'];
    //     $date_to = $_GET['date_to'];
    // if($_GET['category']=='All'){
    //     $res = $conn->query("SELECT ROW_NUMBER() OVER(ORDER BY avail_stocks ASC) AS Row,
    //                                         i.id,i.cat_id,i.item_id,i.cat_name,i.item_name,sum(i.qty) as total_qty,
    //                                         sum(i.total) as total,sum(i.release_qty) as release_qty, sum(i.qty-i.release_qty) as avail_stocks,
    //                                         d.tdate as date_created FROM tbl_itemtrans as i JOIN 
    //                                         (SELECT item_id,item_name,max(trans_date) as tdate
    //                                         FROM `tbl_itemtrans` WHERE trans_type='add' AND status='Active' GROUP BY item_id,item_name) as d 
    //                                         ON d.item_id=i.item_id 
    //                                         WHERE status='Active' AND date_created BETWEEN '$date_from' 
    //                                         AND '$date_to'  GROUP BY item_id,item_name ORDER BY `$col_name` $order LIMIT $offset,$records_page;
    //                                         ") or die($conn->error);


    // }else{
    //     $cat_val = explode("#",$_GET['category']);
    //     $cat_id = $cat_val[0];
    //     $cat_name = $cat_val[1];
        

    //     $res = $conn->query("SELECT ROW_NUMBER() OVER(ORDER BY avail_stocks ASC) AS Row,
    //                                         i.id,i.cat_id,i.item_id,i.cat_name,i.item_name,sum(i.qty) as total_qty,
    //                                         sum(i.total) as total,sum(i.release_qty) as release_qty, sum(i.qty-i.release_qty) as avail_stocks,
    //                                         d.tdate as date_created FROM tbl_itemtrans as i JOIN 
    //                                         (SELECT item_id,item_name,max(trans_date) as tdate
    //                                         FROM `tbl_itemtrans` WHERE trans_type='add' AND status='Active' GROUP BY item_id,item_name) as d 
    //                                         ON d.item_id=i.item_id 
    //                                         WHERE status='Active' AND cat_id='$cat_id' AND trans_date BETWEEN '$date_from' 
    //                                         AND '$date_to'  GROUP BY item_id,item_name ORDER BY `$col_name` $order LIMIT $offset,$records_page;
    //                                         ") or die($conn->error);

    // }
    
                
                // header ("Location:../home.php");



// }

class Item {
    private $server_name = "localhost";
    private $user_name = "root";
    private $pass = "";
    private $db_name="db_ims_lgusol";
    // private $conn = mysqli_connect($server_name,$user_name,$pass,$db_name);
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

