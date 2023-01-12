<?php
if (!isset($_REQUEST["action"])||$_REQUEST["action"]==""){
    include ("template.php");
} else {
    include ("data.php");
}