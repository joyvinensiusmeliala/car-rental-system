<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
if(isset($_GET['del']))
{
$id=$_GET['del'];
$sql = "delete from admin  WHERE id=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> execute();
$msg="Page data updated  successfully";

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
	
	<title>Car Rental Portal | Admin   </title>

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

						<h2 class="page-title">Data Admin</h2>
						<!-- <a href="tambah-provider.php" class="btn btn-primary">Tambah Admin</a> -->
						<!-- <div class="login_btn"> <a href="#daftarprovider" class="btn btn-primary" data-toggle="modal" data-dismiss="modal">Login / Register</a> </div> -->
						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">Reg Users
							<a href="#daftarprovider" class="btn btn-primary btn-sm" data-toggle="modal" data-dismiss="modal">Tambah Admin</a>
							<!-- <button type="button" class="btn btn-primary">Primary</button> -->
							</div>
							<div class="panel-body">
							<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										<th>#</th>
												<th> Nama</th>
												<th> Email</th>
												<th> Level</th>
												<th> Update </th>
												<th> Action</th>
										</tr>
									</thead>
									<tbody>

									<?php $sql = "SELECT * from  admin ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{				?>	
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($result->UserName);?></td>
											<td><?php echo htmlentities($result->Email);?></td>
											<td><?php echo htmlentities($result->level);?></td>
											<td><?php echo htmlentities($result->updationDate);?></td>
											<td>
												<!-- <a href="edit-brand.php?id=<?php echo $result->id;?>">
												<i class="fa fa-edit"></i></a>&nbsp;&nbsp; -->
												<!-- <button type="button" class="btn btn-primary btn-sm" data-ds-toggle="modal" data-bs-target="#edit">Edit</button> -->
												<a href="#edit<?php echo $result->id;?>" 
												class="btn btn-primary btn-sm" data-toggle="modal" 
												data-dismiss="modal"><i class="fa fa-edit"> Edit</i></a>
												
												
												
												
												<a class="btn btn-danger btn-sm" href="reg-provider.php?del=<?php echo $result->id;?>"
												onclick="return confirm('Apakah Anda Yakin Hapus Data Admin?');">
												<i class="fa fa-close"></i>Hapus</a>
											</td>
										</tr>
										<!-- Start Modal Edit   -->

										<?php
												//error_reporting(0);
												if(isset($_POST['editprovider']))
												{
												$username=$_POST['username'];
												$email=$_POST['emailid']; 
												$level=$_POST['level'];
												// $password=md5($_POST['password']); 
												// $sql="INSERT INTO  admin(Username,Email,level,Password) VALUES(:username,:email,:level,:password)";
												$sql="UPDATE admin SET UserName=:username,Email=:email,level=:level WHERE Email=:email";
												$query = $dbh->prepare($sql);
												$query->bindParam(':username',$username,PDO::PARAM_STR);
												$query->bindParam(':email',$email,PDO::PARAM_STR);
												$query->bindParam(':level',$level,PDO::PARAM_STR);
												// $query->bindParam(':password',$password,PDO::PARAM_STR);
												$query->execute();
												// $lastInsertId = $dbh->lastInsertId();
												if($query){
													echo "
													<script>
													alert('Selamat Data Admin Berhasil Di Ubah');
													window.location='reg-provider.php';
													</script>";
												}
												}

												?>


												<script>
												function checkAvailability() {
												$("#loaderIcon").show();
												jQuery.ajax({
												url: "check_availability.php",
												data:'emailid='+$("#emailid").val(),
												type: "POST",
												success:function(data){
												$("#user-availability-status").html(data);
												$("#loaderIcon").hide();
												},
												error:function (){}
												});
												}
												</script>
												<script type="text/javascript">
												function valid()
												{
												
												document.signup.confirmpassword.focus();
												return false;
												}
												
												</script>

												<div class="modal fade" id="edit<?php echo $result->id;?>">
													<div class="modal-dialog">
														<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
															<h3 class="modal-title">Isi Data Admin <?php echo $result->UserName;?></h3>
														</div>
														<div class="modal-body">
															<div class="row">
															<div class="signup_wrap">
																<div class="col-md-12 col-sm-6">
																<form  method="post" action="">
																<div class="form-group">
																<label class="control-label">Username</label>
																<input class="form-control white_bg" name="username" value="<?php echo htmlentities($result->UserName);?>" id="username" type="text"  required>
																</div>
																<div class="form-group">
																<label class="control-label">Email Address</label>
																<input class="form-control white_bg" value="<?php echo htmlentities($result->Email);?>" name="emailid" id="emailid" type="email" onBlur="checkAvailability()" required>
																<!-- <input type="email" class="form-control" name="emailid" id="emailid" onBlur="checkAvailability()" placeholder="Email Address" required="required"> -->
																</div>
																<div class="form-group">
																<label class="control-label">Level</label>
																<input class="form-control white_bg" name="level" value="<?php echo htmlentities($result->level);?>" id="level" type="text" required>
																</div>
																	<div class="form-group checkbox">
																	<input type="checkbox" id="terms_agree" required="required" checked="">
																	<label for="terms_agree">I Agree with <a href="#">Terms and Conditions</a></label>
																	</div>
																	<div class="form-group">
																	<input type="submit" value="Edit" name="editprovider" id="submit" class="btn btn-primary btn-lg btn-block">
																	<!-- <button class="btn btn-primary" name="submit" type="submit">Submit</button> -->
																	</div>
																</form>
																</div>
																
															</div>
															</div>
														</div>
														
														</div>
													</div>
													</div>

													<!-- End Edit Admin  -->
										<?php $cnt=$cnt+1; }} ?>
										
									</tbody>
								</table>

								
						

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

