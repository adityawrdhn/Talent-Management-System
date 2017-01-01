<link href="<?php echo base_url(); ?>asset/css/jquery.fancybox-1.3.4.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>asset/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>asset/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>asset/js/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript">
		$(document).ready(function() {
			$("a[rel=example_group]").fancybox({
				'height'			: '100%',
				'width'				: '70%',
				'transitionIn'		: 'fade',
				'transitionOut'		: 'fade',
				'overlayColor'		: '#000',
				'overlayOpacity'	: 0.9,
				'type'              : 'iframe',
				'showNavArrows'   : false,
				'hideOnOverlayClick': false,
				'onClosed'          : function() {
									  parent.location.reload(true);
									  }
			});});
</script>
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
          <li><a href="#lihat" data-toggle="tab">Lihat Jadwal</a></li>
          <li><a href="#tambah" data-toggle="tab">Tambah Jadwal</a></li>
          <li class="active"><a href="#edit" data-toggle="tab">Edit Jadwal</a></li>
          <!-- <li><a href="#settings" data-toggle="tab">Settings</a></li> -->
        </ul>
        <div class="tab-content">
        	<div class="tab-pane" id="lihat">
			<?php echo $this->session->flashdata('save_krs'); ?>
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
					<td align="center" colspan="2">Kelola Jadwal</td> </tr>
					</thead>
						<?php Tampilkan_Mata_Kuliah($jadwal); ?>
		
					</table>
				</div>
	  		</div>
	  		</div>
			<div class="tab-pane" id="tambah">
			<?php echo $this->session->flashdata('save_krs'); ?>
			
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

	  		<div class="active tab-pane" id="edit">
			<?php echo $this->session->flashdata('save_krs'); ?>
			
            
<form method="post" action="<?php echo base_url(); ?>admin/simpan_jadwal">
<?php
	foreach($edit->result_array() as $e)
	{
		$jdw = explode(" / ",$e['jadwal']);
		$jam = explode("-",$jdw[1]);
?>
<table>

<tr>
<td width="180">Mata Kuliah</td>
<td width="50">:</td>
<td>
<select name="kd_mk" class="input-read-only">
	<?php
		foreach($mata_kuliah->result_array() as $mk)
		{
			$pilih = '';
			if($e['kd_mk']==$mk['kd_mk']) $pilih="selected='selected'";
	?>
	<option value="<?php echo $mk['kd_mk']; ?>" <?php echo $pilih; ?>><?php echo $mk['kd_mk']." - ".$mk['nama_mk']; ?></option>
	<?php
		}
	?>
</select>
</td>
</tr>

<tr>
<td width="180">Nama Dosen</td>
<td width="50">:</td>
<td>
<select name="kd_dosen" class="input-read-only">
	<?php
		foreach($dosen->result_array() as $d)
		{
			$pilih = '';
			if($e['kd_dosen']==$d['kd_dosen']) $pilih="selected='selected'";
	?>
	<option value="<?php echo $d['kd_dosen']; ?>" <?php echo $pilih; ?>><?php echo $d['kd_dosen']." - ".$d['nama_dosen']; ?></option>
	<?php
		}
	?>
</select>
</td>
</tr>

<tr>
<td width="180">Hari</td>
<td width="50">:</td>
<td>
<select name="hari" class="input-read-only">
<?php
	if($jdw[0]=="Senin")
	{
		$senin="selected='selected'"; $selasa=""; $rabu=""; $kamis=""; $jumat="";
	}
	else if($jdw[0]=="Selasa")
	{
		$senin=""; $selasa="selected='selected'"; $rabu=""; $kamis=""; $jumat="";
	}
	else if($jdw[0]=="Rabu")
	{
		$senin=""; $selasa=""; $rabu="selected='selected'"; $kamis=""; $jumat="";
	}
	else if($jdw[0]=="Kamis")
	{
		$senin=""; $selasa=""; $rabu=""; $kamis="selected='selected'"; $jumat="";
	}
	else if($jdw[0]=="Jumat")
	{
		$senin=""; $selasa=""; $rabu=""; $kamis=""; $jumat="selected='selected'";
	}
?>
	<option value="Senin" <?php echo $senin; ?>>Senin</option>
	<option value="Selasa" <?php echo $selasa; ?>>Selasa</option>
	<option value="Rabu" <?php echo $rabu; ?>>Rabu</option>
	<option value="Kamis" <?php echo $kamis; ?>>Kamis</option>
	<option value="Jumat" <?php echo $jumat; ?>>Jumat</option>
</select>
</td>
</tr>

<tr>
<td width="180">Jam Mulai</td>
<td width="50">:</td>
<td><input type="text" name="jam_mulai" size="50" class="input-read-only" value="<?php echo $jam[0]; ?>" /></td>
</tr>

<tr>
<td width="180">Jam Berakhir</td>
<td width="50">:</td>
<td><input type="text" name="jam_akhir" size="50" class="input-read-only" value="<?php echo $jam[1]; ?>" /></td>
</tr>

<tr>
<td width="180">Ruangan</td>
<td width="50">:</td>
<td><input type="text" name="ruang" size="50" class="input-read-only" value="<?php echo $jdw[2]; ?>" /></td>
</tr>

<tr>
<td width="180">Tahun Ajaran</td>
<td width="50">:</td>
<td>
<select name="kd_tahun" class="input-read-only">
	<?php
		foreach($tahun_ajaran->result_array() as $ta)
		{
			$pilih = '';
			if($e['kd_tahun']==$ta['kd_tahun']) $pilih="selected";
	?>
	<option value="<?php echo $ta['kd_tahun']; ?>" <?php echo $pilih; ?>><?php echo $ta['keterangan']; ?></option>
	<?php
		}
	?>
</select>
</td>
</tr>

<tr>
<td width="180">Kapasitas Kelas</td>
<td width="50">:</td>
<td><input type="text" name="kapasitas" size="50" class="input-read-only" value="<?php echo $e['kapasitas']; ?>" /></td>
</tr>

<tr>
<td width="180">Kelas Program</td>
<td width="50">:</td>
<td>
<select name="kelas_program" class="input-read-only">
<?php
	if($e['kelas_program']=="pagi")
	{
		?>
		<option value="pagi" selected>Pagi</option>
		<option value="sore">Sore</option>
		<?php
	}
	else if($e['kelas_program']=="sore")
	{
		?>
		<option value="pagi">Pagi</option>
		<option value="sore" selected>Sore</option>
		<?php
	}
?>
</select>
</td>
</tr>

<tr>
<td width="180">Kelas</td>
<td width="50">:</td>
<td><input type="text" name="kelas" size="50" class="input-read-only" value="<?php echo $e['kelas']; ?>" /></td>
</tr>

<tr>
<td width="180"></td>
<td width="50"></td>
<td>
<input type="submit" value="Simpan Nilai" class="btn-kirim">
<input type="reset" value="Batal" class="btn-kirim">
<input type="hidden" name="kd_jadwal" value="<?php echo $e['kd_jadwal']; ?>">
<input type="hidden" name="stts" value="edit"></td>
</tr>

</table>

<?php } ?>

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
</style>