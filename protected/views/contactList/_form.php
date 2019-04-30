<?php
/* @var $this ContactListController */
/* @var $model ContactList */
/* @var $form CActiveForm */
?>

<div class="form wide">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-list-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
    ),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'first_name'); ?>
		<?php echo $form->textField($model,'first_name',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'first_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'middle_name'); ?>
		<?php echo $form->textField($model,'middle_name',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'middle_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_name'); ?>
		<?php echo $form->textField($model,'last_name',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'last_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'primary_phone'); ?>
        <?php  $this->widget("ext.maskedInput.MaskedInput", array(
                    "model" => $model,
                    "attribute" => "primary_phone",
                    "mask" => '(999) 999-9999',
                    "clientOptions" => array("autoUnmask"=> true),
                    "defaults"=>array("removeMaskOnSubmit"=>false),
        )); ?>
		<?php echo $form->error($model,'primary_phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'secondary_phone'); ?>
        <?php  $this->widget("ext.maskedInput.MaskedInput", array(
            "model" => $model,
            "attribute" => "secondary_phone",
            "mask" => '(999) 999-9999',
            "clientOptions" => array("autoUnmask"=> true),
            "defaults"=>array("removeMaskOnSubmit"=>false),
        )); ?>
		<?php echo $form->error($model,'secondary_phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
    <div class="row">
        <?php echo $form->labelEx($model,'image'); ?>
        <?php echo CHtml::activeFileField($model, 'image'); ?>
        <?php echo $form->error($model,'image'); ?>
    </div>
    <?php if($model->isNewRecord!='1'){ ?>
    <div class="row">
        <?php echo CHtml::image(Yii::app()->request->baseUrl.'/../Profiles/'.$model->image,"image",array("width"=>200)); ?>
    </div>
    <? }?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<style>
    .form-control{
        width:44% !important;
    }
</style>