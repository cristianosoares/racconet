<?php echo $header; ?>

<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?><span> ></span></a></li>
    <?php } ?>
  </ul>
</div>    

<div id="sistemas-iluminacao" class="container">

    <div class="row">
    	<div class="col-md-4">
        	<h3>Informações técnicas</h3>
        </div>
        
        <div class="col-md-8">
        	<div class="row">
            	<div class="col-md-12">
                	<p>Dispomos do que há de melhor no mundo em sistemas de iluminação remota. Modelos Pelican e Racco by NS. Ideais para falta de energia, indústrias em geral. metrô, edifícios públicos, rodovias, ferrovias, resgates, obras,etc.<br>
Kit`s com alta capacidade de iluminação, com até 28.000 lumens de potência e autonomia de até 70 horas de uso contínuo. 
</p>
                </div>
            </div>
            <div class="row">
            	<div class="col-md-4">
                	<img class="img-responsive" src="<?php echo $data['dominio'];?>info-sistemas-iluminacao1.png" alt=""><br>
                    <img class="img-responsive" src="<?php echo $data['dominio'];?>info-sistemas-iluminacao4.png" alt="">
                </div>
                <div class="col-md-4">
                	<img class="img-responsive" src="<?php echo $data['dominio'];?>info-sistemas-iluminacao2.png" alt="">
                </div>
                <div class="col-md-4">
                	<img class="img-responsive" src="<?php echo $data['dominio'];?>info-sistemas-iluminacao3.png" alt=""><br>
                    <img style="max-width:67%;margin: auto;" class="img-responsive" src="<?php echo $data['dominio'];?>/info-sistemas-iluminacao5.png" alt="">
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $footer; ?>
