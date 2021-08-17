<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use  App\Models\UserModel;
use  App\Models\SeriesModel;
use  App\Models\VoucherModel;
class AdminClass extends BaseController
{
	public function index()
	{
		$data['title']= 'Dashboard';

		//get count for all the request
		$seriesModel  = new SeriesModel();

		$data['users'] = $seriesModel->getCount('users', 1);

		$data['series'] = $seriesModel->getCount('series', 0);

		$data['vouchers'] = $seriesModel->getCount('voucher', 0);
		
		echo view('Admin/dashboard', $data);
	}

	function pendingUserRequest()
	{
		//sote pageLink for ajax request to different link with same view
		$data= [
			'title'=>"Pending Users Request",
			'pageLink'=>"/tutorialTube/public/Admin/AdminClass/pendingUserRequest"	
		];

		//shote btn name and id
		$lable = [
			'id1'=>"Accept",
			'id2'=>"Reject",
			'btn1'=>'Accept',
			'btn2'=>'Reject',
			'heading'=>"Pending User Request",
			'status'=>1
		];

		if($this->request->getMethod()=="post")
		{
			
			$results = $this->helperUserRequest($lable);
			echo $results;
			die;
		}
		// print_r($results);
		// echo "<pre>";
		// print_r($link);
		// echo "</pre>";
		// echo $link->links(); 
		// die;
		return view('Admin/userRequest',$data);
	}
	
	function acceptedUser()
	{
		$data= [
			'title'=>"Accepted Users",
			'pageLink'=>"/tutorialTube/public/Admin/AdminClass/acceptedUser"	
		];

		$lable = [
			'id2'=>"Delete",
			'btn2'=>'Delete',
			'heading'=>"Accepted User",
			'status'=>2,
			'type'=>1
		];

		if($this->request->getMethod()=="post")
		{
			
			$results = $this->helperUserRequest($lable);
			echo $results;
			die;
		}
		// print_r($results);
		// echo "<pre>";
		// print_r($link);
		// echo "</pre>";
		// echo $link->links(); 
		// die;
		return view('Admin/userRequest',$data);
	}

	function rejectedUserRequest()
	{
		$data= [
			'title'=>"Rejected Users Request",
			'pageLink'=>"/tutorialTube/public/Admin/AdminClass/rejectedUserRequest"	
		];

		$lable = [
			'id1'=>"Accept",
			'id2'=>"Delete",
			'btn1'=>'Accept',
			'btn2'=>'Delete',
			'heading'=>"Rejected User Request",
			'status'=>3
		];

		if($this->request->getMethod()=="post")
		{
			
			$results = $this->helperUserRequest($lable);
			echo $results;
			die;
		}
		// print_r($results);
		// echo "<pre>";
		// print_r($link);
		// echo "</pre>";
		// echo $link->links(); 
		// die;
		return view('Admin/userRequest',$data);
	}
	
	

	
//jquery for user
	function accept()
	{

		$userModel = new UserModel;
		$update = [
			'status'=>'2'
		];

		//update status
		$userModel->update($_POST['id'], $update);

		//get the user record to send mail
		$results = $userModel->where('id', $_POST['id'])->first();
		// print_r($results);die; 

		//store message that mail send
		echo $output =  "<div class='mt-xl-3 mt-md-2 mt-sm-4 mt-3 mb-sm-2 mb-1 alert alert-success alert-dismissible fade show text-muted' role='alert'>
		Your mail send Successfully
		 <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
		 </div>";
		 
		$email = \Config\Services::email();
		$email->setFrom('zohaibrazamul1122@gmail.com', 'Tutorial Tube');
                $email->setTo($results['email']);
				// $email->setTo('raza3088682050@gmail.com');
                // $email->setCC('another@another-example.com');
                // $email->setBCC('them@their-example.com');
			
				$email->setSubject('Account Approved');
				$email->setMessage('Thank you for registeration your account is approved. Now you are able to access the functionality of registered user');
                
				$email->send();
		
	}

