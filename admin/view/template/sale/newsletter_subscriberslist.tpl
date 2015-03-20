<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
	<div class="page-header">
    <div class="container-fluid">
    		<h1><?php echo $heading_title; ?></h1>
          <ul class="breadcrumb">
            <?php foreach ($breadcrumbs as $breadcrumb) { ?>
            <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
            <?php } ?>
          </ul> 
  </div>
  </div>
  <div class="container-fluid">
  
    <?php if ($error_warning) { ?>
  <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i><?php echo $error_warning; ?>
  <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
  <?php } ?>
  <?php if ($success) { ?>
   <div class="alert alert-success"><i class="fa fa-check-circle"></i><?php echo $success; ?><button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
  <?php } ?>
  

<div class="panel panel-default">

  <div class="panel-heading">
      <i class="fa fa-list"></i><img src="view/image/customer.png" alt="" /> <?php echo $text_edit2; ?>
	    <div class="buttons" style="width: 100%; display: inline-block; position: relative; text-align: right; padding-top: 5px;">
		<a href="<?php echo $synchcustomer; ?>" class="button"><span><?php echo $text_synchcustomer; ?></span></a>
		<a href="<?php echo $pushlist; ?>" class="button"><span><?php echo $text_pushlist; ?></span></a>
        
       
        
		<a href="<?php echo $insert; ?>" ><button class="btn btn-primary" title="<?php echo $button_insert; ?>" data-toggle="tooltip" " type="button" data-original-title="insert"><i class="fa fa-plus-circle"></i></button></a>
        
      
        
		<button class="btn btn-danger" title="<?php echo $button_delete; ?>" data-toggle="tooltip" onclick="document.getElementById('form').submit();"  href="javascript:" type="button" data-original-title="Remove"><i class="fa fa-minus-circle"></i></button>
        
       
        
		<button class="btn btn-default" title="<?php echo $text_import; ?>" data-toggle="tooltip" form="form-backup" type="submit" data-original-title="Backup" onclick="ajax_upload()" href="javascript:"><i class="fa fa-download"></i> </button>
        
        
     
        
	<button class="btn btn-default" title="<?php echo $text_export; ?>" data-toggle="tooltip" form="form-restore" type="submit" data-original-title="Restore" onclick="location = '<?php echo $export; ?>'"  href="javascript:"><i class="fa fa-upload"></i></button>

   
    </div>
  </div>
  <div class="panel-body">
   <div class="well">
          <div class="row">
                <div class="col-sm-4">
                 <div class="form-group">
                <label class="control-label" for="input-email"><?php echo $column_email; ?></label>
                <input type="text" name="filter_email" value="<?php echo $filter_email; ?>" placeholder="<?php echo $column_email; ?>" id="input-email" class="form-control" />
                </div>
      
            </div>
             <div class="col-sm-4">
                
              </div>
             <div class="col-sm-4">
                 <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
              </div>
             </div>
             
            </div>
    <form action="<?php echo $import; ?>" method="post" enctype="multipart/form-data" id="upload_excel_form" >
      <input type="file" name="excel_subscribers" id="excel_subscribers" style="display:none;"  onchange="$('#upload_excel_form').submit();" />
    </form>
    <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form"  style="display: inline-block; width: 100%;">
     <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
            <td class="text-left"><?php echo $column_name; ?></td>
            <td class="text-left"><?php echo $column_email; ?></td>
            <td class="text-left"><?php echo $column_store; ?></td>
            <td class="text-right"><?php echo $column_action; ?></td>
          </tr>
		  
		  
		  
		  
		  
        </thead>
        <tbody>
          <?php if ($emails) { ?>
          <?php foreach ($emails as $email) { ?>
          <tr>
            <td class="text-center">
              <input type="checkbox" name="selected[]" value="<?php echo $email['id']; ?>"/>
             </td>
             <td class="text-left"><?php echo $email['name']; ?></td>
            <td class="text-left"><?php echo $email['email']; ?></td>
            <td class="text-left"><?php echo $email['store_name']; ?></td>
            <td class="text-right"><?php foreach ($email['action'] as $action) { ?>
            
     
            
              <a class="btn btn-primary" title="<?php echo $action['text']; ?>" data-toggle="tooltip" href="<?php echo $action['href']; ?>" data-original-title="Edit"><i class="fa fa-pencil"></i></a> 
              <?php } ?></td>
          </tr>
		  
		  
		  
		  
		  
		  
		  
		  
		  
          <?php } ?>
          <?php } else { ?>
          <tr>
            <td class="center" colspan="5"><?php echo $text_no_results; ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
      </div>
    </form>
  <div class="pagination"><?php echo $pagination; ?></div>
  </div>
</div>

</div>


<script type="text/javascript"><!--
$('#button-filter').on('click', function() {
	url = 'index.php?route=sale/newssubscribers&token=<?php echo $token; ?>';
	
	
	var filter_email = $('input[name=\'filter_email\']').val();
	
	if (filter_email) {
		url += '&filter_email=' + encodeURIComponent(filter_email);
	}
	

				
	location = url;
});
//--></script>
<script language="javascript">
function ajax_upload(){ 
  $('#excel_subscribers').trigger('click');
}
</script>
<style>
.button {
    background: none repeat scroll 0 0 highlight;
    border-radius: 8px;
    color: white;
    cursor: pointer;
    padding: 8px;
}
.button:hover {

    color: white;
	background:yellowgreen;

}
</style></div>
<?php echo $footer; ?>