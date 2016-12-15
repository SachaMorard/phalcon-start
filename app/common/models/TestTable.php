<?php
namespace Models;

/**
 * Class TestTable
 * @package PhalconStart\Models
 *
 * @Source('dbMysql', 'testTable')
 */
class TestTable extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    public $id;

    /**
     *
     * @var string
     * @Column(type="string", length=45, nullable=false)
     */
    public $value;


    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return TestTable[]|TestTable
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return TestTable
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
