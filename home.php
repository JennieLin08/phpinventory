<?php

session_start();
    $title = "Home";
    $filterModal = "class='modal fade' style='display:none;' aria-hidden='true' ";

    require_once 'controller/home_controller.php';
    $item = new Item();

?>

<?php   
include('template/header.php');  
include('include/userExist.php');
include('template/container.php'); 
include('menus.php');
if(isset($_SESSION['type']) && isset($_SESSION['email'])){
?>
<script src="js/app.js"></script>
<div class="row">
		<div class="col-lg-12">
			    <div class="card card-default rounded-0 shadow">
                    <div class="card-header">
                        <div class="row searchpart d-flex d-flex justify-content-around align-items-center">
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
									<h4 class="card-title">INVENTORY SUMMARY</h4>
							</div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 w-10 catrow align-items-center  m-0 no-print" >
                                <form method="GET" action="">
                                    <div class="input-group">
                                        <label for="category" class="input-group-append m-1">Category :</label>
                                        <select style="width:150px;font-size:small;" class="form-control" name="category"  autocomplete="off" onchange="this.form.submit()">
                                            <option value="All" ><?php echo $cat_select_name; ?>
                                                <i class="fa-duotone fa-arrow-down"></i></option>
                                            <option value="All">All</option>
                                            <?php  
                                            $category = $conn->query("SELECT * FROM tbl_category WHERE status='Active' ORDER BY cat_name ASC;") or die($conn->error);
                                            while ($row=$category->fetch_assoc()){
                                                echo '<option value="'.$row["cat_id"].'#>'.$row["cat_name"].'">'.$row["cat_name"].'</option>';
                                            }
                                            ?> 
                                        </select>
                                    </div>
                                </form>
                            </div>
                           
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 align-self-center  m-0 no-print">
                                <form action="" method="GET" class="">
                                    <div class="input-group  ">
                                        <input type="text" name="search" value="<?php if(isset($_GET['search'])){ echo $_GET['search']; };
                                        
                                        ?>" class="form-control" placeholder="Search" >
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                            <!-- <div class="col-lg-1 col-md-1 col-sm-2 col-xs-4 text-end m-0">
                                
                            </div> -->
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 text-end m-0 no-print">
                                <button type="button" name="showfilter" id="showfilter" data-bs-toggle="modal" data-bs-target="#filterModal" class="btn btn-primary btn-sm bg-gradient rounded-0"><i class="far fa-plus-square"></i> Filter List</button>  
                                    <!-- <button type="button" name="add" id="itemAdd" data-bs-toggle="modal" data-bs-target="#itemModal" class="btn btn-primary btn-sm bg-gradient rounded-0"><i class="far fa-plus-square"></i> Open Inventory List</button>    -->
                                    <a href="print/inventorylist.php"
                                    class="btn btn-primary btn-sm bg-gradient rounded-0"><i class="far fa-plus-square"></i> View Inventory List </a>		
                            </div>
					    </div>


                      





                    <div style="clear:both"></div>
                </div>
                <div class="card card-default rounded-0 shadow">

                    <?php   if (isset($_SESSION['message'])):   ?>
                        <div class="alert alert-<?php echo $_SESSION['msg_type'] ?>">
                            <?php
                                echo $_SESSION['message'];
                                unset($_SESSION['message']);
                            ?>
                        </div>
                    <?php endif ?>
                </div>
                <div class="card-body">
                    <div class="row">
                    	<div class="col-sm-12 table-responsive">
                    		<table id="itemList" class="table table-bordered table-striped">
                    			<thead>
                                    <tr>
                                        <th>No.</th>    
                                        <th>Item ID</th>
                                        <!-- <th>Id</th> -->
                                        <th>Item name</th>
                                        <th>Category</th>
                                        <th>Total qty</th>
                                        <th>Total</th>
                                        <th>Out</th>
                                        <th>Avail stocks</th>
                                        <th>Last_Order_</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if(isset($_GET['search']) ){
                                        $filter_val = $_GET['search'];
                                
                                        // $res = $conn->query("SELECT ROW_NUMBER() OVER(ORDER BY avail_stocks ASC) AS Row,
                                        // i.id,i.cat_id,i.item_id,i.cat_name,i.item_name,sum(i.qty) as total_qty,
                                        // sum(i.total) as total,sum(i.release_qty) as release_qty, sum(i.qty_ind-i.qty_rls_ind) as avail_stocks,
                                        //  d.tdate as date_created , i_unit.unit as unit_ind FROM tbl_itemtrans as i JOIN
                                        //   (SELECT item_id,item_name,max(trans_date) as tdate
                                        //   FROM `tbl_itemtrans` WHERE trans_type='add' AND status='Active' GROUP BY item_id,item_name) as d
                                        //    ON d.item_id=i.item_id 
                                        //    JOIN (SELECT unit,item_id from tbl_item) as i_unit ON i_unit.item_id = i.item_id
                                        //   WHERE CONCAT(i.item_name,i.item_code) LIKE '%$filter_val%' AND status='Active' GROUP BY item_id,item_name ORDER BY avail_stocks ASC LIMIT $offset,$records_page;
                                        // ") or die($conn->error);
                                        $res = $conn->query("SELECT * FROM view_home_invlist WHERE CONCAT(item_name,item_code) LIKE '%$filter_val%' ") or die($conn->error);
                                    }elseif(isset($_GET['category']) && $_GET['category'] != 'All' ){
                                        $res = $conn->query("SELECT * FROM view_home_invlist WHERE cat_id='$cat_select_id' ") or die($conn->error);

                                        // $res = $conn->query("SELECT ROW_NUMBER() OVER(ORDER BY avail_stocks ASC) AS Row,
                                        // i.id,i.cat_id,i.item_id,i.cat_name,max(i.item_name) as item_name,sum(i.qty_ind) as total_qty,
                                        // sum(i.total) as total,sum(i.release_qty) as release_qty, sum(i.qty_ind-i.qty_rls_ind) as avail_stocks,
                                        // d.tdate as date_created, i_unit.unit as unit_ind FROM tbl_itemtrans as i JOIN 
                                        // (SELECT item_id,item_name,max(trans_date) as tdate
                                        // FROM `tbl_itemtrans` WHERE trans_type='add' AND status='Active' GROUP BY item_id) as d
                                        // ON d.item_id=i.item_id
                                        // JOIN (SELECT unit,item_id from tbl_item) as i_unit ON i_unit.item_id = i.item_id
                                        //     WHERE status='Active'  AND cat_id='$cat_select_id' GROUP BY item_id ORDER BY avail_stocks ASC LIMIT $offset,$records_page;
                                        // ") or die($conn->error);

                                    }
                                    else{
                                        // $res = $conn->query("SELECT ROW_NUMBER() OVER(ORDER BY order_list,avail_stocks ASC) AS Row,order_list,
                                        // i.id,i.cat_id,i.item_id,i.cat_name,max(i.item_name) as item_name,sum(i.qty_ind) as total_qty,
                                        // sum(i.total) as total,sum(i.release_qty) as release_qty, sum(i.qty_ind-i.qty_rls_ind) as avail_stocks,
                                        //  d.tdate as date_created, i_unit.unit as unit_ind FROM tbl_itemtrans as i 
                                        //  JOIN (SELECT item_id,item_name,max(trans_date) as tdate FROM `tbl_itemtrans` WHERE trans_type='add' AND status='Active' GROUP BY item_id) as d
                                        //  ON d.item_id=i.item_id
                                        //  JOIN (SELECT unit,item_id,order_list from tbl_item JOIN tbl_category ON tbl_category.cat_id=tbl_item.cat_id ) as i_unit ON i_unit.item_id = i.item_id
                                        //  WHERE status='Active' GROUP BY item_id ORDER BY order_list,avail_stocks ASC LIMIT $offset,$records_page;
                                        // ") or die($conn->error);

                                        $res = $conn->query("SELECT * FROM view_home_invlist") or die($conn->error);
                                    }

                                    while ($row=$res->fetch_assoc() ): 
                                        $date = date("m-d-Y", strtotime($row['trans_date']));
                                        if(strtotime($row['trans_date']) > 0){
                                            $trans_date = $date;
                                        }else{ 
                                            $trans_date = '';
                                        }

                                    ?>
                                    <tr>
                                        <td><?php echo $row['Row']; ?></td>
                                        <td><?php echo $row['item_id']; ?></td>
                                        <td><?php echo strtoupper($row['item_name']); ?></td>
                                        <td><?php echo $row['cat_name']; ?></td>
                                        <td><?php echo $row['total_qty']; ?></td>

                                        <td><?php echo number_format($row['total_amnt'],2); ?></td>
                                        <td><?php echo $row['total_rls_qty']; ?></td>
                                        <td <?php if($row['avail_stocks'] < 10 && $row['cat_id']==64){ echo 'style="color:red;font-weight:bold;"'; } ?> ><?php echo $row['avail_stocks'] .' '. $row['item_unit']; ?></td>
                                        <td><?php echo $trans_date;?></td>
                                        <td>
                                            <a href="print/itemtranslist.php?show=<?php echo $row['item_id']; ?>" <?php if(!$trans_date){echo 'hidden';} ?>
                                                class="btn btn-primary rounded-0 btn-sm"><i class="fa-solid fa-align-justify"></i> </a>

                                           
                                        </td>
                                    </tr>  
                                    <?php 
                                        
                                        endwhile; ?> 
                                    <?php  
                                        
                                        $qry = $conn->query("SELECT sum(total_qty) as total_qty, sum(total_amnt) as total from view_home_invlist;") or die($conn->error);
                                        $total= $qry->fetch_assoc();
                                    ?> 
                                    <!-- <tr>
                                        <th colspan="4">Total</th>
                                        <th><?php echo number_format($total['total_qty']); ?></th>
                                        <th><?php echo '₱' . number_format($total['total']); ?></th>
                                        <td></td>
                                    </tr> -->
                                </tbody>
                    		</table>
                            <div class="row d-flex d-flex justify-content-around align-items-center">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <div class="p-10 card-title">
                                        <strong> Page <?php echo $page_no; ?> of <?php echo $total_pages; ?></strong>

                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <nav aria-label="Page navigation example ">
                                        <ul class="pagination">
                                            <li class="page-item"><a class="page-link <?php echo $page_no<=1 ? 'disabled' : ''; ?>"
                                                <?php echo $page_no>1 ? 'href=?page_no=' .$prev_page : ''?> >Previous</a></li>

                                                <?php for($c =1; $c<=$total_pages; $c++){?>
                                                    
                                                    <?php if($page_no != $c){ ?>
                                                        <li class="page-item"><a class="page-link " href="?page_no=<?php echo $c; ?>"><?php echo $c; ?></a></li>
                                                    <?php }
                                                    else{ ?>
                                                        <li class="page-item"><a class="page-link active" href="?page_no=<?php echo $c; ?>"><?php echo $c; ?></a></li> 
                                                    <?php } ?>
                                                <?php } ?>

                                            <li class="page-item"><a class="page-link <?php echo $page_no>= $total_pages ? 'disabled' : ''; ?>" 
                                            <?php echo $page_no<$total_pages ?  'href=?page_no=' .$next_page : ''?> >Next</a></li>
                                        </ul>
                                    </nav>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-end">
                                        <!-- <h3 class="card-title">Inventory Summary</h3> -->
                                        <span>TOTAL INVENTORY VALUE : <?php echo '₱' . number_format($total['total']); ?></span><br>
                                        <span>TOTAL ACQUIRED ITEMS/EQUIPMENT : <?php echo number_format($total['total_qty']); ?></span><br>
                                        <!-- <span>Total release items/equipment: <?php echo number_format($total['rls_qty']); ?></span><br>
                                        <span>Total available items/Equipment: <?php echo number_format($total['avail_stocks']); ?></span> -->
                                </div>


                            </div>
                            
                            
                    	</div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="filterModal" <?php echo $filterModal; ?> >
    	<div class="modal-dialog modal-dialog-centered">
    			<div class="modal-content">

                
                    <form method="GET" id="filterForm" action="print/print_filterhome.php">
                        <div class="modal-header">
                            <h4 class="modal-title"><i class="fa fa-plus"></i>Filter Modal</h4>
                            <a href="controller/home_controller.php?close=0"
                                                class="btn-close"></a>
                        </div>
                        <div class="modal-body">

                            <div class=" m-1">
                                <label for="category" class="">CATEGORY :</label>
                                <select style="width:150px;font-size:small;" class="form-control select2" required name="filter_category"  autocomplete="off" >
                                    <option value="All" ><?php echo $cat_select_name; ?>
                                        <i class="fa-duotone fa-arrow-down"></i></option>
                                                <!-- <option value="All" >All </option> -->
                                    <option value="All">All</option>
                                    <?php  
                                    $category = $conn->query("SELECT * FROM tbl_category WHERE status='Active' ORDER BY cat_name ASC;") or die($conn->error);
                                    while ($row=$category->fetch_assoc()){
                                        echo '<option value="'.$row["cat_id"].'#>'.$row["cat_name"].'">'.$row["cat_name"].'</option>';
                                    }
                                    ?> 
                                </select>
                            </div>

                            <div class=" m-1 row">
                                <div class=" col-lg-4">
                                    <span>Available stocks </span>
                                </div>
                                <div class=" col-lg-2">
                                    <select style="width:50px;font-size:small;" class="form-control" required name="filter_operator"  autocomplete="off" >
                                        <option value="<="><=</option>    
                                        <option value=">=">>=</option>
                                        <option value="=">=</option>
                                    </select>
                                    
                                </div>
                                <div class="col-lg-3">
                                    <input type="number" style="width:100px;font-size:small;" name="filter_qty" class="form-control" placeholder="Input qty" required>
                                    
                                </div>
                                <div class="col-lg-1 mx-0 px-0">
                                    <span style="color:red;font-weigth:bold;">*</span>
                                </div>
                                
                                
                                
                            </div>


                            <div class=" m-1">
                                <label for="col_name" class="m-1">ORDER BY :</label>
                                <div class="input-group">
                                    <select style="width:150px;font-size:small;" class="form-control select2" name="col_name"  autocomplete="off" >
                                        <option value="item_name">ITEM NAME</option>
                                        <option value="avail_stocks">STOCKS AVAILABLE</option>
                                    </select>

                                    <select style="width:150px;font-size:small;" class="form-control select2" name="order"  autocomplete="off" >
                                        <option value="ASC">ASC</option>
                                        <option value="DESC">DESC</option>
                                    </select>
                                </div>
                              
                            </div>

                            <div class=" m-1">
                                <label for='date'>DATE FROM :</label>
                                <input type="date" name="date_from" id="date_from" class="form-control rounded border-secondary" value='' placeholder="Date" required /> 
                            </div>
                            <div class=" m-1">
                                <label for='date'>DATE TO :</label>
                                <input type="date" name="date_to" id="date_to" class="form-control rounded border-secondary" value='<?php echo $date_to; ?>' placeholder="Date" required /> 
                            </div>
                            
                           
                            
                        </div>
                        <div class="modal-footer">
                            <!-- <button type="button" name="add" id="itemAdd" data-bs-toggle="modal" data-bs-target="#itemModal" class="btn btn-primary btn-sm bg-gradient rounded-0"><i class="far fa-plus-square"></i> Open Inventory List</button>    -->
                            <input type="submit" name="filter_inv" id="filter_inv" class="btn btn-primary btn-sm rounded p-2" value="Filter" form="filterForm"/>	

                            <a href="controller/home_controller.php?close=0"
                                                class="btn btn-default btn-sm rounded-0 border">Close </a>
                        </div>
                    </form>





    			</div>
    	</div>
    </div>



<?php 
} 
else{
    header("Location: index.php");
}
?>

<style>

.disabled{
    color:gray;
}

@media print
{    
    .no-print, .no-print *
    {
        display: none !important;
    }
}
</style>




