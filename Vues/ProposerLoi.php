<html>
  <head>
      <title>Proposer une Loi</title>
      <meta charset="utf-8"/>
      <link rel="stylesheet" href="CasCofonieCSS.css"/>
  </head>
    <body>
        <div class='proposerLoi'>
            <FORM action = 'index.php?vue=vueTexte&action=ajouterArticle' method='post' ><input type = 'submit' value = 'Ajouter un Article'></FORM>
            <FORM action = 'index.php?vue=vueTexte&action=retirerArticle' method='post' ><input type = 'submit' value = 'Retirer un Article'></FORM>

            <FORM action = 'index.php?vue=vueTexte&action=enregistrerLoi' method='post' >
                
                <?php echo "<input type='text' name='lib_text' placeholder='Intitulé du Texte' value='".$_SESSION['titre_texte']."' required><br><br>" ?>

                <?php                
                    if(!empty($_SESSION['nbArticle'])){
                        for($i=1;$i<=$_SESSION['nbArticle'];$i++){
                            echo "<input type='text' name='titre_article".$i."' placeholder='Intitulé de l article' required><br>";
                            echo "<textarea id='texte_article".$i."' name='texte_article".$i."' rows='5' cols='33' placeholder='texte de l article'></textarea><br><br>";
                        }
                    }
                ?>
                <input type = 'submit' value = 'Enregistrer la Loi'>
            </FORM>
            
        </div>
    </body>
</html>