<?php
namespace MailTemplates\Mapper;

use MailTemplates\Model\MailTemplateInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Delete;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Update;
use Zend\Stdlib\Hydrator\HydratorInterface;

class SqlMapper implements MailTemplateMapperInterface
{
  protected $dbAdapter;
  protected $hydrator;
  protected $templatePrototype;

  public function __construct(
    AdapterInterface $dbAdapter,
    HydratorInterface $hydrator,
    MailTemplateInterface $templatePrototype
    )
  {
    $this->dbAdapter = $dbAdapter;
    $this->hydrator = $hydrator;

    $this->templatePrototype = $templatePrototype;
  }

  public function find($id){

  }

  public function findAll()
  {

    $sql = new Sql($this->dbAdapter);
    $select = $sql->select('templates');

    $stmt   = $sql->prepareStatementForSqlObject($select);
    $result = $stmt->execute();

    if($result instanceof ResultInterface && $result->isQueryResult())
    {

      $resultSet = new HydratingResultSet($this->hydrator,
                                          $this->templatePrototype);

      return $resultSet->initialize($result);
    }
    return [];
  }

  public function edit(MailTemplateInterface $template)
  {

  }

  public function delete(MailTemplateInterface $template)
  {

  }
}
