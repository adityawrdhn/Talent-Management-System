<?php
    $candidate['active'] = 'competency'; // Current Menu Item
    $candidate['ddactive'] = ''; // Current Menu Item
    include("assets/pages/bg_top.php");
    // include("assets/pages/bg_topindex.php");
    include("assets/pages/bg_menuadmin.php");
?>
	<div class="content-wrapper">
  	    <section class="content-header">
	      <h1>
	        Competency :
	        <small>360 Degrees Feedback</small>
	      </h1>
	      <ol class="breadcrumb">
	        <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
          <li><a href="#"> Competency</a></li>
          <li><a href="#"> Isi Kuesioner</a></li>
	      </ol>
	    </section>
   		<section class="content">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 connectedSortable">
                <?php echo $this->session->flashdata('sukses'); ?>
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#penilai1" data-toggle="tab">MENILAI ATASAN</a></li>
                            <li><a href="#penilai2" data-toggle="tab">MENILAI PEER</a></li>
                            <li><a href="#penilai3" data-toggle="tab">MENILAI BAWAHAN</a></li>
                            <li><a href="#penilai4" data-toggle="tab">MENILAI DIRI SENDIRI</a></li>
                        </ul>
                        <div class="tab-content no-padding">
                          <div class="chart tab-pane active" id="penilai1" style="position: relative; ">
                            <div class="box-body table-responsive">
                              <?php foreach ($penilai1->result() as $row1) {
                                $cek['PERNR']=$row1->pernr;
                                $cek['ID_PENILAI']= $this->session->userdata('pernr');
                                $cekstatus=$this->web_app_model->getSelectedDataMultiple('metode360_penilaian',$cek);
                                if ($cekstatus->num_rows() == 0) {
                                ?>

                              <div class="box box-default collapsed-box box-solid">
                                <div class="box-header with-border">
                                  <h3 class="box-title"><?php echo "$row1->pernr";?> - <?php echo "$row1->name";?></h3>

                                  <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                    </button>
                                  </div>
                                  <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                  <form action="Add_Data_Test" method="post" id="form" class="form-horizontal">
                                  <input type="hidden" name="pernr" value="<?php echo "$row1->pernr";?>">
                                  <input type="hidden" name="atasan" value="<?php echo "$row1->atasan";?>">
                                  <table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" scrollX="true">
                                    <thead >
                                        <tr>
                                            <th>SOAL</th>
                                            <th>JAWABAN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php 
                                      $no=1;
                                      // foreach ($soal->result() as $row) { }

                                      foreach ($soal->result() as $row) { ?>
                                      
                                        <tr>
                                            <td><?php echo "$row->SOAL";?></td>
                                            <td><input type="hidden" name="variabel<?php echo $row->ID_KUIS;?>" value="<?php echo "$row->VARIABEL"; ?>">
                                                <input type="radio" class="flat-blue" name="opsino<?php echo $row->ID_KUIS;?>" value="<?php echo "$row->NILAI_A"; ?>" id="A<?php echo $no;?>"/required>
                                                    <label for="A<?php echo $no;?>"> <?php echo "$row->JAWABAN_A"; ?></label>
                                                <input type="radio" class="flat-blue" name="opsino<?php echo $row->ID_KUIS;?>" value="<?php echo "$row->NILAI_B"; ?>" id="B<?php echo $no;?>"/required>
                                                    <label for="B<?php echo $no;?>"> <?php echo "$row->JAWABAN_B"; ?></label>
                                                <input type="radio" class="flat-blue" name="opsino<?php echo $row->ID_KUIS;?>" value="<?php echo "$row->NILAI_C"; ?>" id="C<?php echo $no;?>"/required>
                                                    <label for="C<?php echo $no;?>"> <?php echo "$row->JAWABAN_C"; ?></label>
                                                <input type="radio" class="flat-blue" name="opsino<?php echo $row->ID_KUIS;?>" value="<?php echo "$row->NILAI_D"; ?>" id="D<?php echo $no;?>"/required>
                                                    <label for="D<?php echo $no;?>"> <?php echo "$row->JAWABAN_D"; ?></label>
                                                <input type="radio" class="flat-blue" name="opsino<?php echo $row->ID_KUIS;?>" value="<?php echo "$row->NILAI_E"; ?>" id="E<?php echo $no;?>"/required>
                                                    <label for="E<?php echo $no;?>"> <?php echo "$row->JAWABAN_E"; ?></label>
                                            </td>
                                        </tr>
                                      <?php $no++; } ?>
                                    </tbody>
                                  </table>
                                  <input type="submit" class="btn btn-default"value="submit jawaban"/>
                                  <input type="hidden" name="stts" value="bawahan">
                                  
                                  </form>
                                </div>
                                <!-- /.box-body -->
                              </div>
                              <?php }
                                else {
                                    echo "";
                              }
                              } ?>
 
                                
                            </div>
                          </div>
                           <!--penilai 2  -->
                           <div class="chart tab-pane" id="penilai2" style="position: relative; ">
                            <div class="box-body table-responsive">
                              <?php foreach ($penilai2->result() as $row1) {
                              $cek['PERNR']=$row1->pernr;
                                $cek['ID_PENILAI']= $this->session->userdata('pernr');
                                // $cek['PERNR']= $this->session->userdata('pernr');
                                $cekstatus=$this->web_app_model->getSelectedDataMultiple('metode360_penilaian',$cek);
                                if ($cekstatus->num_rows() == 0) {
                                ?>
                              <div class="box box-default collapsed-box box-solid">
                                <div class="box-header with-border">
                                  <h3 class="box-title"><?php echo "$row1->pernr";?> - <?php echo "$row1->name";?></h3>

                                  <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                    </button>
                                  </div>
                                  <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                  <form action="Add_Data_Test" method="post" id="form" class="form-horizontal">
                                  <input type="hidden" name="pernr" value="<?php echo "$row1->pernr";?>">
                                  <input type="hidden" name="atasan" value="<?php echo "$row1->atasan";?>">
                                  <table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" scrollX="true">
                                    <thead >
                                        <tr>
                                            <th>SOAL</th>
                                            <th>JAWABAN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php 
                                      $no=1;
                                      // foreach ($soal->result() as $row) { }

                                      foreach ($soal->result() as $row) { ?>
                                      
                                        <tr>
                                            <td><?php echo "$row->SOAL";?></td>
                                            <td><input type="hidden" name="variabel<?php echo $row->ID_KUIS;?>" value="<?php echo "$row->VARIABEL"; ?>">
                                                <input type="radio" class="flat-blue" name="opsino<?php echo $row->ID_KUIS;?>" value="<?php echo "$row->NILAI_A"; ?>" id="A<?php echo $no;?>"/required>
                                                    <label for="A<?php echo $no;?>"> <?php echo "$row->JAWABAN_A"; ?></label>
                                                <input type="radio" class="flat-blue" name="opsino<?php echo $row->ID_KUIS;?>" value="<?php echo "$row->NILAI_B"; ?>" id="B<?php echo $no;?>"/required>
                                                    <label for="B<?php echo $no;?>"> <?php echo "$row->JAWABAN_B"; ?></label>
                                                <input type="radio" class="flat-blue" name="opsino<?php echo $row->ID_KUIS;?>" value="<?php echo "$row->NILAI_C"; ?>" id="C<?php echo $no;?>"/required>
                                                    <label for="C<?php echo $no;?>"> <?php echo "$row->JAWABAN_C"; ?></label>
                                                <input type="radio" class="flat-blue" name="opsino<?php echo $row->ID_KUIS;?>" value="<?php echo "$row->NILAI_D"; ?>" id="D<?php echo $no;?>"/required>
                                                    <label for="D<?php echo $no;?>"> <?php echo "$row->JAWABAN_D"; ?></label>
                                                <input type="radio" class="flat-blue" name="opsino<?php echo $row->ID_KUIS;?>" value="<?php echo "$row->NILAI_E"; ?>" id="E<?php echo $no;?>"/required>
                                                    <label for="E<?php echo $no;?>"> <?php echo "$row->JAWABAN_E"; ?></label>
                                            </td>
                                        </tr>
                                      <?php $no++; } ?>
                                    </tbody>
                                  </table>
                                  <input type="submit" class="btn btn-default"value="submit jawaban"/>
                                  <input type="hidden" name="stts" value="peer">
                                  
                                  </form>
                                </div>
                                <!-- /.box-body -->
                              </div>
                              <?php }
                                else {
                                    echo "";
                                }
                                }
                              ?>
 
                                
                            </div>
                          </div>
                          <!-- penilai3 -->
                          <div class="chart tab-pane" id="penilai3" style="position: relative; ">
                            <div class="box-body table-responsive">
                              <?php foreach ($penilai3->result() as $row1) {
                              $cek['PERNR']=$row1->pernr;
                                $cek['ID_PENILAI']= $this->session->userdata('pernr');
                                // $cek['PERNR']= $this->session->userdata('pernr');
                                $cekstatus=$this->web_app_model->getSelectedDataMultiple('metode360_penilaian',$cek);
                                if ($cekstatus->num_rows() == 0) {
                                ?>
                              <div class="box box-default collapsed-box box-solid">
                                <div class="box-header with-border">
                                  <h3 class="box-title"><?php echo "$row1->pernr";?> - <?php echo "$row1->name";?></h3>

                                  <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                    </button>
                                  </div>
                                  <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                  <form action="Add_Data_Test" method="post" id="form" class="form-horizontal">
                                  <input type="hidden" name="pernr" value="<?php echo "$row1->pernr";?>">
                                  <input type="hidden" name="atasan" value="<?php echo "$row1->atasan";?>">
                                  <table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" scrollX="true">
                                    <thead >
                                        <tr>
                                            <th>SOAL</th>
                                            <th>JAWABAN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php 
                                      $no=1;
                                      // foreach ($soal->result() as $row) { }

                                      foreach ($soal->result() as $row) { ?>
                                      
                                        <tr>
                                            <td><?php echo "$row->SOAL";?></td>
                                            <td><input type="hidden" name="variabel<?php echo $row->ID_KUIS;?>" value="<?php echo "$row->VARIABEL"; ?>">
                                                <input type="radio" class="flat-blue" name="opsino<?php echo $row->ID_KUIS;?>" value="<?php echo "$row->NILAI_A"; ?>" id="A<?php echo $no;?>"/required>
                                                    <label for="A<?php echo $no;?>"> <?php echo "$row->JAWABAN_A"; ?></label>
                                                <input type="radio" class="flat-blue" name="opsino<?php echo $row->ID_KUIS;?>" value="<?php echo "$row->NILAI_B"; ?>" id="B<?php echo $no;?>"/required>
                                                    <label for="B<?php echo $no;?>"> <?php echo "$row->JAWABAN_B"; ?></label>
                                                <input type="radio" class="flat-blue" name="opsino<?php echo $row->ID_KUIS;?>" value="<?php echo "$row->NILAI_C"; ?>" id="C<?php echo $no;?>"/required>
                                                    <label for="C<?php echo $no;?>"> <?php echo "$row->JAWABAN_C"; ?></label>
                                                <input type="radio" class="flat-blue" name="opsino<?php echo $row->ID_KUIS;?>" value="<?php echo "$row->NILAI_D"; ?>" id="D<?php echo $no;?>"/required>
                                                    <label for="D<?php echo $no;?>"> <?php echo "$row->JAWABAN_D"; ?></label>
                                                <input type="radio" class="flat-blue" name="opsino<?php echo $row->ID_KUIS;?>" value="<?php echo "$row->NILAI_E"; ?>" id="E<?php echo $no;?>"/required>
                                                    <label for="E<?php echo $no;?>"> <?php echo "$row->JAWABAN_E"; ?></label>
                                            </td>
                                        </tr>
                                      <?php $no++; } ?>
                                    </tbody>
                                  </table>
                                  <input type="submit" class="btn btn-default"value="submit jawaban"/>
                                  <input type="hidden" name="stts" value="atasan">
                                  
                                  </form>
                                </div>
                                <!-- /.box-body -->
                              </div>
                              <?php }
                                else {
                                    echo "";
                                }
                              
                              } ?>
 
                                
                            </div>
                          </div>
                          <!-- penilai4 -->
                          <div class="chart tab-pane" id="penilai4" style="position: relative; ">
                            <div class="box-body table-responsive">
                              <?php foreach ($penilai4->result() as $row1) {
                              $cek['PERNR']=$row1->pernr;
                                $cek['ID_PENILAI']= $this->session->userdata('pernr');
                                // $cek['PERNR']= $this->session->userdata('pernr');
                                $cekstatus=$this->web_app_model->getSelectedDataMultiple('metode360_penilaian',$cek);
                                if ($cekstatus->num_rows() == 0) {
                                ?>
                              <div class="box box-default collapsed-box box-solid">
                                <div class="box-header with-border">
                                  <h3 class="box-title"><?php echo "$row1->pernr";?> - <?php echo "$row1->name";?></h3>

                                  <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                    </button>
                                  </div>
                                  <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                  <form action="Add_Data_Test" method="post" id="form" class="form-horizontal">
                                  <input type="hidden" name="pernr" value="<?php echo "$row1->pernr";?>">
                                  <input type="hidden" name="atasan" value="<?php echo "$row1->atasan";?>">
                                  <table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" scrollX="true">
                                    <thead >
                                        <tr>
                                            <th>SOAL</th>
                                            <th>JAWABAN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php 
                                      $no=1;
                                      // foreach ($soal->result() as $row) { }

                                      foreach ($soal->result() as $row) { ?>
                                      
                                        <tr>
                                            <td><?php echo "$row->SOAL";?></td>
                                            <td><input type="hidden" name="variabel<?php echo $row->ID_KUIS;?>" value="<?php echo "$row->VARIABEL"; ?>">
                                                <input type="radio" class="flat-blue" name="opsino<?php echo $row->ID_KUIS;?>" value="<?php echo "$row->NILAI_A"; ?>" id="A<?php echo $no;?>"/required>
                                                    <label for="A<?php echo $no;?>"> <?php echo "$row->JAWABAN_A"; ?></label>
                                                <input type="radio" class="flat-blue" name="opsino<?php echo $row->ID_KUIS;?>" value="<?php echo "$row->NILAI_B"; ?>" id="B<?php echo $no;?>"/required>
                                                    <label for="B<?php echo $no;?>"> <?php echo "$row->JAWABAN_B"; ?></label>
                                                <input type="radio" class="flat-blue" name="opsino<?php echo $row->ID_KUIS;?>" value="<?php echo "$row->NILAI_C"; ?>" id="C<?php echo $no;?>"/required>
                                                    <label for="C<?php echo $no;?>"> <?php echo "$row->JAWABAN_C"; ?></label>
                                                <input type="radio" class="flat-blue" name="opsino<?php echo $row->ID_KUIS;?>" value="<?php echo "$row->NILAI_D"; ?>" id="D<?php echo $no;?>"/required>
                                                    <label for="D<?php echo $no;?>"> <?php echo "$row->JAWABAN_D"; ?></label>
                                                <input type="radio" class="flat-blue" name="opsino<?php echo $row->ID_KUIS;?>" value="<?php echo "$row->NILAI_E"; ?>" id="E<?php echo $no;?>"/required>
                                                    <label for="E<?php echo $no;?>"> <?php echo "$row->JAWABAN_E"; ?></label>
                                            </td>
                                        </tr>
                                      <?php $no++; } ?>
                                    </tbody>
                                  </table>
                                  <input type="submit" class="btn btn-default"value="submit jawaban"/>
                                  <input type="hidden" name="stts" value="dirisendiri">
                                  
                                  </form>
                                </div>
                                <!-- /.box-body -->
                              </div>
                              <?php } 
                                else {
                                    echo "";
                                }
                              }?>
 
                                
                            </div>
                          </div>
                    </div>
                </div>
            </div>
        </div>
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
  