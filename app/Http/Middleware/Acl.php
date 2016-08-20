<?php namespace App\Http\Middleware;

use App\Models\Colecta;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Session;

class Acl
{
    public function handle($request, Closure $next)
    {
        $roles = $this->getRequiredRoleForRoute($request->route());
        $this->tienePermisosMenu($request);
        $this->setRolesSesion();
        $this->getYearColecta();
        if ($request->user()->hasRole($roles) || !$roles) {
            return $next($request);
        }
        return abort(401);
    }

    private function setRolesSesion()
    {
        $roles = array(
            1 => "Administrador",
            2 => "Director de sede",
            3 => "Jefe de zona",
            4 => "Jefe de punto"
        );

        Session::set('roles', $roles);
    }

    private function getYearColecta()
    {
        $colecta = Colecta::find(Session::get('idColecta'));
        $year = Carbon::createFromFormat('Y-m-d', $colecta->fecha_inicio)->year;
        Session::set('year', $year);
    }

    private function roleStringToId($role)
    {
        $roles = array(
            'admin' => 1,
            'sede' => 2,
            'zona' => 3,
            'punto' => 4);
        return $roles[$role];
    }

    private function getRequiredRoleForRoute($route)
    {
        $act = array();
        $actions = $route->getAction();
        if (isset($actions['roles'])) {
            foreach ($actions['roles'] as $action) {
                $act[] = $this->roleStringToId($action);
            }
            return $act;
        } else {
            return null;
        }
    }

    private function tienePermisosMenu($request)
    {
        $rol = $request->user()->role;
        $menu = array();
        if ($rol == 'admin') {
            $rol = 1;
        }
        switch ($rol) {
            case 1:
                $menu['1_home'] = true;
                $menu['2_puntos'] = true;
                $menu['3_zonas'] = true;
                $menu['4_ciudads'] = true;
                $menu['5_sedes'] = true;
                $menu['5_voluntarios'] = true;
                $menu['6_users'] = true;
                $menu['7_misvoluntarios'] = true;
                $menu['8_mismobile'] = true;
                $menu['9_colecta'] = true;
                $menu['10_import'] = true;
                break;
            case 2:
                $menu['1_home'] = true; //todo dentro de su sede solo su sede.
                $menu['2_puntos'] = true;
                $menu['3_zonas'] = true;
                $menu['4_ciudads'] = true;
                $menu['5_sedes'] = false;
                $menu['5_voluntarios'] = true;
                $menu['6_users'] = true;
                $menu['7_misvoluntarios'] = true;
                $menu['8_mismobile'] = true;
                $menu['9_colecta'] = false;
                $menu['10_import'] = true;
                break;
            case 3:
                $menu['1_home'] = true; //no puede editar ni agregar nada.
                $menu['2_puntos'] = false;
                $menu['3_zonas'] = false;
                $menu['4_ciudads'] = false;
                $menu['5_sedes'] = false;
                $menu['5_voluntarios'] = false;
                $menu['6_users'] = false;
                $menu['7_misvoluntarios'] = true;
                $menu['8_mismobile'] = true;
                $menu['9_colecta'] = false;
                $menu['10_import'] = false;
                break;
            case 4:
                $menu['1_home'] = true; //no puede editar ni agregar nada.
                $menu['2_puntos'] = false;
                $menu['3_zonas'] = false;
                $menu['4_ciudads'] = false;
                $menu['5_sedes'] = false;
                $menu['5_voluntarios'] = false;
                $menu['6_users'] = false;
                $menu['7_misvoluntarios'] = true;
                $menu['8_mismobile'] = true;
                $menu['9_colecta'] = false;
                $menu['10_import'] = false;
                break;
        }
        Session::set('menu', $menu);
    }

