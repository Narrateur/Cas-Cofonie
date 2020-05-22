<html>
    
    

    <body>
        <div class="vueConnexion">

            <div class="page connexion">
                <FORM action = 'index.php?vue=vueConnexion&action=identification' method='post'>
                    <br>Connexion<br><br>

                    <input type='text' name='loginConnexion' placeholder='Login' required><br>
                    <input type='password' name='mdpConnexion' placeholder='Password' required><br><br>

                    <input type = 'submit' value = 'valider'>
                </FORM>
            </div>

            <!--<a href='index.php?vue=identification&action=inscription'>Pas encore inscrit ?</-a>-->



            <div class="page inscription">
                <FORM action='index.php?vue=vueConnexion&action=enregistrer' method='post'>
                    <br>Inscription<br><br>

                    Nom : <input type='text' name='nom' required><br>
                    Prenom : <input type='text' name='prenom' required><br>
                    Institution : <?php $_SESSION['listeInstitution']; ?>
                    Identifiant : <input type='text' name='login' required><br>
                    Mot de passe : <input type='password' name='mdp' required><br>
                    Confirmer le mot de passe : <input type='password' name='mdp2' required><br><br>
                    
                    <input type = 'reset' value = 'Vider'> <input type = 'submit' value = 'Valider'>
                </FORM>
            </div>

        </div>
    </body>
</html>