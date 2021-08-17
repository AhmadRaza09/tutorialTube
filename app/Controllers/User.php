<?php

namespace App\Controllers;
use  App\Models\SeriesModel;
use  App\Models\UserModel;
class User extends BaseController
{
	public function index()
	{
		$data['title'] = "Home";
		$data['quotation'] = [
			'lable1'=>"A Good education is a foundation for a better future; We warmly Welcome to all of you in the Tutorial Tube Website...",
			'lable2'=>"Best Series For the Fields of Computer Science and Information Technology",
			'lable3'=>"Both the Series of Free and Paid are Available",
			'lable4'=>"A Plateform for both Teaching as well as Learning"
		];

		//for confirmation email
		$uri = service('uri');
		$currentUrl = $this->request->uri;
		$checkSegment = explode("User/index/", $currentUrl);
		
		if(isset($checkSegment[1]))
		{
		// 	print_r($checkSegment);
		// die;
			$email = $uri->getSegment('3');
			$firstName = $uri->getSegment('4');
			$userModel = new UserModel();
			$result =  $userModel->where(['email'=>$email, 'status'=>0])->first();
			//  print_r($result);
			//  die;
			if($result)
			{
				if($result['firstName'] === $firstName && $result['email'] === $email)
				{
				$update = ['status' => 1];
				$userModel->update($result['id'],$update);
				$data['confirm'] = "Your email is confirmed wait for admin approval";
				}
			}
			//confirmation email end 
		
		}
		
			//get free series
			$freeSeries = new SeriesModel();
			$series = $freeSeries->where(['seriesCategory'=>'1', 'status'=>'2'])->paginate(8);
			// echo "<pre>";
			// print_r($series);die;
			$data['series'] = $series;

		echo view('home', $data);
	}

	public function signUp()
	{
		$data['title'] = "SignUp";
		if($this->request->getMethod()=="post")
		{
			
			//validation

			//validation rules 
			helper(['form']);
			$usersModel = new UserModel();
			$rules = [
				'email'=>[
					'label'=>'Email',
					'rules'=>'required|valid_emails|is_unique[users.email]'
				],

				'firstName'=>[
					'label'=>'First Name',
					'rules'=>'required|min_length[4]|max_length[32]|alpha'
				],

				'lastName'=>[
					'label'=>'Last Name',
					'rules'=>'required|min_length[4]|max_length[32]|alpha'
				],

				'role'=>[
					'label'=>'Role',
					'rules'=>'required|in_list[1, 2]',
					'errors'=>[
						'in_list'=>"The Role must be of Student or Trainer"
					]
				],

				'password'=>[
					'label'=>'Password', 
					'rules'=>'required|min_length[8]|max_length[32]'
				],

				'confirmPassword'=>[
					'label'=>'Confirm Password',
					'rules'=>'required|matches[password]'
				]
			];
			//validation rules end

			if($this->validate($rules))
			{
				 $usersModel->save($_POST);
				
				// sendmail
				$email = \Config\Services::email();
				$request = \Config\Services::request(); 
				
                $email->setFrom('zohaibrazamul1122@gmail.com', 'Tutorial Tube');
                $email->setTo($request->getVar('email'));
				// $email->setTo('raza3088682050@gmail.com');
                // $email->setCC('another@another-example.com');
                // $email->setBCC('them@their-example.com');
			
				
				$a = $request->getVar('email') . "/". $request->getVar('firstName');
				$session = \Config\Services::session();
				$email->setSubject('Email Varification');
				$email->setMessage('<a href="localhost/tutorialTube/public/User/index/'. $a .'"  >Click here to confirm your email</a>');
                
				$email->send();
				
				//end
				$session = \Config\Services::session();
				$session->setFlashdata('confirmMail', 'Check your mail to confirm your email address');
				return redirect()->to('/tutorialTube/public/user');
			}
			else
			{
				// print_r($_POST);die;
				$data['validation'] = $this->validator;
				echo view('signUpUser',$data);
				die;
			}
			// print_r($_POST);
			// echo "Ahmad";
			// die;
		}
		
		echo view('signUpUser', $data);
	}

	public function login()
	{
		$data['title'] = "Login";
		if($this->request->getMethod()=="post")
		{
			
			//validation
			helper(['form']);
			
			$rules = [
				'email'=>[
					'label'=>'Email',
					'rules'=>'required|valid_emails'
				],


				'password'=>[
					'label'=>'Password', 
					'rules'=>'required|min_length[8]|max_length[32]'
				],

				
			];

			//validation valid then login
			if($this->validate($rules))
			{
				//reterive the record from database
				$request = \Config\Services::request(); 
				$email = $request->getVar('email');
				$password = $request->getVar('password');
				$userModel = new UserModel();
				$result =  $userModel->where(['email'=>$email])->first();

				// print_r($result);
				//record exist then check the password
				if($result)
				{
					
					if($result['status'] == 2)
					{
						if(password_verify($password, $result['password']))
						{
						
							$session = \Config\Services::session();
							$_SESSION['login'] = [
							'id'=>$result['id'],
							'role'=>$result['role'],
							'name'=>$result['firstName']
							];
							
							//redirect to dashboard
							if($result['role']==3)
							{
								return redirect()->to('/tutorialTube/public/Admin/AdminClass');
							}
							else		//redirect to site
							{
								return redirect()->to('/tutorialTube/public/User');
							}
							}
							else	//if password is inncorrect
							{
								$data['incorrect'] = "Email or password is incorrect";
							}
					}
					else	//if mail is not approved
					{
						$data['incorrect'] = "Your Account is not Approved by admin. Wait for admin Approval";	
					}
					
				}
				else  //if mail is inncorrect
				{
					$data['incorrect'] = "Email or password is incorrect";
				}
				
			}
			else	//show validation errors
			{
				// print_r($_POST);die;
				$data['validation'] = $this->validator;
				echo view('loginUser',$data);
				die;
			}
			// print_r($_POST);
			// echo "Ahmad";
			// die;
		}
		
		echo view('loginUser', $data);
	}

	

	function logout()
	{	
		
		$session = \Config\Services::session();
		unset($_SESSION['login']);
		// print_r($session->get('login'));
		// die;
		return redirect()->to('/tutorialTube/public/User');
	}
}
