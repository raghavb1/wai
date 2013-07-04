<?php
include 'db.php';
include 'scripts.php';
include 'iprofile_updates.php';

class iprofile_outlay
{
	function outlay_html()
	{
		$c=new iprofile_updates;
		$outlay='
				<div class="header">
				</div>
				
				<div class="container">
				
					<div class="container2">
					
						<div class="sidebar1">
							hhh
						</div>
						
						<div class="content">
						'.$c->updates_show('421327464','main',1).'
						</div>
						
						<div class="sidebar2">
							fff
						</div>
						
					</div>
					
				</div>
				
				<div class="footer">
				</div>				
				';
		return $outlay;
	}

}

$c=new iprofile_outlay;
$d=$c->outlay_html();
echo $d;
?>