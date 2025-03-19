<?php
//FICHIER D'EXECUTION

include './utils/utils.php';
include './interface/interfaceModel.php';
include './abstract/abstractController.php';
include './view/header.php';
include './view/footer.php';
include './view/viewPlayer.php';
include './controller/playerController.php';
include './model/playerModel.php';

$playerPage = new PlayerController(new ViewPlayer(), new ViewHeader(), new ViewFooter(), new ModelPlayer());
$playerPage->render();