<?php
	class Administration 
	{
	
		public static function creerCandidat($nom,$prenom,$mail,$telephone,$adresse,$codePostal,$Ville,$promo) 
		{
			try
			{
				bdd::init();
				self::$_pdo->beginTransaction();
				$result = self::$_pdo->prepare('INSERT INTO utilisateur (`telephone`, `mail`, `adresse`, `codePostal`, `ville`, `actif`) VALUES(:telephone,:mail,:adresse,:codePostal,:ville,:actif)');
				$result->bindParam(":telephone",$telephone,PDO::Param_STR,":mail",$mail,PDO::Param_STR,":adresse",$adresse,PDO::Param_STR,
				":codePostal",$codePostal,PDO::Param_STR,":ville",$Ville,PDO::Param_STR,":actif",0,PDO::Param_INT);
				$result->execute();
				$lastIdInserted = self::$_pdo->query('SELECT MAX(id) FROM utilisateur');
				$result = self::$_pdo->prepare('INSERT INTO adherent (`id`, `nom`, `prenom`,`promo`) VALUES(:id,:nom,:prenom,:promo)';
				$result->bindParam(":id",$lastIdInserted,PDO::Param_INT,":nom",$nom,PDO::Param_STR,":prenom",$prenom,PDO::Param_STR,":promo",$promo,PDO::Param_STR);
				$result->execute();
				self::$_pdo->commit();
			}
			catch (Exception $e) 
			{
			  $self::$_pdo->rollBack();
			  echo "Failed: " . $e->getMessage();
			}
		}
		
		public static function creerClient($raisonSociale,$mailClient,$telephone,$adresse,$codePostal,$Ville)
		{
			try
			{
				//première partie : insertion brute dans la BD des informations du client
				bdd::init();
				self::$_pdo->beginTransaction();
				$result = self::$_pdo->prepare('INSERT INTO utilisateur (`telephone`, `mail`, `adresse`, `codePostal`, `ville`, `actif`) VALUES(:telephone,:mail,:adresse,:codePostal,:ville,:actif)');
				$result->bindParam(":telephone",$telephone,PDO::Param_STR,":mail",$mail,PDO::Param_STR,":adresse",$adresse,PDO::Param_STR,
				":codePostal",$codePostal,PDO::Param_STR,":ville",$Ville,PDO::Param_STR,":actif",0,PDO::Param_INT);
				$result->execute();
				$lastIdInserted = self::$_pdo->query('SELECT MAX(id) FROM utilisateur');
				$result = self::$_pdo->prepare('INSERT INTO client (`id`, `raisonSociale`) VALUES (:id, :raisonSociale)';
				$result->bindParam(":id",$lastIdInserted,PDO::Param_INT,":raisonSociale",$raisonSociale,PDO::Param_STR);
				$result->execute();
				
				//deuxième partie : création/génération des logins utilisateur pour le profil client associé
				$type = 'client';
				$logins = genererLogins($type,$lastIdInserted);
				$login = $logins['login'];
				$mdp = $logins['mdp'];
				$mdpCrypter = hash_password($mdp);
				$result = self::$_pdo->prepare('INSERT INTO login (`login`, `mdp`, `type`, `user`) VALUES(:login,:mdp,:type,:idClient)');
				$result->bindParam(":login",$login,Param_STR,":mdp",$mdpCrypter,Param_STR,":type",'C',Param_STR,"idClient",$lastIdInserted,Param_INT);
				$result->execute();
				self::$_pdo->commit();			
				// Préparation du mail contenant les logins
					$sujet = "Vos identifiants SISTEMA" ;
					$entete = "From: sistema@noreply.com" ;
        
				// coeur du message du mail
					$message = 'Bienvenue chez SISTEMA,

					Nous vous informons que votre profil a bien été crée par la direction de SISTEMA. 
					Voici vos identifiants de connexion afin de vous connecter à votre espace 
					sur le site "mettre le futur lien du site".
					
					Login : '.$login'
					Mot de passe : '.$mdp'

       
					---------------
					Ceci est un mail automatique, Merci de ne pas y répondre.';
        
					//mail($mailClient, $sujet, $message, $entete); //envoi le mail (serveur SMTP !)
			}
			catch (Exception $e) 
			{
			  $self::$_pdo->rollBack();
			  echo "Failed: " . $e->getMessage();
			}
		}

		public static function getCandidats() 
		{
			try
			{
				bdd::init();
				$result = self::$_pdo->prepare('SELECT * from utilisateur and adherent where utilisateur.id = adherent.id and actif = :actif');
				$result->bindParam(":actif",0,Param_INT);
				$result->execute();
				$result = $result->fetchAll();
				return $result;
			}
			catch(Exception $e)
			{
				echo "Failed: " . $e->getMessage();
			}
		}
			
		public static function genererLogin($userType, $idUser)
		{//TODO à tester ...
			
			switch($userType)
			{
				case 'candidat':
					try
					{					
							bdd::init();
							$result = self::$_pdo->prepare('SELECT nom, prenom FROM adherent where id = :idUser');
							$result->bindParam("idUser",$idUser,Param_INT);
							$result->execute();
							$result = $result->fetch();
							$login = strtolower($result['prenom'][0].$result['nom']);
							$mdp = genererMDP($longueur);
							$logins["login" => $login, "mdp" => $mdp,];
					}
					catch(Exception $e)
					{
						echo "Failed: " . $e->getMessage();
					}
				break;
				case 'client':
					try
					{
						bdd::init();
						$result = self::$_pdo->prepare('SELECT RaisonSociale FROM client where id = :idUser');
						$result->bindParam("idUser",$idUser,Param_INT);
						$result->execute();
						$result = $result->fetch();
						$login = strtolower($result['raisonSociale']);
						$login = str_replace(CHR(32),"",$login);
						$login = preg_replace("#[^a-zA-Z]#", "", $login);
						if(strlen($login) > 10)
						{
							$login =  substr($login,0,10);
						}
						$mdp = genererMDP($longueur);
						$logins["login" => $login, "mdp" => $mdp,];
						
					}
					catch(Exception $e)
					{
						echo "Failed: " . $e->getMessage();
					}
				break;
			}
			return $logins[];
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
		public function hash_password( $p, $s='', $c=1000, $kl=32, $a = 'sha256' ) 
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
				$type = 'candidat';
				$logins = genererLogins($type,$idCandidat);
				$login = $logins['login'];
				$mdp = $logins['mdp'];
				$mdpCrypter = hash_password($mdp);
				bdd::init();
				self::$_pdo->beginTransaction();
				$result = self::$_pdo->prepare('INSERT INTO login (`login`, `mdp`, `type`, `user`) VALUES(:login,:mdp,:type,:idCandidat)');
				$result->bindParam(":login",$login,Param_STR,":mdp",$mdpCrypter,Param_STR,":type",'E',Param_STR,"idCandidat",$idCandidat,Param_INT);
				$result->execute();
				self::$_pdo->commit();
				
				// Préparation du mail contenant les logins
					$sujet = "Vos identifiants SISTEMA" ;
					$entete = "From: sistema@noreply.com" ;
        
				// coeur du message du mail
					$message = 'Bienvenue chez SISTEMA,

					Nous vous informons que votre candidature a été validé par la direction de SISTEMA. 
					Voici vos identifiants de connexion afin de vous connecter à votre espace 
					sur le site "mettre le futur lien du site".
					
					Login : '.$login'
					Mot de passe : '.$mdp'

       
					---------------
					Ceci est un mail automatique, Merci de ne pas y répondre.';
        
				//mail($mailCandidat, $sujet, $message, $entete); //envoi le mail 
			}
			catch(Exception $e)
			{
				$self::$_pdo->rollBack();
				echo "Failed: " . $e->getMessage();
			}	
		}
		public static function affecterAuProjet($idAdherent) 
		{
			bdd::init();
		}

		public static function nommerChefProjet($idAdherent) 
		{
			bdd::init();
		}
	}
?>