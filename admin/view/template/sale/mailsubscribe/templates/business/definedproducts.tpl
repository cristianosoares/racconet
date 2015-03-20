<?php if ($heading && $products) { ?>
<table width="560" border="0" cellspacing="0" cellpadding="0">
  
            <tr>
              <td style="color:<?php echo $heading_color; ?>;<?php echo $heading_style; ?>" align="center"><?php echo $heading; ?></td>
            </tr>
          </tbody>
       
    
</table>
<?php } ?>
<table width="560" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <?php foreach (array_chunk($products, $columns_count) as $row) {
	

	
	 ?>
    <tr>
      <?php $count = count($row); if ($count < $columns_count) { for (; $count < $columns_count; $count++) { $row[$count] = false; } } ?>
      <?php foreach ($row as $key => $product) { ?>
      <?php if ($product) { ?>
      <td valign="top" style="border:1px #f0f0f0 solid;width:168px;text-align:center;">
        <table border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;text-align:center;">
          <tbody>
            <tr>
              <td style="padding-top:1px;">
                <a href="<?php echo $product['href']; ?>" title="<?php echo $product['name']; ?>" target="_blank"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" width="<?php echo $image_width; ?>" height="<?php echo $image_height; ?>" border="0"></a>
              </td>
            </tr>
            <tr>
              <td style="padding:8px 6px 20px 6px; width:150px; font-family:Arial, Helvetica, sans-serif; font-size:11px;">
              <a style="    font-size: 13px; font-weight: bold; color:<?php echo $name_color; ?>;<?php echo $name_style; ?>" href="<?php echo $product['href']; ?>" target="_blank"><?php echo $product['name']; ?></a> 
                <br>
                <span style="color:<?php echo $model_color; ?>;<?php echo $model_style; ?>" ><?php echo $product['model']; ?></span><br>
                <?php if ($show_price) { ?>
                  <?php if (isset($product['special']) && $product['special']) { ?>
                    <span style="font-size: 15px; color:<?php echo $price_color; ?>;<?php echo $special_style; ?>"><?php echo $product['special']; ?></span><br>
                    <span style="font-size: 15px; color:<?php echo $special_color; ?>;<?php echo $price_style; ?>"><s><?php echo $product['price']; ?></s></span>
                  <?php } else { ?>
                    <span style="font-size: 15px; color:<?php echo $price_color; ?>;<?php echo $price_style; ?>"><?php echo $product['price']; ?></span>
                  <?php } ?>
                <?php } ?>
				<br >
                <?php if ($product['description']) { ?>
                <span style="font-size: 15px; color:<?php echo $description_color; ?>;<?php echo $description_style; ?>" ><?php echo $product['description']; ?></span><br>  <br>             
                <?php } ?>
                <div class="contentEditable">
<a href="<?php echo $product['href']; ?>" style='background: none repeat scroll 0 0 #e3a552;
    border-radius: 3px;
    color: #ffffff;
    font-size: 13px;
    padding: 10px 20px;
    text-decoration: none;'>Buy NOw!</a>
</div>
              </td>
            </tr>
          </tbody>
        </table>
      <?php } else { ?>
      <td style="width:168px;">
      <?php } ?>
      </td>
      <?php if ($key + 1 < $columns_count) { ?>
      <td style="width:12px;"></td>
      <?php } ?>
      <?php } ?>
    </tr>
    <tr>
      <td style=" height:12px;">&nbsp;</td>
    </tr>
    <?php } ?>
  </tbody>
</table>