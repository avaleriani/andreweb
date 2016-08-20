<?php
namespace App\Http\Controllers;

use App\Models\Ciudad;
use App\Models\Correo;
use App\Models\Equipofijo;
use App\Models\Punto;
use App\Models\PuntoDiaColecta;
use App\Models\RegistroVoluntario;
use App\Models\Sede;
use App\Models\User;
use App\Models\Voluntario;
use App\Models\Zona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AjaxController extends Controller
{
//TODO IMPORTANTE::  agregar validacion ajax logeado?
    CONST PUNTO = 1;
    CONST ZONA = 2;
    CONST CIUDADS = 3;
    CONST SEDE = 4;

    CONST D_ZONAL = 3;

    protected $res = array("success" => 'false', "mensaje" => 'error');
    protected $dataVol = array();
    protected $sedeEmail = '';

    public function saveVoluntario(Request $request)
    {
        if ($request->ajax()) {
            if ($this->validateDatos($request)) {
                @$this->GuardarCsvVoluntario($request);
                $this->res["success"] = false;
                $this->res["mensaje"] = 'Error, intente nuevamente.';
                $voluntario = $this->GuardarVoluntario($request);
                if ($voluntario) {
                    $rv = $this->GuardarRV($request, $voluntario);
                    if ($rv) {
                        $this->res["success"] = true;
                        $this->res["mensaje"] = 'Anotado!';

                        @$this->EnviarEmailBienvenida($voluntario, $this->dataVol);
                    }
                } else {
                    $this->res["mensaje"] = 'Error, no se pudo completar el registro, intenta mas tarde.';
                }
            }
            return response()->json(['result' => $this->res]);
        }
        return false;
    }

    private function GuardarCsvVoluntario(Request $request)
    {
        $csv_handler = fopen('voluntades.csv', 'a+'); //todo ubicar mejor este archivo
        fwrite($csv_handler, serialize($request->all()));
        fclose($csv_handler);
    }

    private function EnviarEmailBienvenida($vol, $dataVoluntario)
    {
        $cm = new Correo;
        $cm->voluntario_id = $vol->id;
        $cm->tipo_mail = 'Bienvenida';
        $cm->arr_sender = base64_encode(json_encode(array('colecta.argentina@techo.org' => 'TECHO')));
        $cm->arr_to = base64_encode(json_encode(array($vol->email => $vol->nombre)));
        $cm->arr_replyto = !isset($this->sedeEmail) || empty($this->sedeEmail) ? 'colecta.argentina@techo.org' : $this->sedeEmail;
        $cm->arr_subject = '¡Ya estás anotado en la #colectaTECHO!';
        $cm->arr_emailvars = base64_encode(json_encode(array('nombre' => $vol->nombre, 'tabla' => $dataVoluntario, 'edad' => $this->getAge($vol->fnac))));
        $cm->status = '1'; //estado a enviar.
        $cm->hash = Hash::make($vol->email);
        $cm->colecta_id = Session::get('idColecta');

        $cm->save();
    }

    public function editarVoluntario(Request $request)
    {
        if ($request->ajax()) {
            $this->res["success"] = false;
            $this->res["mensaje"] = 'Error, intente nuevamente.';
            $email = $request->get("editarVoluntarioText");
            $dni = $request->get("editarVoluntarioDni");
            if ($dni && $email) {
                $vol = Voluntario::where('dni', $dni)->where('email', $email)->first();
                if ($vol) {
                    $cm = new Correo;
                    $hash = Hash::make($vol->email);
                    $cm->voluntario_id = $vol->id;
                    $cm->tipo_mail = 'Editar';
                    $cm->arr_sender = base64_encode(json_encode(array('colecta.argentina@techo.org' => 'TECHO')));
                    $cm->arr_to = base64_encode(json_encode(array($vol->email => $vol->nombre)));
                    $cm->arr_replyto = 'colecta.argentina@techo.org';
                    $cm->arr_subject = 'Colecta techo ' . Session::get('year') . ' - Edita tus datos';
                    $cm->arr_emailvars = base64_encode(json_encode(array('nombre' => $vol->nombre, 'link' => route('editar') . "/?email=" . $vol->email . "&hash=" . $hash)));
                    $cm->status = '1'; //estado a enviar.
                    $cm->hash = $hash;
                    $cm->colecta_id = Session::get('idColecta');

                    if ($cm->save()) {
                        $this->res["success"] = true;
                        $this->res["mensaje"] = 'En unos minutos recibiras el correo para cambiar tus datos!';
                    }
                } else {
                    $this->res["mensaje"] = 'Combinacion de DNI y correo no encontrada, verifique sus datos.';
                }
            } else {
                $this->res["mensaje"] = 'Error, no se pudo completar el registro, intenta mas tarde.';
            }
        }

        return response()->json(['result' => $this->res]);
    }

    public function reenviarCorreo(Request $request)
    {
        if ($request->ajax()) {
            $this->res["success"] = false;
            $this->res["mensaje"] = 'Error, intente nuevamente.';
            $idVoluntario = $request->get('idVoluntario');
            if ($idVoluntario) {
                $vol = Voluntario::find($idVoluntario);
                if ($vol) {
                    $hash = Hash::make($vol->email);
                    $cm = new Correo;
                    $cm->voluntario_id = $vol->id;
                    $cm->tipo_mail = 'ManualDatos';
                    $cm->arr_sender = base64_encode(json_encode(array('colecta.argentina@techo.org' => 'TECHO')));
                    $cm->arr_to = base64_encode(json_encode(array($vol->email => $vol->nombre)));
                    $cm->arr_replyto = 'colecta.argentina@techo.org';
                    $cm->arr_subject = 'Colecta techo ' . date("Y") . ' - Completa tus datos';
                    $cm->arr_emailvars = base64_encode(json_encode(array('nombre' => $vol->nombre, 'link' => route('editar') . "/?email=" . $vol->email . "&hash=" . $hash)));
                    $cm->status = '1'; //estado a enviar.
                    $cm->hash = $hash;
                    $cm->colecta_id = Session::get('idColecta');

                    if ($cm->save()) {
                        $this->res["success"] = true;
                        $this->res["mensaje"] = 'En unos minutos se enviara al voluntario el correo para cambiar los datos!';
                    }
                } else {
                    $this->res["mensaje"] = 'No se encontro el id de voluntario.';
                }

            } else {
                $this->res["mensaje"] = 'Error, no se pudo completar el registro, intenta mas tarde.';
            }
        }
        return response()->json(['result' => $this->res]);
    }

    private function getAge($birthdate)
    {
        $adjust = (date("md") >= date("md", strtotime($birthdate))) ? 0 : -1; // Si aún no hemos llegado al día y mes en este año restamos 1
        $years = date("Y") - date("Y", strtotime($birthdate)); // Calculamos el número de años
        return (string)$years + $adjust; // Sumamos la diferencia de años más el ajuste
    }

    private function GuardarVoluntario(Request $request)
    {
        $vol = new Voluntario;
        $vol->nombre = $request->get("nombre");
        $vol->apellido = $request->get("apellido");
        $vol->dni = $request->get("dni");
        $vol->email = $request->get("mail");
        $vol->telefono = $request->get("telefono");
        $vol->fnac = $request->get("fnac");
        $vol->estado = 1; //Anotado
        $vol->colecta_id = Session::get('idColecta');
        if ($vol->save()) {
            return $vol;
        } else {
            return false;
        }
    }

    private function GuardarRV(Request $request, $voluntario)
    {
        $this->sedeEmail = '';
        $idSede = $request->get('sede');
        if ($idSede) {
            $sede = Sede::find($idSede);
            if ($sede) {
                $this->sedeEmail = $sede->mail;
            }
        }

        //guardo VIERNES
        if ($request->get("punto1") != null && $request->get("punto1") != 'null' && $request->get("punto1") != 0) {
            $punto1 = Punto::find($request->get("punto1"));
            $zona1 = Zona::find($punto1->zona_id);
            if ($zona1) {
                $ciudad1 = Ciudad::find($zona1->ciudad_id);
                if ($ciudad1) {
                    $idPunto1 = $request->get("punto1");

                    $r1 = new RegistroVoluntario;
                    $r1->voluntario_id = $voluntario->id;
                    $r1->sede_id = $ciudad1->sede_id;
                    $r1->ciudad_id = $ciudad1->id;
                    $r1->zona_id = $zona1->id;
                    $r1->punto_id = $idPunto1;
                    $r1->dia_colecta_id = 1; //VIERNES
                    $r1->estado = 0; //ANOTADO
                    $r1->asistio = 0;
                    $r1->colecta_id = Session::get('idColecta');

                    $r1->save();

                    $puntoDiaColecta1 = PuntoDiaColecta::where('punto_id', '=', $punto1->id)->where('dia_colecta_id', '=', 1)->first();

                    $this->dataVol["Viernes"]["punto"] = $punto1->nombreMostrar;
                    $this->dataVol["Viernes"]["informacion"] = $puntoDiaColecta1 ? $puntoDiaColecta1->informacion : '';
                    $this->dataVol["Viernes"]["zona"] = $zona1->nombreMostrar;
                    $this->dataVol["Viernes"]["fb"] = $zona1->fb;
                }
            }
        }

        //VIERNES FIN

        //guardo SABADO
        if ($request->get("punto2") != null && $request->get("punto2") != 'null' && $request->get("punto2") != 0) {
            $punto2 = Punto::find($request->get("punto2"));
            $zona2 = Zona::find($punto2->zona_id);
            if ($zona2) {
                $ciudad2 = Ciudad::find($zona2->ciudad_id);
                if ($ciudad2) {
                    $idPunto2 = $request->get("punto2");

                    $r2 = new RegistroVoluntario;
                    $r2->voluntario_id = $voluntario->id;
                    $r2->sede_id = $ciudad2->sede_id;
                    $r2->ciudad_id = $ciudad2->id;
                    $r2->zona_id = $zona2->id;
                    $r2->punto_id = $idPunto2;
                    $r2->dia_colecta_id = 2; //SABADO
                    $r2->estado = 0; //ANOTADO
                    $r2->asistio = 0;
                    $r2->colecta_id = Session::get('idColecta');

                    $r2->save();

                    $puntoDiaColecta2 = PuntoDiaColecta::where('punto_id', '=', $punto2->id)->where('dia_colecta_id', '=', 2)->first();

                    $this->dataVol["Sabado"]["punto"] = $punto2->nombreMostrar;
                    $this->dataVol["Sabado"]["informacion"] = $puntoDiaColecta2 ? $puntoDiaColecta2->informacion : '';
                    $this->dataVol["Sabado"]["zona"] = $zona2->nombreMostrar;
                    $this->dataVol["Sabado"]["fb"] = $zona2->fb;
                }
                //SABADO FIN
            }
        }
        //guardo DOMINGO

        if ($request->get("punto3") != null && $request->get("punto3") != 'null' && $request->get("punto3") != 0) {
            $punto3 = Punto::find($request->get("punto3"));
            $zona3 = Zona::find($punto3->zona_id);
            if ($zona3) {
                $ciudad3 = Ciudad::find($zona3->ciudad_id);
                if ($ciudad3) {
                    $idPunto3 = $request->get("punto3");

                    $r3 = new RegistroVoluntario;
                    $r3->voluntario_id = $voluntario->id;
                    $r3->sede_id = $ciudad3->sede_id;
                    $r3->ciudad_id = $ciudad3->id;
                    $r3->zona_id = $zona3->id;
                    $r3->punto_id = $idPunto3;
                    $r3->dia_colecta_id = 3; //DOMINGO
                    $r3->estado = 0; //ANOTADO
                    $r3->asistio = 0;
                    $r3->colecta_id = Session::get('idColecta');

                    $r3->save();

                    $puntoDiaColecta3 = PuntoDiaColecta::where('punto_id', '=', $punto3->id)->where('dia_colecta_id', '=', 3)->first();

                    $this->dataVol["Domingo"]["punto"] = $punto3->nombreMostrar;
                    $this->dataVol["Domingo"]["informacion"] = $puntoDiaColecta3 ? $puntoDiaColecta3->informacion : '';
                    $this->dataVol["Domingo"]["zona"] = $zona3->nombreMostrar;
                    $this->dataVol["Domingo"]["fb"] = $zona3->fb;
                }
                //DOMINGO FIN
            }
        }
        return true;
    }

    private function GetEncargadoZona($zona, $idDiaColecta = 1)
    {
        $rt = array();

        $usuarios = User::join('user_punto', 'user.id', '=', 'user_punto.user_id')
            ->join('punto', 'punto.id', '=', 'user_punto.punto_id')
            ->where('user.role', 3)//encargado de zona
            ->where('user_punto.dia_colecta_id', $idDiaColecta)
            ->where('punto.zona_id', $zona->id)
            ->get();

        $i = 0;
        foreach ($usuarios as $usuario) {
            $rt[$i]["nombre"] = $usuario["User"]["nombre"];
            $rt[$i]["email"] = $usuario["User"]["email"];
            $i++;
        }
        return $rt;
    }

    private function validateDatos(Request $request)
    {
        if (!empty($request->get('mail')) && !empty($request->get('dni'))){
            $vol = Voluntario::where('dni', $request->get('dni'))->first();
            if ($vol) {
                $this->res["success"] = false;
                $this->res["mensaje"] = 'Ya se encuentra registrado un voluntario con este dni.';
                return false;
            } else {
                $vol = Voluntario::where('email', $request->get('mail'))->first();
                if ($vol) {
                    $this->res["success"] = false;
                    $this->res["mensaje"] = 'Ya se encuentra registrado un voluntario con este email.';
                    return false;
                } else {
                    return true;
                }
            }
        }else{
            $this->res["success"] = false;
            $this->res["mensaje"] = 'Por favor complete todos los datos para continuar con el registro.';
            return false;
        }
    }

    public function getCiudades(Request $request)
    {

        if ($request->ajax()) {
            $idSede = $request->get("sede_id");
            if ($idSede) {
                $ciudades = Ciudad::select('ciudad.*');
                if (!Auth::user()->isAdmin()) {
                    $ciudades->join('zona', 'zona.ciudad_id', '=', 'ciudad.id')
                        ->join('punto', 'punto.zona_id', '=', 'zona.id')
                        ->join('user_punto as UP', 'UP.punto_id', '=', 'punto.id')
                        ->where('UP.user_id', Auth::user()->id);
                }
                $ciudades->where('ciudad.sede_id', '=', $idSede);
                $ret["success"] = true;
                $ret["ciudades"] = $ciudades->groupBy('ciudad.id')->get()->toArray();
            } else {
                $ret["success"] = true;
                $ret["ciudades"] = array();
            }
        } else {
            $ret['success'] = false;
            $ret["message"] = 'No fue posible traer las ciudades';
        }
        return response()->json($ret);
    }

    public function getZonas(Request $request)
    {
        if ($request->ajax()) {
            $idCiudad = $request->get("ciudad_id");
            if ($idCiudad) {
                $zonas = Zona::select('zona.*');

                if (!Auth::user()->isAdmin()) {
                    $zonas->join('punto', 'punto.zona_id', '=', 'zona.id')
                        ->join('user_punto as UP', 'UP.punto_id', '=', 'punto.id')
                        ->where('UP.user_id', Auth::user()->id);
                }
                $zonas->where('zona.ciudad_id', '=', $idCiudad);
                $ret["success"] = true;
                $ret["zonas"] = $zonas->groupBy('zona.id')->get()->toArray();
            } else {
                $ret["success"] = true;
                $ret["zonas"] = array();
            }
        } else {
            $ret["success"] = false;
            $ret["message"] = 'No fue posible traer las zonas';
        }
        return response()->json($ret);
    }

    public function getPuntos(Request $request)
    {
        if ($request->ajax()) {
            $idZona = $request->get("zona_id");
            if ($idZona) {
                $puntos = Punto::select('punto.*');
                if (!Auth::user()->isAdmin()) {
                    $puntos->join('user_punto as UP', 'UP.punto_id', '=', 'punto.id')
                        ->where('UP.user_id', Auth::user()->id);
                }
                $puntos->where('punto.zona_id', '=', $idZona);
                $ret["success"] = true;
                $ret["puntos"] = $puntos->groupBy('punto.id')->get()->toArray();

            } else {
                $ret["success"] = true;
                $ret["puntos"] = array();
            }
        } else {
            $ret["success"] = false;
            $ret["message"] = 'No fue posible traer los puntos';
        }
        return response()->json($ret);
    }

    public function saveAsistencia(Request $request)
    {
        $ret = null;
        if ($request->ajax()) {
            $idRegistro = $request->get("idRegistro");
            $asistio = $request->get("asistio");

            $rv = RegistroVoluntario::find($idRegistro);
            if ($asistio == 'true') {
                $mensaje = 'Asistencia confirmada';
                $rv->asistio = 1;
            } else {
                $mensaje = 'Asistencia no confirmada';
                $rv->asistio = 0;
            }
            $rv->save();
            if ($rv) {
                $ret["success"] = true;
                $ret["message"] = $mensaje;
            } else {
                $ret["success"] = false;
                $ret["message"] = 'Error al confirmar';
            }
        }
        return response()->json($ret);
    }

    function saveEquipoFijo(Request $request)
    {
        if ($request->ajax()) {
            $idVoluntario = $request->get("idVoluntario");
            $tipoPregunta = $request->get("tipoPregunta");
            $valor = $request->get("valor");
            if ($valor == 'true') {
                $valor = 1;
            } else {
                $valor = 0;
            }

            $ef = EquipoFijo::where('voluntario_id', '=', $idVoluntario);
            if (!$ef) {
                $this->Equipofijo = new Equipofijo;
                $this->Equipofijo->voluntario_id = $idVoluntario;
            } else {
                $this->Equipofijo->id = $ef->id;
            }
            $mensaje = 'Guardado';
            switch ($tipoPregunta) {
                case 1:
                    $this->Equipofijo->deteccion = $valor;
                    break;
                case 2:
                    $this->Equipofijo->coordinacion = $valor;
                    break;
                case 3:
                    $this->Equipofijo->emprendedores = $valor;
                    break;
                case 4:
                    $this->Equipofijo->apoyo = $valor;
                    break;
                case 5:
                    $this->Equipofijo->oficios = $valor;
                    break;
            }
            $this->Equipofijo->save();
            $ret["success"] = true;
            $ret["message"] = $mensaje;
        } else {
            $ret["success"] = false;
            $ret["message"] = 'Error al guardar';
        }
        return response()->json($ret);
    }

    function saveEquipoFijoSiNo(Request $request)
    {
        if ($request->ajax()) {
            $idVoluntario = $request->get("idVoluntario");
            $valor = $request->get("valor");
            if ($valor == 'si') {
                $valor = 1;
            } else {
                $valor = 0;
            }
            Voluntario::whereIn('id', $idVoluntario)->update(['equipofijo' => $valor]);

            $ret["success"] = true;
            $ret["message"] = 'Cambio guardado';
        } else {
            $ret["success"] = false;
            $ret["message"] = 'Error al guardar';
        }
        return response()->json($ret);
    }

    function saveEstado(Request $request)
    {
        if ($request->ajax()) {
            $idRegistro = $request->get("idRegistro");
            $estado = $request->get("estado");

            $mensaje = 'Estado cambiado';
            $rv = RegistroVoluntario::find($idRegistro);
            if ($estado == 'true') {
                $rv->estado = 1;
            } else {
                $rv->estado = 0;
            }
            $rv->save();
            $ret["success"] = true;
            $ret["message"] = $mensaje;
        } else {
            $ret["success"] = false;
            $ret["message"] = 'Error al confirmar';
        }
        return response()->json($ret);
    }
}