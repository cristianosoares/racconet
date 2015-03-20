<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
	<div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
      	<button type="submit" form="form-mailsubscribe-draft" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
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
                <label class="control-label" for="input-filter-to"><?php echo $column_to; ?></label>
                <select name="filter_to" id="input-filter-to" class="form-control">
                 <?php if ($filter_to == '') { ?>
						            <option value="" selected="selected"></option>
						            <?php } else { ?>
						            <option value=""></option>
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
              <div class="form-group">
                <label class="control-label" for="input-filter-store"><?php echo $column_store; ?></label>
                <select name="filter_store" id="input-filter-store" class="form-control">
                	<option value=""></option>
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
			<form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-mailsubscribe-draft">
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
							<td class="left">
								<?php if ($sort == 'date') { ?>
								<a href="<?php echo $sort_date; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date; ?></a>
								<?php } else { ?>
								<a href="<?php echo $sort_date; ?>"><?php echo $column_date; ?></a>
								<?php } ?>
							</td>
							<td class="left">
								<?php if ($sort == 'subject') { ?>
								<a href="<?php echo $sort_subject; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_subject; ?></a>
								<?php } else { ?>
								<a href="<?php echo $sort_subject; ?>"><?php echo $column_subject; ?></a>
								<?php } ?>
							</td>
							<td class="left">
								<?php if ($sort == 'to') { ?>
								<a href="<?php echo $sort_to; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_to; ?></a>
								<?php } else { ?>
								<a href="<?php echo $sort_to; ?>"><?php echo $column_to; ?></a>
								<?php } ?>
							</td>
							<td class="right">
								<?php if ($sort == 'store_id') { ?>
								<a href="<?php echo $sort_store; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_store; ?></a>
								<?php } else { ?>
								<a href="<?php echo $sort_store; ?>"><?php echo $column_store; ?></a>
								<?php } ?>
							</td>
							<td class="right"><?php echo $column_actions; ?></td>
						</tr>
					</thead>
					<tbody>
						
					<?php if ($draft) { ?>
						<?php foreach ($draft as $entry) { ?>
						<tr>
							<td style="text-align: center;">
								<?php if ($entry['selected']) { ?>
								<input type="checkbox" name="selected[]" value="<?php echo $entry['draft_id']; ?>" checked="checked" />
								<?php } else { ?>
								<input type="checkbox" name="selected[]" value="<?php echo $entry['draft_id']; ?>" />
								<?php } ?>
							</td>
							<td class="left"><?php echo $entry['datetime']; ?></td>
							<td class="left"><?php echo $entry['subject']; ?></td>
							<td class="left">
					            <?php if ($entry['to'] == 'newsletter') { 
					            	echo $text_newsletter; 
					            } elseif ($entry['to'] == 'customer_all') { 
					            	echo $text_customer_all;
					            } elseif ($entry['to'] == 'customer_group') {
					            	echo $text_customer_group;
					            } elseif ($entry['to'] == 'customer') {
					            	echo $text_customer;
					            } elseif ($entry['to'] == 'affiliate_all') {
					            	echo $text_affiliate_all;
					            } elseif ($entry['to'] == 'affiliate') {
					            	echo $text_affiliate;
					            } elseif ($entry['to'] == 'product') {
					            	echo $text_product;
					            } elseif ($entry['to'] == 'marketing') {
					            	echo $text_marketing;
					            } elseif ($entry['to'] == 'marketing_all') {
									echo $text_marketing_all;
								} elseif ($entry['to'] == 'subscriber') {
									echo $text_subscriber_all;
								} elseif ($entry['to'] == 'all') {
									echo $text_all;
								} elseif (($entry['to'] == 'newsletter_module')) {
									echo $text_newsletter_module;
								} ?>
							</td>
							<td class="right">
								<?php if ($entry['store_id'] == '0') { ?>
									<?php echo $text_default; ?>
								<?php } else { ?>
									<?php foreach ($stores as $store) { ?>
										<?php if ($entry['store_id'] == $store['store_id']) { ?>
											<?php echo $store['name']; ?>
											<?php break; ?>
										<?php } ?>
									<?php } ?>
								<?php } ?>
							</td>
							<td align="right"><a href="<?php echo $detail . $entry['draft_id']; ?>">[<?php echo $text_view; ?>]</a></td>
						</tr>
						<?php } ?>
					<?php } else { ?>
						<tr>
							<td class="center" colspan="6"><?php echo $text_no_results; ?></td>
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
	url = 'index.php?route=sale/mailsubscribe/getlistdraft&token=<?php echo $token; ?>';
	
	var filter_date = $('input[name=\'filter_date\']').val();
	
	if (filter_date) {
		url += '&filter_date=' + encodeURIComponent(filter_date);
	}
	
	var filter_subject = $('input[name=\'filter_subject\']').val();
	
	if (filter_subject) {
		url += '&filter_subject=' + encodeURIComponent(filter_subject);
	}

	var filter_to = $('select[name=\'filter_to\']').val();
	
	if (filter_to) {
		url += '&filter_to=' + encodeURIComponent(filter_to);
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