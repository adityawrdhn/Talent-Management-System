
<?php
			echo $menu;
		?>
<div class="content-wrapper">
<section class="content-header">
	<h1>Info Kampus - Sistem Informasi Akademik Online</h1>
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
              <!-- The time line -->
              <ul class="timeline">
              		
              	<li>
              		<i class="fa bg-red">
<a href="<?php echo base_url(); ?>admin/tambah_info/" style="color:#fff;"><i class="icon-plus"></i></a>
              		</i>
              	</li>
              	</br>
                <!-- timeline time label -->
                <li class="time-label">
                  <span class="bg-aqua">
                  <?php
$tanggal= mktime(date("m"),date("d"),date("Y"));
echo "Tanggal : <b>".date("d-M-Y", $tanggal)."</b> ";
date_default_timezone_set('Asia/Jakarta');
$jam=date("H:i:s");
echo "| Pukul : <b>". $jam." "."</b>";
?>
						<!-- <h5><?php echo time(now) ?></h5> -->
                    
                  </span>
                </li>
                <!-- /.timeline-label -->
                <!-- timeline item -->
				<?php
					foreach($info->result_array() as $i)
					{
				?>

                <li>
              	  <i class="fa icon-clock bg-blue"></i>
                  
	              <div class="timeline-item">
	                <span class="time"><i class="fa fa-clock-o"></i><?php echo tgl_indo($i['waktu_post']); ?></span>
						<h3 class="timeline-header"><?php echo $i['judul']; ?></h3>
                  <div class="box-body">
                    <div class="timeline-body">
						<?php echo $i['isi']; ?>

                    </div>
                    <div class="timeline-footer">
                    <?php
					echo '<a href="'.base_url().'admin/edit_info/'.$i['kd_info'].'" rel="example_group" class="btn btn-primary btn-xs" style="float:left;">Edit</a>
						<a href="'.base_url().'admin/hapus_info/'.$i['kd_info'].'"
						onClick=\'return confirm("Anda yakin...??")\' class="btn btn-danger btn-xs" style="float:left;">Hapus</a>';
					?>
                     
                    </div>
                  </div>
                  </div>
                </li>
                
		


				
		<?php
		} 
		?>
             
                  <ul class="pagination pagination-sm no-margin pull-left">
		<?php echo $paginator;?>

                  </ul>
                
<!-- 
		<?php echo $paginator;?>
		 --></ul>
	</div>
</div></section></div>