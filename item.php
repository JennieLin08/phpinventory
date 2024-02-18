<?php
session_start();
    $title = "item";
    include('template/header.php');
    include('include/userExist.php');
    if(!isset($_SESSION['user_name']) && empty($_SESSION['user_name'])){
        echo 'hello';
        header("Location:index.php");
    }
    // if(!isset($_SESSION['user_name']) && empty($_SESSION['user_name'])){
    //     header ("Location:../index.php");
    // }

    // require_once 'include/db_conn.php';

    $id = 0;
    $update_item = false;
    $duplicate = false;
    $divModalonly = "class='modal fade' style='display:none;' aria-hidden='true' ";
    
    $item_name = '';
    $item_code = '';
    $description='';
    // $amount=0;
    $eul='';
    $remarks='';
    $cat_name='';
    $qty_ind=1;
    $unit = '';
    $unit_package='';
    $i_qty = 1;

    $t_qty = 1;
    $tqty_2 = 0;
    $tamount = 0;
    $tamount_2 = 0;
    $ttotal_1 = 0.0000;
    $ttotal_2 = 0.0000;

    $date = date('Y-m-d');  

    $divModal = "class='modal fade' style='display:none;' aria-hidden='true' ";
    

    require_once 'controller/item_controller.php';
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
							<div class="col-lg-2 col-md-4 col-sm-4 col-xs-5">
									<h3 class="card-title">ITEM LIST</h3>
							</div>

                            <div class="col-lg-3 w-10 catrow align-items-center lign-self-center m-0" >
                                <form method="GET" action="" class="">
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

                            <div class="col-lg-4 align-self-center ">
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

                            <div class="col-lg-3 col-md-2 col-sm-2 col-xs-2 text-end">
                                    <button type="button" name="add" id="itemAdd" data-bs-toggle="modal" data-bs-target="#itemModal" class="btn btn-primary btn-sm bg-gradient rounded-0"><i class="far fa-plus-square"></i> Add Item & Trans</button>   
                                    <button type="button" name="addonly" id="itemAddonly" data-bs-toggle="modal" data-bs-target="#itemModalonly" class="btn btn-primary btn-sm bg-gradient rounded-0 m-1"><i class="far fa-plus-square"></i> Add Item Only</button>   		
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
                            <form method="post" action="controller/item_controller.php">
                            <input type="submit" <?php if($_SESSION['type']!='admin'){ echo 'hidden';}  ?> name="submitDel" value="Delete" onclick="return confirm('Are you sure to delete this transaction/s')" class="btn btn-danger m-1">
                    		<table id="itemList" class="table table-bordered table-striped">
                    			<thead>
                                    <tr>
                                        <th <?php if($_SESSION['type']!='admin'){ echo 'hidden';}  ?>><input type="checkbox" id="checkAll" ></th>
                                        <th>No.</th>
                                        <!-- <th>ID</th> -->
                                        <th>Item Name</th>
                                        <th>Item Code</th>
                                        <th>Category</th>
                                        <th>Unit</th>
                                        <th>Remarks</th>
                                        <th>
                                            
                                            
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(isset($_GET['search']) ){
                                        $filter_val = $_GET['search'];
                                        $res = $conn->query("SELECT *,ROW_NUMBER() OVER(ORDER BY item_name ASC) AS Row FROM tbl_item WHERE CONCAT(item_name,item_code) LIKE '%$filter_val%' AND status='Active' ") or die($conn->error);
                                    }elseif(isset($_GET['category']) && $_GET['category'] != 'All'){
                                        $res = $conn->query("SELECT *,ROW_NUMBER() OVER(ORDER BY item_name ASC) AS Row FROM tbl_item WHERE status!='deleted' AND cat_id='$cat_select_id' ") or die($conn->error);
                                    }
                                    else{
                                        $res = $conn->query("SELECT *,ROW_NUMBER() OVER(ORDER BY item_name ASC) AS Row FROM tbl_item WHERE status!='deleted' ") or die($conn->error);
                                    }
                                     while ($row=$res->fetch_assoc()):
                                      ?>
                                    <tr>
                                        <td <?php if($_SESSION['type']!='admin'){ echo 'hidden';}  ?>><input type="checkbox" class="checkItem" value="<?php echo $row['item_id']; ?>" name="id[]"></td>
                                        <td><?php echo $row['Row']; ?></td>
                                        <!-- <td><?php echo $row['item_id']; ?></td> -->
                                        <td><?php echo strtoupper($row['item_name']); ?></td>
                                        <td><?php echo strtoupper($row['item_code']); ?></td>
                                        <td><?php echo $row['cat_name']; ?></td>
                                        <td><?php echo $row['unit']; ?></td>
                                        <td><?php echo $row['remarks']; ?></td>
                                        <td>
                                            <a href="item.php?edit=<?php echo $row['item_id']; ?>"
                                                class="btn btn-primary rounded-0 btn-sm"><i class="fa-solid fa-pen-to-square"></i> </a>
                                        
                                            <?php
                                            if(isset($_SESSION['type']) && $_SESSION['type']=='admin'){
                                            echo '<a href="controller/item_controller.php?delete='.$row['item_id'].'"
                                            onclick="return confirm(\'Are you sure you want to delete this Supplier?\')"
                                                class="btn btn-danger rounded-0 btn-sm"><i class="fa-solid fa-trash"></i> </a>';
                                            }
                                            ?>
                                            
                                            
                                        </td>
                                    </tr>  
                                    <?php endwhile; ?> 
                                </tbody>
                    		</table>
                            </form>
                    	</div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="itemModal" <?php echo $divModal; ?> >
    	<div class="modal-dialog modal-dialog-centered">
    			<div class="modal-content">
                    <form method="post" id="itemFormtrans" action="controller/item_controller.php">
                        <div class="modal-header">
                            <h4 class="modal-title"><i class="fa fa-plus"></i> Add Item</h4>
                            <a href="controller/item_controller.php?close=0"
                                                class="btn-close"></a>
                        </div>
                        <div class="modal-body">

                            <div class="">
                                <label for='date'>Transaction date <span style="color:red;font-weigth:bold;">*</span></label>
                                <input type="date" name="date" id="date" class="form-control rounded border-secondary" value='<?php echo $date; ?>' placeholder="Date" required />
                            </div>
            
                            <div class="" >
                                <input type="hidden" name="item_id" id="item_id" value="<?php echo $id;?>"/>
                                <label for='item_name'>Item Name <span style="color:red;font-weigth:bold;">*</span></label>
                                <input type="text" name="item_name" id="item_name" class="form-control rounded border-secondary" value='<?php echo $item_name; ?>' placeholder="Enter item name" required />
                            </div>

                            <div class="" >
                                <label for='item_code'>Item Code <span style="color:red;font-weigth:bold;">*</span></label>
                                <input type="text" name="item_code" id="item_code" class="form-control rounded border-secondary" value='<?php echo $item_code; ?>' placeholder="Enter item code" required />
                            </div>

                            <div class="">
                                <label for='cat_name'>Category <span style="color:red;font-weigth:bold;">*</span></label>
                                <select name="cat_name" class="form-control rounded border-secondary select2" required>
                                <?php if($cat_val !=''){
                                        echo $cat_val;
                                    } else{
                                        echo '<option value="" >Choose Category</option>';
                                    }?>
                                    <?php echo $item->getCategory(); ?>
                                </select>
                            </div>

                            <div class="">
                                <label for='sup_name'>Supplier</label>
                                <select name="sup_name" class="form-control rounded border-secondary select2">
                                    <?php if($sup_val !=''){
                                        echo $sup_val;
                                    } else{
                                        echo '<option value="0#na">Choose supplier</option>';
                                    }?>
                                    <?php echo $item->getSupplier(); ?>
                                </select>
                            </div>

                            <div class="">
                                <label for='description'>Description</label>
                                <!-- <input type="text" name="description" id="description" class="form-control rounded border-secondary" value='<?php echo $description; ?>' placeholder="Enter Description" required /> -->
                                <textarea name="description" id="description" value='<?php echo $description; ?>'  class="form-control rounded border-secondary" rows="2" ><?php echo $description; ?></textarea>
                            </div>

                            <div class="border border-secondary rounded p-1 m-1">
                                <h6 class="text-success">Item qty and unit</h6>
                                <div class="row" >
                                    <div class="col-lg-10 col-md-10">
                                    <label for='iunit_package'>Unit<span style="color:red;font-weigth:bold;">*</span></label>
                                    <select name="iunit_package"  onchange="funct_iunit(this.options[this.selectedIndex].value)" class="form-select rounded-0 select2" id="iunit_package" required>
                                                
                                                <option value="">Select Unit</option>
                                                <option value="Pc/s">Pc/s</option>
                                                <option value="Bag/s">Bag/s</option>
                                                <option value="Bottle/s">Bottle/s</option>
                                                <option value="Box/es">Box/es</option>
                                                <option value="Dozen/s">Dozen/s</option>
                                                <option value="Feet">Feet</option>
                                                <option value="Gallon">Gallon/s</option>
                                                <option value="Gram/s">Gram/s</option>
                                                <option value="Inch/es">Inch/es</option>
                                                <option value="Kg/s">Kg/s</option>
                                                <option value="Liter/s">Liter/s</option>
                                                <option value="Meter/s">Meter/s</option>
                                                <option value="No/s">No/s</option>
                                                <option value="Packet/s">Packet/s</option>
                                                <option value="Roll/s">Roll/s</option>
                                                <option value="Set/s">Set/s</option>
                                                <option value="Unit/s">Unit/s</option>
                                                <option value="Pad/s">Pad/s</option>
                                                <option value="Pack/s">Pack/s</option>
                                                <option value="Rim">Rim</option>
                                                <option value="Others">Others</option>
                                            </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-5">
                                        <label for='i_unit'>Unit per Individual <span style="color:red;font-weigth:bold;">*</span></label>
                                        <select name="i_unit_ind" required  onchange="funct_iUnitInd(this.options[this.selectedIndex].value)" class="form-select rounded-0 select2" id="i_unit" required>
                                                <?php if($unit !=''): ?>
                                                        <option ><?php echo $unit ?></option>
                                                    <?php else :?>
                                                        <option value="">Select Unit</option>
                                                    <?php endif ?>
                                                    <option value="">Select Unit</option>
                                                    <option value="Pc/s">Pc/s</option>
                                                    <option value="Bag/s">Bag/s</option>
                                                    <option value="Bottle/s">Bottle/s</option>
                                                    <option value="Box/es">Box/es</option>
                                                    <option value="Dozen/s">Dozen/s</option>
                                                    <option value="Feet">Feet</option>
                                                    <option value="Gallon">Gallon/s</option>
                                                    <option value="Gram/s">Gram/s</option>
                                                    <option value="Inch/es">Inch/es</option>
                                                    <option value="Kg/s">Kg/s</option>
                                                    <option value="Liter/s">Liter/s</option>
                                                    <option value="Meter/s">Meter/s</option>
                                                    <option value="No/s">No/s</option>
                                                    <option value="Packet/s">Packet/s</option>
                                                    <option value="Roll/s">Roll/s</option>
                                                    <option value="Set/s">Set/s</option>
                                                    <option value="Unit/s">Unit/s</option>
                                                    <option value="Pad/s">Pad/s</option>
                                                    <option value="Pack/s">Pack/s</option>
                                                    <option value="Rim">Rim</option>
                                                    <option value="Others">Others</option>
                                                </select>
                                    </div>
                                    <div class="col-lg-5">
                                        <label for='i_qty'>Quantity <span style="color:red;font-weigth:bold;">*</span></label>
                                        <input type="number" name="i_qty" min="1" id="i_qty" class="form-control rounded border-secondary" value='<?php echo $i_qty; ?>' placeholder="Enter quantity" required />
                                    </div>
                                </div>
                            </div>

                            <div class="border border-secondary rounded p-1 m-1">       
                                <h6 class="text-success">Transaction qty and unit</h6>                    
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label for='t_qty'>Qty <span style="color:red;font-weigth:bold;">*</span></label>
                                        <input type="number" name="t_qty" min="1" id="t_qty" onchange="myFunc_tqty(this.value)" class="form-control rounded border-secondary" value='<?php echo $t_qty; ?>' placeholder="Enter quantity" required />
                                    </div>

                                    <div class="col-lg-5">
                                        <label for='t_unit'>Unit_1 <span style="color:red;font-weigth:bold;">*</span></label>
                                        <select name="t_unit" required class="form-select rounded-0 select2" id="t_unit" required>
                                                <?php if($t_unit !=''): ?>
                                                    <option ><?php echo $t_unit ?></option>
                                                <?php endif ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for='t_amount'>Amount per Unit <span style="color:red;font-weigth:bold;">*</span></label>
                                        <input type="number" name="t_amount" min="1" step="any" id="t_amount" onchange="myFunc_tamnt(this.value)" class="form-control rounded border-secondary" value='<?php echo $t_amount; ?>' placeholder="Enter Amount" required />
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-lg-3">
                                        <label for='tqty_2'>Qty </label>
                                        <input type="number" name="tqty_2" min="0" id="tqty_2" onchange="myFunc_tqty2(this.value)" class="form-control rounded border-secondary" value='<?php echo $tqty_2; ?>' placeholder="Enter quantity" />
                                    </div>

                                    <div class="col-lg-5">
                                        <label for='tunit_2'>Unit_2 </label>
                                        <select name="tunit_2" class="form-select rounded-0 select2" id="tunit_2" >
                                                <?php if($unit !=''): ?>
                                                    <option ><?php echo $unit ?></option>
                                                <?php endif ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for='tamount_2'>Amount per Unit </label>
                                        <input type="number" name="tamount_2" min="0" step="any" id="tamount_2" onchange="myFunc_tamnt2(this.value)" class="form-control rounded border-secondary" value='<?php echo $tamount_2; ?>' placeholder="Enter Amount" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <label for='ttotal_1'>Sub total 1 </label>
                                        <input type="number" name="ttotal_1" min="1" step="any" disabled id="ttotal_1" class="form-control rounded border-secondary" value='<?php echo $ttotal_1; ?>'   />
                                    </div>
                                    <div class="col-lg-4">
                                        <label for='total_2'>Sub total 2 </label>
                                        <input type="number" name="total_2"  step="any" disabled id="ttotal_2" class="form-control rounded border-secondary"   value='<?php echo $ttotal_2; ?>'  />
                                    </div>
                                    <div class="col-lg-4">
                                        <label for='gtotal'>Grand total </label>
                                        <input type="number" name="gtotal" step="any" disabled id="gtotal" class="form-control rounded border-secondary"  value='<?php echo $gtotal; ?>' placeholder="Estimated Useful Life"  />
                                    </div>
                                </div>
                            </div>
                            
                           





                            
                            <!-- <div class="">
                                <label for='amount'>Amount <span style="color:red;font-weigth:bold;">*</span></label>
                                <input type="number" name="amount" min="1" step="any" id="amount" class="form-control rounded border-secondary" value='<?php echo $amount; ?>' placeholder="Enter Amount" required />
                            </div> -->
                            <div class="">
                                <label for='eul'>Estimated Useful Life <span style="color:red;font-weigth:bold;">*</span></label>
                                <input type="text" name="eul" id="eul" class="form-control rounded border-secondary" value='<?php echo $eul; ?>' placeholder="Estimated Useful Life" required />
                            </div>

                            <div class="">
                                <label for='remarks'>Remarks</label>
                                <input type="text" name="remarks" id="remarks" class="form-control rounded border-secondary" value='<?php echo $remarks; ?>' placeholder="Remarks"  />
                            </div>
                                
                        </div>
                        <div class="modal-footer">

                            <?php if ($update_item == true ): ?>
                                <input type="submit" name="update_item" id="update_item" class="btn btn-primary btn-sm rounded-0" value="Update" form="itemFormtrans"/>
                            <?php else: ?>
                                <input type="submit" name="save_itemtrans" id="save_itemtrans" class="btn btn-primary btn-sm rounded-0" value="Add" form="itemFormtrans"/>
                            <?php endif; ?>
                            <a href="controller/item_controller.php?close=0"
                                                class="btn btn-default btn-sm rounded-0 border">Close </a>
                        </div>
                    </form>
    			</div>
    	</div>
    </div>
