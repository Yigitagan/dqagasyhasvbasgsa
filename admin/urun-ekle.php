<?php include 'head.php'; 
	  include 'sidebar.php';

if (isset($_POST['uekle'])) {

  $kaydet=$db->prepare("INSERT INTO urunler SET urun_isim=:urun_isim, urun_resimurl=:urun_resimurl, urun_fiyat=:urun_fiyat, urun_komut=:urun_komut");

  $insert=$kaydet->execute(array('urun_isim' => $_POST['urun_isim'], 'urun_resimurl' => $_POST['urun_resimurl'], 'urun_fiyat' => $_POST['urun_fiyat'], 'urun_komut' => $_POST['urun_komut']));


  if ($insert) {
      echo "<script>alert('Ürün eklendi')</script>";
      header("refresh: 0; url=urunler.php");

  } else {
      echo "<script>alert('Ürün eklenemedi')</script>";
      header("refresh: 0; url=urunler.php");
  }

}
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <section class="content">
    	<br>
      <div class="row">

        <section class="col-md-12">
        <div class="col-lg-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Ürün Ekle</h3>
            </div>

            <div class="box-body">
              <center>
              <form method="POST">
                <div class="form-group">
                  <label>Ürün adı</label>
                  <input type="text" style="width: 200px" name="urun_isim" class="form-control" placeholder="Ürün adı giriniz" required="required">
                </div>

                <div class="form-group">
                  <label>Fiyat</label>
                  <input type="number" min="0" max="250" value="0" style="width: 200px" name="urun_fiyat" class="form-control" placeholder="Şifre giriniz" required="required">
                </div>

                <div class="form-group">
                  <label>Komut</label>
                  <input type="text" style="width: 200px" name="urun_komut" placeholder="Komut giriniz" class="form-control" required="required">
                </div>

                <div class="form-group">
                  <label>Resim Url</label>
                  <input type="text" style="width: 200px" name="urun_resimurl" class="form-control" placeholder="Ürün resim url giriniz">
                </div>

                <button type="submit" name="uekle" class="btn btn-primary">Kaydet</button>
              </form>
              </center>
            </div>

          </div>

        </div>

        </section>
      </div>

    </section>
  </div>
  <?php include 'footer.php'; ?>