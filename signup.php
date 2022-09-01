<?php 
include('connect.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$username = $_POST['username'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$verpassword = $_POST['password-ver'];
	$sex = $_POST['sex'];
	$phonelen = '';
	$namelen = '';
	$passlenerror = '';
	$passerror = '';
	$sexerror = '';
	if(strlen($phone) != 10) {
		$phonelen = 'رقم الهاتف يتكون من 10 أرقام';
	};
	if(strlen($username) < 6) {
		$namelen = 'الإسم لايقل عن 6 أحرف';
	};
	if(strlen($password) < 8) {
		$passlenerror = 'كلمة السر لاتقل عن 8 أحرف';
	};
	if($password != $verpassword) {
		$passerror = 'كلمة السر غير مطابقة';
	};
	if($sex == 'الجنس') {
		$sexerror = 'يجب تحديد جنسك';
	};
	if($password == $verpassword && $sex != 'الجنس'){
		$pass = sha1($password);
		$insert = "INSERT INTO users (username,phone,email,password,sex) VALUES ('$username','$phone','$email','$pass','$sex') ";
		mysqli_query($con,$insert);
		header('location:index.php');
		exit();
	} ;
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>حساب جديد</title>
	<!-- Css -->
	<link rel="stylesheet" href="css/all.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/style.css">
	<!-- Font -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>
	<div class="container">
		<img src="images/logogreen.png" class="logo">
	</div>
	<div class="compte">
		<div class="container">
			<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" class="form form-signup">
				<img src="images/signup.png" class="header-img header-img-signup" >
				<h4>حساب جديد</h4>
				<div class="input">
					<input type="text" name="username" placeholder="إسم المستخدم" value="<?php if(isset($username)){ echo $username;} ?>" required >
					<i class="fa-solid fa-user input-icon"></i>
				</div>
				<?php if(!empty($namelen)) { ?>
						<div class='alert alert-danger' role='alert'>
							<?php echo $namelen; ?>
						</div>
				<?php };?>
				<div class="input">
					<input type="number" name="phone" placeholder="رقم الهاتف" value="<?php if(isset($phone)){ echo $phone;} ?>" required>
					<i class="fa-solid fa-phone input-icon"></i>
				</div>
				<?php if(!empty($phonelen)) { ?>
						<div class='alert alert-danger' role='alert'>
							<?php echo $phonelen; ?>
						</div>
				<?php };?>
				<div class="input">
					<input type="email" name="email" placeholder="البريد الإلكتروني" value="<?php if(isset($email)){ echo $email;} ?>" required>
					<i class="fa-solid fa-envelope input-icon"></i>
				</div>
				<div class="input">
					<input type="password" name="password" placeholder="كلمة السر" required class="input-pass">
					<i class="fa-solid fa-lock  input-icon"></i>
				</div>
				<?php if(!empty($passlenerror)) { ?>
						<div class='alert alert-danger' role='alert'>
							<?php echo $passlenerror; ?>
						</div>
				<?php };?>
				<div class="input">
					<input type="password" name="password-ver" placeholder="تأكيد كلمة السر" required class="verify-pass" >
					<i class="fa-solid fa-lock  input-icon"></i>
				</div>
				<?php if(!empty($passerror)) { ?>
						<div class='alert alert-danger' role='alert'>
							<?php echo $passerror; ?>
						</div>
				<?php };?>
				<select name="sex" required class="form-select select mb-2">
					<option hidden selected>الجنس</option>
					<option>ذكر</option>
					<option>أنثى</option>
				</select>
				<?php if(!empty($sexerror)) { ?>
						<div class='alert alert-danger' role='alert'>
							<?php echo $sexerror; ?>
						</div>
				<?php };?>
				<input type="submit" value="إنشاء حساب" class="submit">
				<p>لديك حساب ؟ <a href="index.php">تسجيل الدخول</a></p>
			</form>
			<div class="image">
				<img src="images/login.png" class="login-img">
			</div>
		</div>
	</div>
	<!-- <script>
			// Verify Password
			let inputVerifyPassword = document.querySelector(".verify-pass"),
				inputPassword = document.querySelector(".input-pass"),
				alertPassword = document.querySelector(".error-pass"),
				inputSubmit = document.querySelector(".submit"),
				select = document.querySelector("select");
			inputVerifyPassword.onblur = function(){
				error();
			}
			select.onblur = function(){
				error();
			}
			error();
			function error(){
				if(inputVerifyPassword.value !== inputPassword.value ){
					inputVerifyPassword.classList.add("error");
					alertPassword.classList.add("error");
					inputSubmit.preventDefault();
				} else {
					inputVerifyPassword.classList.remove("error");
					alertPassword.classList.remove("error");
				}
			}
	</script> -->
</body>
</html>