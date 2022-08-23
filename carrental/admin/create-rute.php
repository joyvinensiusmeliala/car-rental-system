<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
// Code for change password	
if(isset($_POST['submit']))
{
$username=$_SESSION['UserName'];
$asal=$_POST['asal'];
$tujuan=$_POST['tujuan'];
$harga=$_POST['harga'];
$id_mobil=$_POST['id_mobil'];
$sql="INSERT INTO  tblreadybook(asal,tujuan,HargaPerHari,id_mobil,UserName) VALUES(:asal,:tujuan,:harga,:id_mobil,:username)";
$query = $dbh->prepare($sql);
$query->bindParam(':username',$username,PDO::PARAM_STR);
$query->bindParam(':asal',$asal,PDO::PARAM_STR);
$query->bindParam(':tujuan',$tujuan,PDO::PARAM_STR);
$query->bindParam(':harga',$harga,PDO::PARAM_STR);
$query->bindParam(':id_mobil',$id_mobil,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Brand Created successfully";
echo "
		<script>
		alert('Selamat Merk Mobil Berhasil Ditambahkan!');
		window.location='manage-rutes.php';
		</script>";
}
else 
{
$error="Something went wrong. Please try again";
}

}
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>Car Rental Portal | Admin Create Brand</title>

	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="css/style.css">
  <style>
		.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
		</style>


</head>

<body>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
	<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">
					
						<h2 class="page-title">Tambah Rute Perjalanan</h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Tambah Rute Perjalanan
									<a href="manage-rutes.php" class="btn btn-primary btn-sm">Kembali</a>
									</div>
									<div class="panel-body">
										<form method="post" name="chngpwd" class="form-horizontal" onSubmit="return valid();">
										
											
  	        	  <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
											<div class="form-group">
												<label class="col-sm-2 control-label">Asal</label>
												<div class="col-sm-4">
													<input type="text" class="form-control" name="asal" id="asal" required>
													<input type="hidden" class="form-control" name="username" id="username" value="<?php echo htmlentities($_SESSION['UserName']);?>" >
												</div>
												
											
											
												<label class="col-sm-2 control-label">Select Brand<span style="color:red">*</span></label>
													<div class="col-sm-4">
													<select class="selectpicker" name="id_mobil" required>
													<option value=""> Select </option>
													<?php 
													$username=$_SESSION['UserName'];
													$ret="SELECT id,VehiclesTitle,UserName FROM tblvehicles WHERE UserName='$username'";
													$query= $dbh -> prepare($ret);
													//$query->bindParam(':id',$id, PDO::PARAM_STR);
													$query-> execute();
													$results = $query -> fetchAll(PDO::FETCH_OBJ);
													if($query -> rowCount() > 0)
													{
													foreach($results as $result)
													{
													?>
													<option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->VehiclesTitle);?></option>
													<?php }} ?>

													</select>
													</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Tujuan</label>
												<div class="col-sm-4">
													<input type="text" class="form-control" name="tujuan" id="tujuan" required>
												</div>
												<label class="col-sm-2 control-label">Harga</label>
												<div class="col-sm-4">
													<input type="text" class="form-control" name="harga" id="harga" required>
												</div>
											</div>
											
											<div class="hr-dashed"></div>
											
										
								
											
											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-4">
								
													<button class="btn btn-primary" name="submit" type="submit">Submit</button>
												</div>
											</div>

										</form>

									</div>
								</div>
							</div>
							
						</div>
						
					

					</div>
				</div>
				
			
			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>

</body>

</html>
<?php } ?>