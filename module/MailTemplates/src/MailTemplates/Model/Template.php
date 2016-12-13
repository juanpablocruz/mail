<?php
namespace MailTemplates\Model;


use BjyAuthorize\Provider\Role\ProviderInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ZfcUser\Entity\UserInterface;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="templates")
 */
class Template implements MailTemplateInterface, InputFilterAwareInterface
{
  protected $inputFilter;
  /**
   * [$id description]
   * @var int
   * @ORM\id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;
  /**
   * [$nombre description]
   * @var string
   * @ORM\Column(type="string", length=255)
   */
  protected $name;

  /**
   * [$partials description]
   * @var \Doctrine\Common\Collections\Collection
   * @ORM\ManyToMany(targetEntity="\MailPartials\Entity\partial")
   * @ORM\JoinTable(name="templates_partials",
   *      joinColumns={@ORM\JoinColumn(name="id_t", referencedColumnName="id",onDelete="CASCADE")},
   *      inverseJoinColumns={@ORM\JoinColumn(name="id_p", referencedColumnName="id")}
   *    )
   */
  protected $partials;

    /**
     * Get the value of Id
     *
     * @return mixed
     */
    public function getId():int
    {
        return $this->id;
    }

    /**
     * Set the value of Id
     *
     * @param mixed id
     *
     * @return self
     */
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of Title
     *
     * @return mixed
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Set the value of Name
     *
     * @param mixed nombre
     *
     * @return self
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    public function setPartials($partial)
    {
      $this->partials = $partial;
    }

    public function getPartials()
    {
      return $this->partials;
    }

    public function addPartial($partial)
    {
      \Zend\Debug\Debug::dump($this->partials);die();
      $this->partials = array_push($this->partials, $partial) ?? array($partial);
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

    public function exchangeArray($data = array())
    {
      $this->id = $data["id"];
      $this->name = $data["name"];
      $this->partials = [$data["partial"]];

    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
      if (!$this->inputFilter) {
            $inputFilter = new InputFilter();

            $inputFilter->add(array(
                'name'     => 'id',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'name',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            ));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}
