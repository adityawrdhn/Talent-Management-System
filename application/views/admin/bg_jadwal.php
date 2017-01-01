
<?php echo $menu;?>
<div class="content-wrapper">
<section class="content-header">

	<h1>Manajemen Jadwal Kuliah - Sistem Informasi Akademik Online</h1>

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
          <li class="active"><a href="#lihat" data-toggle="tab">Lihat Jadwal</a></li>
          <li><a href="#tambah" data-toggle="tab">Tambah Jadwal</a></li>
          <!-- <li><a href="#settings" data-toggle="tab">Settings</a></li> -->
        </ul>
        <div class="tab-content">
        	<div class="active tab-pane" id="lihat">
				<div class="box-body">
				<div class="row">
        			<table id="example2" class="table table-bordered table-hover">
        			<thead>
		<tr style="color:#b8c7ce;background:#2c3b41;">			                
					<td align="center">Kode MK</td>
					<td align="center">Mata Kuliah</td>
					<td align="center">Semester</td> 
					<td align="center">SKS</td> 
					<td align="center" colspan="2">Dosen</td> 
					<td align="center">Kelas</td> 
					<td align="center">Jadwal</td> 
					<td align="center">Quota</td> 
					<td align="center">Peserta</td> 
					<td align="center">Calon Peserta</td> 
					<td align="center" colspan="2">Kelola Jadwal</td> 
					</tr>
					</thead>
						<?php Tampilkan_Mata_Kuliah($jadwal); ?>
					</table>
				</div>
	  		</div>
	  		</div>
	  		<div class="tab-pane" id="tambah">
			
            <form method="post" action="<?php echo base_url(); ?>admin/simpan_jadwal">
                  <div class="box-body">
		            <div class="row">
					<div class="col-md-6">

					<div class="form-group">
                    <label>Mata Kuliah</label>
					<select name="kd_mk" class="form-control select2">
						<?php
							foreach($mata_kuliah->result_array() as $mk)
							{
								?>
								<option value="<?php echo $mk['kd_mk']; ?>"><?php echo $mk['kd_mk']." - ".$mk['nama_mk']; ?></option>
								<?php
							}
						?>
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
					
					<div class="form-group">
                    <label>Hari</label>
					<select name="hari" class="form-control select2">
						<option value="Senin">Senin</option>
						<option value="Selasa">Selasa</option>
						<option value="Rabu">Rabu</option>
						<option value="Kamis">Kamis</option>
						<option value="Jumat">Jumat</option>
					</select>
					</div>
                    <div class="form-group">
                      <label>Jam Mulai</label>
                      <input type="text" class="form-control" name="jam_mulai" placeholder="HH.mm">
                    </div>
                    <div class="form-group">
                      <label >Jam Berakhir</label>
                      <input type="text" class="form-control" name="jam_akhir" placeholder="HH.mm">
                    </div>
                    
                  </div><!-- /.box-body -->
					<div class="col-md-6">
			
					<div class="form-group">
                    <label>Ruangan</label>
                    <input type="text" class="form-control" name="ruang" placeholder="ruang">
					</div>
					<div class="form-group">
                    <label>Tahun Ajaran</label>
					<select name="kd_tahun" class="form-control select2">
						<?php
							foreach($tahun_ajaran->result_array() as $ta)
							{
								?>
								<option value="<?php echo $ta['kd_tahun']; ?>"><?php echo $ta['keterangan']; ?></option>
								<?php
							}
						?>
					</select>
					</div>
					<div class="form-group">
                    <label>Kapasistas Kelas</label>
                    <input type="text" class="form-control" name="kapasitas" placeholder="kapasitas kelas">
					</div>
					<div class="form-group">
                    
					<div class="form-group">
                    <label>Kelas Program</label>
					<select name="kelas_program" class="form-control select2">
						<option value="pagi">Pagi</option>
						<option value="sore">Sore</option>
					</select>
					</div>
                    <div class="form-group">
                      <label>Kelas</label>
                      <input type="text" class="form-control" name="kelas" placeholder="kelas">
                    </div>
                    </div>
                  </div><!-- /.box-body -->

