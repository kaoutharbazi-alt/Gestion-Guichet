<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Etudiant extends Model
{
    protected $fillable = [
        'numero_apogee',
        'cne',
        'cni',
        'nom',
        'prenom',
        'date_naissance',
        'lieu_naissance',
        'filiere',
        'cycle',
        'niveau'
    ];
    public function demandes()
    {
        return $this->hasMany(Demande::class);
    }
}