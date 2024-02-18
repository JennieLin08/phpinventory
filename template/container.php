
</head>
<body class="bg-gradient bg-dark bg-opacity-25">
<!-- <nav role="navigation" class="navbar navbar-dark navbar-static-top bg-primary bg-gradient">
    <div class="container">
      <div class="navbar-header text-center">
        <h5 class="navbar-brand">SANGGUNIANG BAYAN </h5>
      </div>
      <div class="navbar-header">
        <h3 class="navbar-brand">INVENTORY MANAGEMENT SYSTEM</h3>
      </div>
    </div>
  </nav> -->

  <style>
.flex-container {
  display: flex;
  /* background-color: DodgerBlue; */
  background-color: #f1f1f1;
  justify-content: center;
}

.flex-container > div {
  /* background-color: #f1f1f1; */
  margin: 10px;
  /* padding: 20px;
  font-size: 30px; */
  /* align-self: center; */
  text-align:center;
  /* color:white; */
}
.logo{
  padding: 20px;
  font-size: 30px;
}
small{
  /* align-items: flex-start !important;
  align-self: flex-start !important; */
  position: inherit;
  top: 0;
  /* right: 200; */
  width:300px;
}
/* .flex-container div:last-child {
  margin-left: auto;
} */
.grow div:nth-child(2) {
  flex:1;
}
img{
  border-radius:50px;
}

.navbar,.btn-primary{
	background-color:#4682B4 !important;
	border:none;
}

.active{
	/* color:white !important; */
	background-color:#345166;
  border-radius:2px;
}


</style>
<?php
include('controller/db_conn.php');
require_once 'controller/container_controller.php';

?>

<div class="flex-container align-center wrap grow row">
  <div class="col-lg-3 col-md-3">
  	<!-- <div class="logo">logo</div> -->
    <img src="template/lgusolano.jpg" alt="logo" width="80" height="80">
  </div>

  <div class="col-lg-6 col-md-6">
  	<h5>SANGGUNIANG BAYAN</h5>
  	<h3>INVENTORY MANAGEMENT SYSTEM</h3>  
  </div>

  <div class="im col-lg-3 col-md-3">

    <div>
      <small>
        <?php 
        if(isset($_SESSION['type']) && isset($_SESSION['user_name'])){
          echo strtoupper($_SESSION['type']) . ' : ' .$_SESSION['user_name'];
        }
        ?>
      </small>
    </div>
    <div class="row">
      <div class="col-lg-3 d-flex align-items-center justify-content-end">
        <?php
            $res = $conn->query("SELECT item_name, avail_stocks from (SELECT item_name,sum(qty_ind-qty_rls_ind) as avail_stocks FROM tbl_itemtrans WHERE status='Active' AND cat_id in (SELECT cat_id FROM `tbl_notif_category`) GROUP BY item_id ORDER BY item_name ASC) as a WHERE avail_stocks < 10;");
          $cnt = 0;
          while ($row=$res->fetch_assoc()){
            $cnt ++;
          }
          
        ?>
        
        <i class="fa-solid fa-bell" style="font-size:35px;" <?php echo empty($_SESSION['user_name']) ? '' : 'hidden';  ?> ></i>
        <span id="notif" <?php echo empty($_SESSION['user_name']) ? '' : 'hidden';  ?> <?php if($cnt > 0 ){ echo 'style="color:red;font-weight:bold;font-size:20px;"'; } ?> ><?php echo $cnt; ?></span>
      </div>
      <div class="col-lg-8">
        <small id="time"><?php
        // date_default_timezone_set('Asia/Manila');
        // echo  date("m/d/Y") . " | " . date("h:i:sa");
        ?></small>
      </div>
     
    </div>
      
  </div>

</div>

	
	<div class="container">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">
var timestamp = '<?=time();?>';
function updateTime(){
  $('#time').html(Date(timestamp));
  timestamp++;
}
$(function(){
  setInterval(updateTime, 1000);
});
</script>