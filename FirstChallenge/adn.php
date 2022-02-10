<?php
    $adn=readLine("Enter DNA sequence: ");
    /*
    for($i=0;$i<strlen($adn);$i++){
        $char=$adn[$i];
        if($char=="G"){
            $adn[$i]="C";
        }elseif($char=="C"){
            $adn[$i]="G";
        }elseif($char=="T"){
            $adn[$i]="A";
        }elseif($char=="A"){
            $adn[$i]="U";
        }

    }
    echo $adn;
    */
    for($i=0;$i<strlen($adn);$i++){
        $adn[$i]=match($adn[$i]){
            'G' => 'C',
            'C' => 'G',
            'T' => 'A',
            'A' => 'U',
        };

    }
    echo $adn;
    

    
    

?>