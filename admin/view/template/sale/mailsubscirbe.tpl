<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
       <a onclick="preview();" class="btn btn-primary" title="<?php echo $button_preview; ?>"><i class="fa fa-print"></i></a>
      	<button type="submit" form="form-mailsubscribe" data-toggle="tooltip" title="<?php echo $button_draft; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <button id="button-send" data-loading-text="<?php echo $text_loading; ?>" data-toggle="tooltip" title="<?php echo $button_send; ?>" class="btn btn-primary" onclick="send('index.php?route=sale/mailsubscribe/send&token=<?php echo $token; ?>');"><i class="fa fa-envelope"></i></button>
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
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil-square-o"></i> <?php echo $heading_title; ?></h3>
      </div>
      <div class="panel-body">
        <form class="form-horizontal" id="form-mailsubscribe" action="<?php echo $draft_save; ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
    <input type="hidden" name="attachments_id" value="<?php echo $attachments_id; ?>" />
    <input type="hidden" name="newsletter_id" value="" />
    <input type="hidden" name="sent_count_email" value="" />
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-store"><?php echo $entry_store; ?></label>
            <div class="col-sm-10">
              <select name="store_id" id="input-store" class="form-control">
                <option value="0"><?php echo $text_default; ?></option>
                <?php foreach ($stores as $store) { ?>
                <?php if ($store['store_id'] == $store_id) { ?>
                <option value="<?php echo $store['store_id']; ?>" selected="selected"><?php echo $store['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $store['store_id']; ?>"><?php echo $store['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="inserttemplate"><?php echo $entry_template; ?></label>
            <div class="col-sm-10">
              <select name="inserttemplate" id="inserttemplate" class="form-control">
               <?php foreach($templates as $template){?>
             	<?php if($template['template_id'] == $template_id) { ?>
            		<option value="<?php echo $template['template_id'];?>" selected="selected"><?php echo $template['name'];?></option>
             	<?php } else {?>
                   	<option value="<?php echo $template['template_id'];?>"><?php echo $template['name'];?></option>
                <?php }?>
             <?php }?>
            </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-language_id"><?php echo $entry_language; ?></label>
            <div class="col-sm-10">
              <select name="language_id" id="input-language_id" class="form-control">
               <?php foreach ($languages as $language) { ?>
                   <?php if($language['language_id'] == $language_id) { ?>
                        <option value="<?php echo $language['language_id']; ?>" selected="selected"><?php echo $language['name']; ?></option>
                    <?php } else {?>
                        <option value="<?php echo $language['language_id']; ?>"><?php echo $language['name']; ?></option>
                    <?php } ?>
                <?php } ?>
            </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-currency"><?php echo $entry_currency; ?></label>
            <div class="col-sm-10">
              <select name="currency" id="input-currency" class="form-control">
               <?php foreach ($currencies as $cur) { ?>
                	 <?php if($cur['currency_id'] == $currency) { ?>
                       <option value="<?php echo $cur['currency_id']; ?>" selected="selected"><?php echo $cur['title']; ?></option>
                    <?php } else {?>         
	                	<option value="<?php echo $cur['currency_id']; ?>"><?php echo $cur['title']; ?></option>
                    <?php } ?>
                <?php } ?>
            </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-language_id"></label>
            <p><?php echo $text_clear_warning; ?></p>
          </div>  
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-to"><?php echo $entry_to; ?></label>
            <div class="col-sm-10">
              <select name="to" id="input-to" class="form-control">
               <?php if ($to == 'newsletter') { ?>
                <option value="newsletter" selected="selected"><?php echo $text_newsletter; ?></option>
                <?php } else { ?>
                <option value="newsletter"><?php echo $text_newsletter; ?></option>
                <?php } ?>
                <?php if ($to == 'customer_all') { ?>
                <option value="customer_all" selected="selected"><?php echo $text_customer_all; ?></option>
                <?php } else { ?>
                <option value="customer_all"><?php echo $text_customer_all; ?></option>
                <?php } ?>
                <?php if ($to == 'customer_group') { ?>
                <option value="customer_group" selected="selected"><?php echo $text_customer_group; ?></option>
                <?php } else { ?>
                <option value="customer_group"><?php echo $text_customer_group; ?></option>
                <?php } ?>
                <?php if ($to == 'customer') { ?>
                <option value="customer" selected="selected"><?php echo $text_customer; ?></option>
                <?php } else { ?>
                <option value="customer"><?php echo $text_customer; ?></option>
                <?php } ?>
                <?php if ($to == 'affiliate_all') { ?>
                <option value="affiliate_all" selected="selected"><?php echo $text_affiliate_all; ?></option>
                <?php } else { ?>
                <option value="affiliate_all"><?php echo $text_affiliate_all; ?></option>
                <?php } ?>
                <?php if ($to == 'affiliate') { ?>
                <option value="affiliate" selected="selected"><?php echo $text_affiliate; ?></option>
                <?php } else { ?>
                <option value="affiliate"><?php echo $text_affiliate; ?></option>
                <?php } ?>
                <?php if ($to == 'product') { ?>
                <option value="product" selected="selected"><?php echo $text_product; ?></option>
                <?php } else { ?>
                <option value="product"><?php echo $text_product; ?></option>
                <?php } ?>
				<!--<?php //if($this->config->get('option_unsubscribe')){ ?>
					<?php //if ($to == 'newsletter_module') { ?>
					<option value="newsletter_module" selected="selected"><?php ///echo $text_newsletter_module; ?></option>
					<?php //} else { ?>
					<option value="newsletter_module"><?php //echo $text_newsletter_module; ?></option>
					<?php //} ?>
				<?php //} ?>-->
                <?php if($newslettersubscribe_status) { ?>
					<?php if ($to == 'newsletter_module') { ?>
					<option value="newsletter_module" selected="selected"><?php echo $text_newsletter_module; ?></option>
					<?php } else { ?>
					<option value="newsletter_module"><?php echo $text_newsletter_module; ?></option>
					<?php } ?>
				<?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group to" id="to-customer-group">
            <label class="col-sm-2 control-label" for="input-customer-group"><?php echo $entry_customer_group; ?></label>
            <div class="col-sm-10">
              <select name="customer_group_id" id="input-customer-group" class="form-control">
                 <?php foreach ($customer_groups as $customer_group) { ?>
                  <?php if ($customer_group['customer_group_id'] == $customer_group_id && $to == 'customer_group') { ?>
                  <option value="<?php echo $customer_group['customer_group_id']; ?>" selected="selected"><?php echo $customer_group['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group to" id="to-customer">
            <label class="col-sm-2 control-label" for="input-customer"><span data-toggle="tooltip" title="<?php echo $help_customer; ?>"><?php echo $entry_customer; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="customers" value="" placeholder="<?php echo $entry_customer; ?>" id="input-customer" class="form-control" />
              <div id="customer" class="well well-sm" style="height: 150px; overflow: auto;">
               <?php foreach ($customers as $customer) { ?>
                   <div id="customer<?php echo $customer['customer_id']; ?>"><i class="fa fa-minus-circle"></i><?php echo $customer['name']; ?><input type="hidden" name="customer[]" value="<?php echo $customer['customer_id']; ?>" />
                    </div>
               <?php } ?>
              </div>
            </div>
          </div>
          <div class="form-group to" id="to-affiliate">
            <label class="col-sm-2 control-label" for="input-affiliate"><span data-toggle="tooltip" title="<?php echo $help_affiliate; ?>"><?php echo $entry_affiliate; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="affiliates" value="" placeholder="<?php echo $entry_affiliate; ?>" id="input-affiliate" class="form-control" />
              <div id="affiliate" class="well well-sm" style="height: 150px; overflow: auto;">
               <?php foreach ($affiliates as $affiliate) { ?>
                   <div id="affiliate<?php echo $affiliate['affiliate_id']; ?>"><i class="fa fa-minus-circle"></i><?php echo $affiliate['name']; ?>
                    <input type="hidden" name="affiliate[]" value="<?php echo $affiliate['affiliate_id']; ?>" />
                    </div>
               <?php } ?>
              </div>
            </div>
          </div>
          <div class="form-group to" id="to-product">
            <label class="col-sm-2 control-label" for="input-product"><span data-toggle="tooltip" title="<?php echo $help_product; ?>"><?php echo $entry_product; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="products" value="" placeholder="<?php echo $entry_product; ?>" id="input-product" class="form-control" />
              <div id="product" class="well well-sm" style="height: 150px; overflow: auto;">
              <?php foreach ($products as $product) { ?>
                  <div id="product<?php echo $product['product_id']; ?>"><i class="fa fa-minus-circle"></i><?php echo $product['name']; ?>
                    <input type="hidden" name="product[]" value="<?php echo $product['product_id']; ?>" />
                  </div>
                  <?php } ?>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-defined"><?php echo $entry_defined; ?></label>
            <div class="col-sm-10">
               <?php if($defined) {
                    $checked1 = ' checked="checked"';
                    $checked0 = '';
                    } else {
                    $checked1 = '';
                    $checked0 = ' checked="checked"';
                    } ?>
                <label for="defined_1"><?php echo $entry_yes; ?></label>
                <input type="radio"<?php echo $checked1; ?> id="defined_1" name="defined" value="1" />
                <label for="defined_0"><?php echo $entry_no; ?></label>
                <input type="radio"<?php echo $checked0; ?> id="defined_0" name="defined" value="0" />
            </div>
          </div>
          <div id="defined-product" style="display:none">
           	<div class="form-group">
                <label class="col-sm-2 control-label" for="input-defined-product-text"><?php echo $entry_section; ?></label>
                <div class="col-sm-10">
                   <input type="text" class="form-control" name="defined_product_text" id="input-defined-product-text" value="<?php echo $defined_product_text; ?>" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_product; ?></label>
                <div class="col-sm-10">
                   <input type="text" class="form-control" name="defined_products" value="" />
                   <div id="defined_product" class="well well-sm" style="height: 150px; overflow: auto;">
                            <?php foreach ($defined_products as $product) { ?>
                               
                                <div id="defined_product<?php echo $product['product_id']; ?>" ><i class="fa fa-minus-circle"></i>
                                    <?php echo $product['name']; ?>
                                    
                                    <input type="hidden" name="defined_product[]" value="<?php echo $product['product_id']; ?>" />
                                </div>
                            <?php } ?>
                     </div>
                </div>
              </div>
              <div id="addingDefined">
               <?php foreach ($defined_products_more as $index => $dpm) { ?>
               <div>
               	<div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $entry_section; ?></label>
                    <div class="col-sm-10">
                       <input type="text" class="form-control" name="defined_product_more[<?php echo $index; ?>][text]" value="<?php echo $dpm['text']; ?>" /><button data-loading-text="<?php echo $text_loading; ?>" data-toggle="tooltip" title="<?php echo $button_remove; ?>" onclick="remSection(this);" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
                    </div>
                  </div>
                  <div class="form-group">
                <label class="col-sm-2 control-label" ><?php echo $entry_product; ?></label>
                <div class="col-sm-10">
                   <input type="text" class="form-control" name="defined_products_<?php echo $index; ?>" value="" data-id="<?php echo $index; ?>"/>
                   <div id="defined_product_<?php echo $index; ?>" class="well well-sm" style="height: 150px; overflow: auto;">
                             <?php foreach ($dpm['products'] as $product) { ?>
                               
                                 <div id="defined_product_entry<?php echo $index; ?>_<?php echo $product['product_id']; ?>"><i class="fa fa-minus-circle"></i>				
                                 <?php echo $product['name']; ?>
                                 <input type="hidden" name="defined_product_more[<?php echo $index; ?>][products][]" value="<?php echo $product['product_id']; ?>" />
                                </div>
                            <?php } ?>
                        </div>
                </div>
                </div>
               </div>
               <?php } ?>
             </div>  
             
               <div class="form-group">
                <label class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                	<button type="button" onclick="addDefinedSection();" data-toggle="tooltip" title="<?php echo $button_add_defined_section; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button>
                
                </div>
                </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-categories"><?php echo $entry_categories; ?></label>
            <div class="col-sm-10">
              <?php if($defined_categories) {
                    $checked1 = ' checked="checked"';
                    $checked0 = '';
                    } else {
                    $checked1 = '';
                    $checked0 = ' checked="checked"';
                    } ?>
                <label for="defined_categories_1"><?php echo $entry_yes; ?></label>
                <input type="radio"<?php echo $checked1; ?> id="defined_categories_1" name="defined_categories" value="1" />
                <label for="defined_categories_0"><?php echo $entry_no; ?></label>
                <input type="radio"<?php echo $checked0; ?> id="defined_categories_0" name="defined_categories" value="0" />
            </div>
          </div>
          <div id="defined-categories" style="display:none"> 
          <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-10">
            	<input type="text" class="form-control" name="categories_name" value="" />
                   <div id="defined-category" class="well well-sm" style="height: 150px; overflow: auto;">
                            <?php foreach ($defined_category as $category) { ?>
                               
                                <div id="defined_category_entry<?php echo $category['category_id']; ?>" ><i class="fa fa-minus-circle"></i>
                                    <?php echo $category['name']; ?>
                                    
                                    <input type="hidden" name="defined_category[]" value="<?php echo $category['category_id']; ?>" />
                                </div>
                            <?php } ?>
                  </div>
            </div>
          </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-categories"><?php echo $entry_manufactures; ?></label>
            <div class="col-sm-10">
              <?php if($defined_manufactures) {
                    $checked1 = ' checked="checked"';
                    $checked0 = '';
                    } else {
                    $checked1 = '';
                    $checked0 = ' checked="checked"';
                    } ?>
                <label for="defined_manufactures_1"><?php echo $entry_yes; ?></label>
                <input type="radio"<?php echo $checked1; ?> id="defined_manufactures_1" name="defined_manufactures" value="1" />
                <label for="defined_manufactures_0"><?php echo $entry_no; ?></label>
                <input type="radio"<?php echo $checked0; ?> id="defined_manufactures_0" name="defined_manufactures" value="0" />
            </div>
          </div>
          <div id="defined-manufactures" style="display:none"> 
          <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-10">
            	<input type="text" class="form-control" name="manufacture_name" value="" />
                   <div id="defined-manufacture" class="well well-sm" style="height: 150px; overflow: auto;">
                          <?php foreach ($defined_manufacture as $manufacture) { ?>
                               
                                <div id="defined_manufacture_entry<?php echo $manufacture['manufacturer_id']; ?>" ><i class="fa fa-minus-circle"></i>
                                    <?php echo $manufacture['name']; ?>
                                    
                                    <input type="hidden" name="defined_manufacture[]" value="<?php echo $manufacture['manufacturer_id']; ?>" />
                                </div>
                            <?php } ?>
                  </div>
            </div>
          </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-special"><?php echo $entry_special; ?></label>
            <div class="col-sm-10">
              <?php if($special) {
                    $checked1 = ' checked="checked"';
                    $checked0 = '';
                    } else {
                    $checked1 = '';
                    $checked0 = ' checked="checked"';
                    } ?>
                <label for="special_1"><?php echo $entry_yes; ?></label>
                <input type="radio"<?php echo $checked1; ?> id="special_1" name="special" value="1" />
                <label for="special_0"><?php echo $entry_no; ?></label>
                <input type="radio"<?php echo $checked0; ?> id="special_0" name="special" value="0" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-latest"><?php echo $entry_latest; ?></label>
            <div class="col-sm-10">
               <?php if($latest) {
                    $checked1 = ' checked="checked"';
                    $checked0 = '';
                    } else {
                    $checked1 = '';
                    $checked0 = ' checked="checked"';
                    } ?>
                <label for="latest_1"><?php echo $entry_yes; ?></label>
                <input type="radio"<?php echo $checked1; ?> id="latest_1" name="latest" value="1" />
                <label for="latest_0"><?php echo $entry_no; ?></label>
                <input type="radio"<?php echo $checked0; ?> id="latest_0" name="latest" value="0" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-popular"><?php echo $entry_popular; ?></label>
            <div class="col-sm-10">
               <?php if($popular) {
                    $checked1 = ' checked="checked"';
                    $checked0 = '';
                    } else {
                    $checked1 = '';
                    $checked0 = ' checked="checked"';
                    } ?>
                <label for="popular_1"><?php echo $entry_yes; ?></label>
                <input type="radio"<?php echo $checked1; ?> id="popular_1" name="popular" value="1" />
                <label for="popular_0"><?php echo $entry_no; ?></label>
                <input type="radio"<?php echo $checked0; ?> id="popular_0" name="popular" value="0" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-subject"><?php echo $entry_addfile; ?></label>
            <div class="col-sm-10">
               <table id="attachment" class="table table-striped table-bordered table-hover">
                        <tbody id="attachment_0">
                            <tr>
                                <td ><input type="hidden" name="attachments_count" value="1" /><input type="file" name="attachment_0"  id="fileImportData" /><div class="attachmentdiv"><?php if($attachments){ ?>
                             <?php   foreach($attachments as $attach) { ?> <span class="attachmentfile"> <?php echo basename($attach); ?><input type="hidden" value="<?php echo $attach; ?>"/>&nbsp;<i  class="fa fa-minus-circle"></i></span><?php } ?>
                             <?php } ?></div></td>
                                <td></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td ><a onclick="addFile();" class="btn btn-primary" title="<?php echo $button_add_file; ?>"><i class="fa fa-file-image-o"></i></a><a class="btn btn-primary"  onclick="uploadfunction();" title="Upload File" ><i class="fa fa-upload"></i></a></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
            </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-subject"><?php echo $entry_subject; ?></label>
            <div class="col-sm-10">
              <input type="text" name="subject" value="<?php echo $subject; ?>" placeholder="<?php echo $entry_subject; ?>" id="input-subject" class="form-control" />
            </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-message"><?php echo $entry_message; ?></label>
            <div class="col-sm-10">
              <textarea name="message" placeholder="<?php echo $entry_message; ?>" id="input-message" class="form-control"><?php echo $message; ?></textarea>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript"><!--
$('#input-message').summernote({
	height: 700
});
//--></script> 
  <script type="text/javascript"><!--	
$('select[name=\'to\']').on('change', function() {
	$('.to').hide();
	
	$('#to-' + this.value.replace('_', '-')).show();
});

$('select[name=\'to\']').trigger('change');
//--></script> 
  <script type="text/javascript"><!--
// Customers
$('input[name=\'customers\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=sale/customer/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',			
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['customer_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'customers\']').val('');
		
		$('#customer' + item['value']).remove();
		
		$('#customer').append('<div id="customer' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="customer[]" value="' + item['value'] + '" /></div>');	
	}	
});

$('#customer').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});

// Affiliates
$('input[name=\'affiliates\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=sale/customer/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',			
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['customer_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'affiliates\']').val('');
		
		$('#affiliate' + item['value']).remove();
		
		$('#affiliate').append('<div id="affiliate' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="affiliate[]" value="' + item['value'] + '" /></div>');	
	}	
});

$('#affiliate').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});

// Products
$('input[name=\'products\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',			
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['product_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'products\']').val('');
		
		$('#product' + item['value']).remove();
		
		$('#product').append('<div id="product' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="product[]" value="' + item['value'] + '" /></div>');	
	}	
});

