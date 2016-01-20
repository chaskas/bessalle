<div>
  <ul class="nav nav-tabs right-to-left" role="tablist">
    <li role="presentation" class="active"><a href="<?php echo site_url('admin/products');?>" aria-controls="categorias" role="tab">Stock Histórico</a></li>
  </ul>

  <div class="tab-content padding-top-30">
    <div role="tabpanel" class="tab-pane active" id="categorias">

        <h3>Ingreso Histórico</h3>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="text-center">Fecha</th>
                    <th class="text-center">Categoría</th>
                    <th class="text-center">Producto</th>
                    <th class="text-center">Stock</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td class="text-center"><?php echo date_format(date_create($product->date), 'd/m/Y H:i'); ?></td>
                    <td class="text-center"><?php echo $product->category_name; ?></td>
                    <td class="text-center"><?php echo $product->product_name; ?></td>
                    <td class="text-center"><?php echo $product->quantity; ?></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
  </div>

</div>
