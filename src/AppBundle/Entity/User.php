<?php
namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use AppBundle\Entity\Country;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\Address;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use JMS\Serializer\Annotation as JMS;

//Exclusion -> ddisplay only fields with this tag -> @JMS\Expose
/**
 * User
 * @JMS\ExclusionPolicy("all")
 * @ORM\Table(name="user",options={"collate"="utf8_general_ci"})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User implements  AdvancedUserInterface , \Serializable
{
    public function __construct()
    {
        //set default Entity variable
        $this->isActive = true;
        //for user permission gtoup;
        $this->groups = new ArrayCollection();
    }
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Expose
     */
    public $id;
    /**
     * @ORM\Column(type="string", length=25)
     * @Assert\NotNull(message="You have to choose a username (this is my custom validation message).")
     *  @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Your name cannot contain a number"
     * )
     * @JMS\Expose
     */
    private $username;
    /**
     * @ORM\Column(type="string", length=64)
     * @Assert\NotNull(message="Password error (this is my custom validation message).")
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Your password must be at least {{ limit }} characters long",
     *      maxMessage = "Your password cannot be longer than {{ limit }} characters"
     * )
     */
    private $password;
    //user permission group (relation with Group entity)
    //@Jms\Expose -> display only with field
    /**
     * @ORM\ManyToMany(targetEntity="Group", inversedBy="users",cascade={"persist", "remove"}))
     * @ORM\JoinTable(name="user_group",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id",onDelete="cascade")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id",onDelete="cascade")}
     * )
     *@JMS\Expose
     *@JMS\MaxDepth(1)
     * 
     *
     */
    private $groups;
    /**
     * @ORM\Column(type="string", length=60)
     * @Assert\NotNull(message="Please enter email address")
     * @Assert\Email(message = "The email '{{ value }}' is not a valid email.", checkMX = true )
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Your password must be at least {{ limit }} characters long",
     *      maxMessage = "Your password cannot be longer than {{ limit }} characters"
     * )
     * @JMS\Expose
     */
    private $email;
    //related with entity Address
    /**
     * @ORM\ManyToOne(targetEntity="Address", inversedBy="users", cascade={"remove"})
     * @ORM\JoinColumn(name="address_id", referencedColumnName="id", onDelete="CASCADE")
     * @JMS\Expose
     */
    private $address;
    //variable to get address
    /**
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Your password must be at least {{ limit }} characters long",
     *      maxMessage = "Your password cannot be longer than {{ limit }} characters"
     * )
     */
    private $addre;
    /**
     * @ORM\Column(name="is_active", type="boolean")
     * @JMS\Expose
     */
    private $isActive;
    //related with entity Country
    /**
     * @ORM\ManyToOne(targetEntity="Country", inversedBy="users")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     * @JMS\Expose
     */
    private $country;

    //relation with entity Image
    /**
     * @ORM\ManyToOne(targetEntity="Image", inversedBy="users", cascade={"remove"})
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id", onDelete="CASCADE")
     * @JMS\Expose
     */
    private $image;
    public function eraseCredentials()
    {
    }
    //if return false -> user set permission with zero access
    public function isAccountNonExpired()
    {
        return true;
    }
    public function isAccountNonLocked()
    {
        return true;
    }
    public function isCredentialsNonExpired()
    {
        return true;
    }
    public function isEnabled()
    {
        return $this->isActive;
    }
    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }
    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized);
    }
    /**
     * @param $roles
     * @return string
     */
    public function setRoles($roles)
    {
        //  $this->roles = $roles;
        //  return $this->roles;
    }
    /**
     * @return array
     */
    public function getRoles()
    {
        // return array($this->roles);
        return $this->groups->toArray();
    }
    /**
     * @return null
     */
    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }
    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }
    /**
     * @param $password
     * @return mixed
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this->password;
    }
    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }
    /**
     * @param $username
     * @return mixed
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this->username;
    }
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
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }
    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
        return $this;
    }
    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }


    /**
     * Set address
     *
     * @param \AppBundle\Entity\Address $address
     *
     * @return User
     */
    public function setAddress(\AppBundle\Entity\Address $address = null)
    {
        $this->address = $address;
        return $this;
    }
    /**
     * Get address
     *
     * @return \AppBundle\Entity\Address
     */
    public function getAddress()
    {
        return $this->address;
    }
    /**
     * Set country
     *
     * @param \AppBundle\Entity\Country $country
     *
     * @return User
     */
    public function setCountry(\AppBundle\Entity\Country $country = null)
    {
        $this->country = $country;
        return $this;
    }
    /**
     * Get country
     *
     * @return \AppBundle\Entity\Country
     */
    public function getCountry()
    {
        return $this->country;
    }
    /**
     * @return mixed
     * get user address
     */
    public function getAddre()
    {
        return $this->addre;
    }
    /**
     * @param $address
     * @return mixed
     * set user address
     */
    public function setAddre($address)
    {
        return $this->addre = $address;
    }
    /**
     * Add group
     *
     * @param \AppBundle\Entity\Group $group
     *
     * @return User
     */
    public function addGroup(\AppBundle\Entity\Group $group)
    {
        $this->groups[] = $group;
        return $this;
    }
    /**
     * Remove group
     *
     * @param \AppBundle\Entity\Group $group
     */
    public function removeGroup(\AppBundle\Entity\Group $group)
    {
        $this->groups->removeElement($group);
    }
    /**
     * Get groups
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * Set image
     *
     * @param \AppBundle\Entity\Image $image
     *
     * @return User
     */
    public function setImage(\AppBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \AppBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }
}
