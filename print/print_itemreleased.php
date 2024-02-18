<!DOCTYPE html>
<html>
<head>
<title>print </title>
 <!-- Font Awesome -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Bootstrap -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="../assets/style.css">
<link rel="stylesheet" href="../assets/print.css" media="print">
<!-- Font Awesome -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<!-- jQuery -->
<?php
session_start();

    $divModal = "class='modal fade' style='display:none;' aria-hidden='true' ";
    
    require_once '../controller/print_itemreleased_controller.php';
    $item = new Item();
    // $item_transid = $_GET['show'];
    // $item_transname = $conn->query("SELECT item_name FROM tbl_itemtrans WHERE status='Active' and item_id='$item_transid LIMIT 1' ");
    // $name= $item_transname->fetch_array();

    $date_from = $_GET['date_from'];
    $date_to = $_GET['date_to'];
    // echo $date_to .' /'. $date_from . ' /' .$_GET['filter_name'].'/ '.$_GET['filter_category'] ;
    if($_GET['filter_category']=='All' && $_GET['filter_name']=='All'){
        $item_name = 'All';
        $cat_val = 'All';
        $res = $conn->query("SELECT *,ROW_NUMBER() OVER(ORDER BY item_name ASC) AS Row FROM tbl_itemtrans WHERE status='Active' AND trans_type='Released' AND trans_date BETWEEN '$date_from' AND '$date_to'  ") or die($conn->error);
    }elseif($_GET['filter_category']!='All' && $_GET['filter_name']=='All'){
        $item_name = 'All';
        $cat_val = explode('#>',$_GET['filter_category']);
        $cat_id = $cat_val[0];
        $cat_name = $cat_val[1];
        $res = $conn->query("SELECT *,ROW_NUMBER() OVER(ORDER BY item_name ASC) AS Row FROM tbl_itemtrans WHERE status='Active' 
        AND trans_type='Released' AND cat_id = '$cat_id' AND trans_date BETWEEN '$date_from' AND '$date_to' ") or die($conn->error);

    }elseif($_GET['filter_category']=='All' && $_GET['filter_name']!='All'){
        $item_val = explode('#>',$_GET['filter_name']);
        $item_id = $item_val[0];
        $item_name = $item_val[1];
        $cat_name='All';
        $res = $conn->query("SELECT *,ROW_NUMBER() OVER(ORDER BY item_name ASC) AS Row FROM tbl_itemtrans WHERE status='Active' 
        AND trans_type='Released' AND item_id = '$item_id' AND trans_date BETWEEN '$date_from' AND '$date_to' ") or die($conn->error);
    }else{
      
        $item_val = explode('#>',$_GET['filter_name']);
        $item_id = $item_val[0];
        $item_name = $item_val[1];
        $cat_val = explode('#>',$_GET['filter_category']);
        $cat_id = $cat_val[0];
        $cat_name = $cat_val[1];

        $res = $conn->query("SELECT *,ROW_NUMBER() OVER(ORDER BY item_name ASC) AS Row FROM tbl_itemtrans WHERE status='Active' 
        AND trans_type='Released' AND item_id = '$item_id' and cat_id = '$cat_id' AND trans_date BETWEEN '$date_from' AND '$date_to' ") or die($conn->error);
    }
    

    
   

?>

<?php     
// include('template/container.php'); 
// include('menus.php');
if(isset($_SESSION['type']) && isset($_SESSION['email'])){
?>
<div>
<div class="row">
		<div class="col-lg-12">
			    <div class="card card-default rounded-0 shadow">
                    <div class="card-header">
                        <div class="row">
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-6 ">
									<h3 class="card-title">RELEASED ITEM/S</h3>
							</div>
                            
                            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 text-end">
                                <a href="../release.php" class="btn btn-primary btn-sm bg-gradient rounded-0 back">back</a>
                                <button type="button" name="print" onclick="window.print();" id="print-btn" class="btn btn-primary btn-sm bg-gradient rounded-0"> <i class="fa-solid fa-print"></i></button>   		
                            </div>
					    </div>
                        <div class="col-lg-3 col-md-8 col-sm-8 col-xs-6 ">
                            <h6 class="card-title">ITEM NAME : <?php if($item_name != 'All'){echo $item_name;}else{echo 'All';} ?></h6>
							</div>
                        <div class="col-lg-3 col-md-8 col-sm-8 col-xs-6 ">
							<h6 class="card-title">CATEGORY : <?php echo $cat_name; ?> </h6>
						</div>
                        <div class="col-lg-3 col-md-8 col-sm-8 col-xs-6 ">
							<h6 class="card-title">DATE FROM : <span><?php echo $date_from.' '; ?> TO: <?php echo $date_to; ?> </span></h6> 
						</div>   				 
                    <div style="clear:both"></div>
                </div>
                <div class="card card-default rounded-0 shadow">
                </div>
                <div class="card-body">
                    <div class="row">
                    	<div class="col-sm-12 table-responsive">
                    		<table id="itemList" class="table table-bordered table-striped">
                    			<thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>EMPLOYEE</th>
                                        <th>ITEM</th>
                                        <th>ITEM CODE</th>
                                        <th>CATEGORY</th>
                                        <th>QTY</th>
                                        <th>TRANS_DATE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $total_qty=0;

                                    while ($row=$res->fetch_assoc()): 
                                    ?>
                                    <tr>
                                        <td><?php echo $row['Row']; ?></td>
                                        <td><?php echo $row['emp_name']; ?></td>
                                        <td><?php echo $row['item_name']; ?></td>
                                        <td><?php echo $row['item_code']; ?></td>
                                        <td><?php echo $row['cat_name']; ?></td>
                                        <td><?php echo $row['release_qty'] . ' '. $row['unit']; ?></td>
                                        <td><?php echo 
                                        date("m-d-Y", strtotime($row['trans_date']));
                                         ?></td>
                                       
                                    </tr>  
                                    <?php endwhile; ?> 
                                </tbody>
                    		</table>
                    	</div>
                    </div>
                </div>
            </div>
        </div>
    </div>














<?php 
} 
else{
    header("Location: index.php");
}
?>






