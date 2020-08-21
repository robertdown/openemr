<?php


namespace OpenEMR\Services;

use OpenEMR\Common\Database\Connector;
use Doctrine\ORM\EntityManager;
use OpenEMR\Lists\Entity\ListItem;
use OpenEMR\Lists\Repositories\ListItemRepository;

class ListNewService
{

    /**
     * @var ListItemRepository
     */
    private $repository;

    public function __construct()
    {
        $db = Connector::Instance();

        /**
         * @var EntityManager
         */
        $em = $db->entityManager;
        $this->repository = $em->getRepository('\OpenEMR\Repositories\ListItemRepository');
    }

    /**
     * @param $list_id string
     * @param $option_id string
     * @return ListItem
     */
    public function getListItem($list_id, $option_id)
    {
        return $this->repository->getListItem($list_id, $option_id);
    }

    public function getAllListItems($list_id)
    {
        return $this->repository->getAllListItems($list_id);
    }

    public function getLists()
    {
        return $this->repository->getLists();
    }

}
