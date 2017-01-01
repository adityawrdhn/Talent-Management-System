<?php
    $candidate['active'] = 'Dashboard';
    $candidate['ddactive'] = ''; // Current Menu Item
     // Current Menu Item
    include("assets/pages/bg_top.php");
    include("assets/pages/bg_topindex.php");
    include("assets/pages/bg_menuadmin.php");
?>

	<div class="content-wrapper">
  	    <section class="content-header">
	      <h1>
	        Dashboard
	        <small>Control panel</small>
	      </h1>
	      <ol class="breadcrumb">
	        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	        <li class="active">Dashboard</li>
	      </ol>
	    </section>
   		<section class="content">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 connectedSortable">
                <?php echo $this->session->flashdata('sukses'); ?>
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#data-chart" data-toggle="tab"><i class="fa fa-area-chart"></i>Data Graphic</a></li>
                            <li><a href="#table-data" data-toggle="tab"><i class="fa fa-table"></i>Data Table</a></li>
                        <li class="pull-right header"><i class="fa fa-th-large"></i> Talent Pool</li>
                        </ul>
                        <div class="tab-content no-padding">
                          <div class="chart tab-pane active" id="data-chart" style="position: relative;">
                            <div class="col-lg-9 col-sm-12 col-xs-12">    
                                <div id ="mygraph"></div>
                            </div>    
                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                <h4 style="align:center;">Value of Standard</h4>
                                <form name="form1" id="form1" method="post" action="<?php echo base_url()?>admin/savestd">
                                    <div class="form-group">
                                        <div class="input-group">
                                          <div class="input-group-addon bg-yellow progress-bar-striped" style="Width:50%;">
                                            POTENCY
                                          </div>
                                          <input type="number" id="valuec" name="valuec" value="<?php echo $colstd;?>" class="form-control" required/>
                                        </div>
                                      <div class="progress" style="height:8px;">
                                          <div class="progress-bar progress-bar-warning progress-bar-striped active" style="width:<?php echo $colstd;?>%"></div>
                                      </div>

                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="input-group">
                                          <div class="input-group-addon bg-blue progress-bar-striped" style="Width:50%;">
                                            PERFORMANCE
                                          </div>
                                          <input type="number" id="valuep" name="valuep" value="<?php echo $rowstd;?>" class="form-control" required/>
                                          
                                    
                                        </div>
                                      <div class="progress" style="height:8px;">
                                          <div class="progress-bar progress-bar-striped active" style="width:<?php echo $rowstd;?>%"></div>
                                      </div>
                                    </div>
                                    
                                   
                                    <button type="submit" id="submit" name="submit" class="btn btn-block btn-primary btn-flat" style="margin-right: 5px; width=200px">
                                        <i class="fa fa-save"></i> Update Standard
                                    </button>
                                </form>
                            </div>
                          </div>
                          <div class="chart tab-pane" id="table-data" style="position: relative; ">
                            <div class="box-body table-responsive">
                                <!-- <button class="btn btn-success" onclick="add_talent_pool()"><i class="fa fa-user-plus"></i> Add talent_pool</button> -->
                				<!-- <button class="btn btn-default" onclick="reload_table()"><i class="fa fa-reload"></i> Reload</button> -->
                                <table id="table" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                <!-- table-bordered table-striped -->
                                    <thead >
                                        <tr style="color:#b8c7ce;background:#2c3b41;">
                                            <th width="10%">ID</th>
                                            <th width="40%">Name</th>
                                            <th width="15%">Potencial</th>
                                            <th width="15%">Performances</th>
                                            <th width="10%">Grade</th>
                                            <th width="10%">Action
                                                <!-- <div class="btn-group btn-block">
                                                    <label id="EditTriger" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>Edit</label>
                                                    <label data-toggle="modal" id="ModalDelete" class="btn btn-danger btn-xs" data-target="#ModalDelete"><i class="fa fa-trash"></i>Delete</label>
                                                </div>   -->                    
                                            </th>
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
        </div>
    
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0.1
        </div>
        <strong>Copyright &copy; 2015-2016 <a href="http://www.instagram.com/adityawrdhn">TMS - Aditya Wardhana</a>.</strong> All rights reserved.
        </br>
        Halaman ini dimuat selama <strong>{elapsed_time}</strong> detik

     </footer>

        
	
	<!-- <div class="control-sidebar-bg"></div> -->

    </div>
	

    <!-- jQuery UI 1.11.4 -->
    <script src="<?php echo base_url('assets/plugins/jQuery/jQuery-2.2.3.min.js'); ?>"></script>
    
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
    <!-- Morris.js charts -->
    <!-- 

    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
     -->
    <script src="<?php echo base_url('assets/plugins/morris/morris.min.js'); ?>"></script>
    <!-- Sparkline -->
    <script src="<?php echo base_url('assets/plugins/sparkline/jquery.sparkline.min.js'); ?>"></script>
    <!-- jvectormap -->
    <script src="<?php echo base_url('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'); ?>"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?php echo base_url('assets/plugins/knob/jquery.knob.js'); ?>"></script>
    <!-- daterangepicker -->
    <!-- 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
     -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>

    <script src="<?php echo base_url('assets/plugins/daterangepicker/daterangepicker.js'); ?>"></script>
    <!-- datepicker -->
    <script src="<?php echo base_url('assets/plugins/datepicker/bootstrap-datepicker.js'); ?>"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?php echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'); ?>"></script>
    <!-- Slimscroll -->
    <script src="<?php echo base_url('assets/plugins/slimScroll/jquery.slimscroll.min.js');?>"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url('assets/plugins/fastclick/fastclick.min.js');?>"></script>
    <!-- AdminLTE App -->

    <script src="<?php echo base_url('assets/dist/js/app.min.js');?>"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url('assets/dist/js/demo.js'); ?>"></script>
    <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
    <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js')?>"></script>
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
            // Load data for the table's content from an Ajax source
	        "ajax": {
	            "url": "<?php echo site_url('admin/ajax_list')?>",
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
	        orientation: "top auto",
	        todayBtn: true,
	        todayHighlight: true,  
	    });

	});



	function add_talent_pool()
	{
	    save_method = 'add';
	    $('#form')[0].reset(); // reset form on modals
	    $('.form-group').removeClass('has-error'); // clear error class
	    $('.help-block').empty(); // clear error string
	    $('#modal_form').modal('show'); // show bootstrap modal
	    $('.modal-title').text('Add talent_pool'); // Set Title to Bootstrap modal title
	}

	function edit_talent_pool(id)
	{
	    save_method = 'update';
	    $('#form')[0].reset(); // reset form on modals
	    $('.form-group').removeClass('has-error'); // clear error class
	    $('.help-block').empty(); // clear error string

	    //Ajax Load data from ajax
	    $.ajax({
	        url : "<?php echo base_url('admin/ajax_edit')?>/" + id,
	        type: "GET",
	        dataType: "JSON",
	        success: function(data)
	        {

            $('[name="pernr"]').val(data.pernr);
            $('[name="name"]').val(data.name);
            $('[name="value1"]').val(data.key_potency_indicator);
            $('[name="value2"]').val(data.key_performance_indicator);
            // $('[name="quadran"]').val(data.quadran);
            // $('[name="dob"]').datepicker('update',data.dob);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Person'); // Set title to Bootstrap modal title

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
	        url = "<?php echo site_url('admin/ajax_add')?>";
	    } else {
	        url = "<?php echo site_url('admin/ajax_update')?>";
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

	function delete_talent_pool(id)
	{
	    if(confirm('Are you sure delete this data?'))
	    {
	        // ajax delete data to database
	        $.ajax({
	            url : "<?php echo site_url('admin/ajax_delete')?>/"+id,
	            type: "POST",
	            dataType: "JSON",
	            success: function(data)
	            {
	                //if success reload ajax table
	                $('#modal_form').modal('hide');
	                reload_table();
	            },
	            error: function (jqXHR, textStatus, errorThrown)
	            {
	                alert('Error deleting data');
	            }
	        });

	    }
	}

	</script>
   <div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">talent_pool Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <!-- <input type="hidden" value="" name="id"/>  -->
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">ID</label>
                            <div class="col-md-9">
                                <input name="pernr" placeholder="ID Number" class="form-control" type="text"  readonly="true">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">NAME</label>
                            <div class="col-md-9">
                                <input name="name" placeholder="Name" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">COMPETENCY</label>
                            <div class="col-md-9">
                                <input name="value1" placeholder="Competency" class="form-control" type="number">
                                <!-- <textarea name="address" placeholder="Address" class="form-control"></textarea> -->
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">PERFORMANCE</label>
                            <div class="col-md-9">
                                <input name="value2" placeholder="Performance" class="form-control" type="number">
                                <!-- <input name="dob" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text"> -->
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div> 

</body>
</html>
  