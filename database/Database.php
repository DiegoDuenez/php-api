<?php

namespace Database;

use Utilities\Log;
use PDOException;
use Env\Env;
use PDO;

class Database{
	
	private $dbh;

	function __construct(){
		
		$dsn = "mysql:host=" . Env::get('DB_HOST') . ";dbname=". Env::get('DB_DATABASE') .";charset=utf8mb4";

		$options = [
			PDO::ATTR_EMULATE_PREPARES   => false,
			PDO::ATTR_EMULATE_PREPARES => true,
			PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		];

		try {
			
            !$this->dbh = new PDO($dsn, Env::get('DB_USERNAME'),  Env::get('DB_PASSWORD'), $options);

		}catch(PDOException $e) {

			http_response_code(500);
            Log::alert($e->getMessage());
            return $e->getMessage();
			die();

		}
	}


	function read($q, $callback= null){
		try{
			$sth = $this->dbh->prepare($q);
			$sth->execute();
			$sth->setFetchMode(PDO::FETCH_ASSOC);
			$result = $sth->fetchAll();
			//$this->dbh = null;
			$result = json_encode($result);
			$obj = json_decode($result, true);
			if($callback){
				$callback();
			}
			return $obj;

		}
		catch(PDOException $e){
			http_response_code(500);
            Log::error($e->getMessage());
            return $e->getMessage();
			die();
		}
	}

	function execute($q, $parametros, $callback= null){
		try	{

			$sth = $this->dbh->prepare($q);
			if($sth->execute($parametros)){
				if($callback){
					$callback();
				}
				return $sth->rowCount() > 0;
			}
			
		}
		catch(PDOException $e){
			http_response_code(500);
            Log::error($e->getMessage());
            return $e->getMessage();
			if ($e->errorInfo[1] == 1062) {
				echo json_encode(["status" => "error", "error" => $e->getMessage(), "type"=>"duplicate"]);
				die();
			} else {
				throw $e;
			}
			return false;
			die();
		
		}
	}

	function lastId()
	{
		$id = $this->dbh->lastInsertId();
		return $id;
	}

   
    function close()
    {

        $this->dbh = null;

    }

}