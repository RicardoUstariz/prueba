<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServicioController extends Controller
{
    
    public function dataservicio()
    {

        $servicio = DB::table('servicio')->where('id', '1')->first();
        
        return response()->json($servicio);
    }

    public function updateservicio(Request $request){

        DB::table('servicio')->where('id', '1')->update(['activo' => $request['activo']]);

        return redirect()->route('admin.dashboard');
    }
}
