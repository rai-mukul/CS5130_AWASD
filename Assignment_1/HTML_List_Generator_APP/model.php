<?php

namespace HTMLListGenerator;

function generateHTMLList($input) {
    $paragraphs = explode("\n", $input);
    $html = '';

    foreach ($paragraphs as $paragraph) {
        $paragraph = trim($paragraph);
        if (!empty($paragraph)) {
            $html .= "<p>$paragraph</p>\n";
        }
    }

    return $html;
}

?>
