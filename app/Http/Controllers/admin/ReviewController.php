<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CommonController;
use Illuminate\Http\Request;
use App\Review;
use Illuminate\Support\Facades\App;

class ReviewController extends CommonController
{
    public function __construct()
    {
        $this->languageTranslate("French");
    }

    public function index()
    {
        $reviews = Review::orderBy("review_id", "ASC")->paginate(10);
        return view("admin.pages.review", compact("reviews"));
    }

    public function show($id)
    {
        $data["review"] = Review::with("user", "salon")->find($id);
        return response()->json(
            ["success" => true, "data" => $data, "msg" => "Review show"],
            200
        );
    }

    public function destroy($id)
    {
        $review = Review::find($id);
        $review->delete();
        return redirect()->back();
    }
}
