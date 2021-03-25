<?php
error_reporting(0);
require_once 'config.php';
$cache_ext = '.html'; //file extension
$cache_time = 604800;  //Cache file expire time (24 hour = 86400 sec)
$cache_folder = 'cache/'; //Cache files folder 

$webpage_url = 'http://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$cache_file = $cache_folder.md5($webpage_url).$cache_ext; // creating unique name for cache file

function replaceNbspWithSpace($content){
    $string = htmlentities($content, null, 'utf-8');
    $content = str_replace("&nbsp;", " ", $string);
    $content = html_entity_decode($content);
    return $content;
}

//include('postwp.php');
//$url = $_GET['news'];
//$id = $_GET['v']; KEYWORD
$mKEYWORD = KEYWORD;

$id = $mKEYWORD ;
$id = str_replace(" ", "+", $id);

$url = 'http://www.articlesfactory.com/search/'.$id.'/page'.rand(1,9).'.html';
echo '$url: '.$url.'<br>';

//create cURL connection
/*$website = $_POST['url'];
$username = $_POST['username'];
$password = $_POST['password'];*/
$curl_connection = curl_init();

//set options
curl_setopt($curl_connection, CURLOPT_URL,$url);
curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($curl_connection, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl_connection, CURLOPT_FOLLOWLOCATION, 1);



//perform our request
$result = curl_exec($curl_connection);
//echo '$result: '.$result.'<br>';;

//preg_match('/sources:([^`]*?)}],/', $result, $vdolink);
//preg_match('/image: \'([^`]*?)\'/', $result, $imgurl);
preg_match_all('/class="h2" href="([^`]*?)"/', $result, $linkurl);

 $addlink = [];
  
foreach($linkurl[1] as $line){
    array_push($addlink, $line);

}

shuffle($addlink);

echo '$addlink : '.$addlink[1].'<hr>';
$curl_connection = curl_init();

//set options
curl_setopt($curl_connection, CURLOPT_URL,$addlink[1]);
curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($curl_connection, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl_connection, CURLOPT_FOLLOWLOCATION, 1);



//perform our request
$dataweb = curl_exec($curl_connection);


preg_match('/class="txt-main"([^`]*?)<p class="txt-small-regular">/', $dataweb, $contentall);
echo '$contentall : '.$contentall[0].'<br>';

preg_match('/<h1 class="h2">([^`]*?)</', $contentall[1], $title);
preg_match('/<p>([^`]*?)<p class="txt-small-regular">/', $contentall[0], $content);
//echo $content[1];
//$html = strip_tags($content[1], "<br></br>");
$utf8string = html_entity_decode(preg_replace("/U\+([0-9A-F]{4})/", "&#x\\1;", $content[1]), ENT_NOQUOTES, 'UTF-8');
$regexpattern = '/<table.*?<\/table>/s'; // Matching regular expression pattern
$replacement = ''; // Substitute the matched pattern with an empty string
$html = preg_replace($regexpattern, $replacement, $utf8string);
//$html = strip_tags($html);
//echo $html;
$htmlm = replaceNbspWithSpace($html);
$html = strip_tags($htmlm);


$html = str_replace("1.", '1##', $html);
$html = str_replace("2.", '2##', $html);
$html = str_replace("3.", '3##', $html);
$html = str_replace("4.", '4##', $html);
$html = str_replace("5.", '5##', $html);
$html = str_replace("6.", '6##', $html);
$html = str_replace("7.", '7##', $html);
$html = str_replace("8.", '8##', $html);
$html = str_replace("9.", '9##', $html);
$content = explode(".",$html);
$rand = rand(2,3);
$loop = 0;
$data = "";
foreach($content as $line){


$randbr = rand(3,4);
$parametor = @($loop % $randbr);
if($parametor==0){
$data.= $line;
}else{
$data.= $line;
}

$loop++;
}
//$data = str_replace("##", '.', $data);
//$data = str_replace(".%0A%0A.%0A%0A", '.%0A%0A', $data);


while($data===""){
    $url = 'http://www.articlesfactory.com/search/'.$id.'/page'.rand(1,9).'.html';

//create cURL connection
/*$website = $_POST['url'];
$username = $_POST['username'];
$password = $_POST['password'];*/
$curl_connection = curl_init();

//set options
curl_setopt($curl_connection, CURLOPT_URL,$url);
curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($curl_connection, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl_connection, CURLOPT_FOLLOWLOCATION, 1);



//perform our request
$result = curl_exec($curl_connection);
//echo $result;

//preg_match('/sources:([^`]*?)}],/', $result, $vdolink);
//preg_match('/image: \'([^`]*?)\'/', $result, $imgurl);
preg_match_all('/class="h2" href="([^`]*?)"/', $result, $linkurl);

 $addlink = [];
  
foreach($linkurl[1] as $line){
    array_push($addlink, $line);

}

shuffle($addlink);

//echo $addlink[1].'<hr>';
$curl_connection = curl_init();

//set options
curl_setopt($curl_connection, CURLOPT_URL,$addlink[1]);
curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($curl_connection, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl_connection, CURLOPT_FOLLOWLOCATION, 1);



//perform our request
$dataweb = curl_exec($curl_connection);


preg_match('/class="txt-main"([^`]*?)<p class="txt-small-regular">/', $dataweb, $contentall);
//echo $contentall[0];

preg_match('/<h1 class="h2">([^`]*?)</', $contentall[1], $title);
preg_match('/<p>([^`]*?)<p class="txt-small-regular">/', $contentall[0], $content);
//echo $content[1];
//$html = strip_tags($content[1], "<br></br>");
$utf8string = html_entity_decode(preg_replace("/U\+([0-9A-F]{4})/", "&#x\\1;", $content[1]), ENT_NOQUOTES, 'UTF-8');
$regexpattern = '/<table.*?<\/table>/s'; // Matching regular expression pattern
$replacement = ''; // Substitute the matched pattern with an empty string
$html = preg_replace($regexpattern, $replacement, $utf8string);
//$html = strip_tags($html);
//echo $html;
$htmlm = replaceNbspWithSpace($html);
$html = strip_tags($htmlm);


$html = str_replace("1.", '1##', $html);
$html = str_replace("2.", '2##', $html);
$html = str_replace("3.", '3##', $html);
$html = str_replace("4.", '4##', $html);
$html = str_replace("5.", '5##', $html);
$html = str_replace("6.", '6##', $html);
$html = str_replace("7.", '7##', $html);
$html = str_replace("8.", '8##', $html);
$html = str_replace("9.", '9##', $html);
$content = explode(".",$html);
$rand = rand(2,3);
$loop = 0;
$data = "";
foreach($content as $line){


$randbr = rand(3,4);
$parametor = @($loop % $randbr);
if($parametor==0){
$data.= $line;
}else{
$data.= $line;
}

$loop++;
}


}






