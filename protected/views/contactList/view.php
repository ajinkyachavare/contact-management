<?php
/* @var $this ContactListController */
/* @var $model ContactList */

$this->breadcrumbs=array(
	'Contact Lists'=>array('admin'),
);
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'first_name',
		'middle_name',
		'last_name',
		'primary_phone',
		'secondary_phone',
		'email',
		array(
			'name' => 'image',
			'type' => 'raw',
            'value' => CHtml::image(
                $folder.'/'.$model->image,
                'Profile Picture',
                array('width' => '200','height' => 'auto')
            ),
		),
		array(
            'name' => 'created_by',
			'value' => (!empty($model->user)?$model->user->user_name:""),
		),
        array(
            'name' => 'created_at',
            'value' => EasyGeneralize::showDate($model->created_at),
        ),
        array(
            'name' => 'updated_at',
            'value' => EasyGeneralize::showDate($model->updated_at),
        ),
	),
)); ?>
