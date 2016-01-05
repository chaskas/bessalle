<div>
  <ul class="nav nav-tabs right-to-left" role="tablist">
    <li role="presentation" class="active"><a href="<?php echo site_url('admin/ordenes');?>" aria-controls="ordenes" role="tab">Órdenes por Retirar</a></li>
  </ul>

  <div class="tab-content padding-top-30">
    <div role="tabpanel" class="tab-pane active" id="ordenes">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="text-center">Fecha</th>
                    <th class="text-center">Código</th>
                    <th class="text-center">RUT</th>
                    <th>Razón Social</th>
                    <th class="text-right">Monto</th>
                    <th class="text-center">Carrier</th>
                    <th class="text-center">Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                <tr>
                    <td class="text-center"><?php echo  date_format(date_create($order->date), 'd/m/Y'); ?></td>
                    <td class="text-center"><?php echo "IN".$order->id; ?></td>
                    <td class="text-center"><?php echo $order->rut; ?></td>
                    <td><?php echo $order->name; ?></td>
                    <td class="text-right">$<?php echo number_format ( $order->neto + $order->iva , 0 , "," , "." ); ?>.-</td>
                    <td class="text-center"><?php if ( $order->carrier == 0 ) { echo 'Chilexpress'; } else if ( $order->carrier == 1 ) { echo 'Memphis'; } else { echo 'Retiro en Bodega'; } ?></td>
                    <td class="text-center">
                        <div class="btn-group btn-group-xs" role="group">
                            <a href="<?php echo site_url('admin/order/'.$order->id);?>" class="btn btn-default" title="Detalle"><span class="glyphicon glyphicon-list-alt"></span></a>
                            <a href="<?php echo site_url('admin/order/download/'.$order->id);?>" class="btn btn-default" title="Descargar" target="_blank"><span class="glyphicon glyphicon-download-alt"></span></a>
                            <a href="<?php echo site_url('admin/order/withdraw_confirm/'.$order->id);?>" class="btn btn-default" title="Confirmar el Retiro" onclick="return confirm('¿Deseas confirmar el Retiro?')"><span class="glyphicon glyphicon-ok"></span></a>
                        </div>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
  </div>

</div>
