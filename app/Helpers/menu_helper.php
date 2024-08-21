<?php

// application/helpers/my_helper.php
if (!function_exists('get_menu')) {
    function get_menu() {
        // si es admin
        if (session()->get("role") == "admin") {
            return [
                [
                    "name" => "Inicio",
                    "url" => "/inicio"
                ],
                [
                    "name" => "Estudiantes",
                    "url" => "/estudiantes"
                ],
                [
                    "name" => "Profesores",
                    "url" => "/profesores"
                ],
                [
                    "name" => "Instrumentos",
                    "url" => "/instrumentos"
                ],
                [
                    "name" => "Salones",
                    "url" => "/salones"
                ],
                [
                    "name" => "Cursos",
                    "url" => "/cursos"
                ]
            ];
        } elseif (session()->get("role") == "student") {
            return [
                [
                    "name" => "Seleccionar",
                    "url" => "#"
                ],
                [
                    "name" => "Ver",
                    "url" => "#"
                ]
            ];
        }
    }
}