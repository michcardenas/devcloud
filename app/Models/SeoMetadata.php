<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoMetadata extends Model
{
    use HasFactory;

    /**
     * La tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'seo_metadata';

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'page_slug',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'meta_robots',
        'canonical_url',
        'og_title',
        'og_description',
        'og_image',
        'og_type',
        'og_url',
        'og_site_name',
        'og_locale',
        'twitter_card',
        'twitter_title',
        'twitter_description',
        'twitter_image',
        'twitter_image_alt',
        'twitter_site',
        'twitter_creator',
        'language_code',
    ];

    /**
     * Obtiene el título más apropiado considerando las alternativas disponibles.
     * Prioriza el meta_title, y si no existe, busca alternativas.
     *
     * @return string
     */
    public function getBestTitleAttribute()
    {
        return $this->meta_title ?? $this->og_title ?? $this->twitter_title ?? 'DevCloud';
    }

    /**
     * Obtiene la mejor descripción disponible.
     *
     * @return string|null
     */
    public function getBestDescriptionAttribute()
    {
        return $this->meta_description ?? $this->og_description ?? $this->twitter_description ?? null;
    }

    /**
     * Obtiene la mejor imagen disponible para redes sociales.
     *
     * @return string|null
     */
    public function getBestImageAttribute()
    {
        return $this->og_image ?? $this->twitter_image ?? null;
    }

    /**
     * Determina si la página debe ser indexada por los motores de búsqueda.
     *
     * @return bool
     */
    public function getShouldIndexAttribute()
    {
        if (empty($this->meta_robots)) {
            return true;
        }
        
        return !str_contains(strtolower($this->meta_robots), 'noindex');
    }

    /**
     * Determina si los enlaces de la página deben ser seguidos.
     *
     * @return bool
     */
    public function getShouldFollowAttribute()
    {
        if (empty($this->meta_robots)) {
            return true;
        }
        
        return !str_contains(strtolower($this->meta_robots), 'nofollow');
    }

    /**
     * Obtiene los metadatos SEO para una página específica por su slug.
     *
     * @param string $slug
     * @return SeoMetadata|null
     */
    public static function findBySlug($slug)
    {
        return self::where('page_slug', $slug)->first();
    }

    /**
     * Obtiene o crea metadatos SEO para una página.
     *
     * @param string $slug
     * @param array $defaults
     * @return SeoMetadata
     */
    public static function getOrCreate($slug, $defaults = [])
    {
        $seo = self::where('page_slug', $slug)->first();
        
        if (!$seo) {
            $data = array_merge([
                'page_slug' => $slug,
                'meta_robots' => 'index, follow',
                'og_type' => 'website',
                'og_locale' => 'es_CO',
                'twitter_card' => 'summary_large_image',
                'language_code' => 'es',
            ], $defaults);
            
            $seo = self::create($data);
        }
        
        return $seo;
    }
}