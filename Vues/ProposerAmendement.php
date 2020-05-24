<html>
    <head>
        <title>Proposer une Loi</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="CasCofonieCSS.css"/>
    </head>
    <body>
        <div class='proposerAmendement'>
            <FORM action = 'index.php?vue=vueTexte&action=choisirArticle' method='post' > <?php echo $_SESSION['listeDeroulanteTexte']."<input type='submit' value='Valider'>"; ?></FROM>

            <FORM action = 'index.php?vue=vueTexte&action=proposerAmendement' method='post' ><?php echo $_SESSION['listeDeroulanteArticle']."<input type='submit' value='Valider Article'>"; ?></FORM>

            <FORM action = 'index.php?vue=vueTexte&action=enregistrerAmendement' method='post' >
                <?php 
                    if($_SESSION['choixTexteArticle'] == 1){
                        echo "<br><br><input type='text' name='lib_amendement' placeholder='Intitulé de l amendement' required><br>
                        <textarea id='texte_amendement' name='texte_amendement' rows='5' cols='33' placeholder='texte de l amendement'></textarea>
                        <br><input type='submit' value='Enregistrer Amendement'>";
                    }else{
                        echo'non';
                        echo $_SESSION['choixTexteArticle'];
                    }
                ?>
            </FORM>
        </div>
    </body>
</html