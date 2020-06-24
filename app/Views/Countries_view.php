<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Countries</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  </head>
  <body>
 
 
  <div class="container">
    
</center>
    <h3>Countries</h3>
    <br />
    <button class="btn btn-success" onclick="add_country()"><i class="glyphicon glyphicon-plus"></i> Add Country</button>
    <br />
    <br />
    <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
                    <th>Country ID</th>
                    <th>Country Code</th>
                    <th>Country name</th>
                    
          <th style="width:125px;"> Action </th>
        </tr>
      </thead>
      <tbody>
                <?php foreach($countries as $country){?>
                     <tr>
                         <td><?php echo $country->country_id;?></td>
                         <td><?php echo $country->country_code;?></td>
                                 <td><?php echo $country->country_name;?></td>
                                <td>
                                    <button class="btn btn-warning" onclick="edit_country(<?php echo $country->country_id;?>)">Edit</button>
                                    <button class="btn btn-danger" onclick="delete_country(<?php echo $country->country_id;?>)">Delete</button>
 
 
                                </td>
                      </tr>
                     <?php }?>
 
 
 
      </tbody>
 
      <tfoot>
        <tr>
          <th>Country ID</th>
          <th>Country Code</th>
          <th>Country Name</th>
          <th>Action</th>
        </tr>
      </tfoot>
    </table>
 
  </div>
 
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
 
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
 
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
 
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" type="text/javascript"></script>
 
 
 
  <script type="text/javascript">
  $(document).ready( function () {
      $('#table_id').DataTable();
  } );
    var save_method; //for save method string
    var table;
 
 
    function add_country()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
    //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
    }
 
    function edit_country(id)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals
      <?php header('Content-type: application/json'); ?>
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('public/index.php/book/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            console.log(data);
 
            $('[name="country_id"]').val(data.country_id);
            $('[name="country_code"]').val(data.country_code);
            $('[name="country_name"]').val(data.country_name);
            
 
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Country'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            console.log(jqXHR);
            alert('Error get data from ajax');
        }
    });
    }
 
 
 
    function save()
    {
      var url;
      if(save_method == 'add')
      {
          url = "<?php echo site_url('public/index.php/Countries/country_add')?>";
      }
      else
      {
        url = "<?php echo site_url('public/index.php/Countries/country_update')?>";
      }
      
       // ajax adding data to database
          $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
               //if success close modal and reload ajax table
               $('#modal_form').modal('hide');
              location.reload();// for reload a page
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
    }
 
    function delete_country(id)
    {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data from database
          $.ajax({
            url : "<?php echo site_url('public/index.php/Countries/country_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                
               location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
 
      }
    }
 
  </script>
 
  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h3 class="modal-title">Country Form</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal">
          <input type="hidden" value="" name="country_id"/>
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">Country Code</label>
              <div class="col-md-9">
                <input name="country_code" placeholder="Country code" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Country name</label>
              <div class="col-md-9">
                <input name="country_name" placeholder="Country Name" class="form-control" type="text">
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
    </div><!-- /.modal -->
  <!-- End Bootstrap modal -->
 
  </body>
</html>