<?php
ob_start();
session_start();
$adminId=$_SESSION['aid'];
$type=$_SESSION['type'];
include_once("../configuration/connect.php");
include_once("../configuration/functions.php");
checkIntrusion($adminId);
$currentDate=date("Y")."-".date("m")."-".date("d");

if(isset($_GET['search'])){
	if(isset($_GET['sdate'])  && isset($_GET['state'])){
		
		$totalLeads=searchTotalAssignedMeetingLeadsBydateAndPlace($_GET['sdate'],$_GET['edate'],$_GET['state'],$_GET['city'],$_GET['area'],$adminId,$type);	
		if($_GET['sdate']==$_GET['edate']){
			$searchText=" Meetings on  ".$_GET['sdate']." at ".getLocationText($_GET['state'],$_GET['city'],$_GET['area']);
		}else{
			$searchText=" Meetings between  ".$_GET['sdate']." and ".$_GET['edate']. " at ".getLocationText($_GET['state'],$_GET['city'],$_GET['area']);
		}
	}
	
	if(isset($_GET['sdate']) && !isset($_GET['state']) ){
		$totalLeads=searchTotalAssignedMeetingLeadsBydate($_GET['sdate'],$_GET['edate'],$adminId,$type);
		
		if($_GET['sdate']==$_GET['edate']){
			$searchText=" Meetings on  ".$_GET['sdate'];
		}else{
			$searchText=" Meetings between  ".$_GET['sdate']." and ".$_GET['edate'];
		}
			
	}
	
	if(isset($_GET['state']) && !isset($_GET['sdate']) ){
		$totalLeads=searchTotalAssignedMeetingLeadsByPlace($_GET['state'],$_GET['city'],$_GET['area'],$adminId,$type);	
		$searchText=" Meetings at ".getLocationText($_GET['state'],$_GET['city'],$_GET['area']);
	}



}else{
	if($type==1){ 
		$totalLeads=getTotalAssignedMeetingLeads();
	}else{
		$totalLeads=getTotalAssignedMeetingLeadsById($adminId);
	}

}

//print_r($totalLeads);

if(count($totalLeads)==0){
	$totalLeads['0']=0;
}



if(isset($_GET['msg'])&&$_GET['msg']!=''){	
	$msg=$_GET['msg'];
	
	switch($msg){
	case 'ins':
		$msg='Lead Data has been modified successfully !!';
		$class='success';
	break;
	
	case 'inf':
		$msg='Lead Data has been modified successfully !!';
		$class='danger';
	break;
	case 'ups':
		$msg='Members data updated Successfully !!';
		$class='success';
	break;
	
	case 'upf':
		$msg='Members data not updated Successfully !!';
		$class='danger';
	break;
	
	case 'ule':
		$msg='This username already exists!!';
		$class='danger';
	break;
	case 'dls':
		$msg='Data deleted successfully !!';
		$class='success';
	break;
	
	case 'dlf':
		$msg='Data not deleted successfully !!!!';
		$class='danger';
	break;
	
		case 'ads':
		$msg='Administrator rights added successfully !!';
		$class='success';
	break;
	
	case 'adf':
		$msg='Administrator rights not added successfully !!!!';
		$class='danger';
	break;
	
	case 'default' :
		$msg='';
		break;
	
	}
	}
	
	
//print_r($totalLeads);


	
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<title><?php echo getSiteTitle(); ?></title>
    <script src="javascript/javascript.js" type="text/javascript"></script>
    <script type="text/javascript" src="assets/js/libs/jquery-1.10.2.min.js"></script>
    <script src="javascript/sweet-alert.js" language="javascript" type="text/javascript"> </script>
    <link rel="stylesheet" href="css/sweet-alert.css" type="text/css">
    <script src="javascript/javascript.js" language="javascript" type="text/javascript"> </script>
      <script language="javascript" src="javascript/jquery.js"> </script>                     
      <script>
jQuery(function($) {
    // Asynchronously Load the map API 
    var script = document.createElement('script');
    script.src = "http://maps.googleapis.com/maps/api/js?sensor=false&callback=initialize";
    document.body.appendChild(script);
});

