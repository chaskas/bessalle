<div>
  <ul class="nav nav-tabs right-to-left" role="tablist">
    <li role="presentation" class="active"><a href="<?php echo site_url('admin/products');?>" aria-controls="productos" role="tab">Stock</a></li>
  </ul>

  <div class="tab-content padding-top-30">
    <div role="tabpanel" class="tab-pane active" id="productos">

        <div class="panel panel-default">
            <?php echo form_open('admin/stock/add/'.$product->id) ?>
            <div class="panel-heading">
                <div class="panel-title">Agregar Stock</div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group">
                            <label for="product">Producto</label>
                            <p><?php echo $product->category_name." - ".$product->name; ?></p>
                            <input type="hidden" name="product_id" value="<?php echo $product->id ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="quantity">Cantidad</label>
                            <input type="text" name="stock" class="form-control" />
                        </div>
                    </div>

                </div>
            </div>
            <div class="panel-footer text-right">
                <input type="submit" name="submit" value="Agregar" class="btn btn-success ">
            </div>
            </form>
        </div>

    </div>
  </div>

</div>
