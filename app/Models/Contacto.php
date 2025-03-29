<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    use HasFactory;

    /**
     * La tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'contacto';

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'contact_tag',
        'contact_title',
        'contact_description',
        'contact_email',
        'contact_phone',
        'contact_address',
        'faq_button_text',
        'faq_title',
        'faq_description',
    ];
}