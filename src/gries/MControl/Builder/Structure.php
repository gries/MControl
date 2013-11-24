<?php

namespace gries\MControl\Builder;

/**
 * Class Structure
 *
 * Represents a collection of Blocks
 *
 * @package gries\MControl\Builder
 * @Entity @Table(name="structures",indexes={@index(name="search_idx", columns={"name"})})
 */
class Structure
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;

    /** @Column(type="array") **/
    protected $blocks = [];

    /** @Column(type="string", unique=true) **/
    protected $name;

    /**
     * Get all blocks of this structure
     *
     * @return array
     */
    public function getBlocks()
    {
        return $this->blocks;
    }

    /**
     * Add a block to this structure
     *
     * @param Block $block
     */
    public function addBlock(Block $block)
    {
        $this->blocks[] = $block;
    }

    /**
     * Add a row of blocks on a given axis
     *
     * @param       $axis
     * @param       $type
     * @param       $length
     * @param array $startingPosition
     */
    public function addRow($axis, $type, $length, $startingPosition = array('x' => 1, 'y' => 1, 'z' => 1))
    {
        for ($i = 0; $i < $length; $i++)
        {
            $newPosition = $startingPosition;
            $newPosition[$axis] += $i;
            $block = new Block($type, $newPosition);
            $this->addBlock($block);
        }
    }

    /**
     * Create a block
     *
     * @param       $type
     * @param array $coordinates
     *
     * @return Structure
     */
    public function createBlock($type, array $coordinates, $meta = 0)
    {
        $block = new Block($type, $coordinates, $meta);
        $this->addBlock($block);

        return $this;
    }

    /**
     * Set the name of this structure
     *
     * @param $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get the name of this structure
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
}
