<?php

class Imagegenerator
{

	private 	$inputFile;
	private 	$outputdir;
	public 		$imgArr = array();

	public function __construct($inputFile){

		if( file_exists( $_SERVER{'DOCUMENT_ROOT'} . "beheer/public/files/" . $inputFile))  { 
			echo "yes";
		} else {
			echo "no";
		}

		$time_start = microtime(true);

		$this->inputFile = $inputFile;
		$this->outputdir = __DIR__ .'/output/';

		$images = $this->generate();

		$time_end = microtime(true);
		$time = $time_end - $time_start;

		echo 'uitvoertijd: '. $time .'<br />';
		echo $this->outputdir;
		print_r($images);

	}

	public function generate(){

		$filename = pathinfo($this->inputFile, PATHINFO_FILENAME);

		$command = 'gs -dSAFER -dNOPAUSE -dQUIET -dBATCH -dUseTrimBox -dNOSUBSTDEVICECOLORS -r150 -dJPEGQ=85 -dCOLORSCREEN=false -sDEVICE=jpeg -sPAPERSIZE=a4 -dPDFFitPage -dUseCIEColor ';
		$command .= ' -sOutputFile='. $this->outputdir . $filename .'_%04d.jpg '. $this->inputFile;

		exec($command, $output, $return_var);

		if(empty($return_var)){

			return $this->get_pages();

		}else{

			return -1;

      	}

	}

	private function get_pages(){

		$jpgs = glob($this->outputdir .'*.jpg');

		return $jpgs;

	}

}
?>