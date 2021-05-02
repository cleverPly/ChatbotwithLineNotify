<!DOCTYPE html>
<html>
<head>
        <title></title>
	<style>
	body {
    background: #FADBD8;
}

input[type=text] {
  width: 700px;
  height: 50px;
  float: left;
}

input[type=submit] {
  background: #5B2C6F;
  color: #fff;
  float: right;
}

input[type=submit], input[type=text] {
padding: 9px;
font-size: 18px;
line-height: 18px;
border: 0;
display: block;
margin: 0;
}
	</style>
	<img src="https://admissions.siit.tu.ac.th/undergraduate/public/logo.png" alt="Siit banner" style="width:20%;">

    </head>
<body data-gr-c-s-loaded="true">
	<br><br><br><br>
	<table align="center">
	<tbody><tr align="center">
	<td align="center">
	<h1>Response</h1>
	<h2>Source: LINE</h2>
        <form action="" method="post" align="center">
           <input type="text" name="msg"><br><br><br><br><br><br>
            <input type="submit" name="SubmitButton">
        </form>
		</td>
		</tr>
		
	</tbody></table>
	 
    

</body>
</html>

<?php
error_reporting(0);

$id = $_REQUEST["uid"];
if(isset($_POST["SubmitButton"])){
$msg = $_POST["msg"];

$curl = curl_init();

curl_setopt_array($curl, array(
	CURLOPT_URL => "https://api.line.me/v2/bot/message/push",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION=> "CURL_HTTP_VERSION_1_1",
	CURLOPT_CUSTOMREQUEST => "POST",
	CURLOPT_POSTFIELDS => "{\r\n\r\n \"to\": \"$id\",\r\n\r\n \"messages\": [{\r\n\r\n \"type\": \"text\",\r\n\r\n \"text\": \"$msg\"\r\n\r\n }]\r\n\r\n}",
	CURLOPT_HTTPHEADER => array(
		//Channel access token
		//"authorization: Bearer Dbntf0HKGslTEtzvWg4YHxzPDFG+lqAtCHYRPw883DSi5jhv9HrSDDtqdC/ciYlyoeXn+w1pI670mv51UJPbtvyJtaZn0qRd21mBhZMTno8Ie2otG5yWLgHuq8/jX57Q57Ncd1SLxhXOkSdz2orldQdB04t89/1O/w1cDnyilFU=",
		"authorization: Bearer 5098nLh0sDRmSuBKwv4ugegbdyxmpDKz/9dCddGmIHWIxrb0mbkOJtzJ5Xob6ivUY8dOAYP0lld9qoGLE3J1yKxUfSQeuEc4pieyglJRPKob5KtpYdhYWmS6iNzl5U2+uaJutneSuear9GBl4lfWNAdB04t89/1O/w1cDnyilFU=",
		"cache-control: no-cache",
		"content-type: application/json",
		"postman-token: 99e1d5c3-fd7a-8163-c413–687e5cb8e3c8"
		),
		));
		$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);
if ($err) {
echo "cURL Error #:" . $err;
$message = "Wrong!";
echo "<script type='text/javascript'>alert('$message');</script>";
} else {
	$message = "Success!";
echo "<script type='text/javascript'>alert('$message');</script>";
}
}
?>