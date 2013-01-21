<?php

namespace Contrib\Bundle\JapanZipcodeBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\SerializedName;

/**
 * Contrib\Bundle\JapanZipcodeBundle\Entity\OfficeZipcode
 *
 * @ORM\Table(
 *     name = "office_zipcode",
 *     indexes = { @ORM\Index(name = "idx_office_zipcode_01", columns = { "zipcode" }) }
 * )
 * @ORM\Entity(
 *     repositoryClass = "Contrib\Bundle\JapanZipcodeBundle\Repository\OfficeZipcodeRepository"
 * )
 */
class OfficeZipcode extends Zipcode
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

    // accessor

    /**
     * Set street.
     *
     * @param string $street
     * @return OfficeZipcode
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
     * @return OfficeZipcode
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
     * @return OfficeZipcode
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
     * @return OfficeZipcode
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
}
