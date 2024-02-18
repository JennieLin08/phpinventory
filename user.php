<?php
session_start();
    $title = "user";
    include('template/header.php');
    include('include/userExist.php');

    $id = 0;
    $update_user = false;
    $name = '';
    $email = '';
    $type='';
    $password='';
    $confirm_pass='';
    $divModal = "class='modal fade' style='display:none;' aria-hidden='true' ";
    $passModal = "class='modal fade' style='display:none;' aria-hidden='true' ";
        
    include('controller/user_controller.php');

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
							<div class="col-lg-6 col-md-4 col-sm-8 col-xs-6">
									<h3 class="card-title">Users List</h3>
							</div>

                            <!-- <div class="col-lg-4 align-self-center  m-0">
                                <form action="" method="GET" class="">
                                    <div class="input-group  ">
                                        <input type="text" name="search" value="<?php if(isset($_GET['search'])){ echo $_GET['search']; };
                                        
                                        ?>" class="form-control" placeholder="Search" >
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div> -->

                            <div class="col-lg-6 col-md-6 col-sm-4 col-xs-6 text-end">
                                    <!-- <button type="button" name="add" id="userAdd" data-bs-toggle="modal" data-bs-target="#userModal" class="btn btn-primary btn-sm bg-gradient rounded-0"><i class="far fa-plus-square"></i> Add Category</button>   		 -->
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
                    		<table id="userList" class="table table-bordered table-striped">
                    			<thead>
                                    <tr>
                                        <th>No.</th>
                                        <!-- <th>ID</th> -->
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if(isset($_GET['search'])){
                                            $filter_val = $_GET['search'];
                                            $res = $conn->query("SELECT *, ROW_NUMBER() OVER(ORDER BY cat_name ASC) AS Row FROM tbl_user WHERE  CONCAT(cat_name) LIKE '%$filter_val%' AND status!='deleted' ") or die($conn->error);
                                        }else{
                                            $res = $conn->query("SELECT *,ROW_NUMBER() OVER(ORDER BY name ASC) AS Row  FROM tbl_user WHERE status!='deleted' AND type !='superadmin' ") or die($conn->error);
                                        }
                                    while ($row=$res->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo $row['Row']; ?></td>
                                        <td><?php echo strtoupper($row['name']); ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo strtoupper($row['type']); ?></td>
                                        <td>
                                            <a href="user.php?edit=<?php echo $row['userid']; ?>"
                                                class="btn btn-primary rounded-0 btn-sm"><i class="fa-solid fa-pen-to-square"></i> </a>
                                            <a href="user.php?changepassword=<?php echo $row['userid']; ?>"
                                                class="btn btn-primary rounded-0 btn-sm">change password </a>

                                            <!-- <a href="controller/user_controller.php?delete=<?php echo $row['userid']; ?>"
                                            onclick="return confirm('Are you sure, you want to delete this Category?')"
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


    <div id="userModal" <?php echo $divModal; ?> >
    	<div class="modal-dialog modal-dialog-centered">
    			<div class="modal-content">
                    <form method="post" id="userForm" action="controller/user_controller.php">
                        <div class="modal-header">
                            <h4 class="modal-title"><i class="fa fa-plus"></i> Edit</h4>
                            <!-- <button type="button" id="cat_modal_close" class="btn-close" data-bs-dismiss="modal"></button> -->
                            <a href="controller/user_controller.php?close=0"
                                                class="btn-close"></a>
                        </div>
                        <div class="modal-body">
                            
                                <input type="hidden" name="cat_id" id="cat_id" value="<?php echo $id;?>"/>
                                <!-- <input type="hidden" name="btn_action" id="btn_action"/> -->
                                <label>Name</label>
                                <input type="text" name="name" id="name" class="form-control rounded-0" value='<?php echo $name; ?>' required />
                            
                        </div>

                        <div class="modal-body">
                                <label>Email</label>
                                <input type="text" name="email" id="email" class="form-control rounded-0" value='<?php echo $email; ?>' required />
                        </div>

                        <div class="modal-body">
                                <label for='type'>Type</label>
                                <select name="type" required class="form-select rounded-0 select2" id="type" required>
                                        <?php if($type !=''): ?>
                                                <?php echo $type ?>
                                            <?php else :?>
                                                <option value="">Select type</option>
                                            <?php endif ?>
                                            <option value="admin">Admin</option>
                                            <option value="manager">Manager</option>
                                            <option value="encoder">Encoder</option>
                                </select>
                            </div>


                        <div class="modal-footer">

                            <?php if ($update_user == true ): ?>
                                <input type="submit" name="update_user" id="update_user" class="btn btn-primary btn-sm rounded-0" value="Update" form="userForm"/>
                            <?php else: ?>
                                <input type="submit" name="save_user" id="save_user" class="btn btn-primary btn-sm rounded-0" value="Add" form="userForm"/>
                            <?php endif; ?>

                            <!-- <button type="button" class="btn btn-default btn-sm rounded-0 border" data-bs-dismiss="modal">Close</button> -->
                            <a href="controller/user_controller.php?close=0"
                                                class="btn btn-default btn-sm rounded-0 border">Close </a>
                        </div>
                    </form>
    			</div>
    	</div>
    </div>
    <div id="passModal" <?php echo $passModal; ?> >
    	<div class="modal-dialog modal-dialog-centered">
    			<div class="modal-content">
                    <form method="post" id="passForm" action="controller/user_controller.php">
                        <div class="modal-header">
                            <h4 class="modal-title"><i class="fa fa-plus"></i> Change Password</h4>
                            <!-- <button type="button" id="cat_modal_close" class="btn-close" data-bs-dismiss="modal"></button> -->
                            <a href="controller/user_controller.php?close=0"
                                                class="btn-close"></a>
                        </div>
                        <div class="modal-body">
                                <input type="hidden" name="id" id="id" value="<?php echo $id;?>"/>
                                <!-- <input type="hidden" name="btn_action" id="btn_action"/> -->
                                <label>Input new password</label>
                                <input type="password" autocomplete="off" name="password" id="password" class="form-control rounded-0" value='<?php echo $password; ?>' required />
                        </div>

                        <div class="modal-body">
                                <label>Confirm Password</label>
                                <input type="password" autocomplete="off" onkeyup="checkpassword(this.value)" name="confirm_pass" id="confirm_pass" class="form-control rounded-0" value='<?php echo $confirm_pass; ?>' required />
                        </div>

                        <div class="modal-footer">
                            <input type="submit" name="update_pass" id="update_pass" class="btn btn-primary  btn-sm rounded-0" value="Update" form="passForm"/>
                            <a href="controller/user_controller.php?close=0"
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script>
    sessionStorage.setItem("btnActive", "home_menu");
    let password = document.getElementById('password');
    let confirm_pass = document.getElementById('confirm_pass');
    let btn_updatepass = document.getElementById("update_pass");

    function checkpassword(val){
        console.log(val);
        console.log(password.value);

        if(password.value !== val){
            $("#update_pass").addClass('disabled');
            $("#confirm_pass").addClass('border border-danger');
        }else{
            $("#update_pass").removeClass('disabled');
            $("#confirm_pass").removeClass('border border-danger');
        }
    }

</script>

