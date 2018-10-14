<?php
/* @var $this MPSUPLOADSController */
/* @var $model MPSUPLOADS */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mpsuploads-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'image_name'); ?>
		<?php echo $form->textField($model,'image_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'image_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'imagepath'); ?>
		<?php echo $form->textField($model,'imagepath',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'imagepath'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'data'); ?>
		<?php echo $form->textField($model,'data'); ?>
		<?php echo $form->error($model,'data'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->