	//jquery for user
	function delete()
	{
		// echo $_POST['message'];
		// die;
		$userModel = new UserModel;
		$update = [
			'status'=>'4'
		];

		//update status
		$userModel->update($_POST['id'], $update);

		//get the user record to send mail
		$results = $userModel->where('id', $_POST['id'])->first();
		
		//store the message mail send
		echo $output =  "<div class='mt-xl-3 mt-md-2 mt-sm-4 mt-3 mb-sm-2 mb-1 alert alert-success alert-dismissible fade show text-muted' role='alert'>
		Your mail send Successfully
		 <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
		 </div>";

		 $email = \Config\Services::email();
		$email->setFrom('zohaibrazamul1122@gmail.com', 'Tutorial Tube');
                $email->setTo($results['email']);
				// $email->setTo('raza3088682050@gmail.com');
                // $email->setCC('another@another-example.com');
                // $email->setBCC('them@their-example.com');
			
				$email->setSubject('Account Deleted');
				$email->setMessage($_POST['message']);
                
				$email->send();
	}

	//jquery for user
	function reject()
	{
		// echo $_POST['message'];
		// die;
		$userModel = new UserModel;
		$update = [
			'status'=>'3'
		];

		//update status
		$userModel->update($_POST['id'], $update);

		//get the user record to send mail
		$results = $userModel->where('id', $_POST['id'])->first();
		
		//store the message mail send
		echo $output =  "<div class='mt-xl-3 mt-md-2 mt-sm-4 mt-3 mb-sm-2 mb-1 alert alert-success alert-dismissible fade show text-muted' role='alert'>
		Your mail send Successfully
		 <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
		 </div>";

		 $email = \Config\Services::email();
		$email->setFrom('zohaibrazamul1122@gmail.com', 'Tutorial Tube');
                $email->setTo($results['email']);
				// $email->setTo('raza3088682050@gmail.com');
                // $email->setCC('another@another-example.com');
                // $email->setBCC('them@their-example.com');
			
				$email->setSubject('Account Rejected');
				$email->setMessage($_POST['message']);
                
				$email->send();
	}

	
	function pendingSeriesRequest()
	{
	
		//store pageLink for ajax 
		$data = [
			'title'=>"Pending Series Request",
			'pageLink'=>'/tutorialTube/public/Admin/AdminClass/pendingSeriesRequest'
		];

		 $lable = [
			'id1'=>"AcceptSeries",
			'id2'=>"RejectSeries",
			'btn1'=>'Accept',
			'btn2'=>'Reject',
			'heading'=>"Pending Series Request",
			'status'=>0
		];
		if($this->request->getMethod()=="post")
		{
			$results = $this->helperSeriesRequest($lable);
			echo $results;
			die;
		}
		
		return view('Admin/seriesRequest',$data);
	}

	
	function acceptedSeries()
	{
		
		$data = [
			'title'=>"Pending Series Request",
			'pageLink'=>'/tutorialTube/public/Admin/AdminClass/acceptedSeries'
		];

		 $lable = [
			'id2'=>"DeleteSeries",
			'btn2'=>'Delete',
			'heading'=>"Accepted Series",
			'status'=>2,
			'type'=>1
		];
		
		if($this->request->getMethod()=="post")
		{
			$results = $this->helperSeriesRequest($lable);
			echo $results;
			die;
		}
		 
		

		
		return view('Admin/seriesRequest',$data);
	}

	
	function rejectedSeriesRequest()
	{
		
		$data = [
			'title'=>"Pending Series Request",
			'pageLink'=>'/tutorialTube/public/Admin/AdminClass/rejectedSeriesRequest'
		];
		$lable = [
			'id1'=>"AcceptSeries",
			'id2'=>"DeleteSeries",
			'btn1'=>'Accept',
			'btn2'=>'Delete',
			'heading'=>"Rejected Series Request",
			'status'=>3
		];
		if($this->request->getMethod()=="post")
		{
			$results = $this->helperSeriesRequest($lable);
			echo $results;
			die;
		}
		 
		

		
		return view('Admin/seriesRequest',$data);
	}

