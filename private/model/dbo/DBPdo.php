<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 24/07/2019
 * Time: 19:21
 */

namespace model\dbo;

use abstractClasses\AbstractDBO;

class DBPdo extends AbstractDBO {

    protected $host;
    protected $db;
    protected $username;
    protected $pass;
    protected $charset;
    protected $query;
    protected $data;

    public function __construct(array $connectionVars) {
        $connectionVars = (object) $connectionVars;
        if(!$connectionVars) throw new \Exception("No DB Credentials Found");
        else {
            $this->host = $connectionVars->dbHost;
            $this->db = $connectionVars->dbName;
            $this->username = $connectionVars->dbUsername;
            $this->pass = $connectionVars->dbPass;
            $this->charset = $connectionVars->dbCharset;
        }
    }

    public function checkConnectionIsOpen() : bool {
        return ($this->conn !== null);
    }

    public function openConnection() {
        $conn = new PDO("mysql:host=$this->host;dbname=$this->db;charset=$this->charset", $this->username, $this->pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $this->conn = $conn;
    }

    public function setQuery(string $query) {
        if(!$this->checkConnectionIsOpen()) $this->openConnection();
        $this->query = $query;
    }

    public function setData(array $data) {
        // TODO: Implement setData() method.
    }

    public function bindData() {
        // TODO: Implement bindData() method.
    }

    public function executeQuery() {
        // TODO: Implement executeQuery() method.
    }

    public function fetchSingleRow() {
        // TODO: Implement fetchSingleRow() method.
    }

    public function fetchAllRows() {
        // TODO: Implement fetchAllRows() method.
    }

    public function fetchSingleColumn() {
        // TODO: Implement fetchSingleColumn() method.
    }

    public function fetchKeyedArray(string $key) {
        // TODO: Implement fetchKeyedArray() method.
    }

    public function closeConnection() {
        // TODO: Implement closeConnection() method.
    }

}