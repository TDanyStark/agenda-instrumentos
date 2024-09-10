<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    public function authStudent($cedula)
    {
        
        $cedulaEscaped = $this->db->escape($cedula);
        
        $query = $this->db->query("SELECT * FROM students WHERE Cedula = $cedulaEscaped");
        $result = $query->getRow();

        // comprobar si status es = 1

        if ($result && $result->Status == 1) {
            return array(
                "FirstName" => $result->FirstName,
                "cedula" => $result->Cedula,
                "email" => $result->Email,
                "role" => "student"
            );
        }

        return false;
    }

    public function authAdmin($cedula, $password){
        // Conectar a la base de datos
        
        // Escapar valores correctamente y ejecutar la consulta
        $cedulaEscaped = $this->db->escape($cedula);
        $query = $this->db->query("SELECT * FROM users WHERE cedula = $cedulaEscaped");

        // Obtener el resultado
        $result = $query->getRow();

        if ($result && password_verify($password, $result->password)) {
            return array(
                "cedula" => $result->cedula,
                "role" => $result->role
            );
        }

        return false;
    }

    public function validateAdmin($cedula)
    {
        
        $cedulaEscaped = $this->db->escape($cedula);
        
        $query = $this->db->query("SELECT * FROM users WHERE cedula = $cedulaEscaped");
        $result = $query->getRow();

        if ($result && $result->role == 'admin') {
            return true;
        }

        return false;
    }
}

