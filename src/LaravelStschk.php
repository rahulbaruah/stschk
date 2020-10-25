<?php

namespace Rahxcr\LaravelStschk;

class LaravelStschk
{
    // Build your next great package.
    
    public static function ChkLc() {
    	try {
    			//The url you wish to send the POST request to
    			$url = 'https://license.xcraft.co/api/checklicense';
    			
    			//The data you want to send via POST
    			$fields = [
    			    'app'	=> config('laravel-stschk.app_name'),
    			    'key'	=> config('laravel-stschk.key'),
    			    'hash'	=> static::UniqueMachineID(),
    			];
    			
    			//url-ify the data for the POST
    			$fields_string = http_build_query($fields);
    			
    			//open connection
    			$ch = curl_init();
    			
    			//set the url, number of POST vars, POST data
    			curl_setopt($ch,CURLOPT_URL, $url);
    			curl_setopt($ch,CURLOPT_POST, true);
    			curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
    			
    			//So that curl_exec returns the contents of the cURL; rather than echoing it
    			curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
    			
    			//execute post
    			$result = json_decode(curl_exec($ch),true);
    			
    			if(isset($result['status'])) {
    			    return (bool)$result['status'];
    			} else {
    			    return false;
    			}
        }
        catch(Exception $e) {
            return false;
        }
    }
    
    public static function UniqueMachineID($salt = "") {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $temp = sys_get_temp_dir().DIRECTORY_SEPARATOR."diskpartscript.txt";
            if(!file_exists($temp) && !is_file($temp)) file_put_contents($temp, "select disk 0\ndetail disk");
            $output = shell_exec("diskpart /s ".$temp);
            $lines = explode("\n",$output);
            $result = array_filter($lines,function($line) {
                return stripos($line,"ID:")!==false;
            });
            if(count($result)>0) {
                $result = array_shift(array_values($result));
                $result = explode(":",$result);
                $result = trim(end($result));       
            } else $result = $output;       
        } else {
            $result = shell_exec("blkid -o value -s UUID");  
            if(stripos($result,"blkid")!==false) {
                $result = $_SERVER['HTTP_HOST'];
            }
        }   
        return md5($salt.md5($result));
    }
}
