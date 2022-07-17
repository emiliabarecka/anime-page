<?php
declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', '1');

function dump($data){
    if(DEV){
        echo '<br/><div
        style="
        display:inline-block;
        padding:1px 10px;
        margin:5px;
        border: 1px solid black;
        background-color:black;
        color:white;">
        <pre>';
        print_r($data);
        echo'</pre>
        </div>
        <br/>';
    }  
}