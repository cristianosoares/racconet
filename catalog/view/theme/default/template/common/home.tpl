<?php echo $header; ?>
<div id="content" class="container">
	<!--BANNER-->
	<div class="row">
        <div class="col-md-12">
            <?php echo $content_top; ?>
        </div>
    </div>
    
    <?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-md-6';  ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-md-9';  ?>
    <?php } else { ?>
    <?php $class = 'col-md-9 col-sm-8 home'; ?>
    <?php } ?>
    
    <div class="row filter-products">
    
    <!-- Menu home -->
        <?php if ($categories) { ?>
        <div class="menu-bar-home col-md-3 col-sm-4">  
          <nav id="menu" class="navbar">
            <div class="navbar-header"><span id="category" class="visible-xs"><?php echo $text_category; ?></span>
              <button type="button" class="btn btn-navbar navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"><i class="fa fa-bars"></i></button>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
              <ul class="nav navbar-nav">
                <?php foreach ($categories as $category) { ?>
                <?php if ($category['children']) { ?>
                <li class="dropdown"><a href="<?php echo $category['href']; ?>" class="dropdown-toggle" data-toggle="dropdown"><?php echo $category['name']; ?><span class="caret"></span></a>
                  <div class="dropdown-menu">
                    <div class="dropdown-inner">
                      <?php foreach (array_chunk($category['children'], ceil(count($category['children']) / $category['column'])) as $children) { ?>
                      <ul class="list-unstyled">
                        <?php foreach ($children as $child) { ?>
                        <li><a href="<?php echo $child['href']; ?>"><?php echo $child['name']; ?></a></li>
                        <?php } ?>
                      </ul>
                      <?php } ?>
                    </div>
                    <a href="<?php echo $category['href']; ?>" class="see-all"><?php echo $text_all; ?></a> </div>
                </li>
                <?php } else { ?>
                <li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
                <?php } ?>
                <?php } ?>
              </ul>
            </div><!--collapse navbar-collapse navbar-ex1-collapse-->
          </nav>
        </div>
        <?php } ?>
         <!--END Menu home -->
         
        <div class="<?php echo $class; ?> ">
        	<div class="filter-product row">
                <div class="busca-segmento col-md-8 col-sm-12 "></div>    
                <?php if ($filter_groups) { ?>
                    <?php 
                    $count =1; 
                    foreach ($filter_groups as $filter_group) { 
                    $count++;
                    $f = preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//TRANSLIT', $filter_group['name'] ));
                    $filterProd = strtolower(str_replace(' ','-', $f));
                    ?>
                            <a href="<?php echo $filter_group['filter_id']; ?>" class="<?php echo $filterProd; ?> col-md-4 col-sm-4 col-xs-4"><?php echo $filter_group['name']; ?></a>
                    <?php }
                } ?>
            </div><!--filter-product-->
        </div><!--content-->
    </div><!--row-->
    
    <div class="row content_bottom">
        <?php echo $content_bottom; ?>
    </div><!--row-->
    
    <!-- Filtro de Marcas -->
        <div class="marcas">
        	<div class="row">
                <div class="col-md-12">
                    <h2 class="title-marca"><?php echo $text_marca; ?></h2>
                </div>
            </div>
            
            <div class="row">
            	
                <?php foreach ($categorias as $marca) { ?>
                  <?php if ($marca['manufacturer']) { ?>
                  <?php foreach (array_chunk($marca['manufacturer'], 4) as $manufacturers) { ?>
                    <?php foreach ($manufacturers as $manufacturer) { 
                    $m = preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//TRANSLIT', $manufacturer['name'] ));
                    $marcas = strtolower(str_replace(' ','-', $m));
                    ?>
                    <div class="col-md-3 col-sm-4 col-xs-6">
                        <a href="<?php echo $manufacturer['href'];?>" class="<?php echo $marcas; ?>"><?php echo $manufacturer['name']; ?></a>
                    </div>
                    <?php } ?>
                  <?php } ?>
                  <?php } ?>
                  <?php } ?>
              </div><!--row-->
        </div><!--marcas-->
        
        <div class="clearfix"></div>
        
         <!-- Area de Assinaturas -->
        <div class="assinaturas row">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <h2 class="title-ass">
                    <span>Assine</span> a Infoseg
                </h2>
                <div class="col1-ass col-md-6 col-sm-6 col-xs-6"></div>
                <div class=" col-md-6 col-sm-6 col-xs-6">
                    <div class="logo-infoseg"></div>
                    <div class="text-infoseg">
                        É o primeiro informativo eletrônico voltado para os profissionais da área de segurança no trabalho.
                    </div>
                    <div class="btn-infoseg">Cadastre-se Já</div>
                    <div class="ass-free">*Cadastro Gratuito</div>
                </div><!--col2-ass-->
            </div><!--col-md-4-->
            
            <div class="col-md-4 col-sm-6  col-xs-12" style="height: 319px;">
                <h2 class="title-ass">
                    <span>Acompanhe</span> a Racco
                </h2>
                <?php echo $column_right; ?>
            </div><!--col-md-4-->
            
            <div class="col-md-3 col-sm-12  col-xs-12">
                <h2 class="title-ass">
                    <span>Junte-se</span> a Nós
                </h2>
                <div class="junte-se-nos"></div>
            </div><!--col-md-3-->
        </div> <!--assinaturas-->
        
</div><!--container-->
<?php echo $footer; ?>
