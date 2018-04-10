<?php

class CountryStatsModel extends Model
{

	/* Klasa służy do pobiernaia i wyliczania statystyk odnośnie krajów użytkowników.  
	* Zastanowić się czy getCountryCode() nie powinno być w DataReadModel
	*/
	 public function getCountryCode()
    {
        $sql = "SELECT loccountry_code FROM users WHERE loccountry_code IS NOT NULL";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function countCountries($data, $result=array())
    {
        foreach($data as $key =>$value){
        	$result[]= $data[$key]["loccountry_code"];
    	}
    $result = array_count_values($result);
    return $result;
    }

    public function numbersOfRows($data)
    {
    	return count($data);
    }

    public function ratioPerSent($all,$fraction)
    {
    	return (round((($fraction*100)/$all), 2));
    }
    
}

?>