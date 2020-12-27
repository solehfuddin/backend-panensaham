<?php 
namespace App\Controllers\Media;
use App\Controllers\BaseController;
use App\Models\Media\FiltermedModel;
use Config\Services;

class Filtermedcontroller extends BaseController
{
	public function index() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            return view('menumedia/view_mediafilter');
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
                $m_filter = new FiltermedModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_filter->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tomboledit = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editmediafilter('" .$list->kode_filter_media. "')\">
                                                <i class=\"fa fa-edit\"></i></button>";

                                $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                                onclick=\"deletemediafilter('" .$list->kode_filter_media. "')\"> 
                                                <i class=\"fa fa-trash\"></i></button>";

                                $row[] = $no;
                                $row[] = $list->kode_filter_media;
                                $row[] = $list->judul_filter;
                                $row[] = $tomboledit . ' ' . $tombolhapus;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_filter->count_all(),
                            "recordsFiltered" => $m_filter->count_filtered(),
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
                $m_filter = new FiltermedModel($request);

                $getdata = $m_filter->findAll();
                $max  = count($getdata) + 1;
                $gen  = "FMED" . str_pad($max, 3, 0, STR_PAD_LEFT);

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
                    'mediafilter_kode' => [
                        'label' => 'Kode filter media',
                        'rules' => [
                            'required',
                            'is_unique[filter_media.kode_filter_media]',
                        ],
                        'errors' => [
                            'required' 		=> '{field} wajib terisi',
                            'is_unique'	    => '{field} tidak boleh sama, coba dengan kode yang lain'
                        ],
                    ],
    
                    'mediafilter_nama' => [
                        'label' => 'Judul filter',
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
						"mediafilter_kode" => $this->validation->getError('mediafilter_kode'),
						"mediafilter_nama" => $this->validation->getError('mediafilter_nama'),
					]
				];
			}
			else
			{
                $data = [
                    'kode_filter_media' => $this->request->getVar('mediafilter_kode'),
                    'judul_filter' => $this->request->getVar('mediafilter_nama'),
                ];

                $request = Services::request();
                $m_filter = new FiltermedModel($request);

                $m_filter->insert($data);

                $msg = [
                    'success' => [
                       'data' => 'Berhasil menambahkan data jenis pengumuman',
                       'link' => '/admmediafilter'
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
                $m_filter = new FiltermedModel($request);

                $item = $m_filter->find($kode);
    
                $data = [
                    'success' => [
                        'kode' => $item['kode_filter_media'],
                        'judul' => $item['judul_filter'],
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
                    'mediafilter_namaubah' => [
                        'label' => 'Ubah judul filter',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ]
                ]);

                if (!$check) {
                    $msg = [
                        'error' => [
                            "mediafilter_namaubah" => $this->validation->getError('mediafilter_namaubah'),
                        ]
                    ];
                }
                else
                {
                    $data = [
                        'judul_filter' => $this->request->getVar('mediafilter_namaubah'),
                    ];
    
                    $kode = $this->request->getVar('mediafilter_kodeubah');
    
                    $request = Services::request();
                    $m_filter = new FiltermedModel($request);

                    $m_filter->update($kode, $data);
    
                    $msg = [
                        'success' => [
                           'data' => 'Berhasil memperbarui data',
                           'link' => '/admfiltermed'
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
                $m_filter = new FiltermedModel($request);
    
                $m_filter->delete($kode);
    
                $msg = [
                    'success' => [
                        'data' => 'Berhasil menghapus data jenis pengumuman dengan kode ' . $kode,
                        'link' => '/admmediafilter'
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