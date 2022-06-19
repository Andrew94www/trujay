<?php

//Get all deals
function getAllDeals($url,&$arr)
{
$curl = curl_init();     
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
$result =(string)curl_exec($curl);
$k = explode(',', $result);
$v = $k[count($k)-1];
preg_match_all('#[0-9]#',$v , $matches);
$offset=implode($matches[0]);
preg_match_all('#"value":".+?"#',$result ,  $matches);
$dealName =array_unique(array_values($matches[0]));
$arr[]=$dealName;
preg_match_all('#"hasMore":true,"#',$result , $matches);
if($matches[0][0]=='"hasMore":true,"'){
    preg_match_all('#"hasMore":true,"#',$result , $matches);
    return $offset;
}
else {
    return false;
}
 }
$arr =[];
$url ='https://api.hubapi.com/deals/v1/deal/paged?hapikey=df943847-6a97-4b8d-885e-7a867466336f&properties=dealname';
$req = getAllDeals($url,$arr);

while($req){
    $url ='https://api.hubapi.com/deals/v1/deal/paged?hapikey=df943847-6a97-4b8d-885e-7a867466336f&properties=dealname';
    $req = getAllDeals($url.'&offset='.$req,$arr);
}
$fp = fopen('deals.csv', 'w');
foreach ($arr as $fields) {
    fputcsv($fp, $fields);
}
fclose($fp);

 // Get all dcontacts
function getAllContacts($url,&$arr)
{
$curl = curl_init();     
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
$result =(string)curl_exec($curl);
$k = explode(',', $result);
$v = $k[count($k)-1];
preg_match_all('#[0-9]#',$v , $matches);
$vidOffset=implode($matches[0]);
preg_match_all('#"value":".+?"#',$result ,  $matches);
$contactValue =array_unique(array_values($matches[0]));
$arr[]=$contactValue;
 preg_match_all('#"has-more":true,"#',$result , $matches);
 if($matches[0][0]=='"has-more":true,"'){
    preg_match_all('#"has-more":true,"#',$result , $matches);
     return $vidOffset;
 }
 else {
     return false;
 }
 }
$arr =[];
$url ='https://api.hubapi.com/contacts/v1/lists/all/contacts/all?hapikey=df943847-6a97-4b8d-885e-7a867466336f';
$req = getAllContacts($url,$arr);
while($req){
    $url ='https://api.hubapi.com/contacts/v1/lists/all/contacts/all?hapikey=df943847-6a97-4b8d-885e-7a867466336f';
    $req = getAllContacts($url.'&vidOffset='.$req,$arr);
}

$fp = fopen('contacts.csv', 'w');
foreach ($arr as $fields) {
    fputcsv($fp, $fields);
}
fclose($fp);


// Get all company
function getAllCompany($url,&$arr)
{
$curl = curl_init();     
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
$result =(string)curl_exec($curl);
$k = explode(',', $result);
$v = $k[1];
preg_match_all('#[0-9]#',$v , $matches);
$vidOffset=implode($matches[0]);
preg_match_all('#"value":".+?"#',$result ,  $matches);
$contactValue =array_unique(array_values($matches[0]));
$arr[]=$contactValue;
 preg_match_all('#"has-more":true,"#',$result , $matches);
 if($matches[0][0]=='"has-more":true,"'){
    preg_match_all('#"has-more":true,"#',$result , $matches);
     return $vidOffset;
 }
 else {
     return false;
 }
 }
$arr =[];
$url ='https://api.hubapi.com/companies/v2/companies/paged?hapikey=df943847-6a97-4b8d-885e-7a867466336f&properties=name';
$req =  getAllCompany($url,$arr);
while($req){
    $url ='https://api.hubapi.com/companies/v2/companies/paged?hapikey=df943847-6a97-4b8d-885e-7a867466336f&properties=name';
    $req =  getAllCompany($url.'&offset='.$req,$arr);
    // echo '1';
}
$fp = fopen('company.csv', 'w');
foreach ($arr as $fields) {
    fputcsv($fp, $fields);
}
fclose($fp);

 echo'<pre>';
    print_r($arr );
    echo'</pre>';
