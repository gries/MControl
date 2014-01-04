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

    /** @Column(type="string", unique=false, nullable=true) **/
    protected $colorR;

    /** @Column(type="string", unique=false, nullable=true) **/
    protected $colorG;

    /** @Column(type="string", unique=false, nullable=true) **/
    protected $colorB;

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

        if (isset($data['color'])) {
            $this->colorR = $data['color'][0];
            $this->colorG = $data['color'][1];
            $this->colorB = $data['color'][2];
        }

        return $this;
    }

    public function getMeta()
    {
        return $this->meta;
    }

    public function color()
    {
        return sprintf('%s%s%s', $this->colorR, $this->colorG, $this->colorB);
    }
}
