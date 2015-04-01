<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<!--<![endif]-->
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" >
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content= "<?php echo $keywords; ?>">
<?php } ?>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php if ($icon) { ?>
<link href="<?php echo $icon; ?>" rel="icon">
<?php } ?>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>">
<?php } ?>
<link href="catalog/view/javascript/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" >
<link href="catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" >
<link href="//fonts.googleapis.com/css?family=Open+Sans:400,400i,300,700" rel="stylesheet" type="text/css" >
<link href="catalog/view/theme/default/stylesheet/stylesheet.css" rel="stylesheet">
<link href="catalog/view/theme/default/stylesheet/jcarousel.responsive.css" rel="stylesheet">
<?php foreach ($styles as $style) { ?>
<link href="<?php echo $style['href']; ?>" type="text/css" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" >
<?php } ?>
<script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="catalog/view/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="catalog/view/javascript/common.js" type="text/javascript"></script>
<script src="catalog/view/javascript/jquery.jcarousel.min.js" type="text/javascript"></script>
<script src="catalog/view/javascript/jcarousel.responsive.js" type="text/javascript"></script>

<?php foreach ($scripts as $script) { ?>
<script src="<?php echo $script; ?>" type="text/javascript"></script>
<?php } ?>

<?php echo $google_analytics; ?>
</head>
<body class="<?php echo $class; ?>">

<div class="container-fluid bg-top-nav pg-interno">
	<nav class="container">
    	<div class="row">
          <div class="col-top-midias col-md-2">
        	<div class="facebook pull-right"></div>
                <div class="blog pull-right"></div>
                <div class="pull-right">
                    <?php echo $currency; ?>
                    <?php echo $language; ?>
                </div>
          </div>
          <!-- <div id="top-links" class="nav pull-right">
          <ul class="list-inline">
            <li><a href="<?php echo $contact; ?>"><i class="fa fa-phone"></i></a> <span class="hidden-xs hidden-sm hidden-md"><?php echo $telephone; ?></span></li>
            <li class="dropdown"><a href="<?php echo $account; ?>" title="<?php echo $text_account; ?>" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $text_account; ?></span> <span class="caret"></span></a>
              <ul class="dropdown-menu dropdown-menu-right">
                <?php if ($logged) { ?>
                <li><a href="<?php echo $account; ?>"><?php echo $text_account; ?></a></li>
                <li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
                <li><a href="<?php echo $transaction; ?>"><?php echo $text_transaction; ?></a></li>
                <li><a href="<?php echo $download; ?>"><?php echo $text_download; ?></a></li>
                <li><a href="<?php echo $logout; ?>"><?php echo $text_logout; ?></a></li>
                <?php } else { ?>
                <li><a href="<?php echo $register; ?>"><?php echo $text_register; ?></a></li>
                <li><a href="<?php echo $login; ?>"><?php echo $text_login; ?></a></li>
                <?php } ?>
              </ul>
            </li>
            <li><a href="<?php echo $wishlist; ?>" id="wishlist-total" title="<?php echo $text_wishlist; ?>"><i class="fa fa-heart"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $text_wishlist; ?></span></a></li>
            <li><a href="<?php echo $shopping_cart; ?>" title="<?php echo $text_shopping_cart; ?>"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $text_shopping_cart; ?></span></a></li>
            <li><a href="<?php echo $checkout; ?>" title="<?php echo $text_checkout; ?>"><i class="fa fa-share"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $text_checkout; ?></span></a></li>
          </ul>
        </div>-->
          
          <!--top-links-->
        </div><!--row-->
    </nav>
    
    <header class="container">
    	<div class="row bg-top-header">
        	<div class="col-md-3 col-xs-6">
            	<div id="logo">
                  <?php if ($logo) { ?>
                  <a href="<?php echo $home; ?>">
                  	<img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" class="img-responsive" ></a>
                  <?php } else { ?>
                  <h1><a href="<?php echo $home; ?>"><?php echo $name; ?></a></h1>
                  <?php } ?>
                </div><!--logo-->
            </div><!--col-md-3-->
            
            <div class="col-md-9">
                <div class="col-card col-md-3 col-md-offset-9">
                    <?php echo $cart; ?>
                </div>
                <div class="row">
                    <nav role="navigation" class="navbar navbar-default navbar-top col-md-12">
                        <div class="navbar-header col-xs-12">
                            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle pull-left">
                                <span class="sr-only">Menu</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>  
                                              
                            </button>                             
                        </div><!--navbar-header-->
        
                        <div id="navbarCollapse" class="collapse navbar-collapse pull-right col-xs-12">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><?php echo $text_navProdutos; ?></a></li>
                                <?php foreach ($informations as $information) { ?>
                                    <li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
                                <?php } ?>
                                <li><a href="<?php echo $infoseg; ?>"><?php echo $text_navInfoseg; ?></a></li>
                                <li><a href="<?php echo $contact; ?>"><?php echo $text_navContato; ?></a></li>
                                <li><a href="#"><?php echo $text_navTrabalhe; ?></a></li>
                            </ul>
                        </div><!--navbarCollapse-->
                    </nav>
                </div><!--row-->
            </div><!--col-md-9-->
        </div><!--row bg-top-header-->
        
         <div class="search-prod row">
            <div class="col-md-7 col-searchProd col-xs-8"><?php echo $search; ?></div>
            
            <div class="col-md-1 col-xs-6"><!--Busque por c.a--></div>
            
            <div class="col-md-4 col-info-contato col-xs-12">
                <div><div class="ico-faleconoscoTop"></div>
                <div class="tel-contato">31 3029.1477</div>
                <div class="text-funcionamento"><?php echo $text_funcionamento; ?></div></div>
            </div><!--col-md-4 col-xs-12-->
        </div><!--search-prod-->
    </header><!--container-->
</div><!--container-fluid-->

<div class="clearfix"></div>