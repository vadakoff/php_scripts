<?php

ini_set('display_errors', true);
ini_set('error_reporting', E_ALL | E_STRICT);


define('HAZE_AGGREGATOR_PATH', 'http://www.aggregator.com/');
define('HAZE_FILE_CACHE', 'links.db');
define('HAZE_LIFETIME_CACHE', 60);


class Harvester
{
    function __construct($aggregatorPath, $hostName)
    {
        $this->aggregatorPath = $aggregatorPath;
        $this->hostName = $hostName;
    }

    function setHostname($hostName)
    {
        $this->hostName = $hostName;
    }

    function setAggregatorPath($aggregatorPath)
    {
        $this->aggregatorPath = $aggregatorPath;
    }

    function getUrl()
    {
        return $this->aggregatorPath . '?' . "hostname=" . urlencode($this->hostName);
    }

    function fetch()
    {
        $aggregatorUrl = $this->getUrl();
        return file_get_contents($aggregatorUrl);
    }
}

class BoxLinks
{
    function __construct($links, $crc)
    {
        if ( !is_array($links)) {
            throw new Exception('Invalid data input');
        }

        $this->links = $links;
        $this->crc = $crc;
    }

    function squareCalc($count) {
        $crc_floated = fmod($this->crc, 0.99);
        $crc_square = pow($crc_floated, 2);
        $step = 1.0 / $count;
        $ret = $crc_square / $step;
        return (integer)ceil($ret) - 1;
    }

    function marshalLinks($tree, $callback = 'squareCalc', $depth = 1)
    {
        if ( !is_array($tree) || empty($tree) ) {
            return false;
        }

        $keys = array_keys($tree);
        $selectedIndex = call_user_func(array($this, $callback), count($keys));
        $selectedKey = $keys[$selectedIndex];

        if ( $depth <= 0 ) {
            return array($selectedKey, $tree[$selectedKey]);
        }

        $childTree = $tree[$selectedKey];

        return $this->marshalLinks($childTree, $callback, --$depth);
    }

    function calculateLinks()
    {
        $links = $this->marshalLinks($this->links);
        if ( $links === false ) {
            return array();
        }
        return array($links);
    }
}


class LinkStore
{
    protected $harvester;
    protected $file;
    protected $lifeTime; // in seconds

    function __construct($harvester, $file, $lifeTime)
    {
        $this->harvester = $harvester;
        $this->file = $file;
        $this->lifeTime = $lifeTime;
    }

    function getPath()
    {
        return dirname(__FILE__) . DIRECTORY_SEPARATOR . $this->file;
    }

    function isFresh()
    {
        $freshTime = time() - $this->lifeTime;
        return filemtime($this->getPath()) > $freshTime;
    }

    function fetchData()
    {
        $data = $this->harvester->fetch();
        if ( !$data ) {
            return false;
        }

        $unserialized = @unserialize($data);
        if ( ($unserialized === false) || !is_array($unserialized) ) {
            return false;
        }

        return $data;
    }

    function getData()
    {
        if ( file_exists($this->getPath()) ) {
            if ( $this->isFresh() ) {
                return file_get_contents($this->getPath());
            }
            else {
                $data = $this->fetchData();

                if ( !$data ) {
                    touch($this->getPath());
                    return file_get_contents($this->getPath());
                }

                // update file
                $fh = fopen($this->getPath(), 'wb');
            }
        }
        else {
            $data = $this->fetchData();

            if ( !$data ) {
                $data = serialize(array());
            }

            // create file
            $fh = fopen($this->getPath(), 'wb');
            chmod($this->getPath(), 0666);
        }

        fwrite($fh, $data);
        fclose($fh);
        return $data;
    }

    function getLinks()
    {
        return unserialize($this->getData());
    }
}

class Billboard
{
    function __construct()
    {
        $aggregatorPath = HAZE_AGGREGATOR_PATH;
        $this->harvester = new Harvester($aggregatorPath, $_SERVER['SERVER_NAME']);
        $this->linkStore = new LinkStore($this->harvester, HAZE_FILE_CACHE, HAZE_LIFETIME_CACHE);
    }

    function linkFactory()
    {
        $links = $this->linkStore->getLinks();
        try {
            $boxLinks = new BoxLinks($links, crc32($_SERVER['REQUEST_URI']));
        } catch ( Exception $e ) {
            return array();
        }
        return $boxLinks->calculateLinks();
    }

    static function render()
    {
        $that = new self();

        $links = $that->linkFactory();

        echo "<div style=\"position:absolute;width:0;overflow:auto\">";
        foreach ( $links as $item ) {
            echo '<a href="' . $item[1] . '">' . $item[0] . '</a>';
        }
        echo "</div>";
    }
}

//Billboard::render();
