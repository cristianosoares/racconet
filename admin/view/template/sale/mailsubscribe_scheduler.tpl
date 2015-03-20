<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
      <a href="<?php echo $insert; ?>" data-toggle="tooltip" title="<?php echo $button_insert; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
      	<button type="submit" form="form-mailsubscribe-schedular" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
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
                <label class="control-label" for="input-name"><?php echo $column_name; ?></label>
                  <input type="text" name="filter_name" value="<?php echo $filter_name; ?>" placeholder="<?php echo $column_name; ?>" id="input-name" class="form-control" />
              </div> 
              <div class="form-group">
                <label class="control-label" for="input-filter-to"><?php echo $column_to; ?></label>
                <select name="filter_to" id="input-filter-to" class="form-control">
                 <?php if ($filter_to == '') { ?>
						            <option value="*" selected="selected"></option>
						            <?php } else { ?>
						            <option value="*"></option>
						            <?php } ?>
						            <?php if ($filter_to == 'newsletter') { ?>
						            <option value="newsletter" selected="selected"><?php echo $text_newsletter; ?></option>
						            <?php } else { ?>
						            <option value="newsletter"><?php echo $text_newsletter; ?></option>
						            <?php } ?>
						            <?php if ($filter_to == 'customer_all') { ?>
						            <option value="customer_all" selected="selected"><?php echo $text_customer_all; ?></option>
						            <?php } else { ?>
						            <option value="customer_all"><?php echo $text_customer_all; ?></option>
						            <?php } ?>
						            <?php if ($filter_to == 'customer_group') { ?>
						            <option value="customer_group" selected="selected"><?php echo $text_customer_group; ?></option>
						            <?php } else { ?>
						            <option value="customer_group"><?php echo $text_customer_group; ?></option>
						            <?php } ?>
						            <?php if ($filter_to == 'customer') { ?>
						            <option value="customer" selected="selected"><?php echo $text_customer; ?></option>
						            <?php } else { ?>
						            <option value="customer"><?php echo $text_customer; ?></option>
						            <?php } ?>
						            <?php if ($filter_to == 'affiliate_all') { ?>
						            <option value="affiliate_all" selected="selected"><?php echo $text_affiliate_all; ?></option>
						            <?php } else { ?>
						            <option value="affiliate_all"><?php echo $text_affiliate_all; ?></option>
						            <?php } ?>
						            <?php if ($filter_to == 'affiliate') { ?>
						            <option value="affiliate" selected="selected"><?php echo $text_affiliate; ?></option>
						            <?php } else { ?>
						            <option value="affiliate"><?php echo $text_affiliate; ?></option>
						            <?php } ?>
						            <?php if ($filter_to == 'product') { ?>
						            <option value="product" selected="selected"><?php echo $text_product; ?></option>
						            <?php } else { ?>
						            <option value="product"><?php echo $text_product; ?></option>
						            <?php } ?>
									
										<?php if ($filter_to == 'newsletter_module') { ?>
										<option value="newsletter_module" selected="selected"><?php echo $text_newsletter_module; ?></option>
										<?php } else { ?>
										<option value="newsletter_module"><?php echo $text_newsletter_module; ?></option>
										<?php } ?>
                </select>
              </div>
            </div>
           
              <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-filter-active"><?php echo $column_active; ?></label>
                <select name="filter_active" id="input-filter-active" class="form-control">
                  <option value="*"></option>
                  <?php if ($filter_active == '1') { ?>
                  <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_yes; ?></option>
                  <?php } ?>
                   <?php if ($filter_active == '0') { ?>
                  <option value="0" selected="selected"><?php echo $text_no; ?></option>
                  <?php } else { ?>
                  <option value="0"><?php echo $text_no; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label class="control-label" for="input-filter-recurring"><?php echo $column_recurring; ?></label>
                <select name="filter_recurrent" id="input-filter-recurring" class="form-control">
                	 <option value="*"></option>
                  <?php if ($filter_recurrent == '1') { ?>
                  <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_yes; ?></option>
                  <?php } ?>
                   <?php if ($filter_recurrent == '0') { ?>
                  <option value="0" selected="selected"><?php echo $text_no; ?></option>
                  <?php } else { ?>
                  <option value="0"><?php echo $text_no; ?></option>
                  <?php } ?>
                </select>
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
           <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button> 
            </div>
         </div>
     </div>
    <div class="table-responsive">
	   <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-mailsubscribe-schedular">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
              <td class="left"><?php echo $column_name; ?></td>
              <td class="left"><?php echo $column_to; ?></td>
              <td class="left"><?php echo $column_active; ?></td>
              <td class="left"><?php echo $column_recurring; ?></td>
              <td class="left"><?php echo $column_store; ?></td>
              <td class="right"><?php echo $column_action; ?></td>
            </tr>
          </thead>
          <tbody>
          	
            <?php if ($schedules) { ?>
            <?php foreach ($schedules as $schedule) { ?>
            <tr>
              <td style="text-align: center;"><?php if ($schedule['selected']) { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $schedule['schedule_id']; ?>" checked="checked" />
                <?php } else { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $schedule['schedule_id']; ?>" />
                <?php } ?></td>
              <td class="left"><?php echo $schedule['name']; ?></td>
              <td class="left"> <?php if ($schedule['to'] == 'newsletter') { 
					            	echo $text_newsletter; 
					            } elseif ($schedule['to'] == 'customer_all') { 
					            	echo $text_customer_all;
					            } elseif ($schedule['to'] == 'customer_group') {
					            	echo $text_customer_group;
					            } elseif ($schedule['to'] == 'customer') {
					            	echo $text_customer;
					            } elseif ($schedule['to'] == 'affiliate_all') {
					            	echo $text_affiliate_all;
					            } elseif ($schedule['to'] == 'affiliate') {
					            	echo $text_affiliate;
					            } elseif ($schedule['to'] == 'product') {
					            	echo $text_product;
								} elseif (($schedule['to'] == 'newsletter_module')) {
									echo $text_newsletter_module;
								} ?></td>
              <td class="left"><?php echo $schedule['active']; ?></td>
              <td class="left"><?php echo $schedule['recurrent']; ?></td>
              <td class="left">
              <?php if ($schedule['store_id'] == '0') { ?>
									<?php echo $text_default; ?>
								<?php } else { ?>
									<?php foreach ($stores as $store) { ?>
										<?php if ($schedule['store_id'] == $store['store_id']) { ?>
											<?php echo $store['name']; ?>
											<?php break; ?>
										<?php } ?>
									<?php } ?>
								<?php } ?>
              </td>
              <td class="right"><?php foreach ($schedule['action'] as $action) { ?>
                [ <a href="<?php echo $action['href']; ?>"><?php echo $action['text']; ?></a> ]
                <?php } ?>
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
	url = 'index.php?route=sale/mailsubscribe_scheduler&token=<?php echo $token; ?>';
	
	var filter_name = $('input[name=\'filter_name\']').val();
	
	if (filter_name) {
		url += '&filter_name=' + encodeURIComponent(filter_name);
	}
	
	var filter_to = $('select[name=\'filter_to\']').val();
	
	if (filter_to != '*') {
		url += '&filter_to=' + encodeURIComponent(filter_to);
	}
	
	var filter_active = $('select[name=\'filter_active\']').val();
	
	if (filter_active != '*') {
		url += '&filter_active=' + encodeURIComponent(filter_active);
	}	

	var filter_recurrent = $('select[name=\'filter_recurrent\']').val();

	if (filter_recurrent != '*') {
		url += '&filter_recurrent=' + encodeURIComponent(filter_recurrent);
	}	
	
	var filter_store = $('select[name=\'filter_store\']').val();
	
	if (filter_store != '*') {
		url += '&filter_store=' + encodeURIComponent(filter_store);
	}
			
	location = url;
});
//--></script> 

</div>
<?php echo $footer; ?>