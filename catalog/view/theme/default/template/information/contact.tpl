<?php echo $header; ?>

<div class="container contato">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
	<div class="row" >
    	<div class="col-md-12">
        	<h1>Contato</h1><br>
        </div>
    </div>
	<div class="row">
    	<div class="col-md-4 col-sm-6">
        	<p>Preencha todos os campos do formulário
				em breve retornaremos seu contato.</p><br>
			<br>
            <p><span><strong>31 3029.1477</strong></span><br><em>De segunda à sexta<br>de 8h às 18h</em></p>
        </div>
        
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
                    <input id="input-empresa" type="text" placeholder="Empresa" name="empresa" required>
                   </div>
                   <div class="col-md-6">
                   		<textarea id="input-enquiry" placeholder="Mensagem" name="enquiry" required><?php echo $enquiry; ?></textarea>
                        <?php if ($error_enquiry) { ?>
                      		<div class="text-danger"><?php echo $error_enquiry; ?></div>
                        <?php } ?>
                        <input type="submit" value="<?php echo $button_submit; ?>">
                   </div>
                </form>
            </div>
        </div>        
    </div><!--row-->
</div><!--container--><?php echo $footer; ?>
