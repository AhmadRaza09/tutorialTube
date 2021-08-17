<?php

namespace App\Controllers;
use  App\Models\UserModel;
 use  App\Models\SeriesModel;
 use  App\Models\SeriesPriceModel;
 use  App\Models\TutorialModel;
 use  App\Models\CommentModel;
 use  App\Models\FeedbackModel;
 use  App\Models\VoucherModel;
 use App\Libraries\Pdf;
class Series extends BaseController
{
	public function index()
	{
		$data['title'] = "Create Series";
		if($this->request->getMethod()=="post")
		{
			// print_r($_POST);die;
			
			helper(['form']);
			$rules = [
				'seriesName'=>[
					'label'=>'Series Name',
					'rules'=>'required|min_length[15]|max_length[50]|alpha_space'
				],


				'seriesType'=>[
					'label'=>'Series Type', 
					'rules'=>'required|in_list[1,2]',
					'errors'=>[
						'in_list'=>"The Series type must be of Computer Secince or Information Technology"
					]
				],

				'seriesCategory'=>[
					'label'=>'Series Category', 
					'rules'=>'required|in_list[1,2]',
					'errors'=>[
						'in_list'=>"The Series Category must be of Free or Paid Category"
					]
				],

				'seriesDescription'=>[
					'label'=>'Series Description', 
					'rules'=>'required|min_length[250]|max_length[2000]'
				],

				'seriesImage'=>[
					'label'=>'Series Image', 
					'rules'=>'uploaded[seriesImage]|is_image[seriesImage]|ext_in[seriesImage,jpg,jpeg,png]|max_size[seriesImage,400]',
					'errors'=>[
						'uploaded'=>"The Series Image is required",
						'ext_in'=>'The Series Image must be of jpg or png',
						'max_size'=>'The Series Image size must be less then 400kb',
						
					]
				],

			];

			

			if(isset($_POST['seriesPrice']))
			{
				$rules['seriesPrice'] = [
					'label'=>'Series Price', 
					'rules'=>'required|integer|greater_than[499]'
				];
			}
			
			

			if($this->validate($rules))
			{
				$image = $this->request->getFile('seriesImage');
				
				// echo "<pre>";
				// print_r($image);echo "<br>";
				if($image->isValid() && !$image->hasMoved())
				{
					$uniqueImageName = $image->getRandomName();
					$image->move("./uploads/images", $uniqueImageName);
					
				}

				$session = \Config\Services::session();
				$role = $_SESSION['login']['role'];

				$status = $role == 3 ? 2 : 0;
				// echo $status;die;
				 
				$saveSeriesData = [
					'seriesName'=>$this->request->getVar('seriesName'),
					'seriesType'=>$this->request->getVar('seriesType'),
					'seriesCategory'=>$this->request->getVar('seriesCategory'),
					'seriesDescription'=>$this->request->getVar('seriesDescription'),
					'seriesImage'=>$uniqueImageName,
					'seriesUploadedBy'=>$_SESSION['login']['id'],
					'status'=>$status
				];

				$saveSeries = new SeriesModel();
				
				$saveSeries->save($saveSeriesData);

				// print_r($saveSeriesData);
				// echo "<br>";
				if(isset($_POST['seriesPrice']))
				{

					$db = \Config\Database::connect();
					$seriesId = $db->insertID();
					$db->close();

					$saveSeriesPriceData = [
						'seriesId'=>$seriesId,
						'seriesPrice'=>$this->request->getVar('seriesPrice')
					];

					$saveSeriesPrice = new SeriesPriceModel();
					$saveSeriesPrice->save($saveSeriesPriceData);
					// print_r($saveSeriesPriceData);
				}
				
				
				
				if($role == 3)
				{
					$session->setFlashdata('confirmMail', 'Thanks for creating series ' . "<a href='/tutorialTube/public/series/uploadByMe' class='alert-link'>Your series show here</a>");
					return redirect()->to('/tutorialTube/public/Admin/AdminClass');
				}
				else
				{
					$session->setFlashdata('confirmMail', 'Thanks for creating series now wait for admin approval ' . "<a href='/tutorialTube/public/series/uploadByMe' class='alert-link'>Your series show here</a>");
					return redirect()->to('/tutorialTube/public/User');
				}
			}
			else
			{
				// print_r($_POST);die;
				$data['validation'] = $this->validator;
				echo view('seriesForm',$data);
				die;
			}
			// print_r($_POST);
			// echo "Ahmad";
			// die;
		}
		
		echo view('seriesForm', $data);
	}

