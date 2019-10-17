<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>T - Laporan Kejadian A - Display</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
<link href="css/font-awesome.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/pages/dashboard.css" rel="stylesheet">
<script src="js/jquery-1.7.2.min.js"></script>
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

<?php
	include "koneksi.php";

	date_default_timezone_set("Asia/Bangkok");
	
	if(isset($_POST['no_lap']))
	{
		$id = $_POST['no_lap'];
	}
				
	$que = "SELECT * FROM T_Kejadian_a where no_lap='".$id."'";
	$sql = sqlsrv_query($conn,$que);
	$hasil = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC);
?>

<style>
td{
	padding-left: 3px;
}
td.mid{
	padding-left: 0px;
	text-align: center;
}
.style1 {
	font-size: 17px;
	font-weight: bold;
}
</style>
</head>
<body>
<div id="header_rpt"></div>
<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span12 mainPage">
					<br>

					<span class="style1">Display Laporan Kejadian</span>
					<br>
					<table>
						<tr>
							<td>Insiden Sudah Terjadi ?</td>
							<td width="15"> : </td>
							<td><input type="radio" name="kjd_terjadi" id="kjd_ya" <?php if($hasil['kejadian_terjadi'] == 'Ya'){echo 'checked="true"';} ?> disabled> Ya</td>
							<td colspan="4"><input type="radio" name="kjd_terjadi" id="kjd_tidak" <?php if($hasil['kejadian_terjadi'] == 'Tidak'){echo 'checked="true"';} ?> disabled> Tidak</td>
						</tr>
						<tr>
							<td>Apakah Pasien Mengetahui ?</td>
							<td> : </td>
							<td><input type="radio" name="pasien_tahu" id="pasien_ya" <?php if($hasil['pasien_mengetahui'] == 'Ya'){echo 'checked="true"';} ?> disabled> Ya</td>
							<td colspan="4"><input type="radio" name="pasien_tahu" id="pasien_tidak" <?php if($hasil['pasien_mengetahui'] == 'Tidak'){echo 'checked="true"';} ?> disabled> Tidak</td>
						</tr>
						<tr>
							<td>Pasien Mengalami Cedera ?</td>
							<td> : </td>
							<td><input type="radio" name="cedera" id="cedera_ya" <?php if($hasil['cedera'] == 'Ya'){echo 'checked="true"';} ?> disabled> Ya</td>
							<td colspan="4"><input type="radio" name="cedera" id="cedera_tidak" <?php if($hasil['cedera'] == 'Tidak'){echo 'checked="true"';} ?> disabled> Tidak</td>
						</tr>
						<tr>
							<td>Hasil Cidera</td>
							<td> : </td>
							<td width="88"><input type="radio" name="hasil" id="KTC" <?php if($hasil['hasil'] == 'KTC'){echo 'checked="true"';} ?> disabled> KTC</td>

							<td width="88"><input type="radio" name="hasil" id="KNC" <?php if($hasil['hasil'] == 'KNC'){echo 'checked="true"';} ?> disabled> KNC</td>

							<td width="88"><input type="radio" name="hasil" id="KPC" <?php if($hasil['hasil'] == 'KPC'){echo 'checked="true"';} ?> disabled> KPC</td>

							<td width="88"><input type="radio" name="hasil" id="KTD" <?php if($hasil['hasil'] == 'KTD'){echo 'checked="true"';} ?> disabled> KTD</td>

							<td><input type="radio" name="hasil" id="Sentinel" <?php if($hasil['hasil'] == 'Sentinel'){echo 'checked="true"';} ?> disabled> Sentinel</td>
						</tr>				
						<tr>
							<td>No. Laporan</td>
							<td> : </td>
							<td colspan="5"><input disabled name="nolap" id="no_lap" type="text" value="<?php echo $id; ?>" style="text-align:center;font-weight:bold;font-size:14px"></td>
						</tr>
						<tr>
							<td>Tanggal Kejadian </td>
							<td>:</td>
							<td colspan="5"><input disabled name="TglTjd" id="tgl_kejadian" type="text" value="<?php if(isset($hasil['tgl_kejadian'])){echo $hasil['tgl_kejadian']->format('d/m/Y');}?>" maxlength="10" style="text-align:center;font-weight:bold;font-size:15px"/></td>
						</tr>
						<tr>
							<td>Jam Kejadian</td>
							<td> : </td>
							<td colspan="5"><input disabled  value="<?php if(isset($hasil['jam_kejadian'])){echo $hasil['jam_kejadian'];}?>" id="jam_kejadian" name="jam_kejadian" maxlength="50" style="text-align:center;font-weight:bold;font-size:14px">
							</td>
						</tr>
						<tr>
							<td>Lokasi Kejadian</td>
							<td> : </td>
							<td colspan="5"><input disabled type="text" id="lokasi" name="lokasi" maxlength="50" value="<?php if(isset($hasil['lokasi'])){echo $hasil['lokasi'];} ?>"></td>
						</tr>
						<tr>
							<td>No. Rekam Medis</td>
							<td> : </td>
							<td colspan="5"><input disabled type="text" id="no_rm" name="no_rm" maxlength="50" value="<?php if(isset($hasil['no_rm'])){echo $hasil['no_rm'];} ?>"></td>
						</tr>
						<tr>
							<td>Unit terkait</td>
							<td> : </td>
							<td colspan="5">
								<span class="inputan" id="ini">
									<select id="kode_u" name="kode_u" disabled="disabled" style="width:auto">
										<option value=""><?php echo $hasil['kode_u'] ?></option>
									</select>
								</span>
							</td>
						</tr>
						<tr>
							<td>No. Laporan unit terkait</td>
							<td> : </td>
							<td colspan="5"><input name="no_lap_1" type="text" id="no_lap_1" disabled="disabled"maxlength="50" value="<?php if(isset($hasil['no_lap_1'])){echo $hasil['no_lap_1'];} ?>"></td>
						</tr>
						<tr>
                     		<td colspan="7">&nbsp;</td>
                        </tr>
						<tr>
							<td>Tipe Layanan</td>
							<td>&nbsp;</td>
							<td colspan="5"><input type="radio" name="tipe_layanan" id="rawatinap" <?php if($hasil['tipe_layanan'] == 'Rawat Inap'){echo 'checked="true"';} ?> disabled="disabled"> Rawat Inap</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td colspan="5"><input type="radio" name="tipe_layanan" id="rawatjalan" <?php if($hasil['tipe_layanan'] == 'Rawat Jalan'){echo 'checked="true"';} ?> disabled="disabled"> Rawat Jalan</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td colspan="5">
                            	<input type="radio" name="tipe_layanan" id="rawatlain" <?php if($hasil['tipe_layanan'] == 'Rawat Lain'){echo 'checked="true"';} ?> disabled="disabled"> Lainnya&nbsp;
								<input type="text" id="rawat_lain" name="tipe_layanan" maxlength="50" disabled="disabled" value="<?php if(isset($hasil['rawat_lain'])){echo $hasil['rawat_lain'];} ?>">
							</td>
						</tr>
						<tr>
                     		<td colspan="7">&nbsp;</td>
                        </tr>
						<tr>
							<td>Tingkat Cedera</td>
							<td>&nbsp;</td>
							<td colspan="5"><input disabled="disabled" type="radio" name="tingkat_cidera" id="kematian" <?php if($hasil['tingkat_cidera'] == 'kematian'){echo 'checked="true"';} ?>> Kematian</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td colspan="5"><input disabled="disabled" type="radio" name="tingkat_cidera" id="berat" <?php if($hasil['tingkat_cidera'] == 'berat'){echo 'checked="true"';} ?>> Cedera Berat</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td colspan="5"><input disabled="disabled" type="radio" name="tingkat_cidera" id="sedang" <?php if($hasil['tingkat_cidera'] == 'sedang'){echo 'checked="true"';} ?>> Cedera Sedang</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td colspan="5"><input disabled="disabled" type="radio" name="tingkat_cidera" id="ringan" <?php if($hasil['tingkat_cidera'] == 'ringan'){echo 'checked="true"';} ?>> Cedera Ringan</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td colspan="5"><input disabled="disabled" type="radio" name="tingkat_cidera" id="tidakada" <?php if($hasil['tingkat_cidera'] == 'tidak ada'){echo 'checked="true"';} ?>> Tidak Ada Cedera</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td colspan="5">
								<input disabled="disabled" type="radio" name="tingkat_cidera" id="lainnya" <?php if($hasil['tingkat_cidera'] == 'lain'){echo 'checked="true"';} ?>> Lainnya&nbsp;
								<input disabled="disabled" type="text" id="cedera_lain" name="tingkat_cidera" maxlength="50" value="<?php if(isset($hasil['cedera_lain'])){echo $hasil['cedera_lain'];} ?>"></td>
						</tr>
						<tr>
                     		<td colspan="7">&nbsp;</td>
                        </tr>
						<tr>
							<td>Indikator terkait</td>
							<td> : </td>
							<td colspan="5">
								<span class="inputan">
									<select id="kode_indikator" name="kode_indikator" disabled="disabled" style="width:auto">
										<option value=""></option>
                                        <?php
										include "koneksi.php";
										
										$que1 = "SELECT * FROM M_Indikator where Kode = '".$hasil['kode_indikator']."'";
                    					$sql1 = sqlsrv_query($conn1,$que1);
										
										if(isset($hasil['kode_indikator']))
                    					{
                      						while($indikator = sqlsrv_fetch_array($sql1, SQLSRV_FETCH_ASSOC)){
                  				
                  			  						echo "<option value=$indikator[Kode] selected='selected'>$indikator[Kategori]</option>";
                  	
                  							}
                    					}
       
										?>
									</select>
								</span>
							</td>
						</tr>
						<tr>
							<td>Jenis insiden</td>
							<td> : </td>
							<td colspan="5">
								<span class="inputan">
									<select id="kode_insiden" name="kode_insiden" disabled="disabled" style="width:auto">
										<option value=""><?php echo $hasil['kode_insiden'] ?></option>
									</select>
								</span>
							</td>
						</tr>
						<tr>
							<td>Tipe insiden</td>
							<td> : </td>
							<td colspan="5">
								<span class="inputan">
									<select id="tipe_insiden" name="tipe_insiden" disabled="disabled" style="width:auto">
										<option value=""><?php echo $hasil['tipe_insiden'] ?></option>
									</select>
								</span>
							</td>
						</tr>
						<tr>
							<td>Sub Tipe insiden</td>
							<td> : </td>
							<td colspan="5">
								<span class="inputan">
									<select id="kode_sub" name="kode_sub" disabled="disabled" style="width:auto">
										<option value=""><?php echo $hasil['kode_sub'] ?></option>
									</select>
								</span>
							</td>
						</tr>
						<tr>
							<td>Kronologi Kejadian</td>
							<td> : </td>
							<td colspan="5" rowspan="2"><textarea name="kronologis" rows="3" id="kronologis" value="" disabled="disabled"><?php if(isset($hasil['kronologis'])){echo $hasil['kronologis'];} ?></textarea></td>
						</tr>

						<td height="43">&nbsp;</td>
						<td>&nbsp;</td>

						<tr>
							<td colspan="7">Analisa Matriks grading resiko</td>
						</tr>
						<tr>
							<td height="43">&nbsp;</td>
							<td>&nbsp;</td>
							<td colspan="5">i. Skor dampak klinis/ severity</td>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td colspan="5"><input type="radio" name="skor_dampak" id="5" <?php if($hasil['skor_dampak'] == '5'){echo 'checked="true"';} ?> disabled> Katastropil (merah-5)</td></tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td colspan="5"><input type="radio" name="skor_dampak" id="4" <?php if($hasil['skor_dampak'] == '4'){echo 'checked="true"';} ?> disabled> Mayor (orange-4)</td></tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td colspan="5"><input type="radio" name="skor_dampak" id="3" <?php if($hasil['skor_dampak'] == '3'){echo 'checked="true"';} ?> disabled> Moderat (kuning-3)</td></tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td colspan="5"><input type="radio" name="skor_dampak" id="2" <?php if($hasil['skor_dampak'] == '2'){echo 'checked="true"';} ?> disabled> Minor (hijau-2)</td></tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td colspan="5"><input type="radio" name="skor_dampak" id="1" <?php if($hasil['skor_dampak'] == '1'){echo 'checked="true"';} ?> disabled> Tidak Signifikan (biru-1)</td></tr>
						</tr>
						<tr>
							<td height="43">&nbsp;</td>
							<td>&nbsp;</td>
							<td colspan="5">ii. Skor probabilitas/ frekuensi</td>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td colspan="5"><input type="radio" name="skor_prob" id="prob_5" <?php if($hasil['skor_prob'] == '5'){echo 'checked="true"';} ?> disabled> Sangat sering terjadi (merah-5)</td></tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td colspan="5"><input type="radio" name="skor_prob" id="prob_4" <?php if($hasil['skor_prob'] == '4'){echo 'checked="true"';} ?> disabled> Sering terjadi (orange-4)</td></tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td colspan="5"><input type="radio" name="skor_prob" id="prob_3" <?php if($hasil['skor_prob'] == '3'){echo 'checked="true"';} ?> disabled> Mungkin terjadi (kuning-3)</td></tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td colspan="5"><input type="radio" name="skor_prob" id="prob_2" <?php if($hasil['skor_prob'] == '2'){echo 'checked="true"';} ?> disabled> Jarang terjadi (hijau-2)</td></tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td colspan="5"><input type="radio" name="skor_prob" id="prob_1" <?php if($hasil['skor_prob'] == '1'){echo 'checked="true"';} ?> disabled> Sangat jarang terjadi (biru-1)</td></tr>
						</tr>
						<tr>
                     		<td colspan="7">&nbsp;</td>
                        </tr>
						<tr>
							<td>Hasil matriks grading resiko</td>
							<td> : </td>
							<td colspan="5"><input type="text" id="hasil_skor" name="hasil_skor" maxlength="50" value="<?php if(isset($hasil['hasil_skor'])){echo $hasil['hasil_skor'];} ?>" disabled></td>
						</tr>
					</table>

				</div>
				<!-- /span12 -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /main-inner -->
</div>
<!-- /main -->
<div class="extra">
	<div class="extra-inner">
		<div class="container">
			<div class="row">
				<p>
					Rumah Sakit Pantai Indah Kapuk
				</p>
			</div>
		</div>
		<!-- /container -->
	</div>
	<!-- /extra-inner -->
</div>
<!-- /extra -->
<div class="footer">
	<div class="footer-inner">
		<div class="container">
			<div class="row">
				<div class="span12"> &copy; 2013 <a href="#">Bootstrap Responsive Admin Template</a>. </div>
				<!-- /span12 -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /footer-inner -->
</div>
<!-- /footer -->
<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script>



</script>

<script src="js/excanvas.min.js"></script>
<script src="js/chart.min.js" type="text/javascript"></script>
<script src="js/bootstrap.js"></script>
<script src="js/Script.js"></script>
<script language="javascript" type="text/javascript" src="js/full-calendar/fullcalendar.min.js"></script>
<script src="js/base.js"></script>

</body>
</html>
