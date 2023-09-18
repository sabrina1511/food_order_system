<!-- Internal CSS -->
<style>
	.collapse a{
		text-indent:10px;
	}
</style>

<!-- Navigation Bar/Side Bar -->
<nav id="sidebar" class='mx-lt-5 bg-dark' >	
	<div class="sidebar-list">
		<a href="index.php?page=orders" class="nav-item nav-orders"><span class='icon-field'><i class="fa fa-clipboard-list "></i></span> Orders</a>
		<a href="billing/index.php" class="nav-item nav-takeorders"><span class='icon-field'><i class="fa fa-list-ol "></i></span> Take Orders</a>
		
		<!-- Checking Whether Admin Logged In or Staff -->
		<?php if($_SESSION['login_type'] == 1): ?>

		<div class="mx-2 text-white">Master List</div>
		<a href="index.php?page=categories" class="nav-item nav-categories"><span class='icon-field'><i class="fa fa-list-alt "></i></span> Food Categories</a>
		<a href="index.php?page=products" class="nav-item nav-products"><span class='icon-field'><i class="fa fa-th-list "></i></span> Food Items</a>
		
		<?php endif; ?>
			
		<div class="mx-2 text-white">Report</div>
		<a href="index.php?page=sales_report" class="nav-item nav-sales_report"><span class='icon-field'><i class="fa fa-th-list"></i></span> Sales Report</a>
		
		<!-- Checking Whether Admin Logged In or Staff -->
		<?php if($_SESSION['login_type'] == 1): ?>
		
		<div class="mx-2 text-white">Systems</div>
		
		<a href="index.php?page=users" class="nav-item nav-users"><span class='icon-field'><i class="fa fa-users "></i></span> Users</a>
		
		<?php endif; ?>

	</div>
</nav>

<!-- Navigation Tab Active -->
<script>
	$('.nav_collapse').click(function(){
		console.log($(this).attr('href'))
		$($(this).attr('href')).collapse()
	})
	$('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script> 
