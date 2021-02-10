echo "<pre>"

print_r($POST);
echo"</pre>";

$userName= $_POST["name"];
$userEmail= $_POST["email"];
$message= $_POST["message"];


$to = "jked630@gmail.com";
$body = "";

$body .="From: ".$userName. "\r\n";
$body .="Email: ".$userEmail. "\r\n";
$body .="Message: ".$message. "\r\n";
mail($to,$messageSubject,$body);