function initialize() {
    var map;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        mapTypeId: 'roadmap'
    };
                    
    // Display a map on the page
    map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
    map.setTilt(45);
        
    // Multiple Markers
    var markers = [  <?php  echo getMarkersofLeads($totalLeads) ?>  ];
	
	                 
    // Info Window Content
    var infoWindowContent = [ <?php echo getMarkerAddress($totalLeads) ?>  ];
        
    // Display multiple markers on a map
    var infoWindow = new google.maps.InfoWindow(), marker, i;
    
    // Loop through our array of markers & place each one on the map  
	
    for( i = 0; i < markers.length; i++ ) {
        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map,
            title: markers[i][0]
        });
        
        // Allow each marker to have an info window    
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infoWindow.setContent(infoWindowContent[i][0]);
                infoWindow.open(map, marker);
            }
        })(marker, i));

        // Automatically center the map fitting all markers on the screen
        map.fitBounds(bounds);
		
    }
 infowindow.open(map,marker);
    // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(7);
        google.maps.event.removeListener(boundsListener);
    });
   
}
</script>
    
    <style>
#map_wrapper {
    height: 400px;
}

#map_canvas {
    width: 100%;
    height: 100%;
}
</style>
    
    
	</head>

<body class="theme-dark">

	<!-- Header -->
	<?php include_once("header.php"); ?> <!-- /.header -->

	<div id="container" >
		<?php include_once("leftmenu.php"); ?>
		<!-- /Sidebar -->

		<div id="content">
			<div class="container">
				<!-- Breadcrumbs line -->
				<?php include_once("crumb.php"); ?>
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
                <?php if($msg!=''){ ?>
             <div class="row">
             <div class="col-md-12">
             <div class="alert alert-<?php echo $class ?> fade in">
									<i class="icon-remove close" data-dismiss="alert"></i>
									<?php echo $msg; ?>
								</div>
                                </div>
             </div>
             <?php } ?>
                <div class="row">
                <div class="col-md-2"><div class="page-title">
						<h3>View All Meetings  </h3>
						<span style="color:#F00;"> <?php echo changeToStdDate($currentDate); ?> and onwards </span>
					</div></div>
                <div class="col-md-10" ><div class="page-titles" style="text-align:right;padding-top:20px;">
						<h6>
                        
                        <div class="form-group">
                       <div class="row">
                       <div class="col-md-1"><input type="checkbox" id="datecheck" onClick="openDatesSearch()"></div>
                       <div class="col-md-2" ><input type="text"  id="sdate"   placeholder="Start Date" class="form-control input-width datepicker"  ></div>
                            <div class="col-md-2"><input type="text"  id="edate"   placeholder="End Date" class="form-control input-width datepicker" ></div>
                           
                            <div class="col-md-1"><input type="checkbox" id="placecheck" onClick="openPlaceSearch()"></div>
                            
                            <div class="col-md-2">  <input type="hidden" name="hidCity" id="hidCity" value="">
                                                    <input type="hidden" name="hidArea" id="hidArea" value="">
													<select name="state" id="state" class="form-control "  onChange="getCityByStateId(this.value)"><option value="0">Select</option>
				<?php
					$execQry=mysql_query("select * from `state` where `status` = '1' order by `id` ");
					$numRows=mysql_num_rows($execQry);
					if($numRows>0){
					while($fetch=mysql_fetch_array($execQry)){?>
					<option value="<?php echo stripslashes($fetch['id']) ?>" <?php if($userData[1]==$fetch['id']) {?> selected <?php } ?>><?php echo stripslashes($fetch['name']) ?></option>
					<?php }	}else{?>
					<option value="0">No State</option>

					<?php } ?>
                
                </select></div>
                            <div class="col-md-2"><div id="citydiv"><select name="city" id="city" class="form-control " onChange="getAreaByCity(this.value)" ><option value="0">Select City</option>
				
                
                </select></div></div>
                            <div class="col-md-2"><div id="areadiv"><select name="area" id="area" class="form-control " ><option value="0">Select Area</option>
				
                
                </select></div></div>
                            <div class="col-md-1"><input onClick="searchMeetings()" type="button" class="btn" value="Search"></div>
                        </div>
                        
                        
                        </div>
                        

