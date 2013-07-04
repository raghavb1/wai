<?php 
$GoogleContactsEmail            = 'raghavb1@gmail.com'; 
$GoogleContactsPass             = 'pink$#32dollar'; 
/* 
$googleUri = Zend_Gdata_AuthSub::getAuthSubTokenUri('http://'.$_SERVER['SERVER_NAME'].$_ SERVER['REQUEST_URI'],urlencode($scope), 
0, 1); 
echo "Click <a href='$googleUri'>here</a> to authorize this application."; 
*/ 
function GoogleContactsAuth($extLibPath,$GoogleContactsEmail,$GoogleContactsPass){ 
        ini_set('include_path', $extLibPath); 
        include_once('Zend/Loader.php'); 
        Zend_Loader::registerAutoload(); 
        $GoogleContactsService  = 'cp'; 
        $GoogleContactsClient   = 
Zend_Gdata_ClientLogin::getHttpClient($GoogleContactsEmail, 
$GoogleContactsPass, $GoogleContactsService); 
        return $GoogleContactsClient; 
} 

function GoogleContactsAll($GoogleContactsClient,$GoogleContactsEmail){ 
        $scope          = "http://www.google.com/m8/feeds/contacts/".$GoogleContactsEmail."/"; 
        $gdata          = new Zend_Gdata($GoogleContactsClient); 
        $query          = new Zend_Gdata_Query($scope.'full'); 
        $query->setMaxResults(10000); 
        $feed           = $gdata->retrieveAllEntriesForFeed($gdata->getFeed($query)); 
        foreach ($feed as $entry){ 
                $contactName = $entry->title->text; 
                $ext = $entry->getExtensionElements(); 
                foreach($ext as $extension){ 
                        if($extension->rootElement == "email"){ 
                                $attr=$extension->getExtensionAttributes(); 
                                $contactMail = $attr['address']['value']; 
                        }else if($extension->rootElement == "phoneNumber"){ 
                                $contactPhone = $extension->text; 
                        }else if($extension->rootElement == "postalAddress"){ 
                                $contactAddr = $extension->text; 
                        }else if($extension->rootElement == "groupMembershipInfo"){ 
                                $UrlGroup       = $extension->extensionAttributes['href']['value']; 
                                $arrGroupEx     = explode("/",$UrlGroup); 
                                $contactGrp     = $arrGroupEx[(count($arrGroupEx)-1)]; 
                        }else if($extension->rootElement == "organization"){ 
                                $attr=$extension->getExtensionElements(); 
                                if($attr[0]->rootElement == "orgName"){ 
                                        $contactJob = $attr[0]->text; 
                                } 
                                if($attr[1]->rootElement == "orgTitle"){ 
                                        $contactPos = $attr[1]->text; 
                                } 
                        } 
                        if($contactName==""){ 
                                $contactName = $contactMail; 
                        } 
                } 
                $arrContactsData['contactMail']         = $contactMail; 
                $arrContactsData['contactName']         = $contactName; 
                $arrContactsData['contactPhone']        = $contactPhone; 
                $arrContactsData['contactAddr']         = $contactAddr; 
                $arrContactsData['contactJob']          = $contactJob; 
                $arrContactsData['contactPos']          = $contactPos; 
                $arrContactsData['contactGrp']          = $contactGrp; 
                $arrContacts[] = $arrContactsData; 
        } 
        return $arrContacts; 
} 

function GoogleGroupsAll($GoogleContactsClient,$GoogleContactsEmail){ 
        $scope          = "http://www.google.com/m8/feeds/groups/".$GoogleContactsEmail."/"; 
        $gdata          = new Zend_Gdata($GoogleContactsClient); 
        $query          = new Zend_Gdata_Query($scope.'full'); 
        $query->setMaxResults(10000); 
        $feed           = $gdata->retrieveAllEntriesForFeed($gdata->getFeed($query)); 
        foreach ($feed as $entry){ 
                $arrGroupsData['groupName']     = $entry->title->text; 
                $arrIdExplode                   = explode("/",$entry->id->text); 
                $arrGroupsData['groupId']       = $arrIdExplode[(count($arrIdExplode)-1)]; 
                $GroupHref                      = $entry->link[1]; 
                if($GroupHref->rootElement == "link"){ 
                        $arrHrefExplode                 = explode("/",$GroupHref->href); 
                        $arrGroupsData['groupHref']     = $arrHrefExplode[(count($arrHrefExplode)-1)]; 
                } 
                $arrGroups[] = $arrGroupsData; 
        } 
        return $arrGroups; 
} 

?> 