<?php echo $header; ?>

<div class="container contato">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
	<div class="row" >
    	<div class="col-md-12">
        	<h1>Trabalhe Conosco</h1><br>
        </div>
    </div>
	<div class="row">
    	<div class="col-md-4 col-sm-6">
        	<p>Preencha todos os campos do formulário
				e anexe seu currículo.</p><br>
			<br>
            <!--<p><strong>Vagas abertas para:</strong></p>-->
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
                    <div class="fileUpload">
                    	<div>
                        	Anexo <span class="glyphicon glyphicon-paperclip"></span>
                        </div>
                        
                    	<input type="file" placeholder="Anexo" name="anexo" class="upload">
                        <span class="curriculo"></span>
                    </div><!--fileUpload-->
                  </div><!--col-md-6-->
                  
                   <div class="col-md-6">
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
