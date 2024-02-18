<?php
session_start();
    $title = "category";
    include('template/header.php');
    include('include/userExist.php');

    $id = 0;
    $update_cat = false;
    $cname = '';
    $order_no = 1;
    $divModal = "class='modal fade' style='display:none;' aria-hidden='true' ";
        
    include('controller/category_controller.php');

?>

<?php     
include('template/container.php'); 
include('menus.php');
if(isset($_SESSION['type'])){
?>
<script src="js/app.js"></script>
<div class="row">
		<div class="col-lg-12">
			    <div class="card card-default rounded-0 shadow">
                    <div class="card-header">
                        <div class="row">
							<div class="col-lg-4 col-md-4 col-sm-8 col-xs-6">
									<h3 class="card-title">CATEGORY LIST</h3>
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
                                    <button type="button" name="add" id="categoryAdd" data-bs-toggle="modal" data-bs-target="#categoryModal" class="btn btn-primary btn-sm bg-gradient rounded-0"><i class="far fa-plus-square"></i> Add Category</button>   		
                            </div>
					    </div>
                    <div style="clear:both"></div>
                </div>
                <div class="card card-default rounded-0 shadow">

                    <?php  
                     if (isset($_SESSION['message'])):  ?>
                        <div class="alert alert-<?php echo $_SESSION['msg_type']?>">
                            <?php
                                echo $_SESSION['message'];
                              
                                unset($_SESSION['message']);
                            ?>
                        </div>
                    <?php 
                    endif
                    ?>
                </div>
                <div class="card-body">
                    <div class="row">
                    	<div class="col-sm-12 table-responsive">
                    		<table id="categoryList" class="table table-bordered table-striped">
                    			<thead>
                                    <tr>
                                        <th>No.</th>
                                        <!-- <th>ID</th> -->
                                        <th>Category Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if(isset($_GET['search'])){
                                            $filter_val = $_GET['search'];
                                            $res = $conn->query("SELECT *, ROW_NUMBER() OVER(ORDER BY cat_name ASC) AS Row FROM tbl_category WHERE  CONCAT(cat_name) LIKE '%$filter_val%' AND status!='deleted' ") or die($conn->error);
                                        }else{
                                            $res = $conn->query("SELECT *,ROW_NUMBER() OVER(ORDER BY cat_name ASC) AS Row  FROM tbl_category WHERE status!='deleted' ") or die($conn->error);
                                        }
                                    while ($row=$res->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo $row['Row']; ?></td>
                                        <!-- <td><?php echo $row['cat_id']; ?></td> -->
                                        <td><?php echo strtoupper($row['cat_name']); ?></td>
                                        <td>
                                            <a href="category.php?edit=<?php echo $row['cat_id']; ?>"
                                                class="btn btn-primary rounded-0 btn-sm"><i class="fa-solid fa-pen-to-square"></i> </a>
                                                
                                        <?php
                                        if(isset($_SESSION['type']) && $_SESSION['type']=='admin'){
                                            echo '<a href="controller/category_controller.php?delete='. $row['cat_id'] .'"
                                            onclick="return confirm(\'Are you sure, you want to delete this Category?\')"
                                                class="btn btn-danger rounded-0 btn-sm"><i class="fa-solid fa-trash"></i>  </a>';
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


    <div id="categoryModal" <?php echo $divModal; ?> >
    	<div class="modal-dialog modal-dialog-centered">
    			<div class="modal-content">
                    <form method="post" id="categoryForm" action="controller/category_controller.php">
                        <div class="modal-header">
                            <h4 class="modal-title"><i class="fa fa-plus"></i> Add Category</h4>
                            <!-- <button type="button" id="cat_modal_close" class="btn-close" data-bs-dismiss="modal"></button> -->
                            <a href="controller/category_controller.php?close=0"
                                                class="btn-close"></a>
                        </div>
                        <div class="modal-body">
                            
                                <input type="hidden" name="cat_id" id="cat_id" value="<?php echo $id;?>"/>
                                <!-- <input type="hidden" name="btn_action" id="btn_action"/> -->
                            <div>
                                <label>Category Name <span style="color:red;font-weigth:bold;">*</span></label>
                                <input type="text" name="cat_name" id="cat_name" class="form-control rounded-0" value='<?php echo $cname; ?>' required />
                            
                            </div>
                            <div>
                                <label>Order Number <span style="color:red;font-weigth:bold;">*</span></label>
                                <input type="number" name="order_no" id="order_no" class="form-control rounded-0" value='<?php echo $order_no; ?>' required />
                            
                            </div>
                               
                        </div>
                        <div class="modal-footer">

                            <?php if ($update_cat == true ): ?>
                                <input type="submit" name="update_cat" id="update_cat" class="btn btn-primary btn-sm rounded-0" value="Update" form="categoryForm"/>
                            <?php else: ?>
                                <input type="submit" name="save_cat" id="save_cat" class="btn btn-primary btn-sm rounded-0" value="Add" form="categoryForm"/>
                            <?php endif; ?>

                            <!-- <button type="button" class="btn btn-default btn-sm rounded-0 border" data-bs-dismiss="modal">Close</button> -->
                            <a href="controller/category_controller.php?close=0"
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


