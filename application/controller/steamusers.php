<?php 

class SteamUsers extends Controller
{

    public function index()
    {
		/* Page: index.

		*/

		echo "We are in index fumction in games controller ";

		$games_model = $this->loadModel('SteamUsersModel');
	    $users = $games_model->getAllUsers();

	    $stats_model = $this->loadModel('StatsModel');
	    $amount_of_users = $stats_model->getAmountOfUsers();

		require 'application/views/_templates/header.php';
	    require 'application/views/steamusers/index.php';
	    require 'application/views/_templates/footer.php';
	}

	public function deleteUser($user_id)
	{
		if(isset($user_id)){
			$games_model = $this->loadModel('SteamUsersModel');
			$deleteUser = $games_model->deleteUser($user_id);
		}
		
		header('location: ' . URL . 'steamusers/index');
	}

	public function searchSteamUser($steamUserId)
	{
		
	}   

}

?>
