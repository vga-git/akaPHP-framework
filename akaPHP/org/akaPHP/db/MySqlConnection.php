<?php
namespace org\akaPHP\db {

    class MySqlConnection extends DbConnection {

        public function doConnect() {
            if ($this->connection) {
                return;
            }

            $this->connection = new \PDO(
                sprintf(
                    "mysql:host=%s;dbname=%s",
                    $this->info->getHost(),
                    $this->info->getDatabaseName()
                ),
                $this->info->getUser(),
                $this->info->getPassword()
            );
        }

        public function doDisconnect() {
            $this->connection = null;
        }

        public function execute($rawSql) {
            $this->doConnect();

            $pdoObject = $this->connection->query($rawSql);
            if ($pdoObject) {
                // type = PDOStatement
                return $pdoObject->fetchAll();
            }
            return null;

        }

        public function query($sql, array $params) {
            $this->doConnect();

            $statement = $this->connection->prepare($sql);
            $statement->execute($params);
            return $statement->fetchAll();
        }
    }
}
?>
