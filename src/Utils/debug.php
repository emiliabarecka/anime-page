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
        border: 1px solid lightgreen;
        background-color:black;
        color:lightgreen;
        width:96%;
        ">
        <pre style="  
        word-wrap: break-word;
        ">';
        print_r($data);
        echo'</pre>
        </div>
        <br/>';
    }  
}
?>