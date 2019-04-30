<?php
/* @var $this ContactListController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Contact Lists',
);

$this->menu=array(
	array('label'=>'Create ContactList', 'url'=>array('create')),
	array('label'=>'Manage ContactList', 'url'=>array('admin')),
);
?>

<h1>Contact Lists</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
