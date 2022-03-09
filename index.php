<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontaktdaten</title>

    <link rel="stylesheet" href="design.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;500&family=Montserrat:wght@100&display=swap" rel="stylesheet">
</head>

<body>
    <div class="menubar">
        <h1>My Contact Book</h1>
        <div class="myname">
            <div class="avatar">PB</div> Philipp Basler
        </div>
    </div>
    <div class="flex">
        <div class="menue">
            <a href="index.php?page=start"><img src="img/home.svg"> Start</a>
            <a href="index.php?page=contact"><img src="img/book.svg"> Kontakte</a>
            <a href="index.php?page=addcontact"><img src="img/add.svg"> Kontakte hinzufügen</a>
            <a href="index.php?page=impressum"><img src="img/legal.svg"> Impressum</a>
        </div>
        <div class="content">
            <?php
            $headline = 'Herrzlich Willkommen';
            $contacts = [];

            if (file_exists('contacts.txt')) {

                $text = file_get_contents('contacts.txt', true);
                $contacts = json_decode($text, true); /* from text to array */
            }

            if (isset($_POST['name']) && isset($_POST['phone'])) {

                $newContact = [
                    'name' => $_POST['name'],
                    'phone' => $_POST['phone'],
                ];
                array_push($contacts, $newContact);
                file_put_contents('contacts.txt', json_encode($contacts, JSON_PRETTY_PRINT)); /* from array into text */
                echo 'Kontakt <b>' . $_POST['name'] . '</b> wurde hinzugefügt';
            }
            if ($_GET['page'] == 'delete') {
                $headline = 'Kontakt gelöscht';
            }
            if ($_GET['page'] == 'contact') {
                $headline = 'Deine Kontakte';
            } elseif ($_GET['page'] == 'addcontact') {
                $headline = 'Kontakt Hinzufügen';
            } elseif ($_GET['page'] == 'impressum') {
                $headline = 'Impressum';
            } elseif ($_GET['page'] == 'question') {
                $headline = 'Fragen';
            } else {
                $headline = 'Herzlich Wilkommen';
            }

            echo '<h1>' . $headline . '</h1>';
            // Eintrag löschen
            if ($_GET['page'] == 'delete') {
                echo  'Dein <b>Kontakt</b> wurde gelöscht';

                $key = $_GET['delete']; //Index holen
                unset($contacts[$key]); // Eintrag löschen
                file_put_contents('contacts.txt',json_encode($contacts,  JSON_PRETTY_PRINT));
            }
            elseif ($_GET['page'] == 'contact') {
                echo "Hier hast du einen Überblick über deine Kontakte ";

                foreach ($contacts as $key => $row) {
                    $name = $row['name'];
                    $phone = $row['phone'];
                    echo "<div class= 'card'>
                       <img class='profile-picture' src = 'img/profile-picture.png'>
                        <b>$name</b><br>
                        $phone
                    
                        <a class= 'phone-button' href= 'tel: $phone'>Anrufen</a>
                        <a class= 'delete-button' href='?page=delete&delete=$key'>Löschen</a>";
                        
               /*
               <a class= 'delete-button' href='?page=delete&delete=$key'><img class='dustbin' src='img/dustbin_bw.svg'></a>";
                   */ 
                  echo"
                    </div>
                    ";
                }
            } elseif ($_GET['page'] == 'impressum') {
                echo 'Hier steht das Impressum';
            } elseif ($_GET['page'] == 'question') {
                echo 'Hier können Sie Fragen stehlen !';
            } elseif ($_GET['page'] == 'addcontact') {
                echo "
                <div>
                Hier kannst du weitere Kontakte hinzufügen
                </div>

                <form action = '?page=contact' method = 'POST'>
                <div>
                <input placeholder = 'Namen eingeben' name = 'name'> 
                </div>
                <div>
                <input placeholder = 'Telefonnummer eingeben' name = 'phone'>
                </div>

                <button type = 'submit'> Absenden </button>
                </form>
                ";
            } else {
                echo 'Du bist auf der Startseite !';
            }
            ?>
        </div>
    </div>
    <div class="footer">
        (C) 2022 Developer Basler
    </div>

</body>

</html>