	function freeSeries()
	{
		$data['title'] = "Free Series";
		$data['quotation'] = [
			'lable1'=>"A Good education is a foundation for a better future; We warmly Welcome to all of you in the Tutorial Tube Website...",
			'lable2'=>"Best Series For the Fields of Computer Science and Information Technology",
			'lable3'=>"Both the Series of Free and Paid are Available",
			'lable4'=>"A Plateform for both Teaching as well as Learning"
		];
		helper(['form']);
		
	if($this->request->getMethod()=="post" && isset($_POST['check']))
	{
		
		// print_r($_POST);die;
		$_GET['page'] = isset($_POST['page']) ? $_POST['page']: 1;
		
		//get free series
		$pager = \Config\Services::pager();
		$freeSeries = new SeriesModel();
		$where = ['seriesCategory'=>'1', 'status'=>'2'];

		//  print_r($_POST);die;
		if(isset($_POST['seriesType']) && isset($_POST['check']))
		{
			// echo "Ahmad";die;
			
			
			if($this->request->getVar('seriesName') != "")
			{
				$rules['seriesName'] = [
					'label'=>'Series Name',
				'rules'=>'required|min_length[15]|max_length[50]|alpha_space'
				];
			}
			if($this->request->getVar('seriesType') != "")
			{
				$rules['seriesType'] = [
					'label'=>'Series Type', 
				'rules'=>'required|in_list[1,2]',
				'errors'=>[
					'in_list'=>"The Series type must be of Computer Secince or Information Technology"
				]
				];
				
			}
			if($this->request->getVar('seriesCategory') != "")
			{
				$rules['seriesCategory'] = [
					'label'=>'Series Category', 
				'rules'=>'required|in_list[1,2]',
				'errors'=>[
					'in_list'=>"The Series Category must be of Free or Paid Category"
				]
				];
				
			}
		
			
				if($this->validate($rules))
				{
					$where = [];
					
					if($this->request->getVar('seriesName') != "")
					{
						$where['seriesName'] = $this->request->getVar('seriesName');
					}
					if($this->request->getVar('seriesType') != "")
					{
						 $where['seriesType'] = $this->request->getVar('seriesType');
					}
					if($this->request->getVar('seriesCategory') != "")
					{
						 $where['seriesCategory'] = $this->request->getVar('seriesCategory');
					}
					
					// $where["seriesCategory"] = "1";
					$where["status"] = "2";
				}
				else
				{	
						$validation = $this->validator;
						$output = "";
						$output .= "<div class='mt-sm-1 mt-0 mb-sm-2 mb-3 alert alert-danger alert-dismissible fade show text-muted' role='alert'>";
						$output .= $validation->listErrors();
						$output .="<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
						$output .= "</div>";
						$data = ['1', $output];
						echo json_encode($data);
						die;
				}

		}
		
			$series = $freeSeries->where($where)->paginate(8);
			// echo "<pre>";
			// echo ($series);die;
			$pagination =  $freeSeries->pager;
			
			$links = $pagination->links();
			$output = $this->html($series);

			$output .= "<div id='seriesPagination' class='col-12 mt-3 clearfix'>
			$links
			</div> ";
			$data = ['2', $output];
			echo json_encode($data);
			die;
		}

		echo view('freeSeries', $data);
	}

