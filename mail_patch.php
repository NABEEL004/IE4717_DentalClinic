<?php
// codes adapted from https://tareq.co/2010/01/sending-mail-with-gmails-smtp-server-with-fsockopen/

// namespace mail_patch {

// //this function processes the server return codes and generates errors if needed
// function server_parse($socket, $expected_response)
// {
//     $server_response = "";
//     while (substr($server_response, 3, 1) != ' ')
//     {
//         if (!($server_response = fgets($socket, 256))){
//             echo "Couldn\’t get mail server response codes.";
//         }
//     }

//     if (!(substr($server_response, 0, 3) == $expected_response)){
//         echo "Unable to send e-mail. ($server_response)";
//     }
// }

// function mail($to, $subject, $message, $headers="", $sender="")
// {
//     $recipients = explode(',', $to);
//     $from = substr($sender, 2);
//     $smtp_host = 'localhost';
//     $smtp_port = 25;

//     if (!($socket = fsockopen($smtp_host, $smtp_port, $errno, $errstr, 15))){
//         echo "Could not connect to smtp host '$smtp_host' ($errno) ($errstr)";
//     }

//     server_parse($socket, '220');

//     fwrite($socket, 'EHLO '.$smtp_host."\r\n");
//     server_parse($socket, '250');

//     fwrite($socket, "MAIL FROM: <$from>"."\r\n");
//     server_parse($socket, '250');

//     foreach ($recipients as $email)
//     {
//         fwrite($socket, "RCPT TO: <$email>"."\r\n");
//         server_parse($socket, '250');
//     }

//     fwrite($socket, 'DATA'."\r\n");
//     server_parse($socket, '354');

//     fwrite($socket, 'Subject: '.$subject."\r\n".'To: <'.implode('>, <', $recipients).'>'."\r\n".$headers."\r\n\r\n".$message."\r\n");

//     fwrite($socket, '.'."\r\n");
//     server_parse($socket, '250');

//     fwrite($socket, 'QUIT'."\r\n");
//     fclose($socket);

//     return true; 

// }
// }



?>

<?php 
// use function mail_patch\mail;
?>

<!DOCTYPE html>
<html>
<body>

<h1>Hello Mail</h1>

<p>My first mail test.</p>

<?php
$to      = 'f32ee@localhost';
$subject = 'the subject';
$message = 'hello from php mail';
$headers = 'From: f32ee@localhost' . "\r\n" .
    'Reply-To: f32ee@localhost' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers,'-ff32ee@localhost');
echo ("mail sent to : ".$to);
?> 

</body>
</html>
