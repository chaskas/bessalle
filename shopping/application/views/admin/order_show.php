<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Orden: <?php echo "IN".$order->id; ?></h3>
    </div>
    <div class="panel-body">

        <div class="row">
            <div class="col-md-12">
                <h4>Información de Facturación</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label>Razón Social:</label>
                <br>
                <?php echo $order->billing_name; ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <label>RUT:</label>
                <br>
                <?php echo $order->billing_rut; ?>
            </div>
            <div class="col-md-8">
                <label>Giro:</label>
                <br>
                <?php echo $order->billing_business; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label>Direción:</label>
                <br>
                <?php echo $order->billing_address1.", ".$order->billing_address2; ?>
            </div>
            <div class="col-md-3">
                <label>Comuna:</label>
                <br>
                <?php echo $billing_comuna; ?>
            </div>
            <div class="col-md-3">
                <label>Provincia:</label>
                <br>
                <?php echo $billing_provincia; ?>
            </div>
            <div class="col-md-3">
                <label>Región:</label>
                <br>
                <?php echo $billing_region; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label>Fono:</label>
                <br>
                <?php echo $order->billing_phone; ?>
            </div>
            <div class="col-md-6">
                <label>Email:</label>
                <br>
                <?php echo $order->billing_email; ?>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-12">
                <h4>
                    Productos
                </h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-right">Valor Unitario</th>
                            <th class="text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product) : ?>
                        <tr>
                            <td><?php echo $product->name; ?></td>
                            <td class="text-center"><?php echo $product->quantity; ?></td>
                            <td class="text-right">$<?php echo number_format ( $product->price , 0 , "," , "." ); ?></td>
                            <td class="text-right">$<?php echo number_format ( $product->quantity * $product->price , 0 , "," , "." ); ?></td>
                        </tr>
                        <?php endforeach; ?>

                        <tr>
                            <td colspan="3" class="text-right">Subtotal</td>
                            <td class="text-right">$<?php echo number_format ( $order->neto , 0 , "," , "." ); ?></td>
                        </tr>



                    </tbody>
                </table>

            </div>
        </div>

        <br>
        <div class="row">
            <div class="col-md-12">

                <table class="table table-condensed">
                    <tbody>
                        <tr>
                            <td colspan="3" class="text-right">Subtotal</td>
                            <td class="text-right">$<?php echo number_format ( $order->neto , 0 , "," , "." ); ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-right">IVA</td>
                            <td class="text-right">$<?php echo number_format ( $order->iva , 0 , "," , "." ); ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-right">Total</td>
                            <td class="text-right">$<?php echo number_format ( $order->neto + $order->iva , 0 , "," , "." ); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-2"><label>Método de Pago:</label></div>
            <?php if($order->payment_type == 0) : ?>
                <div class="col-md-3">Transferencia Bancaria</div>
                <div class="col-md-3"><label>Monto:</label> $<?php echo number_format ( $order->payment_amount , 0 , "," , "." ); ?></div>
                <div class="col-md-4"><label>Fecha:</label> <?php echo date_format(date_create($order->payment_date), 'd/m/Y'); ?></div>
                <div class="col-md-4"></div>
            <?php else : ?>
                <div class="col-md-10">WebPay</div>
            <?php endif; ?>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <h4>
                    Información del Envío
                </h4>

            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label>Nombre Completo:</label>
                <br>
                <?php echo $order->shipping_name; ?>
            </div>

            <div class="col-md-6">
                <label>RUT:</label>
                <br>
                <?php echo $order->shipping_rut; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label>Direción:</label>
                <br>
                <?php echo $order->shipping_address1.", ".$order->shipping_address2; ?>
            </div>
            <div class="col-md-3">
                <label>Comuna:</label>
                <br>
                <?php echo $shipping_comuna; ?>
            </div>
            <div class="col-md-3">
                <label>Provincia:</label>
                <br>
                <?php echo $shipping_provincia; ?>
            </div>
            <div class="col-md-3">
                <label>Región:</label>
                <br>
                <?php echo $shipping_region; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label>Fono:</label>
                <br>
                <?php echo $order->shipping_phone; ?>
            </div>
            <div class="col-md-6">
                <label>Email:</label>
                <br>
                <?php echo $order->shipping_email; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label>Método de Envío:</label>
                <br>
                <?php if ( $order->carrier == 0 ) { echo 'Chilexpress'; } else if ( $order->carrier == 1 ) { echo 'Memphis'; } else { echo 'Retiro en Bodega'; } ?>
            </div>
            <div class="col-md-4">
                <label>Costo Envío:</label>
                <br>
                $<?php echo number_format ( $order->shipping_cost , 0 , "," , "." ); ?>
            </div>
            <div class="col-md-4">
                <label>Código de Seguimiento:</label>
                <br>
                <?php echo $order->tracking_number; ?>
            </div>
        </div>

        <?php if($order->carrier == 2) : ?>
            <div class="row">
                <div class="col-md-12">
                    <label>Datos de quién retira:</label>
                    <br>
                    <?php echo "RUT: ".$order->withdrawer_rut." Nombre: ".$order->withdrawer_name; ?>
                </div>
            </div>
        <?php endif; ?>

    </div>
    <div class="panel-footer text-right">
        <a href="<?php echo site_url('admin/order/download/'.$order->id);?>" class="btn btn-success" target="_blank">PDF</a>
    </div>
</div>
