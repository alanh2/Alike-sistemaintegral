<a href="http://systemix.com.ar/orshicell/index.php/venta/ver_detalles/<?php echo $venta->id;?>">Ver detalles</a>
<div class="row menuVentas">
    <div class="col-lg-3 col-md-3 col-md-3 col-xs-3">
        <div class="panel panel-<?=$menuClienteColor;?>">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-md-6 text-left hidden-xs">
                        <div class="puntaje"><?=$stars?></i></div>
                    </div>
                    <div class="col-xs-3 text-right hidden-xs hidden-sm alfa">
                        <?=$menuClienteEstado;?>
                    </div>
                </div>
            </div>
            <a href="http://systemix.com.ar/orshicell/index.php/venta/alta_venta/<?php echo $venta->id;?>">
                <div class="panel-footer">
                    <span class="pull-left hidden-xs">Modificar</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-md-3 col-xs-3">
        <div class="panel panel-<?=$menuRenglonesColor;?>">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <i class="fa fa-shopping-cart fa-5x"></i>
                    </div>
                    <div class="col-md-6 text-left hidden-xs">
                        <div class="nombre"><?php echo $cantidadproductos; ?> items<br>$<span><?php echo $total; ?></span></div>
                    </div>
                    <div class="col-xs-3 text-right hidden-xs hidden-sm alfa">
                        <?=$menuRenglonesEstado;?>
                    </div>
                </div>
            </div>
            <a href="http://systemix.com.ar/orshicell/index.php/venta/renglones_venta/<?php echo $venta->id;?>">
                <div class="panel-footer">
                    <span class="pull-left hidden-xs">Modificar</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-md-3 col-xs-3">
        <div class="panel panel-<?=$menuVentaColor?>">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <i class="fa fa-money fa-5x"></i>
                    </div>
                    <div class="col-md-6 text-left hidden-xs">
                    </div>
                    <div class="col-xs-3 text-right hidden-xs hidden-sm alfa">
                        <?=$menuVentaEstado?>
                    </div>
                </div>
            </div>
            <a href="http://systemix.com.ar/orshicell/index.php/venta/metodo_pago_venta/<?php echo $venta->id;?>">
                <div class="panel-footer">
                    <span class="pull-left hidden-xs">Completar método de pago!</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-md-3 col-xs-3">
        <div class="panel panel-<?=$menuEnviosColor?>">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <i class="fa fa-truck fa-5x"></i>
                    </div>
                    <div class="col-md-6 text-left hidden-xs">
                        <div class="nombre"> <br>&nbsp;</div>
                    </div>
                    <div class="col-xs-3 text-right hidden-xs hidden-sm alfa">
                        <?=$menuEnviosEstado?>
                    </div>
                </div>
            </div>
            <a href="http://systemix.com.ar/orshicell/index.php/venta/envios_venta/<?php echo $venta->id;?>">
                <div class="panel-footer">
                    <span class="pull-left hidden-xs">Completar método de envío!</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>