$('#product').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});

function send(url) {
	$('#content textarea').val($('#input-message').code());
	$.ajax({
		url: url,
		type: 'post',
		data: $('#content select, #content input, #content textarea'),		
		dataType: 'json',
		beforeSend: function() {
			$('#button-send').button('loading');	
		},
		complete: function() {
			$('#button-send').button('reset');
		},				
		success: function(json) {
			$('.alert, .text-danger').remove();
			
			if (json['error']) {
				if (json['error']['warning']) {
					$('#content > .container-fluid').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['warning'] + '</div>');
				}
				
				if (json['error']['subject']) {
					$('input[name=\'subject\']').after('<div class="text-danger">' + json['error']['subject'] + '</div>');
				}	
				
				if (json['error']['message']) {
					$('textarea[name=\'message\']').parent().append('<div class="text-danger">' + json['error']['message'] + '</div>');
				}									
			}			
			
			if (json['next']) {
				if (json['newsletter_id']) {
					$('input[name=\'newsletter_id\']').val(json['newsletter_id']);
				}
				if (json['sent_count_email']) {
                        $('input[name=\'sent_count_email\']').val(json['sent_count_email']);
                }
				if (json['success'] && json['success'] != 'wrongcount') {
					$('.box').before('<div class="success">' + json['success'] + '</div>');
				
					$('#content > .container-fluid').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i>  ' + json['success'] + '</div>');
					
					send(json['next']);
				}		
			} else {
				if (json['success']) {
					$('#content > .container-fluid').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');
				}
				$('input[name=\'sent_count_email\']').val('');
				$('input[name=\'newsletter_id\']').val('');					
			}				
		}
	});
}
//--></script>
<script type="text/javascript"><!--
var attachment_row = 1;
 function addFile(){
	
		html  = '<tbody id="attachment_' + attachment_row + '">';
        html += '<tr>';
        html += '<td><input type="file" name="attachment_' + attachment_row + '" value="" /></td>';
        html += '<td><span class="file_remove" onclick="removeFile(' + attachment_row + ');"><i  class="fa fa-minus-circle"></i></span></td>';
        html += '</tr>';
        html += '</tbody>';

        $('#attachment tfoot').before(html);

        attachment_row++;

        $('input[name=attachments_count]').val(attachment_row);
	}

