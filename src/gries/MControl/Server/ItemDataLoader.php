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
            else {
                continue;
            }

            $item['title'] = $title;

            if ($tds->item(0)->childNodes->length != 0 &&
                $tds->item(0)->childNodes->item(0)->nodeName == 'a' &&
                $tds->item(0)->childNodes->item(0)->childNodes->item(0)->nodeName == 'img'
            ) {
                $image = file_get_contents($tds->item(0)->childNodes->item(0)->childNodes->item(0)->getAttribute('src'));

                $storepath = sprintf('/var/www/MControl/images/%s.png', str_replace(':', '_', $item['name']));

                /** @var \Imagick $croppedImage */
                $croppedImage = new \Imagick();
                $croppedImage->readimageblob($image);
                $croppedImage->cropimage(25, 12, 0, 0);
                $croppedImage->writeimage($storepath);
                $palette = $this->colorPalette($storepath, 2);

                $item['color'] = str_split($palette[1], 2);

            } else {
                $item['color'] = null;
            }

            $items[] = $item;
        }

        return $items;
    }

    function colorPalette($imageFile, $numColors, $granularity = 5)
    {
        $granularity = max(1, abs((int)$granularity));
        $colors = array();
        $size = @getimagesize($imageFile);
        if($size === false)
        {
            user_error("Unable to get image size data");
            return false;
        }
        $img = @imagecreatefromstring(file_get_contents($imageFile));
        // Andres mentioned in the comments the above line only loads jpegs,
        // and suggests that to load any file type you can use this:
        // $img = @imagecreatefromstring(file_get_contents($imageFile));

        if(!$img)
        {
            user_error("Unable to open image file");
            return false;
        }
        for($x = 0; $x < $size[0]; $x += $granularity)
        {
            for($y = 0; $y < $size[1]; $y += $granularity)
            {
                $thisColor = imagecolorat($img, $x, $y);
                $rgb = imagecolorsforindex($img, $thisColor);
                $red = round(round(($rgb['red'] / 0x33)) * 0x33);
                $green = round(round(($rgb['green'] / 0x33)) * 0x33);
                $blue = round(round(($rgb['blue'] / 0x33)) * 0x33);
                $thisRGB = sprintf('%02X%02X%02X', $red, $green, $blue);
                if(array_key_exists($thisRGB, $colors))
                {
                    $colors[$thisRGB]++;
                }
                else
                {
                    $colors[$thisRGB] = 1;
                }
            }
        }
        arsort($colors);
        return array_slice(array_keys($colors), 0, $numColors);
    }
}