<div>
  <ul class="nav nav-tabs right-to-left" role="tablist">
    <li role="presentation" class="active"><a href="<?php echo site_url('admin/ordenes');?>" aria-controls="ordenes" role="tab">Órdenes por Pagar</a></li>
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
                            <button class="btn btn-default" title="Confirmar el Pago" data-toggle="modal" data-target="#modal_payment" onclick="javascript:setOrderId(<?php echo $order->id; ?>)"><span class="glyphicon glyphicon-ok"></span></button>
                        </div>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
  </div>

</div>

<div class="modal fade" id="modal_payment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form action="<?php echo site_url('admin/order/payment_confirm');?>" method="post">
        <input type="hidden" id="order_id" name="order_id">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Confirmar Pago</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="order_payment_date">Fecha en que se realizó el pago:</label>
                            <input type="text" class="form-control" id="order_payment_date" name="order_payment_date" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="order_payment_amount">Monto Pagado:</label>
                            <input type="text" class="form-control" id="order_payment_amount" name="order_payment_amount" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Aceptar</button>
            </div>
        </div>
        </form>
    </div>
</div>

<script>

    function setOrderId(order_id) {
        $('#order_id').val(order_id);
    }

    $(function() {
        $( "#order_payment_date" ).datepicker();
    });

</script>
