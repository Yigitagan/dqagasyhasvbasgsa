<?php include 'head.php'; 
	  include 'sidebar.php';

$kullanicisor=$db->prepare("SELECT * FROM authme where id=:id");
$kullanicisor->execute(array('id' => $_GET['id']));
$say=$kullanicisor->rowCount();
$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);


if (isset($_POST['kkaydet'])) {

  $id=$_POST['id'];
  if ($_POST['sifre'] == null) {

	  $kullanicikaydet=$db->prepare("UPDATE authme SET
	    username=:username,
	    kredi=:kredi,
	    yetki=:yetki
	    WHERE id=:id");

	  $update=$kullanicikaydet->execute(array(
	    'username' => $_POST['kadi'],
	    'kredi' => $_POST['kredi'],
	    'yetki' => $_POST['yetki'],
	    'id' => $id));


	  if ($update) {
	  	echo "<script>alert('Kullanıcının bilgileri değiştirildi')</script>";
	    header("refresh: 0; url=uyeler.php");

	  } else {
	  	echo "<script>alert('Kullanıcının bilgileri değiştirilemedi')</script>";
	    header("refresh: 0; url=uyeler.php");
	  }
  }
  else
  {
  		$pass=md5($_POST['sifre']);
  		$kullanicikaydet=$db->prepare("UPDATE authme SET
	    username=:username,
	    password=:password,
	    kredi=:kredi,
	    yetki=:yetki
	    WHERE id=:id");

	  $update=$kullanicikaydet->execute(array(
	    'username' => $_POST['kadi'],
	    'password' => $pass,
	    'kredi' => $_POST['kredi'],
	    'yetki' => $_POST['yetki'],
	    'id' => $id));


	  if ($update) {
	  	echo "<script>alert('Kullanıcının bilgileri değiştirildi')</script>";
	    header("refresh: 0; url=uyeler.php");

	  } else {
	  	echo "<script>alert('Kullanıcının bilgileri değiştirilemedi')</script>";
	    header("refresh: 0; url=uyeler.php");
	  }
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
              <h3 class="box-title">Üye Düzenle</h3>
            </div>

            <div class="box-body">
              <center>
              <form method="POST">
                <div class="form-group">
                  <label>Kullanıcı adı</label>
                  <input type="text" style="width: 200px" name="kadi" class="form-control" value="<?php echo $kullanicicek['username']; ?>" required="required">
                </div>

                <div class="form-group">
                  <label>Şifre</label>
                  <input type="password" style="width: 200px" name="sifre" class="form-control">
                </div>

                <div class="form-group">
                  <label>Kredi</label>
                  <input type="number" style="width: 200px" min="0" max="500" name="kredi" class="form-control" value="<?php echo $kullanicicek['kredi']; ?>" required="required">
                </div>

                <div class="form-group">
                  <label>Yetki</label>
                  <select name="yetki" class="form-control" style="width: 200px">
                    <option value="0" <?php if ($kullanicicek['yetki']=='0') { echo "selected"; } ?>>Üye</option>
                    <option value="1" <?php if ($kullanicicek['yetki']=='1') { echo "selected"; } ?>>Admin</option>
                  </select>
                      
                </div>
                <input type="hidden" name="id" value="<?php echo $kullanicicek['id'] ?>">
                <button type="submit" name="kkaydet" class="btn btn-primary">Kaydet</button>
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