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
                    <img class="pull-left" src="" alt="Image" width="220">
                    <div class="pull-left title-rev">
                     <h3></h3>
                     <a href="" title="Leia Agora" class="baixar-infoseg">Leia Agora > </a>
                    </div>
                </div>
            </div>
        </div><!--col-md-4-->
        
        <div class="col-md-8 col-sm-7 revista">
            <script type="text/javascript" src="//e.issuu.com/embed.js" async="true"></script>
        </div><!--col-md-8-->
    </div><!--row-->
 	
    <div id="slide" class="row">
      <div class="col-md-12">
            <div id="myCarousel" class="carousel slide">
            <!-- Carousel items -->
                <div class="jcarousel">
                    <ul class="row-fluid infosegs">
                        <?php if ($data['infosegs']) { ?>
                            <?php foreach ($data['infosegs'] as $infoseg) { ?>
                                <li class="col-md-2 col-sm-2 col-xs-2 infoseg">
                                    <div data-config="<?php echo $infoseg['cod_revista']; ?>" data-id="<?php echo $infoseg['id_issuu']; ?>" data-arquivo ="<?php echo $infoseg['arquivo']; ?>" data-title="<?php echo $infoseg['title']; ?>" class="thumbnail text-center">
                                        <img src="<?php echo $infoseg['capa']; ?>" alt="Image">
                                        <span class="title-ed">Edição n&deg;<?php echo $infoseg['edicao']; ?></span>
                                    </div>
                                </li>
                            <?php } ?>
                        <?php } ?>
                        <!--col-md-2-->
                    </ul><!--/row-fluid-->
                </div><!--/item-->
                <a class="left carousel-control jcarousel-control-prev" href="#" data-slide="prev"></a>
                <a class="right carousel-control jcarousel-control-next" href="#" data-slide="next"></a>
            </div><!--/myCarousel-->
      </div><!--col-md-12-->
    </div><!--row-->
</div><!--info-seg-->
<script>
    //iniciar revista principal
    var configid = $('.infosegs li div:first-child').attr('data-id')+'/'+$('.infosegs li div:first-child').attr('data-config');
    var arquivo = $('.infosegs li div:first-child').attr('data-arquivo');
    var title = $('.infosegs li div:first-child').attr('data-title');
    var capa = $('.infosegs li div img:first-child').attr('src');
    $('.leia-agora img').attr('src', capa);
    $('.leia-agora h3').append(title);
    $('.revista').append('<div data-configid="'+configid+'" style="width:auto; height:600px;" class="issuuembed"></div>');
    $('.baixar-infoseg').attr('href', arquivo);
    
    // função de alterar revista principal
    $( ".infoseg" ).click(function() {
            $( ".leia-agora h3,.revista" ).empty();
            var s = document.createElement("script");
            s.type = "text/javascript";
            s.src = "//e.issuu.com/embed.js";
            configid = $(this).find("div").attr('data-id')+'/'+$(this).find("div").attr('data-config');
            arquivo = $(this).find("div").attr('data-arquivo');
            title = $(this).find("div").attr('data-title');
            capa = $(this).find("img").attr('src');
            $('.leia-agora img').attr('src', capa);
            $('.leia-agora h3').append(title);
            $('.revista').append('<div data-configid="'+configid+'" style="width:auto; height:600px;" class="issuuembed"></div>');
            $(".revista").append(s);
            $('.baixar-infoseg').attr('href', arquivo);
    });
    
</script>    
<?php echo $footer; ?>
