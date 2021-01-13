<?php 
namespace App\Controllers\Setting;
use App\Controllers\BaseController;
use App\Models\Setting\CustomModel;
use Config\Services;

class Customcontroller extends BaseController
{
	public function index() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            return view('menusetting/view_settingcustom');
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
                $m_custom = new CustomModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_custom->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tomboledit = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editsettingcustom('" .$list->kode_custom. "')\">
                                                <i class=\"fa fa-edit\"></i></button>";

                                $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                                onclick=\"deletesettingcustom('" .$list->kode_custom. "')\"> 
                                                <i class=\"fa fa-trash\"></i></button>";

                                $row[] = $no;
                                $row[] = $list->kode_custom;
                                $row[] = $list->judul_custom;
                                $row[] = $list->isi_custom;
                                $row[] = $tomboledit . ' ' . $tombolhapus;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_custom->count_all(),
                            "recordsFiltered" => $m_custom->count_filtered(),
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
                $m_custom = new CustomModel($request);

                $getdata = $m_custom->findAll();
                $max  = count($getdata) + 1;
                $gen  = "CSTM" . str_pad($max, 3, 0, STR_PAD_LEFT);

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
                    'settingcustom_kode' => [
                        'label' => 'Kode custom',
                        'rules' => [
                            'required',
                            'is_unique[custom.kode_custom]',
                        ],
                        'errors' => [
                            'required' 		=> '{field} wajib terisi',
                            'is_unique'	    => '{field} tidak boleh sama, coba dengan kode yang lain'
                        ],
                    ],
    
                    'settingcustom_judul' => [
                        'label' => 'Judul',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'settingcustom_isi' => [
                        'label' => 'Isi',
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
						"settingcustom_kode" => $this->validation->getError('settingcustom_kode'),
                        "settingcustom_judul" => $this->validation->getError('settingcustom_judul'),
						"settingcustom_isi" => $this->validation->getError('settingcustom_isi'),
					]
				];
			}
			else
			{
                $data = [
                    'kode_custom' => $this->request->getVar('settingcustom_kode'),
                    'judul_custom' => $this->request->getVar('settingcustom_judul'),
                    'isi_custom' => $this->request->getVar('settingcustom_isi'),
                ];

                $request = Services::request();
                $m_custom = new CustomModel($request);

                $m_custom->insert($data);

                $msg = [
                    'success' => [
                       'data' => 'Berhasil menambahkan data',
                       'link' => '/admsettingcustom'
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
                $m_custom = new CustomModel($request);

                $item = $m_custom->find($kode);
    
                $data = [
                    'success' => [
                        'kode' => $item['kode_custom'],
                        'judul' => $item['judul_custom'],
                        'isi' => $item['isi_custom'],
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
                    'settingcustom_judulubah' => [
                        'label' => 'Ubah Judul',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'settingcustom_isiubah' => [
                        'label' => 'Ubah isi',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ]
                ]);

                if (!$check) {
                    $msg = [
                        'error' => [
                            "settingcustom_judulubah" => $this->validation->getError('settingcustom_judulubah'),
                            "settingcustom_isiubah" => $this->validation->getError('settingcustom_isiubah'),
                        ]
                    ];
                }
                else
                {
                    $data = [
                        'judul_custom' => $this->request->getVar('settingcustom_judulubah'),
                        'isi_custom' => $this->request->getVar('settingcustom_isiubah'),
                    ];
    
                    $kode = $this->request->getVar('settingcustom_kodeubah');
    
                    $request = Services::request();
                    $m_custom = new CustomModel($request);

                    $m_custom->update($kode, $data);
    
                    $msg = [
                        'success' => [
                           'data' => 'Berhasil memperbarui data',
                           'link' => '/admsettingcustom'
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
                $m_custom = new CustomModel($request);
    
                $m_custom->delete($kode);
    
                $msg = [
                    'success' => [
                        'data' => 'Berhasil menghapus data custom dengan kode ' . $kode,
                        'link' => '/admsettingcustom'
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