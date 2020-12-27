<?php 
namespace App\Controllers\Information;
use App\Controllers\BaseController;
use App\Models\Information\CategoryModel;
use Config\Services;

class Categorycontroller extends BaseController
{
	public function index() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            return view('menuinformation/view_categorytype');
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
                $m_cat = new CategoryModel($request);

                // $m_cat = $this->infocategorymodel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_cat->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tomboledit = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editinfocategory('" .$list->kode_kategori_pengumuman. "')\">
                                                <i class=\"fa fa-edit\"></i></button>";

                                $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                                onclick=\"deleteinfocategory('" .$list->kode_kategori_pengumuman. "')\"> 
                                                <i class=\"fa fa-trash\"></i></button>";

                                $row[] = $no;
                                $row[] = $list->kode_kategori_pengumuman;
                                $row[] = $list->nama_kategori_pengumuman;
                                // $row[] = $tomboledit;
                                $row[] = $tomboledit . ' ' . $tombolhapus;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_cat->count_all(),
                            "recordsFiltered" => $m_cat->count_filtered(),
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
                $m_cat = new CategoryModel($request);

                $getdata = $m_cat->findAll();
                $max  = count($getdata) + 1;
                $gen  = "KTPM" . str_pad($max, 3, 0, STR_PAD_LEFT);

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
                    'infocategory_kode' => [
                        'label' => 'Kode kategori pengumuman',
                        'rules' => [
                            'required',
                            'is_unique[kategori_pengumuman.kode_kategori_pengumuman]',
                        ],
                        'errors' => [
                            'required' 		=> '{field} wajib terisi',
                            'is_unique'	    => '{field} tidak boleh sama, coba dengan kode yang lain'
                        ],
                    ],
    
                    'infocategory_nama' => [
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
						"infocategory_kode" => $this->validation->getError('infocategory_kode'),
						"infocategory_nama" => $this->validation->getError('infocategory_nama'),
					]
				];
			}
			else
			{
                $data = [
                    'kode_kategori_pengumuman' => $this->request->getVar('infocategory_kode'),
                    'nama_kategori_pengumuman' => $this->request->getVar('infocategory_nama'),
                ];

                $request = Services::request();
                $m_cat = new CategoryModel($request);

                $m_cat->insert($data);

                $msg = [
                    'success' => [
                       'data' => 'Berhasil menambahkan data jenis pengumuman',
                       'link' => '/admcattype'
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
                $m_cat = new CategoryModel($request);

                $item = $m_cat->find($kode);
    
                $data = [
                    'success' => [
                        'kode' => $item['kode_kategori_pengumuman'],
                        'kategori' => $item['nama_kategori_pengumuman'],
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
                    'infocategory_namaubah' => [
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
                            "infocategory_namaubah" => $this->validation->getError('infocategory_namaubah'),
                        ]
                    ];
                }
                else
                {
                    $data = [
                        'nama_kategori_pengumuman' => $this->request->getVar('infocategory_namaubah'),
                    ];
    
                    $kode = $this->request->getVar('infocategory_kodeubah');
    
                    $request = Services::request();
                    $m_cat = new CategoryModel($request);

                    $m_cat->update($kode, $data);
    
                    $msg = [
                        'success' => [
                           'data' => 'Berhasil memperbarui data jenis pengumuman',
                           'link' => '/admcattype'
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
                $m_cat = new CategoryModel($request);
    
                $m_cat->delete($kode);
    
                $msg = [
                    'success' => [
                        'data' => 'Berhasil menghapus data jenis pengumuman dengan kode ' . $kode,
                        'link' => '/admcattype'
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