<?php
session_start();
//Membuat koneksi ke database
$conn = mysqli_connect("localhost","root","","stockbarang");

if(isset($_POST['addnewbarang'])){
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];
    $stock = $_POST['stock'];

    $addtotable = mysqli_query($conn,"insert into stock (namabarang, deskripsi, stock) values('$namabarang','$deskripsi','$stock')");
    if($addtotable){
        header ('location:index.php');
    }else{
        echo 'Gagal';
        header('location : index.php');
    }
}


//Menambah barang masuk
if(isset($_POST['barangmasuk'])){
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstoksekarang = mysqli_query($conn, "SELECT * FROM stock WHERE idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstoksekarang);
    $stocksekarang = $ambildatanya['stock'];
    $addstock = $stocksekarang+$qty;

    $addtomasuk = mysqli_query($conn, "INSERT INTO masuk (idbarang, keterangan, qty) values('$barangnya','$penerima','$qty')");
    $updatestock = mysqli_query($conn, "UPDATE stock SET stock='$addstock' WHERE idbarang='$barangnya'");
    if($addtomasuk && $updatestock){
        header ('location:masuk.php');
    }else{
        echo 'Gagal';
    }
}
//Menambah barang keluar
if(isset($_POST['addbarangkeluar'])){
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstoksekarang = mysqli_query($conn, "SELECT * FROM stock WHERE idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstoksekarang);
    $stocksekarang = $ambildatanya['stock'];
    $addstock = $stocksekarang-$qty;

    $addtokeluar = mysqli_query($conn, "INSERT INTO keluar (idbarang, penerima, qty) values('$barangnya','$penerima','$qty')");
    $updatestock = mysqli_query($conn, "UPDATE stock SET stock='$addstock' WHERE idbarang='$barangnya'");
    if($addtokeluar && $updatestock){
        header ('location:keluar.php');
    }else{
        echo 'Gagal';
        header ('location:keluar.php');
    }
}

//Update Barang
if(isset($_POST['updatebarang'])){
    $idb = $_POST['idb'];
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];
    $update = mysqli_query($conn, "update stock set namabarang='$namabarang', deskripsi='$deskripsi' where idbarang ='$idb'");
    if($update){
        header('location:index.php');
    }else{
        echo 'Gagal';
        header('location:index.php');
    }
}


//Menghapus barang 
if(isset($_POST['hapusbarang'])){
    $id = $_POST['idb'];

    $hapus = mysqli_query($conn, "delete from stock where idbarang='$id'");
    if($hapus){
        header('location:index.php');
    }else{
        echo 'Gagal';
        header('location:index.php');
    }
}

//Edit barang masuk
if(isset($_POST['updatemasuk'])){
    $idb = $_POST['idb'];
    $idm = $_POST['idm'];
    $deskripsi = $_POST['keterangan'];
    $qty = $_POST['qty']; 

    $lihatstok = mysqli_query($conn, "select * from stock where idbarang='$idb'");
    $stoknya = mysqli_fetch_array($lihatstok);
    $stosekrng = $stoknya['stock']; //100

    $qtyskrng = mysqli_query($conn, "select * from masuk where idmasuk='$idm'");
    $qtynya = mysqli_fetch_array($qtyskrng);
    $qtys = $qtynya['qty']; //80

    if($qty>$qtys){
        $nambah = ($stosekrng - $qtys) + $qty;
        $tambah = mysqli_query($conn, "update stock set stock='$nambah' where idbarang='$idb'");
        $updatenya = mysqli_query($conn, "update masuk set qty='$qty', keterangan='$deskripsi' where idmasuk='$idm'");
        if($tambah && $updatenya){
            header('location:masuk.php');
        }else{
            echo 'Gagal';
            header('location:masuk.php');
        }
    }else{
        $jum = ($stosekrng - $qtys) + $qty;
        $tambahinstok = mysqli_query($conn, "update stock set stock='$jum' where idbarang='$idb'");
        $updatenya = mysqli_query($conn, "update masuk set qty='$qty' where idmasuk='$idm'");
        if($tambahinstok && $updatenya){
            header('location:masuk.php');
        }else{
            echo 'Gagal';
            header('location:masuk.php');
        }

    }
}

//Hapus masuk
if(isset($_POST['hapusmasuk'])){
    $idb = $_POST['idb'];
    $idm = $_POST['idm'];
    $qty = $_POST['kty'];

    $getData = mysqli_query($conn, "select * from stock where idbarang='$idb'");
    $data = mysqli_fetch_array($getData);
    $stok = $data['stock'];

    $selisih = $stok-$qty;

    $update = mysqli_query($conn, "update stock set stock='$selisih' where idbarang='$idb'");
    $hapusdata = mysqli_query($conn, "delete from masuk where idmasuk='$idm'");

    if($update && $hapusdata){
        header('location:masuk.php');
    }else{
        echo 'Gagal';
        header('location:masuk.php');
    }
}


//Mengubah barang keluar
if(isset($_POST['updatekeluar'])){
    $idb = $_POST['idb'];
    $idk = $_POST['idk'];
    $deskripsi = $_POST['keterangan'];
    $qty = $_POST['qty']; 

    $lihatstok = mysqli_query($conn, "select * from stock where idbarang='$idb'");
    $stoknya = mysqli_fetch_array($lihatstok);
    $stosekrng = $stoknya['stock']; 

    $qtyskrng = mysqli_query($conn, "select * from keluar where idkeluar='$idk'");
    $qtynya = mysqli_fetch_array($qtyskrng);
    $qtys = $qtynya['qty']; 

    if($qty>$qtys){
        $kurang = ($stosekrng + $qtys) - $qty;
        $kurangin = mysqli_query($conn, "update stock set stock='$kurang' where idbarang='$idb'");
        $updatenya = mysqli_query($conn, "update keluar set qty='$qty', penerima='$deskripsi' where idkeluar='$idk'");
        if($kurangin && $updatenya){
            header('location:keluar.php');
        }else{
            echo 'Gagal';
            header('location:keluar.php');
        }
    }else{
        $jum = ($stosekrng + $qtys) - $qty;
        $tambahinstok = mysqli_query($conn, "update stock set stock='$jum' where idbarang='$idb'");
        $updatenya = mysqli_query($conn, "update keluar set qty='$qty' where idkeluar='$idk'");
        if($tambahinstok && $updatenya){
            header('location:keluar.php');
        }else{
            echo 'Gagal';
            header('location:keluar.php');
        }

    }
}

//Hapus keluar
if(isset($_POST['hapuskeluar'])){
    $idb = $_POST['idb'];
    $idk = $_POST['idk'];
    $qty = $_POST['kty'];

    $getData = mysqli_query($conn, "select * from stock where idbarang='$idb'");
    $data = mysqli_fetch_array($getData);
    $stok = $data['stock'];

    $selisih = $stok;

    $update = mysqli_query($conn, "update stock set stock='$selisih' where idbarang='$idb'");
    $hapusdata = mysqli_query($conn, "delete from keluar where idkeluar='$idk'");

    if($update && $hapusdata){
        header('location:keluar.php');
    }else{
        echo 'Gagal';
        header('location:keluar.php');
    }
}
?>
