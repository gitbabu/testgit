<?php
/* @var $this UserregisterController */
/* @var $model Userregister */

$this->breadcrumbs=array(
	'Userregisters'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Userregister', 'url'=>array('index')),
	array('label'=>'Manage Userregister', 'url'=>array('admin')),
);
?>

<h1>Create Userregister</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>