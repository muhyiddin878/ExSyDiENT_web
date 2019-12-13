<title>Pengetahuan - ExSyDiENT</title>
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
if (text_form.kode_penyakit.value == "")
{
   alert("Pilih dulu penyakit !");
   text_form.kode_penyakit.focus();
   return (false);
}
if (text_form.kode_gejala.value == "")
{
   alert("Pilih dulu gejala !");
   text_form.kode_gejala.focus();
   return (false);
}
if (text_form.mb.value == "")
{
   alert("Isi dulu MB !");
   text_form.mb.focus();
   return (false);
}
if (text_form.md.value == "")
{
   alert("Isi dulu MD !");
   text_form.md.focus();
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
$aksi1="modul/pengetahuan/aksi_pengetahuan.php";
$aksi2="../modul/pengetahuan/aksi_pengetahuan.php";
$aksi3="../../modul/pengetahuan/aksi_pengetahuan.php";
switch($_GET[act]){
	// Tampil pengetahuan
  default:
  $offset=$_GET['offset'];
	//jumlah data yang ditampilkan perpage
	$limit = 15;
	if (empty ($offset)) {
		$offset = 0;
	}
  $tampil=mysql_query("SELECT * FROM basis_pengetahuan ORDER BY kode_pengetahuan");
	echo "<form method=POST action='?module=pengetahuan' name=text_form onsubmit='return Blank_TextField_Validator_Cari()'>
          <br><br><table class='table table-bordered'>
		  <tr><td><input class='btn bg-olive margin' type=button name=tambah value='Add Knowledge Base' onclick=\"window.location.href='pengetahuan/tambahpengetahuan';\"><input type=text name='keyword' style='margin-left: 10px;' placeholder='Write and Click Search...' class='form-control' value='$_POST[keyword]' /> <input class='btn bg-olive margin' type=submit value='   Search   ' name=Go></td> </tr>
          </table></form>";
		  	$baris=mysql_num_rows($tampil);
	if ($_POST[Go]){
			$numrows = mysql_num_rows(mysql_query("SELECT * FROM basis_pengetahuan b,penyakit p where b.kode_penyakit=p.kode_penyakit AND p.nama_penyakit like '%$_POST[keyword]%'"));
			if ($numrows > 0){
				echo "<div class='alert alert-success alert-dismissible'>
                <h4><i class='icon fa fa-check'></i> Sukses!</h4>
                Pengetahuan yang anda cari di temukan.
              </div>";
				$i = 1;
	echo" <table class='table table-bordered' style='overflow-x=auto' cellpadding='0' cellspacing='0'>
          <thead>
            <tr>
              <th>No</th>
              <th>Disease</th>
              <th>Symptoms</th>
              <th>MB</th>
              <th>MD</th>
              <th width='21%'>Action</th>
            </tr>
          </thead>
		  <tbody>";
	$hasil = mysql_query("SELECT * FROM basis_pengetahuan b,penyakit p where b.kode_penyakit=p.kode_penyakit AND p.nama_penyakit like '%$_POST[keyword]%'");
	$no = 1;
	$counter = 1;
    while ($r=mysql_fetch_array($hasil)){
	if ($counter % 2 == 0) $warna = "dark";
	else $warna = "light";
	$sql = mysql_query("SELECT * FROM gejala where kode_gejala = '$r[kode_gejala]'");
	$rgejala=mysql_fetch_array($sql);
       echo "<tr class='".$warna."'>
			 <td align=center>$no</td>
			 <td>$r[nama_penyakit]</td>
			 <td>$rgejala[nama_gejala]</td>
			 <td align=center>$r[mb]</td>
			 <td align=center>$r[md]</td>
			 <td align=center><a type='button' class='btn btn-success margin' href=pengetahuan/editpengetahuan/$r[kode_pengetahuan]><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Ubah </a> &nbsp;
	          <a type='button' class='btn btn-danger margin' href=\"JavaScript: confirmIt('Are You Sure Want to Delete this Item?','$aksi1?module=pengetahuan&act=hapus&id=$r[kode_pengetahuan]','','','','u','n','Self','Self')\" onMouseOver=\"self.status=''; return true\" onMouseOut=\"self.status=''; return true\"><i class='fa fa-trash-o' aria-hidden='true'></i> Hapus</a>
             </td></tr>";
      $no++;
	  $counter++;
    }
    echo "</tbody></table>";
			}
			else{
				echo "<div class='alert alert-danger alert-dismissible'>
                <h4><i class='icon fa fa-ban'></i> Gagal!</h4>
                Maaf, Pengetahuan yang anda cari tidak ditemukan , silahkan inputkan dengan benar dan cari kembali.
              </div>";
			}
		}else{

	if($baris>0){
	echo" <table class='table table-bordered' style='overflow-x=auto' cellpadding='0' cellspacing='0'>
          <thead>
            <tr>
              <th>No</th>
              <th>Disease</th>
              <th>Symptoms</th>
              <th>MB</th>
              <th>MD</th>
              <th width='21%'>Action</th>
            </tr>
          </thead>
		  <tbody>
		  ";
	$hasil = mysql_query("SELECT * FROM basis_pengetahuan ORDER BY kode_pengetahuan limit $offset,$limit");
	$no = 1;
	$no = 1 + $offset;
	$counter = 1;
    while ($r=mysql_fetch_array($hasil)){
	if ($counter % 2 == 0) $warna = "dark";
	else $warna = "light";
	$sql = mysql_query("SELECT * FROM gejala where kode_gejala = '$r[kode_gejala]'");
	$rgejala=mysql_fetch_array($sql);
	$sql2 = mysql_query("SELECT * FROM penyakit where kode_penyakit = '$r[kode_penyakit]'");
	$rpenyakit=mysql_fetch_array($sql2);
       echo "<tr class='".$warna."'>
			 <td align=center>$no</td>
			 <td>$rpenyakit[nama_penyakit]</td>
			 <td>$rgejala[nama_gejala]</td>
			 <td align=center>$r[mb]</td>
			 <td align=center>$r[md]</td>
			 <td align=center>
			 <a type='button' class='btn btn-success margin' href=pengetahuan/editpengetahuan/$r[kode_pengetahuan]><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Ubah </a> &nbsp;
	          <a type='button' class='btn btn-danger margin' href=\"JavaScript: confirmIt('Are You Sure Want to Delete this Item?','$aksi1?module=pengetahuan&act=hapus&id=$r[kode_pengetahuan]','','','','u','n','Self','Self')\" onMouseOver=\"self.status=''; return true\" onMouseOut=\"self.status=''; return true\">
			  <i class='fa fa-trash-o' aria-hidden='true'></i> Hapus</a>
             </td></tr>";
      $no++;
	  $counter++;
    }
    echo "</tbody></table>";
	echo "<div class=paging>";

	if ($offset!=0) {
		$prevoffset = $offset-10;
		echo "<span class=prevnext> <a href=index.php?module=pengetahuan&offset=$prevoffset>Back</a></span>";
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
			echo "<a href=index.php?module=pengetahuan&offset=$newoffset>$i</a>";
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
		echo "<span class=prevnext><a href=index.php?module=pengetahuan&offset=$newoffset>Next</a>";
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

  case "tambahpengetahuan":
	echo "	<div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                <h4><i class='icon fa fa-exclamation-triangle'></i>Instructions for Filling in Experts !</h4>
                Please choose the symptoms that correspond to the existing disease, and give <b>certainty value (MB & MB)</b> with the following coverage:<br><br>
				<b>1.0</b> (Absolutely Yes)&nbsp;&nbsp;|&nbsp;&nbsp;<b>0.8</b> (Almost Certainly Yes)&nbsp;&nbsp;|<br>
				<b>0.6</b> (Most Likely Yes)&nbsp;&nbsp;|&nbsp;&nbsp;<b>0.4</b> (Maybe Yes)&nbsp;&nbsp;|<br>
				<b>0.2</b> (Most Likely Yes)&nbsp;&nbsp;|&nbsp;&nbsp;<b>0.0</b> (Don't Know)&nbsp;&nbsp;|<br><br>
				<b>CF(Expert) = MB – MD</b><br>
				MB :  measure of increased belief MD : measure of increased disbelief <br> <br>
				<b>Example:</b><br>
				If trust <b>(MB)</b> If your trust in headache symptoms for sinusitis is  <b>0.8 (Most Likely Yes)</b><br>
				and increased disbelief <b>(MD)</b> in headache symptoms for sinusitis is <b>0.2 (maybe Yes)</b><br><br>
				<b>So:</b> CF(Expert) = MB – MD (0.8 - 0.2) = <b>0.6</b> <br>
				Where is the value of your certainty of the symptoms of headaches for Sinusitis is <b>0.6 (Most Likely Yes)</b>
              </div>
          <form name=text_form method=POST action='$aksi2?module=pengetahuan&act=input' onsubmit='return Blank_TextField_Validator()'>
          <br><br><table class='table table-bordered'>
		  <tr><td width=120>Disease</td><td><select class='form-control' name='kode_penyakit'  id='kode_penyakit'><option value=''>- Choose Disease -</option>";
		$hasil4 = mysql_query("SELECT * FROM penyakit order by nama_penyakit");
		while($r4=mysql_fetch_array($hasil4)){
			echo "<option value='$r4[kode_penyakit]'>$r4[nama_penyakit]</option>";
		}
		echo	"</select></td></tr>
		<tr><td>Symptoms</td><td><select class='form-control' name='kode_gejala' id='kode_gejala'><option value=''>- Choose Symptoms -</option>";
		$hasil4 = mysql_query("SELECT * FROM gejala order by nama_gejala");
		while($r4=mysql_fetch_array($hasil4)){
			echo "<option value='$r4[kode_gejala]'>$r4[nama_gejala]</option>";
		}
		echo	"</select></td></tr>
		<tr><td>MB</td><td><input autocomplete='off' placeholder='Insert MB' type=text class='form-control' name='mb' size=15 ></td></tr>
		<tr><td>MD</td><td><input autocomplete='off' placeholder='Insert MD' type=text class='form-control' name='md' size=15 ></td></tr>
		  <tr><td></td><td><input class='btn btn-success' type=submit name=submit value='Save' >
		  <input class='btn btn-danger' type=button name=batal value='Cancel' onclick=\"window.location.href='?module=pengetahuan';\"></td></tr>
          </table></form>";
     break;

  case "editpengetahuan":
  include "csstambahan2.php";
    $edit=mysql_query("SELECT * FROM basis_pengetahuan WHERE kode_pengetahuan='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<br>
	<br>
	<form name=text_form method=POST action='$aksi3?module=pengetahuan&act=update' onsubmit='return Blank_TextField_Validator()'>
          <input type=hidden name=id value='$r[kode_pengetahuan]'>
          <br><br><table class='table table-bordered'>
		  <tr><td width=120>Penyakit</td><td><select class='form-control' name='kode_penyakit' id='kode_penyakit'>";
		$hasil4 = mysql_query("SELECT * FROM penyakit order by nama_penyakit");
		while($r4=mysql_fetch_array($hasil4)){
			echo "<option value='$r4[kode_penyakit]'"; if($r[kode_penyakit]==$r4[kode_penyakit]) echo "selected";
			echo ">$r4[nama_penyakit]</option>";
		}
		echo	"</select></td></tr>
		<tr><td>Gejala</td><td><select class='form-control' name='kode_gejala' id='kode_gejala'>";
		$hasil4 = mysql_query("SELECT * FROM gejala order by nama_gejala");
		while($r4=mysql_fetch_array($hasil4)){
			echo "<option value='$r4[kode_gejala]'"; if($r[kode_gejala]==$r4[kode_gejala]) echo "selected";
			echo ">$r4[nama_gejala]</option>";
		}
		echo	"</select></td></tr>
		<tr><td>MB</td><td><input autocomplete='off' placeholder='Masukkan MB' type=text class='form-control' name='mb' size=15 value='$r[mb]'></td></tr>
		<tr><td>MD</td><td><input autocomplete='off' placeholder='Masukkan MD' type=text class='form-control' name='md' size=15 value='$r[md]'></td></tr>
          <tr><td></td><td><input class='btn btn-success' type=submit name=submit value='Simpan' >
		  <input class='btn btn-danger' type=button name=batal value='Batal' onclick=\"window.location.href='?module=pengetahuan';\"></td></tr>
          </table></form>";
    break;
}
?>
<?php } ?>
