<?php echo $header; ?>

<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?><span> ></span></a></li>
    <?php } ?>
  </ul>
</div>    
<div id="servicos" class="container">
	<div class="row">
    	<div class="col-md-12">
            <p>Há 20 anos Assistência Técnica especializada com toda infraestrutura para a linha de instrumentos portáteis (detectores monos e multi-gás) e proteção respiratória 
MSA, além de nossa linha de lanternas e cases.</p>

            <img alt="" src="<?php echo $data['dominio'];?>servicos01.png">
            <img alt="" src="<?php echo $data['dominio'];?>servicos02.png">
            <img alt="" src="<?php echo $data['dominio'];?>servicos03.png">
            <img alt="" src="<?php echo $data['dominio'];?>servicos04.png">
            <img alt="" src="<?php echo $data['dominio'];?>servicos06.png">
        </div>
    </div>
</div>
<?php echo $footer; ?>
