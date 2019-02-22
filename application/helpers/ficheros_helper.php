<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if ( ! function_exists('createPath'))
{
    /*function createPath($path) {
        $tags = explode( DIRECTORY_SEPARATOR ,$path);            // explode the full path
        $mkDir = "";
        
        foreach($tags as $folder) {
            $mkDir = $mkDir . $folder .DIRECTORY_SEPARATOR;   // make one directory join one other for the nest directory to make        
            if(!is_dir($mkDir)) {             // check if directory exist or not
                mkdir($mkDir, 0777);            // if not exist then make the directory
            }
        }
    }*/
    function createPath($path){
       mkdir($path, 755, true);
    }
    
}
if ( ! function_exists('object_to_array'))
{
    function object_to_array($data)
    {
        if (is_array($data) || is_object($data))
        {
            $result = array();
            foreach ($data as $key => $value)
            {
                $result[$key] = object_to_array($value);
            }
            return $result;
        }
        return $data;
    }
}
?>