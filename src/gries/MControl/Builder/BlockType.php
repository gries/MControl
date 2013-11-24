<?php

namespace gries\MControl\Builder;

/**
 * Class BlockType
 *
 * @package gries\MControl\Builder
 * @Entity @Table(name="block_types",indexes={@index(name="search_idx", columns={"name"})})
 */
class BlockType
{
    /**
     * @Id
     * @Column(type="integer", unique=true) *
     */
    protected $id;

    /** @Column(type="string", unique=true) **/
    protected $name;

    /** @Column(type="string", unique=false) **/
    protected $title;

    protected $meta;

    public function __construct(array $data)
    {
        $this->updateData($data);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function updateData(array $data)
    {
        if (isset($data['id'])) {
            $this->id = $data['id'];
        }

        if (isset($data['name'])) {
            $this->name = $data['name'];
        }

        if (isset($data['title'])) {
            $this->title = $data['title'];
        }

        if (isset($data['meta'])) {
            $this->meta = $data['meta'];
        }
    }

    public function getMeta()
    {
        return $this->meta;
    }
}
