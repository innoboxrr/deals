<?php

namespace Innoboxrr\Deals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\Traits\ModelAppendsTrait;
use Innoboxrr\LaravelAudit\Support\Traits\Auditable;
use Innoboxrr\Deals\Models\Traits\Relations\DealProductRelations;
use Innoboxrr\Deals\Models\Traits\Storage\DealProductStorage;
use Innoboxrr\Deals\Models\Traits\Assignments\DealProductAssignment;
use Innoboxrr\Deals\Models\Traits\Operations\DealProductOperations;
use Innoboxrr\Deals\Models\Traits\Mutators\DealProductMutators;

class DealProduct extends Model
{

    use HasFactory,
        SoftDeletes,
        MetaOperations,
        ModelAppendsTrait,
        Auditable,
        DealProductRelations,
        DealProductStorage,
        DealProductAssignment,
        DealProductOperations,
        DealProductMutators;
        
    protected $fillable = [
        'name',
        'description',
        'payload',
        'deal_id',
    ];
    
    protected $creatable = [
        'name',
        'description',
        'deal_id',
    ];
    
    protected $updatable = [
        'name',
        'description',
        'payload',
    ];
    
    protected $casts = [
        'payload' => 'array',
        'deal_id' => 'integer',
    ];
    
    protected $protected_metas = [];
    
    protected $editable_metas = [
        // Información general y creativa
        'image',             // URL de la imagen principal
        'gallery',           // Galería de imágenes adicionales (array)
        'video_url',         // URL del video promocional (si aplica)
        'tagline',           // Eslogan o lema breve
        'description',       // Descripción detallada del producto
        'features',          // Lista de características principales (array)
        'benefits',          // Lista de beneficios clave (array)
    
        // Detalles del producto
        'category',          // Categoría principal (ej.: seguros, salud, automóviles)
        'sub_category',      // Subcategoría (si aplica)
        'brand',             // Marca o proveedor
        'model',             // Modelo o versión del producto
        'price_range',       // Rango de precios o nivel de precio (ej.: "$$", "$$$")
        'warranty',          // Detalles de garantía (si aplica)
        'availability',      // Información de disponibilidad o stock
    
        // Público objetivo del producto
        'min_age',           // Edad mínima recomendada
        'max_age',           // Edad máxima recomendada
        'gender',            // Género(s) a los que se dirige (ej.: ['male', 'female'])
        'ideal_interests',   // Intereses o estilos de vida que definen al cliente ideal (array)
        'usage_context',     // Escenarios o situaciones en que se usa el producto
    
        // Información de marketing
        'key_message',       // Mensaje clave o propuesta de valor
        'differentiators',   // Elementos diferenciadores frente a la competencia
        'testimonials',      // Testimonios o reseñas (opcional)
    ];    
    
    public static $export_cols = [
        'id',
        'name',
        'description',
        'payload',
        'deal_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];        

    public static $loadable_relations = [
        'deal',
        'metas',
    ];
    
    public static $loadable_counts = [
        'metas',
    ];    

    /*
    protected static function newFactory()
    {
        return \Innoboxrr\Deals\Database\Factories\DealProductFactory::new();
    }
    */

}
