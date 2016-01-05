<div>
  <ul class="nav nav-tabs right-to-left" role="tablist">
    <li role="presentation" class="active"><a href="#" aria-controls="categorias" role="tab">Chilexpress</a></li>
  </ul>

  <div class="tab-content padding-top-30">
    <div role="tabpanel" class="tab-pane active">
        <?php echo form_open('admin/transport/chilexpress/'.$chilexpress['id']) ?>
            <div class="panel panel-default">

                <div class="panel-heading">
                    <h3 class="panel-title">Editar Memphis</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $chilexpress['nombre']; ?>"><span class="error"><?php echo form_error('nombre'); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="name">1K50</label>
                                <input type="text" class="form-control" id="1K50" name="1K50" value="<?php echo $chilexpress['1K50']; ?>"><span class="error"><?php echo form_error('1K50'); ?></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="name">3K</label>
                                <input type="text" class="form-control" id="3K" name="3K" value="<?php echo $chilexpress['3K']; ?>"><span class="error"><?php echo form_error('3K'); ?></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="name">6K</label>
                                <input type="text" class="form-control" id="6K" name="6K" value="<?php echo $chilexpress['6K']; ?>"><span class="error"><?php echo form_error('6K'); ?></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="name">10K</label>
                                <input type="text" class="form-control" id="10K" name="10K" value="<?php echo $chilexpress['10K']; ?>"><span class="error"><?php echo form_error('10K'); ?></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="name">15K</label>
                                <input type="text" class="form-control" id="15K" name="15K" value="<?php echo $chilexpress['15K']; ?>"><span class="error"><?php echo form_error('15K'); ?></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="name">ADIC</label>
                                <input type="text" class="form-control" id="ADIC" name="ADIC" value="<?php echo $chilexpress['ADIC']; ?>"><span class="error"><?php echo form_error('ADIC'); ?></span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </div>
        </form>
    </div>
  </div>

</div>
