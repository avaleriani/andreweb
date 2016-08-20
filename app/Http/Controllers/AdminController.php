<?php
namespace App\Http\Controllers;

use App\Models\Punto;
use App\Models\RegistroVoluntario;
use App\Models\Voluntario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function admin_index(Request $request)
    {
        $user = Auth::user();
        if ($user->role == 4) {
            $puntos = Punto::join('user_punto as up', 'up.punto_id', '=', 'punto.id')->where('up.user_id', '=', $user->id);
            $voluntarios = DB::table('voluntario as v')
                ->select('v.dni as dni', 'v.nombre as nom', 'v.apellido as ape', 'v.telefono as tel', 'p.nombreMostrar as pnom', 'rv.id as rvid', 'dc.id as dcid', 'dc.nombre as dcnom', 'rv.estado as estado', 'rv.asistio as asistio')
                ->join('registro_voluntario as rv', 'rv.voluntario_id', '=', 'v.id')
                ->join('user_punto as up', 'up.punto_id', '=', 'rv.punto_id')->where('up.id', '=', $user->id)
                ->join('punto as p ', 'p.id', '=', 'rv.punto_id')
                ->join('punto_dia_colecta as pdc', 'rv.dia_colecta_id', '=', 'pdc.dia_colecta_id')
                ->join('dia_colecta as dc', 'dc.id', '=', 'pdc.dia_colecta_id')
                ->orderBy('dni', 'dcid')
                ->distinct();
            return view('pages.admin.admin_index_jp', [
                'puntos' => $puntos->get(),
                'voluntarios' => $voluntarios->get(),
                'idPunto' => $request->get('punto_id'),
                'estadosMV' => array(0 => "Anotado", 1 => "Confirmado")
            ]);
        } else {
            $mapa = $this->generarMapa();
            $chart = $this->generarChart();

            return view('pages.admin.admin_index', [
                'mapa' => $mapa,
                'barras' => $chart
            ]);
        }
    }

    private function generarChart()
    {
        $ret = array();
        $agregados = array();
        for ($i = 0; $i < 30; $i++) {
            $d[date("Y-m-d", strtotime(' - ' . $i . ' days'))]["val"] = 0;
        }
        $voluntariosReg = RegistroVoluntario::orderBy('registro_voluntario.id');

        switch (Auth::user()->role) {
            case 1 :
                $voluntariosReg->join('sede as EO', 'EO.id', '=', 'registro_voluntario.sede_id');
                $voluntarios = $voluntariosReg->get();
                foreach ($voluntarios as $rg) {
                    if (!in_array($rg->voluntario_id, $agregados)) {
                        if (!isset($ret[$rg->sede->nombre]["anotados"])) {
                            $ret[$rg->sede->nombre]["anotados"] = 0;
                            $ret[$rg->sede->nombre]["confirmados"] = 0;
                            $ret[$rg->sede->nombre]["presentes"] = 0;
                        }
                        if ($rg->estado == 1) { //confirmado
                            $ret[$rg->sede->nombre]["confirmados"] = $ret[$rg->sede->nombre]["confirmados"] + 1;
                        } else {
                            $ret[$rg->sede->nombre]["anotados"] = $ret[$rg->sede->nombre]["anotados"] + 1;
                        }
                        if ($rg->asistio == 1) {
                            $ret[$rg->sede->nombre]["presentes"] = $ret[$rg->sede->nombre]["presentes"] + 1;
                        }
                        $agregados[] = $rg->id;
                        $ret[$rg->sede->nombre]["meta"] = $rg->sede->meta;
                    }
                }
                break;
            case 2 :
            case 3 :
                $voluntariosReg->join('user_punto as UP', 'UP.punto_id', '=', 'registro_voluntario.punto_id');
                $voluntariosReg->where('UP.user_id', Auth::user()->id);
                $voluntarios = $voluntariosReg->get();
                foreach ($voluntarios as $rg) {
                    if (!in_array($rg->voluntario_id, $agregados)) {
                        if (!isset($ret[$rg->zona->nombre]["anotados"])) {
                            $ret[$rg->zona->nombre]["anotados"] = 0;
                            $ret[$rg->zona->nombre]["confirmados"] = 0;
                            $ret[$rg->zona->nombre]["presentes"] = 0;
                        }
                        if ($rg->estado == 1) { //confirmado
                            $ret[$rg->zona->nombre]["confirmados"] = $ret[$rg->zona->nombre]["confirmados"] + 1;
                        } else {
                            $ret[$rg->zona->nombre]["anotados"] = $ret[$rg->zona->nombre]["anotados"] + 1;
                        }
                        if ($rg->asistio == 1) {
                            $ret[$rg->zona->nombre]["presentes"] = $ret[$rg->zona->nombre]["presentes"] + 1;
                        }
                        $agregados[] = $rg->id;
                        $ret[$rg->zona->nombre]["meta"] = $rg->sede->meta;
                    }
                }
                break;
            case 4:
                $voluntariosReg->join('user_punto as UP', 'UP.punto_id', '=', 'registro_voluntario.punto_id');
                $voluntariosReg->join('punto_dia_colecta as PDC', 'PDC.punto_id', '=', 'UP.punto_id');
                $voluntariosReg->where('UP.user_id', Auth::user()->id);
                $voluntarios = $voluntariosReg->get();
                foreach ($voluntarios as $rg) {
                    if (!in_array($rg->voluntario_id, $agregados)) {
                        if (!isset($ret[$rg->diaColecta->nombre]["anotados"])) {
                            $ret[$rg->diaColecta->nombre]["anotados"] = 0;
                            $ret[$rg->diaColecta->nombre]["confirmados"] = 0;
                            $ret[$rg->diaColecta->nombre]["presentes"] = 0;
                        }
                        if ($rg->estado == 1) { //confirmado
                            $ret[$rg->diaColecta->nombre]["confirmados"] = $ret[$rg->diaColecta->nombre]["confirmados"] + 1;
                        } else {
                            $ret[$rg->diaColecta->nombre]["anotados"] = $ret[$rg->diaColecta->nombre]["anotados"] + 1;
                        }
                        if ($rg->asistio == 1) {
                            $ret[$rg->diaColecta->nombre]["presentes"] = $ret[$rg->diaColecta->nombre]["presentes"] + 1;
                        }
                        $agregados[] = $rg->id;
                        $ret[$rg->diaColecta->nombre]["meta"] = $rg->sede->meta;
                    }
                }
                break;

        }

        $las['columns'] = '';
        $las['anotados'] = '';
        $las['confirmados'] = '';
        $las['presentes'] = '';
        $las['meta'] = 0;
        foreach ($ret as $key => $r) {
            $las['columns'] = $las['columns'] . "'" . $key . "'" . ',';
            $las['anotados'] .= $r["anotados"] . ',';
            $las['confirmados'] .= $r['confirmados'] . ',';
            $las['presentes'] .= $r['presentes'] . ',';
            $las['meta'] = $r['meta'];
        }

        return $las;
    }

    private function generarMapa()
    {
        $visitado = array();

        $vols = Voluntario::select('voluntario.*');

        $vols->join('registro_voluntario as RV', 'voluntario.id', '=', 'RV.voluntario_id');

        if (Auth::user()->role != 1) {
            $vols->join('user_punto as UP', 'UP.punto_id', '=', 'RV.punto_id')
                ->where('UP.user_id', '=', Auth::user()->id);
        }

        $sedes = array(
            "Salta" => 0,
            "CordobaRio4" => 0,
            "Misiones" => 0,
            "BA" => 0,
            "NeuquenRN" => 0,
            "SantaFeRosario" => 0,
            "ChacoRrientes" => 0,
            "Tucuman" => 0
        );

        $vols = $vols->get();

//aca tengo todos los voluntarios y las sedes, despues sumo 1 a cada sede por la que pasa el foreach, despues de hacer el registro en el front.
        foreach ($vols as $vol) {
            if (!in_array($vol->id, $visitado)) {
                switch ($vol->registros()->first()->sede_id) {
                    case 3:
                        $sedes["Salta"]++;
                        break;
                    case 8:
                        $sedes["Misiones"]++;
                        break;
                    case 6:
                        $sedes["CordobaRio4"]++;
                        break;
                    case 7:
                        $sedes["CordobaRio4"]++;
                        break;
                    case 4:
                        $sedes["NeuquenRN"]++;
                        break;
                    case 2:
                        $sedes["ChacoRrientes"]++;
                        break;
                    case 1:
                        $sedes["SantaFeRosario"]++;
                        break;
                    case 5:
                        $sedes["Tucuman"]++;
                        break;
                    case 10:
                        $sedes["BA"]++;
                        break;
                }
                $visitado[] = $vol->id;
            }

        }
        return $sedes;
    }

}