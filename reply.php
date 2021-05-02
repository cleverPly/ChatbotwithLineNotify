<?php
//https://asia-east2-newchatbottest02.cloudfunctions.net/webhook

date_default_timezone_set("Asia/Bangkok");
$date = date("Y-m-d");
$time = date("H:i:s");
$json = file_get_contents('php://input');
$request = json_decode($json, true);
$queryText = $request["queryResult"]["queryText"];
$answer = $request["queryResult"]["fulfillmentText"];
//add
$unknown = $request["queryResult"]["action"];

$message = $queryText;
$source = $request["originalDetectIntentRequest"]["source"];

$userId = $request['originalDetectIntentRequest']['payload']['data']['source']['userId'];


$noti_token = 'h8d38YzBqQlhWIupJbH7RvKsdwC1sCI2hIkHBFVvBtq';
date_default_timezone_set("Asia/Bangkok");
$serverName = "localhost";
$userName = "chatbot";
$userPassword = "chatbot";
$dbName = "chatbot";



$opts = [
"http" =>[
    //Channel access token
//"header" => "Content-Type: application/json\r\n"."Authorization: Bearer Dbntf0HKGslTEtzvWg4YHxzPDFG+lqAtCHYRPw883DSi5jhv9HrSDDtqdC/ciYlyoeXn+w1pI670mv51UJPbtvyJtaZn0qRd21mBhZMTno8Ie2otG5yWLgHuq8/jX57Q57Ncd1SLxhXOkSdz2orldQdB04t89/1O/w1cDnyilFU="
"header" => "Content-Type: application/json\r\n"."Authorization: Bearer EfRX4LvlQRftxWawuF8aimRdoVi+Fmc5lVAWiaNO9r2JXlWZRUH0PILJpux95uY3/8xhk2eyupL6IaMAC5MF8dGESsX41MhRo/++nceTqfXiP9EFeY6VCfqJ7uTMIIrSu+KDsycjxNporOa3E66VGwdB04t89/1O/w1cDnyilFU="
]
];

$context = stream_context_create($opts);
$profile_json = file_get_contents('https://api.line.me/v2/bot/profile/'.$userId,false,$context);
$profile_array = json_decode($profile_json,true);
$pic_ = $profile_array['pictureUrl'];
$name_ = $profile_array['displayName'];


$opts = [
"http" =>[
    //Channel access token
//"header" => "Content-Type: application/json\r\n"."Authorization: Bearer Dbntf0HKGslTEtzvWg4YHxzPDFG+lqAtCHYRPw883DSi5jhv9HrSDDtqdC/ciYlyoeXn+w1pI670mv51UJPbtvyJtaZn0qRd21mBhZMTno8Ie2otG5yWLgHuq8/jX57Q57Ncd1SLxhXOkSdz2orldQdB04t89/1O/w1cDnyilFU="
"header" => "Content-Type: application/json\r\n"."Authorization: Bearer 5098nLh0sDRmSuBKwv4ugegbdyxmpDKz/9dCddGmIHWIxrb0mbkOJtzJ5Xob6ivUY8dOAYP0lld9qoGLE3J1yKxUfSQeuEc4pieyglJRPKob5KtpYdhYWmS6iNzl5U2+uaJutneSuear9GBl4lfWNAdB04t89/1O/w1cDnyilFU="
]
];

$context = stream_context_create($opts);
$profile_json = file_get_contents('https://api.line.me/v2/bot/profile/'.$userId,false,$context);
$profile_array = json_decode($profile_json,true);
$pic_ = $profile_array['pictureUrl'];
$name_ = $profile_array['displayName'];


$myfile = fopen("log$date.txt", "a") or die("Unable to open file!");
//$myfile = fopen("log$date.xls", "a+") or die("Unable to open file!");
//$log = $date."--".$time."\t".$source."\t".$userId."\t".$name_."\t".$pic_."\t".$queryText."\t".$answer."\n";
$log = $date."--".$time."\t".$source."\t".$userId."\t".$name_."\t".$queryText."\t".$answer."\n";
//$myfile = fopen("log$date.csv", "a+") or die("Unable to open file!");
//$mxituid = $_SERVER["HTTP_X_MXIT_USERID_R"];
fwrite($myfile,$log);
fclose($myfile);

//$message_all = “คุณ “.$name.” ถามว่า “.$message;
if($source=='line') { 
    if($message=='คุยกับเจ้าหน้าที่'){$message_all = $source."\n\nจากคุณ: ".$name_." ต้องการ".$message;}
    
    else{$message_all = $source."\n\nจากคุณ: ".$name_."\n\nถามว่า: ".$message."\n\nตอบว่า: ".$answer."\n\nถ้าต้องการตอบเพิ่มเติม: ".'https://siitseniorchatbot.azurewebsites.net/push11.php?uid='.$userId;}}
else { 
$message_all = $source."\n\nถามว่า: ".$message."\n\nถ้าต้องการตอบเพิ่มเติม: ".'https://www.facebook.com/SIIT-Chatbot-Senior-Project-113706620038941/inbox';}
//else { $message_all = $source."\n\nถามว่า: ".$message."\n\nตอบว่า: ".$answer;}

$content = $date.' '.$time.' '.$name_.' '.$userId.' '.$pic_.' '.$message."\n";

/* $myfile = fopen(“log_.txt”, “a”) or die(“Unable to open file!”);
fwrite($myfile,$content);
fclose($myfile);
*/
if($unknown=='input.unknown'){

$chOne = curl_init();
curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
// SSL USE
curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0);
//POST
curl_setopt( $chOne, CURLOPT_POST, 1);
// Message
curl_setopt( $chOne, CURLOPT_POSTFIELDS, $message);
//ถ้าต้องการใส่รุป ให้ใส่ 2 parameter imageThumbnail และimageFullsize
//curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=$message_all&imageThumbnail=$pic_&imageFullsize=$pic_");
curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=$message_all");
// follow redirects
curl_setopt( $chOne, CURLOPT_FOLLOWLOCATION, 1);
//ADD header array
$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer aU5wFWucr101CCe2ctl6mY1XIdcgjKjJmbCAwEXYMgU', );
curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
//RETURN
curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec( $chOne );
//Check error
if(curl_error($chOne)) { echo 'error:' . curl_error($chOne); }
else { $result_ = json_decode($result, true);
//echo “status : “.$result_[‘status’];
//echo “message : “. $result_[‘message’];
}
//Close connect
curl_close( $chOne );

}else{
}

$connect = mysqli_connect($serverName,$userName,$userPassword,$dbName);
mysqli_set_charset($connect, "utf8");
$query = "INSERT INTO chatbot_log(user_id,name,pic,text,date_time) VALUE ('$userId','$name_','$pic_' ,'$message',NOW())";
$resource = mysqli_query($connect,$query);
mysqli_close($conn)

?>