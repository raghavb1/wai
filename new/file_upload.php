<?php
ob_start();
define("xafsfsfsgs","qasw1234wqaa");
require_once("includes/functions.php");
require_once("includes/config.php");
require_once('includes/xmltoaraay.php');
require_once('includes/webdefine.php');
if(!$check_obj->checkvariable($_SESSION['userlogin']))
{
session_destroy();
header("location:index.php");
exit;
}
if(isset($_SESSION['userlogin']))
{
if(!$check_obj->checkvariable($_REQUEST['submit']))
{
header("location:invalid.php?i");
exit;
}
if($_REQUEST['submit']=='Upload')
{
if ($_FILES["xmlcauselist"]["error"] > 0){
	  echo "Error: " . $_FILES["xmlcauselist"]["error"] . "<br />";
	  exit;
	  }
 
	if ($_FILES["pdfcauselist"]["error"] > 0){
	  echo "Error: " . $_FILES["pdfcauselist"]["error"] . "<br />";
	  exit;
	  }
if($_FILES["xmlcauselist"]["type"]!='text/xml'){
	  header("location:invalid.php?xmlfile");
	  exit;
	 }
	 if($_FILES["pdfcauselist"]["type"]!='application/pdf'){
	  header("location:invalid.php?pdffile");
	  exit;
	 }
     $obj = new checkpdf();
    if(!$obj->pdf($_FILES["pdfcauselist"]["tmp_name"],'%PDF'))
	{	
      header("location:invalid.php?pdffile");
	  exit;

	}

libxml_use_internal_errors(true);
$xml = new DOMDocument();
$xmlfile = $_FILES["xmlcauselist"]["tmp_name"];	
$xmlschema = 'xmlcauselist.xsd';
$xml->load($xmlfile);
if (!$xml->schemaValidate($xmlschema)) {
    print '<b>DOMDocument::schemaValidate() Generated Errors!</b>';
    libxml_display_errors();
	exit;
}
else
{
     $directory_path = $_SERVER['DOCUMENT_ROOT'].'/'.FOLDERNAME.'/'.XMLTEMPPATH.'/';
     $upload = new Upload();
    $upload->SetFileName($_FILES['xmlcauselist']['name']);
    $upload->SetTempName($_FILES['xmlcauselist']['tmp_name']);
    $upload->SetUploadDirectory($directory_path); //Upload directory, this should be writable
    $upload->SetValidExtensions(array('xml','XML')); //Extensions that are allowed if none are set all extensions 
    $upload->UploadFile();
$xmlfilename = $directory_path.basename($_FILES["xmlcauselist"]["name"]);
 $hp = fopen($xmlfilename,"r") or die("No File Present at that time");
if($hp)
{
$contents = file_get_contents($xmlfilename);
$results = xml2array($contents);
fclose($hp);
delete_directory(XMLTEMPPATH);
if(is_array($results)){

if( is_array($results['causelist']['date']))
	{
        print_r($results['causelist']['date']);
		echo "<br>";
		if(isset($results['causelist']['date']['causelisttodate']))
		{
		  if(is_array($results['causelist']['date']['causelisttodate']))
		  {
	       $todate = "";
		   }
		   else
		   {
			if(!checkDateFormat($todate))
			{
			header("location:invalid.php?date");
			exit;
			
			}
		 }
	}
	$fromdate = $results['causelist']['date']['causelistfromdate'];

	if(!checkDateFormat($fromdate))
	{
	header("location:invalid.php?date");
	exit;
	
	}
		
	
	//$fromdate = formatDate('d-m-Y',$fromdate);
	$fromdate = date('d-m-Y',strtotime($fromdate));
	$todate   =   date('d-m-Y',strtotime($todate));
	$date_array = array();
	$date_array = explode("-",$fromdate);
	$day = $data_array[0];
	$month = $date_array[1];
     $year = $date_array[2];
	$year = date("Y",strtotime($year));
	$month = date('M', mktime(0, 0, 0, $month));
	if($_FILES['pdfcauselist']['tmp_name']) {
	
	///////// causelist type and commom remarks ////////////////
	   // $causelist_date = $results['causelist']['date']['causelistdate'];
        $causelist_type = $results['causelist']['date']['causelisttype'];
		if(isset($results['causelist']['date']['common_remarks']))
		{
	    $common_remarks = @addslashes($results['causelist']['date']['common_remarks']);
		}
		if(isset($results['causelist']['date']['end_remarks']))
		{
	      $end_remarks    = @addslashes($results['causelist']['date']['end_remarks']);
		
		}
		
		
	    $causelst_query = "Select clist_types.LIST_ID,clist_types.LIST_TYPE from clist_types,court_clist_types where clist_types.LIST_DESC='".$causelist_type."' and clist_types.LIST_ID = court_clist_types.LIST_ID and HCCODE='".$_SESSION['hccode']."'";
		
	    $causelist_query_result = mysql_query($causelst_query);
		$list_id_row = mysql_fetch_array($causelist_query_result);
		if(mysql_num_rows($causelist_query_result)<1)
		{
		
		header("location:invalid.php?invalidtype");
		exit;
		
		}
//////////////// list_id////////////////////////
		$list_id = $list_id_row['LIST_ID'];
		$list_id_length = strlen($list_id);
		if($list_id_length==1)
		{
		$list_id = '00'.$list_id;
		}
		elseif($list_id_length==2)
		{
		$list_id = '0'.$list_id;
		}
//// hccode->code for the courts////////////
$hc_query = "select hcode from hclist where hcname = '".$_SESSION['login_name']."'";
$hc_result = mysql_query($hc_query) or die(mysql_error());
if(mysql_num_rows($hc_result)!=0)
		{
	$hc_row = mysql_fetch_array($hc_result) or die(mysql_error());
$hccode = $hc_row['hcode'];

		}
		else
		{
     echo "Invalid Court!! try again";
     exit;

		}
		$hccode_length = strlen($hccode);
		if($hccode_length==1)
		{
		$hccode = '00'.$hccode;
		}
		elseif($hccode_length==2)
		{
		$hccode = '0'.$hccode;
		}
		$obj = new mkdirectory();
	$directorypath = $_SERVER['DOCUMENT_ROOT'].'/'.FOLDERNAME.FPATH.$_SESSION['userlogin'];
	$obj->directory($directorypath,$year,$month);
	$file_ext = substr($_FILES['pdfcauselist']['name'], strripos($_FILES['pdfcauselist']['name'], '.'));
	$newfilename = $list_id.str_replace("-","",$fromdate).$file_ext;
	$upload = new Upload();
    $upload->SetFileName($newfilename);
    $upload->SetTempName($_FILES['pdfcauselist']['tmp_name']);
    $upload->SetUploadDirectory($directorypath.'/'.$year.'/'.$month.'/'); 
	//Upload directory, this should be writable
    $upload->SetValidExtensions(array('pdf','PDF')); 
	//Extensions that are allowed if none are set all extensions 
     $upload->UploadFile();
	 $filepath = FPATH.$_SESSION['userlogin'].'/'.$year.'/'.$month.'/'.$newfilename;
     $fromdate = date('d-m-Y', strtotime($fromdate));
	 $fromdate_formated = str_replace('-',"",$fromdate);
	 $clist_id = $fromdate_formated.$hccode.$list_id;
     $remark_string = @addslashes($common_remarks);
	 $total_file_content = @addslashes($contents);
	 $login_name = $_SESSION['userlogin'];
	$query = "insert into clist_master(CLISTID,ENTIRELIST,FROM_DATE,AFTER_DATE,LIST_REMARK,END_REMARKS,LOGIN_NAME,FILEPATH)VALUES('$clist_id','$total_file_content','$fromdate','$todate','$remark_string','$end_remarks','$login_name','$filepath')";
		 $result = mysql_query($query) or die(mysql_error());
	//////////////////// for multiple courts/////////////////	
	  if(isset($results['causelist']['date']['court'][0]))
		{
		  
            $court_count = count($results['causelist']['date']['court']);
			
			$file_content =file_get_contents('xmlcauselist.xml');
			
              $total_len = strlen($file_content);
		     for($i=0;$i<$court_count;$i++)
				{
				$court_no =@addslashes($results['causelist']['date']['court'][$i]['courtno']);
				   //echo $court_no;
				    $bench1 = @addslashes($results['causelist']['date']['court'][$i]['judge1']);
					$bench2 = @addslashes($results['causelist']['date']['court'][$i]['judge2']);
					$bench3 = @addslashes($results['causelist']['date']['court'][$i]['judge3']);
					$bench4 = @addslashes($results['causelist']['date']['court'][$i]['judge4']);
					$bench5 = @addslashes($results['causelist']['date']['court'][$i]['judge5']);
					$bench6 = @addslashes($results['causelist']['date']['court'][$i]['judge6']);
					$bench7 = @addslashes($results['causelist']['date']['court'][$i]['judge7']);
					$bench8 = @addslashes($results['causelist']['date']['court'][$i]['judge8']);
			  $court_remarks = @addslashes($results['causelist']['date']['court'][$i]['courtremarks']);
			  $court_no_find_pos = strpos($file_content,'<courtno>');
				$content_sub   = substr($file_content, $court_no_find_pos+9,$total_len);
				//if($i==1)
				//echo $file_content;

				if(strstr($content_sub,'<courtno>'))
				{
				 $court_no_find_pos_again = strpos($content_sub,'<courtno>')-10;
				 
				}
				else
				{
				$court_no_find_pos_again = strpos($content_sub,'</court>');
				//echo $court_no_find_pos_again;
				}

				$court_block = '<courtno>'.substr($content_sub,0,$court_no_find_pos_again);
				
				
				if(strstr($file_content,$court_block))
				{
				$file_content  = str_replace($court_block,"",$file_content);
				}
				
			    $court_block = @addslashes($court_block);

	  $detail_id = rand(0,1000).rand(0,100);
	$court_info_query="insert into     court_judge_detail(CLISTID,COURTNO,BENCH1,BENCH2,BENCH3,BENCH4,BENCH5,BENCH6,BENCH7,BENCH8,DETAILID,COURT_LIST,COURT_REMARKS)VALUES('$clist_id','$court_no','$bench1','$bench2','$bench3','$bench4','$bench5','$bench6','$bench7','$bench8','$detail_id','$court_block','$court_remarks')";
	$result = mysql_query($court_info_query)or die(mysql_error());

/////////////// for multi stages in the file/////////////////////////
      if(isset($results['causelist']['date']['court'][$i]['stage'][0]))
					{
		 
                        $stage_count = count($results['causelist']['date']['court'][$i]['stage']);
					   for($j=0;$j<$stage_count;$j++)
						{
						  $stage_remarks =@addslashes( $results['causelist']['date']['court'][$i]['stage'][$j]['stage_remarks']);
                         $stagename=@addslashes($results['causelist']['date']['court'][$i]['stage'][$j]['stagename']);
                        //echo $stagename.'<br>';
		////////////////////////////////// for multi casedetails in cases/////////////////////////

                        if(isset($results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails'][0]))
							{
                                $count_cases=count($results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails']);
                               for($z=0;$z<$count_cases;$z++)
								{

                                   $mcasetype =$results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails'][$z]['mcasetype'];
                                   $mcaseno =$results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails'][$z]['mcaseno'];
								   $mcaseyr =$results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails'][$z]['mcaseyr'];
								   $pname =$results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails'][$z]['pname'];
								   $rname =$results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails'][$z]['rname'];
								   $mpadv =$results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails'][$z]['mpadv'];
                                   $mradv =$results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails'][$z]['mradv'];
								   $serial_no = $results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails'][$z]['serial_no'];
								   $subname = @addslashes($results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails'][$z]['subname']);
								   $case_remarks = @addslashes($results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails'][$z]['case_remarks']);
								   $case_id = rand(0,10000000);
								   if(isset($pname))
								   $party_title = @addslashes($pname.' Vs.'.$rname);
								   else
									$party_title = NULL;
						            if(!isset($serial_no))
									{
                                      $serial_no = 0;
									}
								  
								   $advocate_names = @addslashes($mpadv.','.$mradv);

						$case_query = "insert into caseno_detail(CLISTID,DETAILID,CASEID,CASENO,CASEYEAR,CASETYPE,PARTY,  	ADVOCATE_NAME,CASE_REMARKS,STAGE,STAGE_REMARKS,SERIAL_NO,SUBNAME) values('$clist_id','$detail_id','$case_id',$mcaseno,$mcaseyr,'$mcasetype','$party_title','$advocate_names','$case_remarks','$stagename','$stage_remarks',$serial_no,'$subname')";
						mysql_query($case_query) or die(mysql_error());
								
                                if(isset($results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails'][$z]['extra'][0]))
									{
									 $count_extra = count($results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails'][$z]['extra']);
                                     for($x=0;$x<$count_extra;$x++)
										{
									$excaseid = rand(0,10000).rand(0,100000);
                                    if(is_array($results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails'][$z]['extra'][$x]['excasetype']))
										{
										
										$excasetype = "";
										
										}
										else
										{
                              $excasetype = $results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails'][$z]['extra'][$x]['excasetype'];
							  }
							  if(is_array($results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails'][$z]['extra'][$x]['excaseno']))
							  {
							  $excaseno ="";
							  
							  }
							  else
							  {
							  $excaseno =$results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails'][$z]['extra'][$x]['excaseno'];
							  }
							  if(is_array($results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails'][$z]['extra'][$x]['excaseyr']))
							  {
							  $excaseyr ="";
							  
							  }
							  else
							  {
                              $excaseyr = $results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails'][$z]['extra'][$x]['excaseyr'];
							  }
							  if(($excasetype !="")||($excaseno!="")||($excaseyr!=""))
							  {
                             $extracase_query = "insert into extracase_details(EXCASEID,CASEID,EXCASETYPE,EXCASENO  	,EXCASEYEAR,DETAILID,CLISTID)values($excaseid,$case_id,'$excasetype',$excaseno,$excaseyr,$detail_id,$clist_id)";
						         mysql_query($extracase_query) or die(mysql_error());
								 
								}
								 $excaseid = "";

										}

									}
									elseif(isset($results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails'][$z]['extra']))
									{
										  $excaseid = rand(0,10000).rand(0,100000);
										  if(is_array($results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails'][$z]['extra']['excasetype']))
										  {
										  $excasetype = "";
										  
										  }
										  else
										  {
                                          $excasetype = $results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails'][$z]['extra']['excasetype'];
										  }
										  if(is_array($results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails'][$z]['extra']['excaseno']))
										  {
										  $excaseno = "";
										  }
										  else
										  {
										  $excaseno = $results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails'][$z]['extra']['excaseno'];
										  }
										   if(is_array($results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails'][$z]['extra']['excaseyr']))
										   {
										      $excaseyr = "";
										   }
										   else
										   {
										  $excaseyr = $results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails'][$z]['extra']['excaseyr'];
										  }
										  if(($excasetype !="")||($excaseno!="")||($excaseyr!=""))
							      {
										 $extracase_query = "insert into extracase_details(EXCASEID,CASEID,EXCASETYPE,EXCASENO  	,EXCASEYEAR,DETAILID,CLISTID)values($excaseid,$case_id,'$excasetype','$excaseno','$excaseyr','$detail_id','$clist_id')";
						                  mysql_query($extracase_query) or die(mysql_error());
									}
										

									}


								}
								}
								////////////////////////////////// for single casedetails in cases///////////////
								elseif(isset($results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails']))
									{



								{

                                   $mcasetype =$results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails']['mcasetype'];
                                   $mcaseno =$results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails']['mcaseno'];
								   $mcaseyr =$results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails']['mcaseyr'];
								   $pname =$results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails']['pname'];
								   $rname =$results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails']['rname'];
								   $mpadv =$results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails']['mpadv'];
                                   $mradv =$results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails']['mradv'];
								   $serail_no = $results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails']['serail_no'];
								   $subname = @addslashes($results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails']['subname']);
								   if(isset($results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails']['case_remarks']))
								   {
								   $case_remarks = @addslashes($results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails']['case_remarks']);
								   }
								   $case_id = rand(0,10000000);
								   if(isset($pname))
								   $party_title = @addslashes($pname.' Vs.'.$rname);
								   else
									$party_title = NULL;
								   $advocate_names = @addslashes($mpadv.','.$mradv);

						$case_query = "insert into caseno_detail(CLISTID,DETAILID,CASEID,CASENO,CASEYEAR,CASETYPE,PARTY,  	ADVOCATE_NAME,CASE_REMARKS,STAGE,STAGE_REMARKS,SERIAL_NO,SUBNAME) values('$clist_id','$detail_id','$case_id',$mcaseno,$mcaseyr,'$mcasetype','$party_title','$advocate_names','$case_remarks','$stagename','$stage_remarks',$serail_no,'$subname')";
						mysql_query($case_query) or die(mysql_error());
								
                                if(isset($results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails']['extra'][0]))
									{
									 $count_extra = count($results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails']['extra']);
                                     for($x=0;$x<$count_extra;$x++)
										{
									$excaseid = rand(0,10000).rand(0,100000);
                                        if(is_array($results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails']['extra'][$x]['excasetype']))
										{
										 $excasetype = "";
										}
										else
										{
                              $excasetype = $results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails']['extra'][$x]['excasetype'];
							  }
							  if(is_array($results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails']['extra'][$x]['excaseno']))
							  {
							   $excaseno = "";
							  
							  }
							  else
							  {
							  $excaseno =$results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails']['extra'][$x]['excaseno'];
							  }
							  if(is_array($results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails']['extra'][$x]['excaseyr']))
							  {
							     $excaseyr = "";
							  
							  }
							  else
							  {
                              $excaseyr = $results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails']['extra'][$x]['excaseyr'];
							  }
							  if(($excasetype !="")||($excaseno!="")||($excaseyr!=""))
							      {
                             $extracase_query = "insert into extracase_details(EXCASEID,CASEID,EXCASETYPE,EXCASENO  	,EXCASEYEAR,DETAILID,CLISTID)values($excaseid,$case_id,'$excasetype',$excaseno,$excaseyr,$detail_id,$clist_id)";
						         mysql_query($extracase_query) or die(mysql_error());
								 $excaseid = "";
								 }

										}

									}
									elseif(isset($results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails']['extra']))
									{
										  $excaseid = rand(0,10000).rand(0,100000);
										  if(is_array($results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails']['extra']['excasetype']))
										  {
										  $excasetype = "";
										  }
										  else
										  {
                                          $excasetype = $results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails']['extra']['excasetype'];
										  }
										  if(is_array($results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails']['extra']['excaseno']))
										  {
											$excaseno="";
										  }
										  else
										  {
											$excaseno = $results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails']['extra']['excaseno'];
										  
										  }
										  if(is_array($results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails']['extra']['excaseyr']))
										  {
												$excaseyr="";
										  }
										  else
										  {
										  
										  
											$excaseyr = $results['causelist']['date']['court'][$i]['stage'][$j]['cases']['casedetails']['extra']['excaseyr'];
										  
										  }
									
										  if(($excasetype !="")||($excaseno!="")||($excaseyr!=""))
							      {
										 $extracase_query = "insert into extracase_details(EXCASEID,CASEID,EXCASETYPE,EXCASENO  	,EXCASEYEAR,DETAILID,CLISTID)values($excaseid,$case_id,'$excasetype','$excaseno','$excaseyr','$detail_id','$clist_id')";
						                  mysql_query($extracase_query) or die(mysql_error());
										  }
										

									}

                                       


							   

							}

						}

					}


                                                                   
	}
/////////////// for single stage only ////////////////////////
elseif(isset($results['causelist']['date']['court'][$i]['stage']))
	{
		                   if(isset($results['causelist']['date']['court'][$i]['stage'][$j]['stage_remarks']))
						   {
						  $stage_remarks =@addslashes( $results['causelist']['date']['court'][$i]['stage'][$j]['stage_remarks']);
						  }
                         $stagename=@addslashes($results['causelist']['date']['court'][$i]['stage'][$j]['stagename']);
                        //echo $stagename.'<br>';
                        if(isset($results['causelist']['date']['court'][$i]['stage']['cases']['casedetails'][0]))
							{
                                $count_cases=count($results['causelist']['date']['court'][$i]['stage']['cases']['casedetails']);
                               for($z=0;$z<$count_cases;$z++)
								{

                                   $mcasetype =$results['causelist']['date']['court'][$i]['stage']['cases']['casedetails'][$z]['mcasetype'];
                                   $mcaseno =$results['causelist']['date']['court'][$i]['stage']['cases']['casedetails'][$z]['mcaseno'];
								   $mcaseyr =$results['causelist']['date']['court'][$i]['stage']['cases']['casedetails'][$z]['mcaseyr'];
								   $pname =$results['causelist']['date']['court'][$i]['stage']['cases']['casedetails'][$z]['pname'];
								   $rname =$results['causelist']['date']['court'][$i]['stage']['cases']['casedetails'][$z]['rname'];
								   $mpadv =$results['causelist']['date']['court'][$i]['stage']['cases']['casedetails'][$z]['mpadv'];
                                   $mradv =$results['causelist']['date']['court'][$i]['stage']['cases']['casedetails'][$z]['mradv'];
								   $serial_no =$results['causelist']['date']['court'][$i]['stage']['cases']['casedetails'][$z]['serial_no'];
								   $subname=@addslashes($results['causelist']['date']['court'][$i]['stage']['cases']['casedetails'][$z]['serial_no']);
								   if(isset($results['causelist']['date']['court'][$i]['stage']['cases']['casedetails'][$z]['case_remarks']))
								   {
								   $case_remarks = @addslashes($results['causelist']['date']['court'][$i]['stage']['cases']['casedetails'][$z]['case_remarks']);
								   }
								   $case_id = rand(0,10000000);
								  if(isset($pname))
								   $party_title = @addslashes($pname.' Vs.'.$rname);
								   else
									$party_title = NULL;
								   $advocate_names = @addslashes($mpadv.','.$mradv);

						$case_query = "insert into caseno_detail(CLISTID,DETAILID,CASEID,CASENO,CASEYEAR,CASETYPE,PARTY,  	ADVOCATE_NAME,CASE_REMARKS,STAGE,STAGE_REMARKS,SERIAL_NO,SUBNAME) values('$clist_id','$detail_id','$case_id',$mcaseno,$mcaseyr,'$mcasetype','$party_title','$advocate_names','$case_remarks','$stagename','$stage_remarks',$serial_no,'$subname')";
						mysql_query($case_query) or die(mysql_error());
								
                                if(isset($results['causelist']['date']['court'][$i]['stage']['cases']['casedetails'][$z]['extra'][0]))
									{
									 $count_extra = count($results['causelist']['date']['court'][$i]['stage']['cases']['casedetails'][$z]['extra']);
                                     for($x=0;$x<$count_extra;$x++)
										{
									$excaseid = rand(0,10000).rand(0,100000);
                                        if(is_array($results['causelist']['date']['court'][$i]['stage']['cases']['casedetails'][$z]['extra'][$x]['excasetype']))
										  {
										  $excasetype = "";
										  }
										  else
										  {
                                          $excasetype = $results['causelist']['date']['court'][$i]['stage']['cases']['casedetails'][$z]['extra'][$x]['excasetype'];
										  }
										  if(is_array($results['causelist']['date']['court'][$i]['stage']['cases']['casedetails'][$z]['extra'][$x]['excaseno']))
										  {
											$excaseno="";
										  }
										  else
										  {
											$excaseno = $results['causelist']['date']['court'][$i]['stage']['cases']['casedetails'][$z]['extra'][$x]['excaseno'];
										  
										  }
										  if(is_array($results['causelist']['date']['court'][$i]['stage']['cases']['casedetails'][$z]['extra'][$x]['excaseyr']))
										  {
												$excaseyr="";
										  }
										  else
										  {
										  
										  
											$excaseyr = $results['causelist']['date']['court'][$i]['stage']['cases']['casedetails'][$z]['extra'][$x]['excaseyr'];
										  
										  }
                              if(($excasetype !="")||($excaseno!="")||($excaseyr!=""))
							      {
                             $extracase_query = "insert into extracase_details(EXCASEID,CASEID,EXCASETYPE,EXCASENO  	,EXCASEYEAR,DETAILID,CLISTID)values($excaseid,$case_id,'$excasetype',$excaseno,$excaseyr,$detail_id,$clist_id)";
						         mysql_query($extracase_query) or die(mysql_error());
								 $excaseid = "";
								 }

										}

									}
									elseif(isset($results['causelist']['date']['court'][$i]['stage']['cases']['casedetails'][$z]['extra']))
									{
										  $excaseid = rand(0,10000).rand(0,100000);
										  if(is_array($results['causelist']['date']['court'][$i]['stage']['cases']['casedetails'][$z]['extra']['excasetype']))
										  {
										  $excasetype = "";
										  }
										  else
										  {
                                          $excasetype = $results['causelist']['date']['court'][$i]['stage']['cases']['casedetails'][$z]['extra']['excasetype'];
										  }
										  if(is_array($results['causelist']['date']['court'][$i]['stage']['cases']['casedetails'][$z]['extra']['excaseno']))
										  {
											$excaseno="";
										  }
										  else
										  {
											$excaseno = $results['causelist']['date']['court'][$i]['stage']['cases']['casedetails'][$z]['extra']['excaseno'];
										  
										  }
										  if(is_array($results['causelist']['date']['court'][$i]['stage']['cases']['casedetails'][$z]['extra']['excaseyr']))
										  {
												$excaseyr="";
										  }
										  else
										  {
										  
										  
											$excaseyr = $results['causelist']['date']['court'][$i]['stage']['cases']['casedetails'][$z]['extra']['excaseyr'];
										  
										  }
                                          
										  if(($excasetype !="")||($excaseno!="")||($excaseyr!=""))
							      {
										 $extracase_query = "insert into extracase_details(EXCASEID,CASEID,EXCASETYPE,EXCASENO  	,EXCASEYEAR,DETAILID,CLISTID)values($excaseid,$case_id,'$excasetype','$excaseno','$excaseyr','$detail_id','$clist_id')";
						                  mysql_query($extracase_query) or die(mysql_error());
										 }

									}
								}


								}
								elseif(isset($results['causelist']['date']['court'][$i]['stage']['cases']['casedetails']))
									{



								{

                                   $mcasetype =$results['causelist']['date']['court'][$i]['stage']['cases']['casedetails']['mcasetype'];
                                   $mcaseno =$results['causelist']['date']['court'][$i]['stage']['cases']['casedetails']['mcaseno'];
								   $mcaseyr =$results['causelist']['date']['court'][$i]['stage']['cases']['casedetails']['mcaseyr'];
								   $pname =$results['causelist']['date']['court'][$i]['stage']['cases']['casedetails']['pname'];
								   $rname =$results['causelist']['date']['court'][$i]['stage']['cases']['casedetails']['rname'];
								   $mpadv =$results['causelist']['date']['court'][$i]['stage']['cases']['casedetails']['mpadv'];
                                   $mradv =$results['causelist']['date']['court'][$i]['stage']['cases']['casedetails']['mradv'];
								   $serial_no =$results['causelist']['date']['court'][$i]['stage']['cases']['casedetails']['serail_no'];
								   $subname = @addslashes($results['causelist']['date']['court'][$i]['stage']['cases']['casedetails']['subname']);
								   if(isset($results['causelist']['date']['court'][$i]['stage']['cases']['casedetails']['case_remarks']))
								   {
								   $case_remarks = @addslashes($results['causelist']['date']['court'][$i]['stage']['cases']['casedetails']['case_remarks']);
								   }
								   $case_id = rand(0,10000000);
								   if(isset($pname))
								   $party_title = @addslashes($pname.' Vs.'.$rname);
								   else
									$party_title = NULL;
								   $advocate_names = @addslashes($mpadv.','.$mradv);

						$case_query = "insert into caseno_detail(CLISTID,DETAILID,CASEID,CASENO,CASEYEAR,CASETYPE,PARTY,  	ADVOCATE_NAME,CASE_REMARKS,STAGE,STAGE_REMARKS,SERIAL_NO,SUBNAME) values('$clist_id','$detail_id','$case_id',$mcaseno,$mcaseyr,'$mcasetype','$party_title','$advocate_names','$case_remarks','$stagename','$stage_remarks',$serial_no,'$subname')";
						mysql_query($case_query) or die(mysql_error());
								
                                if(isset($results['causelist']['date']['court'][$i]['stage']['cases']['casedetails']['extra'][0]))
									{
									 $count_extra = count($results['causelist']['date']['court'][$i]['stage']['cases']['casedetails']['extra']);
                                     for($x=0;$x<$count_extra;$x++)
										{
									$excaseid = rand(0,10000).rand(0,100000);
                                        if(is_array($results['causelist']['date']['court'][$i]['stage']['cases']['casedetails']['extra'][$x]['excasetype']))
										  {
										  $excasetype = "";
										  }
										  else
										  {
                                          $excasetype = $results['causelist']['date']['court'][$i]['stage']['cases']['casedetails']['extra'][$x]['excasetype'];
										  }
										  if(is_array($results['causelist']['date']['court'][$i]['stage']['cases']['casedetails']['extra'][$x]['excaseno']))
										  {
											$excaseno="";
										  }
										  else
										  {
											$excaseno = $results['causelist']['date']['court'][$i]['stage']['cases']['casedetails']['extra'][$x]['excaseno'];
										  
										  }
										  if(is_array($results['causelist']['date']['court'][$i]['stage']['cases']['casedetails']['extra'][$x]['excaseyr']))
										  {
												$excaseyr="";
										  }
										  else
										  {
										  
										  
											$excaseyr = $results['causelist']['date']['court'][$i]['stage']['cases']['casedetails']['extra'][$x]['excaseyr'];
										  
										  }
                              if(($excasetype !="")||($excaseno!="")||($excaseyr!=""))
							      {
                             $extracase_query = "insert into extracase_details(EXCASEID,CASEID,EXCASETYPE,EXCASENO  	,EXCASEYEAR,DETAILID,CLISTID)values($excaseid,$case_id,'$excasetype',$excaseno,$excaseyr,$detail_id,$clist_id)";
						         mysql_query($extracase_query) or die(mysql_error());
								 $excaseid = "";
								 }

										}

									}
									elseif(isset($results['causelist']['date']['court'][$i]['stage']['cases']['casedetails']['extra']))
									{
										  $excaseid = rand(0,10000).rand(0,100000);
										  if(is_array($results['causelist']['date']['court'][$i]['stage']['cases']['casedetails']['extra']['excasetype']))
										  {
										  $excasetype = "";
										  }
										  else
										  {
                                          $excasetype = $results['causelist']['date']['court'][$i]['stage']['cases']['casedetails']['extra']['excasetype'];
										  }
										  if(is_array($results['causelist']['date']['court'][$i]['stage']['cases']['casedetails']['extra']['excaseno']))
										  {
											$excaseno="";
										  }
										  else
										  {
											$excaseno = $results['causelist']['date']['court'][$i]['stage']['cases']['casedetails']['extra']['excaseno'];
										  
										  }
										  if(is_array($results['causelist']['date']['court'][$i]['stage']['cases']['casedetails']['extra']['excaseyr']))
										  {
												$excaseyr="";
										  }
										  else
										  {
										  
										  
											$excaseyr = $results['causelist']['date']['court'][$i]['stage']['cases']['casedetails']['extra']['excaseyr'];
										  
										  }
                              if(($excasetype !="")||($excaseno!="")||($excaseyr!=""))
							      {
                             

										 $extracase_query = "insert into extracase_details(EXCASEID,CASEID,EXCASETYPE,EXCASENO  	,EXCASEYEAR,DETAILID,CLISTID)values($excaseid,$case_id,'$excasetype','$excaseno','$excaseyr','$detail_id','$clist_id')";
						                  mysql_query($extracase_query) or die(mysql_error());
										  }
										

									}

                                       


							   

							}

						}

                                                                   
	}

				
			}

				

		}
//////////////////// for single court only ////////////
elseif(isset($results['causelist']['date']['court']))
	{
		   
			$file_content =file_get_contents($_FILES["xmlcauselist"]["name"]);
			
              $total_len = strlen($file_content);
		     
			
				$court_no = @addslashes($results['causelist']['date']['court']['courtno']);
				   //echo $court_no;
				    $bench1 = @addslashes($results['causelist']['date']['court']['judge1']);
					$bench2 = @addslashes($results['causelist']['date']['court']['judge2']);
					$bench3 = @addslashes($results['causelist']['date']['court']['judge3']);
					$bench4 = @addslashes($results['causelist']['date']['court']['judge4']);
					$bench5 = @addslashes($results['causelist']['date']['court']['judge5']);
					$bench6 = @addslashes($results['causelist']['date']['court']['judge6']);
					$bench7 = @addslashes($results['causelist']['date']['court']['judge7']);
					$bench8 = @addslashes($results['causelist']['date']['court']['judge8']);
					if(isset($results['causelist']['date']['court']['courtremarks']))
					{
			          $court_remarks = @addslashes($results['causelist']['date']['court']['courtremarks']);
			         }
			  $court_no_find_pos = strpos($file_content,'<courtno>');
				$content_sub   = substr($file_content, $court_no_find_pos+9,$total_len);
				//if($i==1)
				//echo $file_content;

				if(strstr($content_sub,'<courtno>'))
				{
				 $court_no_find_pos_again = strpos($content_sub,'<courtno>')-10;
				 
				}
				else
				{
				$court_no_find_pos_again = strpos($content_sub,'</court>');
				//echo $court_no_find_pos_again;
				}

				$court_block = '<courtno>'.substr($content_sub,0,$court_no_find_pos_again);
				
				
				if(strstr($file_content,$court_block))
				{
				$file_content  = str_replace($court_block,"",$file_content);
				}
				
			    $court_block = @addslashes($court_block);

	  $detail_id = rand(0,1000).rand(0,100);
	$court_info_query="insert into     court_judge_detail(CLISTID,COURTNO,BENCH1,BENCH2,BENCH3,BENCH4,BENCH5,BENCH6,BENCH7,BENCH8,DETAILID,COURT_LIST,COURT_REMARKS)VALUES('$clist_id','$court_no','$bench1','$bench2','$bench3','$bench4','$bench5','$bench6','$bench7','$bench8','$detail_id','$court_block','$court_remarks')";
	$result = mysql_query($court_info_query)or die(mysql_error());

      if(isset($results['causelist']['date']['court']['stage'][0]))
					{
		 
                        $stage_count = count($results['causelist']['date']['court']['stage']);
					   for($j=0;$j<$stage_count;$j++)
						{
						  if(isset($results['causelist']['date']['court']['stage'][$j]['stage_remarks']))
						  {
						  $stage_remarks =@addslashes( $results['causelist']['date']['court']['stage'][$j]['stage_remarks']);
						  }
                         $stagename=@addslashes($results['causelist']['date']['court']['stage'][$j]['stagename']);
                        //echo $stagename.'<br>';
                        if(isset($results['causelist']['date']['court']['stage'][$j]['cases']['casedetails'][0]))
							{
                                $count_cases=count($results['causelist']['date']['court']['stage'][$j]['cases']['casedetails']);
                               for($z=0;$z<$count_cases;$z++)
								{

                                   $mcasetype =$results['causelist']['date']['court']['stage'][$j]['cases']['casedetails'][$z]['mcasetype'];
                                   $mcaseno =$results['causelist']['date']['court']['stage'][$j]['cases']['casedetails'][$z]['mcaseno'];
								   $mcaseyr =$results['causelist']['date']['court']['stage'][$j]['cases']['casedetails'][$z]['mcaseyr'];
								   $pname =$results['causelist']['date']['court']['stage'][$j]['cases']['casedetails'][$z]['pname'];
								   $rname =$results['causelist']['date']['court']['stage'][$j]['cases']['casedetails'][$z]['rname'];
								   $mpadv =$results['causelist']['date']['court']['stage'][$j]['cases']['casedetails'][$z]['mpadv'];
                                   $mradv =$results['causelist']['date']['court']['stage'][$j]['cases']['casedetails'][$z]['mradv'];
								   $serial_no =$results['causelist']['date']['court']['stage'][$j]['cases']['casedetails'][$z]['serial_no'];
								   $subname =@addslashes($results['causelist']['date']['court']['stage'][$j]['cases']['casedetails'][$z]['subname']);
                                    if(isset($results['causelist']['date']['court']['stage'][$j]['cases']['casedetails'][$z]['case_remarks']))
									{
								   $case_remarks = @addslashes($results['causelist']['date']['court']['stage'][$j]['cases']['casedetails'][$z]['case_remarks']);
								   }
								   $case_id = rand(0,10000000);
								  if(isset($pname))
								   $party_title = @addslashes($pname.' Vs.'.$rname);
								   else
									$party_title = NULL;
								   $advocate_names = @addslashes($mpadv.','.$mradv);

						$case_query = "insert into caseno_detail(CLISTID,DETAILID,CASEID,CASENO,CASEYEAR,CASETYPE,PARTY,  	ADVOCATE_NAME,CASE_REMARKS,STAGE,STAGE_REMARKS,SERIAL_NO,SUBNAME) values('$clist_id','$detail_id','$case_id',$mcaseno,$mcaseyr,'$mcasetype','$party_title','$advocate_names','$case_remarks','$stagename','$stage_remarks',$serial_no,'$subname')";
						mysql_query($case_query) or die(mysql_error());
								
                                if(isset($results['causelist']['date']['court']['stage'][$j]['cases']['casedetails'][$z]['extra'][0]))
									{
									
									 $count_extra = count($results['causelist']['date']['court']['stage'][$j]['cases']['casedetails'][$z]['extra']);
                                     for($x=0;$x<$count_extra;$x++)
										{
									$excaseid = rand(0,10000).rand(0,100000);
                                        if(is_array($results['causelist']['date']['court']['stage'][$j]['cases']['casedetails'][$z]['extra'][$x]['excasetype']))
										  {
										  $excasetype = "";
										  }
										  else
										  {
                                          $excasetype = $results['causelist']['date']['court']['stage'][$j]['cases']['casedetails'][$z]['extra'][$x]['excasetype'];
										  }
										  if(is_array($results['causelist']['date']['court']['stage'][$j]['cases']['casedetails'][$z]['extra'][$x]['excaseno']))
										  {
											$excaseno="";
										  }
										  else
										  {
											$excaseno = $results['causelist']['date']['court']['stage'][$j]['cases']['casedetails'][$z]['extra'][$x]['excaseno'];
										  
										  }
										  if(is_array($results['causelist']['date']['court']['stage'][$j]['cases']['casedetails'][$z]['extra'][$x]['excaseyr']))
										  {
												$excaseyr="";
										  }
										  else
										  {
										  
										  
											$excaseyr = $results['causelist']['date']['court']['stage'][$j]['cases']['casedetails'][$z]['extra'][$x]['excaseyr'];
										  
										  }
										  if(($excasetype !="")||($excaseno!="")||($excaseyr!=""))
							      {
                             
                              
                             $extracase_query = "insert into extracase_details(EXCASEID,CASEID,EXCASETYPE,EXCASENO  	,EXCASEYEAR,DETAILID,CLISTID)values($excaseid,$case_id,'$excasetype',$excaseno,$excaseyr,$detail_id,$clist_id)";
						         mysql_query($extracase_query) or die(mysql_error());
								 $excaseid = "";
								 }

										}

									}
									elseif(isset($results['causelist']['date']['court']['stage'][$j]['cases']['casedetails'][$z]['extra']))
									{
										  $excaseid = rand(0,10000).rand(0,100000);
										  if( is_array($results['causelist']['date']['court']['stage'][$j]['cases']['casedetails'][$z]['extra']['excasetype']))
										  {
										  $excasetype = "";
										  }
										  else
										  {
                                          $excasetype =  $results['causelist']['date']['court']['stage'][$j]['cases']['casedetails'][$z]['extra']['excasetype'];
										  }
										  if(is_array($results['causelist']['date']['court']['stage'][$j]['cases']['casedetails'][$z]['extra']['excaseno']))
										  {
											$excaseno="";
										  }
										  else
										  {
											$excaseno = $results['causelist']['date']['court']['stage'][$j]['cases']['casedetails'][$z]['extra']['excaseno'];
										  
										  }
										  if(is_array($results['causelist']['date']['court']['stage'][$j]['cases']['casedetails'][$z]['extra']['excaseyr']))
										  {
												$excaseyr="";
										  }
										  else
										  {
										  
										  
											$excaseyr = $results['causelist']['date']['court']['stage'][$j]['cases']['casedetails'][$z]['extra']['excaseyr'];
										  
										  }
                                          if(($excasetype !="")||($excaseno!="")||($excaseyr!=""))
							      {
                             
										 $extracase_query = "insert into extracase_details(EXCASEID,CASEID,EXCASETYPE,EXCASENO  	,EXCASEYEAR,DETAILID,CLISTID)values($excaseid,$case_id,'$excasetype','$excaseno','$excaseyr','$detail_id','$clist_id')";
						                  mysql_query($extracase_query) or die(mysql_error());
										
										}

									}


								}
								}
								elseif(isset($results['causelist']['date']['court']['stage'][$j]['cases']['casedetails']))
									{



								{

                                   $mcasetype =$results['causelist']['date']['court']['stage'][$j]['cases']['casedetails']['mcasetype'];
                                   $mcaseno =$results['causelist']['date']['court']['stage'][$j]['cases']['casedetails']['mcaseno'];
								   $mcaseyr =$results['causelist']['date']['court']['stage'][$j]['cases']['casedetails']['mcaseyr'];
								   $pname =$results['causelist']['date']['court']['stage'][$j]['cases']['casedetails']['pname'];
								   $rname =$results['causelist']['date']['court']['stage'][$j]['cases']['casedetails']['rname'];
								   $mpadv =$results['causelist']['date']['court']['stage'][$j]['cases']['casedetails']['mpadv'];
                                   $mradv =$results['causelist']['date']['court']['stage'][$j]['cases']['casedetails']['mradv'];
								   $serial_no =$results['causelist']['date']['court']['stage'][$j]['cases']['casedetails']['serial_no'];
								   $subname =@addslashes($results['causelist']['date']['court']['stage'][$j]['cases']['casedetails']['subname']);
								   if(isset($results['causelist']['date']['court']['stage'][$j]['cases']['casedetails']['case_remarks']))
								   {
								   $case_remarks = @addslashes($results['causelist']['date']['court']['stage'][$j]['cases']['casedetails']['case_remarks']);
								   }
								   $case_id = rand(0,10000000);
								  if(isset($pname))
								   $party_title = @addslashes($pname.' Vs.'.$rname);
								   else
									$party_title = NULL;
								   $advocate_names = @addslashes($mpadv.','.$mradv);

						$case_query = "insert into caseno_detail(CLISTID,DETAILID,CASEID,CASENO,CASEYEAR,CASETYPE,PARTY,  	ADVOCATE_NAME,CASE_REMARKS,STAGE,STAGE_REMARKS,SERIAL_NO,SUBNAME) values('$clist_id','$detail_id','$case_id',$mcaseno,$mcaseyr,'$mcasetype','$party_title','$advocate_names','$case_remarks','$stagename','$stage_remarks',$serial_no,'$subname')";
						mysql_query($case_query) or die(mysql_error());
								
                                if(isset($results['causelist']['date']['court']['stage'][$j]['cases']['casedetails']['extra'][0]))
									{
									 $count_extra = count($results['causelist']['date']['court']['stage'][$j]['cases']['casedetails']['extra']);
                                     for($x=0;$x<$count_extra;$x++)
										{
									$excaseid = rand(0,10000).rand(0,100000);
                                        if( is_array($results['causelist']['date']['court']['stage'][$j]['cases']['casedetails']['extra'][$x]['excasetype']))
										  {
										  $excasetype = "";
										  }
										  else
										  {
                                          $excasetype =  $results['causelist']['date']['court']['stage'][$j]['cases']['casedetails']['extra'][$x]['excasetype'];
										  }
										  if(is_array($results['causelist']['date']['court']['stage'][$j]['cases']['casedetails']['extra'][$x]['excaseno']))
										  {
											$excaseno="";
										  }
										  else
										  {
											$excaseno = $results['causelist']['date']['court']['stage'][$j]['cases']['casedetails']['extra'][$x]['excaseno'];
										  
										  }
										  if(is_array($results['causelist']['date']['court']['stage'][$j]['cases']['casedetails']['extra'][$x]['excaseyr']))
										  {
												$excaseyr="";
										  }
										  else
										  {
										  
										  
											$excaseyr = $results['causelist']['date']['court']['stage'][$j]['cases']['casedetails']['extra'][$x]['excaseyr'];
										  
										  }
                                          if(($excasetype !="")||($excaseno!="")||($excaseyr!=""))
							      {
                              
                             $extracase_query = "insert into extracase_details(EXCASEID,CASEID,EXCASETYPE,EXCASENO  	,EXCASEYEAR,DETAILID,CLISTID)values($excaseid,$case_id,'$excasetype',$excaseno,$excaseyr,$detail_id,$clist_id)";
						         mysql_query($extracase_query) or die(mysql_error());
								 $excaseid = "";
								 }

										}

									}
									elseif(isset($results['causelist']['date']['court']['stage'][$j]['cases']['casedetails']['extra']))
									{
										  $excaseid = rand(0,10000).rand(0,100000);
										  if( is_array($results['causelist']['date']['court']['stage'][$j]['cases']['casedetails']['extra']['excasetype']))
										  {
										  $excasetype = "";
										  }
										  else
										  {
                                          $excasetype =  $results['causelist']['date']['court']['stage'][$j]['cases']['casedetails']['extra']['excasetype'];
										  }
										  if(is_array($results['causelist']['date']['court']['stage'][$j]['cases']['casedetails']['extra']['excaseno']))
										  {
											$excaseno="";
										  }
										  else
										  {
											$excaseno = $results['causelist']['date']['court']['stage'][$j]['cases']['casedetails']['extra']['excaseno'];
										  
										  }
										  if(is_array($results['causelist']['date']['court']['stage'][$j]['cases']['casedetails']['extra']['excaseyr']))
										  {
												$excaseyr="";
										  }
										  else
										  {
										  
										  
											$excaseyr = $results['causelist']['date']['court']['stage'][$j]['cases']['casedetails']['extra']['excaseyr'];
										  
										  }
                                          if(($excasetype !="")||($excaseno!="")||($excaseyr!=""))
							      {
                              
                                         
										  
										 $extracase_query = "insert into extracase_details(EXCASEID,CASEID,EXCASETYPE,EXCASENO  	,EXCASEYEAR,DETAILID,CLISTID)values($excaseid,$case_id,'$excasetype','$excaseno','$excaseyr','$detail_id','$clist_id')";
						                  mysql_query($extracase_query) or die(mysql_error());
									}
										

									}

                                       


							   

							}

						}

					}


                                                                   
	}
/////////////// for single stage only ////////////////////////
elseif(isset($results['causelist']['date']['court']['stage']))
	{
		                 if(isset($results['causelist']['date']['court']['stage']['stage_remarks']))
						 {
						  $stage_remarks =@addslashes( $results['causelist']['date']['court']['stage']['stage_remarks']);
						  }
                         $stagename=@addslashes($results['causelist']['date']['court']['stage']['stagename']);
                        //echo $stagename.'<br>';
                        if(isset($results['causelist']['date']['court']['stage']['cases']['casedetails'][0]))
							{
                                $count_cases=count($results['causelist']['date']['court']['stage']['cases']['casedetails']);
                               for($z=0;$z<$count_cases;$z++)
								{

                                   $mcasetype =$results['causelist']['date']['court']['stage']['cases']['casedetails'][$z]['mcasetype'];
                                   $mcaseno =$results['causelist']['date']['court']['stage']['cases']['casedetails'][$z]['mcaseno'];
								   $mcaseyr =$results['causelist']['date']['court']['stage']['cases']['casedetails'][$z]['mcaseyr'];
								   $pname =$results['causelist']['date']['court']['stage']['cases']['casedetails'][$z]['pname'];
								   $rname =$results['causelist']['date']['court']['stage']['cases']['casedetails'][$z]['rname'];
								   $mpadv =$results['causelist']['date']['court']['stage']['cases']['casedetails'][$z]['mpadv'];
                                   $mradv =$results['causelist']['date']['court']['stage']['cases']['casedetails'][$z]['mradv'];
								   $serial_no =$results['causelist']['date']['court']['stage']['cases']['casedetails'][$z]['serial_no'];
								   $subname =@addslashes($results['causelist']['date']['court']['stage']['cases']['casedetails'][$z]['subname']);
								   if(isset($results['causelist']['date']['court']['stage']['cases']['casedetails'][$z]['case_remarks']))
								   {
								   $case_remarks = @addslashes($results['causelist']['date']['court']['stage']['cases']['casedetails'][$z]['case_remarks']);
								   }
								   
								   $case_id = rand(0,10000000);
								   if(isset($pname))
								   $party_title = @addslashes($pname.' Vs.'.$rname);
								   else
									$party_title = NULL;
								   $advocate_names = @addslashes($mpadv.','.$mradv);

						$case_query = "insert into caseno_detail(CLISTID,DETAILID,CASEID,CASENO,CASEYEAR,CASETYPE,PARTY,  	ADVOCATE_NAME,CASE_REMARKS,STAGE,STAGE_REMARKS,SERIAL_NO,SUBNAME) values('$clist_id','$detail_id','$case_id',$mcaseno,$mcaseyr,'$mcasetype','$party_title','$advocate_names','$case_remarks','$stagename','$stage_remarks',$serial_no,'$subname')";
						mysql_query($case_query) or die(mysql_error());
								
                                if(isset($results['causelist']['date']['court']['stage']['cases']['casedetails'][$z]['extra'][0]))
									{
									 $count_extra = count($results['causelist']['date']['court']['stage']['cases']['casedetails'][$z]['extra']);
                                     for($x=0;$x<$count_extra;$x++)
										{
									$excaseid = rand(0,10000).rand(0,100000);
                                        if( is_array($results['causelist']['date']['court']['stage']['cases']['casedetails'][$z]['extra'][$x]['excasetype']))
										  {
										  $excasetype = "";
										  }
										  else
										  {
                                          $excasetype =  $results['causelist']['date']['court']['stage']['cases']['casedetails'][$z]['extra'][$x]['excasetype'];
										  }
										  if(is_array($results['causelist']['date']['court']['stage']['cases']['casedetails'][$z]['extra'][$x]['excaseno']))
										  {
											$excaseno="";
										  }
										  else
										  {
											$excaseno = $results['causelist']['date']['court']['stage']['cases']['casedetails'][$z]['extra'][$x]['excaseno'];
										  
										  }
										  if(is_array($results['causelist']['date']['court']['stage']['cases']['casedetails'][$z]['extra'][$x]['excaseyr']))
										  {
												$excaseyr="";
										  }
										  else
										  {
										  
										  
											$excaseyr = $results['causelist']['date']['court']['stage']['cases']['casedetails'][$z]['extra'][$x]['excaseyr'];
										  
										  }
                                          if(($excasetype !="")||($excaseno!="")||($excaseyr!=""))
							      {
                              
                              
                             $extracase_query = "insert into extracase_details(EXCASEID,CASEID,EXCASETYPE,EXCASENO  	,EXCASEYEAR,DETAILID,CLISTID)values($excaseid,$case_id,'$excasetype',$excaseno,$excaseyr,$detail_id,$clist_id)";
						         mysql_query($extracase_query) or die(mysql_error());
								 $excaseid = "";
											}
										}

									}
									elseif(isset($results['causelist']['date']['court']['stage']['cases']['casedetails'][$z]['extra']))
									{
										  $excaseid = rand(0,10000).rand(0,100000);
										  if( is_array($results['causelist']['date']['court']['stage']['cases']['casedetails'][$z]['extra']['excasetype']))
										  {
										  $excasetype = "";
										  }
										  else
										  {
                                          $excasetype =  $results['causelist']['date']['court']['stage']['cases']['casedetails'][$z]['extra']['excasetype'];
										  }
										  if(is_array($results['causelist']['date']['court']['stage']['cases']['casedetails'][$z]['extra']['excaseno']))
										  {
											$excaseno="";
										  }
										  else
										  {
											$excaseno = $results['causelist']['date']['court']['stage']['cases']['casedetails'][$z]['extra']['excaseno'];
										  
										  }
										  if(is_array($results['causelist']['date']['court']['stage']['cases']['casedetails'][$z]['extra']['excaseyr']))
										  {
												$excaseyr="";
										  }
										  else
										  {
										  
										  
											$excaseyr = $results['causelist']['date']['court']['stage']['cases']['casedetails'][$z]['extra']['excaseyr'];
										  
										  }
                                          if(($excasetype !="")||($excaseno!="")||($excaseyr!=""))
							      {
                              
                                          
										  
										 $extracase_query = "insert into extracase_details(EXCASEID,CASEID,EXCASETYPE,EXCASENO  	,EXCASEYEAR,DETAILID,CLISTID)values($excaseid,$case_id,'$excasetype','$excaseno','$excaseyr','$detail_id','$clist_id')";
						                  mysql_query($extracase_query) or die(mysql_error());
										
										}
									}
								}


								}
								elseif(isset($results['causelist']['date']['court']['stage']['cases']['casedetails']))
									{



								{

                                   $mcasetype =$results['causelist']['date']['court']['stage']['cases']['casedetails']['mcasetype'];
                                   $mcaseno =$results['causelist']['date']['court']['stage']['cases']['casedetails']['mcaseno'];
								   $mcaseyr =$results['causelist']['date']['court']['stage']['cases']['casedetails']['mcaseyr'];
								   $pname =$results['causelist']['date']['court']['stage']['cases']['casedetails']['pname'];
								   $rname =$results['causelist']['date']['court']['stage']['cases']['casedetails']['rname'];
								   $mpadv =$results['causelist']['date']['court']['stage']['cases']['casedetails']['mpadv'];
                                   $mradv =$results['causelist']['date']['court']['stage']['cases']['casedetails']['mradv'];
								   $serial_no =$results['causelist']['date']['court']['stage']['cases']['casedetails']['serial_no'];
								   $subname=@addslashes($results['causelist']['date']['court']['stage']['cases']['casedetails']['subname']);
								   if(isset($results['causelist']['date']['court']['stage']['cases']['casedetails']['case_remarks']))
								   {
								   $case_remarks = @addslashes($results['causelist']['date']['court']['stage']['cases']['casedetails']['case_remarks']);
								   }
								   $case_id = rand(0,10000000);
								  if(isset($pname))
								   $party_title = @addslashes($pname.' Vs.'.$rname);
								   else
									$party_title = NULL;
								   $advocate_names = @addslashes($mpadv.','.$mradv);

						$case_query = "insert into caseno_detail(CLISTID,DETAILID,CASEID,CASENO,CASEYEAR,CASETYPE,PARTY,  	ADVOCATE_NAME,CASE_REMARKS,STAGE,STAGE_REMARKS,SERIAL_NO,SUBNAME) values('$clist_id','$detail_id','$case_id',$mcaseno,$mcaseyr,'$mcasetype','$party_title','$advocate_names','$case_remarks','$stagename','$stage_remarks',$serial_no,'$subname')";
						mysql_query($case_query) or die(mysql_error());
								
                                if(isset($results['causelist']['date']['court']['stage']['cases']['casedetails']['extra'][0]))
									{
									 $count_extra = count($results['causelist']['date']['court']['stage']['cases']['casedetails']['extra']);
                                     for($x=0;$x<$count_extra;$x++)
										{
									$excaseid = rand(0,10000).rand(0,100000);
                                        if( is_array($results['causelist']['date']['court']['stage']['cases']['casedetails']['extra'][$x]['excasetype']))
										  {
										  $excasetype = "";
										  }
										  else
										  {
                                          $excasetype =  $results['causelist']['date']['court']['stage']['cases']['casedetails']['extra'][$x]['excasetype'];
										  }
										  if(is_array($results['causelist']['date']['court']['stage']['cases']['casedetails']['extra'][$x]['excaseno']))
										  {
											$excaseno="";
										  }
										  else
										  {
											$excaseno = $results['causelist']['date']['court']['stage']['cases']['casedetails']['extra'][$x]['excaseno'];
										  
										  }
										  if(is_array($results['causelist']['date']['court']['stage']['cases']['casedetails']['extra'][$x]['excaseyr']))
										  {
												$excaseyr="";
										  }
										  else
										  {
										  
										  
											$excaseyr = $results['causelist']['date']['court']['stage']['cases']['casedetails']['extra'][$x]['excaseyr'];
										  
										  }
                                          if(($excasetype !="")||($excaseno!="")||($excaseyr!=""))
							      {
                               
                             $extracase_query = "insert into extracase_details(EXCASEID,CASEID,EXCASETYPE,EXCASENO  	,EXCASEYEAR,DETAILID,CLISTID)values($excaseid,$case_id,'$excasetype',$excaseno,$excaseyr,$detail_id,$clist_id)";
						         mysql_query($extracase_query) or die(mysql_error());
								 $excaseid = "";
								 }

										}

									}
									elseif(isset($results['causelist']['date']['court']['stage']['cases']['casedetails']['extra']))
									{
										  $excaseid = rand(0,10000).rand(0,100000);
										  if( is_array($results['causelist']['date']['court']['stage']['cases']['casedetails']['extra']['excasetype']))
										  {
										  $excasetype = "";
										  }
										  else
										  {
                                          $excasetype =  $results['causelist']['date']['court']['stage']['cases']['casedetails']['extra']['excasetype'];
										  }
										  if(is_array($results['causelist']['date']['court']['stage']['cases']['casedetails']['extra']['excaseno']))
										  {
											$excaseno="";
										  }
										  else
										  {
											$excaseno = $results['causelist']['date']['court']['stage']['cases']['casedetails']['extra']['excaseno'];
										  
										  }
										  if(is_array($results['causelist']['date']['court']['stage']['cases']['casedetails']['extra']['excaseyr']))
										  {
												$excaseyr="";
										  }
										  else
										  {
										  
										  
											$excaseyr = $results['causelist']['date']['court']['stage']['cases']['casedetails']['extra']['excaseyr'];
										  
										  }
                                          if(($excasetype !="")||($excaseno!="")||($excaseyr!=""))
							      {
                               
										  
										 $extracase_query = "insert into extracase_details(EXCASEID,CASEID,EXCASETYPE,EXCASENO  	,EXCASEYEAR,DETAILID,CLISTID)values($excaseid,$case_id,'$excasetype','$excaseno','$excaseyr','$detail_id','$clist_id')";
						                  mysql_query($extracase_query) or die(mysql_error());
										  }
										

									}

                                       


							   

							}

						}

					


                                                                   
	}



		}



	}	
		
 }
}

else
		{
echo "Unable to open the file";
		}

		$_SESSION['success'] = 'active';
header("location:login_success.php?success=yes");	

}

	}
 
}
else
{
header("location:index.php");
exit;

}
}
else
{
header("location:index.php");
exit;

}
?> 