<nav class="navbar navbar-dark bg-primary bg-gradient navbar-expand-lg navbar-expand-md my-1 no-print">
	<div class="container-fluid">
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
			<ul class="nav navbar-nav menus" id="menu_nav">	
				<li class="nav-item border rounded m-1 ">
					<a class="nav-link active" href="home.php" name="home_menu" id="home_menu">HOME</a>
				</li>	
				
				<li class="nav-item border rounded m-1">
					<a class="nav-link" href="category.php" name="category_menu" id="category_menu">CATEGORY</a>
				</li>
				<li class="nav-item border rounded m-1">
					<a class="nav-link" href="employee.php" name="employee_menu" id="employee_menu">EMPLOYEE</a>
				</li>
				<li class="nav-item border rounded m-1">
					<a class="nav-link" href="supplier.php" name="supplier_menu" id="supplier_menu">SUPPLIER</a>
				</li>
				<li class="nav-item border rounded m-1">
					<a class="nav-link" href="item.php" name="item_menu" id="item_menu">ITEM/EQUIPMENT</a>
				</li>
				<?php 
				if($_SESSION['type'] == 'admin' || $_SESSION['type'] == 'manager' ){
					echo '
					<li class="nav-item border rounded m-1">
						<div class="dropdown">
							<a class="nav-link dropdown-toggle" name="trans_menu" id="trans_menu" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								TRANSACTION
							</a>

							<ul class="dropdown-menu ">
							
								<li><a class="dropdown-item" name="trans_menu_add" id="trans_menu_add" href="addstock.php">ADD</a></li>
								<li><a class="dropdown-item" name="trans_menu_rls" id="trans_menu_rls" href="release.php">RELEASE</a></li>
								<li><a class="dropdown-item" name="trans_menu_rls" id="trans_transfer" href="mrtransfer.php">MR TRANSFER</a></li>
								

							</ul>
						</div>
						
					</li>
					';
				}
				
				
				?>
                <!-- <li class="nav-item border rounded m-1">
					<div class="dropdown">
						<a class="nav-link dropdown-toggle" name="trans_menu" id="trans_menu" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							Transaction
						</a>

						<ul class="dropdown-menu">
							<li><a class="dropdown-item" name="trans_menu_add" id="trans_menu_add" href="addstock.php">Add Stock</a></li>
							<li><a class="dropdown-item" name="trans_menu_rls" id="trans_menu_rls" href="release.php">Release item</a></li>

						</ul>
					</div>
					
				</li> -->
			</ul>
		</div>

		<ul class="nav navbar-nav">
			<li class="dropdown position-relative">
				<button type="button" class="badge bg-light border px-3 text-dark rounded-pill dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" data-bs-toggle="dropdown" aria-expanded="false">
					<span class="badge badge-pill bg-danger count"></span> 
					<?php echo $_SESSION['user_name']; ?>
				</button>
				<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
					<li><a class="dropdown-item" name='logout' href="controller/logout_controller.php">Logout</a></li>
					<?php 
					if($_SESSION['type']=='admin'){
						echo '<li><a class="dropdown-item" name="autrail" id="autrail" href="audittrail.php" disabled>Audit trail</a></li>
							  <li><a class="dropdown-item" name="touser" id="touser" href="user.php">User setting</a></li>
						';
					} 
					?>
					
				</ul>
			</li>
		</ul>
	</div>
</nav>