	// jquery for series
	function acceptSeries()
	{

		$seriesModel = new SeriesModel;
		$update = [
			'status'=>'2'
		];

		//update status
		$seriesModel->update($_POST['id'], $update);

		//get the user record to send mail
		$results = $seriesModel->getEmail($_POST['id']);

		//  print_r($results);die; 

		//store message that mail send
		echo $output =  "<div class='mt-xl-3 mt-md-2 mt-sm-4 mt-3 mb-sm-2 mb-1 alert alert-success alert-dismissible fade show text-muted' role='alert'>
		Your mail send Successfully
		 <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
		 </div>";
		 
		$email = \Config\Services::email();
		$email->setFrom('zohaibrazamul1122@gmail.com', 'Tutorial Tube');
                $email->setTo($results['email']);
				// $email->setTo('raza3088682050@gmail.com');
                // $email->setCC('another@another-example.com');
                // $email->setBCC('them@their-example.com');
			
				$email->setSubject('Series Approved');
				$email->setMessage('Thank you for creating series. Your series is approved by admin. Now you can Upload your tutorial');
                
				$email->send();

		
	}

	// jquery for series
	function rejectSeries()
	{
		// echo $_POST['message'];
		// die;
		$seriesModel = new SeriesModel;
		$update = [
			'status'=>'3'
		];

		//update status
		$seriesModel->update($_POST['id'], $update);

		//get the user record to send mail
		$results = $seriesModel->getEmail($_POST['id']);
		
		//store the message mail send
		echo $output =  "<div class='mt-xl-3 mt-md-2 mt-sm-4 mt-3 mb-sm-2 mb-1 alert alert-success alert-dismissible fade show text-muted' role='alert'>
		Your mail send Successfully
		 <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
		 </div>";

		 $email = \Config\Services::email();
		$email->setFrom('zohaibrazamul1122@gmail.com', 'Tutorial Tube');
                $email->setTo($results['email']);
				// $email->setTo('raza3088682050@gmail.com');
                // $email->setCC('another@another-example.com');
                // $email->setBCC('them@their-example.com');
			
				$email->setSubject('Series Rejected');
				$email->setMessage($_POST['message']);
                
				$email->send();
	}

	// jquery for series
	function deleteSeries()
	{
		// echo $_POST['message'];
		// die;
		$seriesModel = new SeriesModel;
		$update = [
			'status'=>'4'
		];

		//update status
		$seriesModel->update($_POST['id'], $update);

		//get the user record to send mail
		$results = $seriesModel->getEmail($_POST['id']);
		
		//store the message mail send
		echo $output =  "<div class='mt-xl-3 mt-md-2 mt-sm-4 mt-3 mb-sm-2 mb-1 alert alert-success alert-dismissible fade show text-muted' role='alert'>
		Your mail send Successfully
		 <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
		 </div>";

		 $email = \Config\Services::email();
		$email->setFrom('zohaibrazamul1122@gmail.com', 'Tutorial Tube');
                $email->setTo($results['email']);
				// $email->setTo('raza3088682050@gmail.com');
                // $email->setCC('another@another-example.com');
                // $email->setBCC('them@their-example.com');
			
				$email->setSubject('Series Deleted');
				$email->setMessage($_POST['message']);
                
				$email->send();
	}


	function generatedVoucherRequest()
	{
	
		//sote pageLink for ajax 
		$data = [
			'title'=>"Generated Voucher Request",
			'pageLink'=>'/tutorialTube/public/Admin/AdminClass/generatedVoucherRequest'
		];

		 $lable = [
			'id2'=>"DeleteVoucher",
			'btn2'=>'Delete',
			'heading'=>"Generated Vouchers Request",
			'type'=>1,
			'status'=>0
		];
		if($this->request->getMethod()=="post")
		{
			$results = $this->helperVoucherRequest($lable);
			echo $results;
			die;
		}
		
		return view('Admin/voucherRequest',$data);
	}

