<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
      <a href="<?php echo $insert; ?>" data-toggle="tooltip" title="<?php echo $button_insert; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
      	<button type="submit" form="form-mailsubscribe-history" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
       </div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
<div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list-ol"></i> <?php echo $heading_title; ?></h3>
      </div>
      <div class="panel-body">
    <div class="well">
         <div class="row">
          <div class="col-sm-4">
          <div class="form-group">
                <label class="control-label" for="input-date"><?php echo $column_date; ?></label>
                <div class="input-group date">
                  <input type="text" name="filter_date" value="<?php echo $filter_date; ?>" placeholder="<?php echo $column_date; ?>" data-format="YYYY-MM-DD" id="input-date-modified" class="form-control" /><span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span></div>
              </div>
          <div class="form-group">
                <label class="control-label" for="input-subject"><?php echo $column_subject; ?></label>
                  <input type="text" name="filter_subject" value="<?php echo $filter_subject; ?>" placeholder="<?php echo $column_subject; ?>" id="input-subject" class="form-control" />
              </div>
          </div>
         <div class="col-sm-4">
          <div class="form-group">
                <label class="control-label" for="input-filter-store"><?php echo $column_store; ?></label>
                <select name="filter_store" id="input-filter-store" class="form-control">
                	<option value="*"></option>
                    <?php if ($filter_store == '0') { ?>
                    <option value="0" selected="selected"><?php echo $text_default; ?></option>
                    <?php } else { ?>
                    <option value="0"><?php echo $text_default; ?></option>
                    <?php } ?>
                    <?php foreach ($stores as $store) { ?>
                        <?php if ($filter_store == $store['store_id']) { ?>
                        <option value="<?php echo $store['store_id']; ?>" selected="selected"><?php echo $store['name']; ?></option>
                        <?php } else { ?>
                        <option value="<?php echo $store['store_id']; ?>"><?php echo $store['name']; ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
              </div>
          </div>
          <div class="col-sm-4">
           <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button> 
          </div>
         </div>
       </div>
    <div class="table-responsive">
	   <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-mailsubscribe-history">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
              <td class="left">
                    <?php if ($sort == 'mh.datetime') { ?>
                    <a href="<?php echo $sort_date; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_date; ?>"><?php echo $column_date; ?></a>
                    <?php } ?>
                </td>
              <td class="left">
                    <?php if ($sort == 'mh.subject') { ?>
                    <a href="<?php echo $sort_subject; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_subject; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_subject; ?>"><?php echo $column_subject; ?></a>
                    <?php } ?>
                </td>
              <td class="right">
                    <?php if ($sort == 'ms.queue') { ?>
                    <a href="<?php echo $sort_recipients; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_recipients; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_recipients; ?>"><?php echo $column_recipients; ?></a>
                    <?php } ?>
                </td>
                <td class="right">
                    <?php if ($sort == 'ms.views') { ?>
                    <a href="<?php echo $sort_views; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_views; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_views; ?>"><?php echo $column_views; ?></a>
                    <?php } ?>
                </td>
                 <td class="right">
                    <?php if ($sort == 'ms.failed') { ?>
                    <a href="<?php echo $sort_failed; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_failed; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_failed; ?>"><?php echo $column_failed; ?></a>
                    <?php } ?>
                </td>
                <td class="right">
                    <?php if ($sort == 'mh.store_id') { ?>
                    <a href="<?php echo $sort_store; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_store; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_store; ?>"><?php echo $column_store; ?></a>
                    <?php } ?>
                </td>
              <td class="right"><?php echo $column_actions; ?></td>
            </tr>
          </thead>
          <tbody>
          
            <?php if ($newsletter_history) { ?>
            <?php foreach ($newsletter_history as $history) { ?>
            <tr>
              <td style="text-align: center;"><?php if ($history['selected']) { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $history['history_id']; ?>" checked="checked" />
                <?php } else { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $history['history_id']; ?>" />
                <?php } ?></td>
                <td class="left"><?php echo $history['datetime']; ?></td>
              <td class="left">
              	<?php if ($history['store_id'] == '0') { ?>
                        <a href="<?php echo $store_url . $view_url . $history['history_id'] ?>" target="_blank"><?php echo $history['subject']; ?></a>
                    <?php } else { ?>
                        <?php foreach ($stores as $store) { ?>
                            <?php if ($history['store_id'] == $store['store_id']) { ?>
                                <?php echo $store['name']; ?>
                                <a href="<?php echo rtrim($store['url'], '/') . '/' . $view_url . $history['history_id'] ?>" target="_blank"><?php echo $history['subject']; ?></a>
                                <?php break; ?>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
             </td>
             
             
              <td class="right"><?php echo $history['recipients']; ?></td>
              <td class="right"><?php echo $history['views']; ?></td>
              <td class="right"><?php echo $history['failed']; ?></td>
              <td class="left">
              <?php if($history['store_id'] == 0) {?>
              		<?php echo $text_default; ?>
              <?php } ?>
              <?php foreach ($stores as $store) { ?>
              	<?php if($store['store_id'] == $history['store_id']) {?>
              		<?php echo $store['name']; ?>
                <?php } ?>
			 <?php } ?>
              </td>
              <td class="right">
              
                <!--[ <a href="<?php echo $history['href']; ?>"><?php echo $history['text']; ?></a> ]-->
                
                </td>
            </tr>
            <?php } ?>
            <?php } else { ?>
            <tr>
              <td class="center" colspan="9"><?php echo $text_no_results; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </form>
      <div class="row">
              <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
              <div class="col-sm-6 text-right"><?php echo $results; ?></div>
        	</div>
	</div>
  </div>
 </div>
</div>

<script type="text/javascript"><!--
$('#button-filter').on('click', function() {
	url = 'index.php?route=sale/mailsubscribe_historystat&token=<?php echo $token; ?>';
	
	var filter_date = $('input[name=\'filter_date\']').val();
	
	if (filter_date) {
		url += '&filter_date=' + encodeURIComponent(filter_date);
	}
	
	var filter_subject = $('input[name=\'filter_subject\']').val();
	
	if (filter_subject) {
		url += '&filter_subject=' + encodeURIComponent(filter_subject);
	}

	var filter_store = $('select[name=\'filter_store\']').val();
	
	if (filter_store) {
		url += '&filter_store=' + encodeURIComponent(filter_store);
	}
	
	location = url;
});
//--></script>
 <script src="view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
  <link href="view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css" type="text/css" rel="stylesheet" media="screen" />
  <script type="text/javascript"><!--
$('.date').datetimepicker({
	pickTime: false
});
//--></script> 

</div>
<?php echo $footer; ?>