<?php
namespace App\Http\Controllers;

use App\Models\HomepageContent;
use App\Models\PaginaNosotros;
use Illuminate\Http\Request;
use App\Models\SeoMetadata;
use App\Models\Testimonio;
use App\Models\PartnerTecnologico;


class HomeController extends Controller
{
    public function index()
    {
        $content = HomepageContent::firstOrCreate([]);
        $contenido = PaginaNosotros::first(); 
        $partners = PartnerTecnologico::first();
        $testimonios = Testimonio::all();
        
        if (!$partners) {
            $partners = new PartnerTecnologico();
        }
        
        // Obtener los metadatos SEO para la página Home
        $seo = SeoMetadata::where('page_slug', 'home')->first();
        
        return view('index', compact('content', 'contenido', 'partners', 'seo', 'testimonios'));
    }
    
}
