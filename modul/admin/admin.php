<title>Admin - ExSyDiENT</title>
<?php
session_start();
if (!(isset($_SESSION['username']) && isset($_SESSION['password']))) {
    header('location:index.php');
    exit();
} else {
    ?>
<script Language="JavaScript">
<!--
function Blank_TextField_Validator()
{
if (text_form.username.value == "")
{
   alert("Username tidak boleh kosong !");
   text_form.username.focus();
   return (false);
}
if (text_form.password.value == "")
{
   alert("Password tidak boleh kosong !");
   text_form.password.focus();
   return (false);
}
return (true);
}
function Blank_TextField_Validator_Cari()
{
if (text_form.keyword.value == "")
{
   alert("Isi dulu keyword pencarian !");
   text_form.keyword.focus();
   return (false);
}
return (true);
}
-->
</script>
<?php
//include "modul/csstambahan.php";
include "config/fungsi_alert.php";
$aksi1="modul/admin/aksi_admin.php";
$aksi2="../modul/admin/aksi_admin.php";
$aksi3="../../modul/admin/aksi_admin.php";

switch($_GET[act]){
	// Tampil admin
  default:
  $offset=$_GET['offset'];
	//jumlah data yang ditampilkan perpage
	$limit = 10;
	if (empty ($offset)) {
		$offset = 0;
	}
  $tampil=mysql_query("SELECT * FROM admin ORDER BY username");
	echo "<br><form method=POST action='?module=admin' name=text_form onsubmit='return Blank_TextField_Validator_Cari()'>
          <br><table class='table table-bordered'>
		  <tr><td><input class='btn bg-olive margin' type=button name=tambah value='Add Admin' onclick=\"window.location.href='admin/tambahadmin';\"><input type=text name='keyword' style='margin-left: 10px;' placeholder='Write and Click Search...' class='form-control' value='$_POST[keyword]' /> <input class='btn bg-olive margin' type=submit value='   Search   ' name=Go></td> </tr>
          </table></form>";
		  	$baris=mysql_num_rows($tampil);
	if ($_POST[Go]){
			$numrows = mysql_num_rows(mysql_query("SELECT * FROM admin where username like '%$_POST[keyword]%'"));
			if ($numrows > 0){
				echo "<div class='alert alert-success alert-dismissible'>
                <h4><i class='icon fa fa-check'></i> Sukses!</h4>
                Admin yang anda cari di temukan.
              </div>";
				$i = 1;
	echo" <table class='table table-bordered' style='overflow-x=auto' cellpadding='0' cellspacing='0'>
          <thead>
            <tr>
              <th>No</th>
              <th>Username</th>
              <th>Full Name</th>
              <th width='21%'>Action</th>
            </tr>
          </thead>
		  <tbody>";
	$hasil = mysql_query("SELECT * FROM admin where username like '%$_POST[keyword]%'");
	$no = 1;
	$counter = 1;
    while ($r=mysql_fetch_array($hasil)){
	if ($counter % 2 == 0) $warna = "light";
	else $warna = "dark";
       echo "<tr class='".$warna."'>
			 <td align=center>$no</td>
	         <td>$r[username]</td>
	         <td>$r[nama_lengkap]</td>
			 <td align=center><a type='button' class='btn btn-success margin' href=admin/editadmin/$r[username]><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Edit </a> &nbsp;
	          <a type='button' class='btn btn-danger margin' href=\"JavaScript: confirmIt('Anda yakin akan menghapusnya ?','$aksi?module=admin&act=hapus&id=$r[username]','','','','u','n','Self','Self')\" onMouseOver=\"self.status=''; return true\" onMouseOut=\"self.status=''; return true\"><i class='fa fa-trash-o' aria-hidden='true'></i> Delete</a>
             </td></tr>";
      $no++;
	  $counter++;
    }
    echo "</tbody></table>";
			}
			else{
				echo "<div class='alert alert-danger alert-dismissible'>
                <h4><i class='icon fa fa-ban'></i> Gagal!</h4>
                Maaf, Admin yang anda cari tidak ditemukan , silahkan inputkan dengan benar dan cari kembali.
              </div>";
			}
		}else{

	if($baris>0){
	echo" <table class='table table-bordered' style='overflow-x=auto' cellpadding='0' cellspacing='0'>
          <thead>
            <tr>
              <th>No</th>
              <th>Username</th>
              <th>Full Name</th>
              <th width='21%'>Action</th>
            </tr>
          </thead>
		  <tbody>
		  ";
	$hasil = mysql_query("SELECT * FROM admin ORDER BY username limit $offset,$limit");
	$no = 1;
	$no = 1 + $offset;
	$counter = 1;
    while ($r=mysql_fetch_array($hasil)){
	if ($counter % 2 == 0) $warna = "dark";
	else $warna = "light";
       echo "<tr class='".$warna."'>
			 <td align=center>$no</td>
	         <td>$r[username]</td>
	         <td>$r[nama_lengkap]</td>
			 <td align=center>
			 <a type='button' class='btn btn-success margin' href=admin/editadmin/$r[username]><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Edit </a> &nbsp;
	          <a type='button' class='btn btn-danger margin' href=\"JavaScript: confirmIt('Are You Sure Want To Delete This Account ?','$aksi1?module=admin&act=hapus&id=$r[username]','','','','u','n','Self','Self')\" onMouseOver=\"self.status=''; return true\" onMouseOut=\"self.status=''; return true\"><i class='fa fa-trash-o' aria-hidden='true'></i> Delete</a>
             </td></tr>";
      $no++;
	  $counter++;
    }
    echo "</tbody></table>";
	echo "<div class=paging>";

	if ($offset!=0) {
		$prevoffset = $offset-10;
		echo "<span class=prevnext> <a href=index.php?module=admin&offset=$prevoffset>Back</a></span>";
	}
	else {
		echo "<span class=disabled>Back</span>";//cetak halaman tanpa link
	}
	//hitung jumlah halaman
	$halaman = intval($baris/$limit);//Pembulatan

	if ($baris%$limit){
		$halaman++;
	}
	for($i=1;$i<=$halaman;$i++){
		$newoffset = $limit * ($i-1);
		if($offset!=$newoffset){
			echo "<a href=index.php?module=admin&offset=$newoffset>$i</a>";
			//cetak halaman
		}
		else {
			echo "<span class=current>".$i."</span>";//cetak halaman tanpa link
		}
	}

	//cek halaman akhir
	if(!(($offset/$limit)+1==$halaman) && $halaman !=1){

		//jika bukan halaman terakhir maka berikan next
		$newoffset = $offset + $limit;
		echo "<span class=prevnext><a href=index.php?module=admin&offset=$newoffset>Next</a>";
	}
	else {
		echo "<span class=disabled>Next</span>";//cetak halaman tanpa link
	}

	echo "</div>";
	}else{
	echo "<br><b>Empty Data !</b>";
	}
	}
    break;

  case "tambahadmin":
	echo "<form name=text_form method=POST action='$aksi2?module=admin&act=input' onsubmit='return Blank_TextField_Validator()'>
          <br><br><table class='table table-bordered'>
		  <tr><td>Full Name</td>   <td>  <input autocomplete='off' placeholder='Insert Full Name...' type=text class='form-control' name='nama_lengkap' size=30></td></tr>
          <tr><td>Username</td>   <td>  <input autocomplete='off' placeholder='Insert username...' type=text class='form-control' name='username' size=30></td></tr>
		  <tr><td>Password</td>   <td> <input autocomplete='off' placeholder='Insert Admin Password...' type=password class='form-control' name='password' size=30></td></tr>
		  <tr><td></td><td>
		  <input class='btn btn-success' type=submit name=submit value='Save' >
		  <input class='btn btn-danger' type=button name=batal value='Cancel' onclick=\"window.location.href='?module=admin';\">
		  </td></tr>
          </table></form>";
     break;

  case "editadmin":
  include "csstambahan2.php";
    $edit=mysql_query("SELECT * FROM admin WHERE username='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<form name=text_form method=POST action='$aksi3?module=admin&act=update' onsubmit='return Blank_TextField_Validator()'>
          <input type=hidden name=id value='$r[username]'>
          <br><br><table class='table table-bordered'>
	      <tr><td>Username</td> <td>  <input autocomplete='off' type=text class='form-control' name='username' value=\"$r[username]\" size=30></td></tr>
	      <tr><td>Nama Lengkap</td> <td>  <input autocomplete='off' type=text class='form-control' name='nama_lengkap' value=\"$r[nama_lengkap]\" size=30></td></tr>
          <tr><td></td><td>
		  <input class='btn btn-success' type=submit name=submit value='Simpan' >
		  <input class='btn btn-danger' type=button name=batal value='Batal' onclick=\"window.location.href='?module=admin';\"></td></tr>
          </table></form>";
    break;
}
?>
<?php
} ?>
