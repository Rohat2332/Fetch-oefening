<?php
$data = file_get_contents("namen.json");

switch ($_REQUEST['action']){
    case 'read':
        exit ($data);
    case 'create' :
        $args = explode("/",$_REQUEST["args"]);
        $json = json_decode($data,true);
        $json[]= ["id"=>count($json)+1,"name"=>$args[1]];
        $data = json_encode($json);
        file_put_contents("namen.json", $data);
        exit($data);
        break;
    case 'delete':
        $args = explode("/",$_REQUEST["args"]);
        $json = json_decode($data,true);
        chmod("namen.json", 777);
        chmod( "namen.json", '0755' );
        $json = array_filter($json, function($v) use ($args) {
            return $v['id']!=$args[1];
        });
        $data = json_encode($json);

        file_put_contents("namen.json", $data);
        exit($data);
        break;
}

