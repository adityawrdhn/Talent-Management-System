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
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><strong>Daftar Dosen dan Mata Kuliah Yang Dipegang</strong></h3>
 	      <div class="box-tools pull-right">
          </div>
        </div>
		<div class="box-body">
        <table id="example2" class="table table-bordered table-hover">
        <thead>
		<tr style="color:#b8c7ce;background:#2c3b41;">			                
	<td align="center">Kode MK</td>
	<td align="center">Nama MK</td>
	<td align="center">Kode Dosen</td>	
	<td align="center">Nama Dosen</td>	
	<td align="center">Jadwal</td>
	</tr>
	</thead>
	<?php
		foreach($mk_dosen->result_array() as $d)
		{
		?>
			<tr>
			<td align="center"><?php echo $d['kd_mk']; ?></td>	
			<td align="center"><?php echo $d['nama_mk']; ?></td>
			<td align="center"><?php echo $d['kd_dosen']; ?></td>
			<td align="center"><?php echo $d['nama_dosen']; ?></td>
			<td align="center"><?php echo $d['jadwal']; ?></td>	
			</tr>
		<?php
		}
	?>
	</table>
</div></div></div></div></section>

	</div>
