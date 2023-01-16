<?php
    $conn = mysqli_connect("localhost", "root", "", "spk");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Data Alternatif | SPK Profile Matching</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="fontAwesome/css/fontawesome.min.css">
        <link rel="stylesheet" href="fontAwesome/css/all.min.css">
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    </head>
    <body>
        <div class="sidebar">
            <div class="logo-details">
                <i class='bx bxs-shield icon'></i>
                <div class="logo_name">SDN Guyung 2</div>
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
            </ul>
        </div>
        <section class = "home-section">
            <div class="header">Data Alternatif</div>
            <div class='text'>
                <button><a href="tambah_alternatif.php"><i class="fas fa-plus-square"></i>  Tambah Alternatif</a></button>
                <table class = 'content-table' border = '1' width='98%'>
                    <tr>
                        <th align='center' width='10%'><b>ID</b></th>
                        <th align='center' width='20%'><b>Nama</b></th>
                        <th align='center' width='20%'><b>Nilai</b></th>
                        <th align='center' width='10%'></th>
                    </tr>
                    <?php
                        $no = 1;
                        $cari = "SELECT * FROM data_alternatif ORDER BY id_karyawan";
                        $hasil_cari = mysqli_query($conn, $cari);
                        while($data = mysqli_fetch_row($hasil_cari)){ 
                    ?>
                    <tr>
                        <td align='center'><?= $data[0]; ?></td>
                        <td align='center'><?= $data[1]; ?></td>
                        <td align='center'><a href='edit_nilai.php?id=<?= $data[0];?>'>Edit Nilai</a></td>
                        <td>
                            <center>
                                <a href="edit_alternatif.php?id=<?= $data[0];?>"><i class="fas fa-edit"></i></a> |
                                <a href="hapus_alternatif.php?id=<?= $data[0];?>" onclick="return confirm('Apakah anda yakin ingin menghapus ini ?')"><i class="far fa-trash-alt"></i></a>
                            </center>
                        </td>
                    </tr>
                    <?php } ?>
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
    </body>
</html>