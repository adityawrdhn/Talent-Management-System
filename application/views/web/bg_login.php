
  <body class="hold-transition login-page layout-top-nav">
  <div="wrapper-fixed ">
    <header class="main-header bg-black">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="../../index2.html" class="navbar-brand"> 
              <img src="assets/dist/img/kai.png" class="user-image" alt="User Image" width="40px">
          </a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div><!-- /.navbar-custom-menu -->
        
        <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="#" class="text-yellow">Kereta Api Indonesia</a></li>
              
            </ul>
            
          </div>
        

        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->
            <!-- User Account Menu -->
            <li class="active bg-orange"><a href="#" class="text-black">Login</a></li>
            
          </ul>
        </div>
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <div class="main-body">
  <div class="contain-wrapper">        
    <div class="login-box">
      <div class="login-box-body">
        <p class="login-box-msg text-yellow">Silahkan login untuk mengakses TMS.</p>
		
    <?php echo $this->session->flashdata('gaglog'); ?>
         <form action="<?php echo base_url();?>web/login" method="post">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="pernr" id="pernr" placeholder="Input Your Number ID...">
            <span class="fa fa-key form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" id="password" placeholder="Input Your Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> Remember Me
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn bg-orange btn-block btn-flat">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
<br>
<a href="#">Lupa Password</a>
<hr>
<!-- <hr> -->
       </div>

<!-- /.login-box-body -->
    </div><!-- /.login-box -->
    <!-- </section> -->
    </div>
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0.1
        </div>
        <strong>Copyright &copy; 2015-2016 <a href="http://www.instagram.com/adityawrdhn">TMS - Aditya Wardhana</a>.</strong> All rights reserved.
        </br>
        Halaman ini dimuat selama <strong>{elapsed_time}</strong> detik

     </footer>
</div>

<!-- </section> -->
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body></html>

