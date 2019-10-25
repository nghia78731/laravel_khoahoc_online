<?php

namespace App\Http\Controllers;

use App\Entities\Question\Question;
use App\Repositories\Question\QuestionRepository;
use App\Repositories\Quiz\QuizRepository;
use App\Repositories\QuizResult\QuizResultRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use mysql_xdevapi\Exception;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $quiz, $question, $quizResult;

    public function __construct(QuizRepository $quizRepository,
                                QuestionRepository $questionRepository,
                                QuizResultRepository $quizResultRepository)
    {
        $this->quiz = $quizRepository;
        $this->question = $questionRepository;
        $this->quizResult = $quizResultRepository;
    }

    public function index($class_id)
    {
        $user_id = Auth::id();
        $quizs = $this->quiz->getQuiz($class_id);
        foreach ($quizs as $quiz)
            $quiz_id = $quiz->id;
        $checkCompleted = $this->quizResult->checkCompleted($user_id, $quiz_id);

        if ($checkCompleted > 0)
            return redirect()->route('quiz_finish.index', $quiz_id);

        return view('view.pages.quiz', compact('quizs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $capacityQuestion = $request->input('question_count');
        $answerQuestion = $request->input('answer_question');

        for ($i = 1; $i <= $capacityQuestion; $i++) {
            $answerQuestion = $request->input('answer_question'. $i);
            if ( isset( $answerQuestion ) ) {
                list( $correct, $answered ) = explode( '|', $answerQuestion . $i );
            } else {
                list( $correct, $answered ) = [ 0, 0 ];
            }

            $result = $this->quizResult->create([
                                'user_id' => $request->input('user_id'),
                                'question_id' => $request->input('question_'. $i),
                                'quiz_id' => $request->input('quiz_id'),
                                'correct' => $correct,
                                'answered' => $answered
            ]);
        }


        return redirect()->route('quiz_finish.index', $request->input('quiz_id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showQuizFinish($quiz_id)
    {
        $user_id = Auth::id();
        $totalCorrected = $this->quizResult->getCorrected($user_id, $quiz_id);
        $totalQuestion = $this->quiz->getTotalQuestion($quiz_id);
        $result = $this->getStar($totalCorrected, $totalQuestion);

        return view('view.pages.quiz_finish', compact(['totalCorrected', 'totalQuestion', 'result']));
    }

    public function getStar($totalCorrected, $totalQuestion)
    {
        $yellow_star = 0;
        $star = 0;
        for ($i = 1; $i <= $totalQuestion->question_count; $i++)
        {
            while ($totalCorrected > 0)
            {
                $yellow_star = $yellow_star + 1;
                $totalCorrected = $totalCorrected - 1;
            }
            $star = $totalQuestion->question_count - $yellow_star;
        }
        $result = (object) [
            'yellow_star' => $yellow_star,
            'star' => $star
        ];

        return $result;
    }

    public function clearQuizResult($quiz_id, $class_id)
    {
        $user_id = Auth::id();
        $this->quizResult->clearQuizResult($user_id, $quiz_id);

        return redirect()->route('quiz.index', $class_id);

    }
}
