<?php
 $to        = 'websupport@herbdoc.com';
 $subject   = 'Email Sign Up';
 $sender    = 'noreply@herbdoc.com';
 $message   = 'Did you get this? Please respond in our ticket.';

 $mailMessage = "The following message was received from $sender.\n\n$message";
 mail($to, $subject, $mailMessage, "From: $sender");
?>
