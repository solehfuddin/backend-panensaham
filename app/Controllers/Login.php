<?php namespace App\Controllers;

use App\Models\LoginModel;

class Login extends BaseController
{
	protected $loginModel;

	public function __construct()
	{
		$this->loginModel = new LoginModel();
	}

	public function index()
	{
		return view('view_login');
	}

	// public function test()
	// {
	// 	$data = $this->loginModel->login('udin@trl.co');

	// 	// echo count($data);
	// 	dd($data);
	// }

	public function auth()
	{
		if ($this->request->isAJAX()) {
			$emailaddr = $this->request->getVar('emailaddr');
			$pass      = $this->request->getVar('pass');

			$validationCheck = $this->validate([
				'emailaddr' => [
					'label' => 'Alamat Email',
					'rules' => [
						'required',
						'valid_email',
					],
					'errors' => [
						'required' 		=> '{field} wajib terisi',
						'valid_email'	=> '{field} tidak valid'
					],
				],

				'pass' => [
					'label' => 'Password',
					'rules' => 'required',
					'errors' => [
						'required' 		=> '{field} wajib terisi'
					],
				]
			]);

			if (!$validationCheck) {
				$msg = [
					'error' => [
						"emailaddr" => $this->validation->getError('emailaddr'),
						"pass" => $this->validation->getError('pass'),
					]
				];
			}
			else
			{
				$mailCheck = $this->loginModel->login($emailaddr);

				// $result = $mailCheck->getResult();

				if (count($mailCheck) > 0)
				{
					$passCheck = $mailCheck[0]['password'];
					if ($passCheck == md5($pass)) {
						$saveSession = [
							'islogin' => true,
							'kodeuser' => $mailCheck[0]['kode_user'],
							'username' => $mailCheck[0]['username'],
							'namalengkap' => $mailCheck[0]['nama_lengkap'],
							'alamatemail' => $mailCheck[0]['alamat_email'],
							'namalevel' => $mailCheck[0]['nama_level']
						];

						$this->session->set($saveSession);

						$msg = [
							'success' => [
								'link' => '/admdashboard'
							]
						];
					}
					else
					{
						$msg = [
							'error' => [
								'pass' => 'Maaf password anda salah'
							]
						];
					}
				}
				else
				{
					$msg = [
						'error' => [
							'emailaddr' => 'Maaf akun tidak ditemukan'
						]
					];
				}
			}

			echo json_encode($msg);
		}
	}

	public function out()
	{
		$this->session->destroy();
		return redirect()->to('/');
	}
}