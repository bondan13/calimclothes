<?php 
$baseUrl = Yii::app()->request->baseUrl;
$cs = Yii::app()->clientScript;
$cs ->registerCssFile($baseUrl.'/bootstrap/css/bootstrap.css')
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
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png">
                    
	</div><!-- header -->
        <div class="col-lg-12">
            <div class="navbar-right">
                <a href="<?php echo Yii::app()->request->baseUrl; ?>" class="btn btn-default">HOME</a>
                <a href="#" class="btn btn-default">T SHIRTS</a>
                <a href="#" class="btn btn-default">SHOES</a>
                <a href="#" class="btn btn-default">BAGS</a>
                <a href="#" class="btn btn-default">ACCESORIES</a>
                <a href="#" class="btn btn-default">SHIRTS & POLO</a>
                <a href="#" class="btn btn-default">OUTWEARS</a>
                <a href="#" class="btn btn-default">MERCHANDISES</a> 
                <a href="#" class="btn btn-default"><i class="glyphicon glyphicon-shopping-cart"></i><sup>1</sup></a>
            </div>
            <br/>
            <hr />
        </div>
        
        <div class="col-lg-12">
        
	<?php echo $content; ?>
        </div>
        
	<div class="clear"></div>
	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by Buntut Kasiran.<br/>
		All Rights Reserved.<br/>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
