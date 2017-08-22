<?php
$filename=basename($_SERVER['PHP_SELF']);

?>
<div class="crumbs">
					<ul id="breadcrumbs" class="breadcrumb">
						<li>
							<i class="icon-home"></i>
							<a href="#">You Are Here </a>
						</li>
						<li class="current">
							<a href="#" title=""><?php echo getBreadCrumb($filename); ?></a>
						</li>
					</ul>

					<ul class="crumb-buttons">
						<!--<li><a href="javascript:void(0)" title=""><i class="icon-edit"></i><span>Tds :  <?php echo getEffectiveTDS();  ?> %</span></a></li>
                        <li><a href="javascript:void(0)" title=""><i class="icon-cogs"></i><span>Service Tax : <?php echo getEffectiveServiceTax()  ?> %</span></a></li>-->
						<!--<li class="dropdown"><a href="#" title="" data-toggle="dropdown"><i class="icon-tasks"></i><span>Users <strong>(+3)</strong></span><i class="icon-angle-down left-padding"></i></a>
							<ul class="dropdown-menu pull-right">
							<li><a href="form_components.html" title=""><i class="icon-plus"></i>Add new User</a></li>
							<li><a href="tables_dynamic.html" title=""><i class="icon-reorder"></i>Overview</a></li>
							</ul>
						</li>-->
						<li ><a href="#">
							<i class="icon-calendar"></i>
							<span><?php echo date(" l, d M, Y "); ?></span>
							
						</a></li>
					</ul>
				</div>