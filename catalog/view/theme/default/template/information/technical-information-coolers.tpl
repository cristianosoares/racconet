<?php echo $header; ?>

<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?><span> ></span></a></li>
    <?php } ?>
  </ul>
</div>    
<div id="coolers" class="container">

    <div class="row">
    	<div class="col-md-4">
        	<h3>Informações técnicas</h3>
        </div>
        
        <div class="col-md-8">
        	<div class="row">
            	<div class="col-md-12">
                	<p>Perfeito não só para empresas que necessitam de refrigeração para seus produtos por um longo tempo, mas também para hospitais, 
transporte de orgãos, laboratórios, medicamentos e para todos os amantes de festas, churrascos, lazer, esportes, praia e aventura. A certeza
da manutenção de alimentos, bebidas, exames, amostras, produtos na temperatura pré-definida sem a necessidade de energia.<br>
<br>
Disponível em oito tamanhos e versões com rodizios.
</p>
                </div>
            </div>
            <div class="row">
            	<div class="col-md-4">
                	<img class="img-responsive" src="<?php echo $data['dominio'];?>cooler-1-1.png" alt=""><br>
                    <img class="img-responsive" src="<?php echo $data['dominio'];?>cooler-1-2.png" alt="">
                </div>
                <div class="col-md-4">
                	<img style="margin-top:5px;" class="img-responsive" src="<?php echo $data['dominio'];?>cooler-2.png" alt="">
                </div>
                <div class="col-md-4">
                	<img class="img-responsive" src="<?php echo $data['dominio'];?>cooler-3-1.png" alt=""><br>
                    <img style="max-width: 71%;margin: auto;" class="img-responsive" src="<?php echo $data['dominio'];?>cooler-3-2.png" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $footer; ?>
