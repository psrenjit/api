<?php
session_start();
if (isset($_SESSION['request_No']))
{
   echo 'You are signed in.';
}
 