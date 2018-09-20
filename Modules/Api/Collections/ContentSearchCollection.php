<?php

namespace Modules\Api\Collections;

use Illuminate\Http\Resources\Json\ResourceCollection;

use Modules\Architect\Transformers\ContentTransformer;
use Modules\Architect\Entities\Language;

use Modules\Api\Transformers\ContentSearchTransformer;

class ContentSearchCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request, $hits = null)
    {
        $language = $request->get('accept_lang') ? Language::byIso($request->get('accept_lang'))->first() : Language::getDefault();
        $self = $this;

        return [
            'data' => $this->collection->map(function ($content) use ($request, $language, $hits, $self) {
                $hit = null;
                foreach ($hits as $h) {
                    if ($h['_id'] == $content->id) {
                        $hit = $h;
                    }
                }

                return (new ContentSearchTransformer($content))
                    ->toArray($request, $language, [
                        'description' => $self->buildDescription($hit, $content, $language)
                    ]);
            })
        ];
    }

    private function buildDescription($hit, $content, $language)
    {
        $description = null;

        if ($content->is_page) {
            if (isset($hit['_source'][$language->iso]['body'])) {
                $description = $hit['_source'][$language->iso]['body'];
            }
        } else {
            $arr = [];
            $fields = isset($hit['_source'][$language->iso]) ? $hit['_source'][$language->iso] : [];
            foreach ($fields as $k => $v) {
                if (trim($v)) {
                    $arr[] = $v;
                }
            }

            $description = implode(' ', $arr);
        }

        //
        // extractRelevant($words, $fulltext, $rellength=300, $prevcount=50, $indicator='...')
        return $this->extractRelevant(explode(' ',request('q')), $description);
    }

    // find the locations of each of the words
    // Nothing exciting here. The array_unique is required
    // unless you decide to make the words unique before passing in
    public function _extractLocations($words, $fulltext)
    {
        $locations = array();
        foreach ($words as $word) {
            $wordlen = strlen($word);
            $loc = stripos($fulltext, $word);
            while ($loc !== false) {
                $locations[] = $loc;
                $loc = stripos($fulltext, $word, $loc + $wordlen);
            }
        }
        $locations = array_unique($locations);
        sort($locations);

        return $locations;
    }

    /*
     *
     *  Excerpt builder functions
     *  See :
     *  https://boyter.org/2013/04/building-a-search-result-extract-generator-in-php/
     *
     */


    // Work out which is the most relevant portion to display
    // This is done by looping over each match and finding the smallest distance between two found
    // strings. The idea being that the closer the terms are the better match the snippet would be.
    // When checking for matches we only change the location if there is a better match.
    // The only exception is where we have only two matches in which case we just take the
    // first as will be equally distant.
    public function _determineSnipLocation($locations, $prevcount)
    {
        // If we only have 1 match we dont actually do the for loop so set to the first
        $startpos = isset($locations[0]) ? $locations[0] : 0;
        $loccount = count($locations);
        $smallestdiff = PHP_INT_MAX;
        // If we only have 2 skip as its probably equally relevant
        if (count($locations) > 2) {
            // skip the first as we check 1 behind
            for ($i=1; $i < $loccount; $i++) {
                if ($i == $loccount-1) { // at the end
                    $diff = $locations[$i] - $locations[$i-1];
                } else {
                    $diff = $locations[$i+1] - $locations[$i];
                }

                if ($smallestdiff > $diff) {
                    $smallestdiff = $diff;
                    $startpos = $locations[$i];
                }
            }
        }

        $startpos = $startpos > $prevcount ? $startpos - $prevcount : 0;
        return $startpos;
    }


    // 1/6 ratio on prevcount tends to work pretty well and puts the terms
    // in the middle of the extract
    public function extractRelevant($words, $fulltext, $rellength=300, $prevcount=50, $indicator='...')
    {
        $textlength = strlen($fulltext);
        if ($textlength <= $rellength) {
            return $fulltext;
        }

        $locations = $this->_extractLocations($words, $fulltext);
        $startpos  = $this->_determineSnipLocation($locations, $prevcount);
        // if we are going to snip too much...
        if ($textlength-$startpos < $rellength) {
            $startpos = $startpos - ($textlength-$startpos)/2;
        }

        $reltext = substr($fulltext, $startpos, $rellength);

        // check to ensure we dont snip the last word if thats the match
        if ($startpos + $rellength < $textlength) {
            $reltext = substr($reltext, 0, strrpos($reltext, " ")).$indicator; // remove last word
        }

        // If we trimmed from the front add ...
        if ($startpos != 0) {
            $reltext = $indicator.substr($reltext, strpos($reltext, " ") + 1); // remove first word
        }

        return $reltext;
    }
}
