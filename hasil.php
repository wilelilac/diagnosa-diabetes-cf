<?php
    // untuk memanggil file
    include 'Crud.php';
    
    // untuk mendeklarasikan class menjadi variabel
    $crud = new Crud();
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DiagBetes - Diagnosa Penyakit Diabetes</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
</head>
</head>

<body>
    <div class="container my-2 mt-5">
            <div class="row">
                <div class="col-lg-1">
                    <a class="btn btn-primary" href="diagnosa.php">Kembali</a> 
                </div>
                <div class="col-lg-10 ms-1">
                    <h3>DiagBetes - Diagnosa Penyakit Diabetes</h3>
                </div>
                <hr class="my-4" />
            </div>
    </div>

  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <nav class="nav nav-tabs" id="myTab" role="tablist">
          <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Proses Perhitungan</a>
          <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Hasil Perhitungan</a>
          <a class="nav-item nav-link" id="nav-solusi-tab" data-toggle="tab" href="#nav-solusi" role="tab" aria-controls="nav-solusi" aria-selected="false">Solusi Penyakit</a>          
          <a href="#" class="btn btn-sm btn-primary shadow-sm" id="buttonClick" onclick="printHasil()"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a><br><br>

        </nav>
        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <div row>
              <div class="col-md-12" style="text-align: center;">
                <?php
                  if (isset($_POST['button']))
                  {
                    // group kemungkinan terdapat penyakit
                    $groupKemungkinanPenyakit = $crud->getGroupPengetahuan(implode(",", $_POST['gejala']));

                    // menampilkan kode gejala yang di pilih
                    $sql = $_POST['gejala'];   
                    $nama = $_POST['nama']; 
                    $test = $_POST['kondisi']; 
                    $wxgejala =( $_POST['gejala']);
                    $host="localhost";
                      $id="root";
                      $password="";
                      $db="diagnosa";  
                   
                    if (isset($sql)) {
                      // mencari data penyakit kemungkinan dari gejala
                    
                      for ($h=0; $h < count($sql); $h++) {
                        $kemungkinanPenyakit[] = $crud->getKemungkinanPenyakit($sql[$h]);
                        
                        
                        for ($x=0; $x < count($kemungkinanPenyakit[$h]); $x++) {
                          for ($i=0; $i < count($groupKemungkinanPenyakit); $i++) {
                            $namaPenyakit = $groupKemungkinanPenyakit[$i]['nama_penyakit'];               
                         
                            if ($kemungkinanPenyakit[$h][$x]['nama_penyakit'] == $namaPenyakit) {
                              // list di kemungkinan dari gejala
                                             
                              // echo '<pre>'; var_dump($kemungkinanPenyakit[$h][$x]['id_pengetahuan']);
                              $listIdKemungkinan[$namaPenyakit][] = $kemungkinanPenyakit[$h][$x]['id_pengetahuan'];
                            
                          }
                          }
                          $pengetahuanid[] = $kemungkinanPenyakit[$h][$x]['id_pengetahuan'];  
                          // echo '<pre>'; var_dump($pengetahuanid) ;       
                      
                        }
                      }     
                         
                            /**
                         * @var float|array $test
                       */               
                     
                      for ($ba = 0; $ba < count($sql); $ba++) {                      
                      // var_dump($wxgejala[$ba]);
                      $updatemb = "UPDATE pengetahuan SET mb=$test[$ba] WHERE id_gejala = $wxgejala[$ba]";
                      $kon = mysqli_connect($host,$id,$password,$db);
                      $query = mysqli_query($kon,$updatemb);
                      //  if(mysqli_affected_rows($kon)>0){
                      //  echo 'data berhasil diubah'; 
                      //  echo "<br/>";
                      //  echo var_dump((int)$wxgejala);
                      //  echo "<br/>";
                      //  echo  var_dump($test[$ba]);
                      
                      //  }else{
                      // echo 'data gagal diubah';
                      //  echo "<br/>";
                      //  echo  var_dump($wxgejala[$ba]);
                     
                      //  echo  var_dump($test[$ba]);
                      //  }
                    }               
                      $id_penyakit_terbesar = '';
                      $nama_penyakit_terbesar = '';
                      $kombin=[];
                      $cfkombin=0;     
                  
                      // list penyakit kemungkinan
                      for ($h=0; $h < count($groupKemungkinanPenyakit); $h++) { 
                        $namaPenyakit = $groupKemungkinanPenyakit[$h]['nama_penyakit'];
                        $cfuser=[];       
                        echo "<br/>===========================================<br/>";  
                        echo "Jumlah Gejala = ".
                                  count($listIdKemungkinan[$namaPenyakit])."<br/>";
                                  echo "===========================================";        
                        echo "<br/>===========================================".
                        "<br/>Proses Penyakit ".$h.".".$namaPenyakit.
                        "<br/>===========================================<br/>";                     
                        // list penyakit kemungkinan dari gejala    
                        for ($x=0; $x < count($listIdKemungkinan[$namaPenyakit]); $x++) { 
                          
                          $daftarKemungkinanPenyakit = $crud->getListPenyakit($listIdKemungkinan[$namaPenyakit][$x]);                    
                          echo "<br/>proses ".$x."<br/>-------------------------------------------<br/>";          
                          for ($i=0; $i < count($daftarKemungkinanPenyakit); $i++) {   
                           
                            $persen = 100;
                            $mdbaru = $daftarKemungkinanPenyakit[$i]['md'];
                            $mdbaru = (float)($mdbaru);
                              if (count($listIdKemungkinan) == 1) {
                            
                                
                                echo "Jumlah Gejala = ".
                                  count($listIdKemungkinan[$namaPenyakit])."<br/>";                     
                                // bila list kemungkinan terdapat 1
                                $mb = $daftarKemungkinanPenyakit[$i]['mb'];
                                $md = $daftarKemungkinanPenyakit[$i]['md'];
                                $cf = $mb * $md;
                                $cf1 =$cf*$persen;
                                $daftar_cf[$namaPenyakit][] = $cf;
                                echo "<br/>proses 1<br/>-------------------------------------------<br/>";
                                echo "cfR = ".$mb."<br/>";
                                echo "cfEvid = ".$md."<br/>";
                                echo "cf = cfR * cfEvid = ".$mb." * ".$md." = ".$cf1."%"."<br/><br/><br/>";
                                // end bila list kemungkinan terdapat 1
                                
                              } else {
                                // list kemungkinanan lebih dari satu                               
                                if ($x == 0)
                                {
                                //  if($x==4){
                                //    $x=$x-1;
                                //  }                           
                                  
                                  // record md dan mb sebelumnya
                                  // md yang di esekusi
                                  $mb = $daftarKemungkinanPenyakit[$i]['mb'];
                                  $md = $daftarKemungkinanPenyakit[$i]['md'];
                                  echo "<br/>";
                                  echo "cfR = ".$mb ."<br/>";
                                  echo "cfEvid = ".$md."<br/>";
                                  $cf = $mb * $md;
                                  $cf1=$cf*$persen;
                                  $cflama= $cf;
                                  $cfkombin=$cflama;
                                  echo "cf = cfR * cfEvid = ".$mb." * ".$md." = ".$cf."<br/>";
                                  echo "cf = cf * 100% = ".$cf." * ".$persen." = ".$cf1."%"."<br/><br/><br/>";      
                                  array_push($kombin, $cflama);    
                                  $daftar_cf[$namaPenyakit][] = $cf;                              
                                }                       
                                else {
                                if($mdbaru>0 && $kombin>0)
                                {            
                              //     echo  var_dump($mdbaru); 
                              // echo "<br/>";           
                              // echo  var_dump(current($kombin));
                              // echo "<br/>";                       
                                  $mdbaru = $daftarKemungkinanPenyakit[$i]['md'];    
                                  $mb = $daftarKemungkinanPenyakit[$i]['mb'];
                                  $cfbaru = $mdbaru * $mb; 
                                  $cflama=0;
                                  echo "<br/>";
                                  echo "cfR = ".$mb ."<br/>";
                                  echo "cfEvid = ".$mdbaru."<br/>";
                                  echo "cf = cfR * cfEvid = ".$mb." * ".$mdbaru." = ".$cfbaru."<br/><br/><br/>";
                                  for ($z=0; $z < count($kombin); $z++) {                            
                                       $cflama = $kombin[$z] + ($cfbaru*(1-$kombin[$z]));    
                                  }array_push($kombin, $cflama);
                                    echo "CFbaru = ".$cfbaru."<br/>";
                                     echo " CFlama = ".$kombin[$z-1]."<br/>";               
                                      echo "proses CF = cflama + cfbaru * (1 - cflama) = ".$kombin[$z-1]." + $cfbaru * (1 - ".$kombin[$z-1].") = ".$cflama."<br/>";
                                      $cf = $cflama * $persen;
                                      echo "cf = CFlama - 100% = ".$cflama." * ".$persen."%". " = ".$cf."%"."<br/><br/><br/>";                                               
                                  $daftar_cf[$namaPenyakit][] = $cf;            
                                
                            } else if($mdbaru<-0 && $kombin<-0)
                            {           
                              // echo  var_dump($mdbaru); 
                              // echo "<br/>";           
                              // echo  var_dump($kombin);
                              // echo "<br/>";                                              
                              $mdbaru = $daftarKemungkinanPenyakit[$i]['md'];    
                              $mb = $daftarKemungkinanPenyakit[$i]['mb'];
                              $cfbaru = $mdbaru * $mb; 
                              $cflama=0;
                              echo "<br/>";
                              echo "cfR = ".$mb ."<br/>";
                              echo "cfEvid = ".$mdbaru."<br/>";
                              echo "cf = cfR * cfEvid = ".$mb." * ".$cfbaru." = ".$cfbaru."<br/><br/><br/>";
                              for ($z=0; $z < count($kombin); $z++) {                            
                                   $cflama = $kombin[$z] +($mdbaru*(1+$kombin[$z]));    
                              }array_push($kombin, $cflama);
                              echo "CFbaru = ".$cfbaru."<br/>";
                              echo " CFlama = ".$kombin[$z-1]."<br/>";                
                                  echo "proses CF = cflama + (cfbaru * (1 + cflama)) = ".$kombin[$z-1]." + ($cfbaru * (1 + ".$kombin[$z-1].")) = ".$cflama."<br/>";
                                  $cf = $cflama * $persen;
                                  echo "cf = CFlama - 100% = ".$cflama." * ".$persen."%". " = ".$cf."%"."<br/><br/><br/>";                                               
                              $daftar_cf[$namaPenyakit][] = $cf;  

                            }  else if($mdbaru<-0 || $kombin<-0)
                            {                                                               
                              $mdbaru = $daftarKemungkinanPenyakit[$i]['md'];    
                              $mb = $daftarKemungkinanPenyakit[$i]['mb'];
                              $cfbaru = $mdbaru * $mb; 
                              $cflama=0;
                              echo "<br/>";
                              echo "cfR = ".$mb ."<br/>";
                              echo "cfEvid = ".$mdbaru."<br/>";
                              echo "cf = cfR * cfEvid = ".$mb." * ".$mdbaru." = ".$cfbaru."<br/><br/><br/>";
                              for ($z=0; $z < count($kombin); $z++) {                            
                                $cflama = ($kombin[$z] +$mdbaru)/(1-min($kombin[$z],$cfbaru));       
                              }array_push($kombin, $cflama);
                              echo "CFbaru = ".$cfbaru."<br/>";
                              echo " CFlama = ".$kombin[$z-1]."<br/>";               
                                  echo "proses CF = {CF1 + CF2} / (1-min{| CF1|,| CF2|})  = (".$kombin[$z-1]."+".$cfbaru.")/(1-min{|".$kombin[$z-1]."|,|".$cfbaru."|}) = ".$cflama."<br/>";
                                  $cf = $cflama * $persen;
                                  echo "cf = CFlama - 100% = ".$cflama." * ".$persen."%". " = ".$cf."%"."<br/><br/><br/>";                                               
                              $daftar_cf[$namaPenyakit][] = $cf;  
                          }
                           // end list kemungkinanan lebih dari satu
                        }
                      }
                            }
                            
                        }
                      }
                    }
                ?>
                
              </div>
            </div>
          </div>
          
          <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <div class="row">
              <div class="col-md-12" style="text-align: center;">
                <?php           
                  $crud->hasilCFTertinggi($daftar_cf,$groupKemungkinanPenyakit);
                   $crud->hasilAkhir($daftar_cf,$groupKemungkinanPenyakit,$nama);
                  //  $historytinggicf=$crud->hasilCFTertinggi($daftar_cf,$groupKemungkinanPenyakit);
                  //  $historyhasilakhir= $crud->hasilAkhir($daftar_cf,$groupKemungkinanPenyakit);               
                  }

                 ?>
                 
                  
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="nav-solusi" role="tabpanel" aria-labelledby="nav-solusi-tab">
            <div class="row">
              <div class="col-md-12">
              <div class="container">
            <h2 class="my-4">DIABETES TIPE 1</h2>
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading1-diabetes">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1-diabetes" aria-expanded="true" aria-controls="collapse1-diabetes">1. Melakukan Diet</button>
                    </h2>
                    <div id="collapse1-diabetes" class="accordion-collapse collapse show" aria-labelledby="heading1-diabetes" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p>
                            Melakukan diet dengan takaran yang sudah dianjurkan akan menjaga kadar gizi
                            </p>
                            <p>Makanan untuk penderita diabetes yang dianjurkan adalah makanan dengan komposisi seimbang dalam hal karbohidrat, protein, dan lemak, sesuai dengan kecukupan gizi baik, yakni sebagai berikut:</p>
                            <ul>
                                <li>Karbohidrat: 60-70 persen dari asupan kalori harian</li>
                                <li>Protein: 10-15 persen dari asupan kalori harian</li>
                                <li>Lemak: 20-25 persen dari asupan kalori harian</li>
                            </ul>
                            <p>Jumlah kalori disesuaikan dengan pertumbuhan, status gizi, umur, stress akut, dan kegiatan fisik, yang pada dasarnya ditujuan untuk mencapai dan mempertahankan berat ideal.</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading2-diabetes">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2-diabetes" aria-expanded="false" aria-controls="collapse2-diabetes">
                            2. Perhatikan jenis bahan makanan
                        </button>
                    </h2>
                    <div id="collapse2-diabetes" class="accordion-collapse collapse" aria-labelledby="heading2-diabetes" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p>
                                Selain melakukan diet, pilihan jenis bahan makanan juga sebaiknya diperhatikan. Masukan kolesterol tetap diperlukan, tapi jangan sampai melebihi 300 mg per hari. Sementara, sumber lemak diupayakan yang berasal
                                dari bahan nabati, yang mengandung lebih banyak asam lemak tak jenuh dibandingkan asam lemak jenuh. Sebagai sumber protein sebaiknya diperoleh dari ikan, ayam (terutama daging dada), tahu dan tempe, karena
                                tidak banyak mengandung lemak.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading3-diabetes">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3-diabetes" aria-expanded="false" aria-controls="collapse3-diabetes">
                            3. Terapi insulin
                        </button>
                    </h2>
                    <div id="collapse3-diabetes" class="accordion-collapse collapse" aria-labelledby="heading3-diabetes" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p>
                            Diabetes tipe 1 terjadi karena tubuh kekurangan atau bahkan tidak bisa sama sekali menghasilkan insulin. Itu sebabnya, pasien diabetes ini akan sangat tergantung dengan suntik insulin.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading4-diabetes">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4-diabetes" aria-expanded="false" aria-controls="collapse4-diabetes">
                            4. Monitor kadar gula darah secara rutin
                        </button>
                    </h2>
                    <div id="collapse4-diabetes" class="accordion-collapse collapse" aria-labelledby="heading4-diabetes" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p>
                                Mengukur dan memantau kadar glukosa darah dapat membantu penderita diabetes mengendalikan penyakitnya. Misalnya, melacak membantu mereka menentukan apakah perlu melakukan penyesuaian dalam makanan atau
                                obat-obatan. Ini juga akan membantu para penderita diabetes mengetahui bagaimana tubuh bereaksi terhadap makanan tertentu. Coba ukur level Anda setiap hari, dan catat nomornya dalam buku catatan.
                            </p>
                            <p>Pemeriksaan gula darah memiliki beberapa manfaat bagi penderita diabetes, seperti :</p>
                            <ul>
                                <li>Untuk mengevaluasi pencapaian tujuan pengobatan secara keseluruhan.</li>
                                <li>Mengetahui pengaruh perubahan pola makan dan olahraga terhadap kadar gula darah.</li>
                                <li>Untuk mengetahui faktor lain yang kemungkinan dapat meningkatkan kadar gula darah.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading5-diabetes">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5-diabetes" aria-expanded="false" aria-controls="collapse5-diabetes">5. Rajin Olahraga</button>
                    </h2>
                    <div id="collapse5-diabetes" class="accordion-collapse collapse" aria-labelledby="heading5-diabetes" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p>
                                manfaat penting olahraga untuk penderita diabetes juga dapat membantu meningkatkan sensitivitas insulin dan menjaga gula darah tetap terkendali. Saat berolahraga tubuh membutuhkan energi ekstra yang
                                menyebabkan otot menyerap glukosa sehingga membantu menurunkan kadar gula darah.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading6-diabetes">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6-diabetes" aria-expanded="false" aria-controls="collapse6-diabetes">6. Banyak Minum Air</button>
                    </h2>
                    <div id="collapse6-diabetes" class="accordion-collapse collapse" aria-labelledby="heading6-diabetes" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p>
                                Minum air secara teratur membantu rehidrasi darah, menurunkan kadar gula darah, dan bisa mengurangi risiko diabetes. Ingatlah, air dan minuman non-kalori lainnya adalah yang terbaik. Minuman yang dimaniskan
                                dengan gula meningkatkan glukosa darah, mendorong penambahan berat badan, dan meningkatkan risiko diabetes.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading7-diabetes">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse7-diabetes" aria-expanded="false" aria-controls="collapse7-diabetes">7. Cukup tidur</button>
                    </h2>
                    <div id="collapse7-diabetes" class="accordion-collapse collapse" aria-labelledby="heading7-diabetes" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p>
                                Tidur yang cukup terasa luar biasa dan diperlukan untuk kesehatan yang baik. Kebiasaan tidur yang buruk dan kurang istirahat juga memengaruhi kadar gula darah dan sensitivitas insulin. Kondisi tersebut dapat
                                meningkatkan nafsu makan dan meningkatkan berat badan. Kurang tidur mengurangi pelepasan hormon pertumbuhan dan meningkatkan kadar kortisol. Kedua hal ini memainkan peran penting dalam kontrol gula darah.
                                Selain itu, tidur yang baik adalah soal kuantitas dan kualitas. Yang terbaik adalah mendapatkan jumlah tidur berkualitas tinggi yang cukup setiap malam.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-5">
            <h2 class="my-4">DIABETES TIPE 2</h2>
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading1-nondiabet">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1-nondiabet" aria-expanded="true" aria-controls="collapse1-nondiabet">1. Jaga berat badan tetap ideal</button>
                    </h2>
                    <div id="collapse1-nondiabet" class="accordion-collapse collapse show" aria-labelledby="heading1-nondiabet" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p>
                            Memiliki berat badan berlebih (obesitas) membuat Anda berisiko tinggi mengalami diabetes tipe 2. Obesitas mengganggu kerja metabolisme yang membuat sel-sel tubuh tidak dapat merespons insulin dengan baik. Akibatnya, tubuh menjadi kurang atau tidak sensitif terhadap insulin sehingga menyebabkan resisten insulin.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading2-nondiabet">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2-nondiabet" aria-expanded="false" aria-controls="collapse2-nondiabet">2. Perhatikan pola makan</button>
                    </h2>
                    <div id="collapse2-nondiabet" class="accordion-collapse collapse" aria-labelledby="heading2-nondiabet" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p>
                            Apa yang Anda makan berpengaruh pada kondisi kesehatan secara menyeluruh, termasuk diabetes tipe 2. Berikut ini makanan yang dianjurkan untuk mengurangi risiko diabetes:
                            </p>
                            <ul>
                                <li>Konsumsi buah dan sayuran.</li>
                                <li>Ganti lemak jenuh dengan lemak sehat (seperti alpukat, minyak sayur, kacang-kacangan, tahu).</li>
                                <li>Batasi minuman manis dan perbanyak minum air putih (minimal delapan gelas sehari).</li>
                                <li>Batasi konsumsi daging merah dan daging olahan.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading3-nondiabet">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3-nondiabet" aria-expanded="false" aria-controls="collapse3-nondiabet">3. Aktif bergerak</button>
                    </h2>
                    <div id="collapse3-nondiabet" class="accordion-collapse collapse" aria-labelledby="heading3-nondiabet" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p>
                            Kurang aktivitas fisik meningkatkan risiko diabetes tipe 2 sehingga Anda disarankan untuk aktif bergerak, salah satunya dengan olahraga rutin 30 menit per hari, atau total 150 menit seminggu. Dengan aktif bergerak, otot-otot tubuh menjadi lebih mampu menggunakan insulin dan menyerap glukosa dengan baik.
