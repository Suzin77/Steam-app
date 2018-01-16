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

	public function createTable($tableHeaders,$tableData)
	{
		$result = "<table>";
		$result .= $this->createTableHeader($tableHeaders);
		$result .= $this->createTableBody($tableHeaders,$tableData);
		$result .= "</table>";

		return $result;
	}

	public function createTableHeader($tableHeaders)
	{	
		$result = "<thead style=\"background-color: #ddd; font-weight: bold;\"><tr>";
		foreach($tableHeaders as $key => $value){
			$result .= "<td> ".$key." </td>";
		}
		$result .=  "</tr></thead>";
		return $result;
	}

	public function createTableBody($tableHeaders,$tableData)
	{
		$tbody = "<tbody>";		
		foreach($tableData as $key => $value){
			//var_dump($key);
			//echo "</br>";
			//var_export($tableHeaders);
			//var_dump($value['steamid']);
			$tbody .= "<tr>";
			foreach($tableHeaders as $column => $columnValue){
				$tbody .="
						  
						  <td>".$value[$column]."</td>";						  
			}
			$tbody .= "</tr>";		   
		}
		$tbody .="</tbody>";
		return $tbody;
	}
}

?>