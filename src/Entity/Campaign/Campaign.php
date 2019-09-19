<?php


namespace App\Entity\Campaign;


use App\Entity\User\SfUser;
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
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string")
     * @Serializer\Expose()
     * @Serializer\Groups({"campaigncreationrequirement", "campaigndetailsresponse"})
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
     * @var SfUser
     *
     * @ORM\Column(name="creator", type="integer")
     * @ORM\OneToMany(targetEntity=SfUser::class, mappedBy="id")
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



}
