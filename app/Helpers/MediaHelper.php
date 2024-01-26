<?php

function getNewFileNameWithExtension($extention){
    return uniqid() . '-' . strval(time()) . '.' . $extention;
}