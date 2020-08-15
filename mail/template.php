<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <title>Alex Melo</title>
    </head>

    <body>
        <table style='width: 100% color: red border:1px'>
        <thead style='text-align: center'><tr><td style='border:none' colspan='2'>
        <a href='{$link}'><img src='{$logo}' alt=''></a><br><br>
        </td></tr></thead><tbody><tr>
        <td style=' color: red'><strong>Name:</strong> {<?=$name?>}</td>
        <td style=''><strong>Name:</strong> {<?=$name?>}</td>
        <td style=''><strong>Name:</strong> {<?=$name?>}</td>
        <td style=''><strong>Name:</strong> {<?=$name?>}</td>
        <td style=''><strong>Email:</strong> {<?=$from?>}</td>
        </tr>
        <tr><td style=''><strong>Subject:</strong> {<?=$subject?>}</td></tr>
        <tr><td></td></tr>
        <tr><td colspan='2' style=''>{<?=$message?>}</td></tr>
        </tbody></table>
    </body>
 </html>