<?php
/* @var $this UserMasterController */
/* @var $model UserMaster */

$this->breadcrumbs=array(
	'User Master'=>array('admin'),
	'Create',
);
$this->header = 'Add User';
?>


<?php $this->renderPartial('_form', array('model'=>$model)); ?>