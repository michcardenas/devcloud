<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaginaNosotros;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class NosotrosController extends Controller
{
    public function index()
    {
        $data = \App\Models\PaginaNosotros::first();
        return view('admin.nosotros', compact('data'));
    }
    public function store(Request $request)
    {
        $registro = PaginaNosotros::first();
        $data = $request->except('_token');
    
        $camposImagen = [
            'imagen1',
            'imagen2',
            'imagen_mision',
            'imagen_vision',
            'imagen_valores',
        ];
    
        for ($i = 1; $i <= 10; $i++) {
            $camposImagen[] = "imagen_tarjeta$i";
        }
    
        // Procesamos cada imagen
        foreach ($camposImagen as $campo) {
            if ($request->hasFile($campo)) {
                $file = $request->file($campo);
                $filename = time() . '_' . $campo . '.' . $file->getClientOriginalExtension();
    
                $destinationPath = public_path('images/nosotros');
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0755, true);
                }
    
                $file->move($destinationPath, $filename);
                $data[$campo] = "images/nosotros/" . $filename;
    
                // Borrar imagen anterior si se actualiza
                if ($registro && $registro->$campo && File::exists(public_path($registro->$campo))) {
                    File::delete(public_path($registro->$campo));
                }
            } elseif ($registro) {
                // Mantener imagen anterior si no se sube nueva
                $data[$campo] = $registro->$campo;
            }
        }
    
        if ($registro) {
            $registro->update($data);
        } else {
            PaginaNosotros::create($data);
        }
    
        return redirect()->back()->with('success', 'Información guardada correctamente.');
    }
    
}
