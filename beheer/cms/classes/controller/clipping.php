<?php

include ('generator.php');

class Controller_Clipping extends Controller_Template 
{
	public function action_index()
	{
		//$auth = Auth::instance();
		//$auth->create_user("chantal", "maximumawesome", "chantal@comotion.nl", 100);

		$data['clippings'] = Model_Clipping::find('all');
		$this->template->title = "Clippings";
		$this->template->content = View::forge('clipping/index', $data);
	}

	public function action_view($id = null)
	{
		$data['clipping'] = Model_Clipping::find($id);

		$this->template->title = "Clipping";
		$this->template->content = View::forge('clipping/view', $data);
	}

	public function action_create()
	{
		$labels = Model_Label::find('all');
		$customers = Model_Customer::find('all');

		if (Input::method() == 'POST')
		{
			$val = Model_Clipping::validate('create');
			$errors = array();

			if($val->run() == false)
			{
				$errors = $val->errors();
			}
			else if(Upload::is_valid() == false)
			{
				array_push($errors, 'Upload een pdf bstand.');
			}
			else
			{
				$publicationdate = Input::post('publicationdate');
				list($month, $day, $year) = explode('/', $publicationdate);
				$publicationStamp = mktime(0, 0, 0, $month, $day, $year);


				$clipping = new Model_Clipping();
				$clipping->name = Input::post('name');
				$clipping->label_id = Input::post('label_id');
				$clipping->description = Input::post('description');
				$clipping->customer_id = Input::post('customer_id');
				$clipping->publicationdate = $publicationStamp;
				$clipping->save();

				Upload::save();
				$uploadInfo = Upload::get_files();


				//add new stuff
				$generator = new Generator($clipping->id, $uploadInfo[0]['saved_as']);

				$pdfModel = new Model_Pdf();
				$pdfModel->clipping_id = $clipping->id;
				$pdfModel->url = $generator->pdfUrl;
				$pdfModel->save();

				$imgArray = $generator->imgArr;
				
				for($i=0; $i < count($imgArray); $i++)
				{
					$imageModel = new Model_Image();
					$imageModel->clipping_id = $clipping->id;
					$imageModel->url = $imgArray[$i];
					$imageModel->save();

					if($i == 0)
					{
						Image::load(FILEPATH . 'clippings/' . $clipping->id . '/' .$imageModel->url)
							->crop_resize(200, 300)
							->save(FILEPATH . 'clippings/' . $clipping->id . '/' . 'thumb.jpg');
					}
				}

				$clipping->thumb = 'thumb.jpg';
				$clipping->pdf_url = $generator->pdfUrl;
				$clipping->save();
			}

			if(isset($errors) && count($errors) > 0)
			{	
				$this->template->set_global('errors', $errors);		
			}
			else
			{
				Response::redirect('clipping/index');	
			}
		}

		$this->template->set_global('customers', $customers);
		$this->template->set_global('labels', $labels);
		$this->template->title = "Clippings";
		$this->template->content = View::forge('clipping/create');
	}

	public function action_edit($id = null)
	{
		$clipping = Model_Clipping::find($id);
		$image = Model_Image::find()
					->where('clipping_id', '=', $clipping->id)
					->order_by('id')
					->get_one();
		$labels = Model_Label::find('all');
		$customers = Model_Customer::find('all');

		
		if(Input::method() == 'POST')
		{
			$val = Model_Clipping::validate('create');
			$errors = array();

			if($val->run() == false)
			{
				$errors = $val->errors();
			}
			else
			{
				$publicationdate = Input::post('publicationdate');
				list($month, $day, $year) = explode('/', $publicationdate);
				$publicationStamp = mktime(0, 0, 0, $month, $day, $year);
				
				$clipping->name = Input::post('name');
				$clipping->label_id = Input::post('label_id');
				$clipping->description = Input::post('description');
				$clipping->customer_id = Input::post('customer_id');
				$clipping->publicationdate = $publicationStamp;
				$clipping->save();

				if(Upload::is_valid())
				{
					Upload::save();
					$uploadInfo = Upload::get_files();

					//remove old stuff
					$result = Model_Image::find()
							  ->where('clipping_id', '=', $clipping->id)
							  ->delete();
					$result = Model_Pdf::find()
							  ->where('clipping_id', '=', $clipping->id)
							  ->delete();	
					try{
						File::delete_dir(FILEPATH.'clippings/' .$clipping->id);
					}catch(InvalidPathException $e){

					};

					//add new stuff
					$generator = new Generator($clipping->id, $uploadInfo[0]['saved_as']);

					$pdfModel = new Model_Pdf();
					$pdfModel->clipping_id = $clipping->id;
					$pdfModel->url = $generator->pdfUrl;
					$pdfModel->save();

					$imgArray = $generator->imgArr;
					
					for($i=0; $i < count($imgArray); $i++)
					{
						$imageModel = new Model_Image();
						$imageModel->clipping_id = $clipping->id;
						$imageModel->url = $imgArray[$i];
						$imageModel->save();

						if($i == 0)
						{
							Image::load(FILEPATH . 'clippings/' . $clipping->id . '/' .$imageModel->url)
							->crop_resize(200, 300)
							->save(FILEPATH . 'clippings/' . $clipping->id . '/' . 'thumb.jpg');
						}
					}

					$clipping->thumb = 'thumb.jpg';
					$clipping->pdf_url = $generator->pdfUrl;
					$clipping->save();
				}
			}

			if(isset($errors) && count($errors) > 0)
			{	
				$this->template->set_global('errors', $errors);		
			}
			else
			{
				Response::redirect('clipping/index');	
			}
		}

		$this->template->set_global('customers', $customers);
		$this->template->set_global('labels', $labels);
		$this->template->set_global('image', $image);
		$this->template->set_global('clipping', $clipping);
		$this->template->title = "Clippings";
		$this->template->content = View::forge('clipping/edit');
	}

	public function action_delete($id = null)
	{
		if ($clipping = Model_Clipping::find($id))
		{
			$clipping->delete();
			Session::set_flash('success', 'Deleted clipping #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete clipping #'.$id);
		}

		Response::redirect('clipping');

	}


}