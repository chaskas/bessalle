<nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo site_url('admin')?>">Bessalle</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li class="dropdown <?php echo active_menu('catalogo'); ?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Catálogo <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="<?php echo site_url('admin/categories') ?>">Categorías</a></li>
              <li><a href="<?php echo site_url('admin/products') ?>">Productos</a></li>
            </ul>
          </li>
          <li class="dropdown <?php echo active_menu('transporte'); ?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Transportes <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="<?php echo site_url('admin/transport/chilexpress') ?>">Chilexpress</a></li>
              <li><a href="<?php echo site_url('admin/transport/memphis') ?>">Memphis</a></li>
            </ul>
          </li>
          <li class="<?php echo active_menu('clientes'); ?>"><a href="<?php echo site_url('admin/users') ?>">Clientes</a></li>
          <li class="dropdown <?php echo active_menu('ordenes'); ?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Órdenes <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="<?php echo site_url('admin/orders/paid') ?>">Pagadas</a></li>
              <li><a href="<?php echo site_url('admin/orders/payable') ?>">Por Pagar</a></li>
              <li><a href="<?php echo site_url('admin/orders/tracking') ?>">Por Enviar</a></li>
              <li><a href="<?php echo site_url('admin/orders/withdraw') ?>">Por Retirar</a></li>
              <li><a href="<?php echo site_url('admin/orders/finished') ?>">Procesadas</a></li>
            </ul>
          </li>
          <li class="dropdown <?php echo active_menu('stock'); ?>">
              <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Stock <span class="caret"></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo site_url('admin/stock') ?>">Actual</a></li>
                <?php if($this->session->userdata('is_admin')) : ?><li><a href="<?php echo site_url('admin/stock/history') ?>">Histórico</a></li><?php endif ?>
              </ul>
          </li>
          <li class="<?php echo active_menu('performance'); ?>"><a href="<?php echo site_url('admin/performance') ?>">Costo / Rendimiento</a></li>
        </ul>
        <p class="navbar-text navbar-right"><a href="<?php echo site_url('admin/logout'); ?>" class="navbar-link">Salir</a></p>
      </div>
    </div>
</nav>
