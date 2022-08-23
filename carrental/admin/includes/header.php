<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{ 

if($_SESSION['level']=="admin") {

?>
	<div class="brand clearfix">
	<a href="dashboard.php" style="font-size:25px; font-family: Lucida Calligraphy;"> Sistem 
	Booking Sewa Mobil Samosir | admin Panel</a>  
		<span class="menu-btn"><i class="fa fa-bars"></i></span>
		<ul class="ts-profile-nav">
			
			<li class="ts-account">
				<a href="#"><img src="img/ts-avatar.jpg" class="ts-avatar hidden-side" alt=""><?php echo $_SESSION['UserName'];?> <i class="fa fa-angle-down hidden-side"></i></a>
				<ul>
					<li><a href="change-password.php">Change Password</a></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</li>
		</ul>
	</div>

<?php } 

if($_SESSION['level']=="master") {

?>
	<div class="brand clearfix">
	<a href="dashboard.php" style="font-size: 25px; font-family: Lucida Calligraphy;"> Sistem 
	Booking Sewa Mobil Samosir | Master Admin Panel</a>  
		<span class="menu-btn"><i class="fa fa-bars"></i></span>
		<ul class="ts-profile-nav">
			
			<li class="ts-account">
				<a href="#"><img src="img/ts-avatar.jpg" class="ts-avatar hidden-side" alt=""><?php echo $_SESSION['UserName'];?> <i class="fa fa-angle-down hidden-side"></i></a>
				<ul>
					<li><a href="change-password.php">Change Password</a></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</li>
		</ul>
	</div>
	
<?php } 
}?>