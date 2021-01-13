<?php 
namespace App\Models\Account\Master;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class KomunitasModel extends Model {
    protected $table = 'm_komunitas';
    protected $primaryKey = 'client_id';
    protected $allowedFields = ['client_id', 'user_id', 'kode_account', 'client_id_date', 'mtbl_id', 'mtbl_date',
                                'name', 'address', 'office_address', 'office_name', 'birth_date', 'mothers_name',
                                'email', 'phone', 'cellular', 'no_rek_tsi', 'opening_date', 'remark', 'send_date',
                                'id_no', 'sid_no', 'npwp_no', 'branch_id', 'cabang_induk_id', 'others', 'marketing_id',
                                'marketing_id_2', 'marketing_id_3', 'marketing', 'pendapatan_kotor', 'sumber_dana', 
                                'jenis_kelamin', 'tanggal_pengiriman_oa', 'resi_pengiriman', 'ekspedisi_pengiriman',
                                'tanggal_retur', 'ket_tanggal_retur', 'tanggal_retur_kirim', 'oa_keterangan', 
                                'status_transaksi', 'status_edukasi', 'nilai_cash', 'nilai_portofolio', 
                                'tgl_transaksi_terakhir', 'status_nasabah', 'tenaga_edukasi', 'fu1_date', 'fu1_ket',
                                'fu2_date', 'fu2_ket', 'fu3_date', 'fu3_ket', 'setor_dana', 'terima_email_awal',
                                'sosmed', 'status', 'create_user', 'create_date', 'update_user', 'update_date', 
                                'email_subscribe'];
    protected $column_order = array('', 'client_id','email', 'name', 'jenis_kelamin', '');
    protected $column_search = array('client_id','email', 'name');
    protected $order = array('name' => 'asc');
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