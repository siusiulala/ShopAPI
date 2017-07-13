<?php




class Store extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $sid;
     
    /**
     *
     * @var string
     */
    public $name;
     
    /**
     *
     * @var string
     */
    public $address;
     
    /**
     *
     * @var string
     */
    public $tel;
     
    /**
     *
     * @var integer
     */
    public $startTime;
     
    /**
     *
     * @var integer
     */
    public $endTime;
     
    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'sid' => 'sid', 
            'name' => 'name', 
            'address' => 'address', 
            'tel' => 'tel', 
            'startTime' => 'startTime', 
            'endTime' => 'endTime'
        );
    }

}
