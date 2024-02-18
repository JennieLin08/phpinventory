<?php
session_start();
    $title = "AddTrans";
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
    $qty_2=0;
    $unit = '';
    $description='';
    $amount=0;
    $amount_2=0;
    $remarks='';
    $eul='';
    $total_1=0;
    $total_2=0;
    $gtotal=0;

    $date = date('Y-m-d');  

    $divModal = "class='modal fade' style='display:none;' aria-hidden='true'";

    require_once 'controller/addstock_controller.php';
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
							<div class="col-lg-3 col-md-2 col-sm-2 col-xs-8">
									<h3 class="card-title">ADD TRANSACTION</h3>
							</div>
                            <div class="col-lg-3 w-10 catrow align-items-center align-self-center  m-0" >
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
                                                echo '<option value="'.$row["cat_id"].'#>'.$row["cat_name"].'">'.$row["cat_name"].'</option>';
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


                            <div class="col-lg-2 col-md-3 col-sm-5 col-xs-8 text-end align-self-center">
                                    <button type="button" name="add" id="itemAdd" data-bs-toggle="modal" data-bs-target="#itemModal" class="btn btn-primary btn-sm bg-gradient rounded-0"><i class="far fa-plus-square"></i> Add stocks</button>   		
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
                        <form method="post" action="controller/addstock_controller.php">
                        <input type="submit" <?php if($_SESSION['type']!='admin'){ echo 'hidden';}  ?> name="submitDel" value="Delete" onclick="return confirm('Are you sure to delete this transaction/s')" class="btn btn-danger m-1">
                    		<table id="itemList" class="table table-bordered table-striped">
                    			<thead>
                                    <tr>
                                        <th <?php if($_SESSION['type']!='admin'){ echo 'hidden';}  ?> ><input  type="checkbox" id="checkAll" ></th> 
                                        <th>No.</th>
                                        <th>Item name</th>
                                        <th>Category</th>
                                        <!-- <th>Price</th> -->
                                        <th>Qty & Unit 1</th>
                                        <th>Qty & Unit 2</th>
                                        <th>Total</th>
                                        <th>Transaction_date</th>
                                        <th>Add_action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php 
                                    $total = 0;
                                    if(isset($_GET['search'])){
                                        $filter_val = $_GET['search'];

                                        // $res = $conn->query("SELECT *,ROW_NUMBER() OVER(ORDER BY t.date_created DESC) AS Row,t.item_name,t.cat_name,t.amount,t.qty_ind,i.unit,t.total,t.trans_date FROM tbl_itemtrans as t
                                        // JOIN tbl_item as i ON i.item_id = t.item_id  WHERE CONCAT(t.item_name,t.item_code) LIKE '%$filter_val%' AND t.status='Active' AND t.trans_type='add' ") or die($conn->error);
                                        $res = $conn->query("SELECT *,ROW_NUMBER() OVER(ORDER BY t.date_created DESC) AS Row,t.item_name,t.cat_name,t.amount,t.qty_ind,i.qty as i_qty, t.qty as t_qty,t.unit,i.unit_group,t.total,t.trans_date FROM tbl_itemtrans as t
                                        JOIN tbl_item as i ON i.item_id = t.item_id  WHERE CONCAT(t.item_name,t.item_code) LIKE '%$filter_val%' AND t.status='Active' AND t.trans_type='add' ") or die($conn->error);

                                    }elseif(isset($_GET['category']) && $_GET['category'] != 'All' ){
                                        $res = $conn->query("SELECT *,ROW_NUMBER() OVER(ORDER BY t.date_created DESC) AS Row,t.item_name,t.cat_name,t.amount,t.qty_ind,i.qty as i_qty, t.qty as t_qty,t.unit,i.unit_group,t.total,t.trans_date FROM tbl_itemtrans as t
                                        JOIN tbl_item as i ON i.item_id = t.item_id  WHERE t.status='Active' and t.cat_id='$cat_select_id' AND t.trans_type='add' ") or die($conn->error);

                                        // $res = $conn->query("SELECT *,ROW_NUMBER() OVER(ORDER BY t.date_created DESC) AS Row,t.item_name,t.cat_name,t.amount,t.qty_ind,i.unit,t.total,t.trans_date FROM tbl_itemtrans as t
                                        // JOIN tbl_item as i ON i.item_id = t.item_id  WHERE t.status='Active' and t.cat_id='$cat_select_id' AND t.trans_type='add' ") or die($conn->error);
                                    }else{
                                        $res = $conn->query("SELECT *,ROW_NUMBER() OVER(ORDER BY t.date_created DESC) AS Row,t.item_name,t.cat_name,t.amount,t.qty_ind,i.qty as i_qty, t.qty as t_qty,t.unit,i.unit_group,t.total,t.trans_date FROM tbl_itemtrans as t
                                        JOIN tbl_item as i ON i.item_id = t.item_id  WHERE t.status='Active' AND t.trans_type='add' ") or die($conn->error);

                                    }
                                    
                                    
                                    while ($row=$res->fetch_assoc()): 
                                    $total+=$row['total'];
                                    // $qty_group = $row['qty_ind']/$row['qty'];
                                    // if($row['unit'] == $row['unit_group']){
                                    //     $echo = $row['qty_ind'] . ' ' .$row['unit_group'];
                                    // }else{
                                        
                                    //     $echo = $qty_group . ' ' .$row['unit_group']. ' / ' .$row['qty_ind'] . ' ' .$row['unit']  ;
                                    // }
                                    
                                    ?>
                                    <tr>
                                        
                                        <td <?php if($_SESSION['type']!='admin'){ echo 'hidden';}  ?>><input type="checkbox" class="checkItem" value="<?php echo $row['id']; ?>" name="id[]"></td>
                                        <td><?php echo $row['Row']; ?></td>
                                        <td><?php echo strtoupper($row['item_name']); ?></td>
                                        <td><?php echo $row['cat_name']; ?></td>
                                        <!-- <td><?php echo number_format($row['amount'],2); ?></td> -->
                                        <td><?php echo $row['t_qty'] . ' ' . $row['unit']; ?></td>
                                        <td><?php echo $row['qty_2'] . ' ' .$row['unit_2']; ?></td>
                                        <td><?php echo number_format($row['total'],2); ?></td>
                                        <td><?php echo 
                                        date("m-d-Y", strtotime($row['trans_date']));
                                         ?></td>
                                        <td>
                                            <a href="addstock.php?edit=<?php echo $row['id']; ?>"
                                                class="btn btn-primary rounded-0 btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <?php
                                        if(isset($_SESSION['type']) && $_SESSION['type']=='admin'){
                                            echo '<a href="controller/addstock_controller.php?delete='.$row['id'].'"
                                             onclick="return confirm(\'Are you sure you want to delete this Transaction?\')"
                                                class="btn btn-danger rounded-0 btn-sm"><i class="fa-solid fa-trash"></i> </a>';
                                        }
                                        ?>
                                        </td>
                                    </tr>  

                                    <?php endwhile; ?> 
                                    <tr>
                                        <th colspan="6">Total</th>
                                        <th colspan=""><?php  echo '₱ '.number_format($total); ?></th>
                                    </tr>
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
                    <form method="post" id="itemForm" action="controller/addstock_controller.php">
                        <div class="modal-header">
                            <h4 class="modal-title"><i class="fa fa-plus"></i> Add</h4>
                            <a href="controller/addstock_controller.php?close=0"
                                                class="btn-close"></a>
                        </div>
                        <div class="modal-body">

                            <div class="">
                                <label for='date'>Transaction date <span style="color:red;font-weigth:bold;">*</span></label>
                                <input type="date" name="date" id="date" class="form-control rounded border-secondary" value='<?php echo $date; ?>' placeholder="Date" required />
                            </div>

                            <div class="">
                                <input type="hidden" name="trans_id" id="trans_id" value="<?php echo $id;?>"/>
                                <label for='item_name'>Select item <span style="color:red;font-weigth:bold;">*</span></label>
                                <!-- <input type="text" name="item_name" id="item_name" class="form-control rounded border-secondary" value='<?php echo $item_name; ?>' placeholder="Enter item name" required /> -->
                                <select name="item_name" id="item_name" onchange="func_item_val(this.options[this.selectedIndex].value)"  class="form-control select2 rounded border-secondary" required>
                                        <?php if($item_val !=''){
                                            echo $item_val;
                                        } else{
                                            echo '<option value="">Choose Item</option>';
                                        }?>
                                        <?php echo $item->getItem(); ?>
                                </select>
                            </div>
                           

                            <div class="">
                                <label for='sup_name'>Supplier </label>
                                <select name="sup_name" class="form-control rounded border-secondary select2">
                                    <?php if($sup_val !=''){
                                        echo $sup_val;
                                    } else{
                                        echo '<option value="">Choose supplier</option>';
                                    }?>
                                    <?php echo $item->getSupplier(); ?>
                                </select>
                            </div>

                            <div class="">
                                <label for='description'>Description</label>
                                <!-- <input type="text" name="description" id="description" class="form-control rounded border-secondary" value='<?php echo $description; ?>' placeholder="Enter Description" required /> -->
                                <textarea name="description" id="description" value='<?php echo $description; ?>'  class="form-control rounded border-secondary" rows="2"><?php echo $description; ?></textarea>
                            </div>


                            <div class="row border border-secondary rounded p-1 m-1">
                                <div class="col-lg-3">
                                    <label for='qty'>Qty <span style="color:red;font-weigth:bold;">*</span></label>
                                    <input type="number" name="qty" min="1" id="qty" onchange="myFunc_qty(this.value)" class="form-control rounded border-secondary" value='<?php echo $qty; ?>' placeholder="Enter quantity" required />
                                </div>

                                <div class="col-lg-4">
                                    <label for='unit'>Unit_1 <span style="color:red;font-weigth:bold;">*</span></label>
                                    <select name="unit" required class="form-select rounded-0 select2" id="unit" required>
                                            <?php if($unit !=''): ?>
                                                <option ><?php echo $unit ?></option>
                                            <?php endif ?>
                                    </select>
                                </div>
                                <div class="col-lg-5">
                                    <label for='amount'>Amount per Unit <span style="color:red;font-weigth:bold;">*</span></label>
                                    <input type="number" name="amount" min="1" step="any" id="amount" onchange="myFunc_amnt(this.value)" class="form-control rounded border-secondary" value='<?php echo $amount; ?>' placeholder="Enter Amount" required />
                                </div>
                                <div class="col-lg-4">
                                    <label for='total_1'>total  </label>
                                    <input type="number" name="total_1" min="1" step="any" disabled id="total_1" class="form-control rounded border-secondary" value='<?php echo $total_1; ?>'   />
                                </div>
                            </div>


                            <div class="row border border-secondary rounded p-1 m-1" hidden id="div2">
                                <div class="col-lg-3">
                                    <label for='qty_2'>Qty </label>
                                    <input type="number" name="qty_2" min="0" id="qty_2" onchange="myFunc_qty2(this.value)" class="form-control rounded border-secondary" value='<?php echo $qty_2; ?>' placeholder="Enter quantity" />
                                </div>

                                <div class="col-lg-5">
                                    <label for='unit_2'>Unit_2 </label>
                                    <select name="unit_2" class="form-select rounded-0 select2" id="unit_2" >
                                            <?php if($unit !=''): ?>
                                                <option ><?php echo $unit ?></option>
                                            <?php endif ?>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <label for='amount_2'>Amount per Unit </label>
                                    <input type="number" name="amount_2" min="0" step="any" id="amount_2" onchange="myFunc_amnt2(this.value)" class="form-control rounded border-secondary" value='<?php echo $amount_2; ?>' placeholder="Enter Amount" />
                                </div>
                                <div class="col-lg-4">
                                    <label for='total_2'>total  </label>
                                    <input type="number" name="total_2" step="any" disabled id="total_2" class="form-control rounded border-secondary"   value='<?php echo $total_2; ?>'  />
                                </div>
                                <div class="col-lg-4">
                                    <label for='gtotal'>Grand total </label>
                                    <input type="number" name="gtotal" step="any" disabled id="gtotal" class="form-control rounded border-secondary"  value='<?php echo $gtotal; ?>' placeholder="Estimated Useful Life"  />
                                </div>
                                
                            </div>
                            
                            <!-- <div class="row">

                            </div> -->
                            
                            <div class="">
                                <label for='eul'>Estimated Useful Life <span style="color:red;font-weigth:bold;">*</span></label>
                                <input type="text" name="eul" id="eul" class="form-control rounded border-secondary" value='<?php echo $eul; ?>' placeholder="Estimated Useful Life" required />
                            </div>
                            <div class="">
                                <label for='remarks'>Remarks </label>
                                <input type="text" name="remarks" id="remarks" class="form-control rounded border-secondary" value='<?php echo $remarks; ?>' placeholder="Remarks" />
                            </div>
                                
                                
                            
                        </div>
                        <div class="modal-footer">

                            <?php if ($update_stock == true ): ?>
                                <input type="submit" name="update_item" id="update_item" class="btn btn-primary btn-sm rounded-0" value="Update" form="itemForm"/>
                            <?php else: ?>
                                <input type="submit" name="save_item" id="save_item" class="btn btn-primary btn-sm rounded-0" value="Add" form="itemForm"/>
                            <?php endif; ?>
                            <a href="controller/addstock_controller.php?close=0"
                                                class="btn btn-default btn-sm rounded-0 border">Close </a>
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

    

    function func_item_val(val){
        let get_itemid= val.split('#>');
        let get_unit = get_itemid[2];
        let get_desc = get_itemid[3];
        let get_unitGroup = get_itemid[4];
        let get_catId = get_itemid[5];
        
        if(get_catId=='64'){
            console.log(get_catId);
            $('#div2').removeAttr('hidden');
            $('#total_2').removeAttr('hidden');
        }else{
            $('#div2').attr('hidden','');
            $('#total_2').removeAttr('hidden');
        }
        
        
        // document.getElementById('unit').inner = get_unit;
        document.getElementById('description').value = get_desc;
        $("#unit").html("<option value="+get_unit+" selected>"+get_unit+"</option>  <option value="+get_unitGroup+">"+get_unitGroup+"</option>");
        document.getElementById('description').value = get_desc;
        $("#unit_2").html("<option value="+get_unit+" selected>"+get_unit+"</option>  <option value="+get_unitGroup+">"+get_unitGroup+"</option>");

    }

    let qty = document.getElementById('qty');
    let amnt = document.getElementById('amount');
    let qty_2 = document.getElementById('qty_2');
    let amnt_2 = document.getElementById('amount_2');
    let total_1 = document.getElementById('total_1');
    let total_2 = document.getElementById('total_2');

    function myFunc_qty(val){
        document.getElementById('total_1').value= val * amnt.value;
        document.getElementById('gtotal').value= parseFloat(total_1.value) + parseFloat(total_2.value);

    }
    
    function myFunc_amnt(val){
        document.getElementById('total_1').value= qty.value * val;
        document.getElementById('gtotal').value= parseFloat(total_1.value) + parseFloat(total_2.value);

    }

    function myFunc_qty2(val){
        document.getElementById('total_2').value= val * amnt_2.value;
        document.getElementById('gtotal').value= parseFloat(total_1.value) + parseFloat(total_2.value);

    }

    function myFunc_amnt2(val){
        document.getElementById('total_2').value= qty_2.value * val;
        document.getElementById('gtotal').value= parseFloat(total_1.value) + parseFloat(total_2.value);
    }

      
    $("#checkAll").click(function(){
        if($(this).is(":checked")){
            $(".checkItem").prop('checked', true);
        }else{
            $(".checkItem").prop('checked', false);
        }
    });

</script>

