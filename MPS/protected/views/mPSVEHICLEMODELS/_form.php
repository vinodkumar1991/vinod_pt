<?php
/* @var $this MPSVEHICLEMODELSController */
/* @var $model MPSVEHICLEMODELS */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mpsvehiclemodels-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'models_name'); ?>
		<?php echo $form->textField($model,'models_name',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'models_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'makes_id'); ?>
		<?php echo $form->textField($model,'makes_id'); ?>
		<?php echo $form->error($model,'makes_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->