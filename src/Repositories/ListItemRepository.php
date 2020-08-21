<?php


namespace OpenEMR\Repositories;

use Doctrine\ORM\EntityRepository;
use OpenEMR\Lists\Entity\ListItem;

class ListItemRepository extends EntityRepository
{

//    protected $_entityName = "ListItem";

    /**
     * @param $list_id string
     * @param $option_id string
     * @return ListItem
     */
    public function getListItem($list_id, $option_id): ListItem
    {
        $r = $this->_em
            ->getRepository($this->_entityName)
            ->findOneBy(["list_id" => $list_id, "option_id" => $option_id]);
        return $r;
    }

    public function getListItems($list_id)
    {
        $r = $this->_em
            ->getRepository($this->_entityName)
            ->findBy(["list_id" => $list_id], ["seq"]);
        return $r;
    }

    public function getLists()
    {
        $r = $this->_em
            ->getRepository($this->_entityName)
            ->findBy(["list_id" => "lists"], ["seq"]);
        return $r;
    }
}