function removeFile(row) {
	$('#attachment_' + row).remove();
	attachment_row--;
	$('input[name=attachments_count]').val(attachment_row);
}

$(document).ready(function() {
	 if ($('input[name=defined]:checked').val() == 1)
        {
            $('#defined-product').show();
        }
        else
        {
            $('#defined-product').hide();
        }
	 if ($('input[name=defined_categories]:checked').val() == 1)
        {
            $('#defined-categories').show();
        }
        else
        {
            $('#defined-categories').hide();
        }
	 if ($('input[name=defined_manufactures]:checked').val() == 1)
        {
            $('#defined-manufactures').show();
        }
        else
        {
            $('#defined-manufactures').hide();
        }
	 $('input[name=special], input[name=latest], input[name=popular]').bind('click', function() {
           getTemplate();
        });
	$('input[name=defined]').bind('click', function() {
        if ($('input[name=defined]:checked').val() == 1)
        {
            $('#defined-product').show();
        }
        else
        {
            $('#defined-product').hide();
        }
        getTemplate();
    });
	$('input[name="defined_categories"]').bind('click', function(){
	 if ($('input[name=defined_categories]:checked').val() == 1)
        {
            $('#defined-categories').show();
        }
        else
        {
            $('#defined-categories').hide();
        }
        getTemplate();
		
	   });
	   
	$('input[name="defined_manufactures"]').bind('click', function(){
	 if ($('input[name=defined_manufactures]:checked').val() == 1)
        {
            $('#defined-manufactures').show();
        }
        else
        {
            $('#defined-manufactures').hide();
        }
        getTemplate();
		
	   });
	 
	  $('input[name="defined_manufacture[]"]').bind('click', function(){
          getTemplate();
        });
	   
	$('select[name=customer_group_id]').bind('change', function(){
      	getTemplate();
    });

	$('input[name="defined_category[]"]').bind('click', function(){
		getTemplate();
	});
	
	$('select[name=language_id], select[name=inserttemplate], select[name=store_id], select[name=currency]').bind('change', function(){
		
		getTemplate(true);
    });
		
	
	getTemplate();
	
});

