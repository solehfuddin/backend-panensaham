<?php 
namespace App\Controllers\Account;
use App\Controllers\BaseController;
use App\Models\Account\UserlevelModel;
use Config\Services;

class Userlevelcontroller extends BaseController
{
	public function index() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            return view('menuaccount/view_accountuserlevel');
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
                $m_usrlvl = new UserlevelModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_usrlvl->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tomboledit = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editaccountuserlevel('" .$list->kode_user_level. "')\">
                                                <i class=\"fa fa-edit\"></i></button>";

                                $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                                onclick=\"deleteaccountuserlevel('" .$list->kode_user_level. "')\"> 
                                                <i class=\"fa fa-trash\"></i></button>";

                                $row[] = $no;
                                $row[] = $list->kode_user_level;
                                $row[] = $list->nama_level;
                                $row[] = $list->alias_level;
                                $row[] = $tomboledit . ' ' . $tombolhapus;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_usrlvl->count_all(),
                            "recordsFiltered" => $m_usrlvl->count_filtered(),
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
                $m_usrlvl = new UserlevelModel($request);

                $getdata = $m_usrlvl->findAll();
                $max  = count($getdata) + 1;
                $gen  = "MULV" . str_pad($max, 3, 0, STR_PAD_LEFT);

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
                    'accountuserlevel_kode' => [
                        'label' => 'Kode user level',
                        'rules' => [
                            'required',
                            'is_unique[m_user_level.kode_user_level]',
                        ],
                        'errors' => [
                            'required' 		=> '{field} wajib terisi',
                            'is_unique'	    => '{field} tidak boleh sama, coba dengan kode yang lain'
                        ],
                    ],
    
                    'accountuserlevel_nama' => [
                        'label' => 'Nama level',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],

                    'accountuserlevel_alias' => [
                        'label' => 'Alias user level',
                        'rules' => [
                            'required',
                            'is_unique[m_user_level.alias_level]',
                        ],
                        'errors' => [
                            'required' 		=> '{field} wajib terisi',
                            'is_unique'	    => '{field} tidak boleh sama, coba dengan kode yang lain'
                        ],
                    ],
                ]);
            }
            else
            {
                return view('errors/html/error_404');
            }

            if (!$validationCheck) {
				$msg = [
					'error' => [
						"accountuserlevel_kode" => $this->validation->getError('accountuserlevel_kode'),
                        "accountuserlevel_nama" => $this->validation->getError('accountuserlevel_nama'),
                        "accountuserlevel_alias" => $this->validation->getError('accountuserlevel_alias'),
					]
				];
			}
			else
			{
                $data = [
                    'kode_user_level' => $this->request->getVar('accountuserlevel_kode'),
                    'nama_level' => $this->request->getVar('accountuserlevel_nama'),
                    'alias_level' => $this->request->getVar('accountuserlevel_alias'),
                    'keterangan' => $this->request->getVar('accountuserlevel_keterangan'),
                    'info_tambahan' => $this->request->getVar('accountuserlevel_infolanjut'),
                ];

                $request = Services::request();
                $m_usrlvl = new UserlevelModel($request);

                $m_usrlvl->insert($data);

                $msg = [
                    'success' => [
                       'data' => 'Berhasil menambahkan data',
                       'link' => '/admaccountuserlevel'
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
                $m_usrlvl = new UserlevelModel($request);

                $item = $m_usrlvl->find($kode);
    
                $data = [
                    'success' => [
                        'kodeuser' => $item['kode_user_level'],
                        'level' => $item['nama_level'],
                        'alias' => $item['alias_level'],
                        'keterangan' => $item['keterangan'],
                        'infolanjut' => $item['info_tambahan'],
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
                    'accountuserlevel_namaubah' => [
                        'label' => 'Nama level',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
                ]);

                if (!$check) {
                    $msg = [
                        'error' => [
                            "accountuserlevel_namaubah" => $this->validation->getError('accountuserlevel_namaubah'),
                        ]
                    ];

                    echo json_encode($msg);
                }
                else
                {
                    $request = Services::request();
                    $m_usrlvl = new UserlevelModel($request);

                    $kode  = $this->request->getVar('accountuserlevel_kodeubah');
                    $tmp   = $m_usrlvl->checkalias($kode);
                    $tmpCheck = $tmp[0]['alias_level'];
                    // $temp  = $this->request->getVar('accountuserlevel_aliasdefault');
                    $alias = $this->request->getVar('accountuserlevel_aliasubah');

                    if ($tmpCheck == $alias)
                    {
                        // $msg = [
                        //     'error' => [
                        //         "accountuserlevel_namaubah" => $tmpCheck,
                        //         "accountuserlevel_aliasubah" => "Data sama",
                        //     ]
                        // ];

                        $data = [
                            'nama_level' => $this->request->getVar('accountuserlevel_namaubah'),
                            'alias_level' => $this->request->getVar('accountuserlevel_aliasubah'),
                            'keterangan' => $this->request->getVar('accountuserlevel_keteranganubah'),
                            'info_tambahan' => $this->request->getVar('accountuserlevel_infolanjutubah'),
                        ];
        
                        $kode = $this->request->getVar('accountuserlevel_kodeubah');
        
                        $request = Services::request();
                        $m_usrlvl = new UserlevelModel($request);
    
                        $m_usrlvl->update($kode, $data);
        
                        $msg = [
                            'success' => [
                               'data' => 'Berhasil memperbarui data',
                               'link' => '/admaccountuserlevel'
                            ]
                        ];
                    }
                    else
                    {
                        // $msg = [
                        //     'error' => [
                        //         "accountuserlevel_namaubah" => $tmpCheck,
                        //         "accountuserlevel_aliasubah" => "Data beda",
                        //     ]
                        // ];

                        $checkalias = $this->validate([
                            'accountuserlevel_aliasubah' => [
                                'label' => 'Alias user level',
                                'rules' => [
                                    'required',
                                    'is_unique[m_user_level.alias_level]',
                                ],
                                'errors' => [
                                    'required' 		=> '{field} wajib terisi',
                                    'is_unique'	    => '{field} tidak boleh sama, coba dengan kode yang lain'
                                ],
                            ],
                        ]);
    
                        if (!$checkalias) {
                            $msg = [
                                'error' => [
                                    "accountuserlevel_aliasubah" => $this->validation->getError('accountuserlevel_aliasubah'),
                                ]
                            ];
                        }
                        else
                        {
                            $data = [
                                'nama_level' => $this->request->getVar('accountuserlevel_namaubah'),
                                'alias_level' => $this->request->getVar('accountuserlevel_aliasubah'),
                                'keterangan' => $this->request->getVar('accountuserlevel_keteranganubah'),
                                'info_tambahan' => $this->request->getVar('accountuserlevel_infolanjutubah'),
                            ];
            
                            $kode = $this->request->getVar('accountuserlevel_kodeubah');
            
                            $request = Services::request();
                            $m_usrlvl = new UserlevelModel($request);
        
                            $m_usrlvl->update($kode, $data);
            
                            $msg = [
                                'success' => [
                                   'data' => 'Berhasil memperbarui data',
                                   'link' => '/admaccountuserlevel'
                                ]
                            ];
                        }
                    }

                    echo json_encode($msg);
                }
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
                $m_usrlvl = new UserlevelModel($request);
    
                $m_usrlvl->delete($kode);
    
                $msg = [
                    'success' => [
                        'data' => 'Berhasil menghapus data user level dengan kode ' . $kode,
                        'link' => '/admaccountuserlevel'
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