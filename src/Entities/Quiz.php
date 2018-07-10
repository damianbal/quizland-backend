<?php

namespace damianbal\QuizAPI\Entities;

use damianbal\enterium\Entity;


class Quiz extends Entity
{
    protected static $table = 'quiz';
    protected static $attributes = ['title', 'data'];
}