<?php
/* @var $this UserMasterController */
/* @var $model UserMaster */

$this->breadcrumbs=array(
	'User Masters'=>array('admin'),
	'Manage',
);

$this->header = 'Manage User Master';
?>

<?php //echo CHtml::button('+ Add New User',array('submit' => array('UserMaster/create'))); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-master-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'user_name',
        'email',
        array(
            'name'=>'status',
            'filter' => CHtml::activeDropDownList( $model, 'status', UserMaster::$arrStatus, array( 'prompt' => '--- All ---' ) ),
            'value' => function($data){
                if( in_array( $data->status, UserMaster::$enumStatus ) ) {
                    echo UserMaster::$arrStatus[$data->status];
                } else {
                    echo '&mdash;';
                }
            },
        ),
        array(
            'class'               => 'CButtonColumn',
            'template'            => '{update} {view}',
            'htmlOptions'         => array('width' => '10%', 'style' => 'text-align: left;'),
            'buttons'             => array(
                'update' => array(
                    'options' => array('class' => 'update-user'),
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/icons/Text-Edit-icon.png',
                    'url'=>'Yii::app()->controller->createUrl("/UserMaster/update", array("id"=>$data->id))',
                    'visible'=>'$data->id == '.Yii::app()->user->id,
                ),
                'view' =>array(
                    'option' => array('class' => 'view-user'),
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/icons/Actions-view-pim-tasks-icon.png',
                    'url' =>'Yii::app()->controller->createUrl("/UserMaster/view", array("id"=>$data->id))'
                ),
            )
        )
	),
)); ?>