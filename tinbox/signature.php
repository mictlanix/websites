<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta charset="UTF-8"/>
</head>
<body style="background:#ccc">
    <div id="signature" style="width:400px;font:normal 14px/14px Tahoma, Geneva, sans-serif;color:#4E2812;background:#fff">
        <table style="width:100%">
            <tr>
                <th style="width:40%"></th>
                <th style="width:40%"></th>
                <th style="width:10%"></th>
                <th style="width:10%"></th>
            </tr>
            <tr>
                <td style="width:40%">
                    <img style="margin:0 0 0 2px;border:0;" src="images/signature-logo.png" alt="Tinbox" title="Tinbox"/>
                </td>
                <td style="width:60%;text-align:right" colspan="3">
                    <div style="margin:0 3px 0 0;font-size:16px;font-weight:bold"><?=$_GET["name"]?></div>
                    <div style="margin:5px 3px 0 0;font-size:16px;"><a style="color:#4E2812;text-decoration:none" href="mailto:<?=$_GET["email"]?>"><?=$_GET["email"]?></a></div>
                </td>
            </tr>
            <tr>
                <td style="width:90%" colspan="3">
                    <div style="margin:0 0 0 3px">Georgia 181 Col. Nápoles 03810 México D.F.</div>
                    <div style="margin:4px 0 0 3px">Tel. 5672-3912 y 5672-3944</div>
                    <div style="margin:3px 10px 0 3px"><a style="color:#4E2812;text-decoration:none" href="http://tinbox.mx" target="_blank">www.tinbox.mx</a></div>
                </td>
                <td style="width:10%;text-align:right">
                    <img style="margin:0 2px 0 0;border:0;" src="images/signature-bird.png" alt="Tinbox" title="Tinbox"/>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>