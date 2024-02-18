<?php
session_start();
    $title = "audit trail";
    include('template/header.php');
    include('include/userExist.php');

    $id = 0;
    $update_cat = false;
    $cname = '';
    $divModal = "class='modal fade' style='display:none;' aria-hidden='true' ";
        
    include('controller/audittrail_controller.php');

?>

<?php     
include('template/container.php'); 
// include('menus.php');
if(isset($_SESSION['type'])){
?>
<script src="js/app.js"></script>
<div class="row">
		<div class="col-lg-12">
			    <div class="card card-default rounded-0 shadow">
                    <div class="card-header">
                        <div class="row">
							<div class="col-lg-4 col-md-4 col-sm-8 col-xs-6">
									<h3 class="card-title">AUDIT TRAIL</h3>
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
                                    <!-- <button type="button" name="add" id="audittrailAdd" data-bs-toggle="modal" data-bs-target="#audittrailModal" class="btn btn-primary btn-sm bg-gradient rounded-0"><i class="far fa-plus-square"></i> Add audittrail</button>   -->
                                    <a href="home.php" name="backtohome" class="btn btn-primary btn-sm bg-gradient rounded-0 back">back</a> 		
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
                    		<table id="audittrailList" class="table table-bordered table-striped">
                    			<thead>
                                    <tr>
                                        <th>No.</th>
                                        <!-- <th>ID</th> -->
                                        <th>Transaction</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                        <th>User</th>
                                        <th>Date & Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if(isset($_GET['search'])){
                                            $filter_val = $_GET['search'];
                                            $res = $conn->query("SELECT *, ROW_NUMBER() OVER(ORDER BY date_created ASC) AS Row FROM tbl_audittrail WHERE  CONCAT(descs,trans_type,user_name) LIKE '%$filter_val%'  ") or die($conn->error);
                                        }else{
                                            $res = $conn->query("SELECT *,ROW_NUMBER() OVER(ORDER BY date_created DESC) AS Row  FROM tbl_audittrail ") or die($conn->error);
                                        }
                                    while ($row=$res->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo $row['Row']; ?></td>
                                        <td><?php echo $row['trans_type']; ?></td>
                                        <td><?php echo $row['descs']; ?></td>
                                        <td><?php echo $row['action']; ?></td>
                                        <td><?php echo $row['user_name']; ?></td>
                                        <td><?php echo $row['date_created']; ?></td>
                                        <!-- <td>
                                            <a href="audittrail.php?edit=<?php echo $row['cat_id']; ?>"
                                                class="btn btn-primary rounded-0 btn-sm"><i class="fa-solid fa-pen-to-square"></i> </a>

                                            <a href="controller/audittrail_controller.php?delete=<?php echo $row['cat_id']; ?>"
                                            onclick="return confirm('Are you sure, you want to delete this Audit trail?')"
                                                class="btn btn-danger rounded-0 btn-sm"><i class="fa-solid fa-trash"></i>  </a>
                                        </td> -->
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


    <div id="audittrailModal" <?php echo $divModal; ?> >
    	<div class="modal-dialog modal-dialog-centered">
    			<div class="modal-content">
                    <form method="post" id="audittrailForm" action="controller/audittrail_controller.php">
                        <div class="modal-header">
                            <h4 class="modal-title"><i class="fa fa-plus"></i> Add Audit trail</h4>
                            <!-- <button type="button" id="cat_modal_close" class="btn-close" data-bs-dismiss="modal"></button> -->
                            <a href="controller/audittrail_controller.php?close=0"
                                                class="btn-close"></a>
                        </div>
                        <div class="modal-body">
                            
                                <input type="hidden" name="cat_id" id="cat_id" value="<?php echo $id;?>"/>
                                <!-- <input type="hidden" name="btn_action" id="btn_action"/> -->
                                <label>Audit trail Name</label>
                                <input type="text" name="cat_name" id="cat_name" class="form-control rounded-0" value='<?php echo $cname; ?>' required />
                            
                        </div>
                        <div class="modal-footer">

                            <?php if ($update_cat == true ): ?>
                                <input type="submit" name="update_cat" id="update_cat" class="btn btn-primary btn-sm rounded-0" value="Update" form="audittrailForm"/>
                            <?php else: ?>
                                <input type="submit" name="save_cat" id="save_cat" class="btn btn-primary btn-sm rounded-0" value="Add" form="audittrailForm"/>
                            <?php endif; ?>

                            <!-- <button type="button" class="btn btn-default btn-sm rounded-0 border" data-bs-dismiss="modal">Close</button> -->
                            <a href="controller/audittrail_controller.php?close=0"
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

<script>
    sessionStorage.setItem("btnActive", "home_menu");
</script>


