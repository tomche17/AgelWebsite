<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Récapitulatif de l'inventaire</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 40px;
        }

        .header {
            text-align: center;
            padding: 20px 0;
            border-bottom: 2px solid #000;
            position: relative;
        }

        .content-header-item {
            position: absolute;
            top: 20px;
            right: 0;
        }

        .section-title {
            font-weight: bold;
            margin-top: 30px;
            margin-bottom: 25px; /* augmenté l'espace ici */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px; /* ajout d'un espace sous les tableaux */
        }

        table, th, td {
            border: 1px solid #000;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .pb-4 {
            padding-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="content-header-item">
        <a class="link-effect font-w700" href="/">
            <img src="{{ public_path('images/agel.png') }}" style="width:125px;">
        </a>
    </div>
<div class="header">
    <h2>Récapitulatif de l'inventaire de sortie</h2>

</div>

<div class="content">
    <div class="pb-4">
    </br>
        <span class="section-title">Date de l'inventaire:</span> {{ $inventaire->date }}
    </div>
    
    <div class="pb-4">
        <span class="section-title">Nom de l'évènement:</span> {{ $inventaire->event_name }}
    </div>

    <div class="pb-4">
        <span class="section-title">Nom du responsable AGEL:</span> {{$inventaire->agel_name }}
    </div>
    
    <div class="pb-4">
        <span class="section-title">Nom du CB Sortant:</span> {{$inventaire->comiteOut->nom }}
    </div>

    <div class="pb-4">
        <span class="section-title">Stock actuel le {{ date('d-m-Y') }}:</span></br></br>
        <table>
            <thead>
                <tr>
                    <th>Objet compté</th>
                    <th>Nombre compté</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stocks as $stock)
                    <tr>
                        <td>{{ $stock->name }}</td>
                        <td>{{ $stock->quantity }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="pb-4">
        <span class="section-title">Changement du stock:</span></br></br>
        @if(!empty($modif_items))
        <table>
            <thead>
                <tr>
                    <th>Objet compté</th>
                    <th>Manquants</th>
                    <th>Prix unitaire</th>
                    <th>Prix total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($modif_items as $item => $details)
                    <tr>
                        <td>{{ $item }}</td>
                        <td>{{ $details['quantity'] }}</td>
                        <td>{{ $details['prix_unitaire'] }} €</td>
                        <td>{{ $details['prix'] }} €</td>
                    </tr>
                @endforeach
            </tbody>

           
        </table>
        <div class="pb-4">
        <span class="section-title"></span>  Si facture il y a, celle-ci vous sera envoyée par la trésorerie.
    </div>
        @else
        <p>Aucun éléments manquants.</p>
    @endif
      <!-- ... [reste du code au-dessus] ... -->



    <hr style="margin-top: 40px;">

    <div style="margin-top: 30px;">
        <p style="text-align: center;">En signant ce papier, je reconnais être d'accord avec les chiffres mentionnés ci-dessus.</p>
        
        <table style="width: 100%; margin-top: 40px; border-collapse: collapse;">
            <tr>
                <!-- Cellule pour l'AGEL -->
                <td style="width: 50%; vertical-align: top; padding-right: 20px; border-right: 1px solid #000;">
                    <p>Pour l'AGEL,</p>
                    <p style="margin-top: 20px; border-bottom: 1px solid #000; padding-bottom: 10px;">Nom et prénom</p>
                    <p style="margin-top: 20px;">Signature</p>
                </td>

                <!-- Cellule pour le comité sortant -->
                <td style="width: 50%; vertical-align: top; padding-left: 20px;">
                    <p>Pour le comité sortant,</p>
                    <p style="margin-top: 20px; border-bottom: 1px solid #000; padding-bottom: 10px;">Nom et prénom</p>
                    <p style="margin-top: 20px;">Signature</p>
                </td>
            </tr>
        </table>
    </div>
</div>

</body>
</html>
