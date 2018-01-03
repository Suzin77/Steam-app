<?php 

class Games extends Controller
{

    public function index()
    {
		/* Page: index.

		*/

		echo "We are in index fumction in games controller ";

		$games_model = $this->loadModel('GamesModel');
	    $users = $games_model->getAllPlayers();

		require 'application/views/_templates/header.php';
	    require 'application/views/games/index.php';
	    require 'application/views/_templates/footer.php';
	}    

}

?>
