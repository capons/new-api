<?php
namespace AppBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as JMS;


/**
 * @JMS\ExclusionPolicy("all")
 * @ORM\Table(options={"collate"="utf8_general_ci"})
 * @ORM\Entity
 */
class Address
{

    /**
     * @return mixed
     */
    public function __toString() {
        //if variable return in formbuilder in EntityType::class for example
        // return $this->address;
    }
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Expose
     *
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=60)
     * @JMS\Expose
     */
    private $address;



    /**
     *  @ORM\OneToMany(targetEntity="User", mappedBy="address")
     *
     */

    public $users;
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Set address
     *
     * @param string $address
     *
     * @return Address
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }
    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
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
     * @return Address
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
