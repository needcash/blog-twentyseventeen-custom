<?php
class random_photo_of_me_service
{
	private $photosPath;

	function __construct() {
       $this->photosPath = '/home/site/wwwroot/public-photos/';
   }

	public function getUrlOfRandomPhoto()
	{
		$arrayOfPaths = [];
		foreach (scandir($this->photosPath) as $filename) {
			$path = $this->concatPaths($this->photosPath, $filename);
			$arrayOfPaths = $this->addToArrayRealFilePath($arrayOfPaths, $path);
		}


		return $arrayOfPaths[rand(0, count($arrayOfPaths) - 1)];
	}

	private function addToArrayRealFilePath($array, $path)
	{
		if (is_file($path)) {
			array_push($array, $this->createWebReadyRelativePath($path));
		}

		return $array;
	}

	private function concatPaths($path1, $path2)
	{
		return $path1 . $path2;
	}

	private function createWebReadyRelativePath($path)
	{
		return $this->concatPaths((isset($_SERVER['HTTPS']) ? "https" : "http") . "://" . $_SERVER[HTTP_HOST] . "/public-photos/", basename($path));
	}
}
?>