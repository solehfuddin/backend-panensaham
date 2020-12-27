<?php 
namespace App\Controllers\Information;
use App\Controllers\BaseController;
use App\Models\Information\TypeModel;
use Config\Services;

class Typecontroller extends BaseController
{
	public function index() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            return view('menuinformation/view_infotype');
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
                $m_type = new TypeModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_type->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tomboledit = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editinfotype('" .$list->kode_jenis_pengumuman. "')\">
                                                <i class=\"fa fa-edit\"></i></button>";

                                $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                                onclick=\"deleteinfotype('" .$list->kode_jenis_pengumuman. "')\"> 
                                                <i class=\"fa fa-trash\"></i></button>";

                                $row[] = $no;
                                $row[] = $list->kode_jenis_pengumuman;
                                $row[] = $list->jenis_pengumuman;
                                // $row[] = $tomboledit;
                                $row[] = $tomboledit . ' ' . $tombolhapus;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_type->count_all(),
                            "recordsFiltered" => $m_type->count_filtered(),
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
                $m_cat = new TypeModel($request);

                $getdata = $m_cat->findAll();
                $max  = count($getdata) + 1;
                $gen  = "JEPM" . str_pad($max, 3, 0, STR_PAD_LEFT);

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
                    'infotype_kode' => [
                        'label' => 'Kode jenis pengumuman',
                        'rules' => [
                            'required',
                            'is_unique[jenis_pengumuman.kode_jenis_pengumuman]',
                        ],
                        'errors' => [
                            'required' 		=> '{field} wajib terisi',
                            'is_unique'	    => '{field} tidak boleh sama, coba dengan kode yang lain'
                        ],
                    ],
    
                    'infotype_nama' => [
                        'label' => 'Jenis pengumuman',
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
						"infotype_kode" => $this->validation->getError('infotype_kode'),
						"infotype_nama" => $this->validation->getError('infotype_nama'),
					]
				];
			}
			else
			{
                $data = [
                    'kode_jenis_pengumuman' => $this->request->getVar('infotype_kode'),
                    'jenis_pengumuman' => $this->request->getVar('infotype_nama'),
                ];

                $request = Services::request();
                $m_type = new TypeModel($request);

                $m_type->insert($data);;

                $msg = [
                    'success' => [
                       'data' => 'Berhasil menambahkan data jenis pengumuman',
                       'link' => '/adminfotype'
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
                $m_type = new TypeModel($request);

                $item = $m_type->find($kode);
    
                $data = [
                    'success' => [
                        'kode' => $item['kode_jenis_pengumuman'],
                        'jenis' => $item['jenis_pengumuman'],
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
                    'infotype_namaubah' => [
                        'label' => 'Ubah Jenis pengumuman',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ]
                ]);

                if (!$check) {
                    $msg = [
                        'error' => [
                            "infotype_namaubah" => $this->validation->getError('infotype_namaubah'),
                        ]
                    ];
                }
                else
                {
                    $data = [
                        'jenis_pengumuman' => $this->request->getVar('infotype_namaubah'),
                    ];
    
                    $kode = $this->request->getVar('infotype_kodeubah');

                    $request = Services::request();
                    $m_type = new TypeModel($request);
    
                    $m_type->update($kode, $data);
    
                    $msg = [
                        'success' => [
                           'data' => 'Berhasil memperbarui data jenis pengumuman',
                           'link' => '/adminfotype'
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

    public function hapusdata()
    {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            if ($this->request->isAJAX()) {
                $kode = $this->request->getVar('kode');
                $request = Services::request();
                $m_type = new TypeModel($request);

                $m_type->delete($kode);
    
                $msg = [
                    'success' => [
                        'data' => 'Berhasil menghapus data jenis pengumuman dengan kode ' . $kode,
                        'link' => '/adminfotype'
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
	//--------------------------------------------------------------------

}
