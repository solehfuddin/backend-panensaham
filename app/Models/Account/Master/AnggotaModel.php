<?php 
namespace App\Models\Account\Master;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class AnggotaModel extends Model {
    protected $table = 'm_anggota';
    protected $primaryKey = 'username';
    protected $allowedFields = ['username', 'password', 'salt', 'email', 'activation_code', 'forgotten_password_code',
                                'forgotten_password_time', 'remember_code', 'created_on', 'last_login', 'active',
                                'full_name', 'photo', 'foto_ktp', 'ektp', 'jenis_kelamin', 'tempat_lahir', 'foto_kk',
                                'no_kk', 'no_hp', 'tanggal_lahir', 'alamat', 'foto_ktp_ahli_waris', 'additional',
                                'sudah_member', 'member', 'alamat_rumah'];
    protected $column_order = array('', 'email','fullname', 'jenis_kelamin', '');
    protected $column_search = array('email','full_name', 'jenis_kelamin');
    protected $order = array('full_name' => 'asc');
    protected $request;
    protected $db;
    protected $dt;

    function __construct(RequestInterface $request){
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;
        $this->dt = $this->db->table($this->table);
    }

    private function _get_datatables_query(){
        $i = 0;
        foreach ($this->column_search as $item){
            if($this->request->getPost('search')['value']){ 
                if($i===0){
                    $this->dt->groupStart();
                    $this->dt->like($item, $this->request->getPost('search')['value']);
                }
                else{
                    $this->dt->orLike($item, $this->request->getPost('search')['value']);
                }
                if(count($this->column_search) - 1 == $i)
                    $this->dt->groupEnd();
            }
            $i++;
        }
         
        if($this->request->getPost('order')){
                $this->dt->orderBy($this->column_order[$this->request->getPost('order')['0']['column']], $this->request->getPost('order')['0']['dir']);
            } 
        else if(isset($this->order)){
            $order = $this->order;
            $this->dt->orderBy(key($order), $order[key($order)]);
        }
    }

    function get_datatables(){
        $this->_get_datatables_query();
        if($this->request->getPost('length') != -1)
        $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }

    function count_filtered(){
        $this->_get_datatables_query();
        return $this->dt->countAllResults();
    }

    public function count_all(){
        $tbl_storage = $this->db->table($this->table);
        return $tbl_storage->countAllResults();
    }
}