<div class="col-md-12 list-group">
  <?php foreach ($categories as $category) { 
      $v = preg_replace( '/[`^~?\'"]/', null, iconv( 'UTF-8', 'ASCII//TRANSLIT', $category['category'] ));
      $categoria = strtolower(str_replace(' ','-', $v));
  ?>
  <?php if ($category['category_id'] == $category_id) { ?>
  <a href="<?php echo $category['href']; ?>" class="<?php echo $categoria; ?> list-group-item active"><span><?php echo $category['name']; ?></span></a>
  <?php if ($category['children']) { ?>
  <?php foreach ($category['children'] as $child) { ?>
  <?php if ($child['category_id'] == $child_id) { ?>
  <a href="<?php echo $child['href']; ?>" class="<?php echo $category['category']; ?> list-group-item active"><span><?php echo $child['name']; ?></span></a>
  <?php } else { ?>
  <a href="<?php echo $child['href']; ?>" class="list-group-item sub-item"><span><?php echo $child['name']; ?></span></a>
  <?php } ?>
  <?php } ?>
  <?php } ?>
  <?php } else { ?>
  <a href="<?php echo $category['href']; ?>" class=" <?php echo $categoria; ?> list-group-item"><span><?php echo $category['name']; ?></span></a>
  <?php } ?>
  <?php } ?>
</div>
