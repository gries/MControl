<?php
namespace gries\MControl\Server;

use gries\MControl\Builder\BlockType;
use gries\MControl\Storage\BlockType\BlockTypeRepository;
use Symfony\Component\DomCrawler\Crawler;

class ItemDataLoader
{
    protected $loadUrl;
    protected $blockTypeRepository;

    public function __construct($loadUrl, BlockTypeRepository $blockTypeRepository)
    {
        $this->loadUrl = $loadUrl;
        $this->blockTypeRepository = $blockTypeRepository;
    }

    public function loadAndSave()
    {
        $response = json_decode(file_get_contents($this->loadUrl));


        $items = array();
        $name = '*';

        $this->parseItems('//table[1]/tr', $response->parse->text->$name, $items);
        $this->parseItems('//table[2]/tr', $response->parse->text->$name, $items);
        $this->parseItems('//table[3]/tr', $response->parse->text->$name, $items);
        $this->parseItems('//table[4]/tr', $response->parse->text->$name, $items);
        $this->parseItems('//table[6]/tr', $response->parse->text->$name, $items);
        $this->parseItems('//table[6]/tr', $response->parse->text->$name, $items);
        $this->parseItems('//table[7]/tr', $response->parse->text->$name, $items);
        $this->parseItems('//table[8]/tr', $response->parse->text->$name, $items);
        $this->parseItems('//table[9]/tr', $response->parse->text->$name, $items);
        $this->parseItems('//table[10]/tr', $response->parse->text->$name, $items);
        $this->parseItems('//table[11]/tr', $response->parse->text->$name, $items);

        $this->save($items);
    }

    protected function save(array $items)
    {
        foreach ($items as $item)
        {
            if (!$blockType = $this->blockTypeRepository->getByName($item['name']))
            {
                $blockType = new BlockType($item);
            }
            else
            {
                $blockType->updateData($item);
            }

            $this->blockTypeRepository->add($blockType);
        }
    }

    protected function parseItems($xpath, $html, &$items)
    {
        $crawler = new Crawler();
        $crawler->addHtmlContent($html);

        foreach ($crawler->filterXPath($xpath) as $tr) {
            $item = array();

            $tds = $tr->getElementsByTagName('td');
            if (0 == $tds->length) {
                continue;
            }

            $item['id'] = (int)$item['value'] = str_replace(array("\n", "'"), '', $tds->item(1)->nodeValue);

            $name = $tds->item(3);
            $sup = $name->getElementsByTagName('sup')->item(0);
            if (null !== $sup) {
                $name->removeChild($sup);
            }
            $item['name'] = $item['label'] = str_replace(array("\n", "'"), '', $name->nodeValue);

            /** @var \DOMElement $tds */

            if ($tds->item(4)->getElementsByTagName('a')->length > 0) {
                $title = $tds->item(4)->getElementsByTagName('a')->item(0)->getAttribute('title');
            }
            else
            {
                continue;
            }

            $item['title'] = $title;

            $items[] = $item;
        }

        return $items;
    }
}