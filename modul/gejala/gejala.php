<title>Gejala - ExSyDiENT</title>
<?php

session_start();
if (!(isset($_SESSION['username']) && isset($_SESSION['password']))) {
    header('location:index.php');
    exit();
} else {
    ?>
<script type="text/javascript">
function Blank_TextField_Validator()
{
if (text_form.nama_gejala.value == "")
{
   alert("Nama Gejala tidak boleh kosong !");
   text_form.nama_gejala.focus();
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
// include "modul/csstambahan.php";
include "config/fungsi_alert.php";
$aksi1="modul/gejala/aksi_gejala.php";
$aksi2="../modul/gejala/aksi_gejala.php";
$aksi3="../../modul/gejala/aksi_gejala.php";
switch($_GET[act]){
	// Tampil gejala
  default:
  $offset=$_GET['offset'];
	//jumlah data yang ditampilkan perpage
	$limit = 15;
	if (empty ($offset)) {
		$offset = 0;
	}
  $tampil=mysql_query("SELECT * FROM gejala ORDER BY kode_gejala");
	echo "<form method=POST action='?module=gejala' name=text_form onsubmit='return Blank_TextField_Validator_Cari()'>
          <br><br><table class='table table-bordered'>
		  <tr><td><input class='btn bg-olive margin' type=button name=tambah value='Add Symptoms' onclick=\"window.location.href='gejala/tambahgejala';\"><input type=text name='keyword' style='margin-left: 10px;' placeholder='Write Symptoms...' class='form-control' value='$_POST[keyword]' /> <input class='btn bg-olive margin' type=submit value='   Search   ' name=Go></td> </tr>
          </table></form>";
		  $baris=mysql_num_rows($tampil);

	if ($_POST[Go]){
			$numrows = mysql_num_rows(mysql_query("SELECT * FROM gejala where nama_gejala like '%$_POST[keyword]%'"));
			if ($numrows > 0){
				echo "<div class='alert alert-success alert-dismissible'>
                <h4><i class='icon fa fa-check'></i> Sukses!</h4>
                Symptoms Not Found.
              </div>";
				$i = 1;
	echo" <table class='table table-bordered' style='overflow-x=auto' cellpadding='0' cellspacing='0'>
          <thead>
            <tr>
              <th>No</th>
              <th>Symptoms Name</th>
              <th width='21%'>Action</th>
            </tr>
          </thead>
		  <tbody>";
	$hasil = mysql_query("SELECT * FROM gejala where nama_gejala like '%$_POST[keyword]%'");
	$no = 1;
	$counter = 1;
    while ($r=mysql_fetch_array($hasil)){
	if ($counter % 2 == 0) $warna = "dark";
	else $warna = "light";
       echo "<tr class='".$warna."'>
			 <td align=center>$no</td>
			 <td>$r[nama_gejala]</td>
			 <td align=center><a type='button' class='btn btn-success margin' href=gejala/editgejala/$r[kode_gejala]><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Edit </a> &nbsp;
	          <a type='button' class='btn btn-danger margin' href=\"JavaScript: confirmIt('Are You Sure Want to Delete this Item?','$aksi1?module=gejala&act=hapus&id=$r[kode_gejala]','','','','u','n','Self','Self')\" onMouseOver=\"self.status=''; return true\" onMouseOut=\"self.status=''; return true\"><i class='fa fa-trash-o' aria-hidden='true'></i> Delete</a>
             </td></tr>";
      $no++;
	  $counter++;
    }
    echo "</tbody></table>";
			}
			else{
				echo "<div class='alert alert-danger alert-dismissible'>
                <h4><i class='icon fa fa-ban'></i> Gagal!</h4>
                Sorry, Symptoms Not Found.
              </div>";
			}
		}else{

	if($baris>0){
	echo" <table class='table table-bordered' style='overflow-x=auto' cellpadding='0' cellspacing='0'>
          <thead>
            <tr>
              <th>No</th>
              <th>Symptoms Name</th>
              <th width='21%'>Action</th>
            </tr>
          </thead>
		  <tbody>
		  ";
	$hasil = mysql_query("SELECT * FROM gejala ORDER BY kode_gejala limit $offset,$limit");
	$no = 1;
	$no = 1 + $offset;
	$counter = 1;
    while ($r=mysql_fetch_array($hasil)){
	if ($counter % 2 == 0) $warna = "dark";
	else $warna = "light";
       echo "<tr class='".$warna."'>
			 <td align=center>$no</td>
			 <td>$r[nama_gejala]</td>
			 <td align=center>
			 <a type='button' class='btn btn-success margin' href=gejala/editgejala/$r[kode_gejala]><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Edit </a> &nbsp;
	          <a type='button' class='btn btn-danger margin' href=\"JavaScript: confirmIt('Are You Sure Want to Delete this Item?','$aksi1?module=gejala&act=hapus&id=$r[kode_gejala]','','','','u','n','Self','Self')\" onMouseOver=\"self.status=''; return true\" onMouseOut=\"self.status=''; return true\"><i class='fa fa-trash-o' aria-hidden='true'></i> Delete</a>
             </td></tr>";
      $no++;
	  $counter++;
    }
    echo "</tbody></table>";
	echo "<div class=paging>";

	if ($offset!=0) {
		$prevoffset = $offset-10;
		echo "<span class=prevnext> <a href=index.php?module=gejala&offset=$prevoffset>Back</a></span>";
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
			echo "<a href=index.php?module=gejala&offset=$newoffset>$i</a>";
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
		echo "<span class=prevnext><a href=index.php?module=gejala&offset=$newoffset>Next</a>";
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

  case "tambahgejala":
    echo "<form name=text_form method=POST action='$aksi2?module=gejala&act=input' onsubmit='return Blank_TextField_Validator()'>
          <br><br><table class='table table-bordered'>
		  <tr><td width=120>Symptoms Name</td><td><input type=text autocomplete='off' placeholder='Inut New Symptoms...' class='form-control' name='nama_gejala' size=30></td></tr>
		  <tr><td></td><td><input class='btn btn-success' type=submit name=submit value='Save' >
		  <input class='btn btn-danger' type=button name=batal value='Cancel' onclick=\"window.location.href='?module=gejala';\"></td></tr>
          </table></form>";
     break;

  case "editgejala":
  include "csstambahan2.php";
    $edit=mysql_query("SELECT * FROM gejala WHERE kode_gejala='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<form name=text_form method=POST action='$aksi3?module=gejala&act=update' onsubmit='return Blank_TextField_Validator()'>
          <input type=hidden name=id value='$r[kode_gejala]'>
          <br><br><table class='table table-bordered'>
		  <tr><td width=120>Nama Gejala</td><td><input autocomplete='off' type=text class='form-control' name='nama_gejala' size=30 value=\"$r[nama_gejala]\"></td></tr>
          <tr><td></td><td><input class='btn btn-success' type=submit name=submit value='Save' >
		  <input class='btn btn-danger' type=button value='Cancel' onclick=\"window.location.href='?module=gejala';\"></td></tr>
          </table></form>";
    break;
}
?>
<?php } ?>
