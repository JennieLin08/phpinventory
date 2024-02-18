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


    $id = 0;
    $update_stock = false;
    $item_val = '';
    $item_code='';
    $cat_val = '';
    $sup_val = '';
    $description = '';
    $qty = 0;
    $unit = '';
    $description='';
    $amount=0;
    $remarks='';

    $date = '';  

    $divModal = "class='modal fade' style='display:none;' aria-hidden='true' ";
    
    require_once '../controller/itemtranslist_controller.php';
    $item = new Item();
    $item_transid = $_GET['show'];
    $item_transname = $conn->query("SELECT item_name FROM tbl_itemtrans WHERE status='Active' and item_id='$item_transid LIMIT 1' ");
    $name= $item_transname->fetch_array();

    $res = $conn->query("SELECT *,ROW_NUMBER() OVER(ORDER BY date_created ASC) AS Row FROM tbl_itemtrans WHERE status='Active' and item_id='$item_transid ' ") or die($conn->error);
   

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
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-6">
									<h3 class="card-title"><?php echo strtoupper($name['item_name']); ?></h3>
							</div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 text-end">
                                <a href="../home.php" class="btn btn-primary btn-sm bg-gradient rounded-0 back">back</a>
                                <button type="button" name="print" onclick="window.print();" id="print-btn" class="btn btn-primary btn-sm bg-gradient rounded-0"> <i class="fa-solid fa-print"></i></button>   		
                            </div>
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
                                        <th>TRANS ID</th>
                                        <th>ITEM</th>
                                        <th>ITEM CODE</th>
                                        <th>TRANS TYPE</th>
                                        <th>EMPLOYEE</th>
                                        <th>CATEGORY</th>
                                        <th>SUPPLIER</th>
                                        <th>ADD</th>
                                        <th>OUT</th>
                                        <th>UNIT</th>
                                        <th>AMOUNT</th>
                                        <th>TOTAL</th>
                                        <th>EUL</th>
                                        <th>REMARKS</th>
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
                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php echo $row['item_name']; ?></td>
                                        <td><?php echo $row['item_code']; ?></td>
                                        <td><?php echo $row['trans_type']; ?></td>
                                        <td><?php echo $row['emp_name']; ?></td>

                                        <td><?php echo $row['cat_name']; ?></td>
                                        <td><?php echo $row['sup_name']; ?></td>
                                        <td><?php echo $row['qty']; ?></td>
                                        
                                        <td><?php echo $row['release_qty']; ?></td>
                                        <td><?php echo $row['unit']; ?></td>
                                        <td><?php echo number_format($row['amount'],2); ?></td>
                                        <td><?php echo number_format($row['total'],2); ?></td>
                                        <td><?php echo $row['eul']; ?></td>
                                        <td><?php echo $row['remarks']; ?></td>
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






