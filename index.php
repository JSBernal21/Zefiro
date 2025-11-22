<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Zefiro Aerolinea</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://use.fontawesome.com/releases/v6.7.2/css/all.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="icon" href="img/logoAzul.png">
    </head>

    <body>
        <?php 
        if(!isset($_GET["pid"])){
            include ("presentacion/inicio.php");    
        }/*else{
            $pid = base64_decode($_GET["pid"]);
            if(isset($_SESSION["id"])){
                include ($pid);
            }else{
                include ($pid);
                //TODO reparar esto
            }
        }*/
        ?>       
    </body>
</html>
