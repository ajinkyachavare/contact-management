<?php
/* @var $this ContactListController */
/* @var $model ContactList */

$this->breadcrumbs=array(
	'Contact Lists'=>array('admin'),
	'Create',
);

?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>