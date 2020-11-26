<?php
	$agenda =array("EDDY"=> array("nombre" =>"Gsancho" ,
                                          "direccion" => "sierra olvira" ,
                                           "fuerza"   => "Over 9000") ,
                      "JIRON" => array("nombre" => "jonki",
                                          "direccion" => "valdemin",
                                           "fuerza" => "0"));
      
      
      
     foreach($agenda as $clave_agenda =>$persona){
        
         echo "$clave_agenda ";
        
        foreach($persona as $clave_agenda2 => $datos){
           
            echo "$clave_agenda2 : $datos <br>";
     	}      
     } 
	 
?>	 