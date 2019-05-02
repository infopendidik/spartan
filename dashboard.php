<?php
include "config/koneksi.php";
?>

<html>
 <head>
<script src="js/jquery-1.7.2.js" type="text/javascript"></script>
<script src="plugin/charts/highcharts.js" type="text/javascript"></script>
<script type="text/javascript">

$(function() {
	var chart;
	$(document).ready(function(){
   

  //grafik surat masuk    
	   var gfx_smasuk = new Highcharts.Chart({
	   chart: {
            renderTo: 'gfx_smasuk',
            type: 'column',
			height: 340
         },   
         title: {
            text: 'SURAT MASUK TAHUN <?php echo $_SESSION[periode]; ?>'
         },
         xAxis: {
            categories: ['Bulan']
         },
         yAxis: {
            title: {
               text: 'Jumlah'
            }
         },
              series:             
            [
            <?php 
           $sql   = "SELECT date_format(tMasuk,'%M') as bulan  FROM smasuk WHERE year(tMasuk)='$_SESSION[periode]' group by month(tMasuk) ";
            $query = mysql_query( $sql )  or die(mysql_error());
            while( $ret = mysql_fetch_array( $query ) ){
             $bulan=$ret['bulan'];                     
                 $sql_jumlah   = "SELECT count(nAgenda) as jumlah FROM smasuk where date_format(tMasuk,'%M') = '$bulan' and year(tMasuk)='$_SESSION[periode]' ";        
                 $query_jumlah = mysql_query( $sql_jumlah ) or die(mysql_error());
                 while( $data = mysql_fetch_array( $query_jumlah ) ){
                    $jumlah = $data['jumlah'];                 
                  }             
                  ?>
                  {
                      name: '<?php echo $bulan; ?>',
                      data: [<?php echo $jumlah; ?>]
                  },
                  <?php } ?>
            ]
      }); 


	  
//grafik surat keluar
	var gfx_skeluar = new Highcharts.Chart({
         chart: {
            renderTo: 'gfx_skeluar',
            type: 'column',
			height: 340
         },   
         title: {
            text: 'SURAT KELUAR TAHUN <?PHP echo $_SESSION[periode] ?> '
         },
         xAxis: {
            categories: ['Bulan']
         },
         yAxis: {
            title: {
               text: 'Jumlah'
            }
         },
              series:             
            [
            <?php 
           $sql   = "SELECT date_format(tKeluar,'%M') as bulan  FROM skeluar where year(tKeluar)='$_SESSION[periode]' group by month(tKeluar)";
            $query = mysql_query( $sql )  or die(mysql_error());
            while( $ret = mysql_fetch_array( $query ) ){
             $bulan=$ret['bulan'];                     
                 $sql_jumlah   = "SELECT count(nAgenda) as jumlah FROM skeluar where date_format(tKeluar,'%M') = '$bulan' and year(tKeluar)='$_SESSION[periode]' ";        
                 $query_jumlah = mysql_query( $sql_jumlah ) or die(mysql_error());
                 while( $data = mysql_fetch_array( $query_jumlah ) ){
                    $jumlah = $data['jumlah'];                 
                  }             
                  ?>
                  {
                      name: '<?php echo $bulan; ?>',
                      data: [<?php echo $jumlah; ?>]
                  },
                  <?php } ?>
            ]
      });

//grafik surat keluar per jenis
	var gfx_sjkeluar = new Highcharts.Chart({
         chart: {
            renderTo: 'gfx_sjkeluar',
            type: 'column',
			height: 340
         },   
         title: {
            text: 'SURAT KELUAR PER JENIS TAHUN <?php echo $_SESSION[periode]; ?> '
         },
         xAxis: {
            categories: ['Jenis']
         },
         yAxis: {
            title: {
               text: 'Jumlah'
            }
         },
              series:             
            [
            <?php 
           $sql   = "SELECT jSurat  FROM skeluar group by jSurat ";
            $query = mysql_query( $sql )  or die(mysql_error());
            while( $ret = mysql_fetch_array( $query ) ){
             $jenis=$ret['jSurat'];                     
                 $sql_jumlah   = "SELECT count(nAgenda) as jumlah FROM skeluar where jSurat = '$jenis' and year(tKeluar)='$_SESSION[periode]' ";        
                 $query_jumlah = mysql_query( $sql_jumlah ) or die(mysql_error());
                 while( $data = mysql_fetch_array( $query_jumlah ) ){
                    $jumlah = $data['jumlah'];                 
                  }             
                  ?>
                  {
                      name: '<?php echo $jenis; ?>',
                      data: [<?php echo $jumlah; ?>]
                  },
                  <?php } ?>
            ]
      });

	//grafik arsip surat masuk
	var gfx_arsip_smasuk = new Highcharts.Chart({
         chart: {
            renderTo: 'gfx_arsip_smasuk',
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie',
          // height: 340
         },   
         title: {
             text: 'ARSIP SURAT MASUK TAHUN <?php echo $_SESSION[periode]; ?>'
         },
         tooltip: {
             pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
         },
         plotOptions: {
             pie: {
                 allowPointSelect: true,
                 cursor: 'pointer',
                 dataLabels: {
                     enabled: false
         			},
         			showInLegend: true
             }
         },
         
         series: [{
             name: 'Arsip',
             colorByPoint: true,
             data: [{
                 name: 'Sudah Diarsipkan',
				<?php
					//jumlah yang sudah diarsipkan
					$a = mysql_query("select count(nAgenda) as juma from smasuk where year(tMasuk)='2016' and nArsip IS NOT NULL ");
					$jsudah= mysql_fetch_assoc($a);
					$nsudah=$jsudah['juma'];
				
					//jumlah yang belum diarsipkan
					$b = mysql_query("select count(nAgenda) as jumb from smasuk where year(tMasuk)='2016' and nArsip IS NULL ");
					$jbelum= mysql_fetch_assoc($b);
					$nbelum = $jbelum['jumb'];
					
					//jumlah total arsip
					$c = mysql_query("select count(nAgenda) as jumc from smasuk where year(tMasuk)='2016' ");
					$jtotal= mysql_fetch_assoc($c);
					$ntotal= $jtotal['jumc'];
					
					$psudah = ($nsudah/$ntotal)*100;
					$pbelum = ($nbelum/$ntotal)*100;			
				?>	
                 y: <?php echo number_format($psudah,2,'.',''); ?>
             }, {
                 name: 'Belum Diarsipkan',
                 y: <?php echo number_format($pbelum,2,'.',''); ?>,
                 sliced: true,
                 selected: true
             }]
         }]
     });

	//grafik arsip surat keluar
	var gfx_arsip_skeluar = new Highcharts.Chart({
         chart: {
            renderTo: 'gfx_arsip_skeluar',
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie',
          // height: 340
         },   
         title: {
             text: 'ARSIP SURAT KELUAR TAHUN <?php echo $_SESSION[periode]; ?>'
         },
         tooltip: {
             pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
         },
         plotOptions: {
             pie: {
                 allowPointSelect: true,
                 cursor: 'pointer',
                 dataLabels: {
                     enabled: false
         			},
         			showInLegend: true
             }
         },
         
         series: [{
             name: 'Arsip',
             colorByPoint: true,
             data: [{
                 name: 'Sudah Diarsipkan',
				<?php
					//jumlah yang sudah diarsipkan
					$a = mysql_query("select count(nAgenda) as juma from skeluar where year(tKeluar)='2016' and nArsip IS NOT NULL ");
					$jsudah= mysql_fetch_assoc($a);
					$nsudah=$jsudah['juma'];
				
					//jumlah yang belum diarsipkan
					$b = mysql_query("select count(nAgenda) as jumb from skeluar where year(tKeluar)='2016' and nArsip IS NULL ");
					$jbelum= mysql_fetch_assoc($b);
					$nbelum = $jbelum['jumb'];
					
					//jumlah total arsip
					$c = mysql_query("select count(nAgenda) as jumc from skeluar where year(tKeluar)='2016' ");
					$jtotal= mysql_fetch_assoc($c);
					$ntotal= $jtotal['jumc'];
					
					$psudah = ($nsudah/$ntotal)*100;
					$pbelum = ($nbelum/$ntotal)*100;			
				?>	
                 y: <?php echo number_format($psudah,2,'.',''); ?>
             }, {
                 name: 'Belum Diarsipkan',
                 y: <?php echo number_format($pbelum,2,'.',''); ?>,
                 sliced: true,
                 selected: true
             }]
         }]
     });
  	

//batas penggunaan bracket, hati2 kehapus
  });
  });

</script>

</head>
<body>
<div id="page">
<div id="content">
<table class="table" style="width:100%;">
		<tr height=30px>
		<th colspan="3" align="center">DASHBOARD MONITORING SURAT</th>
		</tr>
		<tr height="50px">
		<td style="height:50px; width:33%;"><div id="gfx_smasuk"></div></td>
		<td style="height:50px; width:33%;"><div id="gfx_skeluar"></div></td>
		<td style="height:50px; width:33%;"><div id="gfx_sjkeluar"></div></td>
		</tr>
		<tr height="50px">
		<td style="height:50px; width:33%;"><div id="gfx_arsip_smasuk"></div></td>
		<td style="height:50px; width:33%;"><div id="gfx_arsip_skeluar"></div></td>
		<td style="height:50px; width:33%;"><div id="gfx_sjkeluar"></div></td>
		</tr>
		</table>
</div></div>		
 </body>
</html>