Pilih olahraga yang Anda sukai agar nyaman melakukannya (seperti jalan kaki, lari, berenang, bersepeda) dan lakukan secara bertahap. Jangan langsung berolahraga dengan intensitas berat dan lama karena tubuh Anda perlu beradaptasi, apalagi jika tidak terbiasa melakukannya.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading4-nondiabet">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4-nondiabet" aria-expanded="false" aria-controls="collapse4-nondiabet">4. Tidak merokok dan batasi konsumsi alkohol</button>
                    </h2>
                    <div id="collapse4-nondiabet" class="accordion-collapse collapse" aria-labelledby="heading4-nondiabet" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p>
                            Jika Anda perokok aktif, tidak ada cara yang lebih efektif untuk mencegah diabetes selain berhenti merokok. Lakukan secara perlahan dan minta bantuan dari orang sekitar saat Anda sedang dalam proses berhenti merokok. Bila perlu, Anda bisa datang ke psikolog untuk membantu janji terapi berhenti merokok langsung dengan ahlinya.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading5-nondiabet">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5-nondiabet" aria-expanded="false" aria-controls="collapse5-nondiabet">5. Konsultasi ke dokter</button>
                    </h2>
                    <div id="collapse5-nondiabet" class="accordion-collapse collapse" aria-labelledby="heading5-nondiabet" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p>
                                Konsultasi memungkinkan tim dokter untuk memantau perkembangan kondisi anda, mengendalikan penyakit, dan mencegah masalah kesehatan ke depannya, meningkatkan kualitas hidup dan kemampuan bergerak, serta
                                memperpanjang usia pasien.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <h2 class="my-4">DIABETES GESTASIONAL</h2>
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading1-gestasional">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1-gestasional" aria-expanded="true" aria-controls="collapse1-gestasional">1. Insulin</button>
                    </h2>
                    <div id="collapse1-gestasional" class="accordion-collapse collapse show" aria-labelledby="heading1-gestasional" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p>
                            Jika tubuh tidak merespon insulin, Anda mungkin perlu suntikan insulin sebagai cara mengobati diabetes gestasional untuk menurunkan kadar glukosa pada darah.
                            </p>
                            <p>Berikut ini resep yang mungkin akan diberikan dokter sebagai cara mengobati diabetes gestasional:</p>
                            <ul>
                                <li>Analog insulin yang bekerja cepat, biasanya disuntikkan sebelum atau sesudah makan. Dapat bekerja dengan cepat, tetapi tidak berlangsung lama.</li>
                                <li>Insulin basal, biasanya disuntikkan pada waktu tidur atau bangun tidur.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading2-gestasional">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2-gestasional" aria-expanded="false" aria-controls="collapse2-gestasional">2. Obat minum hipoglikemik</button>
                    </h2>
                    <div id="collapse2-gestasional" class="accordion-collapse collapse" aria-labelledby="heading2-gestasional" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p>
                            Cara mengobati diabetes gestasional berikutnya adalah penggunaan obat minum.
                            </p>
                            <p>Ini adalah obat yang diminum untuk menurunkan kadar gula dalam darah Anda. Pemilihan obat metformin ini biasanya dilakukan bila gula darah dapat terkontrol.</p>
                            <p>Meski minum obat ini termasuk cara mengobati diabetes gestasional, metformin bisa menyebabkan efek samping, seperti:</p>
                            <ul>
                                <li>Mual (perut sakit).</li>
                                <li>Muntah.</li>
                                <li>Kram perut dan diare (buang air besar encer).</li>
                            </ul>
                            <p>Obat apa pun yang Anda konsumsi semuanya harus berdasar resep dokter.</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading3-gestasional">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3-gestasional" aria-expanded="false" aria-controls="collapse3-gestasional">3. Rutin cek gula darah</button>
                    </h2>
                    <div id="collapse3-gestasional" class="accordion-collapse collapse" aria-labelledby="heading3-gestasional" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p>
                            Pemeriksaan gula pertama kali disarankan pada pagi saat bangun tidur dan setelah sarapan. Hal ini dilakukan untuk memastikan gula darah berada dalam batas yang normal.
                            </p>
                            <p>Selain di rumah sakit atau laboratorium, Anda juga bisa melakukan pemeriksaan gula darah sendiri di rumah.</p>
                            <p>Jangan ragu untuk bertanya langsung ke dokter atau tenaga medis lainnya jika Anda kebingungan untuk menggunakan alat cek gula darah.</p>
                        </div>
                    </div>
                </div>
      </div>
    </div>
    <div class="container mt-5">
            <h2 class="my-4">DIABETES TIPE KHUSUS</h2>
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading1-khusus">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1-khusus" aria-expanded="true" aria-controls="collapse1-khusus">1. Pilih olahraga yang tepat</button>
                    </h2>
                    <div id="collapse1-khusus" class="accordion-collapse collapse show" aria-labelledby="heading1-khusus" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p>
                                Olah raga secara teratur dapat menurunkan dan menjaga kadar gula darah tetap normal. Saat ini ada dokter olah raga yang dapat dimintakan nasihat untuk mengatur jenis dan porsi olah raga yang sesuai untuk
                                penderita diabetes. Prinsipnya, tidak perlu olah raga berat, olah raga ringan asal dilakukan secara teratur akan sangat bagus pengaruhnya bagi kesehatan. Baca juga: Bagaimana Olahraga yang Tepat untuk
                                Tingkatkan Daya Tahan Tubuh? Olahraga yang disarankan adalah yang bersifat CRIPE (Continuous, Rhytmical, Interval, Progressive, Endurance Training). Sedapat mungkin mencapai zona sasaran 75-85 persen denyut
                                nadi maksimal (220-umur), disesuaikan dengan kemampuan dan kondisi penderita. Beberapa contoh olahraga yang disarankan, antara lain jalan atau lari pagi, bersepeda, berenang, dan lain sebagainya. Olahraga
                                aerobik ini paling tidak dilakukan selama total 30-40 menit per hari didahului dengan pemanasan 5-10 menit dan diakhiri pendinginan antara 5-10 menit. Olahraga akan memperbanyak jumlah dan meningkatkan
                                aktivitas reseptor insulin dalam tubuh dan juga meningkatkan penggunaan glukosa.
                            </p>
                        </div>
                    </div>
                </div>
  </div>

  <script>
        function printHasil() {
            const clickButton = document.getElementById("buttonClick");
            clickButton.classList.add("d-none");
            window.print();
        }
    </script>

  

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>
