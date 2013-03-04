<?php
/* @var $this UserregisterController */
/* @var $model Userregister */
/* @var $form CActiveForm */
?>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/javascript/jquery.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/javascript/testing.js"></script>
<div class="form" id="userForm">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'userregister-form','action'=>'index.php?r=site/saveUserInfo',
	'enableClientValidation'=>true,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<div>
		<ul id="errorMessages"></ul>
	</div>
	<div class="row">
		<?php echo $form->hiddenField($model,'id'); ?>
		<?php echo $form->labelEx($model,'first_name'); ?>
		<?php echo $form->textField($model,'first_name',array('size'=>20,'maxlength'=>20,'id'=>'txtFname')); ?>
		<?php echo $form->error($model,'first_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_name'); ?>
		<?php echo $form->textField($model,'last_name',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'last_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>40,'maxlength'=>40,'id'=>'txtEmail')); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

<?php if(!isset($uid) ){?>
	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>20,'maxlength'=>210,'id'=>'txtPassword')); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
	<?php }?>
		<div class="row">
			<label>Confirm Your password</label>
			<input type="text" id="txtconfPass"/>
		</div>
	<div class="row">
		
		
		<?php
                $accountStatus = array('Male'=>'Male', 'Female'=>'Female');
                echo $form->radioButtonList($model,'gender',$accountStatus,array('separator'=>' ','labelOptions'=>array('style'=>'display:inline'),));
        ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'location'); ?>
		<?php			
		$list=CHtml::listData(Locations::model()->findAllByAttributes(array('status'=>'1')), 'id', 'location_name');
		echo CHtml::dropDownList('location','selected',$list,array('empty'=>'Select Status')); ?>

	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'Image');?>
		<?php echo $form->fileField($model, 'cimage',array('id'=>'txtImage'));?>
		<?php echo $form->error($model, 'cimage');?>

	</div>

	<div class="row buttons">
	
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Register' : 'Register',array("onclick"=>"javascript:return validateForm();")); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->