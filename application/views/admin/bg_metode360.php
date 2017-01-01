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
	        Competency:
	        <small>360 Degrees Feedback</small>
	      </h1>
	      <ol class="breadcrumb">
	        <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
	        <li class="active">Competency</li>
	      </ol>
	    </section>
   		<section class="content">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 connectedSortable">
                <?php echo $this->session->flashdata('sukses'); ?>
                    <?php foreach ($competency->result() as $row) {
                    ?>

                    <div class="info-box bg-aqua">
                        <span class="info-box-icon"><i class="fa fa-fw fa-bar-chart"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-text">My Competency</span>
                          <span class="info-box-number"><?php echo $row->competency;?>%</span>

                          <div class="progress">
                            <div class="progress-bar" style="width:<?php echo $row->competency;?>%"></div>
                          </div>
                              <span class="progress-description">
                                My Competency is <?php echo $row->competency;?>%
                              </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <?php } ?>
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#table-data" data-toggle="tab"><i class="fa fa-table"></i>Question Data</a></li>
                            <li><a href="#test-data" data-toggle="tab"><i class="fa fa-table"></i>Test Data</a></li>
                            <li><a href="#my-test-data" data-toggle="tab"><i class="fa fa-user"></i>My Test Data</a></li>
                            <!-- <li class="pull-right header"><small><i class="fa fa-plus"></i>Isi Kuesioner</small></li> -->
                        </ul>
                        <div class="tab-content no-padding">
                          <div class="chart tab-pane active" id="table-data" style="position: relative; ">
                            <div class="box-body table-responsive">
                                <table id="table" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" scrollX="true">
                                    <thead >
                                        <tr style="color:#2c3b41;background:#b8c7ce;">
                                            <th>ID</th>
                                            <th>Soal</th>
                                            <th>Variabel</th>
                                            <th>Jawaban A</th>
                                            <th>Jawaban B</th>
                                            <th>Jawaban C</th>
                                            <th>Jawaban D</th>
                                            <th>Jawaban E</th>
                                            <th>Bobot Variabel</th>
                                            <th>Nilai A</th>
                                            <th>Nilai B</th>
                                            <th>Nilai C</th>
                                            <th>Nilai D</th>
                                            <th>Nilai E</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                          </div>
                          <div class="chart tab-pane" id="test-data" style="position: relative; ">
                            <div class="box-body table-responsive">
                                <table id="test" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" scrollX="true">
                                    <thead >
                                        <tr style="color:#2c3b41;background:#b8c7ce;">
                                            <!-- <th></th> -->
                                            <!-- <th>ID Penilai</th> -->
                                            <th>Nama Penilai</th>
                                            <th>Nama Dinilai</th>
                                            <!-- <th>Atasan</th> -->
                                            <th>Personality</th>
                                            <th>Job Competency</th>
                                            <th>General Attitude</th>
                                            <th>Level Penilaian</th>
                                            <th>Nilai</th>
                                            <!-- <th>Status</th> -->
                                            <th>Last Update</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div> 
                        <div class="chart tab-pane" id="my-test-data" style="position: relative; ">
                            <div class="box-body table-responsive">
                                <table id="mytest" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" scrollX="true">
                                    <thead >
                                        <tr style="color:#2c3b41;background:#b8c7ce;">
                                            <!-- <th></th> -->
                                            <!-- <th>ID Penilai</th> -->
                                            <th>Nama Penilai</th>
                                            <th>Nama Dinilai</th>
                                            <!-- <th>Atasan</th> -->
                                            <th>Personality</th>
                                            <th>Job Competency</th>
                                            <th>General Attitude</th>
                                            <th>Level Penilaian</th>
                                            <th>Nilai</th>
                                            <!-- <th>Status</th> -->
                                            <th>Last Update</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
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
    <script type="text/javascript">

	var save_method; //for save method string
	var table;
	$(document).ready(function() {
	    //datatables
	    table = $('#table').DataTable({ 
	        "processing": true, //Feature control the processing indicator.
	        "serverSide": true, //Feature control DataTables' server-side processing mode.
	        "order": [],
            "autoWidth":false,
            "aLengthMenu": [[20, 40, 60, -1], [20, 40, 60, "All"]],
            "iDisplayLength": 20, // Load data for the table's content from an Ajax source
	        "ajax": {
	            "url": "<?php echo site_url('Metode360/ajax_list_kuis')?>",
	            "type": "POST"
	        },
	        //Set column definition initialisation properties.
	        "columnDefs": [
	        { 
	            "targets": [ -1 ], //last column
	            "orderable": false, //set not orderable
	        },
	        ],

	    });
	    //datepicker
	    $('.datepicker').datepicker({
	        autoclose: true,
	        format: "yyyy-mm-dd",
	        todayHighlight: true,
	        orientation: "top",
	        todayBtn: true,
	        todayHighlight: true,  
	    });

	});



	function add_employee()
	{
	    save_method = 'add';
    	$('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal_form').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title

    }

	function editForm(id)
	{
	    save_method = 'update';
	    $('#form')[0].reset(); // reset form on modals
	    $('.form-group').removeClass('has-error'); // clear error class
	    $('.help-block').empty(); // clear error string

	    //Ajax Load data from ajax
	    $.ajax({
	        url : "<?php echo base_url('Metode360/ajax_edit_kuis')?>/" + id,
	        type: "GET",
	        dataType: "JSON",
	        success: function(data)
	        {
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Employee'); // Set title to Bootstrap modal title

            $('[name="id_kuis"]').val(data.ID_KUIS);
            $('[name="soal"]').val(data.SOAL);
            $('[name="variabel"]').val(data.VARIABEL);
            $('[name="jawaban_a"]').val(data.JAWABAN_A);
            $('[name="jawaban_b"]').val(data.JAWABAN_B);
            $('[name="jawaban_c"]').val(data.JAWABAN_C);
            $('[name="jawaban_d"]').val(data.JAWABAN_D);
            $('[name="jawaban_e"]').val(data.JAWABAN_E);
            $('[name="bobot_variabel"]').val(data.BOBOT_VARIABEL);
            $('[name="nilai_a"]').val(data.NILAI_A);
            $('[name="nilai_b"]').val(data.NILAI_B);
            $('[name="nilai_c"]').val(data.NILAI_C);
            $('[name="nilai_d"]').val(data.NILAI_D);
            $('[name="nilai_e"]').val(data.NILAI_E);
	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert('Error get data from ajax');
	        }
	    });
        
	}

	function reload_table()
	{
	    window.location.reload(null,false); //reload datatable ajax 
	}
	function save()
    {
        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable 
        var url;

        if(save_method == 'add') {
            url = "<?php echo site_url('Metode360/ajax_add_kuis')?>";
        } else {
            url = "<?php echo site_url('Metode360/ajax_update_kuis')?>";
        }

        // ajax adding data to database
        $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {

                if(data.status) //if success close modal and reload ajax table
                {
                    $('#modal_form').modal('hide');
                    reload_table();
                }

                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 


            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 

            }
        });
    }
    function deleteForm(id)
	{
	        // ajax delete data to database
            $.ajax({
            url : "<?php echo base_url('Metode360/ajax_edit_kuis')?>/"+id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('#ModalDelete').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Are you sure to delete this data?');
                $('.modal-title2').val(data.name);
                $('[name="id_kuis"]').val(data.ID_KUIS); // Set title to Bootstrap modal title
    	    },
	        error: function (jqXHR, textStatus, errorThrown)
	            {
	                alert('Error deleting data');
	            }
	        });
	}
    function deleteEmp()
    {
        $('#btndel').text('deleting...'); //change button text
        $('#btndel').attr('disabled',true); //set button disable 
        var url;
        $.ajax({
            url : "<?php echo base_url('Metode360/ajax_delete_kuis')?>",
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {

                if(data.status) //if success close modal and reload ajax table
                {
                    $('#ModalDelete').modal('hide');
                    reload_table();
                }

                $('#btndel').text('deleted'); //change button text
                $('#btndel').attr('disabled',false); //set button enable 
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
                $('#btndel').text('delete'); //change button text
                $('#btndel').attr('disabled',false); //set button enable 

            }
        });
    }
	</script>
    <script type="text/javascript">

    var save_method; //for save method string
    var table;
    $(document).ready(function() {
        //datatables
        table = $('#test').DataTable({ 
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [],
            "autoWidth":false,
            "aLengthMenu": [[20, 40, 60, -1], [20, 40, 60, "All"]],
            "iDisplayLength": 20, // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('Metode360/ajax_list_penilaian')?>",
                "type": "POST"
            },
            //Set column definition initialisation properties.
            "columnDefs": [
            { 
                "targets": [ -1 ], //last column
                "orderable": false, //set not orderable
            },
            ],

        });
        //datepicker
        $('.datepicker').datepicker({
            autoclose: true,
            format: "yyyy-mm-dd",
            todayHighlight: true,
            orientation: "top",
            todayBtn: true,
            todayHighlight: true,  
        });

    });



    function add_employee()
    {
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal_form').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title

    }
    function reload_table()
    {
        window.location.reload(null,false); //reload datatable ajax 
    }
    function deleteFormPenilaian(id)
    {
            // ajax delete data to database
            $.ajax({
            url : "<?php echo base_url('Metode360/ajax_edit_penilaian')?>/"+id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('#ModalDeletePenilaian').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Are you sure to delete this data?');
                $('.modal-title2').val(data.name);
                $('[name="id_test"]').val(data.ID_TEST); // Set title to Bootstrap modal title
                // $('[name="pernr"]').val(data.PERNR); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error deleting data');
                }
            });
    }
    function deletePenilaian()
    {
        $('#btndel').text('deleting...'); //change button text
        $('#btndel').attr('disabled',true); //set button disable 
        var url;
        $.ajax({
            url : "<?php echo base_url('Metode360/ajax_delete_penilaian')?>",
            type: "POST",
            data: $('#forms').serialize(),
            dataType: "JSON",
            success: function(data)
            {

                if(data.status) //if success close modal and reload ajax table
                {
                    $('#ModalDeletePenilaian').modal('hide');
                    reload_table();
                }

                $('#btndel').text('deleted'); //change button text
                $('#btndel').attr('disabled',false); //set button enable 
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
                $('#btndel').text('delete'); //change button text
                $('#btndel').attr('disabled',false); //set button enable 

            }
        });
    }
    </script>
        <script type="text/javascript">

    var save_method; //for save method string
    var table;
    $(document).ready(function() {
        //datatables
        table = $('#mytest').DataTable({ 
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [],
            "autoWidth":false,
            "aLengthMenu": [[20, 40, 60, -1], [20, 40, 60, "All"]],
            "iDisplayLength": 20, // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('Metode360/ajax_list_myPenilaian')?>",
                "type": "POST"
            },
            //Set column definition initialisation properties.
            "columnDefs": [
            { 
                "targets": [ -1 ], //last column
                "orderable": false, //set not orderable
            },
            ],

        });
        //datepicker
        $('.datepicker').datepicker({
            autoclose: true,
            format: "yyyy-mm-dd",
            todayHighlight: true,
            orientation: "top",
            todayBtn: true,
            todayHighlight: true,  
        });

    });



    function reload_table()
    {
        window.location.reload(null,false); //reload datatable ajax 
    }
    function deleteFormPenilaian(id)
    {
            // ajax delete data to database
            $.ajax({
            url : "<?php echo base_url('Metode360/ajax_edit_penilaian')?>/"+id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('#ModalDeletePenilaian').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Are you sure to delete this data?');
                $('.modal-title2').val(data.name);
                $('[name="id_test"]').val(data.ID_TEST); // Set title to Bootstrap modal title
                // $('[name="pernr"]').val(data.PERNR); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error deleting data');
                }
            });
    }
    function deletePenilaian()
    {
        $('#btndel').text('deleting...'); //change button text
        $('#btndel').attr('disabled',true); //set button disable 
        var url;
        $.ajax({
            url : "<?php echo base_url('Metode360/ajax_delete_penilaian')?>",
            type: "POST",
            data: $('#forms').serialize(),
            dataType: "JSON",
            success: function(data)
            {

                if(data.status) //if success close modal and reload ajax table
                {
                    $('#ModalDeletePenilaian').modal('hide');
                    reload_table();
                }

                $('#btndel').text('deleted'); //change button text
                $('#btndel').attr('disabled',false); //set button enable 
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
                $('#btndel').text('delete'); //change button text
                $('#btndel').attr('disabled',false); //set button enable 

            }
        });
    }
    </script>


  <script>
  $(function () {
    $('#datepicker').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true
    });
    $('#datepicker2').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true
    });
    $('#datepicker3').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true
    });

  });
