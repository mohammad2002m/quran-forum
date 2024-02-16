<?php

use App\Models\PreviousPart;

function getPreviousParts($previous_parts, $user_id){
    $previous_parts_with_models = [];
    foreach ($previous_parts as $part){
        array_push($previous_parts_with_models, PreviousPart::create([
            'part' => $part,
            'user_id' => $user_id
        ]));
    }
    return $previous_parts_with_models;
}
