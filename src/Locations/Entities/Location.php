<?php


namespace OpenEMR\Locations\Entities;


class Location
{

    /**
     * @Column()
     */
    private $id;

    /**
     * @Column(name="name", "type="string")
     */
    private $name;

    /**
     * @Column(name="abbreviation", type="string")
     */
    private $abbreviation;

    /**
     * @
     */
    private $locationType;

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
