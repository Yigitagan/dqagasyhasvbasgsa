<?php include 'head.php'; 
	  include 'sidebar.php';

if (isset($_POST['kekle'])) {

  $pass=md5($_POST['password']);

  $kaydet=$db->prepare("INSERT INTO authme SET username=:username, password=:password, kredi=:kredi, yetki=:yetki");

  $insert=$kaydet->execute(array('username' => $_POST['username'], 'password' => $pass, 'kredi' => $_POST['kredi'], 'yetki' => $_POST['yetki']));


  if ($insert) {
      echo "<script>alert('Kullanıcının eklendi')</script>";
      header("refresh: 0; url=uyeler.php");

  } else {
      echo "<script>alert('Kullanıcının eklenemedi')</script>";
      header("refresh: 0; url=uyeler.php");
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
              <h3 class="box-title">Üye Ekle</h3>
            </div>

            <div class="box-body">
              <center>
              <form method="POST">
                <div class="form-group">
                  <label>Kullanıcı adı</label>
                  <input type="text" style="width: 200px" name="username" class="form-control" placeholder="Kullanıcı adı giriniz" required="required">
                </div>

                <div class="form-group">
                  <label>Şifre</label>
                  <input type="password" style="width: 200px" name="password" class="form-control" placeholder="Şifre giriniz" required="required">
                </div>

                <div class="form-group">
                  <label>Kredi</label>
                  <input type="number" style="width: 200px" value="0" min="0" max="500" name="kredi" class="form-control" required="required">
                </div>

                <div class="form-group">
                  <label>Yetki</label>
                  <select name="yetki" class="form-control" style="width: 200px">
                    <option value="0" selected>Üye</option>
                    <option value="1">Admin</option>
                  </select>
                </div>

                <button type="submit" name="kekle" class="btn btn-primary">Kaydet</button>
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