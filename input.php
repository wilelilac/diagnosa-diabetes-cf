<?php 
include 'auth.php';
$db=new auth();
$db -> koneksi();
if (isset($_POST['submit'])){
        $nilai=$_POST['nilai'];
        $nama=$_POST['nama'];
        $penyakit=$_POST['penyakit'];
        $tgl=date("Y/m/d");
        $sql=mysqli_fetch_assoc(mysqli_query($db->konek, "SELECT * FROM catatanmedis WHERE nama"));
        $query="INSERT INTO catatanmedis VALUES('', '$nama', '$nilai','$penyakit','$tgl')";
        mysqli_query($db->konek, $query);
        echo "<script> alert('data berhasil ditambah');</script>" ;
        echo "<script> location='diagnosa.php'</script>";
      } ?>