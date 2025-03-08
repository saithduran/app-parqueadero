<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use Illuminate\Http\Request;

class RegistroController extends Controller{

    public function store(Request $request){

        $request->validate(['placa' => 'required|string|max:6']);
        
        $registro = Registro::create([
            'placa' => strtoupper($request->placa),
            'hora_ingreso' => now(),
        ]);
    
        return response()->json($registro, 201);
    }
    
    public function update(Request $request, $id){

        $registro = Registro::findOrFail($id);
    
        if ($registro->estado === 'salido') {
            return response()->json(['error' => 'Este registro ya está cerrado'], 400);
        }
    
        $horaSalida = now();
        $diferenciaMin = $horaSalida->diffInMinutes($registro->hora_ingreso);
        
        // Cálculo de la tarifa
        if ($diferenciaMin <= 15) {
            $totalPago = 500;
        } elseif ($diferenciaMin <= 70) {
            $totalPago = 700;
        } else {
            $horas = ceil(($diferenciaMin - 10) / 60);
            $totalPago = $horas * 700;
        }
    
        $registro->update([
            'hora_salida' => $horaSalida,
            'total_pago' => $totalPago,
            'estado' => 'salido',
        ]);
    
        return response()->json($registro);
    }
    
}