function translatecontent($data){
    //$url = 'https://www.googleapis.com/language/translate/v2?key=' . $apiKey . '&q=' . rawurlencode($text) . '&source=en&target=fr';
    $url = 'https://translate.googleapis.com/translate_a/single?client=gtx&sl=en&tl=th&dt=t&ie=UTF-8&oe=UTF-8&q='.urlencode($data);

 $curl = curl_init($url);
curl_setopt($curl, CURLOPT_FAILONERROR, true);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);  

$result = curl_exec($curl);
//echo $result;

$datajsone = json_decode($result, true);

$id = 0;
foreach($datajsone['0'] as $students)
{
    $datacontent.= $students['0'];
  
   if($id<5){
    $id++;
   }else{
   $datacontent.= "<br></br>";
    $id = 0;
   }
    
}

return $datacontent;
}

function insertimg($contenter,$title,$KEYWORD){

    $content = explode("<br></br>",$contenter);
//$rand = rand(2,3);
//$randinputlink = rand(5,8);
$loop = 0;
foreach($content as $line){
    //echo $line;
$contents.= $line.'<br></br>';
if($loop == 0){
//$keyurl = str_replace(" ", "+", $_GET['v']);

$keyurl = str_replace(" ", "+", $KEYWORD);
$position = ['alignright','aligncenter','alignleft'];
shuffle($position);
//echo 'https://tse1.mm.bing.net/th?q='.$keyurl.'<hr>';
//echo '<h2>'. $_GET['v'].' : '.$title.'</h2><img class="'.$position[0].'" src="https://tse1.mm.bing.net/th?q='.$keyurl.'" alt="'.$_GET['v'].'" title="'.$_GET['v'].'"><br></br>';
$contents.= '<h2>'. $_GET['v'].' : '.$title.'</h2><img class="'.$position[0].'" src="https://tse1.mm.bing.net/th?q='.$keyurl.'" alt="'.$_GET['v'].'" title="'.$_GET['v'].'"><br></br>';
}/*else{
$randbr = rand(3,4);
$parametor = @($loop % $randbr);
if($parametor==0){
    echo '<br></br>';
$contents.= '<br></br>';
if($loop==$randinputlink){
    echo '<a href="'.$linkurlsite[0].'" target="_blank">'.$_GET['v'].'</a>';
    $contents.= '<a href="'.$linkurlsite[0].'" target="_blank">'.$_GET['v'].'</a>';
}
}else{
$contents.= ' ';
if($loop==$randinputlink){
    echo '<a href="'.$linkurlsite[0].'" target="_blank">'.$_GET['v'].'</a>';
    $contents.='<a href="'.$linkurlsite[0].'" target="_blank">'.$_GET['v'].'</a>';
}
}
}*/
$loop++;
}
return $contents;
}

$titlecontent = translatecontent($title[1]);
echo $titlecontent;
echo "<hr>";

$dataimg = translatecontent($data);

echo "<hr>";
$contentpost = insertimg($dataimg,$titlecontent,KEYWORD);
echo $contentpost;

// require_once('PHPMailer5.2/PHPMailerAutoload.php');

// // passing true in constructor enables exceptions in PHPMailer

// $mail = new PHPMailer(); // create a new object
// $mail->IsSMTP(); // enable SMTP
// $mail->CharSet = 'UTF-8';
// $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
// $mail->SMTPAuth = true; // authentication enabled
// $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
// $mail->Host = "smtp.gmail.com";
// $mail->Port = 465; // or 587
// $mail->IsHTML(true);
// $mail->Username = "somporn5913unapasita@gmail.com";
// $mail->Password = "FECC463811";
// $mail->SetFrom("somporn5913unapasita@gmail.com");
// $mail->Subject = $titlecontent;
// $mail->Body = $contentpost;
// $mail->AddAddress("gamblings2019.sharenow@blogger.com");

//  if(!$mail->Send()) {
//     echo "Mailer Error: " . $mail->ErrorInfo;
//  } else {
//     echo "Message has been sent";
//  }

?>