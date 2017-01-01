<script type="text/javascript"> 
    function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
    }

    function startTime() {
    // var strcount;
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('txt').innerHTML = h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
      if (h==16 && m==39 && s==00) {
        setTimeout("location:admin/refresh", 500)
      }
    }
  </script>

  <script src="<?php echo base_url('assets/js/highcharts.js'); ?>"></script>

  <script src="<?php echo base_url('assets/js/exporting.js'); ?>"></script>
</head>

<body class="hold-transition skin-black sidebar-mini" onload="startTime();">
  <div class="wrapper fixed">
    <header class="main-header">
        <!-- Logo -->
          <a href="<?php echo base_url(); ?>admin/" class="logo">
            <span class="logo-mini">
              <img src="<?php echo base_url();?>assets/dist/img/kai.png" class="user-image" alt="User Image" width="40px">
            </span>
            <span class="logo-lg">
              <img src="<?php echo base_url();?>assets/dist/img/kai.png" class="user-image" alt="User Image" width="50px"><b>KA</b>I
            </span>
          </a>
        

          <!-- Header Navbar: style can be found in header.less -->
          <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
              <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
              <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <!-- User Account: style can be found in dropdown.less -->
                
                <li>
                  <a href="#" data-toggle="control-sidebar"><i class="fa fa-clock-o"></i><?php echo "     ";?><span id="txt"></span></a>
                </li>
                <li class="dropdown user user-menu">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="<?php echo base_url(); ?>assets/dist/img/avatar5.png" class="user-image" alt="User Image">
                    <span class="hidden-xs"><?php echo $name; ?></span>
                  </a>
                  <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                      <img src="<?php echo base_url(); ?>assets/dist/img/avatar5.png" class="img-circle" alt="User Image">
                      <p>
                        <?php echo $name; ?>
                      </p>
                    </li>
                    <!-- Menu Body -->
                    <li class="user-body">
                      <div class="col-xs-4 text-center">
                        <a href="#"><?php echo $status; ?></a>
                      </div>
                      <div class="col-xs-4 text-center">
                        <a href="#">-</a>
                      </div>
                      <div class="col-xs-4 text-center">
                        <a href="#">@<?php echo $pernr; ?></a>
                      </div>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                      <div class="btn-block btn-group text-center">
                        <a href="<?php echo base_url(); ?>admin/akun" class="btn btn-default btn-flat">Pengaturan</a>
                        <a href="<?php echo base_url(); ?>admin/refresh" class="btn btn-default btn-flat">Refresh</a>
                        <a href="<?php echo base_url(); ?>web/logout" class="btn btn-default btn-flat">Keluar</a>
                      </div>
                      <!-- </div> -->
                    </li>
                  </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
              </ul>
            </div>
          </nav>
        </header>
        <aside class="main-sidebar">

        <section class="sidebar">

        <ul class="sidebar-menu">
                
        	<li class="header">Main Navigation</li>


        		<li class="treeview <?php if($candidate['active'] == 'Dashboard') echo 'active'; ?>" >
        			<a href="<?php echo base_url('admin'); ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="pull-right"></i></a>
        		</li>
        	<li class="header">Administration</li>

        		<li class="treeview <?php if($candidate['active'] == 'Master Data') echo 'active'; ?>" >
                	<a href="<?php echo base_url(); ?>MasterData">
                		<i class="fa fa-database"></i> 
                		<span>Master Data</span> 
                		<span class="pull-right-container">
                    		<i class="fa fa-angle-left pull-right"></i>
                    	</span>
                    </a>
                    <ul class="treeview-menu">
                    	<li class="<?php if($candidate['ddactive'] == 'Employee') echo 'active'; ?>">
                    		<a href="<?php echo base_url('MasterData/ViewEmployee'); ?>"><i class="fa fa-circle-o"></i>Employee</a></li>
                    	<li class="<?php if($candidate['ddactive'] == 'Employee Group') echo 'active'; ?>">
                    		<a href="<?php echo base_url(); ?>MasterData/ViewEmgroup"><i class="fa fa-circle-o"></i>Employee Group</a></li>
                    	<li class="<?php if($candidate['ddactive'] == 'Employee Sub Group') echo 'active'; ?>">
                    		<a href="<?php echo base_url(); ?>MasterData/ViewEmsubgroup"><i class="fa fa-circle-o"></i>Employee Sub Group</a></li>
                    	<li class="<?php if($candidate['ddactive'] == 'Personnel Area') echo 'active'; ?>">
                    		<a href="<?php echo base_url(); ?>MasterData/ViewEmpersa"><i class="fa fa-circle-o"></i>Personnel Area</a></li>
                    	<li class="<?php if($candidate['ddactive'] == 'Organization Unit') echo 'active'; ?>">
                    		<a href="<?php echo base_url(); ?>MasterData/ViewEmorgunit"><i class="fa fa-circle-o"></i>Organization Unit</a></li>
                    	<li class="<?php if($candidate['ddactive'] == 'Job') echo 'active'; ?>">
                    		<a href="<?php echo base_url(); ?>MasterData/ViewEmjob"><i class="fa fa-circle-o"></i>Job</a></li>
                    	<li class="<?php if($candidate['ddactive'] == 'Position') echo 'active'; ?>">
                    		<a href="<?php echo base_url(); ?>MasterData/ViewEmplans"><i class="fa fa-circle-o"></i>Position</a></li>
                    	<li class="<?php if($candidate['ddactive'] == 'Pangkat') echo 'active'; ?>">
                    		<a href="<?php echo base_url(); ?>MasterData/ViewEmpangkat"><i class="fa fa-circle-o"></i>Pangkat</a></li>
                  	</ul>
        		</li>
        		<li class="treeview <?php if($candidate['active'] == 'competency') echo 'active'; ?>" >
                	<a href="<?php echo base_url(); ?>metode360/"><i class="fa fa-align-left"></i> <span>Competency Appraisal</span> <i class="pull-right"></i></a></li>
        		</li>
        		<li class="treeview <?php if($candidate['active'] == 'performance') echo 'active'; ?>" >
                	<a href="<?php echo base_url(); ?>bsc/"><i class="fa fa-align-left"></i> <span>Performance Appraisal</span> <i class="pull-right"></i></a></li>
        		</li>
        		<li class="treeview <?php if($candidate['active'] == 'mbti') echo 'active'; ?>" >
                	<a href="<?php echo base_url(); ?>mbti/"><i class="fa fa-bell-o"></i> <span>MBTI</span> <i class="pull-right"></i></a></li>
        		</li>
        		<li class="treeview <?php if($candidate['active'] == 'event') echo 'active'; ?>" >
                	<a href="<?php echo base_url(); ?>admin/mahasiswa"><i class="fa fa-calendar"></i> <span>Event</span> <i class="pull-right"></i></a></li>
        		</li>
        		<li class="treeview <?php if($candidate['active'] == 'news') echo 'active'; ?>" >
                	<a href="<?php echo base_url(); ?>admin/info"><i class="fa fa-newspaper-o"></i> <span>News</span> <i class="pull-right"></i></a></li>
        		</li>
        		<li class="treeview <?php if($candidate['active'] == 'recruitment') echo 'active'; ?>" >
                	<a href="<?php echo base_url(); ?>admin/akun"><i class="fa fa-bookmark-o"></i> <span>Recruitment</span> <i class="pull-right"></i></a></li>
        		</li>
        		<li class="treeview <?php if($candidate['active'] == 'mail') echo 'active'; ?>" >
                	<a href="<?php echo base_url(); ?>web/logout"><i class="fa fa-envelope-o"></i> <span>Mail</span> <i class="pull-right"></i></a></li>
        		</li>
        		
        	<!-- <div class=""></div> -->
        </ul>
        </section>
        </aside>
