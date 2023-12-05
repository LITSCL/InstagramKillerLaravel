<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class FormatearFecha 
{
    
    public static function filtrarTiempoTranscurrido($fecha) 
    {
        if ($fecha == null) {
            return "Sin fecha";
        }
        
        $transcurso = $fecha->diff(new \DateTime(date("Y-m-d") . " " . date("H:i:s")));
        
        if ($transcurso->y == 0) { //Comprobando si no ha transcurrido un año (Desde la fecha entregada con la fecha del PC).
            if ($transcurso->m == 0) {
                if ($transcurso->d == 0) {
                    if ($transcurso->h == 0) {
                        if ($transcurso->i == 0) {
                            if ($transcurso->s == 0) {
                                $resultado = $transcurso->s . " segundos";
                            } else {
                                if ($transcurso->s == 1) {
                                    $resultado = $transcurso->s . " segundo";
                                } else {
                                    $resultado = $transcurso->s . " segundos";
                                }
                            }
                        } else {
                            if ($transcurso->i == 1) {
                                $resultado = $transcurso->i . " minuto";
                            } else {
                                $resultado = $transcurso->i . " minutos";
                            }
                        }
                    } else {
                        if ($transcurso->h == 1) {
                            $resultado = $transcurso->h . " hora";
                        } else {
                            $resultado = $transcurso->h . " horas";
                        }
                    }
                } else {
                    if ($transcurso->d == 1) {
                        $resultado = $transcurso->d . " día";
                    } else {
                        $resultado = $transcurso->d . " días";
                    }
                }
            } else {
                if ($transcurso->m == 1) {
                    $resultado = $transcurso->m . " mes";
                } else {
                    $resultado = $transcurso->m . " meses";
                }
            }
        } else {
            if ($transcurso->y == 1) {
                $resultado = $transcurso->y . " año";
            } else {
                $resultado = $transcurso->y . " años";
            }
        }     
        return "Hace " . $resultado;
    }
    
}