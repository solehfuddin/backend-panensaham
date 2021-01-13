<?php 
namespace App\Controllers\Feedback;
use App\Controllers\BaseController;
use App\Models\Feedback\QuestionModel;
use Config\Services;

class Questioncontroller extends BaseController
{
	public function index() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            return view('menufeedback/view_feedbackquestion');
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
                $m_question = new QuestionModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_question->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $no++;
                                $row = [];

                                $tombolview = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"viewfeedbackquestion('" .$list->id_contact_us. "')\">
                                                <i class=\"fa fa-eye\"></i></button>";

                                $tombolhapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" 
                                                onclick=\"deletefeedbackquestion('" .$list->id_contact_us. "')\"> 
                                                <i class=\"fa fa-trash\"></i></button>";

                                $row[] = $no;
                                $row[] = $list->nama;
                                $row[] = $list->email;
                                $row[] = $list->no_hp;
                                $row[] = $list->insert_date;
                                $row[] = $tombolview . ' ' . $tombolhapus;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_question->count_all(),
                            "recordsFiltered" => $m_question->count_filtered(),
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
                $m_question = new QuestionModel($request);
    
                $m_question->delete($kode);
    
                $msg = [
                    'success' => [
                        'data' => 'Berhasil menghapus data contact us dengan kode ' . $kode,
                        'link' => '/admfeedbackquestion'
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