<?php
session_start();
    $title = "supplier";
    include('template/header.php');
    include('include/userExist.php');

    $id = 0;
    $update_sup = false;
    $sname = '';
    $mobile =0;
    $address = '';
    $tin='';
    $divModal = "class='modal fade' style='display:none;' aria-hidden='true' ";
    
    require_once 'controller/supplier_controller.php';

    

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
							<div class="col-lg-4 col-md-8 col-sm-8 col-xs-6">
									<h3 class="card-title">SUPPLIER LIST</h3>
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
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 text-end">
                                    <button type="button" name="add" id="supplierAdd" data-bs-toggle="modal" data-bs-target="#supplierModal" class="btn btn-primary btn-sm bg-gradient rounded-0"><i class="far fa-plus-square"></i> Add Supplier</button>   		
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
                    		<table id="supplierList" class="table table-bordered table-striped">
                    			<thead>
                                    <tr>
                                        <th>No.</th>
                                        <!-- <th>ID</th> -->
                                        <th>Supplier Name</th>
                                        <th>Mobile No.</th>
                                        <th>Address</th>
                                        <th>TIN</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if(isset($_GET['search'])){
                                        $filter_val = $_GET['search'];
                                        $res = $conn->query("SELECT *,ROW_NUMBER() OVER(ORDER BY supplier_name ASC) AS Row  FROM tbl_supplier WHERE CONCAT(supplier_name) LIKE '%".addslashes($filter_val)."%' AND status!='deleted' ") or die($conn->error);
                                    }else{
                                        $res = $conn->query("SELECT *,ROW_NUMBER() OVER(ORDER BY supplier_name ASC) AS Row  FROM tbl_supplier WHERE status!='deleted' ") or die($conn->error);
                                    }
                                    
                                    while ($row=$res->fetch_assoc()): 
                                    ?>
                                    <tr>
                                        <td><?php echo $row['Row']; ?></td>
                                        <!-- <td><?php echo $row['sup_id']; ?></td> -->
                                        <td><?php echo strtoupper($row['supplier_name']); ?></td>
                                        <td><?php echo $row['mobile']; ?></td>
                                        <td><?php echo $row['address']; ?></td>
                                        <td><?php echo $row['tin']; ?></td>
                                        <td>
                                            <a href="supplier.php?edit=<?php echo $row['sup_id']; ?>"
                                                class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i> </a>
                                        <?php
                                            if(isset($_SESSION['type']) && $_SESSION['type']=='admin'){
                                            echo '<a href="controller/supplier_controller.php?delete='. $row['sup_id'].'"
                                            onclick="return confirm(\'Are you sure you want to delete this Supplier?\')"
                                                class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i> </a>';
                                            }
                                        ?>
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


    <div id="supplierModal" <?php echo $divModal; ?> >
    	<div class="modal-dialog modal-dialog-centered">
    			<div class="modal-content">
                    <form method="post" id="supplierForm" action="controller/supplier_controller.php">
                        <div class="modal-header">
                            <h4 class="modal-title"><i class="fa fa-plus"></i> Add Supplier</h4>
                            <a href="controller/supplier_controller.php?close=0"
                                                class="btn-close"></a>
                        </div>
                        <div class="modal-body">
            
                            <input type="hidden" name="sup_id" id="sup_id" value="<?php echo $id;?>"/>
                            <div class="" >
                                <label for='sup_name'>Supplier Name <span style="color:red;font-weigth:bold;">*</span></label>
                                <input type="text" name="sup_name" id="sup_name" pattern="[a-zA-Z0-9_-\.]" class="form-control rounded border-secondary" value="<?php echo $sname; ?>" placeholder="Enter supplier name" required />
                            </div>

                            <div class="">
                                <label for='mobile'>Mobile Number <span style="color:red;font-weigth:bold;">*</span></label>
                                <input type="number" name="mobile" id="mobile" class="form-control rounded border-secondary" value='<?php echo $mobile; ?>' placeholder="Enter supplier number" required />
                            </div>
                            <div class="">
                                <label for='tin'>TIN Number <span style="color:red;font-weigth:bold;">*</span></label>
                                <input type="text" name="tin" id="tin" class="form-control rounded border-secondary" value='<?php echo $tin; ?>' placeholder="Enter supplier TIN" required />
                            </div>

                            <div class="">
                                <label for='address'>Address <span style="color:red;font-weigth:bold;">*</span></label>
                                <input type="text" name="address" id="address" class="form-control rounded border-secondary" value="<?php echo $address; ?>" placeholder="Enter supplier address" required />
                            </div>
                                
                                
                            
                        </div>
                        <div class="modal-footer">

                            <?php if ($update_sup == true ): ?>
                                <input type="submit" name="update_sup" id="update_sup" class="btn btn-primary btn-sm rounded-0" value="Update" form="supplierForm"/>
                            <?php else: ?>
                                <input type="submit" name="save_sup" id="save_sup" class="btn btn-primary btn-sm rounded-0" value="Add" form="supplierForm"/>
                            <?php endif; ?>
                            <a href="controller/supplier_controller.php?close=0"
                                                class="btn btn-default btn-sm rounded-0 border">Close </a>
                        </div>
                    </form>
    			</div>
    	</div>
    </div>
</div>	

<!-- <SCRIPT LANGUAGE="JavaScript">
    function addDashes(f)
    {
    f.value = f.value.slice(0,5)+"-"+f.value.slice(5,10)+"-"+f.value.slice(10,15);
    }
    </SCRIPT> -->













<?php 
} 
else{
    header("Location: index.php");
}
?>