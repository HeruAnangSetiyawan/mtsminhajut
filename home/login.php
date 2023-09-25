<?php 
  include 'header_menu.php';


?>
    <!-- short -->
    <div class="using-border py-3">
      <div class="inner_breadcrumb  ml-4">
        <ul class="short_ls">
          <li>
            <a href="index.php">Home</a>
            <span>/</span>
          </li>
          <li>Login</li>
        </ul>
      </div>
    </div>
    <!-- //short-->
    <!-- service -->
    <section class="service py-lg-4 py-md-3 py-sm-3 py-3" id="service">
      <div class="container py-lg-5 py-md-4 py-sm-4 py-3">
        <h3 class="title text-center mb-lg-5 mb-md-4 mb-sm-4 mb-3">Login</h3>
        <form action="login_act.php" method="post">
          <div class="w3pvt-wls-contact-mid">
            <div class="form-group contact-forms">
              <input type="text" name="username" autofocus="" class="form-control" placeholder="Email" required="">
            </div>
            <div class="form-group contact-forms">
              <input type="password" name="password" class="form-control" placeholder="Password" required="">
            </div>
            <div class="form-group contact-forms">
              <select name="level" class="form-control">
                <option value="">--Pilih Hak Akses--</option>
                <option value="Wali Kelas">Wali Kelas</option>
                <option value="Siswa">Siswa / Orang Tua Siswa</option>
                <option value="Admin">Admin</option>
              </select>
            </div>
            <button type="submit" class="btn sent-butnn">Login</button>
          </div>
        </form>
      </div>
    </section>
    <!-- //service -->
<?php 
  include 'footer.php';
?>