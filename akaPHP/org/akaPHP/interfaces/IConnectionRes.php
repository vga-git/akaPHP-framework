<?php
namespace org\akaPHP\interfaces {
    interface IConnectionRes {
        function getInfo();
        function connect();
        function disconnect();
        function isConnected();
    }
}
?>
