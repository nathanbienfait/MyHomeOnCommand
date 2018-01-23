<?php

function visuLobbyMessagerieSupport()
{
	$utilisateur=new messagerieSupport;		//On se prépare a utiliser des requêtes SQL de la classe messagerieSupport

	$tab=$utilisateur->recupNewQuestions()->fetchAll();		//On fetch toutes les questions avec pour réponse une réponse automatique

	return $tab;
}

function visuMessagerieSupport($idClient)
{
	$utilisateur=new messagerieSupport;

	$tabou=$utilisateur->getMessagesClient($idClient)->fetchAll();		//On fetch tous les messages d'un client en particulier grace a son id

	return $tabou;
}

function postReponseSupport($reponse, $idClient)
{
	$utilisateur=new messagerieSupport;

	$idQR = $utilisateur->recupIdQr($idClient)->fetch();		//On réupère l'id_qr de la question à laquelle on va répondre
	
	$utilisateur->postReponse($reponse, $idQR[0]);				//On répond à la question grâce à son id
}

?>
