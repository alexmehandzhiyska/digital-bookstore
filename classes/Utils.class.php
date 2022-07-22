<?php

class Utils
{
    private $_pdo = null;

    public function __construct(PDO $_pdo)
    {
        $this->_pdo = $_pdo;
    }

    public function getErrorMessage()
    {
        return $this->_error_message;
    }

    private function _prepare_PDO_ERROR(PDOException $e)
    {
        $this->_error_message = $e->getMessage();
        $error_code = $e->getCode();
        $this->_error_message = $e->getMessage();

        switch ($error_code) {
            case 23000: {
                $_e = 'Such Combination Already exist ZAX!';
                $this->_error_message = $_e;
            }
        }

    }

    /**
     * Добавя в базата данни
     * @param $sql - заявката
     * @param array $params - масива с параметрите (ако има такива)
     * @param bool $debug - ако е сетнато - ще изплюе дебъг информация
     * @return int - последното добавено ID|string - има ГРЕШКА
     */
    private function _pdo_insert($sql, array $params = array())
    {
        try {
            $stmt = $this->_pdo->prepare($sql);
            if (!empty($params)) {
                foreach ($params as $param => $value) {
                    $stmt->bindValue($param, $value);
                }
            }
            $stmt->execute();
            $lastInsertId = $this->_pdo->lastInsertId();

        } catch (PDOException $e) {
            $this->_prepare_PDO_ERROR($e);
            $lastInsertId = 'error';
        }

        return $lastInsertId;
    }

    /**
     *  Fetches the next row from a result set
     * @param $sql - заявката
     * @param array $params - масива с параметрите (ако има такива)
     * @param bool $debug - ако е сетнато - ще изплюе дебъг информация
     * @return array row - ЕДИН ред от Масив - ако има резултат | False - ако няма резултат |string - има ГРЕШКА
     */
    private function _pdo_fetch($sql, array $params = array())
    {
        //автоматизация за pdo
        try {
            $stmt = $this->_pdo->prepare($sql);
            if (!empty($params)) {
                foreach ($params as $param => $value) {
                    $stmt->bindValue($param, $value);
                }
            }
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            $this->_prepare_PDO_ERROR($e);
            $row = 'error';
        }
        return $row;
    }

    /**
     *  Returns an array containing all of the result set rows
     * @param $sql - заявката
     * @param array $params - масива с параметрите (ако има такива)
     * @param bool $debug - ако е сетнато - ще изплюе дебъг информация
     * @return array - Масив - ако има резултат | False - ако няма резултат |string - има ГРЕШКА
     */
    private function _pdo_fetch_all($sql, $params = array())
    {
        try {
            $stmt = $this->_pdo->prepare($sql);
            if (!empty($params)) {
                foreach ($params as $param => $value) {
                    $stmt->bindValue($param, $value);
                }
            }
            $stmt->execute();
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            $this->_prepare_PDO_ERROR($e);
            $row = 'error';
        }
        return $row;
    }

    protected function fetch($sql, $params = array()){
        return $this->_pdo_fetch($sql, $params);
    }

    protected function fetch_all($sql, $params = array()){
        return $this->_pdo_fetch_all($sql, $params);
    }

    protected function insert($sql, $params = array()){
        return $this->_pdo_insert($sql, $params);
    }

}//eof class