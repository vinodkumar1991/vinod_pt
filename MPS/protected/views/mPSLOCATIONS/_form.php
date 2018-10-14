<?php
/* @var $this MPSLOCATIONSController */
/* @var $model MPSLOCATIONS */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mpslocations-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'country_code'); ?>
		<?php echo $form->textField($model,'country_code'); ?>
		<?php echo $form->error($model,'country_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'state_code'); ?>
		<?php echo $form->textField($model,'state_code'); ?>
		<?php echo $form->error($model,'state_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'city_code'); ?>
		<?php echo $form->textField($model,'city_code'); ?>
		<?php echo $form->error($model,'city_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'area_code'); ?>
		<?php echo $form->textField($model,'area_code'); ?>
		<?php echo $form->error($model,'area_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'zipcode'); ?>
		<?php echo $form->textField($model,'zipcode'); ?>
		<?php echo $form->error($model,'zipcode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'location_name'); ?>
		<?php echo $form->textField($model,'location_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'location_name'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->