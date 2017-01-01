<?php
    $candidate['active'] = 'Master Data'; // Current Menu Item
    $candidate['ddactive'] = 'Organization Unit'; // Current Menu Item
    include("assets/pages/bg_top.php");
    // include("assets/pages/bg_topindex.php");
    include("assets/pages/bg_menuadmin.php");
?>
	<div class="content-wrapper">
  	    <section class="content-header">
	      <h1>
	        Master Data
	        <small>Organization Unit</small>
	      </h1>
	      <ol class="breadcrumb">
	        <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
	        <li class="active">Master Data</li>
            <li class="active">Organization Unit</li>
          </ol>
	    </section>
   		<section class="content">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 connectedSortable">
                <?php echo $this->session->flashdata('sukses'); ?>
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#table-data" data-toggle="tab"><i class="fa fa-table"></i>Data Table</a></li>
                            <li><a href="#add-data" onclick="add_data()" data-toggle="tab"><i class="fa fa-plus"></i>Add Organization Unit</a></li>
                            <li class="pull-right header"><i class="fa fa-th-large"></i> Employee Table</li>
                        </ul>
                        <div class="tab-content no-padding">
                          <div class="chart tab-pane active" id="table-data" style="position: relative; ">
                            
                            <div class="box-body table-responsive">
                                <!-- <button class="btn btn-success" onclick="add_data()"><i class="fa fa-user-plus"></i> Add employee</button> -->
                				<!-- <button class="btn btn-default" onclick="reload_table()"><i class="fa fa-refresh"></i> Reload</button> -->
                                <table id="table" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" scrollX="true">
                                <!-- table-bordered table-striped -->
                                    <thead >
                                        <tr style="color:#b8c7ce;background:#2c3b41;">
                                            <th>ID Organization Unit</th>
                                            <th>Name Organization Unit</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                              <!-- </div> -->

                            </div>
                          </div>
                          <div class="chart tab-pane" id="add-data" style="position: relative; ">
                            <form method="post" action="<?php echo base_url(); ?>MasterData/saveEmorgunit" id="formadd">
                              <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>ID Organization Unit</label>
                                            <input type="text" class="form-control" name="orguid" value="<?php echo $getid;?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Name Organization Unit</label>
                                            <input type="text" class="form-control" name="org_text" placeholder="Name Organization Unit...">
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

        
	
	<!--footer -->

    </div>
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
            // Load data for the table's content from an Ajax source
	        "ajax": {
	            "url": "<?php echo site_url('MasterData/ajax_list_Emorgunit')?>",
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



	function add_data()
	{
	    save_method = 'add';
	    $('#formadd')[0].reset(); // reset form on modals
	}

	function editForm(id)
	{
	    save_method = 'update';
	    $('#form')[0].reset(); // reset form on modals
	    $('.form-group').removeClass('has-error'); // clear error class
	    $('.help-block').empty(); // clear error string

	    //Ajax Load data from ajax
	    $.ajax({
	        url : "<?php echo base_url('MasterData/ajax_edit_Emorgunit')?>/" + id,
	        type: "GET",
	        dataType: "JSON",
	        success: function(data)
	        {
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Data'); // Set title to Bootstrap modal title

            $('[name="orguid"]').val(data.orguid);
            $('[name="org_text"]').val(data.org_text);
            
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
	function deleteForm(id)
	{
	        // ajax delete data to database
            $.ajax({
            url : "<?php echo base_url('MasterData/ajax_edit_Emorgunit')?>/"+id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('#ModalDelete').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Are you sure to delete this data?');
                // $('.modal-title2').val(data.name);
                $('[name="orguid"]').val(data.orguid); // Set title to Bootstrap modal title
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
            url : "<?php echo base_url('MasterData/ajax_delete_Emorgunit')?>",
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
                $('#ModalError').modal('show');
                $('.modal-title-error').text("You can't delete this data! If you want to delete this data, you must change/delete Organization Unit ID in employee table");
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">employee Form</h3>
            </div>
            <form id="form" method="post" action="<?php echo base_url(); ?>MasterData/saveEmorgunit" class="form-horizontal">
                <div class="modal-body">
                            
                            <div class="form-group">
                                <label class="control-label col-md-3">ID Organization Unit</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="orguid" value="" class="uneditable-input" readonly="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Name Organization Unit</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="org_text" value="">
                                </div>
                            </div>
                        <!-- </div> -->
                    <input type="hidden" name="stts" value="edit">
                     <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="edit"class="btn btn-primary pull-right">Save</button>
                   
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
                <input type="hidden" name="pernr" value="">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" onclick="deleteEmp()"class="btn btn-outline" id="btndel">Delete</a>
              </div>
                </form>
            </div>
        </div>
</div>
<div class="modal modal-danger fade" id="ModalError" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:100px;">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title-error" style="text-align:center;"><strong class="modal-title2"></strong></h4>
              </div>
                <!-- <form id="form" method="post">         -->
              <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                <!-- <input type="hidden" name="pernr" value=""> -->
                <button type="button" class="btn btn-outline" data-dismiss="modal">OK</button>
                <!-- <button type="button" onclick="deleteEmp()"class="btn btn-outline" id="btndel">Delete</a> -->
              </div>
                <!-- </form> -->
            </div>
        </div>
</div>
</body>
</html>
  