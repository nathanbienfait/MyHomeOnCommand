<?php

function visuMessagerieClient()
{

$idClient=$_SESSION['id'];									//On crée la variable $idClient contenant l'id du client actuel
$utilisateur=new messagerieClient;							//On se prépare a utiliser des requêtes SQL de la classe messagerieClient 
															
$tab=$utilisateur->getMessages($idClient)->fetchAll();		//On fetch toutes les données procurées par la requête SQL getMessages

return $tab;												//On retourne ces valeurs dans le controleurRoute
}

function postQuestionClient($question)
{
	$idClient=$_SESSION['id'];
	$utilisateur=new messagerieClient;

	$utilisateur->postQuestion($question);					//On appelle la requête postQuestion avec comme objet $question fournie par le controleurRoute
	$utilisateur->insertIdRelation($idClient);				//On appelle la requête insertIdRelation
}

function eviteAttenteSupportDoublon()						//Fonction qui sert à éviter que le message "un opérateur va répondre" apparaisse plusieurs fois
{
	$idClient=$_SESSION['id'];
	$utilisateur=new messagerieClient;

	$tab = $utilisateur->verifAttenteSupportDoublon($idClient)->fetchAll(); 	//On récupère tous les id_qr des questions avec une réponse automatique

		foreach($tab as $item):
			$utilisateur->supprAttenteSupportDoublon($item['id_qr']);			//On supprime toutes les réponses automatiques
		endforeach;

	$utilisateur->reecrireDerniereReponse();				//On ré-écrit la réponse automatique pour la dernière question posée
												/* Il y a forcément un moyen plus efficace pour ne supprimer toutes les réponses automatiques sauf la dernière.
												Toutefois ce moyen n'a pas été trouvé et la méthode actuel fonctionne très bien */
}

?>
