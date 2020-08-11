<?php
/**
 * LocationType Entity
 *
 * @package     OpenEMR
 * @link        http://www.open-emr.org
 * @author      Robert Down <robertdown@live.com>
 * @copyright   Copyright (c) 2020 Robert Down <robertdown@live.com>
 * @license     https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

namespace OpenEMR\Locations\Entities;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Index;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\GeneratedValue;

/**
 * @Table(name="location_types")
 * @package OpenEMR\Locations\Entities
 * @Entity(repositoryClass="OpenEMR\Locations\Repositories\LocationTypeRepository")
 */
class LocationType
{

    /**
     * @Column(name="id", type="")
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Column(name="name", type="string")
     */
    private $name;

    /**
     * @Column(name="active", type="integer")
     */
    private $active;

    /**
     * @Column(name="date_created", type="datetime")
     */
    private $date_created;

    /**
     * @Column(name="date_effective", type="datetime")
     */
    private $date_effective;

    /**
     * @Column(name="date_end", type="datetime")
     */
    private $date_end;

    /**
     * @Column(name="date_replaced", type="datetime")
     */
    private $date_replaced;

    /**
     * @Column(name="operator_code", type="integer")
     */
    private $operator_code;
}
