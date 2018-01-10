<?php
class TablesViews
{
	/*
	class where are methods to generate html
	in this class particulary are methods that generates tables.
	*/

	public function friendTable($friendList)
	{
		$html = "<p>jestem frient table</p>";

		return $html;
	}

	public function createTable($data, $config = array())
	{
		$result = "<table>";
		$result .= $this->cerateTableHeader($data);
		$result .= $this->createTableBody($data);
		$result .= "</table>";

		return $result;
	}

	public function cerateTableHeader($tableHeaders)
	{	
		$result = "<thead style=\"background-color: #ddd; font-weight: bold;\"><tr>";
		foreach($tableHeaders as $key => $value){
			$result .= "<td> ".$value." </td>";
		}
		$result .=  "</tr></thead>";
		return $result;
	}

	public function crateTableBody($tbodyData,$tableHeaders=array('steamid','friend_since'))
	{
		$tbody = "<table><tbody>";
		
		foreach($tbodyData['friendslist']['friends'] as $key => $value){
			//var_dump($key);
			//echo "</br>";
			//var_dump($value['steamid']);
			$tbody .= "<tr>
						  <td>".$value[$tableHeaders[0]]."</td>
						  <td>".$value[$tableHeaders[1]]."</td>
					      <td>data cell</td>					      
					   </tr>";
		}
		$tbody .="</tbody></table>";
		return $tbody;
	}
}

?>