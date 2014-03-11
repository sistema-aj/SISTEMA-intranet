<?php
	class Administration 
	{
	
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

		public static function checkCandidatParams(&$data) {
			if($data['nom'] != "" && $data['prenom'] != "" && $data['telephone'] != ""
				&& $data['mail'] != "" && $data['adresse'] != "" && $data['codePostal'] != ""
				&& $data['ville'] != "") 
			{
				$error = "";
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

				throw new Exception($error);

				return true;	
			} else {
				return false;
			}
		}
		
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
				$logins = self::genererLogin('client',array($raisonSociale));
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
			  echo "Failed: " . $e->getMessage();
			}
		}

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
			
		public static function genererLogin($userType, $data)
		{//TODO à tester ...
			
			switch($userType)
			{
				case 'candidat':
					try
					{
						$result = bdd::$_pdo->prepare('SELECT nom, prenom FROM adherent where id = :idUser');
						$result->bindParam(":idUser",$idUser,PDO::PARAM_INT);
						$result->execute();
						$result = $result->fetch();
						$login = strtolower($result->prenom.$result->nom);
						$mdp = genererMDP(10);
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
						$login = strtolower($data[0]);
						$login = str_replace(CHR(32),"",$login);
						$login = preg_replace("#[^a-zA-Z]#", "", $login);
						if(strlen($login) > 10)
						{
							$login =  substr($login,0,10);
						}
						$mdp = self::genererMDP(10);
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

		public static function hash_password( $p, $s='', $c=1000, $kl=32, $a = 'sha256' ) 
		{
		 
			$hl = strlen(hash($a, null, true)); # Hash length
			$kb = ceil($kl / $hl);              # Key blocks to compute
			$dk = '';                           # Derived key
		
			$autorises = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789!#@$%.:,';
			$nb_aut = strlen($autorises)-1;
			if($s=='')
			{
			  $s = '~';
			  for($i=0; $i < 7; $i++)
				  $s .= $autorises[mt_rand(0, $nb_aut)];
			}

			# Create key
			for ( $block = 1; $block <= $kb; $block ++ ) {
		 
				# Initial hash for this block
				$ib = $b = hash_hmac($a, $s . pack('N', $block), $p, true);
		 
				# Perform block iterations
				for ( $i = 1; $i < $c; $i ++ )
		 
					# XOR each iterate
					$ib ^= ($b = hash_hmac($a, $b, $p, true));
		 
				$dk .= $ib; # Append iterated block
			}
		 
			# Return derived key of correct length
			$password_hash = substr($dk, 0, $kl);
			$password_change = bin2hex($password_hash);
			return $password = $s.$password_change;
		}
		
		public static function validationCandidat($idCandidat, $mailCandidat) 
		{
			try
			{
				$logins = genererLogins('candidat',$idCandidat);
				$login = $logins['login'];
				$mdp = $logins['mdp'];
				$mdpCrypter = hash_password($mdp);

				bdd::$_pdo->beginTransaction();
				$result = bdd::$_pdo->prepare("INSERT INTO login (`login`, `mdp`, `type`, `user`) 
											VALUES(:login,:mdp,'E',:idCandidat)");
				$result->bindParam(":login",$login,PDO::PARAM_STR);
				$result->bindParam(":mdp",$mdpCrypter,PDO::PARAM_STR);
				$result->bindParam("idCandidat",$idCandidat,PDO::PARAM_INT);
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

		public static function affecterAuProjet($idAdherent) 
		{

		}

		public static function nommerChefProjet($idAdherent) 
		{

		}
	}
?>