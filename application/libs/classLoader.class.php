<?php

class ClassLoader
{
	public static function loadModels()
	{
		foreach(glob("application/models/*.class.php") as $model){
			include $model;
		}
	}

	public static function loadClass($path)
	{
		foreach(glob($path."*.class.php") as $class){
			include $class;
		}
	}

	public static function readDir($path)
	{
		foreach(glob($path."*.*") as $file){
			//echo $file." ma rozmiar ".filesize($file)."\n";
		}
	}
}

?>