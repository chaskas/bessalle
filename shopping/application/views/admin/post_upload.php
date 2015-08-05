<div>
  <ul class="nav nav-tabs right-to-left" role="tablist">
    <li role="presentation"><a href="<?php echo site_url('admin/product/new');?>" aria-controls="nuevo" role="tab">Nuevo</a></li>
    <li role="presentation"><a href="<?php echo site_url('admin/products');?>" aria-controls="productos" role="tab">Productos</a></li>
  </ul>

  <div class="tab-content padding-top-30">
    <div role="tabpanel" class="tab-pane active">

            <div class="panel panel-default">
                <?php echo form_open_multipart('admin/post_upload/'.$product->id, array('onsubmit'=>'return checkCoords()')) ?>
                <div class="panel-heading">
                    <h3 class="panel-title">Recortar Imagen</h3>
                </div>
                <div class="panel-body">

                    <p class="text-center">
                        <br>
                        Por favor recorte el área que desea usar como imagen.<br><br>
                    </p>

                    <?php echo form_input(array('type'=>'hidden', 'id' =>'x'));?>
                    <?php echo form_input(array('type'=>'hidden', 'id' =>'y'));?>
                    <?php echo form_input(array('type'=>'hidden', 'id' =>'w'));?>
                    <?php echo form_input(array('type'=>'hidden', 'id' =>'h'));?>

                    <div class="text-center">
                        <?php if($product->image == null || $product->image == '') : ?>
                            <?php echo $error; ?>
                            <?php echo img(array('src'=>'assets/images/placeholder.jpg','class'=>'img-thumbnail','id'=>'image')); ?>
                        <?php else : ?>
                            <?php echo img(array('src'=>$product->image,'class'=>'img-thumbnail','id'=>'image')); ?>
                        <?php endif; ?>
                    </div>


                </div>
                <div class="panel-footer text-right">
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
                </form>
            </div>
        </form>
    </div>
  </div>

</div>
