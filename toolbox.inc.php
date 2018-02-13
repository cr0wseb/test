<?php
/**
 * Boite à outil de l'exercice 6
 *
 * PHP Version 7.0
 *
 * @category Void
 * @package Void
 * @author Sébastien Jover <sebastien@jover.fr>
 *
 */

/**
 * Checks if an integer is even
 *
 * @param $myInt int The integer to check
 *
 * @return bool Return true if is even, false if is odd 
 */
function isEven($myInt)
{
	if ($myInt % 2 == 0) {
		// It's even
		return true;
	} else {
		// It's odd
		return false;
	}
}

/**
 * Displays an HTML table
 *
 * @return void
 */
function displayTable()
{
	echo '<table>';
	echo '	<tr class="title">';
	echo '      <td>Id</td>';
	echo '      <td>Login</td>';
	echo '		<td>Prénom</td>';
	echo '		<td>Nom</td>';
	echo '	</tr>';
	
	// Récupération des données d'utilisateurs
	$myData = getDataFromDB();
	
	$lineCounter = 0;
	foreach($myData as $data){
		$lineCounter++;
		if(isEven($lineCounter)) {
			$class = 'even';
		} else {
			$class = 'odd';
		}
		
		echo '<tr class="' . $class . '">';
		echo '	<td>' . $data['u_id'] . '</td>';
		echo '	<td>' . $data['u_login'] . '</td>';
		echo '	<td>' . $data['u_prenom'] . '</td>';
		echo '	<td>' . $data['u_nom'] . '</td>';
		echo '</tr>';
	}
	
	echo '</table>';
}

/***********************************************************************************************************************************/
/***********************************************************************************************************************************/
/***********************************************************************************************************************************/
/***********************************************************************************************************************************/

/**
 * Connects PDO to your DB
 *
 * return PDO
 */
function connectPDO()
{
	try {
		$strConnectionData = 'mysql:host=localhost;dbname=ecod';
		$arrParams= array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
		$myPDO = new PDO($strConnectionData, 'root', '', $arrParams);
		$myPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		return $myPDO;
	}
	catch(PDOException $e) {
		$msg = 'PDO Exception :: on ' . $e->getFile() . ' at line ' . $e->getLine() . ' : ' . $e->getMessage(); 
		exit($msg);
	}
}

/**
 * Returns the users' data
 *
 * @return mixed[] The users' data
 */
function getDataFromDB()
{
	global $pdo;
	
	// We retrieve the users' data
	$stmt = $pdo->query('SELECT * FROM ecod_utilisateur');

	// We get all the data at the  same time
	$arrResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	return $arrResult;
}

/**
 * Inserts new data row
 *
 * @param $login string The login
 * @param $password string The password
 * @param $prenom string The firstname
 * @param $nom string The lastname
 *
 * return void
 */
function insertNewData($login, $password, $prenom, $nom)
{
	global $pdo;
	
	// We insert the new data line
	$result = $pdo->exec('INSERT INTO ecod_utilisateur(u_login, u_password, u_prenom, u_nom) VALUES("'.$login.'", PASSWORD("'.$password.'"), "'.$prenom.'", "'.$nom.'")');
	$insertId = $pdo->lastInsertId();
}