<?php 
namespace App\Controllers\Account\Master;
use App\Controllers\BaseController;
use App\Models\Account\Master\AnggotaModel;
use Config\Services;

class Anggotacontroller extends BaseController
{
	public function index() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            return view('menuaccount/submenumaster/view_masteranggota');
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
                $m_anggota = new AnggotaModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_anggota->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tomboledit = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editaccountmember('" .$list->username. "')\">
                                                <i class=\"fa fa-edit\"></i></button>";

                                // $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                //                 onclick=\"deleteaccountmember('" .$list->kode_jenis_member. "')\"> 
                                //                 <i class=\"fa fa-trash\"></i></button>";

                                $row[] = $no;
                                $row[] = $list->username;
                                $row[] = $list->email;
                                $row[] = $list->full_name;
                                $row[] = $list->jenis_kelamin;
                                $row[] = $tomboledit;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_anggota->count_all(),
                            "recordsFiltered" => $m_anggota->count_filtered(),
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
}