</script>
   <div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">FORM SOAL Metode360 </h3>
            </div>
            <form action="#" id="form" class="form-horizontal">
                
            <!-- <form id="form" method="post" action="<?php echo base_url(); ?>Metode360/savesoalMetode360" class="form-horizontal"> -->
                <div class="modal-body">
                    <div class="col-md-12">   
                            
                            <div class="form-group">
                                <label>ID Kuis</label>
                                
                                    <input type="text" class="form-control" name="id_kuis" value="" class="uneditable-input" readonly="true">
                                
                            </div>
                            <div class="form-group">
                                <label>Soal</label>
                                
                                    <input type="text" class="form-control" name="soal" value="">
                                
                            </div>
                            <div class="form-group">
                                <label>Variabel</label>
                                    <input type="text" class="form-control" name="variabel" value="">
                            </div>
                            <div class="form-group">
                                <label>Jawaban A</label>
                                    <input type="text" class="form-control" name="jawaban_a" value="">
                            </div>
                            <div class="form-group">
                                <label>Jawaban A</label>
                                    <input type="text" class="form-control" name="jawaban_b" value="">
                            </div>
                            <div class="form-group">
                                <label>Jawaban A</label>
                                    <input type="text" class="form-control" name="jawaban_c" value="">
                            </div>
                            <div class="form-group">
                                <label>Jawaban A</label>
                                    <input type="text" class="form-control" name="jawaban_d" value="">
                            </div>
                            <div class="form-group">
                                <label>Jawaban A</label>
                                    <input type="text" class="form-control" name="jawaban_e" value="">
                            </div>
                            <div class="form-group">
                                <label>Bobot Variabel</label>
                                    <input type="text" class="form-control" name="jawaban_e" value="">
                            </div>
                            <div class="form-group">
                                <label>Nilai A</label>
                                    <input type="text" class="form-control" name="nilai_a" value="">
                            </div>
                            <div class="form-group">
                                <label>Nilai B</label>
                                    <input type="text" class="form-control" name="nilai_b" value="">
                            </div>
                            <div class="form-group">
                                <label>Nilai C</label>
                                    <input type="text" class="form-control" name="nilai_c" value="">
                            </div>
                            <div class="form-group">
                                <label>Nilai D</label>
                                    <input type="text" class="form-control" name="nilai_d" value="">
                            </div>
                            <div class="form-group">
                                <label>Nilai E</label>
                                    <input type="text" class="form-control" name="nilai_e" value="">
                            </div>
                        </div>
                    <!-- </div> -->
                        
                        <!-- </div> -->
                    <input type="hidden" name="stts" value="edit">
                   
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="submit" id="btnSave" onclick="save()" class="btn btn-primary pull-right">Save</button>
                    </div>
                </div>
                
                
            </form>
            <!-- </div> -->
            
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div> 
<div class="modal modal-danger fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:100px;">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" style="text-align:center;"><strong class="modal-title2"></strong></h4>
              </div>
                <form id="form" method="post">        
              <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                <input type="hidden" name="id_soal" value="">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" onclick="deleteEmp()"class="btn btn-outline" id="btndel">Delete</a>
              </div>
                </form>
            </div>
        </div>
</div>
<div class="modal modal-danger fade" id="ModalDeletePenilaian" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:100px;">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" style="text-align:center;"><strong class="modal-title2"></strong></h4>
              </div>
                <form id="forms" method="post">        
              <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                <input type="hidden" name="id_test" value="">
                <!-- <input type="hidden" name="pernr" value=""> -->
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" onclick="deletePenilaian()"class="btn btn-outline" id="btndel">Delete</a>
              </div>
                </form>
            </div>
        </div>
</div>

</body>
</html>
  