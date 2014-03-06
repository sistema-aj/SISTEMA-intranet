<?php
	class Adherents 
	{
	
		public static function getAdherents() 
		{
			try
			{
				$table = 'adherent';
				bdd::getAllByTable($table);
			}
			catch(Exception $e)
			{
				echo "Failed: " . $e->getMessage();
			}
		}

		public static function getDetailAdherent($idAdherent) 
		{
			try
			{
				$table ='adherent';
				bdd::getById($table, $idAdherent);
			}
			catch(Exception $e)
			{
				echo "Failed: " . $e->getMessage();
			}
		}

		public static function getAdherentsParProjet($idProjet) 
		{
			//TODO : méthode à tester et valider	
			try
			{
				bdd::init();
				$result = self::$_pdo->prepare("SELECT * FROM adherent, participer, projet where adherent.id = participer.user and participer.projet = projet.id and projet.id = :idProjet");
				$result->bindParam(":idProjet",$idProjet,PDO::Param_STR);
				$result->execute();
				$result = $result->fetchAll();
				return $result;
			}
			catch(Exception $e)
			{
				echo "Failed: " . $e->getMessage();
			}
		}
	}
?>