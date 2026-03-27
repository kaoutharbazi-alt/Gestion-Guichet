<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<style>
body{
font-family: DejaVu Sans;
}
.title{
text-align:center;
font-size:28px;
font-weight:bold;
margin-top:40px;
}
.right{
float:right;
width:30%;
text-align:right;
}
.signature{
margin-top:80px;
text-align:center;
}
</style>
</head>

<body>

<h3 style="text-align:center">
ROYAUME DU MAROC<br>
UNIVERSITE MOHAMED 1er<br>
FACULTE DES SCIENCES OUJDA
</h3>
<div class="right">

<img src="{{ public_path('logo.png') }}" width="90">

</div>
<div class="title">
ATTESTATION DE REUSSITE
</div>

<p>
Le Doyen de la Faculté des Sciences d’Oujda atteste que :
</p>

<p>
<b>{{$demande->etudiant->nom }} {{$demande->etudiant->prenom }}</b>
</p>

<p>CNE : {{ $demande->etudiant->cne }}</p>

<p>
A réussi ses études dans la filière :
<b>{{ $demande->etudiant->filiere }}</b>
</p>

<p>
Cycle : {{ $demande->etudiant->cycle }}
</p>

<br><br>

<p style="text-align:right">
Oujda le : {{ date('d/m/Y') }}
</p>

<p style="text-align:center;margin-top:60px">
<b>LE DOYEN</b>
</p>
<div class="signature">
<img src="{{ public_path('signature.png') }}" width="150">
</div>
</body>
</html>