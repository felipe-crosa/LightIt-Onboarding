<?php
    //Only Numbers
    /*
    $password=readLine("Enter Password: ");
    $password_noSpaces=str_replace(" ","",$password);
   
    $valid_password=false;
    if(strlen($password_noSpaces)>1){
        $valid_password=ctype_digit($password_noSpaces);
    }
    if($valid_password){
        echo 'Valid Password';
    }else{
        echo 'Not Valid';
    }
    */

    //Only AlphaNumerics
    $password=readLine("Enter Password: ");
    $password_noSpaces=str_replace(" ","",$password);
   
    $valid_password=false;
    if(strlen($password_noSpaces)>1){
        $valid_password=ctype_alnum($password_noSpaces); //ctype function return true if all characters are alphanumeric
    }
    if($valid_password){
        echo 'Valid Password';
    }else{
        echo 'Not Valid';
    }

?>