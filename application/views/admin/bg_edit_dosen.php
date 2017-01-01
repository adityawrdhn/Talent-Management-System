

<?php echo $menu;?>
<div class="content-wrapper">
<section class="content-header">

	<h1>Daftar Dosen Sistem Informasi Akademik</h1>

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
    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li><a href="#daftar" data-toggle="tab">Daftar Dosen</a></li>
          <li><a href="#tambah" data-toggle="tab">Tambah Dosen</a></li>

          <li class="active"><a href="#edit" data-toggle="tab">Edit Dosen</a></li>
          <!-- <li><a href="#settings" data-toggle="tab">Settings</a></li> -->
        </ul>
        <div class="tab-content">
          <div class="tab-pane" id="daftar">
      <!-- isi -->
      		
       	<div class="box-body">
        	<div class="row">
        	<table id="example2" class="table table-bordered table-hover">
        	<thead>
		<tr style="color:#b8c7ce;background:#2c3b41;">			                
				<td align="center">Kode Dosen</td>
				<td align="center">NIDN</td>
				<td align="center">Nama Dosen</td>	
				<td align="center" colspan="3" width="50">Kelola Dosen</td>
				</tr>
				</thead>
				<?php
					foreach($dosen->result_array() as $d)
					{
					?>
						<tr>
						<td align="center"><?php echo $d['kd_dosen']; ?></td>
						<td align="center"><?php echo $d['nidn']; ?></td>
						<td align="center"><?php echo $d['nama_dosen']; ?></td>	
						<?php 
						echo '<td align="center" width="10"><a href="'.base_url().'admin/dosen_mk/'.$d['kd_dosen'].'" class="link" style="float:left;">MK</a></td>
						<td align="center" width="10"><a href="'.base_url().'admin/edit_dosen/'.$d['kd_dosen'].'" rel="example_group" class="link" 
						style="float:left;">Edit</a>
						</td>
						<td align="center" width="10">
						<a href="'.base_url().'admin/hapus_dosen/'.$d['kd_dosen'].'"
						onClick=\'return confirm("anda yakin ingin menghapus ini?")\' class="link" style="float:left;">Hapus</a>
						</td>';
						?>
						</tr>
					<?php
					}
				?>
				
				</table>
			</div>
			</div>
			</div>
            <div class="tab-pane" id="tambah">
			<?php echo $this->session->flashdata('save_dosen'); ?> 
                <!-- /.box-header -->
                <!-- form start -->
				<form method="post" action="<?php echo base_url(); ?>admin/simpan_dosen">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="kd">Kode Dosen</label>
                      <input type="text" class="form-control" name="kd_dosen" id="kd" placeholder="kode dosen">
                    </div>
                    <div class="form-group">
                      <label for="nidn">NIDN</label>
                      <input type="text" class="form-control" name="nidn" id="nidn" placeholder="NIDN">
                    </div>
                    <div class="form-group">
                      <label for="nd">Nama Dosen</label>
                      <input type="text" class="form-control" name="nama_dosen" id="nd" placeholder="Nama Dosen">
                    </div>
                    
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                  	<input type="submit" value="Simpan Data" class="btn btn-primary"/>
            		<input type="reset" value="Batal" class="btn btn-default">
					<input type="hidden" name="stts" value="tambah">
                   
                  </div>
                </form>
              <!-- /.box -->

</div>
          <div class="active tab-pane" id="edit">

			<form method="post" action="<?php echo base_url(); ?>admin/simpan_dosen">
			<?php
			foreach($edit_dosen->result_array() as $d)
			{
			?>
			<table>

			<tr>
			<td width="180">NIDN</td>
			<td width="50">:</td>
			<td><input type="text" name="nidn" size="50" class="input-read-only" value="<?php echo $d['nidn']; ?>" /></td>
			</tr>

			<tr>
			<td width="180">Nama Dosen</td>
			<td width="50">:</td>
			<td><input type="text" name="nama_dosen" size="50" class="input-read-only" value="<?php echo $d['nama_dosen']; ?>" /></td>
			</tr>

			<tr>
			<td width="180"></td>
			<td width="50"></td>
			<td>
			<input type="submit" value="Simpan Data" class="btn-kirim">
			<input type="reset" value="Batal" class="btn-kirim">
			<input type="hidden" name="kd_dosen" value="<?php echo $d['kd_dosen']; ?>">
			<input type="hidden" name="stts" value="edit"></td>
			</tr>

			</table>

			<?php } ?>

			</form>

			</div>
			</div></div></div></div></section>

	</div>