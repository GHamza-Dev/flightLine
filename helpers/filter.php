<?php


function filter($data,$dataType = null){
    $data = trim($data);
    $data = htmlspecialchars($data);
    return $data;
}