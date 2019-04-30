<?php
/* @var $this UserMasterController */
/* @var $data UserMaster */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_name')); ?>:</b>
	<?php echo CHtml::encode($data->user_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>
	<?php echo CHtml::encode($data->password); ?>
	<br />


	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('sqid3')); ?>:</b>
	<?php echo CHtml::encode($data->sqid3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sqans1')); ?>:</b>
	<?php echo CHtml::encode($data->sqans1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sqans2')); ?>:</b>
	<?php echo CHtml::encode($data->sqans2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sqans3')); ?>:</b>
	<?php echo CHtml::encode($data->sqans3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lpwdchdt')); ?>:</b>
	<?php echo CHtml::encode($data->lpwdchdt); ?>
	<br />

	*/ ?>

</div>