<?php
    if(strpos($_SERVER['REQUEST_URI'], '.')) header("Location: /");

require_once("./backend/dependencies/scssphp/scss.inc.php");

use ScssPhp\ScssPhp\Compiler;

$hashfile = "files.json";
$sourceDir = "templates/style/";
$destDir = "style/";
if(!file_exists($sourceDir)){
    mkdir($sourceDir, 0777, true);
}
if(!file_exists($destDir)){
    mkdir($destDir, 0777, true);
}

function listFiles($dir){
    $files = [];
    global $hashfile;
    foreach(scandir($dir) as $file){
        if((strpos($file,".") !== false and strpos($file,".") == 0) or strpos($file, $hashfile) !== false){
            continue;
        }
        if(is_dir($file)){
            //$files = array_merge(listFiles($dir."/".$file)); //To be implemented
            continue;
        }
        $files[] = $file;
    }
    return $files;
}

function getFileHashes($dir){
    $hashes = [];
    $files = listFiles($dir);

    foreach($files as $file){
        $hashes[$file] = md5(file_get_contents($dir.$file));
    }
    return $hashes;
}

function compileSCSSFiles($sourceDir, $destDir){
    $compiler = new Compiler();
    $files = listFiles($sourceDir);
    foreach($files as $file){
        $content = file_get_contents($sourceDir.$file);
        $compiled = $compiler->compileString($content)->getCss();
        $filename = str_replace(".scss",".css",$file);
        file_put_contents($destDir.$filename, $compiled);
    }
}

if(file_exists($sourceDir."/".$hashfile)){
    $oldHashes = json_decode(file_get_contents($sourceDir.$hashfile));
    $currentHashes = getFileHashes($sourceDir);
    if($oldHashes == $currentHashes){
        return;
    }
}

file_put_contents($sourceDir.$hashfile, json_encode(getFileHashes($sourceDir), JSON_PRETTY_PRINT));
compileSCSSFiles($sourceDir, $destDir);
