<?php echo $header; ?>

<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
</div>    
<div id="cremes" class="container">
	<div class="row">
    	<nav class="col-md-3">
        	<ul>
            	<li class="active" data-pag="cremes-info">Informações Técnicas</li>
                <li data-pag="dermatoses">Dermatoses</li>
            </ul>
        </nav>
        
        <div class="col-md-9 dermatoses">
        	<h5>DERMATOSES</h5><br>
            <p>- São as doenças mais frequentes;<br><br>
                - Geram enormes custos sociais;<br><br>
                - Reduzem a qualidade de vida / motivação;<br><br>
                - Representam uma grande sobrecarga psicológica e social para a pessoa afetada;<br><br>
                - Podem levar a pessoa a abandonar o seu emprego;<br><br>
                - Podem ser evitadas!;<br><br> 
            </p>
            
			<div class="row">
            	<div class="col-md-6">
                	<img class="img-responsive center-block" src="<?php echo $data['dominio'];?>dermatoses1.png" alt=""><br class="hidden-md">
                </div>
                <div class="col-md-6">
                	<img class="img-responsive center-block" src="<?php echo $data['dominio'];?>dermatoses2.png" alt=""><br class="hidden-md">
                </div>
            </div><!--row-->
            <br><br>
            <h5>Proteger a pele é proteger as mãos</h5><br>
            <p>- 95% das doenças ocupacionais da pele são dermatites das mãos;<br><br>
                - Cerca de 65% dos acidentes que ocorrem envolvem as mãos.
            </p><br><br>
            
            <div class="row">
            	<div class="col-md-12">
                	<h5>Como se desenvolvem as doenças de pele</h5>
                </div>
            	<div class="col-md-4">
                	<img class="img-responsive center-block" src="<?php echo $data['dominio'];?>dermatoses3.png" alt=""><br>
					<img class="img-responsive center-block" src="<?php echo $data['dominio'];?>dermatoses4.png" alt=""><br class="hidden-md">
                </div>
                <div class="col-md-8">
                	<img class="img-responsive center-block" src="<?php echo $data['dominio'];?>dermatoses-aviso.png" alt=""><br class="hidden-md">
                </div>
            </div><!--row-->
            <br><br>
            <h5>Sintomas</h5><br>

            <p>- Eritema;<br><br>
                - Incha;<br><br>
                - Coceira;<br><br>
                - Ressecamento;<br><br>
                - Secreção;<br><br>
                - Crostas;<br><br>
                - Descamação;<br><br>
            </p>
            
            <h5>Dermatite de contato por irritantes</h5><br>

            <p>Causada pelo contato com substâncias agressiva ou materiais que causam danos à pele.</p><br>
            
            <div class="row">
            	<div class="col-md-3">
                	<img class="img-responsive center-block" src="<?php echo $data['dominio'];?>dermatoses5.png" alt=""><br class="hidden-md">
                </div>
                <div class="col-md-3">
                	<img class="img-responsive center-block" src="<?php echo $data['dominio'];?>dermatoses6.png" alt=""><br class="hidden-md">
                </div>
            </div><!--row-->
            
            <div class="clearfix"></div>
            
            <h5>Substâncias prejudiciais à pele</h5><br>

            <p>Exemplos de irritantes à base de água:<br><br>
            - Ácidos e bases;<br><br>
            - Solventes orgânicos;<br><br>
            - Desinfetantes;<br><br>
            - Detergentes;<br><br>
            - Lubrificantes de resfriamento água<br><br>
           	</p>
            
            <div class="row">
            	<div class="col-md-4">
                	<img class="img-responsive center-block" src="<?php echo $data['dominio'];?>dermatoses7.png" alt=""><br class="hidden-md">
                </div>
                <div class="col-md-4">
                	<img class="img-responsive center-block" src="<?php echo $data['dominio'];?>dermatoses8.png" alt=""><br class="hidden-md">
                </div>
                <div class="col-md-4">
                	<img class="img-responsive center-block" src="<?php echo $data['dominio'];?>dermatoses9.png" alt=""><br class="hidden-md">
                </div>
            </div><!--row-->
            
            <h5>Exemplos de irritantes à base de óleo:</h5><br>

            <p>- Solventes orgânicos;<br><br>
            - Óeos e graxas;<br><br>
            - Tntas e vernizes;<br><br>
            - Resinas;<br><br>
            - Componentes sintéticos de resinas<br><br>
            - Substâncias à base de alcatrão<br><br>
            - Óleo diesel e gasolina<br><br>
            </p>
            
             <div class="row"><br>
            	<div class="col-md-4">
                	<img class="img-responsive center-block" src="<?php echo $data['dominio'];?>dermatoses10.png" alt=""><br class="hidden-md">
                </div>
                <div class="col-md-4">
                	<img class="img-responsive center-block" src="<?php echo $data['dominio'];?>dermatoses11.png" alt=""><br class="hidden-md">
                </div>
                <div class="col-md-4">
                	<img class="img-responsive center-block" src="<?php echo $data['dominio'];?>dermatoses12.png" alt=""><br class="hidden-md">
                </div>
            </div><!--row-->
            <br><br>
            <h5>Tipos de alergia:</h5>
            
            <div class="row">
            	<div class="col-md-3">
                    <img class="img-responsive center-block" src="<?php echo $data['dominio'];?>alergia1.png" alt=""><br>
                     <img class="img-responsive center-block" src="<?php echo $data['dominio'];?>alergia2.png" alt=""><br class="hidden-md">
                </div>
                <div class="col-md-3">
                    <img class="img-responsive center-block" src="<?php echo $data['dominio'];?>alergia3.png" alt=""><br>
                    <img class="img-responsive center-block" src="<?php echo $data['dominio'];?>alergia4.png" alt=""><br class="hidden-md">
                </div>
            </div><!--row-->
            
            <div class="clearfix"></div>
            
            <div class="row">
                <div class="col-md-12"><br><br>
                    <h4>Programa de saúde da pele do trabalhador - <span style="color:#f57b20">TRATAMENTO COM PRODUTOS STOKO - 14 DIAS</span></h4><br>
                    
                    <img class="img-responsive center-block " src="<?php echo $data['dominio'];?>programa-saude.png" alt=""><br class="hidden-md">
                </div>
            </div>

        </div><!--dermatoses-->
        
        <div class="col-md-9 cremes-info" >
        	<h5>STOKO&reg; Skin Care – 70 anos de experiência na proteção da pele.</h5><br><br>

            <p>A empresa conta com uma longa tradição na produção de produtos de proteção, limpeza e cuidados da pele, resultando num know-how único na área de 
            cuidados ocupacional da pele.
            </p>    <br><br>    
            
            <div class="row">
            	<div class="col-md-4">
                	<img class="img-responsive center-block" src="<?php echo $data['dominio'];?>info-cremes1.png" alt=""><br class="hidden-md">
                </div>
            </div><!--row-->
            
            <div class=" clearfix"></div>
            
            <h5>Excelente compatibilidade cutânea</h5><br><br>
           <p> A compatibilidade cutânea de cada produto foi testada sob supervisão de dermatologistas independentes, utilizando os mais modernos sistemas de testes dermatológicos.</p><br>
            
            <div class="row">
                <div class="col-md-3">
                	<img class="img-responsive center-block" src="<?php echo $data['dominio'];?>info-cremes2.png" alt=""><br class="hidden-md">
                </div>
                <div class="col-md-3">
                	<img class="img-responsive center-block" src="<?php echo $data['dominio'];?>info-cremes3.png" alt=""><br class="hidden-md">
                </div>
                <div class="col-md-3">
                	<img class="img-responsive center-block" src="<?php echo $data['dominio'];?>info-cremes4.png" alt=""><br class="hidden-md">
                </div>
                <div class="col-md-3">
                	<img class="img-responsive center-block" src="<?php echo $data['dominio'];?>info-cremes5.png" alt=""><br class="hidden-md">
                </div><br><br>
            </div><!--row-->
            
            <h5>Produção de acordo com as Boas Práticas de Fabricação</h5><br><br>
            
            <p>Os produtos STOKO&reg; são produzidos com equipamentos modernos, sob padrões ideais de higiene e qualidade.</p><br>
            
            <div class="row">
            	<div class="col-md-4">
                	<img class="img-responsive center-block" src="<?php echo $data['dominio'];?>info-cremes6.png" alt=""><br class="hidden-md">
                </div>
                <div class="col-md-4">
                	<img class="img-responsive center-block" src="<?php echo $data['dominio'];?>info-cremes7.png" alt=""><br class="hidden-md">
                </div>
            </div><!--row-->
            
            <div class="clearfix"></div>
            
             <h5>Segurança microbiológica</h5><br><br>
            
            <p>Os produtos STOKO&reg; atendem aos padrões microbiológicos para produtos farmacêuticos (menos de 102 germes por grama de produto).</p><br>
            
            <div class="row">
            	<div class="col-md-4">
                	<img class="img-responsive center-block" src="<?php echo $data['dominio'];?>info-cremes8.png" alt=""><br class="hidden-md">
                </div>
                <div class="col-md-4">
                	<img class="img-responsive center-block" src="<?php echo $data['dominio'];?>info-cremes9.png" alt=""><br class="hidden-md">
                </div>
            </div><!--row-->
            
            <div class="clearfix"></div>
            
            
             <h5>Validade de 60 meses</h5><br><br>
            
            <p>STOKO&reg; Skin Care garante a manutenção das propriedades do produto por um período de 60 meses.</p><br>
            
            <div class="row">
            	<div class="col-md-4">
                	<img class="img-responsive center-block" src="<?php echo $data['dominio'];?>info-cremes10.png" alt=""><br class="hidden-md">
                </div>
                <div class="col-md-4">
                	<img class="img-responsive center-block" src="<?php echo $data['dominio'];?>info-cremes11.png" alt=""><br class="hidden-md">
                </div>
            </div><!--row-->
            
            <div class="clearfix"></div>
            
            <h5>Ingredientes exclusivos da Stockhausen</h5><br><br>

            <p>STOKO® Skin Care utiliza ingredientes cosméticos de elevada pureza e potencial mínimo para irritação ou alergias (“Código de Prática”).<br><br>
            
            Ingredientes de alta qualidade:</p><br><br>
            
            <h5>STOKO&reg; Skin Care detém a propriedade de diversas patentes no campo dos cuidados ocupacionais da pele:</h5><br><br>
            <p>
                • ASTOPON&reg; - Agente limpador – farinha de casca de nozes.<br><br>
                • STOKOPON&reg; - Sistema limpador – óleo natural e surfactantes.<br><br>
                • EUCORIOL&reg; - Agente adstringente – Bisclorofenil Sulfamina Sódica.<br><br>
                • EUCORNOL&reg; - Protetor cutâneo – óleo sulfatado de rícino.<br><br>
            </p>
            
        </div><!--cremes-info-->
    </div><!--row-->
</div><!--cases-->

<script>
$(document).ready(function(e) {
    function active(id){
		var attr = $('.active').attr('data-pag');
		var attr2 = $(id).attr('data-pag');
		
		$('.'+attr).css('display','none');
		$('.'+attr2).css('display','block');
		
		$('.active').removeClass('active');
		$(id).addClass('active');
	}	
	
	$('nav ul li').each(function(index, element) {
        $(this).on('click',function(e){
			active(this);
		});
    });
});
</script>
<?php echo $footer; ?>
