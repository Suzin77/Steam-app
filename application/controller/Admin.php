<?php 

class Admin extends Controller
{	
	public function index()
	{
		$statsModel = $this->loadModel('statsModel');
		$amountOfUsers = $statsModel->getAmountOf('user_id','users');
	    $amountToCheck = $statsModel->getAmountOf('steam_id','steam_users_to_check');
	    $DataSearchReadModel = $this ->loadModel('DataSearchReadModel');
	    $exampleToCheck = $DataSearchReadModel->getRandomRows('steam_id','steam_users_to_check',1);
		//tutuaj damy teplates z przyciskami do aktualizacji danych 
		//w bazie.

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
		//header('location: '. URL . 'admin/index');
		//unset($SteamAPISearchReadModel);	
	}

	public function updateMany($howMany)
	{	
		if($howMany > 200){
			$howMany=200;
		}
		echo "Jestem W updatemany</br>";
		$SteamAPISearchReadModel = $this->loadModel('SteamAPISearchReadModel');
		$DataSearchReadModel = $this->loadModel('DataSearchReadModel');
		$DataSearchWriteModel = $this->loadModel('DataSearchWriteModel');	
		for($i=1; $i<=$howMany; $i++){
			$exampleToCheck = $DataSearchReadModel->getRandomRows('steam_id','steam_users_to_check',1);
			$userData = $SteamAPISearchReadModel->searchSteamUser($exampleToCheck[0]['steam_id']);
			$DataSearchWriteModel->addUser($userData);
			$DataSearchWriteModel-> removeId($exampleToCheck[0]['steam_id'],"steam_users_to_check");
			echo "</br>dodano takiego ".$exampleToCheck[0]['steam_id'];
			//unset($exampleToCheck);
			header('location: '. URL . 'admin/index');
		}
	}

	public function Update()
	{
		$updateModel = $this->loadModel('Update');
		$updateModel->UpdateUsers(1);
	}
}
?>