</h6>
						<!--<span>Good morning, John!</span>-->
					</div></div>
                </div>
					

				
                
                
                
                	<!-- Page Stats -->
					
					<!-- /Page Stats -->
				</div>
				<!-- /Page Header -->
            
        <div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> Leads - <?php  echo $searchText; ?> </h4>
								<div class="toolbar no-padding">
									<div class="btn-group">
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div class="widget-content no-padding">
								<table  class="table table-striped table-bordered table-hover table-checkable table-responsive  datatable">
									<thead>
										
                                        
                                         <tr >
                                            <th >Sno</th>
                                            <th  data-hide="phone">View</th>
                                            <th> Lead Id</th>
                                            <th  data-hide="phone">Client Name</th>
                                             <th  data-hide="phone">Conc Per</th>
                                            <th  data-hide="phone">Contact</th>
                                            <th  data-hide="phone">Email</th>
                                            <th data-hide="phone,tablet">Location</th>
                                            <th  data-hide="phone">Meeting Date </th>
                                            <th data-hide="phone,tablet" style="text-align:center;">Meeting Notes</th>
										  </tr>
                                        
                                        
									</thead>
									<tbody>
										<?php 
										$impLeads=implode(",",$totalLeads);
  	$sqlQry=mysql_query("select * from `assignleads` where `status`!='2' and  `id`  IN ($impLeads)  order by `id` Desc");
	$i=0;
	$numrows=mysql_num_rows($sqlQry);
	if($numrows>0){
	while($fetch=mysql_fetch_array($sqlQry)){
		$i++;
		$id=$fetch['id'];
		$lid=$fetch['lid'];
		$leadDetailsArr=getLeadsDetailById($lid);
		$leadId=getLeadId($lid);
	    $clientName=getClientsNameById($lid);
		$clientComp=getClientsCompNameById($lid);
		$meetingDate=getLatestMeetingDatesByLid($lid);
	
		
		
  ?>
  <tr bgcolor="#FFFFFF">
       <td align="center" class="smalltext"><?php echo $i; ?></td>
       <td align="center"  ><a href="viewleaddetails.php?aid=<?php echo base64_encode( $fetch['lid']); ?>"  > <button type="button" class="btn"><i class="icon-desktop"></i></button></a></td>
    <td align="left" class="smallfonttext"><?php echo $leadId; ?></td>
    <td align="left" class="smallfonttext"><?php echo $clientComp; ?></td>
    <td align="left" class="smallfonttext"><?php echo $clientName; ?></td>
   
     <td align="left" class="smallfonttext"><?php echo getClientContact($lid); ?></td>
     <td align="left" class="smallfonttext"><?php echo stripslashes($leadDetailsArr[4]); ?></td>
	<td align="left" class="smallfonttext" style="text-align:center;"><?php echo getClientLocation($lid); ?></td>
     <td align="left" style="text-align:center;" class="smallfonttext"><?php echo changeToStddate($meetingDate); ?></td>
    <td align="center"  ><span class="label label-success"><a style="color:#FFF;" href="addmeetingnotes.php?aid=<?php echo base64_encode($id); ?>">Add  Notes</a></span></td>
  </tr>

  
  <?php }}else{?>
  <tr><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td><td>No Record</td></tr>
  
  <?php } ?>
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>    
             <?php
			 if(count($totalLeads)>0){
				 
				  // getMarkersofLeads($totalLeads);
			 ?>   
                <div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> View Meeting locations </h4>
								<div class="toolbar no-padding">
									<div class="btn-group">
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div class="widget-content no-padding">
     
                            
                            
                                <div id="map_wrapper">
                                		<div id="map_canvas" class="mapping"></div>
                                </div>
							
                            
                            </div>
						</div>
					</div>
				</div>
                
                <?php } ?>
            
			<!-- /.container -->

		</div>
	</div>
<script>
function openDatesSearch(){
	if(document.getElementById('datecheck').checked==true){
		document.getElementById('sdate').style.display='block';
		document.getElementById('edate').style.display='block';
	}else{
		document.getElementById('sdate').style.display='none';
		document.getElementById('edate').style.display='none';
	}
}

function openPlaceSearch(){
	if(document.getElementById('placecheck').checked==true){
		document.getElementById('state').disabled=false;
		document.getElementById('city').disabled=false;
		document.getElementById('location').disabled=false;
	}else{
		document.getElementById('state').disabled=true;
		document.getElementById('city').disabled=true;
		document.getElementById('location').disabled=true;
	}
}

function searchMeetings(){
	var locationsearch="viewmeetings.php?search=true";
	if(document.getElementById('datecheck').checked==true){
		sdate=document.getElementById('sdate').value;
		edate=document.getElementById('edate').value;
		locationsearch+="&sdate="+sdate+"&edate="+edate;
		
	}
	if(document.getElementById('placecheck').checked==true){
		state=document.getElementById('state').value;
		city=document.getElementById('hidCity').value;
		if(city==''){
			city=0;	
		}
		area=document.getElementById('hidArea').value;
		if(area==''){
			area=0;	
		}
		locationsearch+="&state="+state+"&city="+city+'&area='+area;
		
	}
	
	window.location.href=locationsearch;
}

</script>
</div>
</body>
</html>