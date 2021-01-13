<?php 
namespace App\Models\Information;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class NewsModel extends Model {
    protected $table = 'pengumuman';
    protected $primaryKey = 'kode_pengumuman';
    protected $allowedFields = ['kode_pengumuman', 'kode_jenis_pengumuman', 'kode_kategori_pengumuman', 
                                'tgl_pengumuman', 'judul', 'isi_pengumuman', 'gambar'];
    protected $column_order = array('', 'tgl_pengumuman', 'kode_jenis_pengumuman', 'kode_kategori_pengumuman', 'judul', '');
    protected $column_search = array('tgl_pengumuman','kode_kategori_pengumuman', 'judul');
    protected $order = array('tgl_pengumuman' => 'desc');
    protected $request;
    protected $db;
    protected $dt;

    function __construct(RequestInterface $request){
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;
        $this->dt = $this->db->table($this->table)->select('*')->join('kategori_pengumuman', 
                        'pengumuman.kode_kategori_pengumuman = kategori_pengumuman.kode_kategori_pengumuman')
                        ->join('jenis_pengumuman', 
                        'pengumuman.kode_jenis_pengumuman = jenis_pengumuman.kode_jenis_pengumuman');
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