$('input[name=\'defined_products\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',			
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['product_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'defined_products\']').val('');
		
		$('#defined_product' + item['value']).remove();
		
		$('#defined_product').append('<div id="defined_product' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="defined_product[]" value="' + item['value'] + '" /></div>');	
		getTemplate();
	}	
});

$('#defined_product').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
	getTemplate();
});

$("[id^='defined_product_']").delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
	getTemplate();
});

var defined_section_row = <?php echo max(count($defined_products_more), 0); ?>;	
function addDefinedSection(){
	html  =  '<div><div class="form-group"><label class="col-sm-2 control-label"><?php echo $entry_section; ?></label><div class="col-sm-10">';
    html +=  '<input type="text" class="form-control" name="defined_product_more[' + defined_section_row + '][text]" value="" /><button data-loading-text="<?php echo $text_loading; ?>" data-toggle="tooltip" title="<?php echo $button_remove; ?>" onclick="remSection(this);" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></div></div>';
	html +=	'<div class="form-group"><label class="col-sm-2 control-label" ><?php echo $entry_product; ?></label><div class="col-sm-10">';
    html +=	'<input type="text" class="form-control" name="defined_products_' + defined_section_row + '" value="" data-id="' + defined_section_row + '"/>';
    html +=	'<div id="defined_product_' + defined_section_row + '" class="well well-sm" style="height: 150px; overflow: auto;"></div></div></div></div></div>';
        
	$('#addingDefined').append(html);
	
	var id = 0 ;
	$('input[name=\'defined_products_' + defined_section_row + '\']').bind('click change',function (){
				id = this.getAttribute("data-id") ; //working in javascript
				
	});	
  $('input[name=\'defined_products_' + defined_section_row + '\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',			
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['product_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
			
		$('input[name=\'defined_products_' + id + '\']').val('');
		
		$('#defined_product_entry' + id + '_' + item['value']).remove();
		
		$('#defined_product_' + id).append('<div id="defined_product_entry' + id + '_' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="defined_product_more[' + id + '][products][]" value="' + item.value + '" /></div>');	
		getTemplate();
	}	
});   
       defined_section_row++;
	
}
function remSection(el) {
	$(el).parent().parent().parent().remove();
	defined_section_row--;
	
	getTemplate();
}
<?php foreach($defined_products_more as $index => $dpm){ ?>
	var id = 0 ;
	var defined_section_row = <?php echo $index; ?>;	
	$('input[name=\'defined_products_' + defined_section_row + '\']').bind('click change',function (){
				id = this.getAttribute("data-id") ; //working in javascript
				
	});	
  $('input[name=\'defined_products_' + defined_section_row + '\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',			
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['product_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
			
		$('input[name=\'defined_products_' + id + '\']').val('');
		
		$('#defined_product_entry' + id + '_' + item['value']).remove();
		
		$('#defined_product_' + id).append('<div id="defined_product_entry' + id + '_' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="defined_product_more[' + id + '][products][]" value="' + item.value + '" /></div>');	
		getTemplate();
	}	
}); 
<?php } ?>

