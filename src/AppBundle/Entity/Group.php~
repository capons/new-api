<?php
namespace AppBundle\Entity;

use Symfony\Component\Security\Core\Role\RoleInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Table(name="user_permission")
 * @ORM\Entity()
 *
 */
class Group
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Expose
     */
    public $id;

    /**
     * @ORM\Column(name="name", type="string", length=30)
     * @JMS\Expose
     * */
    private $name;


    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="groups")
     * @JMS\MaxDepth(1)
     * @JMS\Expose
     *
     */
    private $users;

    //maxdepth -> need for jsm serializer
    /**
     * @ORM\ManyToOne(targetEntity="Role", inversedBy="group")
     * @ORM\JoinColumn(name="role_id", referencedColumnName="id", onDelete="CASCADE")
     * @JMS\Expose
     * @JMS\MaxDepth(1)
     *
     */
    public $user_role;
    public function __construct()
    {
        $this->users = new ArrayCollection();

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
     * Set name
     *
     * @param string $name
     *
     * @return Group
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get userRole
     *
     * @return \AppBundle\Entity\Role
     */

    public function getUserRole()
    {
        return $this->user_role;
    }

    /**
     * Set userRole
     *
     * @param \AppBundle\Entity\Role $userRole
     *
     * @return Group
     */

    public function setUserRole(\AppBundle\Entity\Role $userRole = null)
    {
        $this->user_role = $userRole;
        return $this;
    }


    /**
     * Add user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Group
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
