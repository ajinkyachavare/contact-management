<?php
/* @var $this UserMasterController */
/* @var $model UserMaster */

$this->breadcrumbs=array(
	'User Master'=>array('admin'),
);
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'user_name',
        array(
        	'name'=>'status',
			'value'=>UserMaster::$arrStatus[$model->status],
		),
	),
));

?>
