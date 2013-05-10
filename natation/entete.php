<?php 
$page = $_SERVER['SCRIPT_NAME'];

?>
<div id="header">
    <div class="logo"></div>
        <ul class="menuH">       
        <a href="nageurs.php"><li id="<?php if(strpos($page, 'nageurs') !== false){ echo 'current';}?>">Nageurs</li></a>
        <a href="competitions.php"><li id="<?php if(strpos($page, 'competitions') !== false){ echo 'current';}?>">Comp&eacute;titions</li></a>
        <a href="index.php"><li id="<?php if(strpos($page, 'index') !== false){ echo 'current';}?>">Accueil</li></a>
    </ul>
</div>