	function paidSeries()
	{
		$data['title'] = "Paid Series";
		$data['quotation'] = [
			'lable1'=>"A Good education is a foundation for a better future; We warmly Welcome to all of you in the Tutorial Tube Website...",
			'lable2'=>"Best Series For the Fields of Computer Science and Information Technology",
			'lable3'=>"Both the Series of Free and Paid are Available",
			'lable4'=>"A Plateform for both Teaching as well as Learning"
		];
		helper(['form']);
		
	if($this->request->getMethod()=="post" && isset($_POST['check']))
	{
		
		// print_r($_POST);die;
		$_GET['page'] = isset($_POST['page']) ? $_POST['page']: 1;
		
		//get free series
		$pager = \Config\Services::pager();
		$paidSeries = new SeriesModel();
		$where = ['seriesCategory'=>'2', 'status'=>'2'];

		//  print_r($_POST);die;
		if(isset($_POST['seriesType']) && isset($_POST['check']))
		{
			// echo "Ahmad";die;
			
			
			if($this->request->getVar('seriesName') != "")
			{
				$rules['seriesName'] = [
					'label'=>'Series Name',
				'rules'=>'min_length[15]|max_length[50]|alpha_space'
				];
			}
			if($this->request->getVar('seriesType') != "")
			{
				$rules['seriesType'] = [
					'label'=>'Series Type', 
				'rules'=>'in_list[1,2]',
				'errors'=>[
					'in_list'=>"The Series type must be of Computer Secince or Information Technology"
				]
				];
				
			}
			if($this->request->getVar('seriesCategory') != "")
			{
				$rules['seriesCategory'] = [
					'label'=>'Series Category', 
				'rules'=>'in_list[1,2]',
				'errors'=>[
					'in_list'=>"The Series Category must be of Free or Paid Category"
				]
				];
				
			}
		
			
				if($this->validate($rules))
				{
					$where = [];
					
					if($this->request->getVar('seriesName') != "")
					{
						$where['seriesName'] = $this->request->getVar('seriesName');
					}
					if($this->request->getVar('seriesType') != "")
					{
						 $where['seriesType'] = $this->request->getVar('seriesType');
					}
					if($this->request->getVar('seriesCategory') != "")
					{
						 $where['seriesCategory'] = $this->request->getVar('seriesCategory');
					}
					
					// $where["seriesCategory"] = "1";
					$where["status"] = "2";
				}
				else
				{	
						$validation = $this->validator;
						$output = "";
						$output .= "<div class='mt-sm-1 mt-0 mb-sm-2 mb-3 alert alert-danger alert-dismissible fade show text-muted' role='alert'>";
						$output .= $validation->listErrors();
						$output .="<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
						$output .= "</div>";
						$data = ['1', $output];
						echo json_encode($data);
						die;
				}

		}
		
			$series = $paidSeries->where($where)->paginate(8);
			$pagination =  $paidSeries->pager;
			$links = $pagination->links();
			// echo "<pre>";
			// print_r($series);die;

			$output = $this->html($series);
			 $output .= "<div id='seriesPagination' class='col-12 mt-3 clearfix'>
			$links
			</div> ";
			$data = ['2', $output];
			echo json_encode($data);
			die;
		}

		echo view('freeSeries', $data);
		
	}

	function uploadByMe()
	{
		$data['title'] = "Upload By ME";
		$data['quotation'] = [
			'lable1'=>"A Good education is a foundation for a better future; We warmly Welcome to all of you in the Tutorial Tube Website...",
			'lable2'=>"Best Series For the Fields of Computer Science and Information Technology",
			'lable3'=>"Both the Series of Free and Paid are Available",
			'lable4'=>"A Plateform for both Teaching as well as Learning"
		];
		if($this->request->getMethod()=="post")
		{
			// echo "Ahmad";die;

			$_GET['page'] = isset($_POST['page']) ? $_POST['page']: 1;
			
			//get free series
			$pager = \Config\Services::pager();
			$paidSeries = new SeriesModel();

			$session = \Config\Services::session();
			$id =  $_SESSION['login']['id'];

			$series = $paidSeries->where(['seriesUploadedBy'=>$id, 'status'=>'2'])->paginate(8);
			$pagination =  $paidSeries->pager;
			$links = $pagination->links();
			// echo "<pre>";
			// print_r($series);die;

			
			$me = true; 

			$output = $this->html($series, $me);
			 $output .= "<div id='seriesPagination' class='col-12 mt-3 clearfix'>
			$links
			</div> ";
			$data = ['2', $output];
			echo json_encode($data);
			die;
		}

		echo view('freeSeries', $data);
		
	}

