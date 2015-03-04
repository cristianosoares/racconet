<?php echo $header; ?>
<div class="container">
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12 home'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>">
        <?php echo $content_top; ?>
        <div class="filter-products">
            <div class="filter-product">
                <div class="busca-segmento"></div>    
                <?php if ($filter_groups) { ?>
                    <?php foreach ($filter_groups as $filter_group) { 
                    $f = preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//TRANSLIT', $filter_group['name'] ));
                    $filterProd = strtolower(str_replace(' ','-', $f));
                    ?>
                            <a href="<?php echo $filter_group['filter_id']; ?>" class="<?php echo $filterProd; ?>"><?php echo $filter_group['name']; ?></a>
                    <?php }
                } ?>
            </div>
        </div>    
        <?php echo $content_bottom; ?>
        <div class="marcas">
            <h2 class="title-marca"><?php echo $text_marca; ?></h2>
            <?php foreach ($categories as $category) { ?>
              <?php if ($category['manufacturer']) { ?>
              <?php foreach (array_chunk($category['manufacturer'], 4) as $manufacturers) { ?>
                <?php foreach ($manufacturers as $manufacturer) { 
                $m = preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//TRANSLIT', $manufacturer['name'] ));
                $marcas = strtolower(str_replace(' ','-', $m));
                ?>
                <a href="<?php echo $manufacturer['href']; ?>" class="<?php echo $marcas; ?>"><?php echo $manufacturer['name']; ?></a>
                <?php } ?>
              <?php } ?>
              <?php } ?>
              <?php } ?>
        </div>      
    </div>
    <?php echo $column_right; ?>
  </div>
</div>
<?php echo $footer; ?>