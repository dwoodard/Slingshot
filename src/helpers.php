<?php


if (!function_exists('deleteDirectory')) {
    function deleteDirectory($dir) {
        if (!file_exists($dir)) {
            return true;
        }

        if (!is_dir($dir)) {
            return unlink($dir);
        }

        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }

            if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }

        }

        return rmdir($dir);
    }
}

if (!function_exists('command_exist')) {
    function command_exist($cmd) {
        $return = shell_exec(sprintf("which %s", escapeshellarg($cmd)));
        return !empty($return);
    }
}

if (!function_exists('recurseCopy')) {
    function recurseCopy($src,$dst, $childFolder='') {

        $dir = opendir($src);
        mkdir($dst);
        if ($childFolder!='') {
            mkdir($dst.'/'.$childFolder);

            while(false !== ( $file = readdir($dir)) ) {
                if (( $file != '.' ) && ( $file != '..' )) {
                    if ( is_dir($src . '/' . $file) ) {
                        $this->recurseCopy($src . '/' . $file,$dst.'/'.$childFolder . '/' . $file);
                    }
                    else {
                        copy($src . '/' . $file, $dst.'/'.$childFolder . '/' . $file);
                    }
                }
            }
        }else{
            // return $cc;
            while(false !== ( $file = readdir($dir)) ) {
                if (( $file != '.' ) && ( $file != '..' )) {
                    if ( is_dir($src . '/' . $file) ) {
                        $this->recurseCopy($src . '/' . $file,$dst . '/' . $file);
                    }
                    else {
                        copy($src . '/' . $file, $dst . '/' . $file);
                    }
                }
            }
        }

        closedir($dir);
    }
}



