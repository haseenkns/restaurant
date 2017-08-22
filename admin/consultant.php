<?php 
	ob_start();
	session_start();
    include_once("configuration/connect.php");
	include_once("configuration/functions.php");
	if(isset($_GET['cid'])&& $_GET['cid']!=''){
		$cid=$_GET['cid'];
		$consultantData=getConsultantDetailsById($cid);
		$profileVideo=$consultantData[13];
		$memName=strreplace(getMemberNameById($cid));
		//echo $consultantData[20];
		 $profession=strreplace(getTableDataById("title","books",$consultantData[20]));
		$ref=$baseurl."/".$profession."/".$memName."/".$cid;
	}
	$baseurl=$Global['baseurl'];
	
	?>
<!doctype shtml>
<html>
    <head>
    <meta charset="utf-8">
	<title><?php echo getSiteTitle(); ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
<script>
function populateReview(){
		review=document.getElementById('review').value;
		cid=document.getElementById('hidRCid').value;
		uid=document.getElementById('hidRUid').value;
		type=document.getElementById('hidRtype').value;
		populateUserReview(review,cid,uid,type);
}

function populateQuestion(){
		question=document.getElementById('question').value;
		subject=document.getElementById('subject').value;
		cid=document.getElementById('hidQCid').value;
		uid=document.getElementById('hidQUid').value;
		type=document.getElementById('hidQtype').value;
		populateUserQuestion(question,cid,uid,type,subject);
}
</script>
        <style>
		.scrollcontent{
			overflow: auto;
			position: relative;
			padding: 20px;
			background:#CCC;
			margin: 5px;
			width: 740px;
			max-width: 97%;
			max-height: 350px;
			-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;
}
		.cons-prof-heading { font-style:normal !important; }
		.ask-a-question a:hover { background:#000 !important; color:#fff; font-weight:normal; }
		.testimonial-part { width: 100% !important;float: left;margin-right: 50px;margin-bottom: 0px !important; }
		.ask-a-question a {
			color: #fff !important;
			font-size: 15px;
			font-style: normal !important;
			font-weight: normal !important;
			padding: 19px 5px !important;
			text-indent: 12px;
			text-shadow: none !important;
			width: 94%;
			background: #1B75DB !important;
			float: left;
			text-align: center;
			border-radius: 50%;
			margin-bottom:20px !important;
		}
		.txt-heading{
		font-family: 'Roboto Condensed', sans-serif;
		font-size:18px;
		font-weight:normal;
		color:#333;
		}
		.txt-heading-small{
		font-family: 'Roboto Condensed', sans-serif;
		font-size:20px;
		font-weight:normal;
		color:#F75959;
		}
		
	
		</style>
       <!-- <link rel="stylesheet" type="text/css" href="http://kenwheeler.github.io/slick/slick/slick.css"/>
  <link rel="stylesheet" type="text/css" href="http://kenwheeler.github.io/slick/slick/slick-theme.css"/>
  	<script type="text/javascript" src="http://kenwheeler.github.io/slick/slick/slick.js"></script>-->
   <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>
   	<link rel="stylesheet" href="css/demo.css" type="text/css" media="screen" />

    </head>
    <body>
    	
     <?php include_once('landingheader.php') ?>
    	<link rel="stylesheet" href="<?php echo $baseurl ?>/css/flexslidernew.css" type="text/css" media="screen" />
 	
        
        <div class="consultant-pic">
        	<a href="javascript:void(0);"><img src="<?php echo $baseurl ?>/thumb/<?php echo thumbNail($consultantData[14],150,150);  ?>" alt="" /></a>
         
         <?php
		 if(!$profileVideo==''){
		 ?>
            
            <div class="html-code">
          <a href="#small-dialog-vid" class="popup-with-zoom-anim video-onpic"><img src="<?php echo $baseurl ?>/images/youtube-icon.png" /></a>
          <!-- dialog itself, mfp-hide class is required to make dialog hidden -->
          <div class="zoom-anim-dialog mfp-hide" id="small-dialog-vid">
            <div class="ask-a-button">
            <?php
			echo get_youtube_video($profileVideo,700,400);
			?>
                <!--<iframe width="100%" height="315" src="<?php echo $profileVideo;  ?>" frameborder="0" allowfullscreen></iframe>-->
            </div>
            
            <div class="clear"></div>
          </div>
        </div>
        
            <script type="text/javascript">
          $(document).ready(function() {
            $('.popup-with-zoom-anim').magnificPopup({
              type: 'inline',
    
              fixedContentPos: false,
              fixedBgPos: true,								
              overflowY: 'auto',								
              closeBtnInside: true,
              preloader: false,										  
              midClick: true,
              removalDelay: 300,
              mainClass: 'my-mfp-zoom-in'
            });
          });
        </script>
        <?php } ?>
        </div>
        
        
        <article class="content dark">
        <div class="s-container team-grid">
        <p style="color:#a6a6a6; margin:0px; padding-top:15px; font-size:13px;"><a style="color:#fff; text-decoration:none;" href="<?php echo $baseurl ?>/thesilverliners.php">The Silver Liners</a> / <?php echo strreplace(getTableDataById("title","books",$consultantData[20])) ?> </p>
        </div>
            <header class="title one"><?php echo getMemberNameById($cid); ?><br><span style="font-size:15px;">(<?php echo strreplace(getTableDataById("title","books",$consultantData[20])) ?>)</span></header>
            
            <section class="team-box">
                <div class="s-container team-grid">
                
                    <div class="t-list">
                        <div class="t-element consultant-part">
                        
                            <!--<div class="follow-header"><img class="rating-star" src="<?php echo $baseurl ?>/images/rating-black-white.png" /><a class="follow-button" href="#"> Follow</a></div>-->
                            
                            <div class="c-data">
                                
                                
                                <div class="coursesmain" style="width:72% !important; margin-top: 15px !important;">
                                <table cellpadding="0" cellspacing="0" border="0" class="table-main" width="100%">
                                	<tbody>
                                    	
                                        	
                                                                          
                                        <tr>
                                         <td width="21%"><span style="font-style:normal;" class="txt-heading">About</span> :</td>
                                         <td width="79%"><div class="cons-prof-heading" style="text-align:justify;"><?php echo stripslashes($consultantData[21])  ?></div></td>
                                        </tr>
                                       <tr><td  colspan="2" height="5px"></td></tr>
                                         <tr>
                                        <td><span style="font-style:normal;" class="txt-heading">Tools Practiced</span> :</td>
                                            <td><div class="cons-prof-heading" style="text-align:justify;"> <?php echo stripslashes($consultantData[23])  ?></div></td>
                                        </tr>
                                        
                                         <tr><td  colspan="2" height="5px"></td></tr>
                                        
                                         <tr>
                                        <td><span style="font-style:normal;" class="txt-heading">Specialization</span> :</td>
                                            <td><div class="cons-prof-heading" style="text-align:justify;"> <?php echo stripslashes($consultantData[25])  ?></div></td>
                                        </tr>
                                        
                                        
                                         <tr><td  colspan="2" height="5px"></td></tr>
                                         <tr>
                                        <td><span style="font-style:normal;" class="txt-heading">Experience <span style="font-size:10px;">(in years)</span></span> :</td>
                                            <td><div class="cons-prof-heading" style="text-align:justify;"> <?php echo stripslashes($consultantData[24])  ?></div></td>
                                        </tr>
                                         <tr><td  colspan="2" height="5px"></td></tr>
                                         <tr>
                                        <td><span style="font-style:normal;" class="txt-heading">Address</span> :</td>
                                            <td><div class="cons-prof-heading" style="text-align:justify;"> <?php echo getMemberAddressById($consultantData[0])  ?></div></td>
                                        </tr>
                                        
                                        
                                        
                                        
                                                                                
                                    </tbody>
                                </table>
                                <div class="testimonial-parts">
                                	<h2 class="txt-heading-small" style="margin-left:5px;">Upcoming Courses</h2>
                                    
                                </div>
                               
                                   
        <div class="flexslider carousel" style="width:90%;">
          <ul class="slides">   
                                      <?php
										$execQry=mysql_query("select * from `consultantcourses` where `c_id` = '$cid' order by `id` desc ");
										$numRows=mysql_num_rows($execQry);
										if($numRows>0){
										while($fetch=mysql_fetch_array($execQry)){
											
											?>
											 <li> <div>
                                              
                                              <div class="main-container">
  <div class="main wrapper clearfix">
    <div class="widget-holder">
      <div class="clearfix">
        
        
        
        
        <article class="crs-widget ">
      
          
          <div class="crs-type2 live-type"><strong><?php echo stripslashes($fetch['coursename']) ?></strong></div>
          <!--<img width="234" height="132" onload="loadimg(this);" class="crs-widget-img" data-src="http://demo2purplecircle.indiciumcrm.com/js/holder.js/234x132/auto/#CF9D00:#CF9D00" title="ANDROID DEVELOPMENT" alt="ANDROID DEVELOPMENT">-->
          <div class="widget-info">
            <div class="crs-footer-info clearfix">
              <div class="timing"> 
               
                  <p><i class="icon-main fa fa-clock-o"></i> Duration: <?php echo $fetch['duration'] ?> days</p>
                
                
              </div>
              
              <div class="timing"> 
                
                  <p><i class="icon-main fa fa-gear"></i> Intake: <?php echo $fetch['intake'] ?></p>
                
                
              </div>
              <div class="timing"> 
                
                  <p><i class="icon-main fa fa-rupee"></i> Fees: Rs <?php echo $fetch['fees'] ?></p>
                
               
              </div>
              
              <div class="timing"> 
                <?php 
						  if($usrId==''){
						  ?>
                  <div style="float:left;" class="ses-type live-type"><strong style="cursor:pointer;" onClick="msgAndRedirect('You would need to login to book an appointment.','<?php echo $ref; ?>')">Enroll Now</strong></div>
                  <div style="float:right;" class="ses-type live-type"><strong style="cursor:pointer;" onClick="window.location.href='<?php echo $baseurl ?>/viewcoursedetail.php?cid=<?php echo $fetch['id'] ?>'">View Detail</strong></div>
                <?php }else{ ?>
                  <div class="ses-type live-type" style="float:left;"><strong style="cursor:pointer;" onClick="window.location.href='<?php echo $baseurl ?>/viewcourse-<?php echo strreplace($fetch['coursename'])  ?>-<?php echo $fetch['id'] ?>'">Enroll Now</strong></div>
                   <div style="float:right;" class="ses-type live-type"><strong style="cursor:pointer;" onClick="window.location.href='<?php echo $baseurl ?>/viewcoursedetail.php?cid=<?php echo $fetch['id'] ?>'">View Detail</strong></div>
                <?php } ?>
               
              </div>
              
            </div>
          </div>
        </article>
           
        
      </div>
     
    </div>
  </div>
  <!-- #main --> 
</div></div></li>
 
 
										<?php }	}else{?>
											  <li><div><div class="main-container">
  <div class="main wrapper clearfix">
    <div class="widget-holder">
      <div class="clearfix">
        <div class="clear"></div>
        
        
        
        <a href="/online-classes/android-development-9">
        <article class="crs-widget ">
          <div class="crs-type2 live-type"><strong>No Courses yet</strong></div>
          <!--<img width="234" height="132" onload="loadimg(this);" class="crs-widget-img" data-src="http://demo2purplecircle.indiciumcrm.com/js/holder.js/234x132/auto/#CF9D00:#CF9D00" title="ANDROID DEVELOPMENT" alt="ANDROID DEVELOPMENT">-->
          <div class="widget-info">
            <div class="timing"> 
                
                  <p>  Add courses and get started.</p>
                
               
              </div>
          </div>
        </article>
        </a>       
        
      </div>
     
    </div>
  </div>
  <!-- #main --> 
</div></div></li>
										<?php }  ?>
                                      
                                      </ul>
                                      </div>
                                      
                                      
								   
                                <!--<script type="text/javascript">
										$('.autoplay').slick({
										  slidesToShow: 3,
										  slidesToScroll: 1,
										  autoplay: true,
										  autoplaySpeed: 2000,
										});
									</script>-->
                                
                                
                                
                                <div class="clear"></div> 
                             
                             
                            
                                                            
                             	</div>                             
                             	
                               <div class="ask-a-question" style="width:25%; float:right; margin-top:0px !important; position:relative;">
                               		
                              
                                    
              
                          <?php 
						  if($usrId==''){
						  ?>
                           
                  <a href="javascript:void(0)" onClick="msgAndRedirect('You would need to login to book an appointment.','<?php echo $ref; ?>')">Meet</a>
                <a href="javascript:void(0)" onClick="msgAndRedirect('You would need to login to book an appointment.','<?php echo $ref; ?>')" >Ask a Question</a>
                
                          <?php }else{ ?>
                                    <div class="meet-button">
                                    <a href="<?php echo $baseurl ?>/meet/<?php echo strreplace(getMemberNameById($cid)); ?>/<?php echo $cid; ?>">Meet</a>
                                    </div>
                                    <div class="ask-a-question-button">
                                    <div class="html-code">
                                    <a href="#small-dialog2" class="popup-with-zoom-anim">Ask A Question</a>
                                    <!-- dialog itself, mfp-hide class is required to make dialog hidden -->
                                    <div class="zoom-anim-dialog mfp-hide" id="small-dialog2">
                                    <h1>Ask A Question</h1>
                                    <div class="ask-a-button" id="loaderQuestion" style="display:block;">
                                    <form action="" class="box-text">
                                        <input type="text" class="text-box" placeholder="Subject"  id="subject" name="subject"/>
                                        <textarea class="text-box" placeholder="Your Question" id="question" name="question"></textarea>
                                         <input type="hidden" name="hidQCid"  id="hidQCid" value="<?php echo $cid; ?>">
                                        <input type="hidden" name="hidQUid" id="hidQUid" value="<?php echo $usrId; ?>">
                                        <input type="hidden" name="hidQtype" id="hidQtype" value="<?php echo $type; ?>">
                                        <button type="button" class="btn-contact" onClick="populateQuestion()">Submit Question</button>
                                    </form>
                                    </div>
                                    <div id="loadingquestionmsg" style="display:none">
                                    <div style="width:100%;min-height:100px;text-align:center;font-size:25px">
                                    <img src="<?php  echo $baseurl?>/images/populate.gif">&nbsp;&nbsp;Your question is being populated,please wait...
                                    </div>
                                    
                                    </div>
                                    <div class="clear"></div>
                                    </div>
                                    </div>
                                    
                                    
                                    </div>
                                    
                          <?php } ?>
                        
                                     
                                    
                               </div> 
                               
                               <div style="width:100%; float:left;">
                                <div class="testimonial-part" style="float:left; width:70% !important;">
                                	<h2>Testimonials / Reviews</h2>
                                    <div  class="cd-testimonials-all-wrapper container content mCustomScrollbar" id="content-1" style="min-height:50px; padding:10px;background:#FEF;height:auto !important;">
                                    
                                    
                    <?php
									$execQry=mysql_query("select * from `reviews` where `status` = '1' and `c_id`='$cid' order by `id` desc limit 0,5");
	$numRows=mysql_num_rows($execQry);
	if($numRows>0){
		while($fetch=mysql_fetch_array($execQry)){
			$uid=$fetch['uid'];
			?>
        
            <ul style="list-style:none;padding:0px !important;">
                    <li class="cd-testimonials-item" style="padding-bottom:30px;">
                        <span><?php echo stripslashes($fetch['comment']) ?></span>
                        
                        <div class="cd-author">
                            <img src="<?php echo $baseurl ?>/photos/<?php echo getUserImageById($uid); ?>" width="100" height="100" alt="Author image">
                            <ul class="cd-author-info" style="list-style:none;">
                                <li><?php echo getLoginName($fetch['uid'],$fetch['type'],"0") ?></li>
                                
                            </ul>
                        </div> <!-- cd-author -->
                    </li>
        
                    
        
                    
        
                    
        
                   
        
                    
                </ul>
		<?php }
	}else{?>
    
    <ul style="list-style:none;padding:0px !important;">
                    <li class="cd-testimonials-item" style="padding-bottom:30px;">
                        <span>No Reviews yet. Be the first, to post a review.Click `Submit a testimonial`</span>
                        
                         <!-- cd-author -->
                    </li>
        
                    
        
                    
        
                    
        
                   
        
                    
                </ul>
			
	<?php }
									?>                 
                                    
        	
                
          
            </div>
                                    
                                </div>
                                   <?php 
									  if($usrId==''){
						  ?>
                                <div class="ask-a-question" style="width:25%; float:right;">
                                	<a  href="javascript:void(0)" onClick="msgAndRedirect('You would need to login to book an appointment.','<?php echo $ref; ?>')" >Submit a Testimonial</a>
                                </div>
                                
                              <?php }else{ ?>
                              <div class="ask-a-question" style="width:25%; float:right;">
                                    <a href="#small-dialog3"  class="popup-with-zoom-anim">Submit A Testimonial</a>
                                    <div class="zoom-anim-dialog mfp-hide" id="small-dialog3">
                                    <h1>Submit A Testimonial</h1>
                                    <div class="ask-a-button" id="loaderReview" style="display:block;">
                                   <p>
	Our Testimonial Policy :-<br />
	<br />
	It is our endeavour to provide the highest quality of service (in terms of information, guidance, and support) to every one visiting The Silver LiningTM. In accordance with the same, we encourage the submission of testimonials which are extremely specific and detailed.<br />
	<br />
	Each testimonial submitted undergoes a preliminary screening before it is shared for public viewing.We therefore humbly request you to spend a few minutes extra and include the following in your testimonial :-<br />
	<br />
	- The day and date of your interaction<br />
	<br />
	- The purpose for which you connected with the Silver Liner<br />
	<br />
	- How your experience was (please be as specific and detailed as possible)<br />
	<br />
	- How you feel you have benefited from this interaction (what is your biggest takeaway)<br />
	<br />
	After this preliminary quality inspection, your testimonial shall be posted on its destination and we shall duly inform you of the same. In case of any concerns also, we shall get back to you.<br />
	<br />
	Special Note : Please note that your testimonial is an extremely personal feedback to the Silver Liner you connected with. This feedback is extremely impactful on their reputation and perceived value.<br />
	<br />
	Please keep the same in mind when submitting your testimonial.If in an extreme case, you were displeased and discomforted in any way, please remember that none of the Silver Liners would ever intentionally cause the same to you. If you would still ever like to inform us of a grievance (we are sure this would be one in a million), please excuse the platform of testimonials for the same and write in to us at care@thesilverlining.co.in.</p>

                                  
                                    
                                    	<textarea class="text-box" id="review" name="review" placeholder="Write Your Review"></textarea>
                                        <input type="hidden" name="hidRCid"  id="hidRCid" value="<?php echo $cid; ?>">
                                        <input type="hidden" name="hidUid" id="hidRUid" value="<?php echo $usrId; ?>">
                                        <input type="hidden" name="hidRtype" id="hidRtype" value="<?php echo $type; ?>">
                                    	<button class="btn-contact" type="button"  onClick="populateReview()">Submit</button>
                                   
                                    </div>
                                    <div id="loadingreviewmsg" style="display:none">
                                    <div style="width:100%;min-height:100px;text-align:center;font-size:25px">
                                    <img src="<?php  echo $baseurl?>/images/populate.gif">&nbsp;&nbsp;Your review is being populated,please wait...
                                    </div>
                                    
                                    </div>
                                    
                                    <div class="clear"></div>
                                    </div>
                                    </div>
                              <?php } ?>  
                                
                                </div>                                   
                              <div class="clear"></div>                       
                            </div>
                        </div>                
                    </div>
                    
            <!----------------------------- first row end ---------------------------------->        
                    
                 <div class="clear" style="float:left;"></div>
                    
                </div>
            </section>
            <div class="clearfix"></div>
        </article>
        
        <div class="clear"></div>
        
        <a href="#" class="scrollup">^</a>
         <script type="text/javascript">
									  $(document).ready(function() {
										$('.popup-with-zoom-anim').magnificPopup({
										  type: 'inline',
								
										  fixedContentPos: false,
										  fixedBgPos: true,								
										  overflowY: 'auto',								
										  closeBtnInside: true,
										  preloader: false,										  
										  midClick: true,
										  removalDelay: 300,
										  mainClass: 'my-mfp-zoom-in'
										});
									  });
									</script>    
      <link   href="<?php echo $baseurl ?>/css/jquery.mCustomScrollbar.css" rel="stylesheet">
	<script src="<?php echo $baseurl ?>/javascript/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="<?php echo $baseurl ?>/javascript/jquery.mCustomScrollbar.js"></script>
     <script>
		(function($){
			$(window).load(function(){
				
				$("#content-1").mCustomScrollbar({
					theme:"minimal"
				});
				
			});
		})(jQuery);
	</script> 
    
    
     
        <?php include_once('innerfooter.php') ?>  
        

  <!-- FlexSlider -->
  <script defer src="<?php echo $baseurl ?>/javascript/jquery.flexslider-min.js"></script>

  <script type="text/javascript">
  
    $(window).load(function(){
      $('.flexslider').flexslider({
        animation: "slide",
        animationLoop: true,
        itemWidth: 245,
        itemMargin: 5,
        pausePlay: false,
	directionNav:false,
	fadeFirstSlide:false,
        start: function(slider){
         // $('body').removeClass('loading');
        }
      });
    });
  </script>        
      
    
    </body>

</html>
