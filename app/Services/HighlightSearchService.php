<?php

namespace App\Services;

class HighlightSearchService {

    protected $object; // object contains result need hightlight
    protected $searchable; // property need search, example [title,content]
    protected $search; // keywords
    protected $needCutString = []; // long string, need cut, example [content]
    protected $maxStringLenghtDontNeedCut = 100;

    public function __construct($searchable, $search, $object = null) {
        $this->object     = $object;
        $this->searchable = $searchable;
        $this->search     = $search;
    }

    function setObject($object) {
        $this->object = $object;
    }

    function setSearchable($searchable) {
        $this->searchable = $searchable;
    }

    function setSearch($search) {
        $this->search = $search;
    }

    function setNeedCutString($needCutString) {
        $this->needCutString = $needCutString;
    }

    public function highlight() {
        $searches = explode(' ', $this->search);
        foreach ($searches as $word) {
            foreach ($this->searchable as $property) {
                $this->addHighlight($word, $property);
            }
        }
        return $this->object;
    }

    protected function addHighlight($word, $property) {
        if (!in_array($property, $this->needCutString)) {
            $this->addHighlightDontNeedCutString($word, $property);
        } else {
            $this->addHighlightNeedCutString($word, $property);
        }
    }

    public function addHighlightDontNeedCutString($word, $property) {
        $text                    = strip_tags($this->object->$property);
        $this->object->$property = preg_replace("/$word/", '<span class="search-highligh">' . $word . '</span>', $text);
    }

    public function addHighlightNeedCutString($word, $property) {
        $text    = strip_tags($this->object->$property);
        $pattern = "/(.*?)$word(.*?)/";
        $matches = [];
        $result  = '';

        preg_match($pattern, $text, $matches);

        if (empty($matches)) {
            $result .= substr($text,0, $this->maxStringLenghtDontNeedCut).'...';
        } else {
            foreach ($matches as $m) {
                if (strlen($m) > $this->maxStringLenghtDontNeedCut) {
                    $result .= '...' . substr($m, -($this->maxStringLenghtDontNeedCut));
                } else {
                    $result .= $m;
                }
            }
        }

        $this->object->$property = preg_replace("/$word/", '<span class="search-highligh">' . $word . '</span>', $result);
    }

}
