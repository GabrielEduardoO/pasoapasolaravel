<?php namespace App\Http\Controllers\Lavado;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditUserRequest;
use App\sw_empleado;
use App\sw_registro_lavado;
use App\sw_usuario;
use App\sw_ctl_lavado;
use App\sw_det_lavado;
use App\sw_adjunto;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;


use App\User;
use Illuminate\Http\Request;

use Illuminate\Routing\Redirector;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use DateTime;

use DateInterval;
use Carbon\Carbon;
use Faker\Factory as Faker;

class LavadoController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    public function __construct()
    {
        $this->middleware('auth');

    }
	public function index(Request $request)
	{
        //dd($request->all);
        $id =Auth::user()->usr_id;

        $menus = \DB::select('
                            select * from
                            fn_get_modules(?)',array($id));



        $ctls = sw_ctl_lavado::join('sw_usuarios AS su','sw_ctl_lavado.ctl_usr_id','=','su.usr_id')
                                ->join('sw_patio AS spatio', 'sw_ctl_lavado.ctl_pto_id', '=', 'spatio.pto_id')
                                 ->join('sw_proveedor AS sprovee', 'sw_ctl_lavado.ctl_pve_an8', '=', 'sprovee.pvd_an8')
                                ->select('sw_ctl_lavado.ctl_id','su.usr_id','su.usr_name','spatio.pto_nombre',
                                         'sw_ctl_lavado.ctl_fecha_inicio','sw_ctl_lavado.ctl_fecha_fin','sprovee.pvd_nombre')

            ->where ('ctl_usr_id',$id)
            ->orderBY('ctl_id', 'DESC')
            ->control($request->get('control'))
            ->paginate(5);




//dd($ctls);


        $usr_name = Auth::user()->usr_name ;

        $patios = \DB::select('select * from sw_patio
        ');

        $proveedores = \DB::select('select * from sw_proveedor
        ');

        return view('lavado.index',compact('menus','ctls','patios','proveedores','usr_name'));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//dd($request->all());

        $control = new sw_ctl_lavado();
        $control->fill($request->all());

        $control->ctl_usr_id = Auth::user()->usr_id;
        $control->ctl_pto_id = ($request->pto_id);
        $control->ctl_pve_an8 = ($request->prove_id);
        $control->ctl_fecha_inicio =new DateTime();
        $control->ctl_fecha_fin = new DateTime('0001-01-01 00:00:00');
        $control->ctl_creado_en = new DateTime();
        $control->ctl_creado_por =Auth::user()->usr_name;
        $control->ctl_modificado_en = new DateTime();
        $control->ctl_modificado_por =Auth::user()->usr_name;
        //dd($control);
        $control->save();

        Session::flash('message', 'Se ha creado en nuevo control. ID: '.$control->ctl_id );

        return redirect()->route('lavado.edit',compact('control'));

    }

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Request $request, $id)
	{
        $iduser =Auth::user()->usr_id;

        $menus = \DB::select('
                            select * from
                            fn_get_modules(?)',array($iduser));

        //dd($menus);

        $ctl = sw_ctl_lavado::find($id);

        $pto_id = $ctl->ctl_pto_id;
        $pvd_id = $ctl->ctl_pve_an8;


        $ptonombre = \DB::select('select pto_nombre from sw_patio where pto_id ='.$pto_id);
        $pvdnombre = \DB::select('select pvd_nombre from sw_proveedor where pvd_an8 ='.$pvd_id);

        $pto_nombre= $ptonombre[0];
        $pvd_nombre= $pvdnombre[0];

        //dd($ptonombre);
        $usr_name = Auth::user()->usr_name ;

        //dd($ctl_id);
        $acciones = \DB::select('select * from sw_accion_lavado
        ');

        $patios = \DB::select('select * from sw_patio
        ');
        $vehiculos = \DB::select('select * from sw_vehiculo
        ');
        $proveedores = \DB::select('select * from sw_proveedor
        ');

        //dd($vehiculos);

        return view('lavado.updatectl',compact('menus','usr_name','acciones','vehiculos','id','pto_nombre','pvd_nombre','patios','proveedores'));

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Request $request, $id)
	{
        //dd($id);
        $iduser =Auth::user()->usr_id;

        $menus = \DB::select('
                            select * from
                            fn_get_modules(?)',array($iduser));

        //dd($menus);

        $ctl = sw_ctl_lavado::find($id);

        $pto_id = $ctl->ctl_pto_id;
        $pvd_id = $ctl->ctl_pve_an8;


        $ptonombre = \DB::select('select pto_nombre from sw_patio where pto_id ='.$pto_id);
        $pvdnombre = \DB::select('select pvd_nombre from sw_proveedor where pvd_an8 ='.$pvd_id);

        $pto_nombre= $ptonombre[0];
        $pvd_nombre= $pvdnombre[0];

        //dd($ptonombre);
        $usr_name = Auth::user()->usr_name ;

               //dd($ctl_id);
        $acciones = \DB::select('select * from sw_accion_lavado
        ');


        $vehiculos = \DB::select('select * from sw_vehiculo
        ');

        //dd($vehiculos);

        return view('lavado.edit',compact('menus','usr_name','acciones','vehiculos','id','pto_nombre','pvd_nombre'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request)
    {
        //dd($request->all());
        //$nombre=$request->archivos;
        $id = $request->reg_ctl_id;
        $ctlactual[] = $request->reg_ctl_id;
        $vehmovil= \DB::select('select veh_movil from sw_vehiculo where veh_id ='.$request->vehi_id);
        $vehmov= $vehmovil[0];

        $ctl = sw_ctl_lavado::find($id);
        //dd($ctl);
        $ctlfechainicio = $ctl->ctl_fecha_inicio;

        $datef = Carbon::createFromFormat('Y-m-d H:i:s',$ctlfechainicio);
        $datef =$datef->subHours(8);
        $datei = Carbon::createFromFormat('Y-m-d H:i:s',$ctlfechainicio);
        $datei = $datei->addHours(8);

        $fechai = date_format($datei,'Y-m-d H:i:s');
        $fechaf = date_format($datef,'Y-m-d H:i:s');

        //dd($fechai,$fechaf);

        $rangoctls= \DB::table('sw_ctl_lavado')->whereBetween('ctl_fecha_inicio', array($fechaf, $fechai))->orderBy('ctl_fecha_inicio', 'DESC')->get();

        //dd($rangoctls);
        foreach ($rangoctls as $rangoctl){
            $ctlsturnosa[] = $rangoctl->ctl_id;
        }



        $ctlsturnos = array_diff($ctlsturnosa,$ctlactual);



        //$v = 100004; //Id vehiculo quemado

        $e= 0;
        $f = 0;
        foreach($ctlsturnos as $ctlsturno) {
            $x = \DB::select('select reg_veh_id from sw_registro_lavado where reg_ctl_id =' . $ctlsturno.'AND reg_veh_id ='.$request->vehi_id);
            if (empty ($x)){
                $f = $f+1;
            }else {
                $e = $e+1;
            }
        }

        $zmovil[] = $request->vehi_id;
        $zmoviles = \DB::select('
                            select * from
                            fn_registro(?)', array($id));

        if(empty($zmoviles)) {
            $zmovs=[];
            $zmov =array_sum($zmovs);


        }else{
            foreach ($zmoviles as $zmovile) {
                $zmovils[] = $zmovile->veh_id;
            }
            $zmovs = array_intersect($zmovils, $zmovil);
            $zmov =array_sum($zmovs);
        }



//        echo 'primer registro';
//


        if($zmov != 0 and $e != 0 ){

            Session::flash('message', 'El Movil '. $vehmov->veh_movil .' se encuentra registrado en este control y en otro en el mismo turno(Serrucho!!!).');
            return redirect()->back();
        }elseif ($zmov!= 0 and $e==0){

            Session::flash('message', 'El Movil '. $vehmov->veh_movil .' ya se encuentra registrado en el control.');
            return redirect()->back();
        }elseif($zmov == '0'  and $e != 0){

            Session::flash('message', 'El Movil '. $vehmov->veh_movil .' ya se encuentra registrado en otro control en el mismo turno.');

            return redirect()->back();
        }elseif($zmov == '0' and $e=='0'){//validar ingreso registro....



        //if (empty($zmov)and $e=='0') {//Movil repetido en el control y en otros cntroles en el turno presente

            $array_bd = ($request->acciones_bd);
            $array_true = ($request->acciones);
            //dd($array_true);
            if (empty($array_true)) {//se debe seleccionar un elemento de la lista
                Session::flash('message', 'Para crear el Registro debe seleccionar un item de la Revisión Externa y/o Interna.');
                return redirect()->back();
            } else {
                $array_false = array_diff($array_bd, $array_true);
                //dd($array_false);

                $registro = new sw_registro_lavado();
                $registro->fill($request->all());
                $registro->reg_veh_id = $request->vehi_id;
                $registro->reg_aprobacion = $request->reg_aprobacion;
                $registro->reg_observacion = $request->reg_observacion;
                $registro->reg_creado_en = new DateTime();
                $registro->reg_creado_por = Auth::user()->usr_name;
                $registro->reg_modificado_en = new DateTime();
                $registro->reg_modificado_por = Auth::user()->usr_name;

                $registro->save();


                //dd($registro);

                foreach ($array_true as $arreglotrue) {
                    $detalle = new sw_det_lavado();
                    $detalle->fill($request->all());
                    $detalle->det_reg_id = $registro->reg_id;
                    $detalle->det_acc_id = $arreglotrue;
                    $detalle->det_acc_estado = 'TRUE';
                    $detalle->det_creado_en = new DateTime();
                    $detalle->det_creado_por = Auth::user()->usr_name;
                    $detalle->det_modificado_en = new DateTime();
                    $detalle->det_modificado_por = Auth::user()->usr_name;
                    //dd($detalle);
                    $detalle->save();
                }
                foreach ($array_false as $arreglofalso) {
                    $detalle = new sw_det_lavado();
                    $detalle->fill($request->all());
                    $detalle->det_reg_id = $registro->reg_id;
                    $detalle->det_acc_id = $arreglofalso;
                    $detalle->det_acc_estado = 'FALSE';
                    $detalle->det_creado_en = new DateTime();
                    $detalle->det_creado_por = Auth::user()->usr_name;
                    $detalle->det_modificado_en = new DateTime();
                    $detalle->det_modificado_por = Auth::user()->usr_name;
                    //dd($detalle);
                    $detalle->save();
                }

                $idreg=$registro->reg_id;

                $array_nombre=$_FILES["archivos"]['name'];
                $ruta1 = 'D:\adjuntos_swcapital\ ';
                $rutareg = '\ ';
                $rutareg = rtrim($rutareg);
                $ruta11 = rtrim($ruta1).$idreg.$rutareg;
                mkdir($ruta11, 0777);

                for($i=0;$i<count($_FILES["archivos"]['name']);$i++){
                    $tmpFilePath = $_FILES["archivos"]['tmp_name'][$i];

                    if ($tmpFilePath != ""){



                        $ruta2 = $_FILES['archivos']['name'][$i];

                        $ruta = $ruta11.$ruta2;

                        //dd($ruta);
                        if(move_uploaded_file($tmpFilePath, $ruta)){

                        }

                    }

                }

                if($array_nombre[0]== null){

                }else {


                    foreach ($array_nombre as $datos){
                        $ruta1 = 'D:\adjuntos_swcapital\ ';
                        $rutareg = '\ ';
                        $rutareg = rtrim($rutareg);
                        $ruta11 = rtrim($ruta1).$idreg.$rutareg;
                         $route=$datos;
                        $ruta = $ruta11.$route;


                        $archivo=new sw_adjunto;

                        $archivo->adj_reg_id=$idreg;
                        $archivo->adj_ruta =$ruta;
                        $archivo->adj_nombre=$datos;
                        $archivo->adj_creado_en= new DateTime();
                        $archivo->adj_creado_por =Auth::user()->usr_name;
                        $archivo->adj_modificado_en = new DateTime();
                        $archivo->adj_modificado_por =Auth::user()->usr_name;

                        $archivo->save();
                    }
                }







                //return Redirect::action('RegistroController@index');
                Session::flash('message', 'Registro Exitoso.');

                return redirect()->route('lavado.edit', compact('id'));

            }
        }else{
            return redirect()->back();
        }


        }

    //}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    public function updatectl(Request $request)
    {
        dd($request);
    }

}
