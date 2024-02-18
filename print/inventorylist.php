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

    $cnt = 1;
    include('../controller/inventorylist_controller.php');
    $get_category = new Item();
    $category = $conn->query("SELECT * FROM tbl_category WHERE status='Active' ORDER BY cat_name ASC;") or die($conn->error);
                                                                             
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
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
									<h3 class="card-title">INVENTORY LIST </h3>
							</div>
                            <div class="col-lg-3 w-10 catrow align-items-center align-self-center  m-0" >
                                <form method="GET" action="">
                                    <div class="input-group">
                                        <label for="category" class="input-group-append m-1">Category :</label>
                                        <select style="width:150px;font-size:small;" class="form-control border-0" name="category"  autocomplete="off" onchange="this.form.submit()">
                                            <option value="All" ><?php echo $cat_select_name; ?>
                                                <i class="fa-duotone fa-arrow-down"></i></option>
                                            <!-- <option value="All" >All </option> -->
                                            <option value="All">All</option>
                                            <?php  
                                            $category = $conn->query("SELECT * FROM tbl_category WHERE status='Active' ORDER BY cat_name ASC;") or die($conn->error);
                                            while ($row=$category->fetch_assoc()){
                                                echo '<option value="'.$row["cat_id"].'#'.$row["cat_name"].'">'.$row["cat_name"].'</option>';
                                            }
                                            ?> 
                                        </select>
                                    </div>
                                </form>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 text-end">
                                <a href="../home.php" class="btn btn-primary btn-sm bg-gradient rounded-0 back"><i class="fa-solid fa-backward-step"></i> Back</a>
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
                                        <th>No.</th>
                                        <!-- <th>Trans Id</th> -->
                                        <th>ITEM</th>
                                        <th>ITEM CODE</th>
                                        <!-- <th>code</th> -->
                                        <th>CATEGORY</th>
                                        <th>TOTAL QTY</th>
                                        <th>TOTAL AMOUNT</th>
                                        <th>OUT</th>
                                        
                                        <th>AVAIL QTY</th>
                                        <th>LAST_ORDER</th>
                                        <th>REMARKS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php 
                                    $totalqty = 0;
                                    $totalamnt = 0;
                                    $totalOut = 0;
                                    $totalAvailQty = 0;
                                     if(isset($_GET['category']) && $_GET['category'] != 'All' ){
                                      

                                        // $res = $conn->query("SELECT id,i.item_id,item_code,i.item_name,cat_name,sum(qty_ind) as total_qty,
                                        // sum(total) as total,sum(release_qty) as release_qty, sum(qty_ind-qty_rls_ind) as avail_stocks,
                                        //   d.tdate as date_created,remarks, i_unit.unit as unit_ind  FROM tbl_itemtrans as i
                                        //   JOIN 
                                        //  (SELECT item_id,item_name,max(trans_date) as tdate
                                        //   FROM `tbl_itemtrans` WHERE trans_type='add' AND status='Active' GROUP BY item_id) as d 
                                        //   ON d.item_id=i.item_id
                                        //   JOIN (SELECT unit,item_id from tbl_item) as i_unit ON i_unit.item_id = i.item_id
                                        //    WHERE status='Active' and cat_id='$cat_select_id'
                                        //    GROUP BY i.item_id ORDER BY i.item_name,date_created ASC;") or die($conn->error);

                                        $res = $conn->query("SELECT * FROM view_home_invlist where cat_id= '$cat_select_id' ORDER BY item_name ;") or die($conn->error);
                                        
                                     }else{
                                        
                                        // $res = $conn->query("SELECT id,i.item_id,item_code,i.item_name,cat_name,sum(qty_ind) as total_qty,sum(total) as total,sum(release_qty) as release_qty, 
                                        // sum(qty_ind-qty_rls_ind) as avail_stocks,d.tdate as  date_created,remarks, i_unit.unit as unit_ind  FROM tbl_itemtrans as i
                                        // JOIN 
                                        //  (SELECT item_id,item_name,max(trans_date) as tdate
                                        //   FROM `tbl_itemtrans` WHERE trans_type='add' AND status='Active' GROUP BY item_id) as d 
                                        //   ON d.item_id=i.item_id
                                        //   JOIN (SELECT unit,item_id from tbl_item) as i_unit ON i_unit.item_id = i.item_id
                                        //  WHERE status='Active' GROUP BY i.item_id ORDER BY i.item_name,date_created ASC;") or die($conn->error);

                                        $res = $conn->query("SELECT * FROM view_home_invlist ORDER BY item_name;") or die($conn->error);
                                    }

                                   while ($row=$res->fetch_assoc()): 
                                    $date = date("m-d-Y", strtotime($row['trans_date']));
                                    if(strtotime($row['trans_date']) > 0){
                                        $trans_date = $date;
                                    }else{ 
                                        $trans_date = '';
                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo $cnt++;?></td>

                                        <td><?php echo strtoupper($row['item_name']); ?></td>
                                        <td><?php echo $row['item_code']; ?></td>
                                        <td><?php echo $row['cat_name']; ?></td>

                                        <td><?php echo $row['total_qty'].' '.$row['item_unit']; ?></td>
                                        <td><?php echo number_format($row['total_amnt'],2); ?></td>
                                        <td><?php echo $row['total_rls_qty']; ?></td>
                                        <td><?php echo $row['avail_stocks'].' '.$row['item_unit']; ?></td>
                                        <td><?php echo $trans_date; ?></td>
                                        <td><?php echo $row['remarks']; ?></td>

                                       
                                    </tr>  
                                    <?php
                                    $totalqty += $row['total_qty']; 
                                    $totalamnt += $row['total_amnt'];
                                    $totalOut += $row['total_rls_qty'];
                                    $totalAvailQty += $row['avail_stocks'];

                                        endwhile; ?> 
                                        <tr>
                                            <th colspan="4">TOTAL</th>
                                             <th ><?php echo number_format($totalqty) ?></th>
                                             <th ><?php echo number_format($totalamnt,2) ?></th>
                                             <th ><?php echo number_format($totalOut) ?></th>
                                             <th ><?php echo number_format($totalAvailQty) ?></th>
                                        </tr>

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








