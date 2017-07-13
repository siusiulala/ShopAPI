<?php




class Record extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $rid;
     
    /**
     *
     * @var integer
     */
    public $bid;
     
    /**
     *
     * @var integer
     */
    public $sid;
     
    /**
     *
     * @var integer
     */
    public $pid;
     
    /**
     *
     * @var integer
     */
    public $count;
     
    /**
     *
     * @var integer
     */
    public $date;
     
    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'rid' => 'rid', 
            'bid' => 'bid', 
            'sid' => 'sid', 
            'pid' => 'pid', 
            'count' => 'count', 
            'date' => 'date'
        );
    }

}
