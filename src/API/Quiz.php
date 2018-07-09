<?php

namespace damianbal\QuizAPI\API;

class Quiz
{
    protected $quizData = [];

    public function createQuizQuestion($title, $possibleAnswers = [], $correctAnswerIndex = 0) {
        $quiz = [
            'title' => $title,
            'possible_answers' => $possibleAnswers,
            'correct_answer_index' => $correctAnswerIndex
        ];

        return $quiz;
    }

    public function createQuiz($title, $questions) {
        $quiz['title'] = $title;
        $quiz['questions'] = $questions;

        return $quiz;
    }

    public function addQuiz($quiz) {
        $this->quizData[] = $quiz;
    }

    public function getQuiz($id) {
        return $this->quizData[$id];
    }

    public function getAllQuiz() {
        $json = [];

        foreach ($this->quizData as $key => $value) {
            $json[] = [
                'id' => $key,
                'title' => $value['title']
            ];
        }

        return $json;
    }

    public function getQuizData()
    {
        return $this->quizData;
    }
}