<?php

namespace Contrib\Bundle\JapanZipcodeBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use JMS\SerializerBundle\Annotation\Groups;
use JMS\SerializerBundle\Annotation\SerializedName;

/**
 * Contrib\Bundle\JapanZipcodeBundle\Entity\HomeZipcode
 *
 * @ORM\Table(
 *     name = "home_zipcode",
 *     indexes = { @ORM\Index(name = "idx_home_zipcode_01", columns = { "zipcode" }) }
 * )
 * @ORM\Entity(
 *     repositoryClass = "Contrib\Bundle\JapanZipcodeBundle\Repository\HomeZipcodeRepository"
 * )
 */
class HomeZipcode extends Zipcode
{
    /**
     * @var string $prefKana
     *
     * @ORM\Column(name="pref_kana", type="string", length=10, nullable=false)
     * @Assert\Length(min=1, max=10)
     * @Groups({"list", "detail"})
     * @SerializedName("prefKana")
     */
    protected $prefKana;

    /**
     * @var string $cityKana
     *
     * @ORM\Column(name="city_kana", type="string", length=30, nullable=false)
     * @Assert\Length(min=1, max=30)
     * @Groups({"list", "detail"})
     * @SerializedName("cityKana")
     */
    protected $cityKana;

    /**
     * @var string $townKana
     *
     * @ORM\Column(name="town_kana", type="string", length=100, nullable=true)
     * @Assert\Length(max=100)
     * @Groups({"list", "detail"})
     * @SerializedName("townKana")
     */
    protected $townKana;

    // accessor

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
