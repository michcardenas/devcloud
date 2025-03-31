<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\HomePageContent;

class PartnershipController extends Controller
{
    /**
     * Procesa el formulario de solicitud de partnership
     */
    public function submit(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'empresa' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nivel' => 'required|string|in:platinum,gold,silver',
            'mensaje' => 'nullable|string',
        ]);
        
        // Obtener el correo de contacto de la base de datos
        $content = HomePageContent::first();
        $contactEmail = $content->contact_email ?? config('mail.from.address');
        
        // Enviar correo con los datos del formulario
        try {
            Mail::send('emails.partnership-request', [
                'nombre' => $validated['nombre'],
                'empresa' => $validated['empresa'],
                'email' => $validated['email'],
                'nivel' => ucfirst($validated['nivel']),
                'mensaje' => $validated['mensaje'],
                'fecha' => now()->format('d/m/Y H:i'),
            ], function ($message) use ($contactEmail, $validated) {
                $message->to($contactEmail)
                        ->subject('Nueva solicitud de Partnership: ' . $validated['empresa']);
            });
            
            return redirect()->back()->with('success', 'Tu solicitud ha sido enviada correctamente. Nos pondremos en contacto contigo pronto.');
        } catch (\Exception $e) {
            \Log::error('Error al enviar email de solicitud de partnership: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Hubo un problema al enviar tu solicitud. Por favor, inténtalo de nuevo más tarde.');
        }
    }
}