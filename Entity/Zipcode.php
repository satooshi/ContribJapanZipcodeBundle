<?php

namespace Contrib\JapanZipcodeBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\SerializedName;

class Zipcode
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups({"detail"})
     */
    protected $id;

    /**
     * @var string $zipcode
     *
     * @ORM\Column(name="zipcode", type="string", length=7, nullable=false)
     * @Assert\Length(min=7, max=7)
     * @Groups({"list", "detail"})
     */
    protected $zipcode;

    /**
     * @var string $pref
     *
     * @ORM\Column(name="pref", type="string", length=5, nullable=false)
     * @Assert\Length(min=3, max=5)
     * @Groups({"list", "detail"})
     */
    protected $pref;

    /**
     * @var string $city
     *
     * @ORM\Column(name="city", type="string", length=25, nullable=false)
     * @Assert\Length(min=1, max=25)
     * @Groups({"list", "detail"})
     */
    protected $city;

    /**
     * @var string $town
     *
     * @ORM\Column(name="town", type="string", length=50, nullable=true)
     * @Assert\Length(max=50)
     * @Groups({"list", "detail"})
     */
    protected $town;

    // accessor

    /**
     * Return id.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set zipcode.
     *
     * @param string $zipcode
     * @return Zipcode
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    /**
     * Return zipcode.
     *
     * @return string
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Set pref.
     *
     * @param string $pref
     * @return Zipcode
     */
    public function setPref($pref)
    {
        $this->pref = $pref;

        return $this;
    }

    /**
     * Return pref.
     *
     * @return string
     */
    public function getPref()
    {
        return $this->pref;
    }

    /**
     * Set city.
     *
     * @param string $city
     * @return Zipcode
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Return city.
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set town.
     *
     * @param string $town
     * @return Zipcode
     */
    public function setTown($town)
    {
        $this->town = $town;

        return $this;
    }

    /**
     * Return town.
     *
     * @return string
     */
    public function getTown()
    {
        return $this->town;
    }
}
