<?php

namespace damianbal\QuizAPI\Core;

/**
 *     $quizAll = QuizEntity::builder()->get();

    $quizData = [];

    foreach ($quizAll as $q) {
        $quizData[] = ['title' => $q->title, 'id' => $q->id];
    }

    return Response::responseJson( $quizData );
});
 */

class Utils
{
    /**
     * Transform array of objects to an associative array
     *
     * @param [mixed] $objs
     * @param [array] $fields
     * @return void
     */
    public static function transform( $objs, $fields ) {
        
        $data = [];

        foreach($objs as  $obj) {
            $obj_data = [];

            foreach($fields as $f) {
                $obj_data[$f] = $obj->{$f};
            }

            $data[] = $obj_data;
        }

        return $data;
    }
}