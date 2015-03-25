<h3><strong>CADASTRE SEU E-MAIL</strong><br> <span><em>e receba novas notícias e promoções exclusivas</em></span></h3>
<div id="frm_subscribe">
  <form name="subscribe" id="subscribe">
    <input type="text" value="" placeholder="Nome" name="subscribe_name" id="subscribe_name">  
    <input type="text" value="" placeholder="Email" name="subscribe_email" id="subscribe_email">

     <a onclick="email_subscribe()"><span class="glyphicon glyphicon-circle-arrow-right"></span></a>
	 <?php if($option_unsubscribe) { ?>
          <a class="btn btn-primary" onclick="email_unsubscribe()" ><span><?php echo $entry_unbutton; ?></span></a>
      <?php } ?>   

     <div id="subscribe_result"></div>

  </form>
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