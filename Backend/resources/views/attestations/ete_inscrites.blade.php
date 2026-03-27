<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<style>
body{
font-family: DejaVu Sans;
margin:40px;
}

.header{
text-align:left;
}

.logo{
position:absolute;
right:40px;
top:40px;
}

.title{
text-align:center;
font-size:20px;
font-weight:bold;
margin-top:60px;
}

.content{
margin-top:40px;
font-size:15px;
}

.footer{
margin-top:50px;
text-align:center;
}

.note{
margin-top:80px;
font-size:14px;
}
</style>
</head>
<body>
<?php $etudiant = $demande->etudiant; ?>
    <div class="header">
        <b>ROYAUME DU MAROC</b><br>
        <b>UNIVERSITE MOHAMED 1er</b><br>
        <b>FACULTE DES SCIENCES</b><br>
        <b>OUJDA</b>
    </div>
    <div class="logo">
        <img src="{{ public_path('logo.png') }}" width="90">
    </div>
    <div class="title">
        ATTESTATION A ETE INSCRITE
    </div>
    <div class="content">
        <p>Le Doyen de la Faculté des Sciences d’Oujda, atteste que l’étudiant(e) :</p>
        <p>
            Nom et Prénom :<b>{{ $demande->etudiant->nom }} {{ $demande->etudiant->prenom }}</b>
        </p>
        <p>
        CNE : <b>{{ $demande->etudiant->cne }}</b>
        </p>
        <p>
            CNI : <b>{{ $demande->etudiant->cni }}</b>
        </p>
         <p>
            Né(e) le : <b>{{ $demande->etudiant->date_naissance }}</b>
            &nbsp;&nbsp;&nbsp;&nbsp;
            à <b>{{ $demande->etudiant->lieu_naissance }}</b>
        </p>
        <p>
        A été inscrit(e) à la filière :
        <b>{{ $demande->etudiant->filiere }}</b>
        </p>
        <p>
        Au titre de l’année universitaire :
        <b>{{ date('Y')-1 }}/{{ date('Y') }}</b>
        </p>
        <p>
        Cycle : <b>{{ $demande->etudiant->cycle }}</b>
        </p>
    </div>
    <div class="footer">
        <p style="text-align:right">
            Oujda, le : {{ date('d/m/Y') }}
        </p>
        <p><b>LE DOYEN</b></p>
        <img src="{{ public_path('signature.png') }}" width="140">
    </div>
    <div class="note">
        <b>N.B :</b> Il ne sera pas délivré de duplicata de cette attestation, le titulaire peut en faire des copies légalisées.
    </div>
</body>
</html>