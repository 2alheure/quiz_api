<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\Builder;

class QuestionController extends Controller {

    const DEFAULT_LIMIT = 10;

    public function get(Request $request) {
        $qb = Question::with(['category', 'language', 'responses', 'type'])
            ->whereNull('deleted_at');

        if (!empty($request->category)) $qb->where('category_id', $request->category);
        if (!empty($request->difficulty)) $qb->whereBetween('estimated_difficulty', [$request->difficulty - 5, $request->difficulty + 5]);
        // if (!empty($language = $request->language)) $qb->whereHas('language', function (Builder $qb) use ($language) {
        //     $qb->where('abbr', $language);
        // });

        return new JsonResponse($qb->simplePaginate($request->limit ?? static::DEFAULT_LIMIT));
    }
}
