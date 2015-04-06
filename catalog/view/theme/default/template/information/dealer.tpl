<?php echo $header; ?>

<div class="container contato">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
	<div class="row" >
    	<div class="col-md-12">
        	<h1>Seja um Parceiro</h1><br>
        </div>
    </div>
	<div class="row">
    	<div class="col-md-4 col-sm-6">
        	<p>Sua empresa tem interesse em ter em seu portfólio o que há de mais avançado e exclusivo no mundo em lanternas profissionais, antiexplosão, Cases especiais e maletas para ferramentas e sistemas de detecção de gases através de tubos colorimétricos, sendo um Revendedor ou Distribuidor?</p><p>Preencha o cadastro que teremos o prazer em contatá-los para fornecimento de informações adicionais.</p> 
</p><br>
        </div><!--col-md-4 col-sm-6-->
        
       <div class="col-md-8 col-sm-6">
        	<div class="row">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                  <div class="col-md-6">
                    <input id="input-name" type="text" placeholder="Nome" name="name" value="<?php echo $name; ?>" required>
                    <?php if ($error_name) { ?>
                      	<div class="text-danger"><?php echo $error_name; ?></div>
                     <?php } ?>
                    <input id="input-email" type="email" placeholder="E-mail" name="email" value="<?php echo $email; ?>" required>
                    <?php if ($error_email) { ?>
                  		<div class="text-danger"><?php echo $error_email; ?></div>
                    <?php } ?>
                    <input id="input-telephone" type="tel"  placeholder="Telefone" name="telephone" required>
                    <select class="campo-estado" name="estados">
                        <option value="">Selecione o Estado</option>
                        <option value="AC">Acre</option>
                        <option value="AL">Alagoas</option>
                        <option value="AP">Amapá</option>
                        <option value="AM">Amazonas</option>
                        <option value="BA">Bahia</option>
                        <option value="CE">Ceará</option>
                        <option value="DF">Distrito Federal</option>
                        <option value="ES">Espirito Santo</option>
                        <option value="GO">Goiás</option>
                        <option value="MA">Maranhão</option>
                        <option value="MS">Mato Grosso do Sul</option>
                        <option value="MT">Mato Grosso</option>
                        <option value="MG">Minas Gerais</option>
                        <option value="PA">Pará</option>
                        <option value="PB">Paraíba</option>
                        <option value="PR">Paraná</option>
                        <option value="PE">Pernambuco</option>
                        <option value="PI">Piauí</option>
                        <option value="RJ">Rio de Janeiro</option>
                        <option value="RN">Rio Grande do Norte</option>
                        <option value="RS">Rio Grande do Sul</option>
                        <option value="RO">Rondônia</option>
                        <option value="RR">Roraima</option>
                        <option value="SC">Santa Catarina</option>
                        <option value="SP">São Paulo</option>
                        <option value="SE">Sergipe</option>
                        <option value="TO">Tocantins</option>
                    </select>
                    <input id="input-cidade" type="text"  placeholder="Cidade" name="cidade">
                  </div><!--col-md-6-->
                  
                   <div class="col-md-6">
                        <input id="input-empresa" type="text"  placeholder="Empresa" name="empresa" required>
                        <textarea id="input-enquiry" placeholder="Mensagem" name="enquiry" required><?php echo $enquiry; ?></textarea>
                        <?php if ($error_enquiry) { ?>
                      		<div class="text-danger"><?php echo $error_enquiry; ?></div>
                        <?php } ?>
                        <input type="submit" value="<?php echo $button_submit; ?>">
                   </div>
                </form>
            </div><!--row-->
        </div><!--col-md-8 col-sm-6-->       
    </div><!--row-->
</div><!--container--><?php echo $footer; ?>
