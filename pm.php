<?php
	$conn = mysqli_connect("localhost", "root", "", "spk");
?>
<!doctype html>
<html lang="en">
  <head>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="fontAwesome/css/fontawesome.min.css">
	<link rel="stylesheet" href="fontAwesome/css/all.min.css">
	<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <title>Metode Profile Matching</title>
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
            <div class="header">Penghitungan Metode Profile Matching</div>
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
						$sql="SELECT * FROM data_sample";
						$hasil=mysqli_query($conn, $sql);
						while($row=mysqli_fetch_assoc($hasil))
							{
								$nilai_sample[$row['karyawan']][$row['faktor']]=$row['nilai'];
							}
					//---------------------Menyimpan tabel karyawan dalam array---------------------		
						$nama_karyawan=array();
						$nilai_akhir=array();
						$sql="SELECT * FROM data_alternatif ORDER BY id_karyawan";
						$hasil=mysqli_query($conn, $sql);
						while($row=mysqli_fetch_assoc($hasil))
							{
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
				?>
				<h2>Data Kriteria</h2>
				<table class = 'content-table' border ='1' width='100%'>
					<tr>
						<th align='center'>No</th>
						<th align='center'>Kriteria</th>
						<th align='center'>Sub Kriteria</th>
						<th align='center'>Bobot PM</th>
						<th align='center'>Bobot SAW</th>
						<th align='center'>Type</th>
					</tr>
					<?php
						$nilai_norm=array();
						$no=1;
						//---------------------Menyimpan tabel faktor dalam array dan menampilkan---------------------
						$sql="SELECT data_subkriteria.*,nama_aspek,IF(jenis='C','c','s') AS nama_jenis
							FROM data_subkriteria LEFT JOIN data_kriteria ON kriteria=id_aspek ORDER BY kriteria,id_sub";
						$hasil=mysqli_query($conn, $sql);
						$nama_jenis=array();
						while($row=mysqli_fetch_assoc($hasil))
						{		
							$bobot_pm[$row['id_sub']]=$row['bobot_standar_pm'];
							$bobot_saw[$row['id_sub']]=$row['bobot_standar_saw'];
							$nama_jenis[$row['id_sub']]=$row['nama_jenis'];
					?>
					<tr>
						<td align='center'><?php echo $no++;?></td>
						<td align='center'><?php echo $row['nama_aspek'];?></td>
						<td align='center'><?php echo $row['nama_sub'];?></td>
						<td align='center'><?php echo $row['bobot_standar_pm'];?></td>
						<td align='center'><?php echo $row['bobot_standar_saw'];?></td>
						<td align='center'><?php echo $row['nama_jenis'];?></td>
					</tr>
					<?php
							}
					?>
				</table>
				<hr /> <br>

				<h2>Data Sampel</h2>
				<table class = 'content-table' border = '1' width='100%'>
					<tr>
						<th align='center'>No</th>
						<th align='center'>Nama</th>
						<?php 
							while (list($key, $value) = each($nama_aspek)) {		
								for($kol=1;$kol<=$jumlah_kolom[$key];$kol++) {?>
						<th align='center'><?php echo $nama_singkat[$key]; ?><sub><?php echo $kol;?></sub></th>
						<?php } 
							}?>
					</tr>
					<?php
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
							while (list($key, $value) = each($nama_aspek)) {
								for($kol=1;$kol<=$jumlah_kolom[$key];$kol++) {
									$pos=$r_index[$key][$kol];
							?>
						<td><?php echo $nilai_sample[$k][$pos]; ?></td>
						<?php 
								} 
							}?>
					</tr>
					<?php
							}
					?>
				</table>
				<hr /> <br>

				<h2>Normalisasi</h2>
				<table class = 'content-table' border='1' width='100%' >
					<tr align='center'>
						<th>No</th>
						<th>Nama</th>
						<?php 
							reset($nama_aspek);
							while (list($key, $value) = each($nama_aspek)) {
								for($kol=1;$kol<=$jumlah_kolom[$key];$kol++) {?>
						<th><?php echo $nama_singkat[$key]; ?><sub><?php echo $kol;?></sub></th>
						<?php }
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
							while (list($key, $value) = each($nama_aspek)) {
								for($kol=1;$kol<=$jumlah_kolom[$key];$kol++) {
									$pos=$r_index[$key][$kol];
									if($nilai_sample[$k][$pos]<=80.0){
										$nilai_norm[$k][$pos]= 1;
									}elseif($nilai_sample[$k][$pos]<=82.0){
										$nilai_norm[$k][$pos]=2;
									}elseif($nilai_sample[$k][$pos]<=84.0){
										$nilai_norm[$k][$pos]=3;
									}elseif($nilai_sample[$k][$pos]<=100.0){
										$nilai_norm[$k][$pos]=4;
									}
							?>
						<td><?php echo $nilai_norm[$k][$pos];?></td>
						<?php } 
							}?>
					</tr>
					<?php
							}
					?>
				</table>
				<hr> <br>

				<h2>Perhitungan Gap</h2>
				<table class = 'content-table' border='1' width='100%'>
					<tr align='center'>
						<th>No</th>
						<th>Nama</th>
						<?php 
							reset($nama_aspek);
							while (list($key, $value) = each($nama_aspek)){
								for($kol=1;$kol<=$jumlah_kolom[$key];$kol++) {?>
						<th><?php echo $nama_singkat[$key]; ?><sub><?php echo $kol;?></sub></th>
						<?php } 
							}?>
					</tr>
					<?php
						//---------------------Proses menghitung nilai GAP---------------------		
						reset($nama_karyawan);
						$nomor=1;	
						while (list($k, $v) = each($nama_karyawan)){
								
					?>
					<tr align='center'>
						<td><?php echo $nomor++;?></td>
						<td><?php echo $nama_karyawan[$k];?></td>
						<?php 
							reset($nama_aspek);
							while (list($key, $value) = each($nama_aspek)){
								for($kol=1;$kol<=$jumlah_kolom[$key];$kol++) {
									$pos=$r_index[$key][$kol];
									$nilai_gap[$k][$pos]=$nilai_norm[$k][$pos]-$bobot_pm[$pos]
							?>
						<td><?php echo $nilai_gap[$k][$pos];?></strong></td>
						<?php } 
							}?>
					</tr>
					<?php
							}
					?>
				</table>
				<hr /> <br><br>
				
				<h2>Nilai Total</h2>
				<?php
					reset($nama_aspek);
					while (list($key, $value) = each($nama_aspek)) 
							{		
								echo "<h4>Aspek ".$nama_aspek[$key]." (".$ba_all[$key]."%)</h4>";
								
						?>
				<table class = 'content-table' border='1' width='100%'>
					<tr align='center'>
						<th>No</th>
						<th>Nama</th>
						<?php for($kol=1;$kol<=$jumlah_kolom[$key];$kol++) {
								$pos=$r_index[$key][$kol];
							?>
						<th><?php echo $nama_singkat[$key]; ?><sub><?php echo $kol;?></sub>[<?php echo $nama_jenis[$pos];?>]</th>
						<?php } ?>
						<th>rCF (<?php echo $ba_cf[$key];?>%)</th>
						<th>rSF (<?php echo $ba_sf[$key];?>%)</th>
						<th>Nilai</th>
					</tr>
					<?php
						reset($nama_karyawan);
						$nomor=1;	
						while (list($k, $v) = each($nama_karyawan)) 
							{
								$jum_cf=$jum_sf=$ccf=$csf=0;
								
					?>
					<tr align='center'>
						<td><?php echo $nomor++;?></td>
						<td><?php echo $nama_karyawan[$k];?></td>
						<?php for($kol=1;$kol<=$jumlah_kolom[$key];$kol++) {
									$pos=$r_index[$key][$kol];
									$nilai_bobot[$k][$pos]=$bobot[$nilai_norm[$k][$pos]-$bobot_pm[$pos]];
									if($nama_jenis[$pos]=="c")
										{
											$jum_cf+=$nilai_bobot[$k][$pos];
											$ccf++;	
										}
									else
										{
											$jum_sf+=$nilai_bobot[$k][$pos];
											$csf++;	
										}	
										
							?>
						<td><?php echo $nilai_bobot[$k][$pos];?></td>
						<?php }
						
							$ncf=$jum_cf/$ccf;
							$nsf=$jum_sf/$csf;
							$nilai_bobot[$k][$key]=$ba_cf[$key]*($ncf/100)+$ba_sf[$key]*($nsf/100);
							$nilai_akhir[$k]+=$nilai_bobot[$k][$key]*($ba_all[$key]/100);
						?>
						<td><?php echo $jum_cf."/".$ccf;?>=<?php echo number_format($ncf,2,",","."); ?></td>
						<td><?php echo $jum_sf."/".$csf;?>=<?php echo number_format($nsf,2,",","."); ?></td>
						<td><?php echo  number_format($nilai_bobot[$k][$key],2,",","."); ?></td>
					</tr>
					<?php
							}
					?>
				</table>
				<hr> <br>

				<?php			
						}
						//print_r($nilai_akhir);
						reset($nilai_akhir);
						//krsort($nilai_akhir);
						//print_r($nilai_akhir);
				?>
				<h2>Nilai Akhir Total</h2>
				<table class = 'content-table' border = '1' width='100%'>
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
							<td><?php echo number_format($nilai_akhir[$k],2,",","."); ?></td>
						</tr>
					<?php					
							}
					?>
				</table> <br>
					<?php
						//print_r($nilai_akhir);
						reset($nilai_akhir);
						arsort($nilai_akhir);
						//print_r($nilai_akhir);
					?>
										
				<h2>Perangkingan</h2>
				<table class = 'content-table' border='1' width='100%'>
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
							<td><?php echo number_format($nilai_akhir[$k],2,",","."); ?></td>
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