<?php
   session_start();
   // Destroying the Session
   if(session_destroy()) {
      header("location: bookHostLogin.php");
   }
?>