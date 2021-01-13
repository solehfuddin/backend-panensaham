<?php 
namespace App\Controllers\Feedback;
use App\Controllers\BaseController;
use App\Models\Feedback\SubscriberModel;
use Config\Services;

class Subscribercontroller extends BaseController
{
	public function index() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            return view('menufeedback/view_feedbacksubscribe');
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
                $m_subscriber = new SubscriberModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_subscriber->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tombolview = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"viewfeedbacksubscriber('" .$list->id_subscriber. "')\">
                                                <i class=\"fa fa-eye\"></i></button>";

                                $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                                onclick=\"deletefeedbacksubscriber('" .$list->id_subscriber. "')\"> 
                                                <i class=\"fa fa-trash\"></i></button>";

                                $row[] = $no;
                                $row[] = $list->email_address;
                                $row[] = $list->insert_date;
                                $row[] = $tombolview . ' ' . $tombolhapus;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_subscriber->count_all(),
                            "recordsFiltered" => $m_subscriber->count_filtered(),
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
                $m_subscriber = new SubscriberModel($request);
    
                $m_subscriber->delete($kode);
    
                $msg = [
                    'success' => [
                        'data' => 'Berhasil menghapus data subscriber dengan kode ' . $kode,
                        'link' => '/admfeedbacksubscribe'
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