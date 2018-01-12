<?php

function visuMessagerieClient()
{

$idClient=$_SESSION['id'];
$utilisateur=new messagerieClient;

$tab=$utilisateur->getMessages($idClient)->fetchAll();
//$nbrLignes=$utilisateur->getNombreQR($idClient);

return $tab;
}

function postQuestionClient($question)
{
	$idClient=$_SESSION['id'];
	$utilisateur=new messagerieClient;

	$utilisateur->postQuestion($question);
	$utilisateur->insertIdRelation($idClient);
}

?>