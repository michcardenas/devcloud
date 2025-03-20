<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CotizacionMail;
use Illuminate\Support\Facades\Validator;

class CotizacionController extends Controller
{
    /**
     * Procesa y envía la solicitud de cotización por correo.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function enviar(Request $request)
    {
        // Validar los datos del formulario
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'telefono' => 'nullable|string|max:20',
            'servicio' => 'required|string|max:100',
            'region' => 'required|string|max:100',
            'presupuesto' => 'required|string|max:100',
            'mensaje' => 'required|string',
            'acepto_privacidad' => 'required|accepted',
        ], [
            'nombre.required' => 'El nombre es obligatorio',
            'email.required' => 'El correo electrónico es obligatorio',
            'email.email' => 'Introduce un correo electrónico válido',
            'servicio.required' => 'Selecciona un servicio',
            'region.required' => 'Selecciona una región',
            'presupuesto.required' => 'Selecciona un rango de presupuesto',
            'mensaje.required' => 'El mensaje es obligatorio',
            'acepto_privacidad.required' => 'Debes aceptar las condiciones de uso y política de privacidad',
            'acepto_privacidad.accepted' => 'Debes aceptar las condiciones de uso y política de privacidad',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Preparar los datos para el correo
        $datos = [
            'nombre' => $request->nombre,
            'email' => $request->email,
            'telefono' => $request->telefono ?: 'No proporcionado',
            'servicio' => $request->servicio,
            'region' => $request->region,
            'presupuesto' => $request->presupuesto,
            'mensaje' => $request->mensaje,
            'fecha' => now()->format('d/m/Y H:i'),
            'ip' => $request->ip(),
        ];

        // Enviar el correo
        try {
            Mail::to(config('mail.from.address'))
                ->send(new CotizacionMail($datos));

            return redirect()->back()->with('success', 'Tu solicitud de cotización ha sido enviada correctamente. Nos pondremos en contacto contigo en breve.');
        } catch (\Exception $e) {
            // Registrar el error
            \Log::error("Error al enviar correo de cotización: " . $e->getMessage());
            
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Ha ocurrido un error al enviar la solicitud. Por favor, inténtalo de nuevo más tarde.']);
        }
    }
}