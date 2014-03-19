<?php

	/**
	 * @author  Marnier Vivien
	 * @package Models
	 * @version 2.0.0
	 */
	class Administration 
	{
	
		/**
		 * Insere un candidat dans la base 
		 * @author   Marnier Vivien
		 * @param    String $nom 
		 * @param    String $prenom 
		 * @param    String $mail 
		 * @param    String $telephone 
		 * @param    String $adresse 
		 * @param    String $codePostal 
		 * @param    String $ville 
		 * @param    String $promo 
		 * @version  1.2.0
		 */
		public static function creerCandidat($nom,$prenom,$mail,$telephone,$adresse,$codePostal,$ville,$promo) 
		{
			try
			{
				bdd::init();
				bdd::$_pdo->beginTransaction();
				$result = bdd::$_pdo->prepare('INSERT INTO utilisateur (`telephone`, `mail`, `adresse`, `codePostal`, `ville`, `actif`) 
											VALUES(:telephone,:mail,:adresse,:codePostal,:ville,0)');
				$result->bindParam(":telephone",$telephone,PDO::PARAM_STR);
				$result->bindParam(":mail",$mail,PDO::PARAM_STR);
				$result->bindParam(":adresse",$adresse,PDO::PARAM_STR);
				$result->bindParam(":codePostal",$codePostal,PDO::PARAM_STR);
				$result->bindParam(":ville",$ville,PDO::PARAM_STR);
				$result->execute();
				$result->closeCursor();

				$lastIdInserted = bdd::$_pdo->query('SELECT MAX(id) as max FROM utilisateur');
				$lastIdInserted->setFetchMode(PDO::FETCH_OBJ);
				$lastIdInserted = $lastIdInserted->fetch();
				$lastIdInserted = $lastIdInserted->max;
				
				$result = bdd::$_pdo->prepare('INSERT INTO adherent (`id`, `nom`, `prenom`,`promo`)
											VALUES(:id,:nom,:prenom,:promo)');
				$result->bindParam(":id",$lastIdInserted,PDO::PARAM_INT);
				$result->bindParam(":nom",$nom,PDO::PARAM_STR);
				$result->bindParam(":prenom",$prenom,PDO::PARAM_STR);
				$result->bindParam(":promo",$promo,PDO::PARAM_STR);
				$result->execute();
				$result->closeCursor();
				bdd::$_pdo->commit();
			}
			catch (Exception $e) 
			{
			  bdd::$_pdo->rollBack();
			  throw new Exception($e->getCode());
			}
		}

		/**
		 * Verifie l'existence de toutes les variables pour la creation d'un candidat
		 * @author Deleuil Maxime 
		 * @param  Array $data Liste des variables 
		 * @return boolean 
		 * @version 1.0.0
		 */
		public static function issetCandidatParams($data) {
			if(isset($data['nom']) && isset($data['prenom']) && isset($data['telephone'])
				&& isset($data['mail']) && isset($data['adresse']) && isset($data['codePostal'])
				&& isset($data['ville']) && isset($data['promo']))
			{
				return true;
			} else {
				return false;
			}
		}

		/**
		 * Verifie l'integrité des variables pour la creation d'un candidat, et la formate 
		 * @author Deleuil Maxime
		 * @param  Array $data Liste des variables  
		 * @return boolean
		 * @version 1.2.0
		 */
		public static function checkCandidatParams(&$data) {
			if($data['nom'] != "" && $data['prenom'] != "" && $data['telephone'] != ""
				&& $data['mail'] != "" && $data['adresse'] != "" && $data['codePostal'] != ""
				&& $data['ville'] != "") 
			{
				/*$error = "";
				// Vérification pour le nom et formattage de la variable.
				if (preg_match("/^[a-zA-Z][a-zA-Z\-]+[a-zA-Z]$/", $data['nom']))
					$data['nom'] = ucfirst(strtolower($data['nom']));
				else {
					$error += "Le nom doit être une chaine de caractères.<br/>"
				}
				// Vérification pour le nom et formattage de la variable.
				if (preg_match("/^[a-zA-Z][a-zA-Z\-]+[a-zA-Z]$/", $data['prenom']))
					$data['prenom'] = ucfirst(strtolower($data['prenom']));
				else {
					$error += "Le prenom doit être une chaine de caractères.<br/>"
				}

				throw new Exception($error);*/
				return true;	
			} else {
				return false;
			}
		}
		

		/**
		 * Crée un Client en base de données
		 * 
		 * @author Vivien Marnier
		 * @param  String $raisonSociale 
		 * @param  String $telephone 
		 * @param  String $mail 
		 * @param  String $adresse 
		 * @param  String $codePostal 
		 * @param  String $ville 
		 * @throws Exception erreur
		 * @version 1.0.0 
		 */
		public static function creerClient($raisonSociale,$telephone,$mail,$adresse,$codePostal,$ville)
		{
			try
			{
				//première partie : insertion brute dans la BD des informations du client
				bdd::init();
				bdd::$_pdo->beginTransaction();
				$result = bdd::$_pdo->prepare('INSERT INTO utilisateur (`telephone`, `mail`, `adresse`, `codePostal`, `ville`, `actif`) 
											VALUES(:telephone,:mail,:adresse,:codePostal,:ville,1)');
				$result->bindParam(":telephone",$telephone,PDO::PARAM_STR);
				$result->bindParam(":mail",$mail,PDO::PARAM_STR);
				$result->bindParam(":adresse",$adresse,PDO::PARAM_STR);
				$result->bindParam(":codePostal",$codePostal,PDO::PARAM_STR);
				$result->bindParam(":ville",$ville,PDO::PARAM_STR);
				$result->execute();
				$result->closeCursor();

				$lastIdInserted = bdd::$_pdo->query('SELECT MAX(id) as max FROM utilisateur');
				$lastIdInserted->setFetchMode(PDO::FETCH_OBJ);
				$lastIdInserted = $lastIdInserted->fetch();
				$lastIdInserted = $lastIdInserted->max;

				$result = bdd::$_pdo->prepare('INSERT INTO client (`id`, `raisonSociale`)
											VALUES (:id, :raisonSociale)');
				$result->bindParam(":id",$lastIdInserted,PDO::PARAM_INT);
				$result->bindParam(":raisonSociale",$raisonSociale,PDO::PARAM_STR);
				$result->execute();
				$result->closeCursor();
				
				//deuxième partie : création/génération des logins utilisateur pour le profil client associé
				$logins = self::genererLogin('client',$lastIdInserted);
				$login = $logins['login'];
				$mdp = $logins['mdp'];
				$mdpCrypter = self::hash_password($mdp);

				$insertLogin = bdd::$_pdo->prepare("INSERT INTO login (`login`, `mdp`, `type`, `user`)
											VALUES(:login,:mdp,'C',:idClient)");
				$insertLogin->bindParam(":login",$login,PDO::PARAM_STR);
				$insertLogin->bindParam(":mdp",$mdpCrypter,PDO::PARAM_STR);
				$insertLogin->bindParam(":idClient",$lastIdInserted,PDO::PARAM_INT);
				$insertLogin->execute();
				bdd::$_pdo->commit();

				// Préparation du mail contenant les logins
					$sujet = "Vos identifiants SISTEMA" ;
					$entete = "From: sistema@noreply.com" ;
				// coeur du message du mail
					$message = 'Bienvenue chez SISTEMA,

					Nous vous informons que votre profil a bien été crée par la direction de SISTEMA. 
					Voici vos identifiants de connexion afin de vous connecter à votre espace 
					sur le site "mettre le futur lien du site".
					
					Login : '.$login.'
					Mot de passe : '.$mdp.'

       
					---------------
					Ceci est un mail automatique, Merci de ne pas y répondre.';
        
				//mail($mailClient, $sujet, $message, $entete); //envoi le mail (serveur SMTP !)
			}
			catch (Exception $e) 
			{
			  bdd::$_pdo->rollBack();
			  throw new Exception("Une erreur est survenue, veuillez réesayer");
			}
		}


		/**
		 * Verifie l'existence et l'integrité des variables pour la creation d'un candidat, et la formate 
		 * @author Deleuil Maxime
		 * @param  Array $data Liste des variables  
		 * @return boolean
		 * @version 1.1.0
		 */
		public static function checkClientParams($data) {
			if(isset($_REQUEST['raisonSociale']) && isset($_REQUEST['telephone']) && isset($_REQUEST['mail'])
				&& isset($_REQUEST['adresse']) && isset($_REQUEST['codePostal']) && isset($_REQUEST['ville']))
			{
				if($_REQUEST['raisonSociale'] != "" && $_REQUEST['telephone'] != "" && $_REQUEST['mail'] != ""
					&& $_REQUEST['adresse'] != "" && $_REQUEST['codePostal'] != "" && $_REQUEST['ville'] != "") 
				{
					return true;	
				} else {
					return false;
				}
			}
		}

		/**
		 * récupère un candidat depuis la base de données 
		 * @author Vivien Marnier 
		 * @return Array Tableau contenant l'ensemble des propriétés du candidat 
		 * @version 1.0.0
		 */
		public static function getCandidats() 
		{
			try
			{
				$result = bdd::$_pdo->query("SELECT utilisateur.id, nom, prenom, promo, telephone, mail 
								FROM utilisateur JOIN adherent ON utilisateur.id = adherent.id 
								WHERE actif = 0");
				$result->setFetchMode(PDO::FETCH_OBJ);
				$result = $result->fetchAll();
				return $result;
			}
			catch(Exception $e)
			{
				echo "Failed: " . $e->getMessage();
			}
		}
			
		/**
		 * Crée un login, selon le type de l'utilisateur.
		 * 
		 * @author Marnier Vivien
		 * @param  String  $userType
		 * @param  Integer $idUser 
		 * @return String
		 * @version 1.2.0
		 */
		public static function genererLogin($userType, $idUser)
		{//TODO à tester ...
			switch($userType)
			{
				case 'candidat':
					try
					{
						$result = bdd::$_pdo->prepare('SELECT nom, prenom FROM adherent where id = :idUser');
						$result->bindParam("idUser",$idUser,PDO::PARAM_INT);
						$result->execute();
						$result->setFetchMode(PDO::FETCH_OBJ);
						$result = $result->fetch();
						$login = strtolower($result->prenom.$result->nom);
						$mdp = self::genererMDP();
						$logins = ["login" => $login, "mdp" => $mdp];
					}
					catch(Exception $e)
					{
						echo "Failed: " . $e->getMessage();
					}
					break;
				case 'client':
					try
					{
						$result = bdd::$_pdo->prepare('SELECT raisonSociale FROM client where id = :idUser');
						$result->bindParam("idUser",$idUser,PDO::PARAM_INT);
						$result->execute();
						$result->setFetchMode(PDO::FETCH_OBJ);
						$result = $result->fetch();
						$login = strtolower($result->raisonSociale);
						$login = str_replace(CHR(32),"",$login);
						$login = preg_replace("#[^a-zA-Z]#", "", $login);
						if(strlen($login) > 10)
						{
							$login = substr($login,0,10);
						}
						$mdp = self::genererMDP();
						$logins = ["login" => $login, "mdp" => $mdp];
					}
					catch(Exception $e)
					{
						echo "Failed: " . $e->getMessage();
					}
					break;
			}
			return $logins;
		}
		
		public static function genererMDP ($longueur = 10)
		{
			// initialiser la variable $mdp
			$mdp = "";
		 
			// Définir tout les caractères possibles dans le mot de passe,
			// Il est possible de rajouter des voyelles ou bien des caractères spéciaux
			$possible = "123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@";
		 
			// obtenir le nombre de caractères dans la chaîne précédente
			// cette valeur sera utilisé plus tard
			$longueurMax = strlen($possible);
		 
			if ($longueur > $longueurMax) 
			{
				$longueur = $longueurMax;
			}
		 
			// initialiser le compteur
			$i = 0;
		 
			// ajouter un caractère aléatoire à $mdp jusqu'à ce que $longueur soit atteint
			while ($i < $longueur) 
			{
				// prendre un caractère aléatoire
				$caractere = substr($possible, mt_rand(0, $longueurMax-1), 1);
		 
				// vérifier si le caractère est déjà utilisé dans $mdp
				if (!strstr($mdp, $caractere)) 
				{
					// Si non, ajouter le caractère à $mdp et augmenter le compteur
					$mdp .= $caractere;
					$i++;
				}
			}
	 
			// retourner le résultat final
			return $mdp;
		}

		/**
		 * Description
		 * 
		 * @author
		 * @param   type $p 
		 * @param   type $s 
		 * @param   type $c 
		 * @param   type $kl 
		 * @param   type $a 
		 * @return  type
		 * @version 2.0.0
		 */
		public static function hash_password( $p, $s='', $c=1000, $kl=32, $a = 'sha256' ) 
		{
		 
			$hl = strlen(hash($a, null, true)); # taille du Hash
			$kb = ceil($kl / $hl);              # blocks
			$dk = '';                           # clé dérivée
		
			$autorises = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789!#@$%.:,';
			$nb_aut = strlen($autorises)-1;
			if($s=='')
			{
			  $s = '~';
			  for($i=0; $i < 7; $i++)
				  $s .= $autorises[mt_rand(0, $nb_aut)];
			}

			# Creation de la clé
			for ( $block = 1; $block <= $kb; $block ++ ) {
		 
				# hash de base pour le block
				$ib = $b = hash_hmac($a, $s . pack('N', $block), $p, true);
		 
				# parcours des blocks
				for ( $i = 1; $i < $c; $i ++ )
		 
					# Ou Exlusif sur chaque block
					$ib ^= ($b = hash_hmac($a, $b, $p, true));
		 
				$dk .= $ib; # Ajout de chaque block
			}
		 
			# retourne la clé derivée de la bonne taille 
			$password_hash = substr($dk, 0, $kl);
			$password_change = bin2hex($password_hash);
			return $password = $s.$password_change;
		}
			
		/**
		 * Valide l'inscription d'un candidat, en lui attribuant un login et un mot de passe 
		 * @author Marnier Vivien 
		 * @param   String $idCandidat 
		 * @param   String $mailCandidat 
		 * @version 1.0.0
		 */
		public static function validationCandidat($idCandidat, $mailCandidat) 
		{
			try
			{
				$logins = self::genererLogin('candidat',$idCandidat);
				$login = $logins['login'];
				$mdp = $logins['mdp'];
				$mdpCrypter = self::hash_password($mdp);

				bdd::$_pdo->beginTransaction();	
				// création des loginsç
				$result = bdd::$_pdo->prepare("INSERT INTO login (`login`, `mdp`, `type`, `user`) 
											VALUES(:login,:mdp,'E',:idCandidat)");
				$result->bindParam(":login",$login,PDO::PARAM_STR);
				$result->bindParam(":mdp",$mdpCrypter,PDO::PARAM_STR);
				$result->bindParam("idCandidat",$idCandidat,PDO::PARAM_INT);
				$result->execute();
				// activation de l'utilisateur
				$result = bdd::$_pdo->prepare("UPDATE utilisateur SET actif = 1
											WHERE id = :id");
				$result->bindParam(":id",$idCandidat,PDO::PARAM_INT);
				$result->execute();
				bdd::$_pdo->commit();
				
				// Préparation du mail contenant les logins
					$sujet = "Vos identifiants SISTEMA" ;
					$entete = "From: sistema@noreply.com" ;
        
				// coeur du message du mail
					$message = 'Bienvenue chez SISTEMA,

					Nous vous informons que votre candidature a été validé par la direction de SISTEMA. 
					Voici vos identifiants de connexion afin de vous connecter à votre espace 
					sur le site "mettre le futur lien du site".
					
					Login : '.$login.'
					Mot de passe : '.$mdp.'

       
					---------------
					Ceci est un mail automatique, Merci de ne pas y répondre.';
        
				//mail($mailCandidat, $sujet, $message, $entete); //envoi le mail 
			}
			catch(Exception $e)
			{
				bdd::$_pdo->rollBack();
				echo "Failed: " . $e->getMessage();
			}	
		}

		/**
		 * Refuse l'adhesion d'un candidat, et le supprime de la base
		 * @author  Marnier Vivien
		 * @param   Integer $id 
		 * @param   String $mail
		 * @version 1.2.0 
		 */
		public static function refusCandidat($id, $mail)
		{
			try
			{
				bdd::$_pdo->beginTransaction();	
				// suppression du candidat
				$result = bdd::$_pdo->prepare("DELETE FROM adherent
											WHERE id = :id");
				$result->bindParam(":id",$id,PDO::PARAM_INT);
				$result->execute();
				// supression de l'utilisateur
				$result = bdd::$_pdo->prepare("DELETE FROM utilisateur
											WHERE id = :id");
				$result->bindParam(":id",$id,PDO::PARAM_INT);
				$result->execute();
				bdd::$_pdo->commit();
				
				// Préparation du mail contenant les logins
					$sujet = "Candidature SISTEMA" ;
					$entete = "From: sistema@noreply.com" ;
        
				// coeur du message du mail
					$message = 'Bonjour,

					Nous vous informons que votre candidature a été refusée par la direction de SISTEMA.
					Cependant, ceci ne remet pas en cause la qualité de votre profil, et vous souhaitons une bonne continuation.

					Cordialement,
					La direction de SISTEMA.

					---------------
					Ceci est un mail automatique, Merci de ne pas y répondre.';
        
				//mail($mailCandidat, $sujet, $message, $entete); //envoi le mail 
			}
			catch(Exception $e)
			{
				bdd::$_pdo->rollBack();
				echo "Failed: " . $e->getMessage();
			}
		}

		/**
		 * Accepte la candidature d'un adherent à un projet
		 * @author  Deleuil Maxime
		 * @param   Integer $idAdh  identifiant de l'adhrent
		 * @param   Integer $idPro  identifiant du projet
		 * @version 1.0.0
		 */
		public static function accepterCandidatureProjet($idAdh, $idPro)
		{
			try {
				bdd::$_pdo->beginTransaction();
				$result = bdd::$_pdo->prepare("UPDATE participer SET status = 'O' 
											WHERE user = :user AND projet = :projet");
				$result->bindParam(':user',$idAdh,PDO::PARAM_INT);
				$result->bindParam(':projet',$idPro,PDO::PARAM_INT);
				$result->execute();
				bdd::$_pdo->commit();
			} catch (Exception $e) {
				bdd::$_pdo->rollBack();
				throw new Exception("Erreur lors de l'acceptation du candidat sur le projet.");
			}
		}


		/**
		 * Refuse la candidature d'un adherent à un projet
		 * @author  Deleuil Maxime
		 * @param   Integer $idAdh Identifiant de l'adherent  
		 * @param   Integer $idPro Identifiant du projet
		 * @version 1.0.0
		 */
		public static function refuserCandidatureProjet($idAdh, $idPro)
		{
			try {
				bdd::$_pdo->beginTransaction();
				$result = bdd::$_pdo->prepare("UPDATE participer SET status = 'R' 
											WHERE user = :user AND projet = :projet");
				$result->bindParam(':user',$idAdh,PDO::PARAM_INT);
				$result->bindParam(':projet',$idPro,PDO::PARAM_INT);
				$result->execute();
				bdd::$_pdo->commit();
			} catch (Exception $e) {
				bdd::$_pdo->rollBack();
				throw new Exception("Erreur lors du refus du candidat sur le projet.");
			}	
		}

		/**
		 * affecte un adherent à un projet 
		 * @author  Deleuil Maxime 
		 * @param   Integer $idAdh Identifiant de l'adherent 
		 * @param   Integer $idPro Identifiant du projet
		 * @version 1.1.0
		 */
		public static function affecterAuProjet($idAdh, $idPro) 
		{
			try {
				bdd::$_pdo->beginTransaction();
				$insert = bdd::$_pdo->prepare("INSERT INTO participer
												VALUES (:user, :projet, 0, 'O')");
				$insert->bindParam(":user",$idAdh,PDO::PARAM_INT);
				$insert->bindParam(":projet",$idPro,PDO::PARAM_INT);
				$insert->execute();
				bdd::$_pdo->commit();
			} catch (Exception $e) {
				bdd::$_pdo->rollBack();
				throw new Exception($e->getMessage());
			}
		}

		/**
		 * Enleve un adherent de la liste des participants au projet
		 * @author  Guemas Anthony
		 * @param   Integer $idAdh Identifiant de l'adherent
		 * @param   Integer $idPro Identifiant du projet
		 * @version 1.0.0
		 */
		public static function detacherDuProjet($idAdh, $idPro)
		{
			try {
				bdd::$_pdo->beginTransaction();
				$insert = bdd::$_pdo->prepare("DELETE FROM participer
													  WHERE user = :user 
													  AND   projet = :projet");

				$insert->bindParam(":user",$idAdh,PDO::PARAM_INT);
				$insert->bindParam(":projet",$idPro,PDO::PARAM_INT);
				$insert->execute();
				bdd::$_pdo->commit();
			} catch (Exception $e) {
				bdd::$_pdo->rollBack();
				throw new Exception($e->getMessage());
			}
		}

		/**
		 * Insere un adherent en tant que chef de projet 
		 * @author  Guemas Anthony
		 * @param   Integer $idAdh Identifiant de l'adherent
		 * @param   Integer $idPro Identifiant du projet
		 * @version 1.0.0
		 */
		public static function nommerChefProjet($idAdh, $idPro) 
		{
			try {
				bdd::$_pdo->beginTransaction();
				$insert = bdd::$_pdo->prepare("INSERT INTO participer
													  VALUES (:user, :projet, 1, 'O')");
				$insert->bindParam(":user",$idAdh,PDO::PARAM_INT);
				$insert->bindParam(":projet",$idPro,PDO::PARAM_INT);
				$insert->execute();
				bdd::$_pdo->commit();
			} catch (Exception $e) {
				bdd::$_pdo->rollBack();
				throw new Exception($e->getMessage());
			}
		}
	}
?>