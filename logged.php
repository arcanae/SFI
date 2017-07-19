<?php
    echo "Welcome ".$_SESSION['user']['username'].".</br>";
    echo "<a href='ownprofil.php'>Mon profil</a></br>";
    echo "<a href='createpost.php'>Ajouter une annonce</a>";
    echo "<form action=\"logout.php\" method=\"POST\">";
    echo "<input id=\"logout\" type=\"submit\" name=\"logout\" value=\"Log Out\">";
    echo "</form>";
?>