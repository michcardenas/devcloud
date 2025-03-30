<?php
namespace App\Http\Controllers;

use App\Models\HomepageContent;
use App\Models\PaginaNosotros;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $content = HomepageContent::firstOrCreate([]);
        $contenido = PaginaNosotros::first(); // Información de la sección "Nosotros"

        return view('index', compact('content', 'contenido'));
    }
}
