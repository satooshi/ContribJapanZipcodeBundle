<?php

namespace Contrib\JapanZipcodeBundle\Adapter;

abstract class RepositoryAdapter
{
    protected $em;
    protected $driver;

    public function __construct($em)
    {
        $this->em = $em;
        $this->driver = $this->em->getConnection()->getWrappedConnection();
    }

    /**
     * @param string $sql
     * @return \PDOStatement
     */
    protected function prepare($sql)
    {
        $stmt = $this->driver->prepare($sql);

        if ($stmt === false) {
            throw new \RuntimeException();
        }

        return $stmt;
    }

    protected function executeStatement($sql, array $params)
    {
        $stmt = $this->prepare($sql);

        $this->bindParams($stmt, $params);

        if ($stmt->execute() === false) {
            throw new \RuntimeException();
        }

        return $stmt;
    }

    protected function bindParams($stmt, array $params)
    {
        foreach ($params as $key => $values) {
            if (!isset($values[0])) {
                continue;
            }

            if (isset($values[1])) {
                $type = $values[1];

                $stmt->bindParam($key, $values[0], $this->getBindType($type, $values[0]));
            } else {
                $stmt->bindParam($key, $values[0]);
            }
        }
    }

    protected function getBindType($type, $value)
    {
        switch ($type) {
            // string
            case 'string?':
                return $value === null ? \PDO::PARAM_NULL : \PDO::PARAM_STR;
            case 'string':
                return \PDO::PARAM_STR;

            // int
            case 'int?':
                return $value === null ? \PDO::PARAM_NULL : \PDO::PARAM_INT;
            case 'int':
                return \PDO::PARAM_INT;

            // bool
            case 'bool?':
                return $value === null ? \PDO::PARAM_NULL : \PDO::PARAM_BOOL;
            case 'bool':
                return \PDO::PARAM_BOOL;

            // lob
            case 'lob?':
                return $value === null ? \PDO::PARAM_NULL : \PDO::PARAM_LOB;
            case 'lob':
                return \PDO::PARAM_LOB;

            // fallback to string
            default:
                return \PDO::PARAM_STR;
        }
    }

    // accessor

    /**
     * @return \Doctrine\DBAL\Driver\Connection
     */
    public function getDriver()
    {
        return $this->driver;
    }

    public function getManager()
    {
        return $this->em;
    }
}
