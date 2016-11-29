<?php
namespace AppBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as JMS;


/**
 * Country
 * @JMS\ExclusionPolicy("all")
 * @ORM\Table(name="country",options={"collate"="utf8_general_ci"})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CountryRepository")
 */
class Country
{
    /**
     * @return mixed
     */
    public function __toString() {

        return $this->name;
    }
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Expose
     */
    public $id;
    /**
     * @ORM\Column(type="string", length=64)
     * @JMS\Expose
     *
     */
    private $name;
    /**
     * @ORM\Column(type="string", length=10)
     * @JMS\Expose
     */
    private $code;

    /**
     *  @ORM\OneToMany(targetEntity="User", mappedBy="country")
     *
     *
     */

    public $users;

    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getCode()
    {
        return $this->code;
    }
    /**
     * Set name
     *
     * @param string $name
     *
     * @return Country
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    /**
     * Set code
     *
     * @param string $code
     *
     * @return Country
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Country
     */
    public function addUser(\AppBundle\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \AppBundle\Entity\User $user
     */
    public function removeUser(\AppBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }
}
