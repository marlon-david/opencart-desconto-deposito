<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-pagseguro" data-toggle="tooltip" title="Salvar" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="Cancelar" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
      	<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-pagseguro" class="form-horizontal">

          <div class="form-group">
          	<label class="col-sm-2 control-label">Total mínimo:</label>
            <div class="col-sm-10">
              <input type="text" name="desconto_deposito_total" value="<?php echo $desconto_deposito_total; ?>" class="form-control float" />
            </div>
          </div>

          <div class="form-group">
          	<label class="col-sm-2 control-label">Porcentagem do desconto:</label>
            <div class="col-sm-10">
            	<div class="input-group">
              		<input type="text" name="desconto_deposito_valor" value="<?php echo $desconto_deposito_valor; ?>" class="form-control float" />
              		<span class="input-group-addon">%</span>
              	</div>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-shipping">Aplicar desconto também sobre o frete:</label>
            <div class="col-sm-10">
              <select name="desconto_deposito_shipping" id="input-shipping" class="form-control">
                <?php if ($desconto_deposito_shipping) { ?>
                <option value="1" selected="selected">Sim</option>
                <option value="0">Não</option>
                <?php } else { ?>
                <option value="1">Sim</option>
                <option value="0" selected="selected">Não</option>
                <?php } ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status">Situação:</label>
            <div class="col-sm-10">
              <select name="desconto_deposito_status" id="input-status" class="form-control">
                <?php if ($desconto_deposito_status) { ?>
                <option value="1" selected="selected">Habilitado</option>
                <option value="0">Desabilitado</option>
                <?php } else { ?>
                <option value="1">Habilitado</option>
                <option value="0" selected="selected">Desabilitado</option>
                <?php } ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort-order">Posição:</label>
            <div class="col-sm-10">
              <input type="number" name="desconto_deposito_sort_order" value="<?php echo $desconto_deposito_sort_order; ?>" placeholder="Posição" id="input-sort-order" class="form-control" />
            </div>
          </div>

      	</form>

      </div>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
function prepararFloat(el) {
  el.value = el.value.replace(/\,/g, '.');
  var posDecimal = el.value.lastIndexOf('.');
  if (posDecimal > 0) {
    var r = el.value.substr(0, posDecimal);
    r = r.replace(/\./g, '');
    r += el.value.substr(posDecimal);
    el.value = r;
  }
}
$('input.float').on('blur', function() {prepararFloat(this);});
//--></script>
<?php echo $footer; ?>
