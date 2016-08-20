<?php

namespace App\Http\Controllers;


use App\Models\Ciudad;
use App\Models\Colecta;
use App\Models\Correo;
use App\Models\Punto;
use App\Models\PuntoDiaColecta;
use App\Models\RegistroVoluntario;
use App\Models\Sede;
use App\Models\User;
use App\Models\Voluntario;
use App\Models\Zona;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PagesController extends Controller
{

    protected $_colecta;
    protected $_sedeEmail;
    protected $_dataVol;
    protected $_year;
    protected $_dias;

    public function __construct()
    {
        $this->_colecta = Session::get('idColecta');
        $this->_colecta = Colecta::find($this->_colecta);
        $this->_year = Carbon::parse($this->_colecta->fecha_inicio)->year;

        $diasStr = '';
        $dias = $this->generateDateRange($this->_colecta->fecha_inicio, $this->_colecta->fecha_cierre);
        foreach ($dias as $i => $dia) {
            $diasStr .= ltrim($dia, '0');
            if ($i < count($dias) - 2) {
                $diasStr .= ", ";
            } elseif ($i == count($dias) - 2) {
                $diasStr .= " y ";
            }
        }
        $this->_dias = $diasStr;
    }

    public function home()
    {

        $from = date_create(date('Y-m-d'));
        $to = date_create($this->_colecta->fecha_inicio);
        $diff = date_diff($to, $from);

        return view('pages.front.home', [
            "year" => $this->_year,
            "anotados" => Voluntario::count(),
            "df" => $diff->format('%a'),
            "dias" => $this->_dias,
            "sedes" => Sede::orderBy("nombre")->get(),
            "nombreMes" => $this->getNombreMes($this->_colecta->fecha_inicio)
        ]);

    }

    private function generateDateRange($first, $last, $step = '+1 day', $output_format = 'd')
    {
        $dates = array();
        $current = strtotime($first);
        $last = strtotime($last);

        while ($current <= $last) {

            $dates[] = date($output_format, $current);
            $current = strtotime($step, $current);
        }

        return $dates;
    }

    private function getNombreMes($fecha)
    {

        $meses = [
            'January' => 'Enero',
            'February' => 'Febrero',
            'March' => 'Marzo',
            'April' => 'Abril',
            'June' => 'Junio',
            'July' => 'Julio',
            'August' => 'Agosto',
            'September' => 'Septiembre',
            'October' => 'Octubre',
            'November' => 'Noviembre',
            'December' => 'Diciembre',
        ];
        return $meses[date('F', strtotime($fecha))];
    }

    public function editar(Request $request)
    {
        $hash = $request->get('hash');
        $email = $request->get('email');

        if ($hash && $email) {
            $cronEmail = null;
            $voluntariosCorreo = Voluntario::where('email', $email)->get();
            foreach ($voluntariosCorreo as $vc) {
                $cronEmail = Correo::where('status', 2)->where('hash', $hash)->where('arr_to', base64_encode(json_encode(array($email => $vc->nombre))))->first();
                if ($cronEmail) {
                    break;
                }
            }

            if ($cronEmail) {
                $voluntarioSolo = Voluntario::find($cronEmail->voluntario_id);
                if ($voluntarioSolo) {
                    $viernes = null;
                    $sabado = null;
                    $domingo = null;
                    $idSede = null;
                    $idsCiudades = array();
                    $idsZonas = array();
                    $idsPuntos = array();
                    foreach ($voluntarioSolo->registros as $v) {
                        if ($v->dia_colecta_id == 1) {
                            $viernes = $v;
                        }
                        if ($v->dia_colecta_id == 2) {
                            $sabado = $v;
                        }
                        if ($v->dia_colecta_id == 3) {
                            $domingo = $v;
                        }
                        $idSede = $v->sede_id;
                        $idsCiudades[] = $v->ciudad_id;
                        $idsZonas[] = $v->zona_id;
                        $idsPuntos[] = $v->punto_id;
                    }

                    return view('pages.front.editar', [
                        "vol" => $voluntarioSolo,
                        "viernes" => $viernes,
                        "sabado" => $sabado,
                        "domingo" => $domingo,
                        "idSede" => $idSede,
                        "hash" => $hash,
                        "ciudades" => $this->listCiudadFront(),
                        "puntos" => $this->listPuntosFront(),
                        "zonas" => $this->listZonasFront(),
                        "sedes" => Sede::orderBy('nombre')->get(),
                        "ciudadV" => Ciudad::whereIn('id', $idsCiudades)->get(),
                        "zonasV" => Zona::whereIn('id', $idsZonas)->get(),
                        "puntosV" => Punto::whereIn('id', $idsPuntos)->get(),
                        "year" => $this->_year,
                        "dias" => $this->_dias
                    ]);
                } else {
                    echo "El correo no se encuentra registrado.";
                    exit;
                }
            } else {
                echo "Error, no se encuentra su pedido de cambio de datos o este ya no es válido.";
                exit;
            }
        } else {
            echo "Error, no se encuentra autorizado para ingresar a este sitio.";
            exit;
        }
    }

    public function guardarEditar(Request $request)
    {
        $hash = $request->get('hash');
        if ($hash) {
            $correo = Correo::where('hash', $hash)->where('status', 2)->first();

            if ($correo) {
                $voluntario = Voluntario::find($correo->voluntario_id);
                if ($voluntario) {

                    $voluntario->nombre = $request->get("nombre");
                    $voluntario->apellido = $request->get("apellido");
                    $voluntario->email = $request->get("email");
                    $voluntario->telefono = $request->get("telefono");
                    $voluntario->fnac = $request->get("fnac");
                    $voluntario->save();

                    $this->guardarRV($request, $voluntario);
                    $correo->status = 3;
                    $correo->save();
                    $this->EnviarMailConfirmarEditar($voluntario, $this->_dataVol);
                    return Redirect::to(route('home'));
                } else {
                    echo "Error, consulte a colecta@techo.org.ar";
                    exit;
                }
            } else {
                echo "El codigo no es valido, vuelva a intentar cambiar los datos desde http://colecta.techo.org.ar.";
                exit;
            }
        } else {
            echo "Ocurrio un problema, intente ingresar nuevamente al link que se le envio en el correo.";
            exit;
        }
    }

    private function EnviarMailConfirmarEditar($voluntario, $dataVoluntario)
    {
        $correo = new Correo;
        $correo->voluntario_id = $voluntario->id;
        $correo->tipo_mail = 'ConfirmarEditar';
        $correo->arr_sender = base64_encode(json_encode(array('colecta.argentina@techo.org' => 'TECHO')));
        $correo->arr_to = base64_encode(json_encode(array($voluntario->email => $voluntario->nombre)));
        $correo->arr_replyto = isset($this->_sedeEmail) || empty($this->_sedeEmail) ? 'colecta.argentina@techo.org' : $this->_sedeEmail;
        $correo->arr_subject = '¡Cambiaste tus datos!';
        $correo->arr_emailvars = base64_encode(json_encode(array('nombre' => $voluntario->nombre, 'tabla' => $dataVoluntario)));
        $correo->status = '1'; //estado a enviar.
        $correo->hash = '';
        $correo->colecta_id = Session::get('idColecta');

        $correo->save();
    }

    /**
     * @param Request $request
     * @param $voluntario
     * @return bool
     */
    private function guardarRV(Request $request, $voluntario)
    {

        //borro todos los registro voluntario que tiene ahora y creo nuevos.

        RegistroVoluntario::where('voluntario_id', $voluntario->id)->delete();

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
                    $r1->sede_id = $idSede;
                    $r1->ciudad_id = $ciudad1->id;
                    $r1->zona_id = $zona1->id;
                    $r1->punto_id = $idPunto1;
                    $r1->dia_colecta_id = 1; //VIERNES
                    $r1->estado = 0; //ANOTADO
                    $r1->asistio = 0;
                    $r1->colecta_id = Session::get('idColecta');

                    $r1->save();

                    $puntoDiaColecta1 = PuntoDiaColecta::where('punto_id', '=', $punto1->id)->where('dia_colecta_id', '=', 1)->first();

                    $this->_dataVol["Viernes"]["punto"] = $punto1->nombreMostrar;
                    $this->_dataVol["Viernes"]["informacion"] = $puntoDiaColecta1 ? $puntoDiaColecta1->informacion : '';
                    $this->_dataVol["Viernes"]["zona"] = $zona1->nombreMostrar;
                    $this->_dataVol["Viernes"]["fb"] = $zona1->fb;
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
                    $r2->sede_id = $idSede;
                    $r2->ciudad_id = $ciudad2->id;
                    $r2->zona_id = $zona2->id;
                    $r2->punto_id = $idPunto2;
                    $r2->dia_colecta_id = 2; //SABADO
                    $r2->estado = 0; //ANOTADO
                    $r2->asistio = 0;
                    $r2->colecta_id = Session::get('idColecta');

                    $r2->save();

                    $puntoDiaColecta2 = PuntoDiaColecta::where('punto_id', '=', $punto2->id)->where('dia_colecta_id', '=', 2)->first();

                    $this->_dataVol["Sabado"]["punto"] = $punto2->nombreMostrar;
                    $this->_dataVol["Sabado"]["informacion"] = $puntoDiaColecta2 ? $puntoDiaColecta2->informacion : '';
                    $this->_dataVol["Sabado"]["zona"] = $zona2->nombreMostrar;
                    $this->_dataVol["Sabado"]["fb"] = $zona2->fb;
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
                    $r3->sede_id = $idSede;
                    $r3->ciudad_id = $ciudad3->id;
                    $r3->zona_id = $zona3->id;
                    $r3->punto_id = $idPunto3;
                    $r3->dia_colecta_id = 3; //DOMINGO
                    $r3->estado = 0; //ANOTADO
                    $r3->asistio = 0;
                    $r3->colecta_id = Session::get('idColecta');

                    $r3->save();

                    $puntoDiaColecta3 = PuntoDiaColecta::where('punto_id', '=', $punto3->id)->where('dia_colecta_id', '=', 3)->first();

                    $this->_dataVol["Domingo"]["punto"] = $punto3->nombreMostrar;
                    $this->_dataVol["Domingo"]["informacion"] = $puntoDiaColecta3 ? $puntoDiaColecta3->informacion : '';
                    $this->_dataVol["Domingo"]["zona"] = $zona3->nombreMostrar;
                    $this->_dataVol["Domingo"]["fb"] = $zona3->fb;
                }
                //DOMINGO FIN
            }
        }
        return true;
    }

    private function GetEncargadoZona($zona, $idDiaColecta = 1)
    {

        //por el momento no se usa.
        $rt = array();

        $usuarios = User::join('user_punto', 'user.id', 'user_punto.user_id')
            ->join('punto', 'punto.id', 'user_punto.id_punto')
            ->where('user.role', 3)//encargado de zona
            ->where('user_punto.dia_colecta_id', $idDiaColecta)
            ->where('punto.zona_id', $zona->id);

        $i = 0;
        foreach ($usuarios as $usuario) {
            $rt[$i]["nombre"] = $usuario->nombre;
            $rt[$i]["email"] = $usuario->email;
            $i++;
        }

        return $rt;
    }

    public function legales()
    {
        return view('pages.front.legales', ["year" => $this->_year, "dias" => $this->_dias]);
    }

    public function prensa()
    {
        return view('pages.front.prensa', ["year" => $this->_year, "dias" => $this->_dias]);
    }

    public function tos()
    {
        return view('pages.front.tos', ["year" => $this->_year, "dias" => $this->_dias]);
    }

    public function listCiudadFront()
    {
        $ret = array();
        $ciudad = Ciudad::orderBy("nombreMostrar")->get();
        foreach ($ciudad as $p) {
            $ret[$p->sede_id][] = array(
                "id" => $p->id,
                "nombre" => $p->nombreMostrar
            );
        }
        return json_encode($ret, JSON_PRETTY_PRINT);
    }

    public function listZonasFront()
    {
        $ret = array();
        $agregados = array();

        $zonas = Zona::select('zona.*');
        /* $zonas->join('punto', 'punto.zona_id', '=', 'zona.id');
         $zonas->join('punto_dia_colecta', 'punto_dia_colecta.punto_id', '=', 'punto.id');*/
        $zonas->orderBy('zona.nombreMostrar');
        foreach ($zonas->get() as $z) {
            foreach ($z->puntos as $pc) {
                foreach ($pc->diaColecta as $dp) {
                    if (!isset($ret[$z->ciudad_id][$dp->dia_colecta_id]) || !in_array($z->id, $agregados[$z->ciudad_id][$dp->dia_colecta_id])) {
                        $ret[$z->ciudad_id][$dp->dia_colecta_id][] = array(
                            "id" => $z->id,
                            "nombre" => $z->nombreMostrar
                        );
                        $agregados[$z->ciudad_id][$dp->dia_colecta_id][] = $z->id;
                    }
                }
            }
        }
        return json_encode($ret, JSON_PRETTY_PRINT);
    }

    public function listPuntosFront()
    {
        $ret = array();
        $agregados = array();

        $puntos = Punto::select('punto.*');
        $puntos->join('punto_dia_colecta', 'punto_dia_colecta.punto_id', '=', 'punto.id');
        $puntos->orderBy('punto.nombreMostrar');

        foreach ($puntos->get() as $p)
            foreach ($p->diaColecta as $dp) {
                if (!isset($ret[$p->zona_id][$dp->dia_colecta_id]) || !in_array($p->id, $agregados[$p->zona_id][$dp->dia_colecta_id])) {
                    $ret[$p->zona_id][$dp->dia_colecta_id][] = array(
                        "id" => $p->id,
                        "nombre" => $p->nombreMostrar
                    );
                    $agregados[$p->zona_id][$dp->dia_colecta_id][] = $p->id;
                }
            }
        return json_encode($ret, JSON_PRETTY_PRINT);
    }

    /* User envio de mail para crear contraseña nueva, tal vez recuperar en un futuro */
    public function passwordUser(Request $request)
    {
        $hash = $request->get('hash');
        $email = $request->get('email');
        if ($hash && $email) {
            $cronEmail = null;
            $userCorreo = User::where('email', $email)->get();
            foreach ($userCorreo as $vc) {
                $cronEmail = Correo::where('status', 2)->where('hash', $hash)->where('arr_to', base64_encode(json_encode(array($email => $vc->nombre))))->first();
                if ($cronEmail) {
                    break;
                }
            }
            if ($cronEmail) {
                $user = User::find($cronEmail->user_id);
                if ($user) {
                    return view('pages.front.user_password', [
                        "user" => $user,
                        "hash" => $hash,
                        "year" => $this->_year,
                        "dias" => $this->_dias
                    ]);
                } else {
                    echo "El correo no se encuentra registrado.";
                    exit;
                }
            } else {
                echo "Error, no se encuentra su pedido de cambio de contraseña o este ya no es válido.";
                exit;
            }
        } else {
            echo "Error, no se encuentra autorizado para ingresar a este sitio.";
            exit;
        }
    }

    public function savePasswordUser(Request $request)
    {
        $hash = $request->get('hash');
        if ($hash) {
            $correo = Correo::where('hash', $hash)->where('status', 2)->first();
            if ($correo) {
                $password = $request->get('password');
                if ($password == $request->get('password_confirm')) {
                    if (strlen($password) > 6) {
                        $user = User::find($correo->user_id);
                        if ($user) {
                            $user->password = bcrypt($password);
                            $user->save();
                            $correo->status = 3;
                            $correo->save();
                            return Redirect::to(route('adminIndex'));
                        } else {
                            echo "Error, consulte a colecta@techo.org.ar";
                            exit;
                        }
                    } else {
                        return Redirect::back()
                            ->withErrors("Las contraseña debe tener mas de 6 caracteres.");
                    }
                } else {
                    return Redirect::back()
                        ->withErrors("Las contraseñas deben ser iguales.");
                }
            } else {
                echo "Ocurrio un problema, intente ingresar nuevamente al link que se le envio en el correo.";
                exit;
            }
        }
        return false;
    }

    public function getCiudadesFrontJsonResponse()
    {
        return response()->json($this->listCiudadFront());
    }

    public function getZonasFrontJsonResponse()
    {
        return response()->json($this->listZonasFront());
    }

    public function getPuntosFrontJsonResponse()
    {
        return response()->json($this->listPuntosFront());
    }
}

