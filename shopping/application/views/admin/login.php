<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">

        <?php echo form_open('verifylogin'); ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title text-center">Panel de Administración</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="username">Usuario</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo set_value('username'); ?>">
                    <span class="error text-center"><?php echo form_error('username'); ?></span>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <span class="error text-center"><?php echo form_error('password'); ?></span>
                </div>
            </div>
            <div class="panel-footer">
                &nbsp;<button type="submit" class="btn btn-success btn-xs pull-right">Login</button>
            </div>
        </div>
        </form> 
    </div>
    <div class="col-md-4"></div>
</div>