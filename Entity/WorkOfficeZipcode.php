<?php

namespace Contrib\JapanZipcodeBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\SerializedName;

/**
 * Contrib\JapanZipcodeBundle\Entity\WorkOfficeZipcode
 *
 * @ORM\Table(
 *     name = "w_office_zipcode",
 *     indexes = { @ORM\Index(name = "idx_w_office_zipcode_01", columns = { "zipcode" }) }
 * )
 * @ORM\Entity(
 *     repositoryClass = "Contrib\JapanZipcodeBundle\Repository\WorkOfficeZipcodeRepository"
 * )
 */
class WorkOfficeZipcode extends WorkZipcode
{
    /**
     * @var string $street
     *
     * @ORM\Column(name="street", type="string", length=125, nullable=true)
     * @Assert\Length(max=125)
     * @Groups({"list", "detail"})
     */
    protected $street;

    /**
     * @var string $officeName
     *
     * @ORM\Column(name="office_name", type="string", length=160, nullable=true)
     * @Assert\Length(max=160)
     * @Groups({"list", "detail"})
     * @SerializedName("officeName")
     */
    protected $officeName;

    /**
     * @var string $officeNameKana
     *
     * @ORM\Column(name="office_name_kana", type="string", length=100, nullable=true)
     * @Assert\Length(max=100)
     * @Groups({"list", "detail"})
     * @SerializedName("officeNameKana")
     */
    protected $officeNameKana;

    /**
     * @var string $branchName
     *
     * @ORM\Column(name="branch_name", type="string", length=40, nullable=true)
     * @Assert\Length(max=40)
     * @Groups({"list", "detail"})
     * @SerializedName("branchName")
     */
    protected $branchName;

    /**
     * @var integer $flg1
     *
     * @ORM\Column(name="flg1", type="integer", nullable=false)
     * @Groups({"detail"})
     */
    protected $flg1;

    /**
     * @var integer $flg2
     *
     * @ORM\Column(name="flg2", type="integer", nullable=false)
     * @Groups({"detail"})
     */
    protected $flg2;

    /**
     * @var integer $flg3
     *
     * @ORM\Column(name="flg3", type="integer", nullable=false)
     * @Groups({"detail"})
     */
    protected $flg3;

    // accessor

    /**
     * Set street.
     *
     * @param string $street
     * @return WorkOfficeZipcode
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Return street.
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set officeName.
     *
     * @param string $officeName
     * @return WorkOfficeZipcode
     */
    public function setOfficeName($officeName)
    {
        $this->officeName = $officeName;

        return $this;
    }

    /**
     * Return officeName.
     *
     * @return string
     */
    public function getOfficeName()
    {
        return $this->officeName;
    }

    /**
     * Set officeNameKana.
     *
     * @param string $officeNameKana
     * @return WorkOfficeZipcode
     */
    public function setOfficeNameKana($officeNameKana)
    {
        $this->officeNameKana = $officeNameKana;

        return $this;
    }

    /**
     * Return officeNameKana.
     *
     * @return string
     */
    public function getOfficeNameKana()
    {
        return $this->officeNameKana;
    }

    /**
     * Set branchName.
     *
     * @param string $branchName
     * @return WorkOfficeZipcode
     */
    public function setBranchName($branchName)
    {
        $this->branchName = $branchName;

        return $this;
    }

    /**
     * Return branchName.
     *
     * @return string
     */
    public function getBranchName()
    {
        return $this->branchName;
    }

    /**
     * Set flg1.
     *
     * @param integer $flg1
     * @return WorkHomeZipcode
     */
    public function setFlg1($flg1)
    {
        $this->flg1 = $flg1;

        return $this;
    }

    /**
     * Return flg1.
     *
     * @return integer
     */
    public function getFlg1()
    {
        return $this->flg1;
    }

    /**
     * Set flg2.
     *
     * @param integer $flg2
     * @return WorkHomeZipcode
     */
    public function setFlg2($flg2)
    {
        $this->flg2 = $flg2;

        return $this;
    }

    /**
     * Return flg2.
     *
     * @return integer
     */
    public function getFlg2()
    {
        return $this->flg2;
    }

    /**
     * Set flg3.
     *
     * @param integer $flg3
     * @return WorkHomeZipcode
     */
    public function setFlg3($flg3)
    {
        $this->flg3 = $flg3;

        return $this;
    }

    /**
     * Return flg3.
     *
     * @return integer
     */
    public function getFlg3()
    {
        return $this->flg3;
    }
}
