<?php 
namespace App\Controllers\Package;
use App\Controllers\BaseController;
use App\Models\Package\PriceModel;
use App\Models\Account\UserlevelModel;
use App\Models\Account\MemberModel;
use Config\Services;

class Pricecontroller extends BaseController
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
            $m_member = new MemberModel($request);

            $data = [
                'usrlevel' => $m_usrlvl->getkodeuser(),
                'mbrlevel' => $m_member->getkodemember(),
            ];

            return view('menupackage/view_packageprice', $data);
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
                $m_price = new PriceModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_price->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tomboledit = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editpackageprice('" .$list->kode_harga_paket. "')\">
                                                <i class=\"fa fa-edit\"></i></button>";

                                $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                                onclick=\"deletepackageprice('" .$list->kode_harga_paket. "')\"> 
                                                <i class=\"fa fa-trash\"></i></button>";

                                $harga = $list->harga_paket > 0 ? "Rp. " . number_format($list->harga_paket, 0, ',', '.') : "Free";
        
                                $row[] = $no;
                                $row[] = $list->jenis_member;
                                $row[] = $list->nama_level;
                                $row[] = $list->bulan;
                                $row[] = $harga;
                                $row[] = $tomboledit . ' ' . $tombolhapus;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_price->count_all(),
                            "recordsFiltered" => $m_price->count_filtered(),
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
                $m_price = new PriceModel($request);

                $getdata = $m_price->findAll();
                $max  = count($getdata) + 1;
                $gen  = "HPKT" . str_pad($max, 3, 0, STR_PAD_LEFT);

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
                    'packageprice_kode' => [
                        'label' => 'Kode harga paket',
                        'rules' => [
                            'required',
                            'is_unique[harga_paket.kode_harga_paket]',
                        ],
                        'errors' => [
                            'required' 		=> '{field} wajib terisi',
                            'is_unique'	    => '{field} tidak boleh sama, coba dengan kode yang lain'
                        ],
                    ],
    
                    'packageprice_harga' => [
                        'label' => 'Harga paket',
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
						"packageprice_kode" => $this->validation->getError('packageprice_kode'),
						"packageprice_harga" => $this->validation->getError('packageprice_harga'),
					]
				];
			}
			else
			{
                $data = [
                    'kode_harga_paket'  => $this->request->getVar('packageprice_kode'),
                    'kode_jenis_member' => $this->request->getVar('packageprice_jenismember'),
                    'kode_user_level'   => $this->request->getVar('packageprice_kodeuser'),
                    'harga_paket'       => $this->request->getVar('packageprice_hargatmp'),
                    'bulan'             => $this->request->getVar('packageprice_durasi')
                ];

                $request = Services::request();
                $m_price = new PriceModel($request);

                $m_price->insert($data);

                $msg = [
                    'success' => [
                       'data' => 'Berhasil menambahkan data',
                       'link' => '/admpackageprice'
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
                $m_price = new PriceModel($request);

                $item = $m_price->find($kode);
    
                $data = [
                    'success' => [
                        'kode'          => $item['kode_harga_paket'],
                        'jenis_member'  => $item['kode_jenis_member'],
                        'user_level'    => $item['kode_user_level'],
                        'harga'         => $item['harga_paket'],
                        'bulan'         => $item['bulan']
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
                    'packageprice_hargaubah' => [
                        'label' => 'Harga Paket',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ]
                ]);

                if (!$check) {
                    $msg = [
                        'error' => [
                            "packageprice_hargaubah" => $this->validation->getError('packageprice_hargaubah'),
                        ]
                    ];
                }
                else
                {
                    $data = [
                        'kode_jenis_member' => $this->request->getVar('packageprice_jenismemberubah'),
                        'kode_user_level'   => $this->request->getVar('packageprice_kodeuserubah'),
                        'harga_paket'       => $this->request->getVar('packageprice_hargatmpubah'),
                        'bulan'             => $this->request->getVar('packageprice_durasiubah'),
                    ];
    
                    $kode = $this->request->getVar('packageprice_kodeubah');
    
                    $request = Services::request();
                    $m_price = new PriceModel($request);

                    $m_price->update($kode, $data);
    
                    $msg = [
                        'success' => [
                           'data' => 'Berhasil memperbarui data',
                           'link' => '/admpackageprice'
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
                $m_price = new PriceModel($request);
    
                $m_price->delete($kode);
    
                $msg = [
                    'success' => [
                        'data' => 'Berhasil menghapus data harga paket dengan kode ' . $kode,
                        'link' => '/admpackageprice'
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