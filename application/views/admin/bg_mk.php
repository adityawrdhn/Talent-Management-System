
<?php echo $menu;?>
<div class="content-wrapper">
<section class="content-header">

	<h1>Daftar Mata Kuliah Sistem Informasi Akademik</h1>

</section>
<section class="content">

<div class="box box-solid">
	<blockquote style="font-size:14px;">
		<?php
			echo $bio;
		?>
	</blockquote>	
</div><?php echo $this->session->flashdata('save_mk'); ?>
  <div class="row">
    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#daftar" data-toggle="tab">Daftar Mata Kuliah</a></li>
          <li><a href="#tambah" data-toggle="tab">Tambah Mata Kuliah</a></li>
          <!-- <li><a href="#settings" data-toggle="tab">Settings</a></li> -->
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="daftar">
            <div class="row">
        	  <div class="box-body">
        		<table id="example2" class="table table-bordered table-hover">
        		<thead>

		<tr style="color:#b8c7ce;background:#2c3b41;">			                
					<td align="center">Kode MK</td>
					<td align="center">Nama MK</td>
					<td align="center">Jumlah SKS</td>
					<td align="center">Semester</td>	
					<td align="center">Jurusan</td>	
					<td align="center" colspan="3" width="50">Kelola Mata Kuliah</td>
					</tr>
</thead>
					<?php
					foreach($mk->result_array() as $d)
					{
					?>
						<tr>
						<td align="center"><?php echo $d['kd_mk']; ?></td>
						<td align="center"><?php echo $d['nama_mk']; ?></td>
						<td align="center"><?php echo $d['jum_sks']; ?></td>
						<td align="center"><?php echo $d['semester']; ?></td>
						<td align="center"><?php echo $d['kode_jur']; ?></td>	
						<?php 
						echo '<td align="center" width="10"><a href="'.base_url().'admin/mk_dosen/'.$d['kd_mk'].'" class="link" style="float:left;">Dosen</a></td>
						<td align="center" width="10"><a href="'.base_url().'admin/edit_mk/'.$d['kd_mk'].'" rel="example_group" class="link" 
						style="float:left;">Edit</a>
						</td>
						<td align="center" width="10">
						<a href="'.base_url().'admin/hapus_mk/'.$d['kd_mk'].'"
						onClick=\'return confirm("Anda yakin...??")\' class="link" style="float:left;">Hapus</a>
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
            <div class="row">
        	  <div class="box-body">

				<form method="post" action="<?php echo base_url(); ?>admin/simpan_mk">
				<div class="box-body">
                    <div class="form-group">
                      <label>Kode Mata Kuliah</label>
                      <input type="text" class="form-control" name="kd_mk" placeholder="Kode Mata Kuliah">
                    </div>
                    <div class="form-group">
                      <label>Nama Mata Kuliah</label>
                      <input type="text" class="form-control" name="nama_mk" placeholder="Nama Mata Kuliah">
                    </div>
                    <div class="form-group">
                      <label>Jumlah SKS</label>
                      <input type="text" class="form-control" name="jum_sks" placeholder="Jumlah SKS">
                    </div>
                    <div class="form-group">
                      <label>Semester</label>
                      <input type="text" class="form-control" name="semester" placeholder="Semester">
                    </div>
                    <div class="form-group">
                      <label>Prasyarat</label>
                      <input type="text" class="form-control" name="prasyarat_mk" placeholder="Prasyarat">
                    </div>
                    <div class="form-group">
                      <label>Jurusan</label>
                      <input type="text" class="form-control" name="kode_jur" placeholder="Jurusan">
                    </div>
                    
                    </div><!-- /.box-body -->

                  <div class="box-footer">
                  	<input type="submit" value="Simpan Data" class="btn btn-primary"/>
            		<input type="reset" value="Batal" class="btn btn-default">
					<input type="hidden" name="stts" value="tambah">
                   
                  </div>

				</form>
        	  </div>
            </div>
		  </div></section>

	</div>
