<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-infoseg" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $heading_title; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-news" class="form-horizontal">
          <ul class="nav nav-tabs" id="language">
			<?php foreach ($languages as $language) { ?>
			<li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
			<?php } ?>
		  </ul>
		  <div class="tab-content">
			<?php foreach ($languages as $language) { ?>
			<div class="tab-pane" id="language<?php echo $language['language_id']; ?>">
			  <div class="form-group required">
				<label class="col-sm-2 control-label" for="input-title<?php echo $language['language_id']; ?>"><?php echo $text_title; ?></label>
				<div class="col-sm-10">
				  <input type="text" name="infoseg[<?php echo $language['language_id']; ?>][nome]" value="<?php echo isset($infoseg[$language['language_id']]) ? $infoseg[$language['language_id']]['nome'] : ''; ?>" placeholder="<?php echo $text_title; ?>" id="input-nome<?php echo $language['language_id']; ?>" class="form-control" />
				</div>
			  </div>
			  <div class="form-group required">
				<label class="col-sm-2 control-label" for="input-edicao<?php echo $language['language_id']; ?>"><?php echo $text_edicao; ?></label>
				<div class="col-sm-10">
				  <input type="text" name="infoseg[<?php echo $language['language_id']; ?>][edicao]" value="<?php echo isset($infoseg[$language['language_id']]) ? $infoseg[$language['language_id']]['edicao'] : ''; ?>" placeholder="<?php echo $text_edicao; ?>" id="input-edicao<?php echo $language['language_id']; ?>" class="form-control" />
				</div>
			  </div>
			</div>
			<?php } ?>
		  </div>
		  <div class="form-group required">
			<label class="col-sm-2 control-label" for="input-image"><?php echo $text_image; ?></label>
			<div class="col-sm-10">
			  <a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $no_image; ?>" /></a>
			  <input type="hidden" name="image" value="<?php echo $capa; ?>" id="input-image" />
			</div>
		  </div>  
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-date-available"><?php echo $entry_date_available; ?></label>
                  <div class="col-sm-3">
                    <div class="input-group date">
                      <input type="text" name="date_available" value="<?php echo $data; ?>" placeholder="<?php echo $entry_date_available; ?>" data-date-format="YYYY-MM-DD" id="input-date-available" class="form-control" />
                      <span class="input-group-btn">
                      <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                      </span></div>
                  </div>
                </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>