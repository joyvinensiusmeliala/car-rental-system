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
	$email=$_POST['email'];
	$namausaha=$_POST['namausaha'];
	$nama=$_POST['nama'];
	$alamat=$_POST['alamat'];
	$contactno=$_POST['contactno'];
	$namabank=$_POST['namabank'];
	$norek=$_POST['norek'];
	$username=$_SESSION['UserName'];
	$sql="UPDATE tbseller SET NamaUsaha=:namausaha,Nama=:nama,Address=:alamat,ContactNo=:contactno,Email=:email,NamaBank=:namabank,NoRekening=:norek WHERE UserName=:username";
	$query = $dbh->prepare($sql);
	$query->bindParam(':namausaha',$namausaha,PDO::PARAM_STR);
	$query->bindParam(':nama',$nama,PDO::PARAM_STR);
	$query->bindParam(':alamat',$alamat,PDO::PARAM_STR);
	$query->bindParam(':contactno',$contactno,PDO::PARAM_STR);
	$query->bindParam(':email',$email,PDO::PARAM_STR);
	$query->bindParam(':namabank',$namabank,PDO::PARAM_STR);
	$query->bindParam(':norek',$norek,PDO::PARAM_STR);
	$query->bindParam(':username',$username,PDO::PARAM_STR);
	$query->execute();

	$sql2="UPDATE admin SET Nama=:nama,Email=:email WHERE UserName=:username";
	$query2 = $dbh->prepare($sql2);
	$query2->bindParam(':nama',$nama,PDO::PARAM_STR);
	$query2->bindParam(':username',$username,PDO::PARAM_STR);
	$query2->bindParam(':email',$email,PDO::PARAM_STR);
	// $query2->bindParam(':level',$level,PDO::PARAM_STR);
	// $query2->bindParam(':password',$password,PDO::PARAM_STR);
	$query2->execute();
	$lastInsertId = $dbh->lastInsertId();

	$msg="Akun Update successfully";
	echo "
		<script>
		
		window.location='akun-admin.php';
		</script>";
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
	
	<title>Car Rental Portal | Admin Update Brand</title>

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
						<h2 class="page-title">Update Profile</h2>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Update Profile</div>
									<div class="panel-body">
										<form method="post" name="chngpwd" class="form-horizontal" onSubmit="return valid();">				
											<?php 
												if($error){
											?>
												<div class="errorWrap">
													<strong>ERROR</strong>:
											<?php 
											echo htmlentities($error); 
											?> 
												</div>
											<?php } 
												else if($msg){
											?>
												<div class="succWrap"><strong>SUCCESS</strong>:
											<?php echo htmlentities($msg); ?> 
												</div>
											<?php }?>

											<?php	
												$username=$_SESSION['UserName'];
												$ret="select * from tbseller where UserName=:username";
												$query= $dbh -> prepare($ret);
												$query->bindParam(':username',$username, PDO::PARAM_STR);
												$query-> execute();
												$results = $query -> fetchAll(PDO::FETCH_OBJ);
												$cnt=1;
												if($query -> rowCount() > 0)
												{
												foreach($results as $result)
												{
											?>

											<div class="form-group">
												<label class="col-sm-2 control-label">Nama Pemilik</label>
													<div class="col-sm-10">
														<input type="text" class="form-control" value="<?php echo htmlentities($result->Nama);?>" name="nama" id="nama" required>
													</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Nama Usaha</label>
													<div class="col-sm-4">
														<input type="text" class="form-control" value="<?php echo htmlentities($result->NamaUsaha);?>" name="namausaha" id="namausaha" required>
													</div>
												<label class="col-sm-2 control-label">Contact No<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="text" name="contactno" class="form-control" value="<?php echo htmlentities($result->ContactNo);?>" id="contactno" required>
													</div>
											</div>
											
											<div class="form-group">
												<label class="col-sm-2 control-label">Username</label>
													<div class="col-sm-4">
														<input type="text" class="form-control" value="<?php echo htmlentities($result->UserName);?>" name="username" id="username" disabled>
													</div>
												<label class="col-sm-2 control-label">Email<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="text" name="email" class="form-control" value="<?php echo htmlentities($result->Email);?>" id="email" required>
													</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Nama Bank</label>
													<div class="col-sm-4">
														<input type="text" class="form-control" value="<?php echo htmlentities($result->NamaBank);?>" name="namabank" id="namabank">
													</div>
												<label class="col-sm-2 control-label">No Rekning</label>
													<div class="col-sm-4">
														<input type="text" class="form-control" value="<?php echo htmlentities($result->NoRekening);?>" name="norek" id="norek">
													</div>
												
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Alamat</label>
													<div class="col-sm-10">
													<textarea class="form-control" name="alamat" id="alamat" required><?php echo htmlentities($result->Address);?></textarea>
													</div>
											</div>

											
											
											<div class="hr-dashed"></div>
											
											<?php }} ?>
											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-4">
								
													<button class="btn btn-primary" name="submit" type="submit" style="float:right;">Submit</button>
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