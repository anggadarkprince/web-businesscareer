<?php

function transport($destination){
	$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https' ? 'https://' : 'http://';

	$path = $_SERVER['PHP_SELF'];

	$path_parts = pathinfo($path);
	$directory = $path_parts['dirname'];

	$directory = ($directory == "/") ? "" : $directory;

	$host = $_SERVER['HTTP_HOST'];

	header("location:".$protocol.$host.$directory."/".$destination);
}

function binding_data($data){
    $string= "";
    $first = true;
    foreach($data as $key => $value)
    {
        if($first)
        {
            $first = false;
            $string .= $key."=".$value;
        }
        else
        {
            $string .= "&".$key."=".$value;
        }
    }
    echo $string;
}

function get_base_url(){
    $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https' ? 'https://' : 'http://';

    $path = $_SERVER['PHP_SELF'];

    $path_parts = pathinfo($path);
    $directory = $path_parts['dirname'];

    $directory = ($directory == "/") ? "" : $directory;

    /**
     * @return
     * localhost
     * or mysite.com
     */
    $host = $_SERVER['HTTP_HOST'];

    /**
     * @return
     * http://localhost/mysite
     * or http://mysite.com
     */
    return $protocol.$host.$directory;
}