	function submitedVoucherRequest()
	{
	
		//sote pageLink for ajax 
		$data = [
			'title'=>"Submited Voucher Request",
			'pageLink'=>'/tutorialTube/public/Admin/AdminClass/submitedVoucherRequest'
		];

		 $lable = [
			'id1'=>"AcceptVoucher",
			'id2'=>"DeleteVoucherPath",
			'btn1'=>'Accept',
			'btn2'=>'Delete',
			'heading'=>"Submited Vouchers Request",
			'status'=>1
		];
		if($this->request->getMethod()=="post")
		{
			$results = $this->helperVoucherRequest($lable);
			echo $results;
			die;
		}
		
		return view('Admin/voucherRequest',$data);
	}

	//jquery for voucher
	function deleteVoucherPath()
	{
		helper('filesystem');
		$voucherModel = new VoucherModel();
		$results = $voucherModel->where('voucherId', $_POST['voucherId'])->findColumn('voucherPath');
		// print_r($results);
		
		
		$path = 'uploads/voucher/' . $results[0];
		// echo $path;die;
		unlink($path);
		// echo "Ahmad";die;
		$changeStatus = ['status'=>3, 'voucherPath'=>''];
		$voucherModel->update($_POST['voucherId'], $changeStatus);
		echo $output =  "<div class='mt-xl-3 mt-md-2 mt-sm-4 mt-3 mb-sm-2 mb-1 alert alert-success alert-dismissible fade show text-muted' role='alert'>
		Voucher deleted Successfully
		 <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
		 </div>";

	}
	
	//jquery for voucher
	function deleteVoucher()
	{
		// helper('filesystem');
		$voucherModel = new VoucherModel();
		
		$voucherModel->delete($_POST['voucherId']);
		echo $output =  "<div class='mt-xl-3 mt-md-2 mt-sm-4 mt-3 mb-sm-2 mb-1 alert alert-success alert-dismissible fade show text-muted' role='alert'>
		Voucher  record deleted Successfully
		 <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
		 </div>";

	}

	//jquery for voucher
	function acceptVoucher()
	{
		// helper('filesystem');
		$voucherModel = new VoucherModel();
		$changeStatus = ['status'=>2];
		$voucherModel->update($_POST['voucherId'], $changeStatus);
		echo $output =  "<div class='mt-xl-3 mt-md-2 mt-sm-4 mt-3 mb-sm-2 mb-1 alert alert-success alert-dismissible fade show text-muted' role='alert'>
		Voucher Accepted Successfully
		 <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
		 </div>";

	}

