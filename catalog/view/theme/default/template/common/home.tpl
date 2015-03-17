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
            <!-- Menu home -->
            <?php if ($categories) { ?>
            <div class="menu-bar-home">  
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
                </div>
              </nav>
            </div>
            <?php } ?>
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
        <!-- Filtro de Marcas -->
        <div class="marcas">
            <h2 class="title-marca"><?php echo $text_marca; ?></h2>
            <?php foreach ($categorias as $marca) { ?>
              <?php if ($marca['manufacturer']) { ?>
              <?php foreach (array_chunk($marca['manufacturer'], 4) as $manufacturers) { ?>
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
        
        <!-- Area de Assinaturas -->
        <div class="assinaturas">
            <div class="col-lg-4">
                <h2 class="title-ass">
                    <span>Assine</span> a Infoseg
                </h2>
                <div class="col1-ass">
                </div>
                <div class="col2-ass">
                    <div class="logo-infoseg"></div>
                    <div class="text-infoseg">
                        É o primeiro informativo eletrônico voltado para os profissionais da área de segurança no trabalho.
                    </div>
                    <div class="btn-infoseg">Cadastre-se Já</div>
                    <div class="ass-free">*Cadastro Gratuito</div>
                </div>
            </div>
            <div class="col-lg-4">
                <h2 class="title-ass">
                    <span>Acompanhe</span> a Racco
                </h2>
            </div>
            <div class="col-lg-3">
                <h2 class="title-ass">
                    <span>Junte-se</span> a Nós
                </h2>
                <div class="junte-se-nos"></div>
            </div>
        </div>    
    </div>
    <?php echo $column_right; ?>
  </div>
</div>
<?php echo $footer; ?>