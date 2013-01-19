<?php

namespace Contrib\JapanZipcodeBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\SerializedName;

/**
 * Contrib\JapanZipcodeBundle\Entity\HomeZipcode
 *
 * @ORM\Table(name="home_zip_code")
 * @ORM\Entity(repositoryClass="Contrib\JapanZipcodeBundle\Repository\HomeZipcodeRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class HomeZipcode
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups({"detail"})
     */
    private $id;

    /**
     * @var string $zipcode
     *
     * @ORM\Column(name="zipcode", type="string", length=7, nullable=false)
     * @Assert\Length(min=7, max=7)
     * @Groups({"list", "detail"})
     */
    private $zipcode;

    /**
     * @var string $pref
     *
     * @ORM\Column(name="pref", type="string", length=5, nullable=false)
     * @Assert\Length(min=3, max=5)
     * @Groups({"list", "detail"})
     */
    private $pref;

    /**
     * @var string $city
     *
     * @ORM\Column(name="city", type="string", length=25, nullable=false)
     * @Assert\Length(min=1, max=25)
     * @Groups({"list", "detail"})
     */
    private $city;

    /**
     * @var string $town
     *
     * @ORM\Column(name="town", type="string", length=50, nullable=true)
     * @Assert\Length(max=50)
     * @Groups({"list", "detail"})
     */
    private $town;

    /**
     * @var string $prefKana
     *
     * @ORM\Column(name="pref_kana", type="string", length=10, nullable=false)
     * @Assert\Length(min=1, max=10)
     * @Groups({"list", "detail"})
     * @SerializedName("prefKana")
     */
    private $prefKana;

    /**
     * @var string $cityKana
     *
     * @ORM\Column(name="city_kana", type="string", length=30, nullable=false)
     * @Assert\Length(min=1, max=30)
     * @Groups({"list", "detail"})
     * @SerializedName("cityKana")
     */
    private $cityKana;

    /**
     * @var string $townKana
     *
     * @ORM\Column(name="town_kana", type="string", length=100, nullable=true)
     * @Assert\Length(max=100)
     * @Groups({"list", "detail"})
     * @SerializedName("townKana")
     */
    private $townKana;

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
     * @return HomeZipcode
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
     * @return HomeZipcode
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
     * @return HomeZipcode
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
     * @return HomeZipcode
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

    /**
     * Set prefKana.
     *
     * @param string $prefKana
     * @return HomeZipcode
     */
    public function setPrefKana($prefKana)
    {
        $this->prefKana = $prefKana;

        return $this;
    }

    /**
     * Return prefKana.
     *
     * @return string
     */
    public function getPrefKana()
    {
        return $this->prefKana;
    }

    /**
     * Set cityKana.
     *
     * @param string $cityKana
     * @return HomeZipcode
     */
    public function setCityKana($cityKana)
    {
        $this->cityKana = $cityKana;

        return $this;
    }

    /**
     * Return cityKana.
     *
     * @return string
     */
    public function getCityKana()
    {
        return $this->cityKana;
    }

    /**
     * Set townKana.
     *
     * @param string $townKana
     * @return HomeZipcode
     */
    public function setTownKana($townKana)
    {
        $this->townKana = $townKana;

        return $this;
    }

    /**
     * Return townKana.
     *
     * @return string
     */
    public function getTownKana()
    {
        return $this->townKana;
    }
}
