<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Une nouvelle commande N°{{$commande->id}} a été créée !</title>
    <!-- le reste de vos styles -->
</head>
<body>
<table width="640" border="0" align="center" cellpadding="0" cellspacing="0">
    <!-- ... -->
    <tr>
        <td width="20" valign="top">&nbsp;</td>
        <td width="100%" valign="top" align="center"><font face="Tahoma, Verdana, Segoe, sans-serif" color="black"><p style=" font-size:20px; margin:0px; padding:0px;">Notification d'une nouvelle commande</p></font></td>
        <td width="20" valign="top">&nbsp;</td>
    </tr>
    <!-- ... Le reste du contenu reprenant les détails de la commande ... -->
    <tr>
        <td width="20" valign="top">&nbsp;</td>
        <td width="600" valign="top">
            <p style="margin:0px; padding:0px; font-size:14px;"><font face="Tahoma, Verdana, Segoe, sans-serif">
            Une nouvelle commande a été passée. Veuillez la vérifier et la valider si tout est en ordre.</font></p>
        </td>
        <td width="20" valign="top">&nbsp;</td>

 <tr>
    <td width="20" valign="top">&nbsp;</td>
    <td width="600" valign="top"><font face="Tahoma, Verdana, Segoe, sans-serif', serif" color="black"><p style="font-size:19px; margin:0px; padding:0px;">Informations générales</p></font></td>
    <td width="20" valign="top">&nbsp;</td>
 </tr>

  <tr>
    <td width="20" valign="top">&nbsp;</td>
    <td width="100%" height="25px"valign="top">&nbsp;</td>
    <td width="20" valign="top">&nbsp;</td>
 </tr>

 <tr>
    <td width="20" valign="top">&nbsp;</td>
    <td width="600" valign="top"><p style="margin:0px; padding:0px; font-size:14px;"><font face="Tahoma, Verdana, Segoe, sans-serif">Evenement: {{$commande->event->nom}} qui aura lieu le {{$commande->event->date}}</font></p></td>
    <td width="20" valign="top">&nbsp;</td>
 </tr>
 <tr>
    <td width="20" valign="top">&nbsp;</td>
    <td width="600" valign="top"><p style="margin:0px; padding:0px; font-size:14px;"><font face="Tahoma, Verdana, Segoe, sans-serif">Estimation affluence : {{$commande->frequentation}}</font></p></td>
    <td width="20" valign="top">&nbsp;</td>
 </tr>

 <tr>
    <td width="20" valign="top">&nbsp;</td>
    <td width="600" valign="top"><p style="margin:0px; padding:0px; font-size:14px;"><font face="Tahoma, Verdana, Segoe, sans-serif">Commanditaire : {{$commande->prenom}} {{$commande->nom}}</font></p></td>
    <td width="20" valign="top">&nbsp;</td>
 </tr>

 <tr>
    <td width="20" valign="top">&nbsp;</td>
    <td width="600" valign="top"><p style="margin:0px; padding:0px; font-size:14px;"><font face="Tahoma, Verdana, Segoe, sans-serif">Email : {{$commande->email}}</font></p></td>
    <td width="20" valign="top">&nbsp;</td>
 </tr>

 <tr>
    <td width="20" valign="top">&nbsp;</td>
    <td width="600" valign="top"><p style="margin:0px; padding:0px; font-size:14px;"><font face="Tahoma, Verdana, Segoe, sans-serif">Adresse Légale : {{$commande->adresselegale}}</font></p></td>
    <td width="20" valign="top">&nbsp;</td>
 </tr>

 <tr>
    <td width="20" valign="top">&nbsp;</td>
    <td width="600" valign="top"><p style="margin:0px; padding:0px; font-size:14px;"><font face="Tahoma, Verdana, Segoe, sans-serif">Adresse de facturation : {{$commande->adressefacturation}}</font></p></td>
    <td width="20" valign="top">&nbsp;</td>
 </tr>

 <tr>
    <td width="20" valign="top">&nbsp;</td>
    <td width="600" valign="top"><p style="margin:0px; padding:0px; font-size:14px;"><font face="Tahoma, Verdana, Segoe, sans-serif">Adresse de livraison : {{$commande->adresselivraison}}</font></p></td>
    <td width="20" valign="top">&nbsp;</td>
 </tr>

 <tr>
    <td width="20" valign="top">&nbsp;</td>
    <td width="600" valign="top"><p style="margin:0px; padding:0px; font-size:14px;"><font face="Tahoma, Verdana, Segoe, sans-serif">Numéro du responsable du comité pour l'inventaire : {{$commande->telephone}}</font></p></td>
    <td width="20" valign="top">&nbsp;</td>
 </tr>

 <tr>
   <td width="20" valign="top">&nbsp;</td>
   <td width="100%" height="40px"valign="top">&nbsp;</td>
   <td width="20" valign="top">&nbsp;</td>
</tr>

<tr>
   <td width="20" valign="top">&nbsp;</td>
   <td width="600" valign="top"><font face="Tahoma, Verdana, Segoe, sans-serif', serif" color="black"><p style="font-size:19px; margin:0px; padding:0px;">Commande</p></font></td>
   <td width="20" valign="top">&nbsp;</td>
</tr>

 <tr>
   <td width="20" valign="top">&nbsp;</td>
   <td width="100%" height="25px"valign="top">&nbsp;</td>
   <td width="20" valign="top">&nbsp;</td>
</tr>

@foreach($commande->futs as $fut)
  @if($fut->pivot->nombre > 0)
    <tr>
       <td width="20" valign="top">&nbsp;</td>
       <td width="600" valign="top"><p style="margin:0px; padding:0px; font-size:14px;"><font face="Tahoma, Verdana, Segoe, sans-serif">{{$fut->nom}} x {{$fut->pivot->nombre}}</font></p></td>
       <td width="20" valign="top">&nbsp;</td>
    </tr>
  @endif
@endforeach

<tr>
  <td width="20" valign="top">&nbsp;</td>
  <td width="100%" height="25px"valign="top">&nbsp;</td>
  <td width="20" valign="top">&nbsp;</td>
</tr>

    </tr>
    <!-- ... -->
    <tr>
        <td width="20" valign="top">&nbsp;</td>
        <td width="600" valign="top" align="center"><font face="Tahoma, Verdana, Segoe, sans-serif" color="#777777"><p style="font-size:15px; width:100%; text-align:center;">L'équipe de l'Association Générale des Etudiants Liegeois</p></font></td>
        <td width="20" valign="top">&nbsp;</td>
    </tr>
</table>
</body>
</html>
