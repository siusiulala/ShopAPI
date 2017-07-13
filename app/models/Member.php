<?php




class Member extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $memberID;
     
    /**
     *
     * @var string
     */
    public $type;
     
    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'memberID' => 'memberID', 
            'type' => 'type'
        );
    }

}
