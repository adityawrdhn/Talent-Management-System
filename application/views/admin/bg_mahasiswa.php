
<?php echo $menu;?>
<div class="content-wrapper">
<section class="content-header">
	<h1>Daftar Mahasiswa Sistem Informasi Akademik Online</h1>
</section>
<section class="content">

<div class="box box-solid">
	<blockquote style="font-size:14px;">
		<?php
			echo $bio;
		?>
	</blockquote>	
</div>
				<?php echo $this->session->flashdata('save_mahasiswa'); ?>
  <div class="row">
    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#daftar" data-toggle="tab">Daftar Mahasiswa</a></li>
          <li><a href="#tambah" data-toggle="tab">Tambah Mahasiswa</a></li>
          <!-- <li><a href="#settings" data-toggle="tab">Settings</a></li> -->
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="daftar">
			<div class="box-body">
			  <div class="row">
				<table id="example2" class="table table-bordered table-hover">
				<thead>

		<tr style="color:#b8c7ce;background:#2c3b41;">			                
				<td align="center">NIM</td>
				<td align="center">Nama Mahasiswa</td>
				<td align="center">Angkatan</td>	
				<td align="center">Jurusan</td>	
				<td align="center">Kelas Program</td>
				<td align="center" colspan="2">Kelola Mahasiswa</td>
				</tr>
</thead>
				<?php
				foreach($employee->result_array() as $d)
				{
				?>
					<tr>
					<td align="center"><?php echo $d['pernr']; ?></td>	
					<td align="center"><?php echo $d['name']; ?></td>
					<td align="center"><?php echo $d['gelar']; ?></td>
					<td align="center"><?php echo $d['birthdate']; ?></td>
					<td align="center"><?php echo $d['birthplace']; ?></td>	
					<td align="center" width="60">
					<?php
					echo '<a href="'.base_url().'admin/edit_mahasiswa/'.$d['pernr'].'" rel="example_group" class="link" style="float:left;">Edit</a>
						</td>
						<td align="center" width="60">
						<a href="'.base_url().'admin/hapus_mahasiswa/'.$d['pernr'].'"
						onClick=\'return confirm("Anda yakin...??")\' class="link" style="float:left;">Hapus</a>';
					?>
					</td>	
					</tr>
				<?php
				}
				?>
				</table>
				<?php
					echo $paginator;
				?>
			  </div>
		    </div>
		  </div>
  		  <div class="tab-pane" id="tambah">
				<form method="post" action="<?php echo base_url(); ?>admin/simpan_mahasiswa">
				  <div class="box-body">
		            <div class="row">
					  <div class="col-md-6">
					    <div class="form-group">
                        <label>NIM</label>
                        <input type="text" class="form-control" name="nim" id="nidn" placeholder="NIM">
                      	</div>
						<div class="form-group">
                        <label>Nama Mahasiswa</label>
                        <input type="text" class="form-control" name="nama_mahasiswa" id="nidn" placeholder="Nama">
                      	</div>
						<div class="form-group">
                        <label>Agkatan</label>
                        <input type="text" class="form-control" name="angkatan" id="nidn" placeholder="Angkatan">
                      	</div>						
                      	<div class="form-group">
                        <label>Jurusan</label>
                        <input type="text" class="form-control" name="jurusan" id="nidn" placeholder="Jurusan">
                      	</div>												
						<div class="form-group">
		                <label>Kelas Program</label>
						<select name="kelas_program" class="form-control select2">
							<option value="pagi">Pagi</option>
							<option value="sore">Sore</option>
						</select>
						</div>
		                <div class="form-group">
	                    <label>Nama Dosen</label>
						<select name="kd_dosen" class="form-control select2">
							<?php
								foreach($dosen->result_array() as $d)
								{
									?>
									<option value="<?php echo $d['kd_dosen']; ?>"><?php echo $d['kd_dosen']." - ".$d['nama_dosen']; ?></option>
									<?php
								}
							?>
						</select>
						</div>
					  </div>
					</div>
				  </div>
				  <div class="box-footer">
                  	<input type="submit" value="Simpan Data" class="btn btn-primary"/>
            		<input type="reset" value="Batal" class="btn btn-default">
					<input type="hidden" name="stts" value="tambah">
                   
                  </div>
				</form>
				</div>

		  </div></section></div>