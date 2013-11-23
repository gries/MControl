<?php

namespace gries\MControl\Builder;

class BlockType
{
    protected $id;

    protected $name;

    protected $title;


    public function __construct(array $data)
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
}
