<title>Ubah Password - ExSyDiENT</title>
<?php
if ($_SESSION[username] != "" && $_SESSION[password] != ""){
switch($_GET[act]){
default:
echo "	<form method='post' action='?module=password&act=updatepassword'>
		<table class='table table-bordered'>
		<br><tr><td width=220>Insert Old Password</td><td><input class='form-control' autocomplete='off' placeholder='Type Old Password...' type='password' name='oldPass' /></td></tr>
		<br><tr><td>Insert a New Password</td><td><input class='form-control' autocomplete='off' placeholder='Type a New Password...' type='password' name='newPass1' /></td></tr>
		<br><tr><td>Confirm a new Password</td><td><input class='form-control' autocomplete='off' placeholder='Confirm a new Password...' type='password' name='newPass2' /></td></tr>
		<tr><td></td><td>
		<input class='btn btn-success' type=submit name=submit title='Simpan' alt='Simpan' value='Save' />
		<input type='hidden' name='pass' value='".$_SESSION[password]."'>
		<input type='hidden' name='nama' value='".$_SESSION[username]."'></td></tr>
		</table>
		</form>";
break;

case "updatepassword":
include "../config/koneksi.php";
$user = $_POST['nama'];
$passwordlama = $_POST['oldPass'];
$passwordbaru1 = $_POST['newPass1'];
$passwordbaru2 = $_POST['newPass2'];
$query = "SELECT * FROM admin WHERE username = '$user'";
$hasil = mysql_query($query);
$data  = mysql_fetch_array($hasil);

if ($data['password'] ==  md5($passwordlama))
{
	if ($passwordbaru1 == $passwordbaru2)
	{
		$passwordbaruenkrip = md5($passwordbaru1);
		$query = "UPDATE admin SET password = '$passwordbaruenkrip' WHERE username = '$user' ";
		$hasil = mysql_query($query);

		if ($hasil) echo "<h2><a href='#'></a></h1>Password berhasil diubah";
	}
	else echo "<h2><a href='#'></a></h1>Password baru Anda tidak sama";
}
else echo "<h2><a href='#'></a></h1>Password lama Anda salah";
break;
}
}else{
echo "<h2><a href='#'>Akses Ditolak</a></h2>
<br>
<strong>Anda harus login untuk dapat mengakses menu ini!</strong><br><br>
<input type=button value='   Klik Disini   ' onclick=location.href='./'><br><br><br><br>";
}
?>
