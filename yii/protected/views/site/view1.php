<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/javascript/jquery.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/javascript/testing.js"></script>
<div id="maindiv">
	<div id="leftside" style="width:200px;float:left">
		<p><a href="#"  class="selected" onclick="javascript:getPages('1');">Page 1</a></p>
		<p><a href="#"  onclick="javascript:getPages('2');">Page 2</a></p>
		<p><a href="#"  onclick="javascript:getPages('3');">Page 3</a></p>
		<p><a href="#"  onclick="javascript:getPages('4');">Page 4</a></p>
		<p><a href="#"  onclick="javascript:getPages('5');">Page 5</a></p>
	</div>
	<div style="style="width:500px";float:right" id="rightside">
		<div id="page1" class="tabcontent" style="border:">
			Here we can render partial of page 1 contents
		<div id="page2" class="tabcontent" style="display:none">
			Here we can render partial of page 2 contents
		</div>
		
		<div id="page3" class="tabcontent" style="display:none">
			Here we can render partial of page 3 contents
		</div>
		
		<div id="page4" class="tabcontent" style="display:none">
			Here we can render partial of page 4 contents
		</div>
		<div id="page5" class="tabcontent" style="display:none">
			Here we can render partial of page 5 contents
		</div>
	</div>
	
</div>

