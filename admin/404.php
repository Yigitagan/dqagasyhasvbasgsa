<?php include 'head.php'; 
	  include 'sidebar.php';?>

  <div class="content-wrapper">

    <section class="content">
      <div class="error-page">
        <h2 class="headline text-yellow"> 404</h2>

        <div class="error-content">
          <h3 style="margin-top: 200px"><i class="fa fa-warning text-yellow"></i> Oops! Aradığın sayfa bulunamadı</h3>

          <p>
            <?php header("refresh: 5; url=index.php") ?>
          </p>

        </div>
      </div>
    </section>
  </div>
  <?php include 'footer.php'; ?>