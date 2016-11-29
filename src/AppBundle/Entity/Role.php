<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\MaxDepth;
use JMS\Serializer\Annotation as JMS;

/**
 * Role
 * @JMS\ExclusionPolicy("all")
 * @ORM\Table(name="role")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RoleRepository")
 */
class Role
{
    public function __toString() {
        //if variable return in formbuilder in EntityType::class for example
        return $this->role; //need in choice form type
    }
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Expose
     */
    private $id;
    /**
     * @var string
     *
     * @ORM\Column(name="user_role", type="string", length=50, columnDefinition="enum('ROLE_USER', 'ROLE_ADMIN', 'ROLE_MANAGER')")
     * @JMS\Expose
     */
    private $role;
    /**
     * @ORM\Column(name="role_label", type="string", length=50)
     * @JMS\Expose
     */
    public $role_label;


    /**
     *
     * @ORM\OneToMany(targetEntity="Group", mappedBy="user_role")
     * @JMS\MaxDepth(1)
     *
     */

    public $group;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Set role
     *
     * @param string $role
     *
     * @return Role
     */
    public function setRole($role)
    {
        $this->role = $role;
        return $this;
    }
    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

  

    public function setRoleLabel($roleLabel)
    {
        $this->role_label = $roleLabel;
        return $this;
    }
    /**
     * Get roleLabel
     *
     * @return string
     */

    public function getRoleLabel()
    {
        return $this->role_label;
    }


    /**
     * Add group
     *
     * @param \AppBundle\Entity\Group $group
     *
     * @return Role
     */
    public function addGroup(\AppBundle\Entity\Group $group)
    {
        $this->group[] = $group;

        return $this;
    }

    /**
     * Remove group
     *
     * @param \AppBundle\Entity\Group $group
     */
    public function removeGroup(\AppBundle\Entity\Group $group)
    {
        $this->group->removeElement($group);
    }

    /**
     * Get group
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGroup()
    {
        return $this->group;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->group = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
