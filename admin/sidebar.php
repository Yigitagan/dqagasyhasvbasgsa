  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Menü</li>
        <li <?php if($menuaktif == "index.php"){ ?>class="active"<?php } ?>>
          <a href="index.php">
            <i class="fa fa-home"></i> <span>Anasayfa</span>
          </a>
        </li>
        <li <?php if($menuaktif == "uyeler.php"){ ?>class="active"<?php } ?>>
          <a href="uyeler.php">
        	<i class="fa fa-users"></i> <span>Üyeler</span>
           </a>
        </li>
        <li <?php if($menuaktif == "urunler.php"){ ?>class="active"<?php } ?>>
          <a href="urunler.php">
            <i class="fa fa-shopping-basket"></i> <span>Ürünler</span>
          </a>
        </li>
        <li <?php if($menuaktif == "ayarlar.php"){ ?>class="active"<?php } ?>>
          <a href="ayarlar.php">
            <i class="fa fa-gears"></i> <span>Ayarlar</span>
          </a>
        </li>
      </ul>
    </section>
  </aside>