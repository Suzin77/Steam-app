<?php
//namespace application\libs;

//use application\libs;

class Admin extends Controller
{	
	public function index()
	{
		$statsModel = $this->loadModel('statsModel');
		$countryStatsModel = $this ->loadModel('countryStatsModel');
		$amountOfUsers = $statsModel->getAmountOf('user_id','users');
	    $amountToCheck = $statsModel->getAmountOf('steam_id','steam_users_to_check');
	    $DataSearchReadModel = $this ->loadModel('DataSearchReadModel');
	    $exampleToCheck = $DataSearchReadModel->getRandomRows('steam_id','steam_users_to_check',1);
		$allCountries = $countryStatsModel -> getCountryCode();
		$numberOfRows = count($allCountries);
		$allCountries = $countryStatsModel -> countCountries($allCountries);
		arsort($allCountries);
		$ratio = $countryStatsModel-> ratioPerSent($amountOfUsers,$numberOfRows);

		require 'application/views/_templates/header.php'; 
		require 'application/views/admin/admin.php';    
	    require 'application/views/_templates/debug.php';
	    require 'application/views/_templates/footer.php';
	}

	public function updateUser($userID)
	{
		//sprawdzic czy takiego ID już nie ma w bazie	
		// 1 odpytac steam o id
		$SteamAPISearchReadModel = $this->loadModel('SteamAPISearchReadModel');		
		// 2 pobrac odpwiedz
		$userData = $SteamAPISearchReadModel->searchSteamUser($userID);	
		$DataSearchWriteModel = $this->loadModel('DataSearchWriteModel');
		// 4 zapisac w tabeli users
		$DataSearchWriteModel->addUser($userData);
		//5 usunąć ID z tabeli do sprawdzenia
		$DataSearchWriteModel-> removeId($userID,"steam_users_to_check");
		//A moze lepiej wpisać datę aktualizacji.
		//header('location: '. URL . 'admin/index');
		//unset($SteamAPISearchReadModel);	
	}

	public function updateMany($howMany)
	{	
		/**
		Funkcja: 
		-pobiera z listy uzytkowników "do sprawdzenia" identyfikatory
		-komunikuje sie ze steam aby pobrac infomacje
		-zapisuje pobrane dane w tabeli users
		-usuwa zaktualizowne Id z listy "do sprawdzenia"

		**/
		if($howMany > 200){
			$howMany=200;
		}
		$SteamAPISearchReadModel = $this->loadModel('SteamAPISearchReadModel');
		$DataSearchReadModel = $this->loadModel('DataSearchReadModel');
		$DataSearchWriteModel = $this->loadModel('DataSearchWriteModel');	
		for($i=1; $i<=$howMany; $i++){
			$exampleToCheck = $DataSearchReadModel->getRandomRows('steam_id','steam_users_to_check',1);
			$userData = $SteamAPISearchReadModel->searchSteamUser($exampleToCheck[0]['steam_id']);
			$DataSearchWriteModel->addUser($userData);
			$DataSearchWriteModel-> removeId($exampleToCheck[0]['steam_id'],"steam_users_to_check");		
			header('location: '. URL . 'admin/index');
		}
	}

	public function Update()
	{
		$updateModel = $this->loadModel('Update');
		$updateModel->UpdateUsers(1);
	}

	public function answer()
	{
		$DataSearchWriteModel = $this->loadModel('DataSearchWriteModel');
					
		if(isset($_POST['answer'])&& !empty($_POST['answer'])){			
			//sanitization of enterned data.
			$answer = Sanitizer::sanitizeString($_POST['answer']);
			$DataSearchWriteModel->addAnswer($answer);
			header('location: '. URL . 'admin/pytania');

		} else {
			echo "Proszę wróc i uzupełnij formularz. Naprawde potrzbuje tych odpowiedzi ;)";
		}			
	}
}
?>