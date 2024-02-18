<?php
session_start();
    $title = "Transfer";
    include('template/header.php');
    include('include/userExist.php');

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
 
    $date = date('Y-m-d');   

    $divModal = "class='modal fade' style='display:none;' aria-hidden='true' ";
    
    require_once 'controller/mrtransfer_controller.php';
    $item = new Item();

?>

<?php     
include('template/container.php'); 
include('menus.php');
if(isset($_SESSION['type']) && isset($_SESSION['email'])){
?>
<script src="js/app.js"></script>
<div class="row">
		<div class="col-lg-12">
			    <div class="card card-default rounded-0 shadow">
                    <div class="card-header">
                        <div class="row">
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
									<h3 class="card-title">MR TRANSFER</h3>
							</div>
                            <div class="col-lg-3 w-10 catrow align-items-center  align-self-center m-0" >
                                <form method="GET" action="">
                                    <div class="input-group">
                                        <label for="category" class="input-group-append m-1">Category :</label>
                                        <select style="width:150px;font-size:small;" class="form-control" name="category"  autocomplete="off" onchange="this.form.submit()">
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

                            <div class="col-lg-4 align-self-center  m-0">
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

                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 text-end align-self-center ">
                                    <button type="button" name="add" id="itemAdd" data-bs-toggle="modal" data-bs-target="#itemModal" class="btn btn-primary btn-sm bg-gradient rounded-0 border-dark "><i class="fa-solid fa-square-minus"></i> Transfer</button>   		
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
                                        <!-- <th>TransID</th> -->
                                        <th>Employee</th>
                                        <th class='text-sm'>Item name</th>
                                        <th>From</th>
                                        <!-- <th>Category</th> -->
                                        <!-- <th>Desc</th> -->
                                        <!-- <th>Supplier</th> -->
                                        <!-- <th>Unit price</th> -->
                                        <th>Qty</th>
                                        <th>Trans_Date</th>
                                        <!-- <th>Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if(isset($_GET['search'])){
                                        $filter_val = $_GET['search'];
                                        $res = $conn->query("SELECT *,ROW_NUMBER() OVER(ORDER BY date_created DESC) AS Row FROM tbl_itemtrans WHERE CONCAT(item_name,item_code,emp_name) LIKE '%$filter_val%' AND status='Active' AND trans_type='Transfer'") or die($conn->error);
                                    }elseif(isset($_GET['category']) && $_GET['category'] != 'All' ){
                                        $res = $conn->query("SELECT *,ROW_NUMBER() OVER(ORDER BY date_created DESC) AS Row FROM tbl_itemtrans WHERE cat_id='$cat_select_id' AND status='Active' && trans_type='Transfer' ") or die($conn->error);
                                    }else{
                                        $res = $conn->query("SELECT *,ROW_NUMBER() OVER(ORDER BY date_created DESC) AS Row FROM tbl_itemtrans WHERE status='Active' && trans_type='Transfer'") or die($conn->error);
                                    }
                                    while ($row=$res->fetch_assoc()): 
                                    ?>
                                        
                                    <tr>
                                        <td><?php echo $row['Row']; ?></td>
                                        <!-- <td><?php echo $row['id']; ?></td> -->
                                        <td class='text-sm'><?php echo $row['emp_name']; ?></td>
                                        <td><?php echo strtoupper($row['item_name']); ?></td>
                                        <td><?php echo $row['from_name']; ?></td>
                                        <!-- <td><?php echo $row['cat_name']; ?></td> -->
                                        <!-- <td><?php echo $row['description']; ?></td>
                                        <td><?php echo $row['sup_name']; ?></td>
                                        <td><?php echo $row['amount']; ?></td> -->
                                        <td><?php echo $row['release_qty']; ?></td>
                                        <td><?php echo 
                                        date("m-d-Y", strtotime($row['trans_date']));
                                         ?></td>
                                        <td>
                                            <!-- <a href="mrtransfer.php?edit=<?php echo $row['id']; ?>"
                                                class="btn btn-primary rounded-0 btn-sm"><i class="fa-solid fa-pen-to-square"></i></a> -->

                                            <!-- <a href="controller/mrtransfer_controller.php?delete=<?php echo $row['id']; ?>"
                                            onclick="return confirm('Are you sure you want to delete this Transaction?')"
                                                class="btn btn-danger rounded-0 btn-sm"><i class="fa-solid fa-trash"></i>  </a> -->
                                        </td>
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


    <div id="itemModal" <?php echo $divModal; ?> >
    	<div class="modal-dialog modal-dialog-centered">
    			<div class="modal-content">
                    <form method="post" id="itemForm" action="controller/mrtransfer_controller.php">
                        <div class="modal-header">
                            <h4 class="modal-title"><i class="fa fa-plus"></i> Add</h4>
                            <a href="controller/mrtransfer_controller.php?close=0"
                                                class="btn-close"></a>
                        </div>
                        <div class="modal-body">

                            <div class="">
                                <label for='date'>Transaction date <span style="color:red;font-weigth:bold;">*</span></label>
                                <input type="date" name="date" id="date" class="form-control rounded border-secondary" value='<?php echo $date; ?>' placeholder="Date" required />
                            </div>

                            <div class="" >
                                <label for='emp_name'>Transfer to : (Select employee) <span style="color:red;font-weigth:bold;">*</span></label>
                                <select required name="emp_name" id="emp_name" class="form-control rounded border-secondary select2">
                                    <?php if($emp_val !=''){
                                        echo $emp_val;
                                    } else{
                                        echo '<option value="">Select Employee</option>';
                                    }?>
                                    <?php echo $item->getEmp(); ?>
                                </select>
                            </div>
            
                            <!-- <div class="" >
                                <input type="hidden" name="trans_id" id="trans_id" value="<?php echo $id;?>"/>
                                <label for='item_name'>Select item</label>
                                
                                <select name="item_name" required id='item_name' onchange="func_item_val(this.options[this.selectedIndex].value)" class="form-control rounded border-secondary">
                                    <?php if($item_val !=''){
                                        echo $item_val;
                                    } else{
                                        echo '<option value="">Choose Item</option>';
                                    }?>
                                    <?php echo $item->getStocksAvail(); ?>
                                </select>
                            </div> -->

                            <div class="" >
                                <input type="hidden" name="trans_id" id="trans_id" value="<?php echo $id;?>"/>
                                <label for='item_name'>From : (Select item and current incharge) <span style="color:red;font-weigth:bold;">*</span></label>
                                <!-- <input type="text" name="item_name" id="item_name" class="form-control rounded border-secondary" value='<?php echo $item_name; ?>' placeholder="Enter item name" required /> -->
                                <select name="item_name" required id='item_name' onchange="func_item_val(this.options[this.selectedIndex].value)" class="form-control rounded border-secondary select2">
                                    <?php if($item_val !=''){
                                        echo $item_val;
                                    } else{
                                        echo '<option value="">Choose Item</option>';
                                    }?>
                                    <?php echo $item->itemandMR(); ?>
                                </select>
                            </div>
                            

                            <div class="p-2">
                                <span>Available Stock/s:</span> <input id="available_stock" class="form-control border-0 m-1" type="text" value="0">
                            </div>

                            <!-- <div class="" >
                                <label for='item_code'>Item Code</label>
                                <input type="text" name="item_code" id="item_code" class="form-control rounded border-secondary" value='<?php echo $item_code; ?>' placeholder="Enter item code" required />
                            </div> -->

                            <!-- <div class="">
                                <label for='description'>Description</label>
                                <textarea name="description" id="description" value='<?php echo $description; ?>'  class="form-control rounded border-secondary" rows="2" required><?php echo $description; ?></textarea>
                            </div> -->

                            <div class="pt-1">
                                <label for='qty'>Quantity to be transfer <span style="color:red;font-weigth:bold;">*</span></label>
                                <input type="number" name="qty" min="1" id="qty"  class="form-control rounded border-secondary" value='<?php echo $qty; ?>' placeholder="Enter quantity" required />
                            </div>
                            <!-- <div class="">
                                <label for='unit'>Unit</label>
                                <select name="unit" class="form-select rounded-0" id="unit" required>
                                        <?php if($unit !=''): ?>
                                                <option ><?php echo $unit ?></option>
                                            <?php else :?>
                                                <option value="">Select Unit</option>
                                            <?php endif ?>
                                            <option value="">Select Unit</option>
                                            <option value="pc">Pc</option>
                                            <option value="Bags">Bags</option>
                                            <option value="Bottles">Bottles</option>
                                            <option value="Box">Box</option>
                                            <option value="Dozens">Dozens</option>
                                            <option value="Feet">Feet</option>
                                            <option value="Gallon">Gallon</option>
                                            <option value="Grams">Grams</option>
                                            <option value="Inch">Inch</option>
                                            <option value="Kg">Kg</option>
                                            <option value="Liters">Liters</option>
                                            <option value="Meter">Meter</option>
                                            <option value="Nos">Nos</option>
                                            <option value="Packet">Packet</option>
                                            <option value="Rolls">Rolls</option>
                                            <option value="Rolls">Set</option>
                                            <option value="Rolls">Others</option>
                                        </select>
                            </div> -->
                            <!-- <div class="">
                                <label for='amount'>Amount</label>
                                <input type="number" name="amount" onkeyup="funcHandleAmount(this.value)" step=".0001" id="amount" class="form-control rounded border-secondary" value='<?php echo $amount; ?>' placeholder="Enter Amount" required />
                            </div>
                            <div class="">
                                <label for='total_amnt'>Total </label>
                                <input type="number" name="total_amnt" step=".0001" id="total_amnt" class="form-control "disabled value='0' placeholder="Enter Amount" required />
                            </div> -->
                            <div class="">
                                <label for='remarks'>Remarks</label>
                                <input type="text" name="remarks" id="remarks" class="form-control rounded border-secondary" value='<?php echo $remarks; ?>' placeholder="Remarks"  />
                            </div>
                                
                                
                            
                        </div>
                        <div class="modal-footer">

                            <?php if ($update_stock == true ): ?>
                                <input type="submit" name="update_item" id="update_item" class="btn btn-primary btn-sm rounded-0" value="Update" form="itemForm"/>
                            <?php else: ?>
                                <input type="submit" name="save_item" id="save_item" class="btn btn-primary btn-sm rounded-0" value="Add" form="itemForm" />
                            <?php endif; ?>
                            <a href="controller/mrtransfer_controller.php?close=0"
                                                class="btn btn-default btn-sm rounded-0 border " >Close </a>
                        </div>
                    </form>
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

<script type="text/javascript">

    let item_val = document.getElementById('item_name').value;
    let avail_stocks = document.getElementById('available_stock');
    let emp_name = document.getElementById('emp_name').value;

    let amnt = document.getElementById('amount');
    let total_amount = document.getElementById('total_amnt');
    let addbtn = document.getElementById('save_item');
    
    let total_qty = document.getElementById('qty');
    // total_amount.value = total_qty.value*amnt.value;

    // if(emp_name == ""){
    //     alert('Select Employee Name')
    // }

    function func_item_val(val){
        // alert(i_val);
        
        let get_itemid= val.split('#');
        
        let avail_qty = get_itemid[2];
        document.getElementById('available_stock').value = avail_qty;
        let updatebtn = document.getElementById('update_item');
        let check_clist = addbtn.classList.contains('disabled');

        if(avail_qty <=0 && !(check_clist)){
            addbtn.classList.add('disabled');
        }else{
            addbtn.classList.remove('disabled');
        }

        
        
        // console.log(avail_stocks.type)
        if(Number(avail_stocks.value) >=1){
            total_qty.setAttribute("max", avail_stocks.value);
            console.log('t');
            console.log(Number(avail_stocks.value))
        }
    }



    if(item_val){
        let out_get_itemid= item_val.split('#');
        let out_avail_qty = out_get_itemid[2];
        if(out_avail_qty){
            avail_stocks.value = out_avail_qty;
        }else{
            avail_stocks.value = '0';
        }
    }



    // function funcHandleAmount(val){
    //     console.log(val);
    //     total_amount.value=total_qty.value*val;

    // }

    // function funcHandleqty(val){
    //     total_amount.value=amnt.value*val;
    // }
 



</script>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
      $('.select2').each(function () {
        $(this).select2({
            theme: 'bootstrap-5',
            dropdownParent: $(this).parent(),
        });
    });

   
</script>
