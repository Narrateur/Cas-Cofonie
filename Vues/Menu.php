<div class="menu">
  <ul id="menu_bar">
<html>
  <head>
      <title>Menu</title>
      <meta charset="utf-8"/>
      <link rel="stylesheet" href="CasCofonieCSS.css"/>
  </head>
  <body>
    <nav>
      <ul>
        
        <?php
          if(empty($_SESSION['IdentifiantUtilisateur'])){
            echo "<li><a href='index.php?vue=vueConnexion&action=connexion'>Connexion / Inscription</a></li>";
          }else{
            echo "<p style='color:white'>".$_SESSION['InfoUser']."</p>";
          }

        ?>
        <li><a href='index.php?vue=vueTexte&action=visualiser'>Consulter les Textes de Loi</a></li>
        <li><a href="index.php?vue=vueTexte&action=vueVoter">Voter un Article</a></li>
        <li><a href="index.php?vue=vueTexte&action=proposerLoi">Proposer une Loi</a></li>
        <li><a href="index.php?vue=vueTexte&action=proposerAmendement">Proposer un Amendement</a></li>
        <?php
          if (!empty($_SESSION['IdentifiantUtilisateur'])){
            echo "<li><a href='index.php?vue=vueConnexion&action=deconnecter'>Déconnexion</a></li>";
          }
        ?>
      </ul>
    </nav>
</html>
