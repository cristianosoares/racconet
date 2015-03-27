<?php echo $header; ?>
<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
</div>   
<div id="info-seg" class="container">    
    <div id="header" class="row">
    	<div id="cadastro-email" class="col-md-5 col-md-offset-7 col-sm-6 col-sm-offset-6">
        	<p >Cadastre-se e receba as novas edições do InfoSeg em seu e-mail.</p><br>
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
            	<input id="input-name" type="text" placeholder="Nome" name="name" value="<?php echo $name; ?>" required>
                <?php if ($error_name) { ?>
                   <div class="text-danger"><?php echo $error_name; ?></div>
                <?php } ?>
                <input id="input-empresa" type="text" placeholder="Empresa" name="empresa" value="<?php echo $empresa; ?>" required>
                <?php if ($error_empresa) { ?>
                   <div class="text-danger"><?php echo $error_empresa; ?></div>
                <?php } ?>
                <input id="input-email" type="email" placeholder="E-mail" name="email" value="<?php echo $email; ?>" required>
                <?php if ($error_email) { ?>
                            <div class="text-danger"><?php echo $error_email; ?></div>
                <?php } ?>
                <input type="submit" value="<?php echo $button_submit; ?>">
            </form>
        </div><!--col-md-4 col-md-offset-8-->
    </div><!--row-->
    <div class="clearfix"></div>
    <div class="row">
    	<div class="col-md-4 col-sm-5">
        	<h1>A InfoSeg</h1>
            <p>A Racco Brasil, imbuída do firme propósito em contribuir para a difusão de informações relacionadas com a Higiene, Saúde e Segurança do Trabalho, tendo como foco o desenvolvimento e o crescimento profissional das pessoas envolvidas e devotadas à permanente realização do bem comum, resolveu produzir o informativo eletrônico INFOSEG&reg;.<br><br>

Lançado há mais de dez anos, tem como objetivo de seus editores levar a mais de dezoito mil assinantes, valendo-se da agilidade e interatividade da internet, assuntos do mais elevado interesse.</p><br>
			
            <div class="row">
                <div class="leia-agora col-md-10 col-sm-10 col-xs-6">
                    <img class="pull-left" src="images/revista-thumb.png" alt="Image">
                    <div class="pull-right">
                     <h3> Edição n&deg;35</h3>
                     <a href="#" title="Leia Agora">Leia Agora > </a>
                    </div>
                </div>
            </div>
        </div><!--col-md-4-->
        
        <div class="col-md-8 col-sm-7">
        	<img class="center-block" src="images/resvista-destaque.png" alt="Info Seg">
           
        </div><!--col-md-8-->
    </div><!--row-->
 	
    <div id="slide" class="row">
      <div class="col-md-12">
            <div id="myCarousel" class="carousel slide">
            <!-- Carousel items -->
            <div class="carousel-inner">
                <div class="item col-md-10 col-md-offset-1 col-sm-12 active">
                    <div class="row-fluid">
                        <div class="col-md-2 col-sm-2 col-xs-2">
                            <a href="#x" class="thumbnail text-center">
                            	<img src="images/revista-thumb.png" alt="Image">
                                Edição n&deg;35
                            </a>
                        </div><!--col-md-2-->
                        <div class="col-md-2 col-sm-2 col-xs-2">
                            <a href="#x" class="thumbnail text-center">
                            	<img src="images/revista-thumb.png" alt="Image">
                                Edição n&deg;35
                            </a>
                        </div><!--col-md-2-->
                        <div class="col-md-2 col-sm-2 col-xs-2">
                            <a href="#x" class="thumbnail text-center">
                            	<img src="images/revista-thumb.png" alt="Image">
                                Edição n&deg;35
                            </a>
                        </div><!--col-md-2-->
                        <div class="col-md-2 col-sm-2 col-xs-2">
                            <a href="#x" class="thumbnail text-center">
                            	<img src="images/revista-thumb.png" alt="Image">
                                Edição n&deg;35
                            </a>
                        </div><!--col-md-2-->
                        <div class="col-md-2 col-sm-2 col-xs-2">
                            <a href="#x" class="thumbnail text-center">
                            	<img src="images/revista-thumb.png" alt="Image">
                                Edição n&deg;35
                            </a>
                        </div><!--col-md-2-->
                        <div class="col-md-2 col-sm-2 col-xs-2">
                            <a href="#x" class="thumbnail text-center">
                            	<img src="images/revista-thumb.png" alt="Image">
                                Edição n&deg;35
                            </a>
                        </div><!--col-md-2-->
                    </div><!--/row-fluid-->
                </div><!--/item-->
                
                 
            </div><!--/carousel-inner-->
             
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            	
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
            	
            </a>
            </div><!--/myCarousel-->
      </div><!--col-md-12-->
    </div><!--row-->
</div><!--info-seg-->
<?php echo $footer; ?>
