<?php

function username(){
    return isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
}

function auth(){
    if (isset($_SESSION['logged']) && $_SESSION['logged']) return true;
    return false;
}

function id(){
    return auth() ? $_SESSION['id'] : false;
}