<?php
require 'function.php';
require 'cek.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Barang Keluar</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">STOCK BARANG LAB TIF</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
       
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                        <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Stock Barang
                            </a>
                            <a class="nav-link" href="masuk.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Barang Masuk
                            </a>
                            <a class="nav-link" href="keluar.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Barang Keluar
                            </a>
                            <a class="nav-link" href="logout.php">
                                Logout
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Syariefan2000018200@webmail.uad.ac.id
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Barang Keluar</h1>
                       
                        
                       
                        <div class="card mb-4">
                            <div class="card-header">
                                  <!-- Button to Open the Modal -->
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                        Tambah barang 
                                    </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Id Barang</th>
                                                <th>Tanggal</th>
                                                <th>Penerima</th>
                                                <th>Jumlah</th>
                                                <th>Aksi</th>
                                            
                                            </tr>
                                        </thead>
                                        </tfoot>
                                        <tbody>
                                           
                                        <?php
                                                $i = 1;
                                                $query = mysqli_query($conn, "select * from keluar m, stock s where s.idbarang = m.idbarang");
                                                while($row = mysqli_fetch_array($query)){
                                                    $idb = $row['idbarang'];
                                                    $idk = $row['idkeluar'];
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $i; ?>
                                                    </td>
                                                    <td>
                                                    <?php echo $row['idbarang']; ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            $tanggal = $row['tanggal']; 
                                                            $pisah = explode("-", $tanggal);
                                                            $tangg = explode(" ", $pisah[2]);
                                                            echo $tangg[0]." ";
                                                            if($pisah[1]=="01"){
                                                                echo "Januari ";
                                                            }else if($pisah[1]=="02"){
                                                                echo "Februari ";
                                                            }else if($pisah[1]=="03"){
                                                                echo "Maret ";
                                                            }else if($pisah[1]=="04"){
                                                                echo "April ";
                                                            }else if($pisah[1]=="05"){
                                                                echo "Mei ";
                                                            }else if($pisah[1]=="06"){
                                                                echo "Juni ";
                                                            }else if($pisah[1]=="07"){
                                                                echo "Juli ";
                                                            }else if($pisah[1]=="08"){
                                                                echo "Agustus ";
                                                            }else if($pisah[1]=="09"){
                                                                echo "September ";
                                                            }else if($pisah[1]=="10"){
                                                                echo "Oktober ";
                                                            }else if($pisah[1]=="11"){
                                                                echo "November ";
                                                            }else if($pisah[1]=="12"){
                                                                echo "Desember ";
                                                            }
                                                            echo $pisah[0];
                                                            echo " ".$tangg[1]." WIB";
                                                        ?>
                                                    </td>
                                                    <td>
                                                    <?php echo $row['penerima']; ?>
                                                    </td>
                                                    <td>
                                                    <?php echo $row['qty']; ?>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myEdit<?php echo $idk; ?>">Edit</button>
                                                        <input type="hidden" value=<?php echo '"'.$idk.'"' ?> readonly>
                                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myDelete<?php echo $idk; ?>">Delete</button> 
                                                    </td>
                                                </tr>
                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="myEdit<?php echo $idk; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Data</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        
                                                        <!-- Modal body -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                <input type="text" name="keterangan" value=" <?=$row['penerima']; ?> " class="form-control" required>
                                                                <br>
                                                                <input type="texnumbert" name="qty" value=" <?=$row['qty']; ?> " class="form-control" required>
                                                                <br>
                                                                <input type="hidden" name="idb" value="<?=$id;?>">
                                                                <input type="hidden" name="idk" value="<?=$idk;?>">
                                                                <button type="submit" class="btn btn-warning" name="updatekeluar">Edit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            
                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="myDelete<?php echo $idk; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Hapus Data</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        
                                                        <!-- Modal body -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                Yakin lu mau ngapus <?php echo $row['namabarang']; ?>?
                                                                <br><br>
                                                                <input type="hidden" name="idb" value="<?=$idb;?>">
                                                                <input type="hidden" name="idk" value="<?=$idk;?>">
                                                                <input type="hidden" name="kty" value="<?=$row['qty'];?>">
                                                                <button type="submit" class="btn btn-danger" name="hapuskeluar">Hapus</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                                <?php $i++; } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Lab Informatika 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
        <div class="modal-content">
        
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Tambah Barang Keluar</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <form method="post">
            <div class="modal-body">
            <select name="barangnya" class="form-control"> 
                <?php
                    $ambilsemuadatanya = mysqli_query($conn,"SELECT * FROM stock");
                    while($fetcharray = mysqli_fetch_array($ambilsemuadatanya)){
                    
                ?>
                <option value=<?php echo $fetcharray['idbarang']; ?> > <?php echo $fetcharray['namabarang']; ?> </option>
                <?php } ?>
            </select>
            <br>   
            <input type="number" name="qty" placeholder="Quantity" class="form-control" required>
            <br>
            <input type="text" name="penerima" class="form-control" placeholder="Penerima" required>
            <br>
            <button type="submit" class="btn btn-primary" name="addbarangkeluar">submit</button>
            </div>
            </form>
        </div>
        </div>
    </div>
</html>
