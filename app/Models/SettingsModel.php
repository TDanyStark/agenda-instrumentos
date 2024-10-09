<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingsModel extends Model
{
    protected $table = 'settings';
    protected $primaryKey = 'SettingID';
    protected $allowedFields = ['SettingName', 'SettingValue'];

    // Método para actualizar o insertar una configuración
    public function updateOrInsertSetting($name, $value)
    {
        $existing = $this->where('SettingName', $name)->first();

        if ($existing) {
            $this->update($existing['SettingID'], ['SettingValue' => $value]);
        } else {
            $this->insert(['SettingName' => $name, 'SettingValue' => $value]);
        }
    }

    // Método para obtener una configuración por SettingName
    public function getSetting(string $name)
    {
        $setting = $this->where('SettingName', $name)->first();
        return $setting ? $setting['SettingValue'] : null;
    }

    // Método para obtener la hora de inicio y fin general
    public function getGeneralSchedule()
    {
        $horaInicio = $this->getSetting('hora_inicio_general');
        $horaFin = $this->getSetting('hora_fin_general');

        return [
            'hora_inicio' => $horaInicio ? $horaInicio : '',
            'hora_fin'    => $horaFin ? $horaFin : '',
        ];
    }
}