	function seriesDetail($id)
	{
		
		// echo $id;die;
		$data['title'] = "Series Detail";
		$seriesModel = new SeriesModel();
		$series = $seriesModel->find($id);
		// print_r($series);die;
		if($series['seriesCategory'] == 2 )
		{
			$seriesPriceModel = new SeriesPriceModel();
			$seriesPrice = $seriesPriceModel->where('seriesId', $id)->first();
			$voucherModel = new VoucherModel;
			$voucherApproved = $voucherModel->where(['seriesId'=>$id, 'status'=>2])->findColumn('status');
			
			// echo "<pre>";
			// print_r($voucherApproved);
			// die;
			$data['voucherApproved'] = false;
			if($voucherApproved != null)
			{
				$data['voucherApproved'] = $voucherApproved[0] == 2 ? true : false;
			}
			$series['seriesPrice'] = $seriesPrice['seriesPrice'];
		}
		$data['series'] = $series;
		// print_r($data['series']);die;

		return view('seriesDetail', $data);
	}

	function uploadTutorial($seriesId)
	{
		
		$data['title'] = "Upload Tutorial";

		//series id for the lectures
		$data['seriesId'] = $seriesId;
		


		if($this->request->getMethod()=="post")
		{
			// print_r($_POST);die;
			
			//validation rules
			helper(['form']);
			$rules = [
				'tutorialTitle'=>[
					'label'=>'Tutorial Title',
					'rules'=>'required|min_length[15]|max_length[50]|alpha_space'
				],


				'tutorialPath'=>[
					'label'=>'Tutorial Path', 
					'rules'=>'uploaded[tutorialPath]|ext_in[tutorialPath,mp4,ogg,webm]',
					'errors'=>[
						'uploaded'=>"The Tutorial is required",
						'ext_in'=>'The Tutorial must be of mp4, webm or ogg extension',
						
					]
				],

			];

			//if rules validate then save tutorial and tutorial data
			if($this->validate($rules))
			{
				$tutorial = $this->request->getFile('tutorialPath');
				
				// echo "<pre>";
				// print_r($image);echo "<br>";
				if($tutorial->isValid() && !$tutorial->hasMoved())
				{
					$uniqueTutorialName = $tutorial->getRandomName();
					$tutorial->move("./uploads/tutorial", $uniqueTutorialName);
					
				}

				//get all data that belong to the tutorial
				$saveTutoraialData = [
					"tutorialTitle" => $this->request->getVar('tutorialTitle'),
					"tutorialPath"=>$uniqueTutorialName,
					'seriesId'=>$seriesId
				];

				//create tutorial model
				$tutorialModel = new TutorialModel();
				$tutorialModel->save($saveTutoraialData);

				//save message to show in the UI
				$session = \Config\Services::session();
				
				$session->setFlashdata('message', 'Your tutorial is Uploaded on Tutorial Tube');
				return redirect()->to('/tutorialTube/public/series/course/' . $seriesId);
			}
			else	//if rule fails then save errors and show in UI
			{
				// print_r($_POST);die;
				$data['validation'] = $this->validator;
				echo view('tutorialForm',$data);
				die;
			}

		}

		return view("tutorialForm", $data);
	}