// Category
$('input[name=\'categories_name\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/category/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',			
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['category_id']
					}
				}));
			}
	  });
  },
  'select': function(item) {
	  $('input[name=\'categories_name\']').val('');
	  
	  $('#defined_category_entry' + item['value']).remove();
	  
	  $('#defined-category').append('<div id="defined_category_entry' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="defined_category[]" value="' + item['value'] + '" /></div>');
	  getTemplate();	
  }
});

$('#defined-category').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
	getTemplate();
});
// Manufacturer
$('input[name=\'manufacture_name\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/manufacturer/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',			
			success: function(json) {
				
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['manufacturer_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'manufacturer\']').val(item['label']);
		
		$('input[name=\'manufacture_name\']').val('');
	  
	  $('#defined_manufacture_entry' + item['value']).remove();
	  
	  $('#defined-manufacture').append('<div id="defined_manufacture_entry' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="defined_manufacture[]" value="' + item['value'] + '" /></div>');
	getTemplate();
	}	
});

$('#defined-manufacture').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
	getTemplate();
});

function getTemplate(clear){
	
	var defined_products = [];
       if ($('input[name=defined]:checked').val() == 1) {
            $('#defined_product input').each(function(id) {
                var item = $('#defined_product input').get(id);
                defined_products.push(item.value);
            });
        }
		
	var defined_products_more = [];
        if ($('input[name=defined]:checked').val() == 1) {
            for (var i = 0; i < defined_section_row; i++) {
              defined_products_more[i] = {
                'text' : $('input[name="defined_product_more[' + i + '][text]"]').val(),
                'products' : []
              };
              $('#defined_product_' + i + ' input').each(function(id) {
                var item = $('#defined_product_' + i + ' input').get(id);
                defined_products_more[i]['products'].push(item.value);
              });
            }
        }
		
	var defined_categories2 = [];
        if ($('input[name=defined_categories]:checked').val() == 1) {
            $('input[name="defined_category[]"]').each(function(){
                defined_categories2.push($(this).val());
            });
        }
		
	var defined_manufactures = [];
        if ($('input[name=defined_manufactures]:checked').val() == 1) {
            $('input[name="defined_manufacture[]"]').each(function(){
                defined_manufactures.push($(this).val());
            });
        }
	
	var message ='';
	var messagedata = $('#input-message').code();
	if(messagedata != "<p><br></p>"){
		message = messagedata;
	}
	
	$.ajax({
            type: 'post',
            url: 'index.php?route=sale/mailsubscribe/insertproduct&token=<?php echo $token; ?>',
            data: {
                special: $('input[name=special]:checked').val(),
                latest: $('input[name=latest]:checked').val(),
                popular: $('input[name=popular]:checked').val(),
                template_id: $('select[name=inserttemplate]').val(),
				language_id: $('select[name=language_id]').val(),
				store_id: $('select[name=store_id]').val(),
				currency_id : $('select[name=currency]').val(),
				customer_group_id: ($('select[name=customer_group_id]').length ? $('select[name=customer_group_id]').val() : ''),
				defined: defined_products,
				defined_more: defined_products_more,
				defined_categories2: defined_categories2,
				defined_manufactures: defined_manufactures,
				defined_product_text: $('input[name=defined_product_text]').val(),
				//attachments_id: $('input[name=attachments_id]').val(),
                message: message,
                subject: $('input[name=subject]').val(),
				clear: clear
                
            },
            dataType: 'json',
            success: function(json) {
				
              	$('input[name=subject]').val(json['subject']);
				
				$('#input-message').code(json['body']);
                
            },
			error: function(json){
					alert(JSON.stringify(json));////later on remove this one
				}
        });

	
	


}
function getspecifictemplate(){
	$.ajax({
			type: 'post',
			url: 'index.php?route=sale/mailsubscribe/gettemplate&token=<?php echo $token; ?>',		
			 data: {
                store_id: $('select[name=store_id]').val(),
                template_id: $('select[name=inserttemplate]').val(),
				language_id: $('select[name=language_id]').val(),
				
                
            },
			dataType: 'json',
			success: function(json) {
					
              	$('input[name=subject]').val(json['subject']);
              
				$('#input-message').code(json['body']);
                
			},
			error: function(json){
					alert(JSON.stringify(json));////later on remove this one
				}
		});
}


 //--></script> 
 <script type="text/javascript"><!--
