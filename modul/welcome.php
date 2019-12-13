<title>Home - ExSyDiENT</title>
<?php
  $htgejala=mysql_query("SELECT count(*) as total from gejala");
	$dtgejala=mysql_fetch_assoc($htgejala); ?>
	<div class='row'>
        <div class='col-lg-3 col-xs-6'>
          <!-- small box -->
          <div class='small-box bg-aqua'>
            <div class='inner'>
              <h3> <?php echo $dtgejala["total"]; ?></h3>
              <p>Total Symptoms</p>
            </div>
            <div class='icon'>
              <i class='ion ion-thermometer'></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
<?php
	$htpenyakit=mysql_query("SELECT count(*) as total from penyakit");
	  $dtpenyakit=mysql_fetch_assoc($htpenyakit); ?>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3> <?php echo $dtpenyakit["total"]; ?></h3>

              <p>Total Disease</p>
            </div>
            <div class="icon">
              <i class="ion ion-bug"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
<?php
	$htpengetahuan=mysql_query("SELECT count(*) as total from basis_pengetahuan");
	  $dtpengetahuan=mysql_fetch_assoc($htpengetahuan); ?>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $dtpengetahuan["total"]; ?></h3>

              <p>Total Knowledge</p>
            </div>
            <div class="icon">
              <i class="ion ion-erlenmeyer-flask"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
<?php
	$htadmin=mysql_query("SELECT count(*) as total from admin");
	  $dtadmin=mysql_fetch_assoc($htadmin); ?>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
             <h3> <?php echo $dtadmin["total"]; ?></h3>
              <p>Total Expert Admin</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
      </div>
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carousel-example-generic" data-slide-to="0" class=""></li>
                  <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                  <li data-target="#carousel-example-generic" data-slide-to="2" class="active"></li>
                </ol>
                <div class="carousel-inner">
                  <div class="item active">
                    <img src="aset/banner/banner1.png" alt="First slide">
                    <div class="carousel-caption">
                    </div>
                  </div>
                  <div class="item">
                    <img src="aset/banner/banner2.png" alt="Second slide">
                    <div class="carousel-caption">
                    </div>
                  </div><!--
                  <div class="item active">
                    <img src="aset/banner/daging.jpg" alt="Third slide">
                    <div class="carousel-caption">
                    </div>
                  </div>-->
                </div>
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                  <span class="fa fa-angle-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                  <span class="fa fa-angle-right"></span>
                </a>
              </div>
			  <br>
            <div class="row">
                <div class="col-sm-4 text-center padding wow fadeIn animated" data-wow-duration="1000ms" data-wow-delay="300ms" style="visibility: visible; animation-duration: 1000ms; animation-delay: 300ms; animation-name: fadeIn;">
                    <div class="single-service">

                            <img style="width:90px" src="aset/banner/icon3.png" alt="">

                        <h2>Responsive Application</h2>
                        <p>This expert system application can adjust the size of your device, so even though it is accessed via a mobile device it is also convenient.</p>
                    </div>
                </div>
                <div class="col-sm-4 text-center padding wow fadeIn animated" data-wow-duration="1000ms" data-wow-delay="600ms" style="visibility: visible; animation-duration: 1000ms; animation-delay: 600ms; animation-name: fadeIn;">
                    <div class="single-service">

                            <img style="width:90px" src="aset/banner/icon2.png" alt="">

                        <h2>Society Friend</h2>
                        <p>This Expert system continues to adjust diagnosis calculations, so that the accuracy of the illness suffered is more appropriate and becomes a reference for the society.</p>
                    </div>
                </div>
                <div class="col-sm-4 text-center padding wow fadeIn animated" data-wow-duration="1000ms" data-wow-delay="900ms" style="visibility: visible; animation-duration: 1000ms; animation-delay: 900ms; animation-name: fadeIn;">
                    <div class="single-service">
                            <img style="width:125px" src="aset/banner/icon1.png" alt="">
                        <h2>Expert Admin</h2>
                        <p>There is an expert admin feature, to manage expert knowledge and CF, it has been adjusted to display so that the expert can explore the application more.</p>
                    </div>
                </div>
            </div>
        <div></div>
