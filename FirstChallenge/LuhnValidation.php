<?php

    $credit_number=(int)readLine();
    $isEven=false; //boolean checks if position is even or odd
    
    $suma=0; 
    while($credit_number>0){ 
        if($isEven){

            $num=($credit_number%10)*2; //doubles last digit
            if($num >= 10) {
                $num=($num%10)+(intdiv($num,10)); //if after doubling the number the result is >=10, we replace the number by the sum of the two digits
            }
            $suma+=$num; 

        }else{
            $last_digit = $credit_number%10;
            $suma+= $last_digit; 

        }
        $isEven= ! $isEven;
        $credit_number=intdiv($credit_number,10); //shortens the number by erasing the last digit
    }

    if($suma%10){
        echo 'No Valido';
    }else{
        echo 'Valido';
    }
    
    
?>