</div>	
<script>
    let t_qty = document.getElementById('t_qty');
    let t_amnt = document.getElementById('t_amount');
    let tqty_2 = document.getElementById('tqty_2');
    let tamnt_2 = document.getElementById('tamount_2');
    let ttotal_1 = document.getElementById('ttotal_1');
    let ttotal_2 = document.getElementById('ttotal_2');

    function myFunc_tqty(val){
        document.getElementById('ttotal_1').value= val * t_amnt.value;
        document.getElementById('gtotal').value= parseFloat(ttotal_1.value) + parseFloat(ttotal_2.value);

    }
    
    function myFunc_tamnt(val){
        document.getElementById('ttotal_1').value= t_qty.value * val;
        // console.log(ttotal_2.value);
        document.getElementById('gtotal').value= parseFloat(ttotal_1.value) + parseFloat(ttotal_2.value);

    }

    function myFunc_tqty2(val){
        document.getElementById('ttotal_2').value= val * tamnt_2.value;
        document.getElementById('gtotal').value= parseFloat(ttotal_1.value) + parseFloat(ttotal_2.value);

    }

    function myFunc_tamnt2(val){
        document.getElementById('ttotal_2').value= tqty_2.value * val;
        document.getElementById('gtotal').value= parseFloat(ttotal_1.value) + parseFloat(ttotal_2.value);
    }
