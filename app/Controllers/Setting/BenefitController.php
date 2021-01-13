<?php 
namespace App\Controllers\Setting;
use App\Controllers\BaseController;
use App\Models\Setting\BenefitModel;
use Config\Services;

class Benefitcontroller extends BaseController
{
	public function index() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            return view('menusetting/view_settingbenefit');
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
                $m_benefit = new BenefitModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_benefit->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tomboledit = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editsettingbenefit('" .$list->kode_keunggulan. "')\">
                                                <i class=\"fa fa-edit\"></i></button>";

                                $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                                onclick=\"deletesettingbenefit('" .$list->kode_keunggulan. "')\"> 
                                                <i class=\"fa fa-trash\"></i></button>";

                                $row[] = $no;
                                $row[] = $list->kode_keunggulan;
                                $row[] = $list->judul;
                                $row[] = $list->deskripsi;
                                $row[] = $tomboledit . ' ' . $tombolhapus;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_benefit->count_all(),
                            "recordsFiltered" => $m_benefit->count_filtered(),
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
                $m_benefit = new BenefitModel($request);

                $getdata = $m_benefit->findAll();
                $max  = count($getdata) + 1;
                $gen  = "KUGL" . str_pad($max, 3, 0, STR_PAD_LEFT);

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
                    'settingbenefit_kode' => [
                        'label' => 'Kode keunggulan',
                        'rules' => [
                            'required',
                            'is_unique[keunggulan.kode_keunggulan]',
                        ],
                        'errors' => [
                            'required' 		=> '{field} wajib terisi',
                            'is_unique'	    => '{field} tidak boleh sama, coba dengan kode yang lain'
                        ],
                    ],
    
                    'settingbenefit_nama' => [
                        'label' => 'Judul',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'settingbenefit_deskripsi' => [
                        'label' => 'Deskripsi',
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
						"settingbenefit_kode" => $this->validation->getError('settingbenefit_kode'),
                        "settingbenefit_nama" => $this->validation->getError('settingbenefit_nama'),
						"settingbenefit_deskripsi" => $this->validation->getError('settingbenefit_deskripsi'),
					]
				];
			}
			else
			{
                $data = [
                    'kode_keunggulan' => $this->request->getVar('settingbenefit_kode'),
                    'judul' => $this->request->getVar('settingbenefit_nama'),
                    'deskripsi' => $this->request->getVar('settingbenefit_deskripsi'),
                ];

                $request = Services::request();
                $m_benefit = new BenefitModel($request);

                $m_benefit->insert($data);

                $msg = [
                    'success' => [
                       'data' => 'Berhasil menambahkan data',
                       'link' => '/admsettingbenefit'
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
                $m_benefit = new BenefitModel($request);

                $item = $m_benefit->find($kode);
    
                $data = [
                    'success' => [
                        'kode' => $item['kode_keunggulan'],
                        'judul' => $item['judul'],
                        'deskripsi' => $item['deskripsi'],
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
                    'settingbenefit_namaubah' => [
                        'label' => 'Ubah Judul',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'settingbenefit_deskripsiubah' => [
                        'label' => 'Ubah Deskripsi',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ]
                ]);

                if (!$check) {
                    $msg = [
                        'error' => [
                            "settingbenefit_namaubah" => $this->validation->getError('settingbenefit_namaubah'),
                            "settingbenefit_deskripsiubah" => $this->validation->getError('settingbenefit_deskripsiubah'),
                        ]
                    ];
                }
                else
                {
                    $data = [
                        'judul' => $this->request->getVar('settingbenefit_namaubah'),
                        'deskripsi' => $this->request->getVar('settingbenefit_deskripsiubah'),
                    ];
    
                    $kode = $this->request->getVar('settingbenefit_kodeubah');
    
                    $request = Services::request();
                    $m_benefit = new BenefitModel($request);

                    $m_benefit->update($kode, $data);
    
                    $msg = [
                        'success' => [
                           'data' => 'Berhasil memperbarui data',
                           'link' => '/admsettingbenefit'
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
                $m_benefit = new BenefitModel($request);
    
                $m_benefit->delete($kode);
    
                $msg = [
                    'success' => [
                        'data' => 'Berhasil menghapus data benefit dengan kode ' . $kode,
                        'link' => '/admsettingbenefit'
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