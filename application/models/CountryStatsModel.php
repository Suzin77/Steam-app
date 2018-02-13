<?php
include_once 'application/libs/model.php';

class CountryStatsModel extends Model
{

	/*public function __construct($db)
	{
		$this -> countryList = $this -> getCountryCode();
		$this -> numberOfrows = $this ->count($this -> countryList);
		//$this -> countriesData = $this ->
	}
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