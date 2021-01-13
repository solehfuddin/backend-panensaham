<?php 
namespace App\Controllers\Account;
use App\Controllers\BaseController;
use App\Models\Account\MemberModel;
use Config\Services;

class Membercontroller extends BaseController
{
	public function index() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            return view('menuaccount/view_accountmember');
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
                $m_member = new MemberModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_member->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tomboledit = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editaccountmember('" .$list->kode_jenis_member. "')\">
                                                <i class=\"fa fa-edit\"></i></button>";

                                $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                                onclick=\"deleteaccountmember('" .$list->kode_jenis_member. "')\"> 
                                                <i class=\"fa fa-trash\"></i></button>";

                                $row[] = $no;
                                $row[] = $list->kode_jenis_member;
                                $row[] = $list->jenis_member;
                                $row[] = $tomboledit . ' ' . $tombolhapus;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_member->count_all(),
                            "recordsFiltered" => $m_member->count_filtered(),
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
                $m_member = new MemberModel($request);

                $getdata = $m_member->findAll();
                $max  = count($getdata) + 1;
                $gen  = "JMBR" . str_pad($max, 3, 0, STR_PAD_LEFT);

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
                    'accountmember_kode' => [
                        'label' => 'Kode jenis member',
                        'rules' => [
                            'required',
                            'is_unique[m_jenis_member.kode_jenis_member]',
                        ],
                        'errors' => [
                            'required' 		=> '{field} wajib terisi',
                            'is_unique'	    => '{field} tidak boleh sama, coba dengan kode yang lain'
                        ],
                    ],
    
                    'accountmember_nama' => [
                        'label' => 'Kategori pengumuman',
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
						"accountmember_kode" => $this->validation->getError('accountmember_kode'),
						"accountmember_nama" => $this->validation->getError('accountmember_nama'),
					]
				];
			}
			else
			{
                $data = [
                    'kode_jenis_member' => $this->request->getVar('accountmember_kode'),
                    'jenis_member' => $this->request->getVar('accountmember_nama'),
                ];

                $request = Services::request();
                $m_member = new MemberModel($request);

                $m_member->insert($data);

                $msg = [
                    'success' => [
                       'data' => 'Berhasil menambahkan data',
                       'link' => '/admaccountmember'
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
                $m_member = new MemberModel($request);

                $item = $m_member->find($kode);
    
                $data = [
                    'success' => [
                        'kode' => $item['kode_jenis_member'],
                        'keterangan' => $item['jenis_member'],
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
                    'accountmember_namaubah' => [
                        'label' => 'Keterangan',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ]
                ]);

                if (!$check) {
                    $msg = [
                        'error' => [
                            "accountmember_namaubah" => $this->validation->getError('accountmember_namaubah'),
                        ]
                    ];
                }
                else
                {
                    $data = [
                        'jenis_member' => $this->request->getVar('accountmember_namaubah'),
                    ];
    
                    $kode = $this->request->getVar('accountmember_kodeubah');
    
                    $request = Services::request();
                    $m_member = new MemberModel($request);

                    $m_member->update($kode, $data);
    
                    $msg = [
                        'success' => [
                           'data' => 'Berhasil memperbarui data',
                           'link' => '/admaccountmember'
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
                $m_member = new MemberModel($request);
    
                $m_member->delete($kode);
    
                $msg = [
                    'success' => [
                        'data' => 'Berhasil menghapus data member dengan kode ' . $kode,
                        'link' => '/admaccountmember'
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