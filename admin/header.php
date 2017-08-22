 <?php
$adminId=$_SESSION['aid'];
$admtype=$_SESSION['type'];




	//updateExpiredMembers(); // expire member set status to 0
?>

	<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

	<!-- jQuery UI -->
	<!--<link href="../plugins/jquery-ui/jquery-ui-1.10.2.custom.css" rel="stylesheet" type="text/css" />-->
	<!--[if lt IE 9]>
		<link rel="stylesheet" type="text/css" href="plugins/jquery-ui/jquery.ui.1f.10.2.ie.css"/>
	<![endif]-->

	<!-- Theme -->
	<link href="../assets/css/main.css" rel="stylesheet" type="text/css" />
	<link href="../assets/css/plugins.css" rel="stylesheet" type="text/css" />
	<link href="../assets/css/responsive.css" rel="stylesheet" type="text/css" />
	<link href="../assets/css/icons.css" rel="stylesheet" type="text/css" />

	<link rel="stylesheet" href="../assets/css/fontawesome/font-awesome.min.css">
	<!--[if IE 7]>
		<link rel="stylesheet" href="assets/css/fontawesome/font-awesome-ie7.min.css">
	<![endif]-->

	<!--[if IE 8]>
		<link href="assets/css/ie8.css" rel="stylesheet" type="text/css" />
	<![endif]-->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>

	<!--=== JavaScript ===-->

	<script type="text/javascript" src="../assets/js/libs/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="../plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>

	<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../assets/js/libs/lodash.compat.min.js"></script>

	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
		<script src="assets/js/libs/html5shiv.js"></script>
	<![endif]-->

	<!-- Smartphone Touch Events -->
	<script type="text/javascript" src="../plugins/touchpunch/jquery.ui.touch-punch.min.js"></script>
	<script type="text/javascript" src="../plugins/event.swipe/jquery.event.move.js"></script>
	<script type="text/javascript" src="../plugins/event.swipe/jquery.event.swipe.js"></script>

	<!-- General -->
	<script type="text/javascript" src="../assets/js/libs/breakpoints.js"></script>
	<script type="text/javascript" src="../plugins/respond/respond.min.js"></script> <!-- Polyfill for min/max-width CSS3 Media Queries (only for IE8) -->
	<script type="text/javascript" src="../plugins/cookie/jquery.cookie.min.js"></script>
	<script type="text/javascript" src="../plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script type="text/javascript" src="../plugins/slimscroll/jquery.slimscroll.horizontal.min.js"></script>

	<!-- Page specific plugins -->
	<!-- Charts -->
	<!--[if lt IE 9]>
		<script type="text/javascript" src="plugins/flot/excanvas.min.js"></script>
	<![endif]-->
	<script type="text/javascript" src="../plugins/sparkline/jquery.sparkline.min.js"></script>
	<script type="text/javascript" src="../plugins/flot/jquery.flot.min.js"></script>
	<script type="text/javascript" src="../plugins/flot/jquery.flot.tooltip.min.js"></script>
    
	<script type="text/javascript" src="../plugins/flot/jquery.flot.resize.min.js"></script>
	<script type="text/javascript" src="../plugins/flot/jquery.flot.time.min.js"></script>
	<script type="text/javascript" src="../plugins/flot/jquery.flot.growraf.min.js"></script>
	<script type="text/javascript" src="../plugins/easy-pie-chart/jquery.easy-pie-chart.min.js"></script>
    
	<script type="text/javascript" src="../plugins/flot/jquery.flot.pie.min.js"></script>
	<script type="text/javascript" src="../plugins/daterangepicker/moment.min.js"></script>
	<script type="text/javascript" src="../plugins/daterangepicker/daterangepicker.js"></script>
    
    <script type="text/javascript" src="../plugins/pickadate/picker.time.js"></script>
	<script type="text/javascript" src="../plugins/blockui/jquery.blockUI.min.js"></script>

	<script type="text/javascript" src="../plugins/fullcalendar/fullcalendar.min.js"></script>