</script>


<div id="itemModalonly" <?php echo $divModalonly; ?> >
    	<div class="modal-dialog modal-dialog-centered">
    			<div class="modal-content">
                    <form method="post" id="itemForm" action="controller/item_controller.php">
                        <div class="modal-header">
                            <h4 class="modal-title"><i class="fa fa-plus"></i> Add Item</h4>
                            <a href="controller/item_controller.php?close=0"
                                                class="btn-close"></a>
                        </div>
                        <div class="modal-body">
            
                            <div class="" >
                                <input type="hidden" name="item_id" id="item_id" value="<?php echo $id;?>"/>
                                <label for='item_name'>Item Name <span style="color:red;font-weigth:bold;">*</span></label>
                                <input type="text" name="item_name" id="item_name" pattern="[a-zA-Z0-9_-\.]" class="form-control rounded border-secondary" value='<?php echo $item_name; ?>' placeholder="Enter item name" required />
                            </div>
                            <div class="">
                                <label for='description'>Description</label>
                                <textarea name="description" id="description" value='<?php echo $description; ?>'  class="form-control rounded border-secondary" rows="2" ><?php echo $description; ?></textarea>
                            </div>

                            <div class="" >
                                <label for='item_code'>Item Code <span style="color:red;font-weigth:bold;">*</span></label>
                                <input type="text" name="item_code" id="item_code" class="form-control rounded border-secondary" value='<?php echo $item_code; ?>' placeholder="Enter item code" required />
                            </div>

                            <div class="row" >
                                <div class="col-lg-10 col-md-10">
                                <label for='unit'>Unit_package<span style="color:red;font-weigth:bold;">*</span></label>
                                <select name="unit_package"  onchange="get_unit(this.options[this.selectedIndex].value)" class="form-select rounded-0 select2" id="unit_package" required>
                                            
                                            <?php if($unit_package !=''): ?>
                                                <option ><?php echo $unit_package ?></option>
                                            <?php else :?>
                                                <option value="">Select Unit</option>
                                            <?php endif ?>
                                              
                                            <option value="Pc/s">Pc/s</option>
                                            <option value="Bag/s">Bag/s</option>
                                            <option value="Bottle/s">Bottle/s</option>
                                            <option value="Box/es">Box/es</option>
                                            <option value="Dozen/s">Dozen/s</option>
                                            <option value="Feet">Feet</option>
                                            <option value="Gallon">Gallon/s</option>
                                            <option value="Gram/s">Gram/s</option>
                                            <option value="Inch/es">Inch/es</option>
                                            <option value="Kg/s">Kg/s</option>
                                            <option value="Liter/s">Liter/s</option>
                                            <option value="Meter/s">Meter/s</option>
                                            <option value="No/s">No/s</option>
                                            <option value="Packet/s">Packet/s</option>
                                            <option value="Roll/s">Roll/s</option>
                                            <option value="Set/s">Set/s</option>
                                            <option value="Unit/s">Unit/s</option>
                                            <option value="Pad/s">Pad/s</option>
                                            <option value="Pack/s">Pack/s</option>
                                            <option value="Rim">Rim</option>
                                            <option value="Others">Others</option>
                                        </select>
                                </div>
                            </div>

                            <div class="row" >
                                <div class="col-lg-5 col-md-5">
                                <label for='unit'>Unit_ind<span style="color:red;font-weigth:bold;">*</span></label>
                                <select name="unit" required class="form-select rounded-0 select2" id="unit" required>
                                        <?php if($unit !=''): ?>
                                                <option ><?php echo $unit ?></option>
                                            <?php else :?>
                                                <option value="">Select Unit</option>
                                            <?php endif ?>
                                            <option value="Pc/s">Pc/s</option>
                                            <option value="Bag/s">Bag/s</option>
                                            <option value="Bottle/s">Bottle/s</option>
                                            <option value="Box/es">Box/es</option>
                                            <option value="Dozen/s">Dozen/s</option>
                                            <option value="Feet">Feet</option>
                                            <option value="Gallon">Gallon/s</option>
                                            <option value="Gram/s">Gram/s</option>
                                            <option value="Inch/es">Inch/es</option>
                                            <option value="Kg/s">Kg/s</option>
                                            <option value="Liter/s">Liter/s</option>
                                            <option value="Meter/s">Meter/s</option>
                                            <option value="No/s">No/s</option>
                                            <option value="Packet/s">Packet/s</option>
                                            <option value="Roll/s">Roll/s</option>
                                            <option value="Set/s">Set/s</option>
                                            <option value="Unit/s">Unit/s</option>
                                            <option value="Pad/s">Pad/s</option>
                                            <option value="Pack/s">Pack/s</option>
                                            <option value="Rim">Rim</option>
                                            <option value="Others">Others</option>
                                        </select>
                                </div>
                                <div class="col-lg-5 col-md-5">
                                    <label for='qty_ind'>Qty ind <span style="color:red;font-weigth:bold;">*</span></label>
                                    <input type="number" name="qty_ind" min="1" step="any" id="qty_ind" class="form-control rounded border-secondary" value='<?php echo $qty_ind; ?>' placeholder="Enter Amount" required />
                                </div>
                            </div>

                            <div class="">
                                <label for='cat_name'>Category <span style="color:red;font-weigth:bold;">*</span></label>
                                <select name="cat_name" class="form-control rounded border-secondary select2" required>
                                <?php if($cat_val !=''){
                                        echo $cat_val;
                                    } else{
                                        echo '<option value="" >Choose Category</option>';
                                    }?>
                                    <?php echo $item->getCategory(); ?>
                                </select>
                            </div>

                            <div class="">
                                <label for='remarks'>Remarks</label>
                                <input type="text" name="remarks" id="remarks" class="form-control rounded border-secondary" value='<?php echo $remarks; ?>' placeholder="Remarks"  />
                            </div>
                                
                        </div>
                        <div class="modal-footer">

                            <?php if ($update_item == true ): ?>
                                <input type="submit" name="update_item" id="update_item" class="btn btn-primary btn-sm rounded-0" value="Update" form="itemForm"/>
                            <?php else: ?>
                                <input type="submit" name="save_item" id="save_item" class="btn btn-primary btn-sm rounded-0" value="Add" form="itemForm"/>
                            <?php endif; ?>
                            <a href="controller/item_controller.php?close=0"
                                                class="btn btn-default btn-sm rounded-0 border">Close </a>
                        </div>
                    </form>
    			</div>
    	</div>
        </div> 
        <!--  end of modal item -->
</div>	















<?php 
} 
else{
    header("Location: index.php");
}
?>

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

    function get_unit(select){
        $("#unit").val(select).change();
    }

    function funct_iunit(select){
        // $("#unit").val(select).change();
        // var iunit_package = document.getElementById('i_unit_ind').value = select;
        
        $("#t_unit").html("<option value="+select+" selected>"+select+"</option>  ");
        $("#tunit_2").html("<option value="+select+" selected>"+select+"</option>  ");
    }
    

        let iunit_package = document.getElementById('iunit_package');
    function funct_iUnitInd(select){
        
        console.log(iunit_package.value);
        $("#t_unit").html("<option value="+select+" selected>"+select+"</option> <option value="+iunit_package.value+" selected>"+iunit_package.value+"</option>   ");
        $("#tunit_2").html("<option value="+select+" selected>"+select+"</option> <option value="+iunit_package.value+" selected>"+iunit_package.value+"</option>   ");

    }
    
    $("#checkAll").click(function(){
        if($(this).is(":checked")){
            $(".checkItem").prop('checked', true);
        }else{
            $(".checkItem").prop('checked', false);
        }
    });

</script>