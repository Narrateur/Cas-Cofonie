<html>
    
    <head>
        <title>Connexion</title>
        <meta charset="utf-8"/>
    <link rel="stylesheet" href="CasCofonieCSS.css"/>
    </head>

    <body>
        <div class="vueConnexion">

            <div class="connexion"><FORM action = 'index.php?vue=identification&action=connexion' method='post'>
                                <br>Connexion<br><br>
                                <input type='email' name='emailConnexion' placeholder='Login'><br>
                                <input type='password' name='mdpConnexion' placeholder='Password'><br>
                                <input type = 'submit' value = 'valider'>
            </FORM></div>

            <!--<a href='index.php?vue=identification&action=inscription'>Pas encore inscrit ?</-a>-->



            <div class="inscription">
            <BR><BR><BR>
            <FORM action='index.php?vue=identification&action=enregistrer' method='post'>
                Nom : <input type='text' name='nom' required><br>
                Prenom : <input type='text' name='prenom' required><br>
                
                
                
                Institution : <input type='text' name='insitution' required><br>
                Email : <input type='email' name='email' required><br>
                Mot de passe : <input type='password' name='mdp' required><br>
                Confirmer le mot de passe : <input type='password' name='mdp2' required><br><br>
                
                <input type = 'reset' value = 'Vider'> <input type = 'submit' value = 'Valider'>
            </FORM>
            </div>

        </div>
    </body>
</html>