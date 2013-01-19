<?php

namespace Contrib\JapanZipcodeBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;
use Contrib\JapanZipcodeBundle\Adapter\HomeZipcode\FindByZipcode;

class HomeZipcodeRepository extends EntityRepository
{
    /**
     * @param string  $zipcode
     * @param integer $limit
     * @param integer $offset
     * @return array
     */
    public function findByZipcode($zipcode, $limit = 100, $offset = 0)
    {
        $adapter = new FindByZipcode($this->_em);

        return $adapter
            ->execute($zipcode, $limit, $offset)
            ->fetchAll(\PDO::FETCH_CLASS, 'Contrib\JapanZipcodeBundle\Entity\HomeZipcode');
    }
}
