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
        Université Mohammed Premier<br>
        Faculté des Sciences Oujda<br>
        Services Des Affaires Estudiantines
    </h3>
    <div class="right">
        <img src="{{ public_path('logo.png') }}" width="90">
    </div>
    <div class="title">
        ATTESTATION DE VACANCES
    </div>
    <p>Le Doyen de la Faculté des Sciences d’Oujda , atteste par la présente</p>
    <p>
        Que les vacances de fin d’Année Universitaire :
        <b>{{ date('Y') }}-{{ date('Y')+1 }}</b>
    </p>
    <p>
        Pour les étudiants Régulièrement inscrits à la dite Faculté :
    </p>
    <p>
        Auront lieu du : <b>01/08/{{ date('Y') }}</b>
        au <b>31/08/{{ date('Y') }}</b>
    </p>
    <p>
        Cette attestation est délivrée à l’étudiant(e) :
        <b>{{ $demande->etudiant->nom }} {{ $demande->etudiant->prenom }}</b>
    </p>
    <p>
        <b>CNE : {{ $demande->etudiant->cne }}</b> Pour servir et valoir ce que de droit
    </p>
    <br><br>
    <p style="text-align:right">
        Fait à Oujda le : {{ date('d/m/Y') }}
    </p>
    <p style="text-align:center;margin-top:60px">
        <b>Le Doyen</b>
    </p>
    <div class="signature">
        <img src="{{ public_path('signature.png') }}" width="150">
    </div>
</body>
</html>