<!DOCTYPE html>
<html>
<head>
<title>pdf </title>
 <!-- Font Awesome -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Bootstrap -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!-- <link rel="stylesheet" href="assets/style.css"> -->
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
    $cnt = 1;
 
    $date = '';  

    $divModal = "class='modal fade' style='display:none;' aria-hidden='true' ";
    
    require_once '../controller/employeetrans_controller.php';
    $item = new Item();
    $emp_transid = $_GET['id'];
    $emp_transname = $conn->query("SELECT name FROM tbl_employee WHERE emp_id='$emp_transid'");
    $name= $emp_transname->fetch_array();
    
    // $res = $conn->query("SELECT * FROM tbl_itemtrans WHERE status='Active' and emp_id='$emp_transid' GROUP BY item_name ORDER BY item_name,date_created ASC;") or die($conn->error);
    $res = $conn->query("SELECT * FROM tbl_itemtrans WHERE status='Active' and emp_id='$emp_transid' ORDER BY item_name,date_created ASC;") or die($conn->error);
    
    

?>

<?php     
if(isset($_SESSION['type']) && isset($_SESSION['email'])){
?>
<div>
<div class="row">
		<div class="col-lg-12">
			    <div class="card card-default rounded-0 shadow">
                    <div class="card-header">
                        <div class="row">
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-6">
									<h3 class="card-title"><?php echo strtoupper($name['name']); ?></h3>
							</div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 text-end">
                                <a href="../employee.php" class="btn btn-primary btn-sm bg-gradient rounded-0 back">back</a>
                                <button type="button" name="print" onclick="window.print();" id="print-btn" class="btn btn-primary btn-sm bg-gradient rounded-0"> Print</button>   		
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
                                        <th>No.</th>
                                        <th>Item_id</th>
                                        <th>Item</th>
                                        <th>Code</th>
                                        <th>Trans_type</th>
                                        <th>category</th>
                                        <!-- <th>Supplier</th> -->
                                        <th>Qty</th>
                                        <!-- <th>Amnt</th> -->
                                        <th>Date</th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row=$res->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo $cnt++;?></td>
                                        <td><?php echo $row['item_id']; ?></td>
                                        <td><?php echo $row['item_name']; ?></td>
                                        <td><?php echo $row['item_code']; ?></td>
                                        <td><?php echo $row['trans_type']; ?></td>
                                        <td><?php echo $row['cat_name']; ?></td>
                                        <!-- <td><?php echo $row['sup_name']; ?></td> -->
                                        <td><?php echo $row['release_qty']; ?></td>
                                        <!-- <td><?php echo number_format($row['rls_total'],2); ?></td> -->
                                       
                                        <td><?php 
                                        echo date("m-d-Y", strtotime($row['trans_date']));
                                        ?></td>
                                        <td><?php echo $row['remarks']; ?></td>
                                        <!-- <td><?php echo 
                                        date("m-d-Y", strtotime($row['trans_date']));
                                         ?></td> -->
                                       
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






