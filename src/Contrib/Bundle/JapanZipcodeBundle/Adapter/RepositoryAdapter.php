<?php

namespace Contrib\Bundle\JapanZipcodeBundle\Adapter;

abstract class RepositoryAdapter
{
    const TABLE_NAME = '';

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * @var \PDO
     */
    protected $driver;

    /**
     * @var \PDOStatement
     */
    protected $statement;

    /**
     * Cached SQL.
     *
     * @var string
     */
    protected $sql;

    public function __construct($em)
    {
        $this->em = $em;
        $this->driver = $this->em->getConnection()->getWrappedConnection();
    }

    // prepared statement

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

    protected function bindParams(array $params)
    {
        foreach ($params as $key => $values) {
            if (!isset($values[0])) {
                continue;
            }

            if (isset($values[1])) {
                $type = $values[1];

                $this->statement->bindParam($key, $values[0], $this->getBindType($type, $values[0]));
            } else {
                $this->statement->bindParam($key, $values[0]);
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

    protected function useCache($useCachedSql)
    {
        return isset($this->sql) && $useCachedSql;
    }

    // statement

    /**
     * Execute prepared statement.
     *
     * @param string $sql
     * @param array  $params
     * @return PDOStatement
     * @throws \RuntimeException
     */
    protected function executeStatement($sql, array $params = array())
    {
        if (!isset($this->statement) || $this->statement->queryString !== $sql) {
            $this->statement = $this->prepare($sql);
        }

        $this->bindParams($params);

        if ($this->statement->execute() === false) {
            throw new \RuntimeException();
        }

        return $this->statement;
    }

    /**
     * Execute scalar query.
     *
     * @param string $sql
     * @param array  $params
     * @return integer Scalar result.
     */
    protected function executeScalar($sql, array $params = array())
    {
        $scalar = $this->executeStatement($sql, $params)->fetchColumn(0);

        if (is_numeric($scalar)) {
            return (int)$scalar;
        }

        return 0;
    }

    /**
     * Execute insert, update, delete statement.
     *
     * @param string $sql
     * @param array  $params
     * @return integer Affected rows.
     */
    protected function executeUpdate($sql, array $params = array())
    {
        return $this->executeStatement($sql, $params)->rowCount();
    }

    /**
     * Execute count query.
     *
     * @return integer
     */
    protected function count()
    {
        $sql = sprintf('select count(*) count from %s', static::TABLE_NAME);

        return $this->executeScalar($sql);
    }

    /**
     * Execute insert statement.
     *
     * @param array  $params [col1 => value1, col2 => value2]
     * @param array  $types  [col1 => type1, col2 => type2]
     * @return integer Affected rows.
     */
    protected function insert($params, $types = array(), $useCachedSql = false)
    {
        if (!$this->useCache($useCachedSql)) {
            $this->sql = sprintf(
                "insert into %s (%s) values (%s)",
                static::TABLE_NAME,
                implode(', ', array_keys($params)),
                implode(', ', array_map(function ($param) { return '?';}, $params))
            );
        }

        $bindParams = $this->createBindParams($params, $types);

        return $this->executeUpdate($this->sql, $bindParams);
    }

    /**
     * Execute multiple insert statement.
     *
     * @param array  $params [col1 => value1, col2 => value2]
     * @param array  $types  [col1 => type1, col2 => type2]
     * @return integer Affected rows.
     */
    protected function multipleInsert($params, $types = array(), $useCachedSql = false)
    {
        if (count($params) === 0) {
            return 0;
        }

        $valuesPlaceHolders = array(); // ['(?, ?, ...)', '(?, ?, ...)']
        $bindParams = array();

        foreach ($params as $entityParams) {
            if (!$this->useCache($useCachedSql)) {
                $values = implode(', ', array_map(function ($param) { return '?';}, $entityParams));
                $valuesPlaceHolders[] = sprintf('(%s)', $values);
            }

            $index = count($bindParams) + 1;
            $bindParams += $this->createBindParams($entityParams, $types, $index);
        }

        if (!$this->useCache($useCachedSql)) {
            $this->sql = sprintf(
                "insert into %s (%s) values %s",
                static::TABLE_NAME,
                implode(', ', array_keys($params[0])),
                implode(', ', $valuesPlaceHolders)
            );
        }

        return $this->executeUpdate($this->sql, $bindParams);
    }

    /**
     * Return last insert id.
     *
     * @return mixed.
     */
    protected function getLastInsertId()
    {
        return $this->driver->lastInsertId();
    }

    /**
     * Execute update statement.
     *
     * @param array  $params          [col1 => value1, col2 => value2]
     * @param array  $types           [col1 => type1, col2 => type2]
     * @param array  $identifiers     [col1 => value1, col2 => value2]
     * @param array  $identifierTypes [col1 => type1, col2 => type2]
     * @return integer Affected rows.
     */
    protected function update($params, $types = array(), $identifiers = array(), $identifierTypes = array(), $useCachedSql = false)
    {
        if (!$this->useCache($useCachedSql)) {
            $sql = sprintf(
                "update %s set %s",
                static::TABLE_NAME,
                implode(', ', array_keys($params)),
                implode(', ', array_map(function ($param) { return '?';}, $params))
            );
        }

        $updateParams = $this->createBindParams($params, $types);

        if (count($identifiers) > 0) {
            if (!$this->useCache($useCachedSql)) {
                $this->sql = sprintf(
                    "%s where %s",
                    $sql,
                    implode(' and ', $this->createIdentifiers($identifiers))
                );
            }

            $index = count($updateParams) + 1;
            $idBindParams = $this->createBindParams($identifiers, $identifierTypes, $index);
            $bindParams = $updateParams + $idBindParams;
        } else {
            $bindParams = $updateParams;

            if (!$this->useCache($useCachedSql)) {
                $this->sql = $sql;
            }
        }

        return $this->executeUpdate($this->sql, $bindParams);
    }

    /**
     * Execute delete statement.
     *
     * @param array  $identifiers     [col1 => value1, col2 => value2]
     * @param array  $identifierTypes [col1 => type1, col2 => type2]
     * @return integer
     */
    protected function delete($identifiers = array(), $identifierTypes = array(), $useCachedSql = false)
    {
        if (!$this->useCache($useCachedSql)) {
            $sql = sprintf("delete from %s", static::TABLE_NAME);
        }

        if (count($identifiers) > 0) {
            if (!$this->useCache($useCachedSql)) {
                $this->sql = sprintf(
                    "%s where %s",
                    $sql,
                    implode(' and ', $this->createIdentifiers($identifiers))
                );
            }

            $bindParams = $this->createBindParams($identifiers, $identifierTypes);
        } else {
            $bindParams = array();

            if (!$this->useCache($useCachedSql)) {
                $this->sql = $sql;
            }
        }

        return $this->executeUpdate($this->sql, $bindParams);
    }

    /**
     * Execute truncate statement.
     *
     * @return integer
     */
    protected function truncate()
    {
        $sql = sprintf('truncate %s', static::TABLE_NAME);

        return $this->driver->exec($sql);
    }

    // utils

    protected function createBindParams($params, $types = array(), $index = 1)
    {
        $bindParams = array();

        foreach ($params as $columnName => $value) {
            if (is_array($value) && count($value) > 0) {
                $type = isset($types[$columnName]) ? $types[$columnName] : 'string?';

                foreach ($value as $v) {
                    $bindParams[$index] = array($v, $type);
                }
            } else {
                $type = isset($types[$columnName]) ? $types[$columnName] : 'string?';
                $bindParams[$index] = array($value, $type);
            }

            $index++;
        }

        return $bindParams;
    }

    /**
     * @param array $identifiers [col1 => value1, col2 => value2]
     * @return array
     */
    protected function createIdentifiers($identifiers = array())
    {
        $ids = array();

        foreach ($identifiers as $columnName => $value) {
            if (is_array($value) && count($value) > 0) {
                $values = implode(', ', array_map(function ($v) { return '?';}, $value));
                $ids[] = sprintf('%s in (%s)', $columnName, implode(', ', $values));
            } else {
                $ids[] = sprintf('%s = ?', $columnName);
            }
        }

        return $ids;
    }

    // accessor

    /**
     * @return \Doctrine\DBAL\Driver\Connection
     */
    public function getDriver()
    {
        return $this->driver;
    }

    public function getStatement()
    {
        return $this->statement;
    }

    public function getManager()
    {
        return $this->em;
    }
}
