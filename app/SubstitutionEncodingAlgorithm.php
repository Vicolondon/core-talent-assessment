<?php

/**
 * Class SubstitutionEncodingAlgorithm
 *  http://www.writephponline.com/
 */
class SubstitutionEncodingAlgorithm implements EncodingAlgorithm
{
    /**
     * @var array
     */
    private $substitutions;

    /**
     * SubstitutionEncodingAlgorithm constructor.
     * @param $substitutions
     */
    public function __construct(array $substitutions)
    {
        $this->substitutions = $substitutions;
    }

    /**
     * Encodes text by substituting character with another one provided in the pair.
     * For example pair "ab" defines all "a" chars will be replaced with "b" and all "b" chars will be replaced with "a"
     * Examples:
     *      substitutions = ["ab"], input = "aabbcc", output = "bbaacc"
     *      substitutions = ["ab", "cd"], input = "adam", output = "bcbm"
     *
     * @param string $text
     * @return string
     */
    public function encode($text)
    {
        /**
         * @TODO: Implement it
         */
        $newArray = array();
        $stringToArray = str_split($text);
        $elementToCompare = "";
        foreach ($this->substitutions as $coupleTab ){
            $elementToCompare = $elementToCompare.$coupleTab;
        }
        $newArrayImposed = str_split($elementToCompare);
        foreach ( $stringToArray as $letterToChange) {
            if(!ctype_lower($letterToChange)){
                array_push($newArray, $this->changeLetter(strtolower($letterToChange),
                    $newArrayImposed,
                    ctype_lower($letterToChange)
                ));
            }else{
                array_push($newArray, $this->changeLetter($letterToChange,
                    $newArrayImposed,
                    ctype_lower($letterToChange)
                ));
            }
        }

        return implode($newArray);
    }

    /*
     * Change letter depending on encoder rule
     * */
    public function changeLetter($letter, $arrayImposed, $isLowerCase){
        for ($i = 0; $i < count($arrayImposed); $i++) {
            if (in_array($letter, $arrayImposed)) {
                $positionOfMatch = array_search(($letter), $arrayImposed);
                if ( $positionOfMatch %2 == 1){
                    if($isLowerCase){
                        return $arrayImposed[$positionOfMatch-1];
                    }
                    return strtoupper($arrayImposed[$positionOfMatch-1]);
                } else {
                    if($isLowerCase){
                        return $arrayImposed[$positionOfMatch+1];
                    }
                    return strtoupper($arrayImposed[$positionOfMatch+1]);
                }
            }
            else {
                if($isLowerCase){
                    return $letter;
                }
                return strtoupper($letter);
            }
        }
    }
}