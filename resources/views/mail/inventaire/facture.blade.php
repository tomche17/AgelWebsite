<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Nouvelle facture disponible</title>
    <style type="text/css">
        @media only screen and (max-width: 639px) {
            body, table, td, p, a, li, blockquote {
                -webkit-text-size-adjust: none !important;
            }
            table {
                width: 100% !important;
            }
        }
    </style>
</head>
<body>
<table width="640" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td width="20" valign="top">&nbsp;</td>
        <td width="600" valign="top" align="center"><font face="Tahoma, Verdana, Segoe, sans-serif" color="#A9A9A9"><p style="font-size:12px;">Si cet email s'affiche mal, vous pouvez cliquer <a href="#" style="color:#B8AD9E; font-style:italic;" title="afficher l'email sur le navigateur">ici</a></p></font></td>
        <td width="20" valign="top">&nbsp;</td>
    </tr>
    <tr>
        <td width="20" valign="top">&nbsp;</td>
        <td width="600" valign="top" align="center"><font face="Tahoma, Verdana, Segoe, sans-serif" color="black"><p style="font-size:24px; margin:0px; padding:0px;">Nouvelle facture disponible</p></font></td>
        <td width="20" valign="top">&nbsp;</td>
    </tr>
    <tr>
        <td width="20" valign="top">&nbsp;</td>
        <td width="600" valign="top"><p style="margin:20px 0; font-size:16px;"><font face="Tahoma, Verdana, Segoe, sans-serif">Une nouvelle facture associée à l'événement <strong>{{ $inventaire->event_name }}</strong> est maintenant disponible pour consultation.</font></p></td>
        <td width="20" valign="top">&nbsp;</td>
    </tr>
    <tr>
        <td width="20" valign="top">&nbsp;</td>
        <td width="600" valign="top"><p style="margin-bottom:30px; font-size:16px;"><font face="Tahoma, Verdana, Segoe, sans-serif">Veuillez cliquer sur le bouton ci-dessous pour visualiser la facture.</font></p></td>
        <td width="20" valign="top">&nbsp;</td>
    </tr>
    <tr>
        <td width="20" valign="top">&nbsp;</td>
        <td width="600" valign="top" align="center"><a href="{{ route('admin.facture.view', ['filename' => $inventaire->facture_path . '.xlsx']) }}">Télécharger facture</a></td>
        <td width="20" valign="top">&nbsp;</td>
    </tr>
    <tr>
        <td width="20" valign="top">&nbsp;</td>
        <td width="600" valign="top" align="center"><font face="Tahoma, Verdana, Segoe, sans-serif" color="#777777"><p style="font-size:15px; width:100%; text-align:center;">Cordialement,</p></font></td>
        <td width="20" valign="top">&nbsp;</td>
    </tr>
</table>
</body>
</html>
