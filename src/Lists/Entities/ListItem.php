<?php

namespace OpenEMR\Lists\Entity;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;

/**
 * Class ListItem
 * @package OpenEMR\Lists
 * @subpackage Entity
 * @Table(name="list_options")
 * @Entity(repositoryClass="OpenEMR\Lists\Repositories\ListItemRepository")
 */
class ListItem
{

    /**
     * List ID this option belongs to
     * @var string
     * @Column(type="string", length="100")
     */
    private $list_id;

    /**
     * Option ID as defined by the user.
     * @var string
     * @Column(type="string", length="100")
     */
    private $option_id;

    /**
     * Title of the option.
     * @var string
     * @Column(type="string", length="255")
     */
    private $title;

    /**
     * Sequence of the item in the list.
     * @var integer
     * @Column(type="integer", length="11")
     */
    private $seq;

    /**
     * Default item flag.
     * @var integer
     * @Column(type="smallint", length="1")
     */
    private $is_default;

    /**
     * Option Value.
     * @var float
     * @Column(type="float")
     */
    private $option_value;

    /**
     * Mapping
     * @var string
     * @Column(type="string", length="31")
     */
    private $mapping;

    /**
     * Notes for the list item.
     * @var string
     * @Column(type="text")
     */
    private $notes;

    /**
     * Codes associated with the list item.
     * @var string
     * @Column(type="string", length="255)
     */
    private $codes;

    /**
     * Toggle setting 1
     * @var integer
     * @Column(type="smallint", length="1")
     */
    private $toggle_setting_1;

    /**
     * Toggle setting 2
     * @var integer
     * @Column(type="smallint", length="1")
     */
    private $toggle_setting_2;

    /**
     * Activity
     * @var integer
     * @Column(type="smallint", length="1")
     */
    private $activity;

    /**
     * Subtype
     * @var string
     * @Column(type="string" length="31")
     */
    private $subtype;

    /**
     * Edit Options
     * @var integer
     * @Column(type="smallint" length="1")
     */
    private $edit_options;

    /**
     * Timestamp of last change
     * @var string
     * @Column(type="datetime_immutable")
     */
    private $timestamp;

    /**
     * @return string
     */
    public function getListId()
    {
        return $this->list_id;
    }

    /**
     * @param string $list_id
     * @return ListItem
     */
    public function setListId($list_id): string
    {
        $this->list_id = $list_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getOptionId(): string
    {
        return $this->option_id;
    }

    /**
     * @param string $option_id
     * @return ListItem
     */
    public function setOptionId(string $option_id): ListItem
    {
        $this->option_id = $option_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return ListItem
     */
    public function setTitle(string $title): ListItem
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return int
     */
    public function getSeq(): int
    {
        return $this->seq;
    }

    /**
     * @param int $seq
     * @return ListItem
     */
    public function setSeq(int $seq): ListItem
    {
        $this->seq = $seq;
        return $this;
    }

    /**
     * @return int
     */
    public function getIsDefault(): int
    {
        return $this->is_default;
    }

    /**
     * @param int $is_default
     * @return ListItem
     */
    public function setIsDefault(int $is_default): ListItem
    {
        $this->is_default = $is_default;
        return $this;
    }

    /**
     * @return float
     */
    public function getOptionValue(): float
    {
        return $this->option_value;
    }

    /**
     * @param float $option_value
     * @return ListItem
     */
    public function setOptionValue(float $option_value): ListItem
    {
        $this->option_value = $option_value;
        return $this;
    }

    /**
     * @return string
     */
    public function getMapping(): string
    {
        return $this->mapping;
    }

    /**
     * @param string $mapping
     * @return ListItem
     */
    public function setMapping(string $mapping): ListItem
    {
        $this->mapping = $mapping;
        return $this;
    }

    /**
     * @return string
     */
    public function getNotes(): string
    {
        return $this->notes;
    }

    /**
     * @param string $notes
     * @return ListItem
     */
    public function setNotes(string $notes): ListItem
    {
        $this->notes = $notes;
        return $this;
    }

    /**
     * @return string
     */
    public function getCodes(): string
    {
        return $this->codes;
    }

    /**
     * @param string $codes
     * @return ListItem
     */
    public function setCodes(string $codes): ListItem
    {
        $this->codes = $codes;
        return $this;
    }

    /**
     * @return int
     */
    public function getToggleSetting1(): int
    {
        return $this->toggle_setting_1;
    }

    /**
     * @param int $toggle_setting_1
     * @return ListItem
     */
    public function setToggleSetting1(int $toggle_setting_1): ListItem
    {
        $this->toggle_setting_1 = $toggle_setting_1;
        return $this;
    }

    /**
     * @return int
     */
    public function getToggleSetting2(): int
    {
        return $this->toggle_setting_2;
    }

    /**
     * @param int $toggle_setting_2
     * @return ListItem
     */
    public function setToggleSetting2(int $toggle_setting_2): ListItem
    {
        $this->toggle_setting_2 = $toggle_setting_2;
        return $this;
    }

    /**
     * @return int
     */
    public function getActivity(): int
    {
        return $this->activity;
    }

    /**
     * @param int $activity
     * @return ListItem
     */
    public function setActivity(int $activity): ListItem
    {
        $this->activity = $activity;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubtype(): string
    {
        return $this->subtype;
    }

    /**
     * @param string $subtype
     * @return ListItem
     */
    public function setSubtype(string $subtype): ListItem
    {
        $this->subtype = $subtype;
        return $this;
    }

    /**
     * @return int
     */
    public function getEditOptions(): int
    {
        return $this->edit_options;
    }

    /**
     * @param int $edit_options
     * @return ListItem
     */
    public function setEditOptions(int $edit_options): ListItem
    {
        $this->edit_options = $edit_options;
        return $this;
    }

    /**
     * @return string
     */
    public function getTimestamp(): string
    {
        return $this->timestamp;
    }

    /**
     * @param string $timestamp
     * @return ListItem
     */
    public function setTimestamp(string $timestamp): ListItem
    {
        $this->timestamp = $timestamp;
        return $this;
    }

}