	//helper function
	private function helperUserRequest($lable)
	{
		//loadTable with ajax
		
			
			// echo "Razadfs";die;

			//table header
			 $output = "
			<div class='mt-lg-3 mt-sm-2 mt-1 table-responsive d-sm-flex mb-lg-2 mb-1'>
			<table class='table table-light  table-striped table-hover align-middle text-center ms-sm-4 me-sm-4 caption-top'>
			<caption><h1 class='text-dark ms-sm-0 ms-2'>{$lable['heading']}</h1></caption>
			<thead>
			  <tr class='align-middle'>
				<th scope='col' class='pt-3 pb-3'>#</th>
				<th scope='col' class='pt-3 pb-3'>First Name</th>
				<th scope='col' class='pt-3 pb-3'>Last Name</th>
				<th scope='col' class='pt-3 pb-3'>Email</th>
				<th scope='col' class='pt-3 pb-3'>Role</th>
				<th scope='col' class='pt-3 pb-3'>Action</th>
			  </tr>
			</thead>
			<tbody>
			";

			//for pagination
			$pager = \Config\Services::pager();
			

			$userModel = new UserModel();

			//set page no
			$_GET['page'] = isset($_POST['page']) ? $_POST['page']: 1;
			if(isset($_POST['firstName']))
			{
				//validation rules 
				helper(['form']);

				//apply rules if input given other not apply any rule
				if($this->request->getVar('firstName') != "")
				{
					$rules['firstName'] = [
								'label'=>'First Name',
								'rules'=>'min_length[4]|max_length[32]|alpha'
							];
					
				}
				if($this->request->getVar('lastName') != "")
				{
					$rules['lastName'] = [
								'label'=>'Last Name',
								'rules'=>'min_length[4]|max_length[32]|alpha'
							];
					
				}
				if($this->request->getVar('email') != "")
				{
					$rules['email'] = [
								'label'=>'Email',
								'rules'=>'valid_emails'
					];
					
				}

					
					if($this->validate($rules))
					{
						// echo "Ahmad";die;
						//get data on the basis of the user
						$where = ['status'=>"{$lable['status']}", 'role !='=>3];

						//add where clause for filter to fetch data
						if($this->request->getVar('firstName') != "")
						{
							$where['firstName'] = $this->request->getVar('firstName');
						}

						if($this->request->getVar('lastName') != "")
						{
							$where['lastName'] = $this->request->getVar('lastName');
						}

						if($this->request->getVar('email') != "")
						{
							$where['email'] = $this->request->getVar('email');
						}

						
						$results = $userModel->where($where)->paginate(3);
					}
					else	//store validation errors
					{
						// print_r($_POST);die;
						$validation = $this->validator;
						$output = "";
						$output .= "<div class='mt-sm-1 mt-0 mb-sm-2 mb-3 alert alert-danger alert-dismissible fade show text-muted' role='alert'>";
						$output .= $validation->listErrors();
						$output .="<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
						$output .= "</div>";
						$data = ['1', $output];
						return json_encode($data);
						
					}
			}
			else	//if filters not given
			{
				$where = ['status'=>"{$lable['status']}", 'role !='=>3];
				$results = $userModel->where($where)->paginate(3);
			}

			//make links
			$pagination =  $userModel->pager;
			$links = $pagination->links();

			//to give data of the table
			$output .= $this->html($results, $lable);

			 $output .= "<div id='pagination' class='col-12 clearfix'>
			$links
			</div> ";
			$data = ['2', $output];
			return json_encode($data);
			
		
		
	}

	private	function html($data, $lable)
	{
		$output = "";

	 if(isset($data[0]))
	 { 
			$i= 1 ;
			foreach($data as $row)
			{
				$btn = "";
				//condition for accepted user
				if(!isset($lable['type']))
				{
					$btn = "<button id='{$lable['id1']}' data-id='{$row['id']}' type='button' class='btn  btn-success ps-3 pe-3 rounded-pill me-lg-2 me-md-1  mb-1'>{$lable['btn1']}</button>";
				}
				//label role
				$row['role']  = $row['role'] == 1 ? "Student" : "Trainer";

			//store rows
			 $output .= "<tr>
			   <th scope='row'>{$i}</th>
			   <td>{$row['firstName']}</td>
			   <td>{$row['lastName']}</td>
			   <td>{$row['email']}</td>
			   <td>{$row['role']}</td>
			   <td class='text-center'>
				 {$btn}
				 <button id='{$lable['id2']}' data-id='{$row['id']}' type='button' class='btn  btn-danger ps-3 pe-3 pS  rounded-pill'>{$lable['btn2']}</button>
				 </td>
			 </tr>";
				   
				   //index
				   $i = $i + 1;
				}
			 }
		else	//if there is no records in db
		{

			 $output .= "<tr>
			   <td scope='row' colspan='6'>
				 <div class='alert alert-danger fs-4 m-0 p-2' role='alert'>
				 No records Found
				 </div>
			   </td>
			 </tr>";
		}

		//end table
		return $output .= "</tbody>
		</table></div>";		
	}


