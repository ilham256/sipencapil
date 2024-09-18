<?php

namespace App\Models;

use CodeIgniter\Model;

class CplModel extends Model
{
    protected $table = 'cpl';
    protected $primaryKey = 'id';
    protected $useTimestamps = false;
    protected $returnType = 'object';
    
    public function getCpls($order = 'asc')
    {
        return $this->orderBy('id', $order)->findAll();
    }
}
?>
