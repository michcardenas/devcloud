<?php
namespace App\Http\Controllers;

use App\Models\HomepageContent;
use App\Models\PaginaNosotros;
use Illuminate\Http\Request;
use App\Models\PartnerTecnologico;


class HomeController extends Controller
{
    public function index()
    {
        $content = HomepageContent::firstOrCreate([]);
        
        $contenido = PaginaNosotros::first(); 
        
        $partners = PartnerTecnologico::first();
        
        if (!$partners) {
            $partners = new PartnerTecnologico();
        }
        
        return view('index', compact('content', 'contenido', 'partners'));
    }
}
