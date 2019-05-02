<?php
session_start();
error_reporting(0);
include "timeout.php";

$timezone = "Asia/Jakarta";
if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);

if($_SESSION[login]==1){
	if(!cek_login()){
		$_SESSION[login] = 0;
	}
}
if($_SESSION[login]==0){
  header('location:logout.php');
}
else{
if (empty($_SESSION['username']) AND empty($_SESSION['passuser']) AND $_SESSION['login']==0){
  echo "<link href='css/style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=index.php><b>LOGIN</b></a></center>";
}
else{

?>
<html>
<head>
<title></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />


<!-- data table-->

<style type="text/css" title="currentStyle">
			
	@import "css/datatable/demo_table_jui.css";
	@import "themes/smoothness/jquery-ui-1.8.4.custom.css";
		body {
			background: #309ccb;
		}


.tooltip {
 	display:none;
	 position:absolute;
	 border:1px solid #333;
	 background-color:#161616;
	 border-radius:5px;
	 padding:10px;
	 color:#fff;
 	font-size:12px Arial;
}

#msg{
	width:345px;;
	border:green 1px solid;
	margin-left:auto;
	margin-right:auto;
	margin-bottom:5px;
	padding:0 0 0 5px;
}

/* --MENU DROPDOWN CSS -- */

#primary_nav_wrap
{
	margin-top:0px;
	padding:0;
	border-top:1px solid;
	border-top-color:#309ccb;
	margin-bottom:50px;
	width:100%;
	
	
}

#primary_nav_wrap ul
{
	list-style:none;
	position:relative;
	float:left;
	margin:0;
	padding:0;
	-webkit-box-shadow: 0 3px 3px #3c3c40;
     -moz-box-shadow: 0 3px 3px #3c3c40;
          box-shadow: 0 3px 3px #3c3c40;
	
border-right: 1px solid #323235;
  border-left: 1px solid rgba(255, 255, 255, 0.2);
  
  background-image: -moz-linear-gradient(top, #535357, #3c3c3f);
  background-image: -ms-linear-gradient(top, #535357, #3c3c3f);
  background-image: -webkit-linear-gradient(top, #535357, #3c3c3f);
  background-image: linear-gradient(top, #535357, #3c3c3f);
  
  -webkit-box-shadow: inset 0 1px 0px rgba(255, 255, 255, 0.2), 0 1px 0px #292929;
     -moz-box-shadow: inset 0 1px 0px rgba(255, 255, 255, 0.2), 0 1px 0px #292929;
          box-shadow: inset 0 1px 0px rgba(255, 255, 255, 0.2), 0 1px 0px #292929;
	
	
}

#primary_nav_wrap ul a
{
	display:block;
	color:#fff;
	text-decoration:none;
	font-weight:700;
	font-size:12px;
	line-height:32px;
	padding:0 15px;
	font-family:"HelveticaNeue","Helvetica Neue",Helvetica,Arial,sans-serif;
	
	border-right: 1px solid #323235;
  border-left: 1px solid rgba(255, 255, 255, 0.2);
  
  background-image: -moz-linear-gradient(top, #535357, #3c3c3f);
  background-image: -ms-linear-gradient(top, #535357, #3c3c3f);
  background-image: -webkit-linear-gradient(top, #535357, #3c3c3f);
  background-image: linear-gradient(top, #535357, #3c3c3f);
  
  -webkit-box-shadow: inset 0 1px 0px rgba(255, 255, 255, 0.2), 0 1px 0px #292929;
     -moz-box-shadow: inset 0 1px 0px rgba(255, 255, 255, 0.2), 0 1px 0px #292929;
          box-shadow: inset 0 1px 0px rgba(255, 255, 255, 0.2), 0 1px 0px #292929;
	
}

#primary_nav_wrap ul li
{
	position:relative;
	float:left;
	margin:0;
	padding:0
}

#primary_nav_wrap ul li.current-menu-item
{
	background: #414142;
  -webkit-box-shadow: inset 0 2px 3px rgba(0,0,0, 0.2);
      -moz-box-shadow: inset 0 2px 3px rgba(0,0,0, 0.2);
           box-shadow: inset 0 2px 3px rgba(0,0,0, 0.2);
}

#primary_nav_wrap ul li:hover
{
	background:#f6f6f6;
	z-index:1;
	
	text-shadow: 0 0 8px rgba(255, 255, 255, 0.2);
  background-image: -moz-linear-gradient(top, #565658, #313132);
  background-image: -ms-linear-gradient(top, #565658, #313132);
  background-image: -webkit-linear-gradient(top, #565658, #313132);
  background-image: linear-gradient(top, #565658, #313132);
  
  -webkit-box-shadow: inset 0 1px 0px rgba(255, 255, 255, 0.2), 0 1px 0px #292929;
      -moz-box-shadow: inset 0 1px 0px rgba(255, 255, 255, 0.2), 0 1px 0px #292929;
           box-shadow: inset 0 1px 0px rgba(255, 255, 255, 0.2), 0 1px 0px #292929;
}

#primary_nav_wrap ul ul
{
	display:none;
	position:absolute;
	top:100%;
	left:0;
	background:#fff;
	padding:0
}

#primary_nav_wrap ul ul li
{
	float:none;
	width:200px
}

#primary_nav_wrap ul ul a
{
	line-height:120%;
	padding:10px 15px
}

#primary_nav_wrap ul ul ul
{
	top:0;
	left:100%
}

#primary_nav_wrap ul li:hover > ul
{
	display:block
}
</style>
					
		<script type="text/javascript" language="javascript" src="js/jquery-1.7.2.js"></script>
		<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
		
		<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				oTable = $('#example').dataTable({
					"bJQueryUI": true,
					"sPaginationType": "full_numbers"
				});
			} );
		</script>
<!-- data table-->
<!-- complete-->

<script type="text/javascript">
 $(document).ready(function() {
 $("#page").hide();
    setInterval(function() {
		$('#page').fadeIn(100);
		$('#divjam').load('plugin/jam.php?acak='+ Math.random());
    }, 500);
  });
</script>
<?php include "plugin/me.php"; ?>
<!-- piker-->
	<script src="ui/jquery.ui.widget.js"></script>
	<script src="ui/jquery.ui.core.js"></script>
	<script src="ui/jquery.ui.tabs.js"></script>
	<script src="ui/jquery.ui.accordion.js"></script>
	<script src="ui/jquery.ui.autocomplete.js"></script>
	<script src="ui/jquery.ui.datepicker.js"></script>
	<script src="ui/jquery.effects.core.js"></script>
	<script src="ui/jquery.effects.blind.js"></script>
	<script src="ui/jquery.effects.bounce.js"></script>
	<script src="ui/jquery.effects.clip.js"></script>
	<script src="ui/jquery.effects.drop.js"></script>
	<script src="ui/jquery.effects.fold.js"></script>
	<script src="ui/jquery.effects.slide.js"></script>
	
	
	<script type="text/javascript"> 
      $(document).ready(function(){
        $("#datepicker").datepicker({
          changeMonth : false,
		  changeYear : false,
		  numberOfMonths: 2,
          showAnim    : "slide",
          showOptions : { direction: "down" }
        });
      });
    </script>
	
	
<!-- piker-->
<!-- according-->
	<!--link rel="stylesheet" href="../../themes/base/jquery.ui.all.css">
	<link rel="stylesheet" href="../demos.css"-->
	<script>
	$(function() {
		$( "#accordion" ).accordion({
			autoHeight: false,
			navigation: true
		});
	});
	</script>
<!-- according-->

<!-- membuat autocomplete kantor -->

<script type="text/javascript" language="javascript" src="js/jquery.autocomplete.js"></script>	
		<link href="css/jquery.autocomplete.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
		$().ready(function() {	
			$("#kantor").autocomplete("plugin/pKantor.php", {
				minLength:2,						
	  });
	});
</script>
<!-- autocomplete kantor finished -->

<!-- script untuk Tooltips -->
<script type="text/javascript">
$(document).ready(function() {
// Tooltip only Text
$('.masterTooltip').hover(function(){
        // Hover over code
        var title = $(this).attr('title');
        $(this).data('tipText', title).removeAttr('title');
        $('<p class="tooltip"></p>')
        .text(title)
        .appendTo('body')
        .fadeIn('slow');
}, function() {
        // Hover out code
        $(this).attr('title', $(this).data('tipText'));
        $('.tooltip').remove();
}).mousemove(function(e) {
        var mousex = e.pageX + 20; //Get X coordinates
        var mousey = e.pageY + 10; //Get Y coordinates
        $('.tooltip')
        .css({ top: mousey, left: mousex })
});
});
</script>
<!-- akhir script Tooltips -->


</head>
<body>
<div class="codrops-top">
               
				
            <a href="?op=conf" ><strong>PERIODE PELAKSANAAN : <?php  echo $_SESSION['periode'] ?></strong></a>
			<a id="divjam" href="#"></a>
              
                <span class="right">
                    <a class="modal1" href="javascript:void(0);"><strong>Developer</strong></a>
                    <a href="logout.php" ><strong><font color='red'>Logout/Keluar sistem</font></strong></a>
                </span>
            </div>
			
	<div id="header">
	<div class="logo">
	<img src='images/logo.png'>
	<?php include "config/koneksi.php"; $edit=mysql_query("SELECT * FROM nama WHERE id_nama='1'"); $r=mysql_fetch_array($edit);
	echo "<h2><font color=white>Sistem Penatausahaan Arsip dan Persuratan (SPARTAN)</font></h2><span><font color=white>$r[nama]</font></span><p><font color=white>$r[alamat]<br>Telp: $r[telp], E-mail: <a href=mailto:$r[email]>$r[email]</a>, Web: <a href='http://$r[web]' target=_blank>$r[web]</a></font></p>"; ?>
	</div>

<!-- MENU DROPDOWN ATAS -->	
<div class="wrap">
	<nav id="primary_nav_wrap">
<ul>
  <li class="current-menu-item"><a href="?op=home">Dashboard</a></li>
  <li><a href="#">Persuratan</a>
    <ul>
      <li><a href="?op=sMasuk">Surat Masuk</a></li>
      <li><a href="?op=sKeluar">Surat Keluar</a></li>
     </ul>     
  </li>
  <li><a href="#">Pengarsipan</a>
    <ul>
      	<li class="dir"><a href="?op=sArsip">Non Surat</a></li>
    </ul>
  </li>
  <li><a href="#">Monitoring</a></li>
  <li><a href="#">Laporan</a></li>
  <li><a href="#">Referensi</a>
  	<ul>
  		<li><a href="?op=rJenis">Jenis Surat</a></li>
  		<li><a href="?op=rSifat">Sifat Surat</a></li>
  		<li><a href="?op=rStatus">Status Surat</a></li>
		<li><a href="?op=rKlasifikasi">Klasifikasi Arsip</a></li>
  	</ul>
  </li>	
  <li><a href="?op=conf">Konfigurasi</a></li>
</ul>
</nav>
</div> 
<!-- AKHIR MENU DROPDOWN ATAS -->	

  <div id=page>
	 <div  class="content">
	 		<?php include "content.php"; ?>
  </div>
  </div>
  
		<div id="footer">
			
		</div>
</div>

</body>
</html>
<?php
}
}
?>
 