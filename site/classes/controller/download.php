<?php

class Controller_Download extends Controller_Template {

	public function action_image($id, $clippingId)
	{
		$image = Model_Image::find()
			->where('id', '=', $id)
			->get_one();

		if(!$image)	\Response::redirect('/');

		$path = FILEPATH . 'clippings/' . $clippingId . '/' . $image->url; // docroot + iets + img_url

		if(realpath($path)){

			$extension = pathinfo($path, PATHINFO_EXTENSION);
			
			\File::download($path, $image->created_at);

		}else{

			\Response::redirect('/');
		}
	}

	public function action_clipping($id)
	{
		$clipping = Model_Clipping::find()
			->where('id', '=', $id)
			->get_one();

		if(!$clipping)	\Response::redirect('/');

		$path = FILEPATH . 'clippings/' . $id . '/' . $clipping->pdf_url; // docroot + iets + img_url

		if(realpath($path)){

			$name = preg_replace('/\s+/', '', $clipping->pdf_url);

			$extension = pathinfo($path, PATHINFO_EXTENSION);
			
			\File::download($path, $name);

		}else{

			\Response::redirect('/');

		}

	} 

	public function action_collection($year, $month, $customerId)
	{
		$dateFrom = mktime(0, 0, 0, $month, 1, $year);
	    $dateTo = mktime(0, 0, -1, $month + 1, 1, $year);

		$results = DB::select_array(array('clippings.id', 'clippings.name', 'pdf_url'))
	                   ->from('clippings')
	                   ->where('customer_id', '=', $customerId)
	                   ->where('publicationdate', '>=', $dateFrom)
	                   ->where('publicationdate', '<', $dateTo)
	                   ->execute()
	                   ->as_array();

        $customerModel = Model_Customer::find($customerId);
        $filename = strtolower($month . '_' . $year . '_' . $customerModel->company_name . '_' . count($results) . 'n.zip');
        //$destination = DOCROOT . 'data/collections/' . $filename;

        $destination = FILEPATH . 'collections/' . $filename; // docroot + iets + img_url

        if(! file_exists($destination))
        {
        	//nieuwe zip maken

	        $overwrite = false;
	        $zip = new ZipArchive();

	        if ($zip->open($destination,  ZIPARCHIVE::CREATE) !== TRUE) 
	        {
	        	echo "zip bestand kan niet aangemaakt worden";
		      	return false;
		    }

		    $count = 0;

	        foreach($results as $result)
	        {
	        	$file = FILEPATH . 'clippings/' . $result['id'] . '/' . $result['pdf_url'];

	        	if(file_exists($file))
	        	{
	        		$zip->addFile($file, $count . '_' . $result['name'] . '.pdf');	
	        		$count++;
	        	}
	        }

	        $zip->close();
	    }

	    //destination laten downloaden

	    if(realpath($destination)){

			$name = preg_replace('/\s+/', '', $filename);

			$extension = pathinfo($path, PATHINFO_EXTENSION);
			
			\File::download($destination, $name);

		}else{

			\Response::redirect('/');

		}
	}
}