<!-- Form Validation -->
	<script type="text/javascript" src="../plugins/validation/jquery.validate.min.js"></script>
	<script type="text/javascript" src="../plugins/validation/additional-methods.min.js"></script>


	<!-- Noty -->
	<script type="text/javascript" src="../plugins/noty/jquery.noty.js"></script>
	<script type="text/javascript" src="../plugins/noty/layouts/top.js"></script>
	<script type="text/javascript" src="../plugins/noty/themes/default.js"></script>

	<!-- Forms -->
	<script type="text/javascript" src="../plugins/uniform/jquery.uniform.min.js"></script>
	<script type="text/javascript" src="../plugins/select2/select2.min.js"></script>

	<!-- App -->
	<script type="text/javascript" src="../assets/js/app.js"></script>
	<script type="text/javascript" src="../assets/js/plugins.js"></script>
	<script type="text/javascript" src="../assets/js/plugins.form-components.js"></script>
	<!-- Tables -->
	
    	<!-- alert --><script type="text/javascript" src="../plugins/bootbox/bootbox.js"></script>
        	

    
	<script type="text/javascript" src="../plugins/datatables/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="../plugins/datatables/tabletools/TableTools.min.js"></script> <!-- optional -->
	<script type="text/javascript" src="../plugins/datatables/colvis/ColVis.min.js"></script> <!-- optional -->
	<script type="text/javascript" src="../plugins/datatables/DT_bootstrap.js"></script>
	<script type="text/javascript" src="../plugins/datatables/responsive/datatables.responsive.js"></script> <!-- optional -->
	<script type="text/javascript" src="../plugins/typeahead/typeahead.min.js"></script> <!-- AutoComplete -->
     
	<script type="text/javascript" src="../plugins/autosize/jquery.autosize.min.js"></script>
	<script type="text/javascript" src="../plugins/inputlimiter/jquery.inputlimiter.min.js"></script>
	<script type="text/javascript" src="../plugins/uniform/jquery.uniform.min.js"></script> <!-- Styled radio and checkboxes -->
	<script type="text/javascript" src="../plugins/tagsinput/jquery.tagsinput.min.js"></script>
	<script type="text/javascript" src="../plugins/select2/select2.min.js"></script> <!-- Styled select boxes -->
	<script type="text/javascript" src="../plugins/fileinput/fileinput.js"></script>
    
	<script type="text/javascript" src="../plugins/duallistbox/jquery.duallistbox.min.js"></script>
	<script type="text/javascript" src="../plugins/bootstrap-inputmask/jquery.inputmask.min.js"></script>
	<script type="text/javascript" src="../plugins/bootstrap-wysihtml5/wysihtml5.min.js"></script>
	<script type="text/javascript" src="../plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.min.js"></script>
	<script type="text/javascript" src="../plugins/bootstrap-multiselect/bootstrap-multiselect.min.js"></script>
	 <script type="text/javascript" src="../plugins/sparkline/jquery.sparkline.min.js"></script>
   
	<script>
	$(document).ready(function(){
		"use strict";

		App.init(); // Init layout and core plugins
		Plugins.init(); // Init all plugins
		FormComponents.init(); // Init all form-specific plugins
	});
	</script>
    	
	<script>
  
    $(function() {
		var pickerOpts = {
			dateFormat:"dd/mm/yy"
		};	
    	$( ".datepicker" ).datepicker(pickerOpts);
		
		
    });
    </script>
	<!-- Demo JS -->
		<script type="text/javascript" src="../assets/js/custom.js"></script>
        <script type="text/javascript" src="../assets/js/demo/pages_calendar.js"></script>
        <script type="text/javascript" src="../plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
        
        <script type="text/javascript" src="../assets/js/demo/ui_general.js"></script>
        <script type="text/javascript" src="../assets/js/demo/form_validation.js"></script>
        <script type="text/javascript" src="../plugins/pickadate/picker.time.js"></script>
       
    <script type="text/javascript" src="../plugins/sparkline/jquery.sparkline.min.js"></script>
	<script type="text/javascript" src="../plugins/flot/jquery.flot.min.js"></script>
	<script type="text/javascript" src="../plugins/flot/jquery.flot.tooltip.min.js"></script>

	<script type="text/javascript" src="../plugins/flot/jquery.flot.pie.min.js"></script>
	<script type="text/javascript" src="../plugins/easy-pie-chart/jquery.easy-pie-chart.min.js"></script>
	<script type="text/javascript" src="../assets/js/custom.js"></script>
	<script type="text/javascript" src="../assets/js/demo/charts.js"></script>
	<script type="text/javascript" src="../assets/js/demo/charts/chart_pie.js"></script>
      
       