	//helper function for the creating card for series
	private function html($data, $me = false)
	{
		 $output = "";
		if(isset($data[0]))
		{
		
	   //  foreach start
		   foreach($data as $series)
		   {
			 // echo "<pre>";
			 // print_r($course);
			 // echo "</pre>";
			 // echo "<br>";
				 
		
		  
		 $output .= "<div class='col-xl-2 col-lg-4 col-sm-6 me-xxl-4 me-xl-5 mt-3 '>
		 <div class='card' style='width: 18rem;'>
				 <img src='/tutorialTube/public/uploads/images/{$series['seriesImage']}'  class='card-img-top cardImageHeight' alt='course-logo'>
				 <div class='card-body'>
				   <h5 class='card-title cardTitle' >{$series['seriesName']}</h5>
				   <p class='card-text cardDescription' >{$series['seriesDescription']}</p>
				   <div class='text-end'><a href='/tutorialTube/public/Series/seriesDetail/{$series['seriesId']}' class='btn btn-primary'>Read more</a></div>
				 </div>
			   </div>
			 </div>";
		   
		
		   }
		}
		else
		{
			$message = $me == true ? "You have not uploaded any Series yet" : "Series will be uploaded soon......";
		 $output .= "<div class='col-md-10 text-center col-12 fs-2'>
		 <div class='alert alert-primary' role='alert'>
		 $message
		 </div>
		 </div>";
   
		}
		return $output;
		
	}

	

	
	function createpdf($seriesId)
	{
		
		//get series name and series Price
		$seriesModel = new SeriesModel();
		$result = $seriesModel->getVoucherDetail($seriesId);
	
		
		//get user id and user name
			$session = \Config\Services::session();
			$userId = $_SESSION['login']['id'];
			$name = $_SESSION['login']['name'];

			//get date for the voucher
			$createdDate = date("Y-m-d");
			$dueDate = date('Y-m-d', strtotime($createdDate. ' + 10 days'));

			//get all detail for the voucher
			$saveVoucher = [
				'userId'=> $userId,
				'seriesId'=>$seriesId,
				'createdDate'=>$createdDate,
				'dueDate'=>$dueDate,
				'status'=>0
			];
				// print_r($result);die;
				// print_r($seriesName);
			// print_r($saveVoucher);

			//save voucher detail
			$voucherModel = new VoucherModel();
			$exist = $voucherModel->where(['userId'=>$userId, 'seriesId'=>$seriesId])->first();
			
			if($exist == null)
			{
				$voucherModel->save($saveVoucher);
				
				//get the id of the saved voucher
				$db = \Config\Database::connect();
				$number = $db->insertID();
				$db->close();
			}
			else
			{
				$number = $exist['voucherId'];
			}
			



			//add leading zeros for voucher id
			
			$voucherId = substr(str_repeat(0, 8).$number, - 8);


			$pdf = new PDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
			// create new PDF document


			// set document information
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('Nicola Asuni');
			$pdf->SetTitle('Tutorial Tube Voucher');
			$pdf->SetSubject('TCPDF Tutorial');
			$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

			$pdf->setPrintHeader(false);

			// set default header data

			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

			// set margins
			$pdf->SetMargins(10, 10, PDF_MARGIN_RIGHT);


			// set auto page breaks


			// set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			// set some language-dependent strings (optional)
			if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
			require_once(dirname(__FILE__).'/lang/eng.php');
			$pdf->setLanguageArray($l);
			}

			// ---------------------------------------------------------

			$pdf->setCellPaddings(1, 1, 1, 1);

			// set cell margins
			$pdf->setCellMargins(1, 0, 1, 0);

			// set font
			$pdf->SetFont('dejavusans', '', 10);

			// add a page
			$pdf->AddPage();

			// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
			// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

			// create some HTML content
			// add a page
			$html = '<div style=" width:50%; margin:auto">
			<table style=" width:100%;">

			<tr style="text-align: left; ">
				<th style="width:170px;" ><img src="/tutorialTube/public/img/cover.png" alt="" style="width:120px;"></th>
				<th colspan="2" style=" width:490px; text-align: left;">
				<h2>
				<br>
				Fee Recipient by Tutorial Tube</h2>
				</th>
				
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;"><h1>Tutorial Tube Copy</h1></td>
			</tr>
			<tr>
				<td colspan="2">Created Date:
					<span>'.$createdDate.'</span>
				</td>
			
				<td style="text-align: right;">Due Date:
				<span>'.$dueDate.'</span></td>
			</tr>
			<tr>
				
