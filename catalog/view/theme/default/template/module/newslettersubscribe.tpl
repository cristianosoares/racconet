<h3><?php echo $heading_title; ?></h3>
<div class="row">
  
  
  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" id="frm_subscribe">
  <form name="subscribe" id="subscribe">
  <table border="0" cellpadding="2" cellspacing="2">
   <tr>
     <td align="left"><span class="required">*</span>&nbsp;<?php echo $entry_email; ?><br /><input type="text" value="" name="subscribe_email" id="subscribe_email"></td>
   </tr>
   <tr>
     <td align="left"><?php echo $entry_name; ?>&nbsp;<br /><input type="text" value="" name="subscribe_name" id="subscribe_name"> </td>
   </tr>
   
   <?php for($ns=1;$ns<=$option_fields;$ns++) { ?>

      <tr>
     <td align="left"><?php echo $option_fields_[$ns]; ?>&nbsp;<br /><input type="text" value="" name="option<?php echo $ns; ?>" id="option<?php echo $ns; ?>"> </td>
   </tr>
	
  <?php } ?>
   
   <tr>
     <td align="left">
     <a class="btn btn-primary" onclick="email_subscribe()"><span><?php echo $entry_button; ?></span></a>
	 <?php if($option_unsubscribe) { ?>
          <a class="btn btn-primary" onclick="email_unsubscribe()" ><span><?php echo $entry_unbutton; ?></span></a>
      <?php } ?>   
	  
     </td>
   </tr>
   <tr>
     <td align="center" id="subscribe_result"></td>
   </tr>
  </table>
  </form>
  </div>
  

  </div>

<script language="javascript">
	
function email_subscribe(){
	$.ajax({
			type: 'post',
			url: 'index.php?route=module/newslettersubscribe/subscribe',
			dataType: 'html',
            data:$("#subscribe").serialize(),
			success: function (html) {
				eval(html);
			}}); 
}
function email_unsubscribe(){
	$.ajax({
			type: 'post',
			url: 'index.php?route=module/newslettersubscribe/unsubscribe',
			dataType: 'html',
            data:$("#subscribe").serialize(),
			success: function (html) {
				eval(html);
			}}); 
}
     
</script>