<?php
/* @var $this MPSVEHICLESController */
/* @var $model MPSVEHICLES */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mpsvehicles-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'makes_id'); ?>
		<?php echo $form->textField($model,'makes_id'); ?>
		<?php echo $form->error($model,'makes_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'models_id'); ?>
		<?php echo $form->textField($model,'models_id'); ?>
		<?php echo $form->error($model,'models_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'year'); ?>
		<?php echo $form->textField($model,'year'); ?>
		<?php echo $form->error($model,'year'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'maker_model_name'); ?>
		<?php echo $form->textField($model,'maker_model_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'maker_model_name'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->