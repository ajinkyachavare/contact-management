<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<!-- bootstrap 3.0.2 -->
	<link href="<?php echo Yii::app()->theme->baseUrl; ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
	<!-- Theme style -->
	<link href="<?php echo Yii::app()->theme->baseUrl; ?>/dist/css/AdminLTE.css" rel="stylesheet" type="text/css" />
     <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- Style custom -->
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/dist/css/style.css" rel="stylesheet" type="text/css" />
    
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/dist/css/form.css" rel="stylesheet" type="text/css" />
    
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/dist/css/main.css" rel="stylesheet" type="text/css" />
    
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/jQuery/jQuery-2.1.4.min.js"></script>

 	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

</head>

<body class="skin-blue sidebar-mini">

    <!-- Site wrapper -->
    <div class="wrapper">

            <?php
                 $isGuest = false;
            if(!Yii::app()->user->isGuest)
            {
                $isGuest = true;
                $this->widget('Navbar', array(
                    //'brand'=>CHtml::image(Yii::app()->baseUrl . "/images/logo_neocds.png", ""),
                    'icon'=>'',
                    'brand'=>'Manage Contacts',
                    'brandUrl'=>$this->createUrl('index'),
                    'htmlOptions'=>array('class'=>'navbar-custom-menu'),
                    'items'=>array(
                        array(
                            'class'=>'Users',
                            'htmlOptions'=>array('class'=>'dropdown user user-menu'),
                            'avatar'=> Yii::app()->theme->baseUrl . '/dist/img/avatar04.png',
                            'itemsCssClass'=>'dropdown-menu',
                            'items'=>array(
                               // array('url'=>'#', 'label'=>Yii::t('app','Change Password')),
                               //array('url'=>Yii::app()->createurl('userMaster/update',array('id'=>Yii::app()->user->id)), 'label'=>Yii::t('app','Change Password')),
                                array('url'=>array('/logout'), 'label'=>Yii::t('app','Logout'))
                                )
                            ),
                        )
                ));
            }
            ?>

    	    <?php echo $content; ?>
             <?php if($isGuest): ?>
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <?php //echo Yii::powered(); ?>
                </div>
                Copyright &copy; <?php echo date('Y'); ?> by Ajinkya Chavare. All Rights Reserved.
            </footer>
             <?php endif;?>

          <div class='control-sidebar-bg'></div>

    </div><!-- ./wrapper -->

    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?php echo Yii::app()->theme->baseUrl; ?>/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/dist/js/app.min.js" type="text/javascript"></script>

</body>
</html>
