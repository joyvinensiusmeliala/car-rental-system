<?php

session_start();
error_reporting(0);
include('../includes/config.php');

?>

<?php 
// $username=intval($_GET['username']);

$sql = "SELECT * from  tbseller";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{
	echo $result->UserName;
	}}


	?>	

<nav class="ts-sidebar">
	<ul class="ts-sidebar-menu">
		<li class="ts-label">Main</li>
		<li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>

			<?php 
				if($_SESSION['level']=="admin") {
			?>
			
			

			<li>
				<a href="#"><i class="fa fa-user"></i> Data Akun</a>
					<ul>
						<li><a href="akun-admin.php?UserName=<?php echo $result->UserName;?>">Akun Saya</a></li>
						<li><a href="manage-brands.php">Toko Saya</a></li>
					</ul>
			</li>
			<!-- <li>
				<a href="manage-rutes.php"><i class="fa fa-map-marker"></i> Rute Perjalanan</a>
			</li> -->
			<li>
				<a href="#"><i class="fa fa-files-o"></i> Merk Mobil</a>
					<ul>
						<li><a href="create-brand.php">Tambah Merk Mobil</a></li>
						<li><a href="manage-brands.php">Kelola Merk Mobil</a></li>
					</ul>
			</li>

			<li>
				<a href="#"><i class="fa fa-car"></i> Kendaraan</a>
					<ul>
						<li><a href="post-avehical.php">Tambah Kendaraan</a></li>
						<li><a href="manage-vehicles.php">Kelola Kendaraan</a></li>
					</ul>
			</li>

			<li>
				<a href="#"><i class="fa fa-sitemap"></i> Pemesanan</a>
					<ul>
						<li><a href="new-bookings.php">Baru</a></li>
						<li><a href="confirmed-bookings.php">Konfirmasi</a></li>
						<li><a href="canceled-bookings.php">Batal</a></li>
					</ul>
			</li>
			<?php }?>

			<?php 
				if($_SESSION['level']=="master") {
			?>
			<li>
				<a href="testimonials.php"><i class="fa fa-table"></i>Kelola Testimoni</a>
			</li>
			<li>
				<a href="manage-conactusquery.php"><i class="fa fa-desktop"></i> Kelola Kontak</a>
			</li>
			<li>
				<a href="reg-provider.php"><i class="fa fa-users"></i> Admin Penyewa</a>
			</li>
			<li>
				<a href="reg-users.php"><i class="fa fa-users"></i> Kelola User</a>
			</li>
			<!-- <li>
				<a href="manage-pages.php"><i class="fa fa-files-o"></i> Kelola Halaman</a>
			</li> -->
			
			<!-- <li>
				<a href="update-contactinfo.php"><i class="fa fa-files-o"></i> Ubah Kontak Info</a>
			</li> -->
			<li>
				<a href="manage-subscribers.php"><i class="fa fa-table"></i> Kelola Subscribers</a>
			</li>
			</ul>
			<?php }?>
			
		</nav>