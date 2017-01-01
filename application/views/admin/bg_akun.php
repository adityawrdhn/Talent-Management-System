<?php echo $menu;?>
<div class="content-wrapper">
<section class="content-header">

	<h1>Pengaturan Akun Sistem Informasi Akademik</h1>

</section>
<section class="content">

<div class="box box-solid">
	<blockquote style="font-size:14px;">
		<?php
			echo $bio;
		?>
	</blockquote>	
</div>
<div class="row">
	
<div class="col-sm-6">
<?php echo $this->session->flashdata('save_akun'); ?>
				<div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Ganti Password</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
				<form method="post" action="<?php echo base_url(); ?>admin/simpan_akun">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="pl">Password Lama</label>
                      <input type="password" class="form-control" name="pass_lama" id="pl" placeholder="password lama">
                    </div>
                    <div class="form-group">
                      <label for="pb">Password Baru</label>
                      <input type="password" class="form-control" name="pass_baru" id="pb" placeholder="password baru">
                    </div>
                    <div class="form-group">
                      <label for="upb">Ulangi Password Baru</label>
                      <input type="password" class="form-control" name="ulangi_pass" id="upb" placeholder="ulangi password baru">
                    </div>
                    
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                  	<input type="submit" value="Simpan Data" class="btn btn-primary"/>
                   
                  </div>
                </form>
              </div><!-- /.box -->
		
	</div>
</div></section>
	</div>
