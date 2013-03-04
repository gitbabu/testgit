<?php foreach($eventsRec as $singEventRec){ ?>
							
								<div class="spanimg">
									<img alt="Missing" class="profile_pic" src="<?php echo Yii::app() -> baseUrl; ?>/images/missing.png" />
								</div>
								<div class="spanTxt">
								<span style="color: #999999;"><?php echo $singEventRec['created_by'] ?> > <?php echo $singEventRec['pcp_id'] ?> > <a href='/members/34089-carleton-rinehart'><?php echo $singEventRec['member_id'] ?></a> <span class="small"> - A 
									<?php echo $singEventRec['event_type'] ?> was added</span> </span>
								<pre><?php echo $singEventRec['created'] ?>- <?php echo $singEventRec['event_desc'] ?></pre>
								<small> <?php echo $singEventRec['created'] ?>      | <a href="#" class="add_comment" act_id="11098" onclick="showCommentBox()">Add Comment</a> </small>
								<div class="comments_portlet">

									<div id="commentBox" class="comment_form" style="display:none;">
										<div class="form" id="commentsDiv">
												
													<div class="row">
														<textarea rows="4" cols="20" id="txtAreaComments">
 
														</textarea>
													</div>
													<div class="row buttons">
														<input type="submit" value="Post" onclick="saveComments()"/>
														<input type="button" value="Cancel" onclick="hideCommentBox()"/>
													</div>
												
										</div><!-- form -->
										
									</div>

									<div id="11098_all_comments" class="all_comments">
										
									<?php	foreach($comments as $singComments){?>
											<div id="comment_entry_1509" class="comment_entry">
												<div class="comment_body">
													<pre><?php echo $singComments -> comment_text; ?></pre>
												</div>
												<?php $userName = Users::model() -> findByAttributes(array('id' => $singComments -> user_id)); ?>
												<small> <!-- 11:41 PM on 22 January 2013 by --> On <?php echo Yii::app() -> dateFormatter -> format("d-MMM-y hh:mm a", $singComments -> comment_datetime) . "  by " . $userName -> username; ?></small>
											</div>
										<?php } ?>
									</div>

								</div>
								</div>
						<?php	} ?>