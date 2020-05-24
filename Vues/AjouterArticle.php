<html>
    <head>
        <title>Proposer une Loi</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="CasCofonieCSS.css"/>
    </head>
    <body>
        <div class='ajouterArticle'>
            <FORM action = 'index.php?vue=vueTexte&action=ajouterArticleTexte' method='post' > <?php echo $_SESSION['listeTexteAjoutArticle']."<input type='submit' value='Valider'>"; ?></FORM>


            <FORM action = 'index.php?vue=vueTexte&action=enregistrerArticleAjout' method='post' >
                <?php 
                    //if(){
                        echo $_SESSION['ArticlesDuTexte']."<br><br><input type='text' name='titre_article' value='".$_SESSION['libArticle']."' placeholder='Titre' required/>
                        <br><textarea name='texte_article' rows='5' cols='33' placeholder='Texte'></textarea>
                        <br><input type='submit' value='Valider'>";
                    //}
                ?>
            </FORM>
        </div>
    </body>
</html>