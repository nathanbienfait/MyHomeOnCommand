<?php

function visuLobbyMessagerieSupport()
{
	$utilisateur=new messagerieSupport;

	$tab=$utilisateur->recupNewQuestions()->fetchAll();

	return $tab;
}

function visuMessagerieSupport($idClient)
{
	$utilisateur=new messagerieSupport;

	$tabou=$utilisateur->getMessagesClient($idClient)->fetchAll();

	return $tabou;
}

function postReponseSupport($reponse, $idClient)
{
	$utilisateur=new messagerieSupport;

	$idQR = $utilisateur->recupIdQr($idClient)->fetch();
	
	$utilisateur->postReponse($reponse, $idQR[0]);
}


?>