<?php 

/*

Created by: Bruno Garcia (brunoely.gc@gmail.com)
Filtra a variavel contra SQL Injection e retorna a string filtrada

*/

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SQLInjectionController extends Controller
{
	public static function removeMalicius($value)
	{
		$value = addslashes($value);
		$value = htmlspecialchars($value);

		$SQLwords = array('select', 'insert', 'delete', 'update', 'drop', 'database', 'union', 'limit', 'from', 'where');

		$value = str_ireplace($SQLwords, '', $value);

		return $value;
	}
}