</div></div>

                  <div class="box-footer">
                  	<input type="submit" value="Simpan Data" class="btn btn-primary"/>
            		<input type="reset" value="Batal" class="btn btn-default">
					<input type="hidden" name="stts" value="tambah">
                   
                  </div>
                  

                </form>
                  </div>
		

  </div>
 </section>
</div>
	
<?php
function Tampilkan_Mata_Kuliah($jdwl)
{
	$rows=array();
	$index=0;
	$temp='';
	$acuan=0;
	$rowspan=1;
	foreach ($jdwl->result_array() as $value) 
	{
		if(($temp=='') || ($value['kd_mk']!=$temp)) {			
			$rows[$index] = '<tr>
				<td align="center" rowspan="1">'.$value['kd_mk'].'</td>
				<td rowspan="1" id="'.'nama_'.$value['kd_mk'].'">'.$value['nama_mk'].'</td>
				<td align="center" rowspan="1">'.$value['semester'].'</td>
				<td align="center" rowspan="1" id="id'.$value['kd_mk'].'">'.$value['jum_sks'].'</td>';
				
				$rowspan=1;				
				$acuan=$index;
			}else if($value['kd_mk']==$temp) {
				$rows[$index] = '<tr>';
				$rowspan++;
			}

			$rows[$acuan]=str_replace('rowspan="'.($rowspan-1).'"', 'rowspan="'.$rowspan.'"', $rows[$acuan]);
			$peserta = isset($value['Peserta']) ? $value['Peserta']:'0';
			$calonpeserta = isset($value['CalonPeserta']) ? $value['CalonPeserta']:'0';
		
			$disabled ='';
			if($peserta >= $value['kapasitas'])
				$disabled ='disabled="disabled"';
			
			$linkpeserta = $peserta;
			if($peserta >0)
			$linkpeserta = '<a href="'.base_url().'admin/peserta/'.$value['kd_jadwal'].'_1
			/" title="Daftar Peserta Mata Kuliah '.$value['nama_mk'].'  -  Dosen '.$value['nama_dosen'].'" rel="example_group" class="link2">'
				.$peserta.'</a>';
				
			$linkcalonpeserta = $calonpeserta;
			if($calonpeserta >0)
			$linkcalonpeserta = '<a href="'.base_url().'admin/peserta/'.$value['kd_jadwal'].'_0
			/" title="Daftar Calon Peserta Mata Kuliah '.$value['nama_mk'].'  -  Dosen '.$value['nama_dosen'].'" rel="example_group" class="link2">	
			'.$calonpeserta.'</a>';
						
			$rows[$index] .='<td id="'.'cell_'.$value['kd_mk'].'_'.$value['kelas'].'">'.$value['kd_dosen'].'</td><td>'.$value['nama_dosen'].'</td>
				<td align="center">'.$value['kelas'].'</td>
				<td align="center" id="jdwl_'.$value['kd_jadwal'].'">'.$value['jadwal'].'</td>
				<td align="center">'.$value['kapasitas'].'</td>
				<td align="center">'.$linkpeserta.'</td>
				<td align="center">'.$linkcalonpeserta.'</td>
				<td align="center">
				<a href="'.base_url().'admin/edit_jadwal/'.$value['kd_jadwal'].'" rel="example_group" class="link" style="float:left;">Edit</a>
				</td>
				<td align="center">
				<a href="'.base_url().'admin/hapus_jadwal/'.$value['kd_jadwal'].'"
				onClick=\'return confirm("Anda yakin...??")\' class="link" style="float:left;">Hapus</a>
				</td></tr>';
			$index++;
			$temp=$value['kd_mk'];
	}		
	foreach($rows as $row)
	{
		echo str_replace('rowspan="1"', '', $row);
	}
}
?>
