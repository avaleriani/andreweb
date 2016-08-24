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
        if ($request->user()->hasRole($roles) || !$roles) {
            return $next($request);
        }
        return abort(401);
    }

    private function setRolesSesion()
    {
        $roles = array(
            1 => "Administrador",
        );

        Session::set('roles', $roles);
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
                $menu['2_projects'] = true;
                $menu['3_users'] = true;
                break;
        }
        Session::set('menu', $menu);
    }
}