	private function helperSeriesRequest($lable)
	{
		$output  = "<div class='mt-lg-3 mt-sm-2 mt-1 table-responsive d-sm-flex mb-lg-4 mb-2'>
          
			<table class='table table-light  table-striped table-hover align-middle text-center ms-sm-4 me-sm-4 caption-top'>
			  <caption><h1 class='text-dark ms-sm-0 ms-2'>{$lable['heading']}</h1></caption>
			  <thead>
				<tr class='align-middle'>
				  <th scope='col' class='pt-3 pb-3'>#</th>
				  <th scope='col' class='pt-3 pb-3'>Series Name</th>
				  <th scope='col' class='pt-3 pb-3'>Uploaded By</th>
				  <th scope='col' class='pt-3 pb-3'>Series Type</th>
				  <th scope='col' class='pt-3 pb-3'>Series Category</th>
				  <th scope='col' class='pt-3 pb-3'>Series Price</th>
				  <th scope='col' class='pt-3 pb-3'>Action</th>
				</tr>
			  </thead>
			  <tbody>";
			//   $data = ['2', $output];
			// 			return  json_encode($data);
			  
			$pager = \Config\Services::pager();
			$_GET['page'] = isset($_POST['page']) ? $_POST['page']: 1;
			$seriesModel = new SeriesModel(); 
			if(isset($_POST['seriesName']))
			{
				//validation rules 
				helper(['form']);
				// echo "<pre>";
				// print_r($_POST);die;

				//apply rules if input given other not apply any rule
				if($this->request->getVar('seriesName') != "")
				{
					$rules['seriesName'] = [
								'label'=>'Series Name',
								'rules'=>'min_length[15]|max_length[50]|alpha_space'
							];
					
				}
				
				if($this->request->getVar('email') != "")
				{
					$rules['email'] = [
								'label'=>'Email',
								'rules'=>'valid_emails'
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
						// echo "Ahmad";die;
						$where['series.status'] = $lable['status'];
						if($this->request->getVar('seriesName') != "")
						{
							$where['series.seriesName'] = $this->request->getVar('seriesName');
						
						}
						
						if($this->request->getVar('email') != "")
						{
							$where['users.email'] = $this->request->getVar('email');
							
						}

						if($this->request->getVar('seriesType') != "")
						{
							$where['series.seriesType'] = $this->request->getVar('seriesType');
						}

						if($this->request->getVar('seriesCategory') != "")
						{
							$where['series.seriesCategory'] = $this->request->getVar('seriesCategory');
					
						}
					
						$results = $seriesModel->paginateSeries($where, 3);
					}
					else	//store validation errors
					{
						// print_r($_POST);die;
						$validation = $this->validator;
						$output = "";
						$output .= "<div class='mt-sm-1 mt-0 mb-sm-2 mb-3 alert alert-danger alert-dismissible fade show text-muted' role='alert'>";
						$output .= $validation->listErrors();
						$output .="<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
						$output .= "</div>";
						$data = ['1', $output];
						return  json_encode($data); 
						
						
					}
				}
				else
				{
					$where = [
						'series.status'=>$lable['status'],
						// 'series.seriesType'=>1,
						// 'series.seriescategory'=>2
					];
					
					$results = $seriesModel->paginateSeries($where, 3);
				}
		

		
		
			
		$pagination =  $seriesModel->pager;
	 	$links = $pagination->links();
		// print_r($results);die;
		
			$output .= $this->htmlSeries($results, $lable);
			$output .= "<div id='paginationSeries' class='col-12 clearfix'>
			$links
			</div> ";
			$data = ['2', $output];
			return json_encode($data);
	}

	private	function htmlSeries($data, $lable)
	{
		$output = "";

	 if(isset($data[0]))
	 { 
			$i= 1 ;
			foreach($data as $row)
			{
				$btn = "";
				if(!isset($lable['type']))
				{
					 $btn = "<button id='{$lable['id1']}' data-id='{$row['seriesId']}' type='button' class='btn  btn-success ps-3 pe-3 rounded-pill me-lg-2 me-md-1  mb-1'>{$lable['btn1']}</button>";
				}
				$row['seriesType'] = $row['seriesType'] == 1 ? "Computer Science" : "Information Technology";
				$row['seriesCategory'] = $row['seriesCategory'] == 1 ? "Free" : "Paid";
				$row['seriesPrice'] = $row['seriesPrice'] != "" ? $row['seriesPrice'] : 0;
			//store rows
			 $output .= "<tr>
			   <th scope='row'>{$i}</th>
			   <td>{$row['seriesName']}</td>
			   <td>{$row['email']}</td>
			   <td>{$row['seriesType']}</td>
			   <td>{$row['seriesCategory']}</td>
			   <td>{$row['seriesPrice']}</td>
			   <td class='text-center'>
				{$btn}
				 <button id='{$lable['id2']}' data-id='{$row['seriesId']}' type='button' class='btn  btn-danger ps-3 pe-3 pS  rounded-pill'>{$lable['btn2']} </button>
				 </td>
			 </tr>";
				   
				   //index
				   $i = $i + 1;
				}
			 }
		else	//if there is no records in db
		{

			 $output .= "<tr>
			   <td scope='row' colspan='7'>
				 <div class='alert alert-danger fs-4 m-0 p-2' role='alert'>
				 No records Found
				 </div>
			   </td>
			 </tr>";
		}

		//end table
		return $output .= "</tbody>
		</table></div>";		
	}

	private function helperVoucherRequest($lable)
	{
		//loadTable with ajax
		$th = "";
			
			//  echo "Razadfs";die;
		if($lable['status'] == 1 || $lable['status'] == 3)
		{
			$th = "<th scope='col' class='pt-3 pb-3'>Voucher</th>";
		}
			//table header
			 $output = "
			<div class='mt-lg-3 mt-sm-2 mt-1 table-responsive d-sm-flex mb-lg-2 mb-1'>
			<table class='table table-light  table-striped table-hover align-middle text-center ms-sm-4 me-sm-4 caption-top'>
			<caption><h1 class='text-dark ms-sm-0 ms-2'>{$lable['heading']}</h1></caption>
			<thead>
			  <tr class='align-middle'>
				<th scope='col' class='pt-3 pb-3'>#</th>
				<th scope='col' class='pt-3 pb-3'>Voucher Id</th>
				<th scope='col' class='pt-3 pb-3'>Email</th>
				<th scope='col' class='pt-3 pb-3'>Series Name</th>
				<th scope='col' class='pt-3 pb-3'>Series Type</th>
				<th scope='col' class='pt-3 pb-3'>Series Price</th>
				$th
				<th scope='col' class='pt-3 pb-3'>Created Date</th>
				<th scope='col' class='pt-3 pb-3'>Due Date</th>
				<th scope='col' class='pt-3 pb-3'>Action</th>
			  </tr>
			</thead>
			<tbody>
			";
				
			//for pagination
			$pager = \Config\Services::pager();
			

			$voucherModel = new VoucherModel();

			//set page no
			$_GET['page'] = isset($_POST['page']) ? $_POST['page']: 1;
			
			if(isset($_POST['voucherId']))
			{
				
				//validation rules 
				helper(['form']);
				
				//apply rules if input given other not apply any rule
				if($this->request->getVar('seriesName') != "")
				{
					$rules['seriesName'] = [
								'label'=>'Series Name',
								'rules'=>'min_length[15]|max_length[50]|alpha_space'
							];
					
				}
				
				if($this->request->getVar('email') != "")
				{
					$rules['email'] = [
								'label'=>'Email',
								'rules'=>'valid_emails'
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
				
				if($this->request->getVar('voucherId') != "")
				{
					$rules['voucherId'] = [
								'label'=>'VoucherID', 
								'rules'=>'integer|max_length[8]|greater_than[0]',
							];
					
				}
				
				// echo 1;die;	
					if($this->validate($rules))
					{
						// echo "Ahmad";die;
						 $where['voucher.status'] = $lable['status'];
						if($this->request->getVar('seriesName') != "")
						{
							$where['series.seriesName'] = $this->request->getVar('seriesName');
						
						}
								
						if($this->request->getVar('email') != "")
						{
							$where['users.email'] = $this->request->getVar('email');
							
						}

						if($this->request->getVar('seriesType') != "")
						{
							$where['series.seriesType'] = $this->request->getVar('seriesType');
						}

						if($this->request->getVar('voucherId') != "")
						{
							$where['voucher.voucherId'] = $this->request->getVar('voucherId');
					
						}
						
						$results = $voucherModel->paginateVouchers($where,3);
						//  echo "Ahmad";die;
						// echo "Ahmad";die;
					}
					else	//store validation errors
					{
						// print_r($_POST);die;
						$validation = $this->validator;
						$output = "";
						$output .= "<div class='mt-sm-1 mt-0 mb-sm-2 mb-3 alert alert-danger alert-dismissible fade show text-muted' role='alert'>";
						$output .= $validation->listErrors();
						$output .="<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
						$output .= "</div>";
						$data = ['1', $output];
						return json_encode($data);
						
					}
			}
			else	//if filters not given
			{
				
				// echo "a";die;
				$where = ['voucher.status'=>$lable['status']];
				$results = $voucherModel->paginateVouchers($where,3);
				// echo "a";die;
			}
			// echo "Razadfs";die;
			//make links
			$pagination =  $voucherModel->pager;
			$links = $pagination->links();

			//to give data of the table
			$output .= $this->htmlVoucher($results, $lable);

			 $output .= "<div id='paginationVoucher' class='col-12 clearfix'>
			$links
			</div> ";
			// echo "Amad";die;
			$data = ['2', $output];
			return json_encode($data);
			
		
		
	}

	private	function htmlVoucher($data, $lable)
	{
		$output = "";

	 if(isset($data[0]))
	 { 
			$i= 1 ;
			foreach($data as $row)
			{
				$btn = "";
				if(!isset($lable['type']))
				{
					 $btn = "<button id='{$lable['id1']}' data-voucherId='{$row['voucherId']}' type='button' class='btn  btn-success ps-3 pe-3 rounded-pill me-lg-2 me-md-1  mb-1'>{$lable['btn1']}</button>";
				}
				$row['seriesType'] = $row['seriesType'] == 1 ? "Computer Science" : "Information Technology";
				$voucherId = substr(str_repeat(0, 8).$row['voucherId'], - 8);
				$td ="";
				if($lable['status'] == 1 || $lable['status'] == 3)
		{
			$td = "<th scope='col' class='pt-3 pb-3'><a data-fancybox='gallery' href='/tutorialTube/public/uploads/voucher/{$row['voucherPath']}'><img src='/tutorialTube/public/uploads/voucher/{$row['voucherPath']}' style='width:100px; height:auto;'></a></th>";
		}
			//store rows
			 $output .= "<tr>
			   <th scope='row'>{$i}</th>
			   <td>$voucherId</td>
			   <td>{$row['email']}</td>
			   <td>{$row['seriesName']}</td>
			   <td>{$row['seriesType']}</td>
			   <td>{$row['seriesPrice']}</td>
			   $td
			   <td>{$row['createdDate']}</td>
			   <td>{$row['dueDate']}</td>
			   <td class='text-center'>
				{$btn}
				 <button id='{$lable['id2']}' data-voucherId='{$row['voucherId']}' type='button' class='btn  btn-danger ps-3 pe-3 pS  rounded-pill'>{$lable['btn2']} </button>
				 </td>
			 </tr>";
				   
				   //index
				   $i = $i + 1;
				}
			 }
		else	//if there is no records in db
		{

			 $output .= "<tr>
			   <td scope='row' colspan='10'>
				 <div class='alert alert-danger fs-4 m-0 p-2' role='alert'>
				 No records Found
				 </div>
			   </td>
			 </tr>";
		}
		// echo "a";die;
		//end table
		return $output .= "</tbody>
		</table></div>";		
	}



}


