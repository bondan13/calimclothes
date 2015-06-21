
<?php
$cs        = Yii::app()->clientScript;
$themePath = Yii::app()->theme->baseUrl;

/**
 * StyleSHeets
 */
$cs->registerCssFile($themePath . '/assets/css/bootstrap.css');
$cs->registerCssFile($themePath . '/assets/css/bootstrap-theme.css');

/**
 * JavaScripts
 */
$cs->registerCoreScript('jquery', CClientScript::POS_END);
$cs->registerCoreScript('jquery.ui', CClientScript::POS_END);
$cs->registerScriptFile($themePath . '/assets/js/bootstrap.min.js', CClientScript::POS_END);
$cs->registerScript('tooltip', "$('[data-toggle=\"tooltip\"]').tooltip();$('[data-toggle=\"popover\"]').tooltip()", CClientScript::POS_READY);
?>
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
    <script src="<?php
echo Yii::app()->theme->baseUrl . '/assets/js/html5shiv.js';
?>"></script>
    <script src="<?php
echo Yii::app()->theme->baseUrl . '/assets/js/respond.min.js';
?>"></script>
<![endif]-->
<?php
echo $content;
?>