<!-- Modal Tambah Admin  -->

<?php
	//error_reporting(0);
	if(isset($_POST['signup']))
	{
	$username=$_POST['username'];
	$email=$_POST['emailid']; 
	$level=$_POST['level'];
	$password=md5($_POST['password']); 
	$sql="INSERT INTO admin(UserName,Email,level,Password) VALUES(:username,:email,:level,:password)";
	$sql2="INSERT INTO tbseller(UserName,Email) VALUES(:username,:email)";
	$query = $dbh->prepare($sql);
	$query->bindParam(':username',$username,PDO::PARAM_STR);
	$query->bindParam(':email',$email,PDO::PARAM_STR);
	$query->bindParam(':level',$level,PDO::PARAM_STR);
	$query->bindParam(':password',$password,PDO::PARAM_STR);
	$query->execute();

	$query2 = $dbh->prepare($sql2);
	$query2->bindParam(':username',$username,PDO::PARAM_STR);
	$query2->bindParam(':email',$email,PDO::PARAM_STR);
	// $query2->bindParam(':level',$level,PDO::PARAM_STR);
	// $query2->bindParam(':password',$password,PDO::PARAM_STR);
	$query2->execute();

	$lastInsertId = $dbh->lastInsertId();
	if($lastInsertId)
	{
	echo "<script>alert('Registrasi Admin Berhasil.');
	window.location='reg-provider.php';
	</script>";
	}
	else 
	{
	echo "<script>alert('Silahkan Lihat Inputan Anda. Coba Lagi!');</script>";
	}
	}

	?>


	<script>
	function checkAvailability() {
	$("#loaderIcon").show();
	jQuery.ajax({
	url: "check_availability.php",
	data:'emailid='+$("#emailid").val(),
	type: "POST",
	success:function(data){
	$("#user-availability-status").html(data);
	$("#loaderIcon").hide();
	},
	error:function (){}
	});
	}
	</script>
	<script type="text/javascript">
	function valid()
	{
	if(document.signup.password.value!= document.signup.confirmpassword.value)
	{
	alert("Password and Confirm Password Field do not match  !!");
	document.signup.confirmpassword.focus();
	return false;
	}
	return true;
	}
	</script>
	<div class="modal fade" id="daftarprovider">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h3 class="modal-title">Isi Data Admin</h3>
		</div>
		<div class="modal-body">
			<div class="row">
			<div class="signup_wrap">
				<div class="col-md-12 col-sm-6">
				<form  method="post" name="signup" onSubmit="return valid();">
					<div class="form-group">
					<input type="text" class="form-control" name="username" placeholder="Username" required="required">
					</div>
					<div class="form-group">
					<input type="email" class="form-control" name="emailid" id="emailid" onBlur="checkAvailability()" placeholder="Email Address" required="required">
					<span id="user-availability-status" style="font-size:12px;"></span> 
					</div>
					<div class="form-group">
					<input type="password" class="form-control" name="password" placeholder="Password" required="required">
					</div>
					<div class="form-group">
					<input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password" required="required">
					</div>
					<div class="form-group">
					<input type="text" class="form-control" name="level" placeholder="Level" maxlength="10" required="required">
					</div>
					<div class="form-group checkbox">
					<input type="checkbox" id="terms_agree" required="required" checked="">
					<label for="terms_agree">I Agree with <a href="#">Terms and Conditions</a></label>
					</div>
					<div class="form-group">
					<input type="submit" value="Sign Up" name="signup" id="submit" class="btn btn-primary btn-lg btn-block">
					<!-- <button class="btn btn-primary" name="submit" type="submit">Submit</button> -->
					</div>
				</form>
				</div>
				
			</div>
			</div>
		</div>
		
		</div>
	</div>
	</div>

	<!-- End Tambah Admin  -->

