<?php
	$conn = mysqli_connect("localhost", "root", "", "spk");
?>
<!doctype html>
<html lang="en">
  	<head>
		<!-- <link rel="stylesheet" href="bs/bootstrap.min.css"> -->
		<link rel="stylesheet" href="style.css"><link rel="stylesheet" href="fontAwesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="fontAwesome/css/all.min.css">
		<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
		<!--<link rel="stylesheet" href="style.css"> -->
		<title>Metode SAW</title>
  	</head>
  	<body>
  		<div class="sidebar">
            <div class="logo-details">
                <i class='bx bxs-shield icon'></i>
                <div class="logo_name">SPK Profile Matching</div>
                <i class='bx bx-menu' id="btn" ></i>
            </div>
            <ul class="nav-list">
                <li>
                    <a href="index.php">
                        <i class='bx bx-grid-alt'></i>
                        <span class="links_name">Dashboard</span>
                    </a>
                    <span class="tooltip">Dashboard</span>
                </li>
                <li>
                    <a href="data_alternatif.php">
                        <i class='bx bx-user' ></i>
                        <span class="links_name">Alternatif</span>
                    </a>
                    <span class="tooltip">Alternatif</span>
                </li>
                <li>
                    <a href="data_kriteria.php">
                        <i class='bx bx-library'></i>
                        <span class="links_name">Kriteria</span>
                    </a>
                    <span class="tooltip">Kriteria</span>
                </li>
                <li>
                    <a href="data_subkriteria.php">
                        <i class='bx bx-list-ul'></i>
                        <span class="links_name">Sub Kriteria</span>
                    </a>
                    <span class="tooltip">Sub Kriteria</span>
                </li>
                <li>
                    <a href="hasil.php">
                        <i class='bx bx-clipboard'></i>
                        <span class="links_name">Perhitungan</span>
                    </a>
                    <span class="tooltip">Perhitungan</span>
                </li>
                </li>
            </ul>
        </div>
		<section class = "home-section">
            <div class="header">Penghitungan Metode SAW</div>
            <div class='text'>
				<?php
					//---------------------Menyimpan tabel bobot dalam array---------------------
						$bobot=array();
						$sql="SELECT * FROM bobot";
						$hasil=mysqli_query($conn, $sql);
						while($row=mysqli_fetch_assoc($hasil))
							{
								$bobot[$row['selisih']]=$row['bobot'];
							}
					//---------------------Menyimpan tabel sample dalam array---------------------
						//$rk=array();
						$sql="SELECT * FROM data_sample";
						$hasil=mysqli_query($conn, $sql);
						while($row=mysqli_fetch_assoc($hasil))
							{
								$nilai_sample[$row['karyawan']][$row['faktor']]=$row['nilai'];
							}
					//---------------------Menyimpan tabel karyawan dalam array---------------------		
						$nama_karyawan=array();
						$nilai_akhir=array();
						$id_karyawan=array();
						$sql="SELECT * FROM data_alternatif ORDER BY id_karyawan";
						$hasil=mysqli_query($conn, $sql);
						while($row=mysqli_fetch_assoc($hasil))
							{
								$id_karyawan=$row['id_karyawan'];
								$nama_karyawan[$row['id_karyawan']]=$row['nama_karyawan'];
								$nilai_akhir[$row['id_karyawan']]=0;
							}
					//---------------------Menyimpan tabel aspek dalam array---------------------		
						$nama_aspek=array(); 
						$nama_singkat=array(); 
						$jumlah_kolom=array();
						$ba_all=array();
						$ba_cf=array();
						$ba_sf=array();
						$sql="SELECT *,(SELECT COUNT(id_sub) FROM data_subkriteria WHERE kriteria=id_aspek) AS jum_kolom 
							FROM data_kriteria";
						$hasil=mysqli_query($conn, $sql);
						while($row=mysqli_fetch_assoc($hasil))
							{
								$aspek=$row['id_aspek'];
								$nama_aspek[$row['id_aspek']]=$row['nama_aspek'];
								$nama_singkat[$row['id_aspek']]=$row['nama_singkat'];
								$jumlah_kolom[$row['id_aspek']]=$row['jum_kolom'];
								$ba_all[$row['id_aspek']]=$row['bobot'];
								$ba_cf[$row['id_aspek']]=$row['bobot_core'];
								$ba_sf[$row['id_aspek']]=$row['bobot_secondary'];
								//------------cari index berdasarkan nomor 
								$sql2="SELECT * FROM data_subkriteria WHERE kriteria='$aspek' ORDER BY id_sub";
								$hasil2=mysqli_query($conn, $sql2);
								$kolom=1;
								while($row2=mysqli_fetch_assoc($hasil2))
									{
										$r_index[$aspek][$kolom]=$row2['id_sub'];
										$kolom++;
									}
							}
					//-----------data kriteria---
						$sub=array();
						$nama_sub=array();
						$sql2="SELECT * FROM data_subkriteria WHERE kriteria='$aspek' ORDER BY id_sub";
						$hasil2=mysqli_query($conn, $sql2);
						$kolom=1;
						while($row2=mysqli_fetch_assoc($hasil2))
							{
								$sub=$row['id_sub'];
								$nama_sub[$row['id_sub']]=$row['nama_sub'];
								$r_index2[$aspek][$kolom]=$row2['id_sub'];
								$kolom++;
							}
					?>

				<h2>Data Kriteria</h2>
					<table class = 'content-table' border='1' width='100%'>
						<tr align='center'>
							<th>No</th>
							<th>Kriteria</th>
							<th>Bobot SAW</th>
							<th>Atribut</th>
						</tr>
						<?php
							$nilai_norm=array();
							$norm=array();
							$no=1;
							//---------------------Menyimpan tabel faktor dalam array dan menampilkan----------
							$sql="SELECT * FROM data_subkriteria ORDER BY id_sub";
							$hasil=mysqli_query($conn, $sql);
							$id_sub=array();
							$nama_sub=array();
							$bobot_saw=array();
							$jns_saw=array();
							while($row=mysqli_fetch_assoc($hasil))
							{		
								
								$nama_sub[$row['id_sub']]=$row['nama_sub'];
								$bobot_saw[$row['id_sub']]=$row['bobot_standar_saw'];
								$jns_saw[$row['id_sub']]=$row['jns_saw'];
						?>
						<tr align='center'>
							<td><?php echo $no++;?></td>
							<td><?php echo $row['nama_sub'];?></td>
							<td><?php echo $row['bobot_standar_saw'];?></td>
							<td><?php echo $row['jns_saw'];?></td>
						</tr>
						<?php
								}
						?>
					</table> 
					<hr><br>
		
				<h2>Data Sampel</h2>
					<table border = '1' class = 'content-table' width='100%'>
						<thead><tr align='center'>
							<th>No</th>
							<th>Nama</th>
							<?php while (list($key, $value) = each($nama_aspek)) 
									{
										for($kol=1;$kol<=$jumlah_kolom[$key];$kol++) {?>
							<th><?php echo $nama_singkat[$key]; ?><sub><?php echo $kol;?></sub></th>
							<?php }
							}?>
						</tr></thead>
						<?php
						//reset($nama_aspek); 
						
							reset($nama_karyawan);
							$nomor=1;	
							while (list($k, $v) = each($nama_karyawan)) 
								{
									
						?>
						<tbody><tr align='center'>
							<td><?php echo $nomor++;?></td>
							<td><?php echo $nama_karyawan[$k];?></td>
							<?php 
								reset($nama_aspek);
								//var_dump($nama_aspek);
								while (list($key, $value) = each($nama_aspek)) 
								{	
									for($kol=1;$kol<=$jumlah_kolom[$key];$kol++) {
										$pos=$r_index[$key][$kol];
										
								?>
							<td><?php echo $nilai_sample[$k][$pos]; ?></td>
							<?php 
									}
								} ?>
						</tr></tbody>
						<?php
								//var_dump($k);
							}
							
						?>
					</table>
        			<hr> <br>
		
				<h2>Matriks Keputusan (X)</h2>
					<table border='1' class = 'content-table' width='100%'>
						<tr align='center'>
							<th>No</th>
							<th>Nama</th>
							<?php
								reset($nama_aspek);
								while (list($key, $value) = each($nama_aspek)) 
									{						
									for($kol=1;$kol<=$jumlah_kolom[$key];$kol++) {?>
							<th><?php echo $nama_singkat[$key]; ?><sub><?php echo $kol;?></sub></th>
							<?php 		}
									} ?>
						</tr>
						<?php
							//--------Pembobotan----------
							reset($nama_karyawan);
							$nomor=1;	
							while (list($k, $v) = each($nama_karyawan)) 
								{
									
						?>
						<tr align='center'>
							<td><?php echo $nomor++;?></td>
							<td><?php echo $nama_karyawan[$k];?></td>
							<?php 
								reset($nama_aspek);
								while (list($key, $value) = each($nama_aspek)) 
									{
									for($kol=1;$kol<=$jumlah_kolom[$key];$kol++) {
										$pos=$r_index[$key][$kol];
										if($nilai_sample[$k][$pos]<=80.0){
											$nilai_sample[$k][$pos]= 1;
										}elseif($nilai_sample[$k][$pos]<=82.0){
											$nilai_sample[$k][$pos]=2;
										}elseif($nilai_sample[$k][$pos]<=84.0){
											$nilai_sample[$k][$pos]=3;
										}elseif($nilai_sample[$k][$pos]<=100.0){
											$nilai_sample[$k][$pos]=4;
										}
								?>
							<td><?php echo $nilai_sample[$k][$pos];?></td>
							<?php } 
								}?>
						</tr>
						<?php
								}
						?>
					</table>
				<hr> <br>

				<h2>Max/Min</h2>
					<table border = '1' class = 'content-table' width='100%'>
						<tr align='center'>
							<th>Kriteria</th>
							<?php 
								reset($nama_aspek);
								while (list($key, $value) = each($nama_aspek)) 
									{	
									for($kol=1;$kol<=$jumlah_kolom[$key];$kol++) {?>
							<th><?php echo $nama_singkat[$key]; ?><sub><?php echo $kol;?></sub></th>
							<?php } 
								}	?>
						</tr>
						<tr align='center'>
							<td>Nilai Maks</td>
							<?php 
							reset($nama_aspek);
							while (list($key, $value) = each($nama_aspek)) 
								{
									for($kol=1;$kol<=$jumlah_kolom[$key];$kol++) {
										$pos=$r_index[$key][$kol];
										for ($a=1; $a<=count($nilai_sample); $a++){
											$n = $nilai_sample[$a][$pos];
											//var_dump($a); echo '</br>';
											//var_dump($pos); echo '</br>';
											//var_dump($n); echo '</br>';
											$norm[] = $n;
										}
										
										$maks[$pos] = max($norm); //echo 'maks';
										$mins[$pos] = min($norm);
										//var_dump($maks[$pos]); echo '</br>'; echo '</br>';
									
								?>
							<td>
								<?php if ($jns_saw='Benefit'){
										echo $maks[$pos];
									}elseif ($jns_saw='Cost') {
										echo $mins[$pos];
									}
								}
								?>
							</td>
							<?php	
								}							
								
							?>
					
						</tr>
					</table>
				<hr /> <br>

				<h2>Matriks Ternormalisasi (R)</h2>
					<table border='1' class = 'content-table' width='100%'>
						<tr align='center'>
							<th>No</th>
							<th>Nama</th>
							<?php
								reset($nama_aspek);
								while (list($key, $value) = each($nama_aspek)) 
									{						
									for($kol=1;$kol<=$jumlah_kolom[$key];$kol++) {?>
							<th><?php echo $nama_singkat[$key]; ?><sub><?php echo $kol;?></sub></th>
							<?php 		}
									} ?>
						</tr>
						<?php
							//--------Pembobotan----------
							reset($nama_karyawan);
							$nomor=1;	
							while (list($k, $v) = each($nama_karyawan)) 
								{
									
						?>
						<tr align='center'>
							<td><?php echo $nomor++;?></td>
							<td><?php echo $nama_karyawan[$k];?></td>
							<?php 
								reset($nama_aspek);
								while (list($key, $value) = each($nama_aspek)) 
									{
									for($kol=1;$kol<=$jumlah_kolom[$key];$kol++) {
										$pos=$r_index[$key][$kol];
										$matriks_r[$k][$pos]= $nilai_sample[$k][$pos]/$maks[$pos];
								?>
							<td><?php echo round($matriks_r[$k][$pos], 2);?></td>
							<?php } 
								}?>
						</tr>
						<?php //var_dump($maks[$pos]);
								}
						?>
					</table>
				<hr><br>

				<h2>Perangkingan (V)</h2>
					<table border='1' class = 'content-table' width='100%'>
						<tr align='center'>
							<th>No</th>
							<th>Nama</th>
							<th>Nilai Total (V)</th>
						</tr>
						<?php
							//--------Pembobotan----------
							$digit = 2;
							reset($nama_karyawan);
							$nomor=1;	
							while (list($k, $v) = each($nama_karyawan)) 
								{
									
						?>
						<tr align='center'>
							<td><?php echo $nomor++;?></td>
							<td><?php echo $nama_karyawan[$k];?></td>
							<?php 
								//$total_nilai=array();
								reset($nama_aspek);
								while (list($key, $value) = each($nama_aspek)) {
									for($kol=1;$kol<=$jumlah_kolom[$key];$kol++) {
										$pos=$r_index[$key][$kol];
										$nilai_akhir[$k] += (round($matriks_r[$k][$pos], 2) * $bobot_saw[$pos]);
										//var_dump($nilai_akhir[$k]);
									}; 
								}
							?>
							<td><?php echo round($nilai_akhir[$k], 4); ?></td>
						</tr>
						<?php
								}
						?>
					</table>
					<?php
						//print_r($nilai_akhir);
						reset($nilai_akhir);
						arsort($nilai_akhir);
						//print_r($nilai_akhir);
					?>
					<hr><br>

				<h1>Nilai Akhir Total Sorting</h1>
					<table border='1' class = 'content-table' width='100%'>
						<tr align='center'>
							<th>No</th>
							<th>Nama</th>
							<th>Nilai</th>
						</tr>
							<?php
								$nomor=1;	
								while (list($k, $v) = each($nilai_akhir)) 	
									{
								?>
						<tr align='center'>
								<td><?php echo $nomor++; ?></td>
								<td><?php echo $nama_karyawan[$k]; ?></td>
								<td><?php echo number_format($nilai_akhir[$k],4,",","."); ?></td>
						</tr>
						<?php					
									}
							?>
					</table>
			</div>
		</section>
        <script>
        let sidebar = document.querySelector(".sidebar");
        let closeBtn = document.querySelector("#btn");
        let searchBtn = document.querySelector(".bx-search");

        closeBtn.addEventListener("click", ()=>{
            sidebar.classList.toggle("open");
            menuBtnChange();//calling the function(optional)
        });

        searchBtn.addEventListener("click", ()=>{ // Sidebar open when you click on the search iocn
            sidebar.classList.toggle("open");
            menuBtnChange(); //calling the function(optional)
        });

        // following are the code to change sidebar button(optional)
        function menuBtnChange() {
        if(sidebar.classList.contains("open")){
            closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");//replacing the iocns class
        }else {
            closeBtn.classList.replace("bx-menu-alt-right","bx-menu");//replacing the iocns class
        }
        }
        </script>
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="bs/jquery-3.2.1.slim.min.js"></script>
		<script src="bs/bootstrap.min.js"></script>
	</body>
</html>