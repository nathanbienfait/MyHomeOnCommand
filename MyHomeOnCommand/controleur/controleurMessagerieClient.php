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

function eviteAttenteSupportDoublon()
{
	$idClient=$_SESSION['id'];
	$utilisateur=new messagerieClient;

	$tab = $utilisateur->verifAttenteSupportDoublon($idClient)->fetchAll();

		foreach($tab as $item):
			$utilisateur->supprAttenteSupportDoublon($item['id_qr']);
			$lastId=$item['id_qr'];
		endforeach;

	$utilisateur->reecrireDerniereReponse();
	
}

?>
