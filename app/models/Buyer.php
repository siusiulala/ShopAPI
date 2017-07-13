<?php




class Buyer extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $bid;
     
    /**
     *
     * @var string
     */
    public $name;
     
    /**
     *
     * @var integer
     */
    public $age;
     
    /**
     *
     * @var string
     */
    public $address;
     
    /**
     *
     * @var string
     */
    public $sex;
     
    /**
     *
     * @var integer
     */
    public $memberID;
     
    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'bid' => 'bid', 
            'name' => 'name', 
            'age' => 'age', 
            'address' => 'address', 
            'sex' => 'sex', 
            'memberID' => 'memberID'
        );
    }

}
