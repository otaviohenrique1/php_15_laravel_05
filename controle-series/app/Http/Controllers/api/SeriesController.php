<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function __construct(private SeriesRepository $seriesRepository)
    {
        //
    }

    /*
    blic function index(Request $request)
    {
        if (!$request->has('nome')) {
            return Series::paginate();
            // return Series::all();
        }
        return Series::whereNome($request->nome)->paginate();
        // return Series::whereNome($request->nome)->get();

    }
    */

    public function index(Request $request)
    {
        $query = Series::query();
        if ($request->has('nome')) {
            $query->where('nome', $request->nome);
        }
        return $query->paginate();
        // return Series::whereNome($request->nome)->get();

    }

    public function store(SeriesFormRequest $request)
    {
        // dd($request->all());
        return response()->json($this->seriesRepository->add($request), 201);
    }

    public function show(int $series)
    // public function show(Series $series)
    {
        // $series = Series::whereId($series)->with('seasons.episodes')->first();
        // $series = Series::whereId($series)->with('seasons.episodes')->get();
        $seriesModel = Series::with('seasons.episodes')->find($series);
        if ($seriesModel === null) {
            return response()->json(['message' => 'Series not found'], 404);
        }
        return $seriesModel;
    }

    public function update(Series $series, SeriesFormRequest $request)
    {
        $series->fill($request->all());
        $series->save();
        return $series;
    }

    public function destroy(int $series)
    {
        Series::destroy($series);
        return response()->noContent();
    }
}
