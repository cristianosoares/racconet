<div class="col-md-12 list-group">
  <?php 
  foreach ($categories as $category) { 
		  $v = preg_replace( '/[`^~?\'"]/', null, iconv( 'UTF-8', 'ASCII//TRANSLIT', $category['category'] ));
		  $categoria = strtolower(str_replace(' ','-', $v));
		  $category2 = preg_replace('/[0-9)(]+/', "",$category['name']); //remove os numeros
	  ?>
	  <?php if ($category['category_id'] == $category_id) {  $classes = ' ';?>
      
      
          <a href="<?php echo $category['href']; ?>" class="<?php echo $categoria; ?> list-group-item active"><span><?php echo $category2; ?></span></a>
          <?php if ($category['children']) { ?>
			 <?php foreach ($category['children'] as $child) { ?>
              <?php if ($child['category_id'] == $child_id) { ?>
                  <a href="<?php echo $child['href']; ?>" class="<?php echo $category['category']; ?> list-group-item active"><span><?php echo $child['name']; ?></span></a>
                  <?php } else { ?>
                  <a href="<?php echo $child['href']; ?>" class="list-group-item sub-item"><span><?php echo $child['name']; ?></span></a>
                  <?php } ?>
              <?php } ?>
          <?php } ?>
	  <?php } else { 
	
		?>
	  <a href="<?php echo $category['href']; ?>" class="<?php echo $data['class']; ?> <?php echo $categoria; ?> list-group-item"><span><?php echo $category2; ?></span></a>
	  <?php } ?>
  <?php } ?>
  <a href="<?php echo $epis; ?>" class="col-md-3 col-sm-4 col-xs-6 epis list-group-item"><span>EPI'S </span></a>
</div>
