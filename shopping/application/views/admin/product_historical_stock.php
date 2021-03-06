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
                    <th class="text-center">Stock Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td class="text-center"><a href="<?php echo site_url('admin/product_historical_stock_detailed/'.date_format(date_create($product->date), 'd-m-Y')); ?>"><?php echo date_format(date_create($product->date), 'd/m/Y'); ?></a></td>
                    <td class="text-center"><?php echo $product->quantity; ?></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
  </div>

</div>
