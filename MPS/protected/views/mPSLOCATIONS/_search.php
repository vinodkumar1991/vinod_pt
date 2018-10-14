<?php
/* @var $this MPSLOCATIONSController */
/* @var $model MPSLOCATIONS */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'country_code'); ?>
		<?php echo $form->textField($model,'country_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'state_code'); ?>
		<?php echo $form->textField($model,'state_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'city_code'); ?>
		<?php echo $form->textField($model,'city_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'area_code'); ?>
		<?php echo $form->textField($model,'area_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'zipcode'); ?>
		<?php echo $form->textField($model,'zipcode'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'location_name'); ?>
		<?php echo $form->textField($model,'location_name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->