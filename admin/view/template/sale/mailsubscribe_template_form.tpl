<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  
<div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
       <button type="submit" form="form-template" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
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
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_edit_template; ?></h3>
      </div>
      <div class="panel-body">
        <div class="table-responsive">
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-template">
   
    <div id="overlay" style="display:compact;visibility:hidden;" title="Preview Email"></div>
        <table id="mail" class="table table-bordered table-hover">
          <tr>
            <td><?php echo $entry_template_name; ?></td>
            <td><input type="text" name="template_name" value="<?php echo $template_name; ?>"></td>
          </tr>
          <tr>
            <td><?php echo $entry_template_uri; ?></td>
            <td><select name="template_uri">
                            <?php foreach ($parts as $key => $part) { ?>
                            <?php if ($template_uri == $key) { ?>
                            <option value="<?php echo $key; ?>" selected="selected"><?php echo $part; ?></option>
                            <?php } else { ?>
                            <option value="<?php echo $key; ?>"><?php echo $part; ?></option>
                            <?php } ?>
                            <?php } ?>
                        </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_product_image_size; ?></td>
            <td><input type="text" name="image_height" value="<?php echo $image_height; ?>" size="5" /> /<input type="text" name="image_width" value="<?php echo $image_width; ?>" size="5"/></td>
          </tr>
           <tr>
                    <td><?php echo $entry_show_prices; ?></td>
                    <td>
                        <?php if($show_price) {
                        $checked1 = ' checked="checked"';
                        $checked0 = '';
                        } else {
                        $checked1 = '';
                        $checked0 = ' checked="checked"';
                        } ?>
                    <label for="show_price_1"><?php echo $entry_yes; ?></label>
                    <input type="radio"<?php echo $checked1; ?> id="show_prices_1" name="show_price" value="1" />
                    <label for="show_price_0"><?php echo $entry_no; ?></label>
                    <input type="radio"<?php echo $checked0; ?> id="show_prices_0" name="show_price" value="0" />
                    </td>
                </tr>
                
          <tbody id="to-customer-group" class="to">
               <tr>
                    <td><?php echo $entry_description_length; ?></td>
                    <td><input type="text" name="product_description_length" size="3" value="<?php echo $product_description_length; ?>" /></td>
                </tr>
                <tr>
                    <td><?php echo $entry_product_cols; ?></td>
                    <td><input type="text" name="product_cols" size="3" value="<?php echo $product_cols; ?>" /></td>
                </tr>
                <tr>
                    <td><?php echo $entry_special_product_count; ?></td>
                    <td><input type="text" name="special_product_count" size="3" value="<?php echo $special_product_count; ?>" /></td>
                </tr>
                <tr>
                    <td><?php echo $entry_latest_product_count; ?></td>
                    <td><input type="text" name="latest_product_count" size="3" value="<?php echo $latest_product_count; ?>" /></td>
                </tr>
                <tr>
                    <td><?php echo $entry_popular_product_count; ?></td>
                    <td><input type="text" name="popular_product_count" size="3" value="<?php echo $popular_product_count; ?>" /></td>
                </tr>
                <tr>
                    <td colspan="2"><b><?php echo $text_styles; ?></b></td>
                </tr>
                <tr>
                    <td><?php echo $entry_heading_color; ?></td>
                    <td><input class="color {hash:true}" type="text" name="heading_color" value="<?php echo $heading_color; ?>" size="7" maxlength="7" /></td>
                </tr>
                <tr>
                    <td><?php echo $entry_heading_style; ?></td>
                    <td><input type="text" name="heading_style" size="100" value="<?php echo $heading_style; ?>" /></td>
                </tr>
                <tr>
                    <td><?php echo $entry_name_color; ?></td>
                    <td><input class="color {hash:true}" type="text" name="product_name_color" value="<?php echo $product_name_color; ?>" size="7" maxlength="7" /></td>
                </tr>
                <tr>
                    <td><?php echo $entry_name_style; ?></td>
                    <td><input type="text {hash:true}" name="product_name_style" size="100" value="<?php echo $product_name_style; ?>" /></td>
                </tr>
                <tr>
                    <td><?php echo $entry_model_color; ?></td>
                    <td><input class="color {hash:true}" type="text" name="product_model_color" value="<?php echo $product_model_color; ?>" size="7" maxlength="7" /></td>
                </tr>
                <tr>
                    <td><?php echo $entry_model_style; ?></td>
                    <td><input type="text" name="product_model_style" size="100" value="<?php echo $product_model_style; ?>" /></td>
                </tr>
                <tr>
                    <td><?php echo $entry_price_color; ?></td>
                    <td><input class="color {hash:true}" type="text" name="product_price_color" value="<?php echo $product_price_color; ?>" size="7" maxlength="7" /></td>
                </tr>
                <tr>
                    <td><?php echo $entry_price_style; ?></td>
                    <td><input type="text" name="product_price_style" size="100" value="<?php echo $product_price_style; ?>" /></td>
                </tr>
                <tr>
                    <td><?php echo $entry_price_color_special; ?></td>
                    <td><input class="color {hash:true}" type="text" name="product_price_color_special" value="<?php echo $product_price_color_special; ?>" size="7" maxlength="7" /></td>
                </tr>
                <tr>
                    <td><?php echo $entry_price_style_special; ?></td>
                    <td><input type="text" name="product_price_style_special" size="100" value="<?php echo $product_price_style_special; ?>" /></td>
                </tr>
                <tr>
                    <td><?php echo $entry_description_color; ?></td>
                    <td><input class="color {hash:true}" type="text" name="product_description_color" value="<?php echo $product_description_color; ?>" size="7" maxlength="7" /></td>
                </tr>
                <tr>
                    <td><?php echo $entry_description_style; ?></td>
                    <td><input type="text" name="product_description_style" size="100" value="<?php echo $product_description_style; ?>" /></td>
                </tr>
                <tr>
                    <td><?php echo $entry_show_custom_css; ?></td>
                    <td>
                    <?php if($show_custom_css) { 
                        $checked1 = ' checked="checked"';
                        $checked0 = '';
                    } else {
                        $checked1 = '';
                        $checked0 = ' checked="checked"';
                    } ?>
                        <label for="show_custom_css_1"><?php echo $entry_yes; ?></label>
                        <input type="radio" id="show_custom_css_1" name="show_custom_css" value="1"<?php echo $checked1; ?>/>
                <label for="show_custom_css_0"><?php echo $entry_no; ?></label>
                <input type="radio" id="show_custom_css_0" name="show_custom_css" value="0"<?php echo $checked0; ?> /></td>
                </tr>
                <tr id="custom-css" style="display:<?php echo ($show_custom_css)?'table-row':'none';?>">
                    <td><?php echo $entry_custom_css; ?></td>
                    <td><textarea name="custom_css" style="width: 56%;" rows="10"><?php echo $custom_css; ?></textarea></td>
                </tr>
          </tbody>
          <tr>
                    <td colspan="2">
                <ul class="nav nav-tabs" id="language">
                <?php foreach ($languages as $language) { ?>
                <li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                <?php } ?>
              </ul>
         		<div class="tab-content">
        			<?php foreach ($languages as $language) { ?>
                          <div class="tab-pane" id="language<?php echo $language['language_id']; ?>">
                            <table class="table table-bordered table-hover">
                              <tr>
                                <td><?php echo $entry_subject; ?></td>
                                <td><input type="text" name="subject[<?php echo $language['language_id']; ?>]" size="100" value="<?php echo isset($subject[$language['language_id']]) ? $subject[$language['language_id']] : ''; ?>" /></td>
                              </tr>
                              <tr>
                                <td><?php echo $entry_defined_text; ?></td>
                                <td><input type="text" name="defined_text[<?php echo $language['language_id']; ?>]" size="100" value="<?php echo isset($defined_text[$language['language_id']]) ? $defined_text[$language['language_id']] : ''; ?>" /></td>
                              </tr>
                              <tr>
                                <td><?php echo $entry_special_text; ?></td>
                                <td><input type="text" name="special_text[<?php echo $language['language_id']; ?>]" size="100" value="<?php echo isset($special_text[$language['language_id']]) ? $special_text[$language['language_id']] : ''; ?>" /></td>
                              </tr>
                              <tr>
                                <td><?php echo $entry_latest_text; ?></td>
                                <td><input type="text" name="latest_text[<?php echo $language['language_id']; ?>]" size="100" value="<?php echo isset($latest_text[$language['language_id']]) ? $latest_text[$language['language_id']] : ''; ?>" /></td>
                              </tr>
                              <tr>
                                <td><?php echo $entry_popular_text; ?></td>
                                <td><input type="text" name="popular_text[<?php echo $language['language_id']; ?>]" size="100" value="<?php echo isset($popular_text[$language['language_id']]) ? $popular_text[$language['language_id']] : ''; ?>" /></td>
                              </tr>
                              <tr>
                                <td><?php echo $entry_manufactures_text; ?></td>
                                <td><input type="text" name="manufactures_text[<?php echo $language['language_id']; ?>]" size="100" value="<?php echo isset($manufactures_text[$language['language_id']]) ? $manufactures_text[$language['language_id']] : ''; ?>" /></td>
                              </tr>
                              <tr>
                                <td><?php echo $entry_categories_text; ?></td>
                                <td><input type="text" name="categories_text[<?php echo $language['language_id']; ?>]" size="100" value="<?php echo isset($categories_text[$language['language_id']]) ? $categories_text[$language['language_id']] : ''; ?>" /></td>
                              </tr>
                              
                                <tr>
                                  <td><?php echo $entry_template_body; ?></td>
                                  <td><textarea name="body[<?php echo $language['language_id']; ?>]" id="body<?php echo $language['language_id']; ?>"><?php echo isset($body[$language['language_id']]) ? $body[$language['language_id']] : ''; ?></textarea></td>
                                </tr>
                                
                                <tr>
                                  <td>&nbsp;</td>
                                  <td>
                                    <p><?php echo $text_message_info; ?></p>
                                  </td>
                                </tr>
                            </table>
                          </div>
                        <?php } ?>
           		</div>
                    </td>
                </tr>
            </table>
        </form>
    </div>
        
        
      </div>
    </div>
  </div>
<script type="text/javascript"><!--
<?php foreach ($languages as $language) { ?>
$('textarea[name=\'body[<?php echo $language['language_id']; ?>]\']').summernote({height: 700});
<?php } ?>
//--></script> 
<script type="text/javascript"><!--
$('input[name=show_custom_css]').bind('click', function() {
	if ($('input[name=show_custom_css]:checked').val() == 1)
	{
		$('#custom-css').show();
	}
	else
	{
		$('textarea[name=custom_css]').val('');
		$('#custom-css').hide();
	}
});
//--></script>
<script type="text/javascript"><!--
$('#language a:first').tab('show');
//--></script></div>
</div>
<?php echo $footer; ?>
