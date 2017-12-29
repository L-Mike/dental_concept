<?php

// require 'phpmailer/class.phpmailer.php';
// require 'phpmailer/class.phpmaileroauth.php';
// require 'phpmailer/class.phpmaileroauthgoogle.php';
// require 'phpmailer/class.pop3.php';
// require 'phpmailer/class.smtp.php';
require 'phpmailer/PHPMailerAutoload.php';

$msg = "";

if(isset($_POST['contact_name']) && isset($_POST['contact_email']) && isset($_POST['contact_phone']) && isset($_POST['contact_text']) && isset($_FILES['attachment'])) {

    $contact_name = $_POST['contact_name'];
    $contact_email = $_POST['contact_email'];
    $contact_text = $_POST['contact_text'];
    $contact_phone = $_POST['contact_phone'];
    $attachment = $_FILES['attachment']['tmp_name'];  
    
    if(!empty($contact_name) && !empty($contact_email) && !empty($contact_text)) {
        if(strlen($contact_name)>25 || strlen($contact_email)>50 || strlen($contact_text)>1000) {
        $msg = '<div class="alert alert-danger">Hai superato il numero massimo di caratteri per uno qualsiasi dei campi.</div>';
    } else {

        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->CharSet = 'UTF-8';
            $mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'mail.dentalconcept23.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'office@dentalconcept23.com';                 // SMTP username
            $mail->Password = 'dentalco23';                           // SMTP password
            $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 465;                                    // TCP port to connect to
        
            //Recipients
            $mail->setFrom($contact_email);
            $mail->addAddress('office@dentalconcept23.com');
        
            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Poruka sa web sajta';
            $mail->Body = 'Ime: ' . '<strong>' . $contact_name . '</strong>' . '<br>' . 'E-mail: ' . '<strong>' . $contact_email . '</strong>' . '<br>' . 'Telefon: ' . '<strong>' . $contact_phone . '</strong>' . '<br>' . 'Poruka: ' . '<strong>' . $contact_text . '</strong>';
            $mail->AltBody = $contact_text;
            if($attachment) {
                $mail->addAttachment($_FILES['attachment']['tmp_name'], $_FILES['attachment']['name']);
            }

            $mail->send();
            $msg = '<div class="alert alert-success">Grazie per averci contattato. Il suo Dental Concept 23.</div>';
        } catch (Exception $e) {
            $msg = '<div class="alert alert-danger">C\'è stato un errore. Per favore riprova.</div>';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
    }
}

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Benvenuti! Lo studio dentistico Dental Concept 23 garantisce la salute dei vostri denti e un sorriso brillante. E tutto a prezzi bassi, ma la qualità del lavoro molto elevata.">
    <meta name="keywords" content="impianto, implants, teeth, tooth, denti, dentista, odontriatria, odontotecnico, zirconia, biohorizons, nobel, straumann, isomed, abatment, abutment, sovrastruttura, dentist, dentistry, turismo dentale, Dental tourism, belgrade, belgrado, moncone, protesi, metallo ceramica, perni, cadcam, prosthetic, surgery, chirurgo, chirurgia, conservativa, toronto, all on six, all on four, all on 6, all on 4, provvisorio, capsule, corone, crowns, temporary crown, temporary bridge, impronta, impressione, preventivo, gratitudo">
    <meta property="og:type" content="article">
    <meta property="og:title" content="Home - Dental Concept 23">
    <meta property="og:description" content="Benvenuti! Lo studio dentistico Dental Concept 23 garantisce la salute dei vostri denti e un sorriso brillante. E tutto a prezzi bassi, ma la qualità del lavoro molto elevata.">
    <meta property="og:url" content="https://dentalconcept23.com/">
    <meta property="og:site_name" content="Dental Concept 23">
    <meta property="og:image" content="http://www.dentalconcept23.com/images/logo.jpg"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/fontawesome-all.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="manifest" href="manifest.json">
    <link rel="mask-icon" href="safari-pinned-tab.svg" color="#aaaaaa">
    <meta name="theme-color" content="#ffffff">
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="js/responsiveslides.min.js"></script>
    <title>Dental Concept 23</title>
</head>
<body>
    <nav class="navbar navbar-toggleable-lg">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="index"><img src="images/logo.png" class="img-fluid" alt=""></a>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index">HOME</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="turismo-dentale">TURISMO DENTALE</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="la-clinica">LA CLINICA</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="come-funziona">COME FUNZIONA</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">LISTINO PREZZI</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="pacchetti-promozionali">Pacchetti Promozionali</a>
                    <a class="dropdown-item" href="chirurgia-orale">Chirurgia Orale</a>
                    <a class="dropdown-item" href="a-terapia-per-la-perodontia">A terapia per la perodontia</a>
                    <a class="dropdown-item" href="protesi-mobile">Protesi Mobile</a>
                    <a class="dropdown-item" href="protesi-fissa">Protesi Fissa</a>
                    <a class="dropdown-item" href="conservativa">Conservativa</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">BLOG</a>
            </li>
            <li class="nav-item">
                    <a class="nav-link" href="contatto">CONTATTO</a>
                </li>
            </ul>
        </div>
    </nav>
    
    <div class="container text-center">
        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
            <button type="button" class="btn btn-1" onclick="window.location='turismo-dentale.html'"><a href="turismo-dentale">TURISMO DENTALE</a></button>
            <button type="button" class="btn btn-2" onclick="window.location='la-clinica.html'"><a href="la-clinica">LA CLINICA</a></button>
            <button type="button" class="btn btn-3" onclick="window.location='come-funziona.php'"><a href="come-funziona">COME FUNZIONA</a></button>
            <button type="button" class="btn btn-4 active" onclick="window.location='index.php'"><a href="index">HOME</a></button>
            <div class="btn-group dropdown" role="group">
                <button id="btnGroupDrop1" type="button" class="btn dropdown-toggle btn-5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><a href="#">LISTINO PREZZI</a></button>
                <div class="dropdown-menu dropdown-menu2" aria-labelledby="btnGroupDrop1">
                <a class="dropdown-item" href="pacchetti-promozionali">Pacchetti Promozionali</a>
                <a class="dropdown-item" href="chirurgia-orale">Chirurgia Orale</a>
                <a class="dropdown-item" href="a-terapia-per-la-perodontia">A terapia per la perodontia</a>
                <a class="dropdown-item" href="protesi-mobile">Protesi Mobile</a>
                <a class="dropdown-item" href="protesi-fissa">Protesi Fissa</a>
                <a class="dropdown-item" href="conservativa">Conservativa</a>
                </div>
            </div>
            <button type="button" class="btn btn-6"><a href="#">BLOG</a></button>
            <button type="button" class="btn btn-7" onclick="window.location='contatto.php'"><a href="contatto">CONTATTO</a></button>
        </div>
        <div class="mt-lg-5">
            <a href="index"><img src="images/logo.png" class="logo" alt=""></a>
        </div>
    </div>
    <br>
    <br>
    <div class="container">
        <ul class="rslides">
            <li><img src="img/image_27.jpg" alt=""></li>
            <li><img src="img/image_1.jpg" alt=""></li>
            <li><img src="img/image_2.jpg" alt=""></li>
            <li><img src="img/image_3.jpg" alt=""></li>
            <li><img src="img/image_4.jpg" alt=""></li>
            <li><img src="img/image_5.jpg" alt=""></li>
            <li><img src="img/image_28.jpg" alt=""></li>
            <li><img src="img/image_29.jpg" alt=""></li>
            <li><img src="img/image_30.jpg" alt=""></li>
            <li><img src="img/image_31.jpg" alt=""></li>
        </ul>
    </div>
    <br>
    <br>
    <div class="container">
        <h1 class="text-center">Benvenuti in <span>DENTAL CONCEPT 23.</span></h1>
        <h1 class="text-center">Venite, sorridiamo insieme.</h1>
    </div>
    <br>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="line"></div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 mt-0 mt-md-5 mt-lg-5">
                <div class="social-icons text-center">
                    <img src="images/osmeh_1.jpg" class="img-fluid rounded mt-5" alt="">
                    <br>
                    <br>
                    <a href="https://www.facebook.com/den.con.73550" target="_blank" class="fab fa-facebook-f fa-2x fa-fw"></a>
                    <a href="https://www.instagram.com/dentalconcept23" target="_blank" class="fab fa-instagram fa-2x fa-fw"></a>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 mt-lg-5 mt-md-5 mt-5">
                <p><strong>DENTAL CONCEPT 23</strong> è il team altamente specializzato in implantologia e chirurgia orale. Il centro per la odontoiatria e implantologia moderna è diretto dalla Dott.ssa Dragana Misic  con il suo team di esperti nel campo dell'implantologia e chirurgia orale. Cerchiamo di distinguerci per la qualità del servizio che offriamo ai nostri clienti. Per noi non esistono casi senza soluzione, soluzioni parziali o compromessi. I nostri pazienti hanno la priorità assoluta, la nostra statistica è altissima, i nostri lavori sono di altissima qualità ed estetica. Il sorriso dei nostri clienti viene sempre riconosciuto e ricordato, perchè 
                <br>
                <i><strong>IL NOSTRO STANDARD E’ PERFEZIONE!</strong></i></p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <p>Il centro per odontoiatria e implantologia moderna <strong>DENTAL CONCEPT 23</strong> fornisce servizi di implantologia dentale, chirurgia orale, protetica, parodontologia, ortodonzia, odontoiatria estetica e ricostruttiva, utilizzando i materiali migliori che seguono i più alti standard europei. Con una moderna tecnica diagnostica, riceverete un buon consiglio su come risolvere il vostro problema di salute o estetico, secondo le vostre esigenze e possibilità.</p>
            </div>
        </div>
    </div>
    <br>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mx-auto">
                <div class="line"></div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <p><strong>Perché scegliere noi?</strong></p>
                <p>Quando vi offriamo un trattamento, prendiamo in considerazione i vostri desideri. Vi spieghiamo le possibilità che avete a disposizione, i prezzi, e voi potete fare la scelta. Saprete sempre che cosa facciamo. In ogni momento, se avete una domanda o non siete sicuri che cosa succeda, non esitate a chiedere a un membro del nostro team.</p>
                <p>Noi crediamo che la cura preventiva ed educazione portano alla salute ottimale dei denti. Cerchiamo di fornire ”assistenza sanitaria dei denti” ai nostri pazienti. Pertanto, durante la conversazione con il paziente, ci concetriamo sulla condizione completa della bocca, dei denti e delle gengive. Questo significa che vi diamo i consigli, vi aiutiamo di capire come prendersi cura dei vostri denti per ridurre la necessità di trattamenti odontoiatrici. Vi consigliamo di eseguire regularmente l’asportazione del tartaro e la placca morbida, di pulire i denti con il filo interdentale, di fluorizzare, perché tutto questo aiuta a prevenire le malattie dei denti. Non ci concentriamo soltanto sul vostro sorriso, ma anche ci prendiamo cura della vostra salute.</p>
                <p>Noi desideriamo che tutti i nostri pazienti lascino il nostro centro soddisfatti e ci ritornino sempre, perché noi crediamo che la raccomandazione sia la migliore pubblicità.</p>
                <p>Il nostro motto è: <strong> Vostra visione, nostra competenza!</strong></p>
            </div>
        </div>
    </div>
    <br>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-md-12 d-block mx-auto">
                <div class="embed-responsive embed-responsive-16by9">
                    <video class="embed-responsive-item" autoplay muted>
                        <source src="video_2.mp4">
                    </video>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <p><strong>VI PROMETTIAMO</strong></p>
                <p><em>Professionismo e compassione</em> - il nostro team dei dentisti fornisce la migliore cura dentistica. Il nostro impegno è la prevenzione dentale e crediamo che il migliore paziente sia un paziente informato. Diamo la priorità al trattamento più conveniente per voi. Se avete alcuni dubbi, vi aiuteremo di fare la scelta giusta.</p>
                <p><em>Atmosfera accogliente</em> - L’atmosfera piacevole nel nostro centro fa sì che i nostri pazienti si sentano rilassati. Siamo orgogliosi dell’ambiente pieno di ospitalità e calore e del rapporto pieno di fiducia che abbiamo stabilito. Abbiamo sempre tempo sufficiente per prestare attenzione al nostro paziente e con il buon lavoro meritiamo il suo rispetto e la fiducia.</p>
                <p><em>Rispetto</em> - Poiché sappiamo che il vostro tempo e prezioso, cerchiamo di darvi un servizio veloce. Facciamo del nostro meglio per fissare un appuntamento nell’orario comodo a voi.</p>
                <p><em>Igiene</em> - Il controllo dell’igiene è la base della sicurezza dei nostri pazienti. Pertanto, per proteggere voi, usiamo processi di sterilizzazione rigorosi.</p>
                <p><em>Sincerità</em> - Vi ringraziamo per la fiducia che ci avete accordato usando i nostri servizi.</p>
            </div>
        </div>
    </div>
    <br>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-12">
                <p>Per un preventivo chiaro e sicuro basta inviare l'ortopanoramica.</p>
                <p><span class="red">INVIA L'ORTOPANORAMICA UTILIZZANDO IL FORM IN QUESTA PAGINA E CHIEDI SUBITO UN PREVENTIVO</span> oppure invia una email al nostro responsabile per la tua regione.</p>
                <p>Il Turismo odontoiatrico garantisce la soluzione dei vostri problemi dentistici con un risparmio che arriva fino al 60% dei prezzi in ambito nazionale, il tutto senza rinunciare alla professionalità e alla sicurezza.</p>
                <p>I nostri lavori sono del tutto GARANTITI e CERTIFICATI e le prestazioni mediche possono essere detratte fiscalmente. La vostra salute ci è a cuore e per questo i nostri interventi sono seguiti in ottemperanza dei protocolli Europei.</p>
            </div>
            <div class="col-lg-7 col-md-12">
                <p><strong>10 motivi per sceglierci</strong></p>
                <div class="btn-group-vertical">
                    <button class="btn btn-default">Elevato risparmio rispetto ai costi Italiani</button>
                    <button class="btn btn-default">Per tutti i manufatti/protesi vengono rilasciati certificati di conformità alla normativa CEE</button>
                    <button class="btn btn-default">Professionalità identica alle cliniche italiane</button>
                    <button class="btn btn-default">Materiali utilizzati certificate</button>
                    <button class="btn btn-default">Garanzia dei trattamenti effettuati</button>
                    <button class="btn btn-default">Assistenza alla prenotazione volo</button>
                    <button class="btn btn-default">Possibilità di detrarre spese dentistiche dalla dichiarazione dei redditi in Italia</button>
                    <button class="btn btn-default">Opportunità di visitare Belgrado capitale storica della Serbia</button>
                    <button class="btn btn-default">Assistenza a 360 gradi</button>
                    <button class="btn btn-default">Pernotto e prima colazione gratuito</button>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <div class="container">
            <div class="row mt-5">
                <div class="col-lg-6 col-md-6 form-area">
                <?php echo $msg; ?>     
                <form role="form" method="post" action="index.php" enctype="multipart/form-data">
                    <br style="clear: both">
                    <h3 style="text-align: center;">Contattaci</h3>
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" name="contact_name" placeholder="Nome" required>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" id="email" name="contact_email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="mobile" name="contact_phone" placeholder="Telefono" required>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" type="textarea" id="message" name="contact_text" placeholder="Messaggio" maxlength="2000" rows="7" required></textarea>
                    </div>
                    <div class="form-group">
                        <input type="file" class="form-control-file" id="exampleInputFile" name="attachment" aria-describedby="fileHelp">
                    </div>
                        <button type="submit" name="submit" class="btn float-right submit">Invia</button>
                </form>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="text-center">
                            <img src="images/osmeh_3.jpg" class="img-fluid rounded" alt="">
                    </div>
                </div>
            </div>
        </div>
            <div class="container-fluid text-center">
                <div class="row">
                    <div class="col-lg-12 col-md-12 mt-5 mt-md-5 mt-lg-5">
                        <a href="http://www.dentarc.com" target="_blank"><img class="img-fluid" src="images/dent-arc_logo.png"></a>
                        <img class="img-fluid" src="images/zimmer_logo.png">
                        <img class="img-fluid" src="images/straumann_logo.png">
                        <img class="img-fluid" src="images/nobel-biocare_logo.png">
                        <img class="img-fluid" src="images/botiss_logo.png">
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <img class="img-fluid" src="images/3M_logo.png">
                        <img class="img-fluid" src="images/alpha-bio_logo.png">
                        <img class="img-fluid" src="images/b&b-dental_logo.png">
                        <img class="img-fluid" src="images/bredent_logo.png">
                        <img class="img-fluid" src="images/isomed_logo.png">
                        <img class="img-fluid" src="images/sweden&martina_logo.png">                
                    </div>
                </div>
            </div>
            <br>
            <br>
            <a id="back-to-top" href="#" class="btn btn-secondary btn-lg back-to-top" role="button" title="Ritorna all'inizio della pagina" data-toggle="tooltip" data-placement="left"><span class="fa fa-chevron-up"></span></a>
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <p class="text-sm-center text-xs-center">Dental Concept 23 © 2017</p>
                </div>
                <div class="col-lg-3">
                    <p class="text-sm-center text-xs-center"><i class="far fa-envelope"></i><a href="mailto: office@dentalconcept23.com"> office@dentalconcept23.com</a><br><i class="far fa-envelope"></i><a href="mailto: dentalconcept23@gmail.com"> dentalconcept23@gmail.com</a></p>
                </div>
                <div class="col-lg-2">
                    <p class="text-sm-center text-xs-center"><i class="fas fa-phone"></i><a href="tel: +381644679448"> +381/64-467-94-48</a></p>
                </div>
                <div class="col-lg-2">
                    <p class="text-sm-center text-xs-center"><i class="fab fa-blogger"></i><a href="#"> BLOG</a></p>
                </div>
                <div class="col-lg-2">
                    <div class="social-icons text-center">
                        <a href="https://www.facebook.com/den.con.73550" target="_blank" class="fab fa-facebook-f fa-2x fa-fw"></a>
                        <a href="https://www.instagram.com/dentalconcept23" target="_blank" class="fab fa-instagram fa-2x fa-fw"></a>
                    </div>
                </div>
            </div>     
        </div>
    </footer>

    <script>
        $(document).ready(function(){ 
            $(function() {
                $(".rslides").responsiveSlides({
                    auto: true, // Boolean: Animate automatically, true or false
                    speed: 500, // Integer: Speed of the transition, in milliseconds
                    timeout: 3000, // Integer: Time between slide transitions, in milliseconds
                });
            });
            $('video').on('ended', function () {
                this.load();
                this.play();
            });     
        });
    </script>
    <script>
        $(document).ready(function(){
            $(window).scroll(function() {
                if ($(this).scrollTop() > 50) {        
                    $('#back-to-top').fadeIn();    
                } else {
                    $('#back-to-top').fadeOut();   
                }
            });
            $('#back-to-top').click(function() {      
                $('body, html').animate({
                    scrollTop : 0                       
                }, 800);
            }); 
        });
    </script>
</body>
</html>