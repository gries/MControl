<?php
namespace gries\MControl\Server;

use Symfony\Component\DomCrawler\Crawler;

class ItemDataLoader
{
    protected $loadUrl;
    protected $savePath;

    public function __construct($loadUrl, $savePath)
    {
        $this->loadUrl = $loadUrl;
        $this->savePath = $savePath;
    }

    public function loadAndSave()
    {
        $response = json_decode(file_get_contents('http://minecraft.gamepedia.com/api.php?format=json&action=parse&prop=text&title=Data_values&text={{%3AData+values%2FBlock+IDs}}'));


        $items = array();
        $name = '*';

        $this->parseItems('//table[1]/tr', $response->parse->text->$name, $items);
//        $this->parseItems('//div[3]/div[3]/div[4]/table[3]/tr', $html, $items);
//        $this->parseItems('//div[3]/div[3]/div[4]/table[4]/tr', $html, $items);
//        $this->parseItems('//div[3]/div[3]/div[4]/table[5]/tr', $html, $items);
//        $this->parseItems('//div[3]/div[3]/div[4]/table[6]/tr', $html, $items);
//
//        $this->parseItems('//div[3]/div[3]/div[4]/table[7]/tr', $html, $items);
//        $this->parseItems('//div[3]/div[3]/div[4]/table[8]/tr', $html, $items);
//        $this->parseItems('//div[3]/div[3]/div[4]/table[9]/tr', $html, $items);
//        $this->parseItems('//div[3]/div[3]/div[4]/table[10]/tr', $html, $items);
//        $this->parseItems('//div[3]/div[3]/div[4]/table[11]/tr', $html, $items);

        $this->save($items);
    }

    public function getSavedData()
    {
        if (file_exists($this->savePath)) {
            return unserialize(file_get_contents($this->savePath));
        }
    }

    protected function save(array $items)
    {
        file_put_contents($this->savePath, serialize($items));
    }

    protected function parseItems($xpath, $html, &$items)
    {
        $crawler = new Crawler();
        $crawler->addHtmlContent($html);

        foreach ($crawler->filterXPath($xpath) as $tr) {
            echo '.';
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
            $item['title'] = $tds->item(4)->nodeValue;

            $items[] = $item;
        }

        return $items;
    }
}