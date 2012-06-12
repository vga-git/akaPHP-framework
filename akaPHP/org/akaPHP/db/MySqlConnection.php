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

        public function query($sql, array $params = null) {
            $this->doConnect();

            $statement = $this->connection->prepare($sql);
            $statement->execute($params);
            return $statement->fetchAll();
        }
    }
}
?>
