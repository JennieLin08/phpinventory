<?php
session_start();
    $title = "employee";
    include('template/header.php');
    include('include/userExist.php');


    $id = 0;
    $update_emp = false;
    $emp_name = '';
    $mobile =0;
    $address = '';
    $office = '';
    $section = '';
    $divModal = "class='modal fade' style='display:none;' aria-hidden='true' ";
    
    require_once 'controller/employee_controller.php';

    $res = $conn->query("SELECT * FROM tbl_employee WHERE status!='deleted' ") or die($conn->error);

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
							<div class="col-lg-4 col-md-4 col-sm-8 col-xs-6">
									<h3 class="card-title">EMPLOYEE LIST</h3>
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
                                    <button type="button" name="add" id="employeeAdd" data-bs-toggle="modal" data-bs-target="#employeeModal" class="btn btn-primary btn-sm bg-gradient rounded-0"><i class="far fa-plus-square"></i> Add Employee</button>   		
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
                    		<table id="employeeList" class="table table-bordered table-striped">
                    			<thead>
                                    <tr>
                                        <th>No.</th>
                                        <!-- <th>ID</th> -->
                                        <th>Employee Name</th>
                                        <th>Mobile No.</th>
                                        <th>Address</th>
                                        <th>Section</th>
                                        <th>Office</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if(isset($_GET['search'])){
                                        $filter_val = $_GET['search'];
                                        $res = $conn->query("SELECT *, ROW_NUMBER() OVER(ORDER BY name ASC) AS Row FROM tbl_employee WHERE  CONCAT(name) LIKE '%$filter_val%' AND status!='deleted' ") or die($conn->error);
                                    }else{
                                        $res = $conn->query("SELECT *,ROW_NUMBER() OVER(ORDER BY name ASC) AS Row  FROM tbl_employee WHERE status!='deleted' ") or die($conn->error);
                                    }
                                    while ($row=$res->fetch_assoc()): 
                                    ?>
                                    <tr>
                                        <td><?php echo $row['Row']; ?></td>
                                        <!-- <td><?php echo $row['emp_id']; ?></td> -->
                                        <td><?php echo strtoupper($row['name']); ?></td>
                                        <td><?php echo $row['mobile']; ?></td>
                                        <td><?php echo $row['address']; ?></td>
                                        <td><?php echo $row['section']; ?></td>
                                        <td><?php echo $row['office']; ?></td>
                                        <td>
                                            <a href="employee.php?edit=<?php echo $row['emp_id']; ?>"
                                                class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i> </a>

                                            <?php
                                            if(isset($_SESSION['type']) && $_SESSION['type']=='admin'){
                                            echo '<a href="controller/employee_controller.php?delete='. $row['emp_id'].'"
                                            onclick="return confirm(\'Are you sure you want to delete this Employee?\')"
                                                class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i> </a>';
                                            }
                                            ?>

                                            <a href="print/employeetrans.php?id=<?php echo $row['emp_id']; ?>"
                                                class="btn btn-warning btn-sm"><i class="fa-solid fa-align-justify"></i></a>
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


    <div id="employeeModal" <?php echo $divModal; ?> >
    	<div class="modal-dialog modal-dialog-centered">
    			<div class="modal-content">
                    <form method="post" id="employeeForm" action="controller/employee_controller.php">
                        <div class="modal-header">
                            <h4 class="modal-title"><i class="fa fa-plus"></i> Add Employee</h4>
                            <a href="controller/employee_controller.php?close=0"
                                                class="btn-close"></a>
                        </div>
                        <div class="modal-body">
            
                            <input type="hidden" name="emp_id" id="emp_id" value="<?php echo $id;?>"/>
                            <div class="" >
                                <label for='emp_name'>Employee Name <span style="color:red;font-weigth:bold;">*</span></label>
                                <input type="text" name="emp_name" id="emp_name" class="form-control rounded border-secondary" value='<?php echo $emp_name; ?>' placeholder="Enter employee name" required />
                            </div>

                            <div class="">
                                <label for='mobile'>Mobile Number <span style="color:red;font-weigth:bold;">*</span></label>
                                <input type="number" name="mobile" id="mobile" class="form-control rounded border-secondary" value='<?php echo $mobile; ?>' placeholder="Enter employee number" required />
                            </div>

                            <div class="">
                                <label for='address'>Address<span style="color:red;font-weigth:bold;">*</span></label>
                                <input type="text" name="address" id="address" class="form-control rounded border-secondary" value='<?php echo $address; ?>' placeholder="Enter employee address" required />
                            </div>
                            <div class="">
                                <label for='section'>Section <span style="color:red;font-weigth:bold;">*</span></label>
                                <input type="text" name="section" id="section" class="form-control rounded border-secondary" value='<?php echo $section; ?>' placeholder="Enter employee Section" required />
                            </div>

                            <div class="">
                                <label for='office'>Office <span style="color:red;font-weigth:bold;">*</span></label>
                                <input type="text" name="office" id="office" class="form-control rounded border-secondary" value='<?php echo $office; ?>' placeholder="Enter employee office" required />
                            </div>
                                
                                
                            
                        </div>
                        <div class="modal-footer">

                            <?php if ($update_emp == true ): ?>
                                <input type="submit" name="update_emp" id="update_emp" class="btn btn-primary btn-sm rounded-0" value="Update" form="employeeForm"/>
                            <?php else: ?>
                                <input type="submit" name="save_emp" id="save_emp" class="btn btn-primary btn-sm rounded-0" value="Add" form="employeeForm"/>
                            <?php endif; ?>
                            <a href="controller/employee_controller.php?close=0"
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