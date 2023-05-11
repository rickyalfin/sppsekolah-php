<?php
session_start();
if (isset($_SESSION['login']) ) {
	header('Location: index.php');
} 
include 'koneksi.php';
if ($_SERVER['REQUEST_METHOD']=='POST' ) {
	$user  = $_POST['username'];
	$pass  = $_POST['password'];
	$p     = hash('sha1', $pass);

	if ( $user == "" || $p == ""){
		$error = true;
	}else {
		$data = $konek -> query("SELECT * FROM admin WHERE username ='".$user."' AND password = '".$p."'");
	$dt = mysqli_num_rows($data);
	$dta = mysqli_fetch_Assoc($data);

	if ($dt > 0) {
		session_start();
		$_SESSION['login']    = TRUE;
		$_SESSION['username'] = $dta['username'];
		$_SESSION['id']		  = $dta['idadmin'];
		header('Location: index.php');

		if($dta['level']=="admin"){
 
			// buat session login dan username
			$_SESSION['username'] = $username;
			$_SESSION['level'] = "admin";
			// alihkan ke halaman dashboard admin
			header("location:index.php");
	 
		// cek jika user login sebagai pegawai
		}else if($dta['level']=="user"){
			// buat session login dan username
			$_SESSION['username'] = $username;
			$_SESSION['level'] = "user";
			// alihkan ke halaman dashboard pegawai
			header("location:index_user.php");
	 
		}else{
	 
			// alihkan ke halaman login kembali
			echo "
			<script>
			alert('username atau password anda salah');
			document.location.href = 'login.php';
			</script>
			";

		}	
	}else{
		echo "
		<script>
		alert('username atau password anda salah');
		document.location.href = 'login.php';
		</script>
		";
	}
	}

	
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
	<section class="login">
		<div class="login_box">
			<div class="left">
				<div class="top_link"><a href="halamanutama.html"><img src="https://drive.google.com/u/0/uc?id=16U__U5dJdaTfNGobB_OpwAJ73vM50rPV&export=download" alt="">Return Home</a></div>
				<div class="contact">
					<form action="" method="post">
						<h3>SIGN IN</h3>
						<input type="text" name="username" placeholder="USERNAME">
						<input type="password" name="password" placeholder="PASSWORD">
						<button class="submit" name="login">LET'S GO</button>
					</form>
				</div>
			</div>
			<div class="right">
				<div class="right-text">
				</div>
				<div class="right-inductor"><img src="" alt=""></div>
			</div>
		</div>
	</section>
</body>
</html>
<?php include 'footer.php';  ?>


