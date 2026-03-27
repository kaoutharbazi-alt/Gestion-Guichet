<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Demande extends Model
{
    protected $fillable = [
        'etudiant_id',
        'type_document',
        'etat',
        'signature_electronique',
        'date_traitement'
    ];
    protected $casts = [
        'date_traitement' => 'datetime'
    ];
    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}