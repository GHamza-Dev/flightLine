<?php


function filter($data){
    if (is_string($data)) {
        $data = trim($data);
        $data = htmlspecialchars($data);
    }elseif(is_array($data)){
        foreach($data as $key => $val){
            $data[$key] = trim($val);
            $data[$key] = htmlspecialchars($val);  
        }
    }
    return $data;
}