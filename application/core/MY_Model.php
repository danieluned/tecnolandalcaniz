<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class MY_Model extends CI_Model {
     
    protected function convertToObject($array) {
        $object = new stdClass();
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $value = convertToObject($value);
            }
            $object->$key = $value;
        }
        return $object;
    }
}
