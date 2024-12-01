<?php
session_start();
if (isset($_SESSION["studentid"])){
    echo"welcome student";
}
else{
    echo "NOT THE VALID STUDENT";
}
?>