				<td colspan="3" style="text-align: center;">
					<b>
					Voucher ID:
					<span>'.$voucherId.'</span>
						</b>
				</td>
					
			</tr>
			<tr>
				<td colspan="2">Student Name:
					<span>'.$name.'</span>
				</td>
				
				<td style="text-align: right;" >Course Name:
				<span>'.$result['seriesName'].'</span></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td  style="text-align: right;"><b>
					Total Fee:
				<span>'.$result['seriesPrice'].'</span>
			</b>
				</td>
			</tr>
			<tr>
				<td colspan="3"><hr></td>
			</tr>

			<tr style="text-align: left; ">
				<th style="width:170px;" ><img src="/tutorialTube/public/img/cover.png" alt="" style="width:120px;"></th>
				<th colspan="2" style=" width:490px; text-align: left;">
				<h2>
				<br>
				Fee Recipient by Tutorial Tube</h2>
				</th>
				
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;"><h1> Student Copy</h1></td>
			</tr>
			<tr>
				<td colspan="2">Created Date:
					<span>'.$createdDate.'</span>
				</td>
				
				<td style="text-align: right;">Due Date:
				<span>'.$dueDate.'</span></td>
			</tr>
			<tr>
				
				<td colspan="3" style="text-align: center;">
					<b>
					Voucher ID:
					<span>'.$voucherId.'</span>
						</b>
				</td>
					
			</tr>
			<tr>
				<td colspan="2">Student Name:
					<span>'.$name.'</span>
				</td>
				
				<td style="text-align: right;" >Course Name:
				<span>'.$result['seriesName'].'</span></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td  style="text-align: right;"><b>
					Total Fee:
				<span>'.$result['seriesPrice'].'</span>
			</b>
				</td>
			</tr>
			<tr>
				<td colspan="3"><hr></td>
			</tr>

			<tr style="text-align: left; ">
				<th style="width:170px;" ><img src="/tutorialTube/public/img/cover.png" alt="" style="width:120px;"></th>
				<th colspan="2" style=" width:490px; text-align: left;">
				<h2>
				<br>
				Fee Recipient by Tutorial Tube</h2>
				</th>
				
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;"><h1>Bank Copy</h1></td>
			</tr>
			<tr>
				<td colspan="2">Created Date:
					<span>'.$createdDate.'</span>
				</td>
				
				<td style="text-align: right;">Due Date:
				<span>'.$dueDate.'</span></td>
			</tr>
			<tr>
				
				<td colspan="3" style="text-align: center;">
					<b>
					Voucher ID:
					<span>'.$voucherId.'</span>
						</b>
				</td>
					
			</tr>
			<tr>
				<td colspan="2">Student Name:
					<span>'.$name.'</span>
				</td>
				
				<td style="text-align: right;" >Course Name:
				<span>'.$result['seriesName'].'</span></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td  style="text-align: right;"><b>
					Total Fee:
				<span>'.$result['seriesPrice'].'</span>
			</b>
				</td>
			</tr>
			

			</table>

			</div>';
			$pdf->writeHTML($html, true, false, true, false, '');
			//Close and output PDF document
			$this->response->setHeader("Content-Type", "application/pdf");
			echo $pdf->Output('Voucher.pdf', 'D');

