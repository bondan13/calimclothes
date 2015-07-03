<?php
$baseUrl = Yii::app()->request->baseUrl;
$cs = Yii::app()->clientScript;
$cs->registerCssFile($baseUrl . '/bootstrap/css/bootstrap.css')
        //->registerCssFile($baseUrl.'/bootstrap/css/bootstrap-theme.css')
        ->registerScriptFile($baseUrl . '/bootstrap/js/bootstrap.min.js', CClientScript::POS_END);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="language" content="en">

        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print">
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection">
        <![endif]-->

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/fruitful.css">

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body>

        <div class="container" id="page">

            <div id="header">
                <a href="<?php echo Yii::app()->request->baseUrl; ?>">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png">
                </a>

            </div><!-- header -->
            <div class="row clearfix">
                <div class="col-lg-6">
                    <form method="get" action="<?php echo Yii::app()->createUrl('barang/cari'); ?>">
                        <div class="input-group">
                            <input name="key" type="text" class="form-control" placeholder="Search for...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </span>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6">
                    <div class="navbar-right">
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>" class="btn btn-default">HOME</a>
                        <a href="<?php echo Yii::app()->createUrl('barang/kategori', array('id' => 8)); ?>" class="btn btn-default">KAOS</a>
                        <a href="<?php echo Yii::app()->createUrl('barang/kategori', array('id' => 2)); ?>" class="btn btn-default">KEMEJA</a>
                        <a href="<?php echo Yii::app()->createUrl('barang/kategori', array('id' => 5)); ?>" class="btn btn-default">CELANA</a>
                        <a href="<?php echo Yii::app()->createUrl('barang/kategori', array('id' => 6)); ?>" class="btn btn-default">TAS</a>
                        <a href="<?php echo Yii::app()->createUrl('barang/kategori', array('id' => 7)); ?>" class="btn btn-default">AKSESORIS</a>
                        <?php if (!Yii::app()->user->isGuest) { ?>
                            <a href="<?php echo Yii::app()->createUrl('transaksi'); ?>" class="btn btn-default"><i class="glyphicon glyphicon-shopping-cart"></i><sup><?php echo Transaksi::model()->countByAttributes(array('status'=>'pesan','user_id'=>Yii::app()->user->id)); ?></sup></a>
                        <?php } ?>
                        <?php if (Yii::app()->user->isGuest) { ?>
                            <a id="modal-788569" data-toggle="modal" href="#modal-container-788569" class="btn btn-default"><i class="glyphicon glyphicon-user"></i> LOGIN</a>
                        <?php } ?>
                    </div>
                </div>
                <br/>
                <hr />
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">

                    <?php echo $content; ?>
                </div>

                <div class="clear"></div>
                <div id="footer">
                    Copyright &copy; <?php echo date('Y'); ?> by Buntut Kasiran.<br/>
                    All Rights Reserved.<br/>
                </div><!-- footer -->
            </div>

        </div><!-- page -->
        <div class="modal fade" id="modal-container-788569" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            ×
                        </button>
                        <h4 class="modal-title" id="myModalLabel">
                            Login
                        </h4>
                    </div>
                    <div class="modal-body">
                        <?php
                            $this->renderPartial('application.views.site.login', array(
                                    'model'=>new LoginForm,
                                    'action'=> Yii::app()->createUrl('site/login')
                            )); 
                        ?>
                    </div>
                </div>

            </div>
        </div>
    </body>
</html>
