<?php $this->beginContent('//layouts/main'); ?>
        <?php if(!Yii::app()->user->isGuest){ ?> 
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">

             <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/dist/img/avatar04.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p><?php echo Yii::t('app','Hello'); ?>, <?php echo ucfirst(Yii::app()->user->name); ?></p>
                            <a><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>

                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="header">HEADER</li>
                        <!-- Optionally, you can add icons to the links -->
                        <li><a href="<?php echo Yii::app()->createurl('index');?>"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-book"></i><span>Master Data</span> <i class="fa fa-angle-left pull-right"></i></a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo Yii::app()->createurl('contactList/admin');?>">Contact List</a></li>
                            </ul>
                        </li>

                        <li class="treeview">
                            <a href="#"><i class="fa fa-wrench"></i><span>Admin</span> <i class="fa fa-angle-left pull-right"></i></a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo Yii::app()->createurl('userMaster/admin');?>">User Master</a></li>
                            </ul>
                        </li>
                    </ul>

                </section>
          <!-- /.sidebar -->
        </aside>

        <!-- Right side column. Contains the navbar and content of the page -->
        <div class="content-wrapper">

           <!-- Content Header (Page header) -->
           <section class="content-header">
                <h1> <?php echo CHtml::encode($this->pageTitle); ?> </h1>

                <?php if(isset($this->breadcrumbs)):?>
                   <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links'=>$this->breadcrumbs,
                    'tagName'=>'ol',
                    'htmlOptions'=>array('class'=>'breadcrumb'),
                    'homeLink'=>CHtml::tag('li', array(),CHtml::link(Yii::t('app','Home'), array('../index')),true),
                    'activeLinkTemplate'=>'<li><a href="{url}">{label}</a></li>',
                    'inactiveLinkTemplate'=>'<li class="active">{label}</li>',
                    'separator'=>'',
                    )); ?><!-- breadcrumbs -->
                <?php endif?>

            </section>

            <!-- Main content -->
            <section class="content">
                <?php echo $content; ?>
            </section><!-- /.content -->

        </div><!-- /.right-side -->
        
          <?php }else{?>
    <section class="content">
        <?php echo $content; ?>
    </section><!-- /.content -->
    <?php }?>

<?php $this->endContent(); ?>