			//============================================================+
			// END OF FILE
		//============================================================+
		
		
	}

	function course($id)
	{
		//
		$data['title'] = "Course";

		//get series name 
		$seriesModel = new SeriesModel();
		$data['seriesName'] = $seriesModel->where('seriesId', $id)->findColumn('seriesName');
		
		//get all tutorial detail that belongs to the particular series
		$tutorialModel = new TutorialModel();
		$data['tutorials'] = $tutorialModel->where('seriesId', $id)->findAll();
		// echo "<pre>";
		// print_r($data['tutorials']);
		// die;
		 
		return view('course', $data);
	}

	//jquery
	function comment()
	{
		//get all comments for the particular tutorial
		$commentModel  = new CommentModel();
		$result = $commentModel->getAllComment($_POST['id']);
		// echo 1;die;

		//return to ajax
		echo json_encode($result);die;
	}

	//jquery
	function feedback()
	{
		//get view like dislike and also get the particular user like or dislike the tutorial
		$feedbackModel = new FeedbackModel();
		$myFeedback = $feedbackModel->where(['tutorialId'=>$_POST['tutorialId'], 'userId'=>$_POST['userId']])->findColumn('tutorialLike');
		
		//if user not like or dislike tutorial then save 0
		$result['myFeedback'] = isset($myFeedback[0])? $myFeedback[0] : 0;

		//get all views
		$views = $feedbackModel->views($_POST['tutorialId']);
		$result['views'] = $views['views'];

		//get all like
		$like = $feedbackModel->getFeedback($_POST['tutorialId'], 1);
		$result['like'] = $like['feedback'];

		//get all dislkie
		$dislike = $feedbackModel->getFeedback($_POST['tutorialId'], 2);
		$result['dislike'] = $dislike['feedback'];

		//return to ajax
		echo json_encode($result);die;
	}

	//jquery
	function addComment()
	{
		//add comment
		$commentModel  = new CommentModel();
		$commentModel->save($_POST);
	}

	function addFeedback()
	{
		//add view, like or dilkie of the particular user
		$feedbackModel  = new feedbackModel();

		//if type 1 then view else like or dislike
		if($_POST['type'] == 1)
		{
			//get data for view
			$data =  [
				'tutorialId'=>$_POST['tutorialId'],
				'userId'=>$_POST['userId'],
				'tutorialWatchCount'=>1,
				'tutorialLike'=>0,
			];

			//check is view already store
			$result = $feedbackModel->where(['tutorialId'=>$_POST['tutorialId'], "userId"=>$_POST['userId']])->first();
			if($result == null)
			{
				$feedbackModel->save($data);
			}
			// print_r($result);die;
			// echo "type" .  $_POST['type'];
			die;
		}
		else if($_POST['type'] == 2)
		{
			$feedbackModel
			->where(['tutorialId'=>$_POST['tutorialId'], "userId"=>$_POST['userId']])
			->set(['tutorialLike' => $_POST['feedback']])
			->update();
			// echo "type" .  $_POST['type'];
			die;
		} 
		
	}

	function submitVoucher()
	{
		
		$data['title'] = "Submit Voucher";

		$session = \Config\Services::session();
		$userId = $_SESSION['login']['id'];

		//get the voucher record for the specific user
		$voucherModel = new VoucherModel();
		$where = ['userId'=>$userId];
		$data['voucherDetail'] = $voucherModel->getSubmitVoucherDetail($where);

		if($this->request->getMethod()=='post')
		{
			// print_r($_POST);
			// print_r($_FILES);
			// die;
			helper(['form']);
			$rules = [

				'file'=>[
					'label'=>'Voucher Image', 
					'rules'=>'uploaded[file]|is_image[file]|ext_in[file,jpg,jpeg,png]',
					'errors'=>[
						'uploaded'=>"The Voucher Image is required",
						'ext_in'=>'The Voucher Image must be of jpg or png',
						
					]
				],

			];

			if($this->validate($rules))
			{
				$image = $this->request->getFile('file');
				
				// echo "<pre>";
				// print_r($image);echo "<br>";
				if($image->isValid() && !$image->hasMoved())
				{
					$uniqueImageName = $image->getRandomName();
					$image->move("./uploads/voucher", $uniqueImageName);	
				}
				
				$saveVoucherData = [
					'status'=>1,
					'voucherPath'=>$uniqueImageName
				];
				$voucherModel->update($this->request->getVar('voucherId'), $saveVoucherData);
				
				//get the updated voucher record
				$data['voucherDetail'] = $voucherModel->getSubmitVoucherDetail($where);
			}
			else
			{
				$data['validation'] = $this->validator;
				echo view('submitVoucher',$data);
				die;
			}
			
			
		}
	
		// print_r($data);die;

		return view('submitVoucher', $data);
	}


}

