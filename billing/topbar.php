<!-- Internal CSS -->
<style>
	.logo {
    margin: auto;
    font-size: 20px;
    background: white;
    padding: 7px 11px;
    border-radius: 50% 50%;
    color: #000000b3;
  }
</style>

<!-- Top Navbar -->
<nav class="navbar navbar-light fixed-top bg-primary" style="padding:0">
  <div class="container-fluid mt-2 mb-2">
  	<div class="col-lg-12">
  		<!-- <div class="col-md-1 float-left" style="display: flex;">
  		
  		</div> -->
      <!-- Title -->
      <div class="col-md-4 float-left text-white">
        <large><b>Tasty Shop</b></large>
      </div>
      <!-- Account Settings -->
	  	<div class="float-right">
        <div class=" dropdown mr-4">
            <a href="#" class="text-white dropdown-toggle"  id="account_settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['login_name'] ?> </a>
            <div class="dropdown-menu" aria-labelledby="account_settings" style="left: -2.5em;">
            <a class="dropdown-item" href="../ajax.php?action=logout"><i class="fa fa-power-off"></i> Logout</a>
        </div>
      </div>
    </div>
  </div> 
</nav>