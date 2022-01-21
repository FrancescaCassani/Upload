<?php 
$nomepagina = "Upload file"; 

if ($_POST['action'] == 'send') {

    $pname = $_FILES["file"]["name"];
    $tname = $_FILES["file"]["tmp_name"];
    $uploads_dir = 'upload';
    $fileSize = $_FILES["file"]["size"];
    $fileError = $_FILES["file"]["error"];

    $fileExt = explode('.', $pname);
    $fileAttualeExt = strtolower(end($fileExt));
    $allowed = array('pdf', 'png', 'jpg', 'jpeg');


    if (in_array( $fileAttualeExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000) { 
                //$fileNameNew = uniqid('', true).".".$fileAttualeExt;
                $name = pathinfo($pname, PATHINFO_FILENAME);
                $fileNameNew = $name.".".$fileAttualeExt;
                

                $fileDestination = $uploads_dir.'/'.$fileNameNew;

                if (file_exists($fileDestination)) {
                    $fileNameNew = uniqid('', true).".".$fileAttualeExt;
                    $fileNameNew = $name."_".$fileNameNew;
                    $fileDestination = $uploads_dir.'/'.$fileNameNew;
                }

                move_uploaded_file($tname, $fileDestination);

                $esito = "<div role=\"alert\" class=\"alert alert-success\"><button aria-label=\"Close\" data-dismiss=\"alert\" class=\"close\" type=\"button\"><span aria-hidden=\"true\">×</span></button><div style=\"display:flex; align-items: center;\"><i style=\"font-size:20px\" class=\"fas fa-check\"></i><p style=\"padding-left:8px;margin-bottom:0 !important\">Upload effettuato correttamente.</p> </div></strong></div>";
            } else {
                $esito = "<div role=\"alert\" class=\"alert alert-warning\"><button aria-label=\"Close\" data-dismiss=\"alert\" class=\"close\" type=\"button\"><span aria-hidden=\"true\">×</span></button><div style=\"display:flex; align-items: center;\"><i style=\"font-size:20px\" class=\"fas fa-check\"></i><p style=\"padding-left:8px;margin-bottom:0 !important\">Il file è troppo grande!</p> </div></strong></div>";
            }
        } else { 
            $esito = "<div role=\"alert\" class=\"alert alert-warning\"><button aria-label=\"Close\" data-dismiss=\"alert\" class=\"close\" type=\"button\"><span aria-hidden=\"true\">×</span></button><div style=\"display:flex; align-items: center;\"><i style=\"font-size:20px\" class=\"fas fa-check\"></i><p style=\"padding-left:8px;margin-bottom:0 !important\">Errore nell'upload del file!</p> </div></strong></div>";
        }
    } else {
        $esito = "<div role=\"alert\" class=\"alert alert-warning\"><button aria-label=\"Close\" data-dismiss=\"alert\" class=\"close\" type=\"button\"><span aria-hidden=\"true\">×</span></button><div style=\"display:flex; align-items: center;\"><i style=\"font-size:20px\" class=\"fas fa-check\"></i><p style=\"padding-left:8px;margin-bottom:0 !important\">File non ammesso.</p> </div></strong></div>";
    }  
}
 
?>

<!DOCTYPE html>
<html lang="it">
<head>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="index, follow">
    <title><?php echo $nomepagina; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }
    html,body{
        display: grid;
        height: 100%;
        place-items: center;
    }

    #button{
        height: 50px;
        width: 94%;
        border: none;
        outline: none;
        color: #fff;
        font-weight: 500;
        font-size: 18px;
        cursor: pointer;
        border-radius: 5px;
        opacity: 0.5;
        background: linear-gradient(-135deg, #c850c0, #4158d0);
        transition: all 0.3s ease;
    }

    .sixth-page form .form-check,
    .sixth-page form .btn {
        margin-left: 1rem;
    }
    .sixth-page form {
        color: #00296a;
        width: 850px;
    }
</style>

<body>
    <section class="sixth-page" style="padding:0 !important">
        <div class="container" style="margin-bottom: 100px;"><?php echo $esito; ?> </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <form method="post" enctype="multipart/form-data" style="width: 500px;">
                        <input type="hidden" name="action" value="send">
                        <div class="form-group col-sm-12 pb-1">
                            <label for="cv">Allega il tuo file</label>
                            <input type="file" class="form-control" name="file" required accept="image/*">
                        </div>
                        <button id="button" type="submit" class="btn btn-primary mt-3">Invia</button>
                    </form>
                </div>
            </div>
        </div>
    </section>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
</body>
</html>


