<?php
class Generator
{
	private 	$inputFile;
	private 	$clippingId;
	public 		$imgArr = array();
	public 		$outputdir;
	public 		$filepath;
	public 		$pdfUrl;
	public 		$clippingPath;

	public function __construct($clippingId, $inputFile)
	{
		$this->clippingId = $clippingId;

		File::create_dir(FILEPATH.'clippings/', $this->clippingId, 0777);
		$this->outputdir = FILEPATH.'clippings/'.$this->clippingId.'/';

		$this->filepath = 'data/clippings/'.$this->clippingId.'/';

		$this->inputFile = FILEPATH.'files/'.$inputFile;

		$this->clippingPath = 'data/clippings/'.$clippingId.'/';

		$images = $this->generate();
		$this->imgArr = $images;

		File::copy($this->inputFile, $this->outputdir.$inputFile);

		//$this->pdfUrl = $this->outputdir.$inputFile;
		$this->pdfUrl = $inputFile;

		return;
	}

	public function generate(){

		$filename = pathinfo($this->inputFile, PATHINFO_FILENAME);

		$command = '/usr/bin/gs -dSAFER -dNOPAUSE -dQUIET -dBATCH -dUseTrimBox -dNOSUBSTDEVICECOLORS -r150 -dJPEGQ=85 -dCOLORSCREEN=false -sDEVICE=jpeg -sPAPERSIZE=a4 -dPDFFitPage -dUseCIEColor';
		$command .= ' -sOutputFile='. $this->outputdir . $filename .'_%04d.jpg '. $this->inputFile;

		//. ' 2>&1'

		//echo '<pre>' . print_r($command, true) . '</pre>';

		exec($command, $output, $return_var);

		//echo '<pre>' . print_r($output, true) . '</pre>';

		//exit;

		if(empty($return_var)){

			return $this->get_pages();

		}else{

			return -1;

      	}

	}

	private function get_pages(){

		$files = File::read_dir($this->outputdir);

		return $files;
	}
}