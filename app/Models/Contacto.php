<?php 
namespace App\Models;

use CodeIgniter\Model;

class Contacto extends Model{
    protected $table      = 'info_contacto';
    protected $primaryKey = 'id';
    protected $allowedFields = ['telefono','direccion','poblacion','cp','pais','empleado'];
}