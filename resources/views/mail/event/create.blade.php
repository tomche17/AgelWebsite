<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Votre événement {{$event->nom}} a été créé !</title>

    <style type="text/css">
        @media only screen and (max-width: 639px) {
            body,table,td,p,a,li,blockquote {
            -webkit-text-size-adjust:none !important;
            }
            table {width: 100% !important;}
        }
    </style>
</head>

<body>
<table width="640" border="0" align="center" cellpadding="0" cellspacing="0">

    <!-- Header -->
    <tr>
        <td width="20" valign="top">&nbsp;</td>
        <td width="100%" valign="top" align="center">
            <font face="Tahoma, Verdana, Segoe, sans-serif" color="#A9A9A9">
                <p style="font-size:12px;">Si cet email s'affiche mal, vous pouvez cliquer <a href="{{ route('event.show', $event->id) }}" style="color:#B8AD9E; font-style:italic;" title="afficher l'email sur le navigateur">ici</a></p>
            </font>
        </td>
        <td width="20" valign="top">&nbsp;</td>
    </tr>
    <!-- Espacement -->
    <tr>
        <td width="20" valign="top">&nbsp;</td>
        <td width="100%" height="40px" valign="top">&nbsp;</td>
        <td width="20" valign="top">&nbsp;</td>
    </tr>
    <!-- Titre -->
    <tr>
        <td width="20" valign="top">&nbsp;</td>
        <td width="100%" valign="top" align="center">
            <font face="Tahoma, Verdana, Segoe, sans-serif" color="black">
                <p style=" font-size:20px; margin:0px; padding:0px;">Votre événement {{$event->nom}} a été créé avec succès!</p>
            </font>
        </td>
        <td width="20" valign="top">&nbsp;</td>
    </tr>

    <!-- Détails de l'événement -->
    <tr>
        <td width="20" valign="top">&nbsp;</td>
        <td width="600" valign="top"><font face="Tahoma, Verdana, Segoe, sans-serif', serif" color="black"><p style="font-size:19px; margin:0px; padding:0px;">Détails de l'événement</p></font></td>
        <td width="20" valign="top">&nbsp;</td>
    </tr>
    <tr>
        <td width="20" valign="top">&nbsp;</td>
        <td width="100%" height="25px" valign="top">&nbsp;</td>
        <td width="20" valign="top">&nbsp;</td>
    </tr>
    <tr>
        <td width="20" valign="top">&nbsp;</td>
        <td width="600" valign="top">
            <p style="margin:0px; padding:0px; font-size:14px;">
                <font face="Tahoma, Verdana, Segoe, sans-serif">Nom de l'événement : {{$event->nom}}</font>
            </p>
            <p style="margin:0px; padding:0px; font-size:14px;">
                <font face="Tahoma, Verdana, Segoe, sans-serif">Date : {{$event->date}}</font>
            </p>
            <p style="margin:0px; padding:0px; font-size:14px;">
                <font face="Tahoma, Verdana, Segoe, sans-serif">Salle : {{$event->salle}}</font>
            </p>
        </td>
        <td width="20" valign="top">&nbsp;</td>
    </tr>

    <!-- Pied de page -->
    <tr>
        <td width="20" valign="top">&nbsp;</td>
        <td width="100%" height="55px" valign="top">&nbsp;</td>
        <td width="20" valign="top">&nbsp;</td>
    </tr>
    <tr>
        <td width="20" valign="top">&nbsp;</td>
        <td width="600" valign="top" align="center">
            <font face="Tahoma, Verdana, Segoe, sans-serif" color="#777777">
                <p style="font-size:15px; width:100%; text-align:center;">A bientôt !</p>
                <p style="font-size:15px; width:100%; text-align:center;">L'Association Générale des Étudiants Liégeois</p>
            </font>
        </td>
        <td width="20" valign="top">&nbsp;</td>
    </tr>

</table>
</body>
</html>
