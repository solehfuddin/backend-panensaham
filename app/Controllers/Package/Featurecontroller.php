<?php 
namespace App\Controllers\Package;
use App\Controllers\BaseController;
use App\Models\Package\FeatureModel;
use App\Models\Account\UserlevelModel;
use Config\Services;

class Featurecontroller extends BaseController
{
	public function index() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            $request = Services::request();
            $m_usrlvl = new UserlevelModel($request);

            $data = [
                'data' => $m_usrlvl->getkodeuser()
            ];

            return view('menupackage/view_packagefeature', $data);
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
                $m_feature = new FeatureModel($request);

                // $m_cat = $this->infocategorymodel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_feature->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tomboledit = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editpackagefeature('" .$list->kode_fitur_paket. "')\">
                                                <i class=\"fa fa-edit\"></i></button>";

                                $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                                onclick=\"deletepackagefeature('" .$list->kode_fitur_paket. "')\"> 
                                                <i class=\"fa fa-trash\"></i></button>";

                                $row[] = $no;
                                $row[] = $list->kode_user_level;
                                $row[] = $list->keterangan;
                                // $row[] = $tomboledit;
                                $row[] = $tomboledit . ' ' . $tombolhapus;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_feature->count_all(),
                            "recordsFiltered" => $m_feature->count_filtered(),
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
                    'packagefeature_keterangan' => [
                        'label' => 'Keterangan',
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
						"packagefeature_keterangan" => $this->validation->getError('packagefeature_keterangan'),
					]
				];
			}
			else
			{
                $data = [
                    'kode_user_level' => $this->request->getVar('packagefeature_kodeuser'),
                    'keterangan' => $this->request->getVar('packagefeature_keterangan'),
                ];

                $request = Services::request();
                $m_feature = new FeatureModel($request);

                $m_feature->insert($data);

                $msg = [
                    'success' => [
                       'data' => 'Berhasil menambahkan data jenis pengumuman',
                       'link' => '/admpackagefeature'
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
                $m_feature = new FeatureModel($request);

                $item = $m_feature->find($kode);
    
                $data = [
                    'success' => [
                        'kode_user' => $item['kode_user_level'],
                        'keterangan' => $item['keterangan'],
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
                    'packagefeature_keteranganubah' => [
                        'label' => 'Ubah Keterangan',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ]
                ]);

                if (!$check) {
                    $msg = [
                        'error' => [
                            "packagefeature_keteranganubah" => $this->validation->getError('packagefeature_keteranganubah'),
                        ]
                    ];
                }
                else
                {
                    $data = [
                        'kode_user_level' => $this->request->getVar('packagefeature_kodeuserubah'),
                        'keterangan' => $this->request->getVar('packagefeature_keteranganubah'),
                    ];
    
                    $kode = $this->request->getVar('packagefeature_kode');
    
                    $request = Services::request();
                    $m_feature = new FeatureModel($request);

                    $m_feature->update($kode, $data);
    
                    $msg = [
                        'success' => [
                           'data' => 'Berhasil memperbarui data jenis pengumuman',
                           'link' => '/admpackagefeature'
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
                $m_feature = new FeatureModel($request);
    
                $m_feature->delete($kode);
    
                $msg = [
                    'success' => [
                        'data' => 'Berhasil menghapus data jenis pengumuman dengan kode ' . $kode,
                        'link' => '/admpackagefeature'
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