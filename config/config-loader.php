<?php
error_reporting(-1);
/**
 * 
 * Path of the environment file or .ENV file
 * Should be constant
 * File name is case sensitive
 *  */
define('ENV_PATH', 'config/.ENV');



/**
 * 
 * Strict mode will check if execution to be stopped when value 
 * does not match
 * or should return blank value and keep continue.
 * 
 * 
 *  */
define('STRICT_MODE', false);


/**
 * 
 * function will return env value from .ENV file
 * if value is not available or empty, will try to return backup value if available
 * will return false if both are missing
 * @param string $key default ''
 * @param string $backup_value default null 
 * 
 * */
function env(string $key='', string $backup_value=''){

   
    $filename   =   ENV_PATH;


    validate_file($filename);

    $all_vars   =   read_file($filename);

    foreach($all_vars as $var=>$value){
        
        if($value==''){
            // Ignore blank line
            continue;
        }
        
        list($variable, $value)     =   explode('=',$value);
        $config[$variable]  =   $value;

    }

    if(array_key_exists($key, $config) AND $config[$key]!=''){
       return $config[$key];
    }

    return_fallback($backup_value, $key);


}


/**
 * 
 * Check if file exists, if missing, function will abort execution
 * with message of missing or incorrect file
 * @param string $filename
 * @return true if file exists
 * 
 *  */
function validate_file(string $filename)
{
    if(!file_exists($filename)){
        //create_env_file($filename);
        die('Your environment file is not setup correctly, please configure environment file. <pre>'.ENV_PATH.'</pre>');
    }

    return true;
}


/**
 * 
 * Function will read file and split
 * will return array of lines
 * @param string $filename
 * @return array $all_vars
 * 
 *  */
function read_file(string $filename)
{
    $data       =   file_get_contents($filename);
    $all_vars   =   explode(PHP_EOL,$data);
    $all_vars   =   array_filter($all_vars);

    return $all_vars;
}


/**
 * 
 * Function will return fallback value if supplied 
 * else function will abort with messafe of missing variable.
 * if strict mode is enabled, execution will stop else will return blank
 * @param string $backup
 * @param string $key
 * @return string $value
 * 
 *  */
function return_fallback(string $backup, string $key)
{
    if($backup!=''){
        return $backup;
    }


    if(STRICT_MODE==true){

        die('ENV value does not exists for# '.$key);
 
    }

    return "";
}