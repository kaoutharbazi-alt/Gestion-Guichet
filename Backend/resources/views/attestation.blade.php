<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Attestation</title>
</head>

<body>

<h2 style="text-align:center;">Attestation de scolarité</h2>

<p>Nous soussignés certifions que l'étudiant :</p>

<p>Nom : {{ $demande->etudiant->nom }}</p>

<p>Prénom : {{ $demande->etudiant->prenom }}</p>

<p>CNE : {{ $demande->etudiant->cne }}</p>

<p>Filière : {{ $demande->etudiant->filiere }}</p>

<p>Cycle : {{ $demande->etudiant->cycle }}</p>

<p>Cette attestation est délivrée pour servir et valoir ce que de droit.</p>

<br><br>

<p>Signature :</p>

<img src="{{ public_path('signature.png') }}" width="150">

</body>
</html>