function preview(){
	var template = $('#input-message').code();
	$('body').css('overflow','hidden');
	$('body').append('<div id="modal-image" class="modal in" style="display: block; overflow:scroll;" aria-hidden="false"><div class="modal-dialog modal-lg"><div class="modal-content"><div class="modal-header"><button type="button" class="close" onclick="closepreview();" data-dismiss="modal" aria-hidden="true">&times;</button><h4 class="modal-title"><?php echo $heading_title; ?></h4></div><div class="modal-body">'+template+'</div><div class="modal-footer"><a href="http://www.kodecube.com/"><?php echo "Kodecube"; ?></a></div></div></div></div><div class="modal-backdrop  in"></div>')
}
function closepreview(){
	$('#modal-image').remove();
	$('.modal-backdrop').remove();
	$('body').css('overflow','scroll');
}

 //--></script> 
 <script type="text/javascript" src="view/javascript/kodecube/upclick.js"></script> 
<script type="text/javascript"><!--	
function uploadfunction(){
	$.ajax({
			url: "index.php?route=sale/mailsubscribe/attachmentset&token=<?php echo $token; ?>",
			type: "POST",
			data: {
				attachments_count : $('input[name=attachments_count]').val(),
				attachments_id : $('input[name=attachments_id]').val()
				},
			success: function(json) {
				
			 }
	});
	
	
    var formdata = false;
    if (window.FormData) {
        formdata = new FormData();
    }
	 var data = $('#form-mailsubscribe input[type=\'file\']').files;
	 
    $('#form-mailsubscribe input[type=\'file\']').each(function(){
		///var namevalue = $(this).attr("name");  
		
		var i = 0, len = this.files.length, img, reader, file;

        for ( ; i < len; i++ ) {
            file = this.files[i];

            if (!!file.type.match(/image.*/)) {
                if ( window.FileReader ) {
                    reader = new FileReader();
                    reader.onloadend = function (e) {
                        //showUploadedItem(e.target.result, file.fileName);
                    };
                    reader.readAsDataURL(file);
                }

                if (formdata) {
                    formdata.append($(this).attr("name"), file);
					
                    formdata.append("extra",'extra-data');
                }
             
            }
            else
            {
                alert('Not a vaild image!');
            }
        }
	 });
   
	 if (formdata) {
		alert('Befor uploading files');

		$.ajax({
			url: "index.php?route=sale/mailsubscribe/upload&token=<?php echo $token; ?>",
			type: "POST",
			data:formdata ,
			processData: false,
			contentType: false,
			success: function(json) {
				///alert(json);
				
				var obj =  $.parseJSON(json);
				///alert(obj[0]['filename']);
				for(i=0; i< obj.length;i++){
					////alert(obj[i]['filename']);
					$('.attachmentdiv').append('<span class="attachmentfile">'+ obj[i]['filename'] +'<input type="hidden" value="'+ obj[i]['path'] +'" />&nbsp;<i  class="fa fa-minus-circle"></i></span>');
				}
 		 	},
			complete:function(){
				$('.attachmentfile').bind('click', function() {
					var object = $(this);
					var file = object.find('input').val();
					if(!confirm('Are you sure to delete this file!!!'))
						return false;
					$.ajax({
							url: "index.php?route=sale/mailsubscribe/deletefile&token=<?php echo $token; ?>",
							type: "POST",
							datatype:"JSON",
							data: {
								file : file
							},
							success: function(json) {
								object.remove();
							}
						});
					
				});

			}
		});
	}
    
}
$(document).ready(function () {
	$('.attachmentfile').bind('click', function() {
		var object = $(this);
		var file = object.find('input').val();
		if(!confirm('Are you sure to delete this file!!!'))
			return false;
		$.ajax({
				url: "index.php?route=sale/mailsubscribe/deletefile&token=<?php echo $token; ?>",
				type: "POST",
				datatype:"JSON",
				data: {
					file : file
				},
				success: function(json) {
					object.remove();
				}
			});
		
	});
});
//--></script> 
<style>
.attachmentdiv{
	float: right;
    margin-left: 2px;
}
.attachmentfile{
	
    border: 1px solid;
    margin: 5px;
    padding: 5px 20px 5px 5px;
	border-radius: 10px;
	cursor: context-menu;
}
.attachmentdiv{
	float: right;
    margin-left: 2px;
}
</style>
</div>
<?php echo $footer; ?>