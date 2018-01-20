<?php
	include 'sistema/classes/criteriaClass.php';
	include 'sistema/classes/receitaClass.php';

	function sqlSelect ($criteria, $tablename) {
		$sql = 'SELECT ' . $criteria->select . ' FROM ' . $tablename;
		
		if (!empty($criteria->condition)) {	
			$sql .= $criteria->condition;
		}
		if (!empty($criteria->order)) {
			$sql .= ' ORDER BY ' . $criteria->order;
		}
		if (!empty($criteria->group)) {
			$sql .= ' GROUP BY ' . $criteria->group;
		}

		return $sql;
	}

	function sqlQuerySelect ($link, $criteria, $tablename){
		$sql = sqlSelect($criteria, $tablename);
		return mysqli_query($link, $sql);
	}
	
	function sqlUpdate ($criteria, $tablename) {
		

		$sql = 'UPDATE ' . $tablename . ' SET ' . $criteria->update;
		
		if (!empty($criteria->condition)) {	
			$sql .= $criteria->condition;
		}

		return $sql;
	}

	function sqlQueryUpdate ($link, $criteria, $tablename) {
		$sql = sqlUpdate ($criteria, $tablename);
		return mysqli_query($link, $sql);
	}

	function sqlInsert ($criteria, $tablename) {
		$sql = 'INSERT INTO ' . $tablename . $criteria->insert;
		return $sql;
	}

	function sqlQueryInsert ($link, $criteria, $tablename) {
		$sql = sqlInsert($criteria, $tablename);
		return mysqli_query($link, $sql);
	}

	function sqlDelete ($criteria, $tablename) {
		$sql = 'DELETE FROM ' . $tablename . ' WHERE ' . $criteria->condition;
		return $sql;
	}

	function sqlQueryDelete ($link, $criteria, $tablename) {
		$sql = sqlDelete($criteria, $tablename);
		return mysqli_query($link, $sql);
	}

	function sqlFetchAssoc ($link, $criteria, $tablename) {
		$query = sqlQuerySelect($link, $criteria, $tablename);
		return mysqli_fetch_assoc($query);
	}

	function sqlFetchAll ($link, $criteria, $tablename) {
		$query = sqlQuerySelect($link, $criteria, $tablename);
		return mysqli_fetch_all($query);
	}

	function sqlFetchRow ($link, $criteria, $tablename) {
		$query = sqlQuerySelect($link, $criteria, $tablename);
		return mysqli_fetch_row($query);
	}
?>