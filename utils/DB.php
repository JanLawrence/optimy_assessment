<?php

namespace Utils;

use PDO;
use PDOException;
class DB
{
	private $pdo;
	protected $table = '';
	private $conditions = [];

	private static $instance = null;

	/** 
	 *  Initiate PDO Connection
	 */
	protected function __construct($table = null)
	{
		try{
			$dsn = DB_CONN.':dbname='.DB_NAME.';host='.DB_HOST;
			$user = DB_USER;
			$password = DB_PASS;

			$this->table = $table ?? $this->table;

			$this->pdo = new \PDO($dsn, $user, $password);
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}

	/** 
	 *  Initiate class
	 */
	public static function getInstance()
	{
		if (null === self::$instance) {
			$c = __CLASS__;
			self::$instance = new $c;
		}
		return self::$instance;
	}

	/** 
	 *  Execute raw queries
	 */
	public function raw($sql)
	{
		try{
			$statement = $this->pdo->prepare($sql);
			$statement->execute();
			return $statement->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}

	/** 
	 *  Collect where clauses in array
	 *  @param $column - column name
	 *  @param $operator - operator value
	 *  @param $value - value
	 */
	
	public function where($column, $operator, $value) {
		$this->conditions[] = compact('column', 'operator', 'value');
		return $this;
	}
	
	/** 
	 *  Get all data of table, you can chain where() to add conditions
	 *  @param array $fields_arr this array sets the fields of the select query, default empty or *
	 *  @return object
	 */
	public function get($fields_arr = [])
	{
		try{
			$fields = empty($fields_arr) ? '*' : implode(', ',  $fields_arr);

			$sql = "SELECT $fields FROM $this->table";

			if (!empty($this->conditions)) {
				$sql .= " WHERE";
				foreach ($this->conditions as $cond) {
					$sql .= " {$cond['column']} {$cond['operator']} '{$cond['value']}' AND";
				}
				$sql = rtrim($sql, ' AND');
			}

			$statement = $this->pdo->prepare($sql);
			$statement->execute();
			return $statement->fetchAll(PDO::FETCH_CLASS, get_called_class());
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}

	/** 
	 *  Get data of table by id
	 *  @param $id - id of the table
	 *  @return object
	 */
	public function find($id)
	{
		try{
			$statement = $this->pdo->prepare("SELECT * FROM $this->table WHERE id = :id");
			$statement->bindParam(':id', $id);
			$statement->execute();
			return $statement->fetchObject(get_called_class());
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}

	/** 
	 *  Create data of table by id
	 *  @param $data - associative array of table data using column names as indexes
	 *  @return object of newly inserted data
	 */
	public function create($data)
	{
		try{
			$columns = $this->statementConcat($data, 'c');
			$values = $this->statementConcat($data, 'v');

			$pdo = $this->pdo;
			$statement = $pdo->prepare("INSERT INTO $this->table ($columns) VALUES ($values)");

			$statement->execute($this->bindColumns($data));
			$last_id = $pdo->lastInsertId();
			
			return $this->find($last_id);

		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}

	/** 
	 *  Update data of table by id
	 *  @param $data - associative array of table data using column names as indexes
	 *  @return object
	 */

	public function update($data)
	{
		try{
			$set = $this->statementConcat($data, 'u');

			$pdo = $this->pdo;
			$statement = $pdo->prepare("UPDATE $this->table SET $set WHERE id = $this->id");

			$statement->execute($this->bindColumns($data));
			
			return $this->find($this->id);

		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}

	 /** 
	 *  Delete data of table by id - find the data first to use delete()
	 *  the $this->id property is reused so find($id) is used after deleting
	 */

	public function delete()
	{
		try{
			$pdo = $this->pdo;
			$statement = $pdo->prepare("DELETE FROM $this->table WHERE id = $this->id");

			$statement->execute();

		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}

	/** 
	 *  Getting data of the child table in relation of parent table to child table
	 *  @param $class - model class name of child
	 *  @param $column - column name of parent table in relation to foreign
	 *  @param $forein_column - foreign column name of child table
	 */
	public function hasChildren($class, $column, $foreign_column){
		$data = $class->where($foreign_column, '=' , $this->{$column})->get();
		return $data;
	}

	/** 
	 *  Getting data of the parent table in relation of child table to parent table
	 *  @param $class - model class name of parent
	 *  @param $column - column name of child table in relation to foreign
	 */
	public function belongsTo($class, $column){
		$data = $class->find($this->{$column});
		return $data;
	}

	/** 
	 *  Creating arrays with : in index for binding parameters in executing pdo prepared statements
	 *  @param $data - data with columns as indexes
	 */
	private function bindColumns($data){
		$new_arr = [];
		foreach($data as $key => $val){
			$new_arr[':'.$key] = $val;
		}
		return $new_arr;
	}

	/** 
	 *  Creating string concatenation base on $data passed, for pdo prepared statements
	 *  @param $data - data with columns as indexes, $type - to base if columns as c or values as v, u is for update set query
	 */
	private function statementConcat($data, $type){
		$concat = '';
		if($type == 'c'){
			$concat = implode(', ', array_keys($data));
		} else if($type == 'u') {
			foreach($data as $key => $each){
				$concat .= $key.' = :'.$key.', ';
			}
			$concat = rtrim($concat, ', ');
		} else {
			$concat = ":" . implode(', :', array_keys($data));
		}
		return $concat;
	}
}