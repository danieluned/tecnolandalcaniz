<?php
/**
 * Modelo Competicion,
 * Tiene las funciones relacionadas con la base de datos
 * para manejar una competicion
 * @author Usuario
 *
 */
class Mapa extends MY_Model {
    
   
    public static function callofdutyPuntocaliente(){
        return array(
            "Seaside","Slums","Summit","Arsenal","Contraband","Frequency","Gridlock"
        );
    }
    
    public static function callofdutyByd(){
        return array(
            "Hacienda","Firing Range","Frequency","Gridload","Seaside","Arsenal"
        );
    }
    
    public static function callofdutyControl(){
        return array(
            "Arsenal","Frequency","Jungle","Payload","Seaside","Gridlock"
        );
    }
}
?>