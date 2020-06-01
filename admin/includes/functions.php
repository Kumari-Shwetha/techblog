<?php
 function slug($text)
    { 

        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

        // trim
        $text = trim($text, '-');

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // lowercase
        $text = strtolower($text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        if (empty($text))
        {
            return 'n-a';
        }

        return $text;
    }
    function validateFormData($valid)
    {
        
        foreach($_POST as $key=>$value)
        {
            if(empty($_POST[$key]))
            {
                $valid=0;      
            }
        }
       return $valid;

    }

?>