<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="./dashboard.php" class="app-brand-link">
      <span class="app-brand-text demo menu-text fw-bolder ms-2 text-uppercase">Laticha</span>
    </a>
    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>
  <div class="menu-inner-shadow"></div>
  <ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item">
      <a href="dashboard.php" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Dashboard</div>
      </a>
    </li>
    <!-- Forms & Tables -->
    <li class="menu-item">
      <a href="peminjaman.php" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Peminjaman</div>
      </a>
    </li>
    <li class="menu-header small text-uppercase"><span class="menu-header-text">books</span></li>
    <!-- Forms -->

    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-detail"></i>
        <div data-i18n="books">Buku</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="tambah_buku.php" class="menu-link">
            <div data-i18n="Basic Inputs">Tambah Buku</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="buku.php" class="menu-link">
            <div data-i18n="Input groups">Daftar Buku</div>
          </a>
        </li>
      </ul>
    </li>

    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-detail"></i>
        <div data-i18n="books">Anggota</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="tambah_anggota.php" class="menu-link">
            <div data-i18n="Basic Inputs">Tambah Anggota</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="anggota.php" class="menu-link">
            <div data-i18n="Input groups">Daftar Anggota</div>
          </a>
        </li>
      </ul>
    </li>
  </ul>
</aside>
<!-- / Menu -->