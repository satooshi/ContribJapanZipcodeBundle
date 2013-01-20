<?php

namespace Contrib\JapanZipcodeBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\SerializedName;

/**
 * Contrib\JapanZipcodeBundle\Entity\HomeZipcode
 *
 * @ORM\Table(
 *     name = "w_home_zipcode",
 *     indexes = { @ORM\Index(name = "idx_w_home_zipcode_01", columns = { "zipcode" }) }
 * )
 * @ORM\Entity(
 *     repositoryClass = "Contrib\JapanZipcodeBundle\Repository\WorkHomeZipcodeRepository"
 * )
 */
class WorkHomeZipcode
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
     * @var string $oldZipcode
     *
     * @ORM\Column(name="old_zipcode", type="string", length=5, nullable=false)
     * @Assert\Length(min=5, max=5)
     * @Groups({"list", "detail"})
     */
    protected $oldZipcode;

    /**
     * @var string $jiscode
     *
     * @ORM\Column(name="jiscode", type="string", length=7, nullable=false)
     * @Assert\Length(min=7, max=7)
     * @Groups({"list", "detail"})
     */
    protected $jiscode;

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
     * @return WorkHomeZipcode
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
     * Set oldZipcode.
     *
     * @param string $oldZipcode
     * @return WorkHomeZipcode
     */
    public function setOldZipcode($oldZipcode)
    {
        $this->oldZipcode = $oldZipcode;

        return $this;
    }

    /**
     * Return oldZipcode.
     *
     * @return string
     */
    public function getOldZipcode()
    {
        return $this->oldZipcode;
    }

    /**
     * Set jiscode.
     *
     * @param string $jiscode
     * @return WorkHomeZipcode
     */
    public function setJiscode($jiscode)
    {
        $this->jiscode = $jiscode;

        return $this;
    }

    /**
     * Return jiscode.
     *
     * @return string
     */
    public function getJiscode()
    {
        return $this->jiscode;
    }

    /**
     * Set pref.
     *
     * @param string $pref
     * @return WorkHomeZipcode
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
     * @return WorkHomeZipcode
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
     * @return WorkHomeZipcode
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
