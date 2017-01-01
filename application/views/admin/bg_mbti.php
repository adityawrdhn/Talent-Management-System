<?php
    $candidate['active'] = 'mbti'; // Current Menu Item
    $candidate['ddactive'] = ''; // Current Menu Item
    include("assets/pages/bg_top.php");
    // include("assets/pages/bg_topindex.php");
    include("assets/pages/bg_menuadmin.php");
?>
	<div class="content-wrapper">
  	    <section class="content-header">
	      <h1>
	        Psichology Test:
	        <small>Myers-Briggs Type Indicators</small>
	      </h1>
	      <ol class="breadcrumb">
	        <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
            <li><a href="#">Psichology Test</a></li>
            <!-- <li class="active">Master Data</li> -->
	      </ol>
	    </section>
   		<section class="content">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 connectedSortable">
                <?php echo $this->session->flashdata('sukses'); ?>
                    <?php 
                        foreach ($hasilpribadi->result() as $row) {
                    ?> 
                    <div class="small-box bg-aqua">
                        <div class="inner">
                          <h3><?php echo "$row->TIPE"?></h3>

                          <p>Type</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-user"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                          More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                      </div>
                    <?php }?>
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#table-data" data-toggle="tab"><i class="fa fa-table"></i>Question Data</a></li>
                            <li><a href="#test-data" data-toggle="tab"><i class="fa fa-table"></i>Test Data</a></li>
                            <li><a href="#my-test-data" data-toggle="tab"><i class="fa fa-user"></i>My Test Data</a></li>
                            <li class="pull-right header"><i class="fa fa-th-large"></i> Employee Table</li>
                        </ul>
                        <div class="tab-content no-padding">
                          <div class="chart tab-pane active" id="table-data" style="position: relative; ">
                            <div class="box-body table-responsive">
                                <table id="table" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" scrollX="true">
                                    <thead >
                                        <tr style="color:#2c3b41;background:#b8c7ce;">
                                            <th>ID</th>
                                            <th>Answer A</th>
                                            <th>Answer B</th>
                                            <th>Type A</th>
                                            <th>Type B</th>
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
                                <table id="table-test" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" scrollX="true">
                                    <thead >
                                        <tr style="color:#2c3b41;background:#b8c7ce;">
                                            <th>ID Test</th>
                                            <th>Pernr</th>
                                            <th>Name</th>
                                            <th>Tipe</th>
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
                                <table id="table-test" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" scrollX="true">
                                    <thead >
                                        <tr style="color:#2c3b41;background:#b8c7ce;">
                                            <th>ID Test</th>
                                            <th>Pernr</th>
                                            <th>Name</th>
                                            <th>Tipe</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                    foreach ($hasilpribadi->result() as $row) {
                                ?> 
                                
                                    <tr>
                                        <td><?php echo "$row->ID_TEST"; ?></td>
                                        <td><?php echo "$row->PERNR"; ?></td>
                                        <td><?php echo $this->session->userdata('name'); ?></td>
                                        <td><?php echo "$row->TIPE"; ?></td>
                                        <td><a class="btn btn-sm btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="deleteFormTest(<?php echo "$row->ID_TEST"; ?>)"><i class="glyphicon glyphicon-trash"></i></a></td>
                                        
                                    </tr>
                                <?php
                                    }
                                    ?>  
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
	            "url": "<?php echo site_url('mbti/ajax_list_soal')?>",
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
	        url : "<?php echo base_url('MBTI/ajax_edit_soal')?>/" + id,
	        type: "GET",
	        dataType: "JSON",
	        success: function(data)
	        {
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Employee'); // Set title to Bootstrap modal title

            $('[name="id_soal"]').val(data.ID_SOAL);
            $('[name="jawaban_a"]').val(data.JAWABAN_A);
            $('[name="jawaban_b"]').val(data.JAWABAN_B);
            $('[name="tipe_a"]').val(data.TIPE_A);
            $('[name="tipe_b"]').val(data.TIPE_B);
            
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
            url = "<?php echo site_url('mbti/ajax_add_soal')?>";
        } else {
            url = "<?php echo site_url('mbti/ajax_update_soal')?>";
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
    function deleteFormSoal(id)
	{
	        // ajax delete data to database
            $.ajax({
            url : "<?php echo base_url('mbti/ajax_edit_soal')?>/"+id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('#ModalDelete').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Are you sure to delete this data?');
                $('.modal-title2').val(data.ID_SOAL);
                $('[name="id_soal"]').val(data.ID_SOAL); // Set title to Bootstrap modal title
    	    },
	        error: function (jqXHR, textStatus, errorThrown)
	            {
	                alert('Error deleting data');
	            }
	        });
	}
    function deleteSoal()
    {
        $('#btndel').text('deleting...'); //change button text
        $('#btndel').attr('disabled',true); //set button disable 
        var url;
        $.ajax({
            url : "<?php echo base_url('mbti/ajax_delete_soal')?>",
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
        table = $('#table-test').DataTable({ 
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [],
            "autoWidth":false,
            "aLengthMenu": [[20, 40, 60, -1], [20, 40, 60, "All"]],
            "iDisplayLength": 20, // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('mbti/ajax_list_test')?>",
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

    // function editForm(id)
    // {
    //     save_method = 'update';
    //     $('#form')[0].reset(); // reset form on modals
    //     $('.form-group').removeClass('has-error'); // clear error class
    //     $('.help-block').empty(); // clear error string

    //     //Ajax Load data from ajax
    //     $.ajax({
    //         url : "<?php echo base_url('MBTI/ajax_edit_test')?>/" + id,
    //         type: "GET",
    //         dataType: "JSON",
    //         success: function(data)
    //         {
    //         $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
    //         $('.modal-title').text('Edit Employee'); // Set title to Bootstrap modal title

    //         $('[name="id_test"]').val(data.ID_TEST);
    //         $('[name="pernr"]').val(data.PERNR);
    //         $('[name="name"]').val(data.NAME);
    //         $('[name="tipe"]').val(data.TIPE);
    //         // $('[name="tipe_b"]').val(data.TIPE_B);
            
    //         },
    //         error: function (jqXHR, textStatus, errorThrown)
    //         {
    //             alert('Error get data from ajax');
    //         }
    //     });
        
    // }

    function reload_table()
    {
        window.location.reload(null,false); //reload datatable ajax 
    }
    function deleteFormTest(id)
    {
            // ajax delete data to database
            $.ajax({
            url : "<?php echo base_url('mbti/ajax_edit_test')?>/"+id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('#ModalDeleteTest').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Are you sure to delete this data?');
                // $('.modal-title').val(data.TIPE);
                
                $('[name="id_test"]').val(data.ID_TEST); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error deleting data');
                }
            });
    }
    function deleteTest()
    {
        $('#btndel').text('deleting...'); //change button text
        $('#btndel').attr('disabled',true); //set button disable 
        var url;
        $.ajax({
            url : "<?php echo base_url('mbti/ajax_delete_test')?>",
            type: "POST",
            data: $('#forms').serialize(),
            dataType: "JSON",
            success: function(data)
            {

                if(data.status) //if success close modal and reload ajax table
                {
                    $('#ModalDeleteTest').modal('hide');
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
                <h3 class="modal-title">FORM SOAL MBTI </h3>
            </div>
            <form action="#" id="form" class="form-horizontal">
                
            <!-- <form id="form" method="post" action="<?php echo base_url(); ?>mbti/savesoalmbti" class="form-horizontal"> -->
                <div class="modal-body">
                    <div class="col-md-12">   
                            
                            <div class="form-group">
                                <label>ID_Soal</label>
                                
                                    <input type="text" class="form-control" name="id_soal" value="" class="uneditable-input" readonly="true">
                                
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
                                <label>Tipe A</label>
                                    <input type="text" class="form-control" name="tipe_a" value="">
                            </div>
                            <div class="form-group">
                                <label>Tipe A</label>
                                    <input type="text" class="form-control" name="tipe_b" value="">
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
                <h4 class="modal-title" style="text-align:center;"></h4>
              </div>
                <form id="form" method="post">        
              <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                <input type="hidden" name="id_soal" value="">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" onclick="deleteSoal()"class="btn btn-outline" id="btndel">Delete</a>
              </div>
                </form>
            </div>
        </div>
</div>
<div class="modal modal-danger fade" id="ModalDeleteTest" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:100px;">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" style="text-align:center;"></h4>
              </div>
                <form id="forms" method="post">        
              <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                <input type="hidden" name="id_test" value="">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" onclick="deleteTest()"class="btn btn-outline" id="btndel">Delete</a>
              </div>
                </form>
            </div>
        </div>
</div>
</body>
</html>
  