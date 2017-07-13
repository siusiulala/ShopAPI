<?php




class Product extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $pid;
     
    /**
     *
     * @var string
     */
    public $name;
     
    /**
     *
     * @var integer
     */
    public $stock;
     
    /**
     *
     * @var string
     */
    public $classify;
     
    /**
     *
     * @var integer
     */
    public $price;
     
    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'pid' => 'pid', 
            'name' => 'name', 
            'stock' => 'stock', 
            'classify' => 'classify', 
            'price' => 'price'
        );
    }

}