<header class="header navbar navbar-fixed-top" role="banner">
		<!-- Top Navigation Bar -->
		<div class="container">

			<!-- Only visible on smartphones, menu toggle -->
			<ul class="nav navbar-nav">
				<li class="nav-toggle"><a href="javascript:void(0);" title=""><i class="icon-reorder"></i></a></li>
			</ul>

			<!-- Logo -->
			<a class="navbar-brand" href="#">
				<!--<img src="images/logoiconsmall.png" alt="logo" width="39" height="39" />-->
				<strong style="margin-top:5px;">Restaurant</strong>&nbsp;</a>
			<!-- /logo -->

			<!-- Sidebar Toggler -->
			<a href="#" class="toggle-sidebar bs-tooltip" data-placement="bottom" data-original-title="Toggle navigation">
				<i class="icon-reorder"></i>			</a>
			<!-- /Sidebar Toggler -->

			<!-- Top Left Menu -->
	  <ul class="nav navbar-nav navbar-left hidden-xs hidden-sm">
				<li>
					<a href="#">
						Dashboard
					</a>
				</li>
               
			</ul>
			<!-- /Top Left Menu -->

			<!-- Top Right Menu -->
			<ul class="nav navbar-nav navbar-right">
				<!-- Notifications -->
                
               
                
                
             
              
                
                <!--<li style="width:150px;border:0px;">&nbsp;</li>-->
                <?php
				//	$unassignedLeads=getUnassignedLeads($adminId,$admtype);
					//	$countUnassigned=count($unassignedLeads);	
					//if($countUnassigned>0){
						
				?>
                
				<?php /*?><li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img src="images/validmember.png" title="Unassigned Leads">
						<span class="badge"><?php echo $countUnassigned; ?></span>					</a>
			  <ul class="dropdown-menu extended notification" >
						<li class="title">
							<p><?php echo $countCredit; ?> Unassigned Leads</p>
						</li>
						
                        <?php 
						
					    $amtcount=0;
						foreach($unassignedLeads as $uleads){
							
						   $amtcount++;	
							$unassignleadid=getLeadId($uleads);
							
						?>
                        <?php if($amtcount<=6){ ?>
						<li>
							<a href="javascript:void(0);">
								<span class="label label-info"><i class="icon-bullhorn"></i></span>
								<span class="message"><?php echo "Not Assigned Yet - ".$unassignleadid; ?></span>
								<span class="time"></span>
							</a>
						</li>
                        
                        
                        
                       <?php }} ?> 
					
						<!--<li class="footer">
							<a href="unassignedleads.php">View All Notifications</a>
						</li>-->
                       
                        
					</ul>
				</li><?php */?>

     			<?php //} ?>

		    <!-- Tasks -->
				<!--<li class="dropdown hidden-xs hidden-sm">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-tasks"></i>
						<span class="badge">0</span>					</a>
			  <ul class="dropdown-menu extended notification">
						<li class="title">
							<p>You have 0 pending tasks</p>
						</li>
						<li>
							<a href="javascript:void(0);">
								<span class="task">
									<span class="desc">No Pending Request</span>
									<span class="percent">0%</span>
								</span>
								<div class="progress progress-small">
									<div style="width: 30%;" class="progress-bar progress-bar-info"></div>
								</div>
							</a>
						</li>
						
						
						<li class="footer">
							<a href="javascript:void(0);">View all tasks</a>
						</li>
					</ul>
				</li>-->

		    <!-- Messages -->
            
          

		    <!-- .row .row-bg Toggler -->
				<?php
					 $leadNotification=checkLeadsNotification();
				?>

				<!-- Project Switcher Button -->
			<!--	<li class="dropdown">
					<a href="#" class="project-switcher-btn dropdown-toggle">
						<i class="icon-folder-open"></i>
                        
						<span>Notifications <?php if($leadNotification) {?><img src="images/bell.png"><?php } ?></span>
					</a>
				</li>
                -->

				<!-- User Login Dropdown -->
				<li class="dropdown user">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<!--<img alt="" src="assets/img/avatar1_small.jpg" />-->
						<i class="icon-male"></i>
						<span class="username"><?php echo getAdminNameById($adminId); ?></span>
						<i class="icon-caret-down small"></i>
					</a>
					<ul class="dropdown-menu">
						<li><a href="account.php"><i class="icon-user"></i> My Account</a></li>
						<li class="divider"></li>
						<li><a href="logout.php"><i class="icon-key"></i> Log Out</a></li>
					</ul>
				</li>
				<!-- /user login dropdown -->
			</ul>
			<!-- /Top Right Menu -->
		</div>
		<!-- /top navigation bar -->

		<!--=== Project Switcher ===-->
		 <!-- /#project-switcher -->
         <div id="project-switcher" class="container project-switcher">
			<div id="scrollbar">
				<div class="handle"></div>
			</div>

			<div id="frame">
				<ul class="project-list">
					
                    <?php
									$execQry=mysql_query("select * from `leadtypes` where `status` = '1' and `id` IN (1,2) order by `id` "); // 1,2 for followup and meetings
									$numRows=mysql_num_rows($execQry);
									if($numRows>0){
									while($fetch=mysql_fetch_array($execQry)){
										$countLeadTypes=countLeadTypesByDate($fetch['id']);
										
										?>
                                    <li class="current">
						<a href="viewleadstatus.php?type=<?php echo $fetch['id']; ?>">
							<span class="image"><i class="icon-<?php echo $fetch['class']; ?>"></i></span>
							<span class="title"><?php echo $fetch['name'] ?>
                            <?php 
							if($countLeadTypes){
							?>
                            <span style="color:#FFF;font-weight:bold;background-color:#D51E1E;padding:3px;border-radius:4px;">&nbsp;<?php echo $countLeadTypes; ?>&nbsp;</span>
                            <?php }?>
                            </span>
						</a>
					</li>
                                    
                                    <?php  }}?> 
                    
                    
                    
                    
					
					<!--<li>
						<a href="javascript:void(0);">
							<span class="image"><i class="icon-female"></i></span>
							<span class="title">At vero eos et</span>
						</a>
					</li>-->
					
				</ul>
			</div> <!-- /#frame -->
		</div>
	</header>