    private function mapaDePermisosPorRoute()
    { //todo: legacy, esta logica sepaso a routes.
        $config = array(
            '2' => array( //Director de sede
                array('controller' => 'pages', 'action' => 'admin_index'),
                array('controller' => 'voluntarios', 'action' => '*'),
                array('controller' => 'ajax', 'action' => 'admin_SaveAsistencia'),
                array('controller' => 'ajax', 'action' => 'admin_SaveEstado'),
                array('controller' => 'ajax', 'action' => 'admin_getCiudades'),
                array('controller' => 'ajax', 'action' => 'admin_getZonas'),
                array('controller' => 'ajax', 'action' => 'admin_getPuntos'),
                array('controller' => 'ajax', 'action' => 'admin_getSedes'),
                array('controller' => 'ajax', 'action' => 'admin_SaveEquipoFijo'),
                array('controller' => 'ajax', 'action' => 'admin_SaveEquipoFijoSiNo'),
                array('controller' => 'puntos', 'action' => '*'),
                array('controller' => 'zonas', 'action' => '*'),
                array('controller' => 'ciudads', 'action' => '*'),
                array('controller' => 'users', 'action' => 'admin_index'),
                array('controller' => 'users', 'action' => 'admin_add'),
                array('controller' => 'users', 'action' => 'admin_edit'),
                array('controller' => 'users', 'action' => 'admin_logout'),
                array('controller' => 'users', 'action' => 'admin_login'),
                array('controller' => 'UserPunto', 'action' => 'admin_index'),
                array('controller' => 'UserPunto', 'action' => 'admin_addPunto'),
                array('controller' => 'UserPunto', 'action' => 'admin_addZona'),
                array('controller' => 'UserPunto', 'action' => 'admin_addCiudad'),
                array('controller' => 'UserPunto', 'action' => 'admin_addSede'),
                array('controller' => 'UserPunto', 'action' => 'destroy'),
            ),
            '3' => array( //Jefe de zona
                array('controller' => 'pages', 'action' => 'admin_index'),
                array('controller' => 'voluntarios', 'action' => 'admin_misvoluntarios'),
                array('controller' => 'voluntarios', 'action' => 'admin_exportar'),
                array('controller' => 'voluntarios', 'action' => 'admin_mismobile'),
                array('controller' => 'ajax', 'action' => 'admin_SaveAsistencia'),
                array('controller' => 'ajax', 'action' => 'admin_SaveEstado'),
                array('controller' => 'ajax', 'action' => 'admin_getCiudades'),
                array('controller' => 'ajax', 'action' => 'admin_getZonas'),
                array('controller' => 'ajax', 'action' => 'admin_getPuntos'),
                array('controller' => 'ajax', 'action' => 'admin_getSedes'),
                array('controller' => 'ajax', 'action' => 'admin_SaveEquipoFijo'),
                array('controller' => 'ajax', 'action' => 'admin_SaveEquipoFijoSiNo'),
                array('controller' => 'puntos', 'action' => 'index'),
                array('controller' => 'users', 'action' => 'admin_logout'),
                array('controller' => 'users', 'action' => 'admin_login'),
            ),
            '4' => array( //Jefe de punto
                array('controller' => 'pages', 'action' => 'admin_index'),
                array('controller' => 'ajax', 'action' => 'admin_SaveAsistencia'),
                array('controller' => 'ajax', 'action' => 'admin_SaveEstado'),
                array('controller' => 'ajax', 'action' => 'admin_getCiudades'),
                array('controller' => 'ajax', 'action' => 'admin_getZonas'),
                array('controller' => 'ajax', 'action' => 'admin_getPuntos'),
                array('controller' => 'ajax', 'action' => 'admin_getSedes'),
                array('controller' => 'ajax', 'action' => 'admin_SaveEquipoFijo'),
                array('controller' => 'ajax', 'action' => 'admin_SaveEquipoFijoSiNo'),
                array('controller' => 'voluntarios', 'action' => 'admin_exportar'),
                array('controller' => 'voluntarios', 'action' => 'admin_add'),
                array('controller' => 'voluntarios', 'action' => 'admin_misvoluntarios'),
                array('controller' => 'voluntarios', 'action' => 'admin_mismobile'),
                array('controller' => 'VoluntariosPuntos', 'action' => 'admin_add'),
                array('controller' => 'VoluntariosPuntos', 'action' => 'admin_index'),
                array('controller' => 'users', 'action' => 'admin_logout'),
                array('controller' => 'users', 'action' => 'admin_login'),
            )
        );
    }
}