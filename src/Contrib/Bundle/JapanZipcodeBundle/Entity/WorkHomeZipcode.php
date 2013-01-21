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
 *     name = "w_home_zipcode",
 *     indexes = { @ORM\Index(name = "idx_w_home_zipcode_01", columns = { "zipcode" }) }
 * )
 * @ORM\Entity(
 *     repositoryClass = "Contrib\Bundle\JapanZipcodeBundle\Repository\WorkHomeZipcodeRepository"
 * )
 */
class WorkHomeZipcode extends WorkZipcode
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

    /**
     * @var integer $flg4
     *
     * @ORM\Column(name="flg4", type="integer", nullable=false)
     * @Groups({"detail"})
     */
    protected $flg4;

    /**
     * @var integer $flg5
     *
     * @ORM\Column(name="flg5", type="integer", nullable=false)
     * @Groups({"detail"})
     */
    protected $flg5;

    /**
     * @var integer $flg6
     *
     * @ORM\Column(name="flg6", type="integer", nullable=false)
     * @Groups({"detail"})
     */
    protected $flg6;

    // accessor

    /**
     * Set prefKana.
     *
     * @param string $prefKana
     * @return WorkHomeZipcode
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
     * @return WorkHomeZipcode
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
     * @return WorkHomeZipcode
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

    /**
     * Set flg4.
     *
     * @param integer $flg4
     * @return WorkHomeZipcode
     */
    public function setFlg4($flg4)
    {
        $this->flg4 = $flg4;

        return $this;
    }

    /**
     * Return flg4.
     *
     * @return integer
     */
    public function getFlg4()
    {
        return $this->flg4;
    }

    /**
     * Set flg5.
     *
     * @param integer $flg5
     * @return WorkHomeZipcode
     */
    public function setFlg5($flg5)
    {
        $this->flg5 = $flg5;

        return $this;
    }

    /**
     * Return flg5.
     *
     * @return integer
     */
    public function getFlg5()
    {
        return $this->flg5;
    }

    /**
     * Set flg6.
     *
     * @param integer $flg6
     * @return WorkHomeZipcode
     */
    public function setFlg6($flg6)
    {
        $this->flg6 = $flg6;

        return $this;
    }

    /**
     * Return flg6.
     *
     * @return integer
     */
    public function getFlg6()
    {
        return $this->flg6;
    }
}
