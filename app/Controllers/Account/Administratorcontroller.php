<?php 
namespace App\Controllers\Account;
use App\Controllers\BaseController;
use App\Models\Account\AdministratorModel;
use Config\Services;

class Administratorcontroller extends BaseController
{
	public function index() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            return view('menuaccount/view_accountadministrator');
        }
    }

    public function ajax_list() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            if ($this->request->isAJAX())
            {
                $request = Services::request();
                $m_admin = new AdministratorModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_admin->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tomboledit = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editaccountadministrator('" .$list->kode_user. "')\">
                                                <i class=\"fa fa-edit\"></i></button>";

                                $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                                onclick=\"deleteaccountadministrator('" .$list->kode_user. "')\"> 
                                                <i class=\"fa fa-trash\"></i></button>";

                                $row[] = $no;
                                $row[] = $list->kode_user;
                                $row[] = $list->alamat_email;
                                $row[] = $list->nama_lengkap;
                                $row[] = $list->jenis_kelamin;
                                $row[] = $tomboledit . ' ' . $tombolhapus;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_admin->count_all(),
                            "recordsFiltered" => $m_admin->count_filtered(),
                            "data" => $data
                        ];

                    echo json_encode($output);
                }
            }
            else
            {
                return view('errors/html/error_404');
            }
        }
    }

    public function getdata() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            if ($this->request->isAJAX())
            {
                $request = Services::request();
                $m_admin = new AdministratorModel($request);

                $getdata = $m_admin->findAll();
                $max  = count($getdata) + 1;
                $gen  = "TUSR" . str_pad($max, 3, 0, STR_PAD_LEFT);

                $data = [
                    'kodegen' => $gen
                ];

                echo json_encode($data);
            }
            else
            {
                return view('errors/html/error_404');
            }
        }
    }

    public function simpandata() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            if ($this->request->isAJAX())
            {
                $validationCheck = $this->validate([
                    'accountadministrator_kode' => [
                        'label' => 'Kode user',
                        'rules' => [
                            'required',
                            'is_unique[t_user.kode_user]',
                        ],
                        'errors' => [
                            'required' 		=> '{field} wajib terisi',
                            'is_unique'	    => '{field} tidak boleh sama, coba dengan kode yang lain'
                        ],
                    ],
    
                    'accountadministrator_username' => [
                        'label' => 'Username',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'accountadministrator_fullname' => [
                        'label' => 'Nama lengkap',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'accountadministrator_email' => [
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

                    'accountadministrator_password' => [
                        'label' => 'Password',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ]
                ]);
            }
            else
            {
                return view('errors/html/error_404');
            }

            if (!$validationCheck) {
				$msg = [
					'error' => [
						"accountadministrator_kode" => $this->validation->getError('accountadministrator_kode'),
                        "accountadministrator_username" => $this->validation->getError('accountadministrator_username'),
                        "accountadministrator_fullname" => $this->validation->getError('accountadministrator_fullname'),
                        "accountadministrator_email" => $this->validation->getError('accountadministrator_email'),
                        "accountadministrator_password" => $this->validation->getError('accountadministrator_password')
					]
				];
			}
			else
			{
                $password = $this->request->getVar('accountadministrator_password');
                $data = [
                    'kode_user' => $this->request->getVar('accountadministrator_kode'),
                    'kode_user_level' => "MULV006",
                    'username'  => $this->request->getVar('accountadministrator_username'),
                    'nama_lengkap' => $this->request->getVar('accountadministrator_fullname'),
                    'alamat_email' => $this->request->getVar('accountadministrator_email'),
                    'password'  => md5($password),
                    'jenis_kelamin' => $this->request->getVar('accountadministrator_gender')
                ];

                $request = Services::request();
                $m_admin = new AdministratorModel($request);

                $m_admin->insert($data);

                $msg = [
                    'success' => [
                       'data' => 'Berhasil menambahkan data',
                       'link' => '/admaccountadministrator'
                    ]
                ];
            }

            echo json_encode($msg);
        }
    }

    public function pilihdata() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            if ($this->request->isAJAX()) {
                $kode = $this->request->getVar('kode');
                $request = Services::request();
                $m_admin = new AdministratorModel($request);

                $item = $m_admin->find($kode);
    
                $data = [
                    'success' => [
                        'kode' => $item['kode_user'],
                        'username' => $item['username'],
                        'nama' => $item['nama_lengkap'],
                        'email' => $item['alamat_email'],
                        'gender' => $item['jenis_kelamin'],
                    ]
                ];
    
                echo json_encode($data);
            }
            else
            {
                return view('errors/html/error_404');
            }
        }
    }

    public function perbaruidata() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            if ($this->request->isAJAX())
            {
                $check = $this->validate([
                    'accountadministrator_usernameubah' => [
                        'label' => 'Username',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'accountadministrator_fullnameubah' => [
                        'label' => 'Nama lengkap',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'accountadministrator_emailubah' => [
                        'label' => 'Alamat Email',
                        'rules' => [
                            'required',
                            'valid_email',
                        ],
                        'errors' => [
                            'required' 		=> '{field} wajib terisi',
                            'valid_email'	=> '{field} tidak valid'
                        ],
                    ]
                ]);

                if (!$check) {
                    $msg = [
                        'error' => [
                            "accountadministrator_usernameubah" => $this->validation->getError('accountadministrator_usernameubah'),
                            "accountadministrator_fullnameubah" => $this->validation->getError('accountadministrator_fullnameubah'),
                            "accountadministrator_emailubah" => $this->validation->getError('accountadministrator_emailubah'),
                        ]
                    ];
                }
                else
                {
                    $data = [
                        'username'  => $this->request->getVar('accountadministrator_usernameubah'),
                        'nama_lengkap' => $this->request->getVar('accountadministrator_fullnameubah'),
                        'alamat_email' => $this->request->getVar('accountadministrator_emailubah'),
                        'jenis_kelamin' => $this->request->getVar('accountadministrator_genderubah')
                    ];
    
                    $kode = $this->request->getVar('accountadministrator_kodeubah');
    
                    $request = Services::request();
                    $m_admin = new AdministratorModel($request);

                    $m_admin->update($kode, $data);
    
                    $msg = [
                        'success' => [
                           'data' => 'Berhasil memperbarui data',
                           'link' => '/admaccountadministrator'
                        ]
                    ];
                }
    
                echo json_encode($msg);
            }
            else
            {
                return view('errors/html/error_404');
            }
        }
    }

    public function perbaruipassword() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            if ($this->request->isAJAX())
            {
                $check = $this->validate([
                    'passadministrator_passwordbaru' => [
                        'label' => 'Passwor Baru',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'passadministrator_passwordkonfirmasi' => [
                        'label' => 'Konfirmasi Password',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ]
                ]);

                if (!$check) {
                    $msg = [
                        'error' => [
                            "passadministrator_passwordbaru" => $this->validation->getError('passadministrator_passwordbaru'),
                            "passadministrator_passwordkonfirmasi" => $this->validation->getError('passadministrator_passwordkonfirmasi'),
                        ]
                    ];
                }
                else
                {
                    $newpassword = $this->request->getVar('passadministrator_passwordbaru');
                    $confirmpass = $this->request->getVar('passadministrator_passwordkonfirmasi');

                    if ($newpassword == $confirmpass)
                    {
                        $data = [
                            'password'  => md5($confirmpass)
                        ];
        
                        $kode = $this->request->getVar('passadministrator_kodeubah');
        
                        $request = Services::request();
                        $m_admin = new AdministratorModel($request);
    
                        $m_admin->update($kode, $data);
        
                        $msg = [
                            'success' => [
                               'data' => 'Berhasil memperbarui password dari akun ' . $kode,
                               'link' => '/admaccountadministrator'
                            ]
                        ];
                    }
                    else
                    {
                        $msg = [
                            'error' => [
                                "passnotmatch" => "Kata sandi yang dimasukkan tidak cocok satu sama lain",
                            ]
                        ];
                    }
                }
    
                echo json_encode($msg);
            }
            else
            {
                return view('errors/html/error_404');
            }
        }
    }

    public function hapusdata() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            if ($this->request->isAJAX()) {
                $kode = $this->request->getVar('kode');
                $request = Services::request();
                $m_admin = new AdministratorModel($request);
    
                $m_admin->delete($kode);
    
                $msg = [
                    'success' => [
                        'data' => 'Berhasil menghapus data admin dengan kode ' . $kode,
                        'link' => '/admaccountadministrator'
                     ]
                ];
            }
            else
            {
                return view('errors/html/error_404');
            }
    
            echo json_encode($msg);
        }
    }   
}