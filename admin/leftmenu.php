<?php
$adminid=$_SESSION['aid'];
$filename=basename($_SERVER['PHP_SELF']);

$adKey=getAdminKey($adminid);
	if($adKey=='1'){
		$excMenuQry=mysql_query("select * from `menucategory` where `status` ='1' order by `position` Asc ");
		$qryText=" 1";
	}else{
		$adminRole=getAdminRoleById($adminid); 
		$roleBasedRights=getRoleBasedRights($adminRole); 
		$impRights=implode(",",$roleBasedRights);
		$mainMenus=getMainMenusByRights($roleBasedRights);
		$unqMainMenus=implode(",",array_unique($mainMenus));
		$qryText=" `id` IN ($impRights)";
		
		$excMenuQry=mysql_query("select * from `menucategory` where `id` in(".$unqMainMenus.") order by `position` Asc ");
	}
	    $numMenuRows=mysql_num_rows($excMenuQry);
		
		$mainCatIdByUrl=getMenuIdByUrl($filename);
?>
<div id="sidebar" class="sidebar-fixed">
			<div id="sidebar-content">

				<!-- Search Input -->
				<!--<form class="sidebar-search">
					<div class="input-box">
						<button type="submit" class="submit">
							<i class="icon-search"></i>
						</button>
						<span>
							<input type="text" placeholder="Search...">
						</span>
					</div>
				</form>-->

				<!-- Search Results -->
				 <!-- /.sidebar-search-results -->

				<!--=== Navigation ===-->
				<ul id="nav">
					<li class="current">
                       <?php 
					   if($adKey==1){
					   ?>
						<a href="dashboard.php"><i class="icon-dashboard"></i>Dashboard</a>
                        <?php }else{ ?>
                        <a href="home.php"><i class="icon-dashboard"></i>Dashboard</a>
                        <?php } ?>
					</li>
					<!--<li>
						<a href="javascript:void(0);">
							<i class="icon-desktop"></i>
							UI Features
							<span class="label label-info pull-right">6</span>
						</a>
						<ul class="sub-menu">
							<li>
								<a href="ui_general.html">
								<i class="icon-angle-right"></i>
								General
								</a>
							</li>
							<li>
								<a href="ui_buttons.html">
								<i class="icon-angle-right"></i>
								Buttons
								</a>
							</li>
							<li>
								<a href="ui_tabs_accordions.html">
								<i class="icon-angle-right"></i>
								Tabs &amp; Accordions
								</a>
							</li>
							<li>
								<a href="ui_sliders.html">
								<i class="icon-angle-right"></i>
								Sliders
								</a>
							</li>
							<li>
								<a href="ui_nestable_list.html">
								<i class="icon-angle-right"></i>
								Nestable List
								</a>
							</li>
							<li>
								<a href="ui_typography.html">
								<i class="icon-angle-right"></i>
								Typography / Icons
								</a>
							</li>
							<li>
								<a href="ui_google_maps.html">
								<i class="icon-angle-right"></i>
								Google Maps
								</a>
							</li>
							<li>
								<a href="ui_grid.html">
								<i class="icon-angle-right"></i>
								Grid
								</a>
							</li>
						</ul>
					</li>-->
                
                <?php
				if($numMenuRows>0){
				while($fetchMenu=mysql_fetch_array($excMenuQry)){
				 $menuId=$fetchMenu['id'];
				 $category=$fetchMenu['category'];
				 $menuClass=$fetchMenu['class'];
				 //$id++;
				// echo "select * from `menusubcategory` where 1 and `c_id` ='$menuId' and  $qryText and `status` ='1' ";
				?>
                
                    
					<li  >
						<a href="javascript:void(0);">
							<i class="icon-<?php echo $menuClass; ?>" ></i>
							<span <?php if($mainCatIdByUrl==$menuId){ ?> style="color:#E12424;" <?php } ?> ><?php echo $category; ?></span>
						</a>
						<ul class="sub-menu" style="display:<?php if($mainCatIdByUrl==$menuId){ ?> block<?php }else{?>none;<?php }?>" >
							<?php
							
							$excSubMenuQry=mysql_query("select * from `menusubcategory` where 1 and `c_id` ='$menuId' and  $qryText and `status` ='1' order by `position` Asc ,`id` Desc ");
								$numSubMenuRows=mysql_num_rows($excSubMenuQry);
								$mid=0;
								if($numSubMenuRows>0){
								while($fetchSubMenu=mysql_fetch_array($excSubMenuQry)){
								$subcategory=$fetchSubMenu['subcategory'];
								$link=$fetchSubMenu['link'];
							?>
							<li>
								<a href="<?php echo $link; ?>">
								<i class="icon-angle-right"></i>
								<?php echo $subcategory; ?>
                                
								</a>
							</li>
                            
                            <?php }}else{?>
                            <li>
								<a href="form_validation.html">
								<i class="icon-angle-right"></i>
								No Sub Menu Yet
								</a>
							</li>
                            <?php }?>
                            
						</ul>
					</li>
					
					
				<?php
				}}else{
				?>
                	
                <li>
						<a href="javascript:void(0);">
							<i class="icon-edit"></i>
							No Menu Yet
						</a>
						
					</li>
				<?php } ?>	
				</ul>
				
				<!-- /Navigation -->
				
			</div>
			<div id="divider" class="resizeable"></div>
		</div>