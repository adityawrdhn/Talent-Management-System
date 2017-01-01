<?php echo $menu;?>
<div class="content-wrapper">
<section class="content-header">

	<h1>Nilai - Kartu Hasil Studi - Sistem Informasi Akademik Online</h1>

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
          <h3 class="box-title"><strong>Mata Kuliah Yang Akan Diinputkan Nilainya</strong></h3>
 	      <div class="box-tools pull-right">
          </div>
        </div>
		<div class="box-body">
        <table id="example2" class="table table-bordered table-hover">
        <thead>


			<tr style="color:#b8c7ce;background:#2c3b41;">
			<td align="center">Kode MK</td>
			<td align="center">Mata Kuliah</td>
			<td align="center">Smstr</td>	
			<td align="center">SKS</td>
			<td align="center">Dosen</td>
			<td align="center">Kelas</td>
			<td align="center">Jadwal</td>
			<td align="center">Quota</td>
			<td align="center">Peserta</td>
			<td align="center">*</td>
			<?php
			if($status=='0')
			{
				echo '<td align="center">Batalkan</td>';
			}
			?>
			</tr>


			<?php
			$no=1;
			$tot_sks = 0;
			foreach ($detailfrs->result_array() as $value) 
			{
			$tot_sks += $value['jum_sks'];

			echo '<tr class="content">
					<td>'.$value['kd_mk'].'</td>
					<td>'.$value['nama_mk'].'</td>
					<td>'.$value['semester'].'</td>
					<td>'.$value['jum_sks'].'</td>';
					
			echo '<td>'.$value['nama_dosen'].'</td>
					<td align="center">'.$value['kelas'].'</td>
					<td align="center">'.$value['jadwal'].'</td>
					<td align="center">'.$value['kapasitas'].'</td>
					<td align="center">'.$value['Peserta'].'</td>
					<td align="center"><a href="'.base_url().'admin/form_input_nilai/'.$value['nim'].'/'.$value['kd_jadwal'].'" class="link"
					rel="example_group">Input</a></td>';
				if($status=='0')
				{
					echo '<td align="center">
					<a class="delbutton" id="'.$value['nim'].'|'.$value['kd_jadwal'].'" href="#"><div id="box-link">Batalkan</div></a>
					</td>';
				}
			}
			echo '<tr><td colspan=3>Total SKS Yang Akan Ditempuh :</td><td colspan=8 id="jmlcart"><b>'.$tot_sks.' SKS</b></td></tr>';
			?>
		</thead>
		</table></div></div></div></div>
		
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><strong>Mata Kuliah yang Tersimpan</strong></h3>
 	      <div class="box-tools pull-right">
          </div>
        </div>
		<div class="box-body">
        <table id="example2" class="table table-bordered table-hover">
        <thead>

		
		<?php 
		$temp='';
		$rows=array();
		$totalNH=0;	
		$totalSKS=0;
		$no=1;
		?>
		<tr style="color:#b8c7ce;background:#2c3b41;">
		<td align="center">No</td>
		<td align="center">Kode Mata Kuliah</td>
		<td align="center">Mata Kuliah</td>
		<td align="center">Semester</td>
		<td align="center">SKS</td>
		<td align="center">Nilai</td>	
		<td align="center">Bobot</td>
		<td align="center">SKS x Bobot</td>
		<td colspan="2">Aksi</td>
		</tr>
		<?php
		foreach($khs->result_array() as $value)
		{
			if($temp=='')
			{
				$rows[]='<tr>
				<td colspan="10" bgcolor="#fff"><strong>Semester : '.$value['semester_ditempuh'].'</strong></td>
				</tr>';
				$rows[]='<tr>
				<td>'. $no.'</td>
				<td>'. $value['kd_mk'].'</td>
				<td>&nbsp;'. $value['nama_mk'].'</td>
				<td align="center">'. $value['semester_ditempuh'].'</td>
				<td align="center">'. $value['jum_sks'].'&nbsp;</td>
				<td align="center">'. $value['grade'].'</td>
				<td align="center">'. $value['bobot'].'</td>
				<td align="center">'. $value['NxH'].'</td>
				<td align="center"><a href="'.base_url().'admin/edit_nilai/'.$value['nim'].'/'.$value['kd_mk'].'" class="link"
				rel="example_group">Edit</a></td>
				<td align="center"><a href="'.base_url().'admin/hapus_nilai/'.$value['nim'].'/'.$value['kd_mk'].'" class="link"
				onClick=\'return confirm("Anda yakin...??")\'>Hapus</a></td>';
				$no++;
				$totalNH=0;
				$totalSKS=0;
			}
			else if($value['semester_ditempuh']!=$temp)
			{
				$ip = 0;
				if($totalNH !=0)			
					$ip = round($totalNH/$totalSKS, 2);			
				$rows[]='<tr>
				<td colspan="6"><strong>Jumlah SKS : '.$totalSKS.'</strong></td>
				<td colspan="6"><strong>IP Semester : '.$ip.'</strong></td>';
	
				$rows[]='<tr>
				<td colspan="10" bgcolor="#fff"><strong>Semester : '.$value['semester_ditempuh'].'</strong></td>
				</tr>';
	
				$rows[]='<tr>
				<td>'. $no.'</td>
				<td>'. $value['kd_mk'].'</td>
				<td>&nbsp;'. $value['nama_mk'].'</td>
				<td align="center">'. $value['semester_ditempuh'].'</td>
				<td align="center">'. $value['jum_sks'].'&nbsp;</td>
				<td align="center">'. $value['grade'].'</td>
				<td align="center">'. $value['bobot'].'</td>
				<td align="center">'. $value['NxH'].'</td>
				<td align="center"><a href="'.base_url().'admin/edit_nilai/'.$value['nim'].'/'.$value['kd_mk'].'" class="link"
				rel="example_group">Edit</a></td>
				<td align="center"><a href="'.base_url().'admin/hapus_nilai/'.$value['nim'].'/'.$value['kd_mk'].'" class="link"
				onClick=\'return confirm("Anda yakin...??")\'>Hapus</a></td>
			</tr>';
			$no++;
			
				$totalNH =0;
				$totalSKS=0;
			}		
			else 
			{ 
				$rows[]='<tr>
				<td>'. $no.'</td>
				<td>'. $value['kd_mk'].'</td>
				<td>&nbsp;'. $value['nama_mk'].'</td>
				<td align="center">'. $value['semester_ditempuh'].'</td>
				<td align="center">'. $value['jum_sks'].'</td>
				<td align="center">'. $value['grade'].'</td>
				<td align="center">'. $value['bobot'].'</td>
				<td align="center">'. $value['NxH'].'</td>
				<td align="center"><a href="'.base_url().'admin/edit_nilai/'.$value['nim'].'/'.$value['kd_mk'].'" class="link"
				rel="example_group">Edit</a></td>
				<td align="center"><a href="'.base_url().'admin/hapus_nilai/'.$value['nim'].'/'.$value['kd_mk'].'" class="link"
				onClick=\'return confirm("Anda yakin...??")\'>Hapus</a></td>
			</tr>';
			$no++;
						
			}
			if($value['grade'] != 'T') {
				$totalNH +=$value['NxH'];
				$totalSKS+=$value['jum_sks'];
			}
			$temp=$value['semester_ditempuh'];	
		}
		$ip = 0;
		if($totalNH !=0)			
			$ip = round($totalNH/$totalSKS, 2);
		$rows[]='
				<tr>
				<td colspan="6"><strong>Jumlah SKS : '.$totalSKS.'</strong></td>
				<td colspan="6"><strong>IP Semester : '.$ip.'</strong></td>
				</tr>';
	
		foreach($rows as $row)
		{
			echo $row;
		}
		?>
		</thead>
		</table>		
	</div>
</div></div></div></section></div>