<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomepageContent extends Model

{
    /**
     * La tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'homepage_contents';

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'hero_tagline',
        'hero_title_1',
        'hero_title_2',
        'hero_description',
        'hero_bg_image',
        'stat_projects',
        'stat_clients',
        'stat_experts',
        'stat_years',
        'services_tag',
        'services_title',
        'services_description',
        'services', // Almacenará un array de servicios
        'contact_tag',
        'contact_title',
        'contact_description',
        'contact_phone',
        'contact_email',
        'contact_address',
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     *
     * @var array
     */
    protected $casts = [
        'services' => 'array',
    ];

    /**
     * Obtiene la URL completa de la imagen de fondo del hero.
     *
     * @return string|null
     */
    public function getHeroBgImageUrlAttribute()
    {
        if (!$this->hero_bg_image) {
            return asset('images/cloud-dark-bg.jpg');
        }
        
        if (strpos($this->hero_bg_image, 'http') === 0 || strpos($this->hero_bg_image, '//') === 0) {
            return $this->hero_bg_image;
        }
        
        return asset($this->hero_bg_image);
    }
    
    /**
     * Obtiene la URL del icono de un servicio específico.
     *
     * @param int $index Índice del servicio
     * @return string|null
     */
    public function getServiceIconUrl($index)
    {
        if (!isset($this->services[$index]['icon']) || empty($this->services[$index]['icon'])) {
            return null;
        }
        
        $iconPath = $this->services[$index]['icon'];
        
        if (strpos($iconPath, 'http') === 0 || strpos($iconPath, '//') === 0) {
            return $iconPath;
        }
        
        return asset($iconPath);
    }
    
    /**
     * Obtiene un valor por defecto para los servicios si no hay ninguno configurado.
     *
     * @return array
     */
    public function getServicesAttribute($value)
    {
        $services = json_decode($value, true);
        
        if (empty($services) || !is_array($services)) {
            return [
                [
                    'title' => 'Desarrollo Web',
                    'description' => 'Creamos sitios web modernos, responsivos y optimizados para buscadores.',
                    'icon' => null
                ],
                [
                    'title' => 'Cloud Computing',
                    'description' => 'Servicios de nube que mejoran la eficiencia y reducen costos operativos.',
                    'icon' => null
                ],
                [
                    'title' => 'Consultoría IT',
                    'description' => 'Asesoramiento técnico para implementar soluciones tecnológicas efectivas.',
                    'icon' => null
                ]
            ];
        }
        
        return $services;
    }
}