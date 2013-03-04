<div>
<div style="color:blue">Thank you for register to Spredthewordapps</div>

<table border="1">
	<tr>
		<td>
			Your profile Picture
		</td>
		<td >
			<img src="<?php echo $myprofile['photourl']; ?>"/>
		</td>
	</tr>
	<tr>
		<td>
			Your Full Name:
		</td>
		<td>
			<?php echo $myprofile['fname']." ".$myprofile['lname'];?>
		</td>
	</tr>
	<tr>
		<td>
			DOB:
		</td>
		<td>
			<?php echo $myprofile['birthday']."-".$myprofile['birthmonth']."-".$myprofile['birthyear']?>
		</td>
	</tr>
	<tr>
		<td>
			Your Contact Number:
		</td>
		<td>
			<?php echo $myprofile['contactnumber'];?>
		</td>
	</tr>
	<tr>
		<td>
			Your Job Title:
		</td>
		<td>
			<?php echo $myprofile['jobtitle'];?>
		</td>
	</tr>
	<tr>
		<td>
			Your Company Name:
		</td>
		<td>
			<?php echo $myprofile['company'];?>
		</td>
	</tr>
	<tr>
		<td>
			Your Degree:
		</td>
		<td>
			<?php echo $myprofile['degrees'];?>
		</td>
	</tr>
	<tr>
		<td>
			Your Degree:
		</td>
		<td>
			<?php echo $myprofile['skills'];?>
		</td>
	</tr>
	<tr>
		<td>
			Your Connections Names:
		</td>
		<td>
			<?php echo $myprofile['connections'];?>
		</td>
	</tr>
	
</table>


</div>
<?php
 if((int)$connections['total'] > 0) {
                ?>
                <p>First <?php echo CONNECTION_COUNT;?> of <?php echo $connections['total'];?> total connections being displayed:</p>

                <form id="linkedin_cmessage_form" action="<?php echo Yii::app() -> baseUrl; ?>/index.php/site/sendMessage" method="post">
                  <input type="hidden" name="<?php echo LINKEDIN::_GET_TYPE;?>" id="<?php echo LINKEDIN::_GET_TYPE;?>" value="message" />
                  <?php
                  foreach($connections->person as $connection) {
                    ?>
                    <div style="float: left; width: 150px; border: 1px solid #888; margin: 0.5em; text-align: center;">
                      <?php
                      if($connection->{'picture-url'}) {
                        ?>
                        <img src="<?php echo $connection->{'picture-url'};?>" alt="" title="" width="80" height="80" style="display: block; margin: 0 auto; padding: 0.25em;" />
                        <?php
                      } else {
                        ?>
                        <img src="<?php echo Yii::app() -> baseUrl; ?>/images/anonymous.png" alt="" title="" width="80" height="80" style="display: block; margin: 0 auto; padding: 0.25em;" />
                        <?php
                      }
                      ?>
                      <input type="checkbox" name="connections[]" id="connection_<?php echo $connection->id;?>" value="<?php echo $connection->id;?>" />
                      <label for="connection_<?php echo $connection->id;?>"><?php echo $connection->{'first-name'};?></label>
                      <div><?php echo $connection->id;?></div>
                    </div>
                    <?php
                  }
                  ?>
                  
                  <br style="clear: both;" />
              
                  <h4 id="network_connections_message">Send a Message to the Checked Connections Above:</h4>
                  
                  <div style="font-weight: bold;">Subject:</div>            
                  <input type="text" name="message_subject" id="message_subject" length="255" maxlength="255" style="display: block; width: 400px;" />
                  
                  <div style="font-weight: bold;">Message:</div>
                  <textarea name="message_body" id="message_body" rows="4" style="display: block; width: 400px;"></textarea>
                  <input type="submit" value="Send Message" /><input type="checkbox" value="1" name="message_copy" id="message_copy" checked="checked" /><label for="message_copy">copy self on message</label>
                  
                  <p>(Note, any HTML in the subject or message bodies will be stripped by the LinkedIn->message() method)</p>
                
                </form>
                <?php
              }
 ?>