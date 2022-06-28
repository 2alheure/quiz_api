<?php

namespace App\Http\Controllers;

use App\Models\Token;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class QuestionController extends Controller {

    const DEFAULT_LIMIT = 10;

    public function get(Request $request) {
        if (!empty($token = $request->token)) {
            $token = Token::where('token', $token)->first();
            if (empty($token)) throw new BadRequestHttpException('Token invalide.');
        }

        $qb = Question::with(['category', 'language', 'responses', 'type'])
            ->whereNull('deleted_at');

        if (!empty($request->category)) $qb->where('category_id', $request->category);
        if (!empty($request->difficulty)) $qb->whereBetween('estimated_difficulty', [$request->difficulty - 5, $request->difficulty + 5]);
        if (!empty($language = $request->language)) $qb->whereHas('language', function (Builder $qb) use ($language) {
            $qb->where('abbr', $language);
        });
        if (!empty($token)) $qb->whereDoesntHave('sessions', function (Builder $query) use ($token) {
            $query->where('token', $token->token);
        });

        $questions = $qb->inRandomOrder()->limit($request->limit ?? static::DEFAULT_LIMIT)->get();
        if (!empty($token)) {
            $array = $questions->map(function ($question) use ($token) {
                return [
                    'token_id' => $token->id,
                    'question_id' => $question->id
                ];
            })
                ->toArray();

            DB::table('session')->insert($array);
        }

        return new JsonResponse($questions);
    }
}
