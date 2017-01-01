<?php
    $candidate['active'] = 'mbti'; // Current Menu Item
    $candidate['ddactive'] = ''; // Current Menu Item
    include("assets/pages/bg_top.php");
    // include("assets/pages/bg_topindex.php");
    include("assets/pages/bg_menuadmin.php");
?>
	<div class="content-wrapper">
  	    <section class="content-header">
	      <h1>
            Psichology Test:
            <small>Myers-Briggs Type Indicators</small>
          </h1>
	      <ol class="breadcrumb">
	        <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
	        <li><a href="#">Psichology Test</a></li>
            <li class="active">Test</li>
	      </ol>
	    </section>
   		<section class="content">
            <div class="row">
                <div class="col-md-12">
                    <?php echo $this->session->flashdata('sukses'); ?>
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs pull-right">
                            <li class="active"><a href="#table-data" data-toggle="tab"><i class="fa fa-table"></i>TEST</a></li>
                            <li class="pull-left header"><i class="fa fa-th-large"></i> Jawablah pertanyaan sesuai dengan kepribadian anda!</li>
                        </ul>
                    <!-- /.box-header -->
                        <div class="tab-content no-padding">
                        <div class="chart tab-pane active" id="table-data" style="position: relative; ">
                        <div class="box-body table-responsive">
                                            
                            <form action="Add_Data_Test" method="post" id="form" class="form-horizontal">
                            <input type="hidden" name="pernr" value="<?php $this->session->userdata('pernr');?>">
                                <table id="table" class="table table-striped">
                                
                                    <tr style="color:#2c3b41;background:#b8c7ce;">
                                        <th width="6%">No</th>
                                        <th width="40%" style="text-align:center;">Answer A</th>
                                        <th width="7%" style="text-align:center;">A</th>
                                        <th width="7%" style="text-align:center;">B</th>
                                        <th width="40%" style="text-align:center;">Answer B</th>
                                    </tr>
                               
                               
                                <?php 
                                    $no=1;
                                    foreach ($soal->result() as $row) {
                                ?> 
                                
                                    <tr>
                                        <td style="text-align:center;"><?php echo $no;?></td>
                                        <td style="text-align:center;"><label for="A<?php echo $no;?>"> <?php echo "$row->JAWABAN_A"; ?></label></td>
                                        <td style="text-align:center;"><input type="radio" class="flat-blue" name="opsino<?php echo $row->ID_SOAL;?>" value="<?php echo "$row->TIPE_A"; ?>" id="A<?php echo $no;?>"/required></td>
                                        <td style="text-align:center;"><input type="radio" class="flat-blue" name="opsino<?php echo $row->ID_SOAL;?>" value="<?php echo "$row->TIPE_B"; ?>" id="B<?php echo $no;?>"/required></td>
                                        <td style="text-align:center;"><label for="B<?php echo $no;?>"><?php echo "$row->JAWABAN_B"; ?></label></td>
                                        <input type="hidden" name="soalno<?php echo $no;?>" value="" />
                                    </tr>
                                <?php
                                    $no++;
                                    }
                                    ?>    
                                </table>
                            
                        <input type="submit" class="btn btn-primary"value="submit jawaban"/ onclick=selesai()>
                    </form>
                    </div></div>
                </div></div></div></div>
               </section></div>
    
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0.1
        </div>
        <strong>Copyright &copy; 2015-2016 <a href="http://www.instagram.com/adityawrdhn">TMS - Aditya Wardhana</a>.</strong> All rights reserved.
        </br>
        Halaman ini dimuat selama <strong>{elapsed_time}</strong> detik

     </footer>

        
	
	<!--footer -->

    
	<?php 
    include("assets/pages/bg_footer.php");
    ?>
    
    <!-- endfooter-->
 
</body>
</html>
  