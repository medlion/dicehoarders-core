<?php


namespace App\Entity\Campaign;


use App\Entity\User\SfUser;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Table(name="campaign")
 * @ORM\Entity()
 * @Serializer\ExclusionPolicy("ALL")
 */
class Campaign
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer"),
     * @ORM\GeneratedValue()
     * @ORM\Id()
     * @Serializer\Groups({"campaigndetailsresponse", "campaignadminsresponse", "campaigndmresponse"})
     * @Serializer\Expose()
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string")
     * @Serializer\Expose()
     * @Serializer\Groups({"campaigncreationrequirement", "campaigndetailsresponse", "characterlisting"})
     * @Serializer\SerializedName("campaign_name")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="join_code", type="string")
     * @Serializer\Expose()
     * @Serializer\Groups({"campaigndetailsresponse"})
     */
    private $joinCode;

    /**
     * @var boolean
     *
     * @ORM\Column(name="join_unlocked", type="boolean")
     */
    private $joinUnlocked;

    /**
     * @var SfUser
     *
     * @ORM\ManyToOne(targetEntity=SfUser::class)
     * @ORM\JoinColumn(name="creator", referencedColumnName="id")
     */
    private $creator;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     * @Serializer\Expose()
     * @Serializer\Groups({"campaigndetailsresponse"})
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * @var array
     *
     * @ORM\ManyToMany(targetEntity=SfUser::class, fetch="EAGER")
     * @ORM\JoinTable(name="campaign_dm", joinColumns=
     *     {@ORM\JoinColumn(name="campaign_id", referencedColumnName="id")},
     *     inverseJoinColumns=
     *     {@ORM\JoinColumn(name="user_id", referencedColumnName="id")}
     * )
     * @Serializer\Expose()
     * @Serializer\Groups({"campaigndmresponse"})
     * @Serializer\Inline()
     */
    private $dms;

    /**
     * @var array
     *
     * @ORM\ManyToMany(targetEntity=SfUser::class, fetch="EAGER")
     * @ORM\JoinTable(name="campaign_admin", joinColumns=
     *     {@ORM\JoinColumn(name="campaign_id", referencedColumnName="id")},
     *     inverseJoinColumns=
     *     {@ORM\JoinColumn(name="user_id", referencedColumnName="id")}
     * )
     * @Serializer\Expose()
     * @Serializer\Groups({"campaignadminsresponse"})
     * @Serializer\Inline()
     */
    private $admins;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getJoinCode()
    {
        return $this->joinCode;
    }

    /**
     * @param string $joinCode
     */
    public function setJoinCode(string $joinCode)
    {
        $this->joinCode = $joinCode;
    }

    /**
     * @return bool
     */
    public function isJoinUnlocked()
    {
        return $this->joinUnlocked;
    }

    /**
     * @param bool $joinUnlocked
     */
    public function setJoinUnlocked(bool $joinUnlocked)
    {
        $this->joinUnlocked = $joinUnlocked;
    }

    /**
     * @return SfUser
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * @param SfUser $creator
     */
    public function setCreator(SfUser $creator)
    {
        $this->creator = $creator;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return array
     */
    public function getDms(): array
    {
        return $this->dms->toArray();
    }

    /**
     * @param array $dms
     */
    public function setDms(array $dms): void
    {
        $this->dms = new ArrayCollection($dms);
    }

    /**
     * @return array
     */
    public function getAdmins(): array
    {
        return $this->admins->toArray();
    }

    /**
     * @param array $admins
     */
    public function setAdmins(array $admins): void
    {
        $this->admins = new ArrayCollection($admins);
    }
}
