<?php 
namespace App\Models;

use CodeIgniter\Model;

class Usuario extends Model{
    protected $table      = 'usuario';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username','email','passwd'];
}