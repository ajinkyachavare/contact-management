<?php
/* @var $this ContactListController */
/* @var $model ContactList */

$this->breadcrumbs=array(
	'Contact Lists'=>array('admin'),
	'Manage',
);

$this->header = 'Manage Contact List';
?>


<?php echo CHtml::button('+ Add New Contact',array('submit' => array('ContactList/create'))); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'contact-list-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    'afterAjaxUpdate'=>"function(){jQuery('#created_at_search').datepicker({'dateFormat': 'yy-mm-dd'})}",
	'columns'=>array(
		'first_name',
		'middle_name',
		'last_name',
        'email',
		'primary_phone',
		'secondary_phone',
		array(
			'name' => 'created_by',
			'value' => '(!empty($data->user)?$data->user->user_name:"")',
		),
        array(
            'name' => 'created_at',
            'value' => 'EasyGeneralize::showDate($data->created_at)',
            'filter'=>$this->widget('zii.widgets.jui.CJuiDatepicker', array(
                'model'=>$model,
                'attribute'=>'created_at',
                'htmlOptions' => array(
                    'id' => 'created_at_search'
                ),
                'options' => array(
                    'dateFormat' => 'yy-mm-dd'
                )
            ), true)
        ),
        array(
            'class'               => 'CButtonColumn',
            'template'            => '{update} {view} {delete} {share}',
            'htmlOptions'         => array('width' => '12%', 'style' => 'text-align: left;'),
            'buttons'             => array(
                'update' => array(
                    'options' => array('class' => 'update-user'),
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/icons/Text-Edit-icon.png',
                    'url'=>'Yii::app()->controller->createUrl("/ContactList/update", array("id"=>$data->id))',
                ),
                'view' =>array(
                    'option' => array('class' => 'view-user'),
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/icons/Actions-view-pim-tasks-icon.png',
                    'url' =>'Yii::app()->controller->createUrl("/ContactList/view", array("id"=>$data->id))'
                ),
                'delete' => array(
                    'options'=>array('class' => 'delete-user'),
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/icons/trash-icon-too-small.png',
                    'url' => 'Yii::app()->controller->createUrl("/ContactList/delete", array("id"=>$data->id))'
                ),
                'share' => array(
                    'options'=>array('class' => 'share-user fa fa-share'),
                    'url' => 'Yii::app()->controller->createUrl("/ContactList/share", array("firstName"=>$data->first_name,"contactId"=>$data->id))'
                )

            )
        ),
	),
)); ?>
