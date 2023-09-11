<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController as APIBaseController;
use App\Models\BookVersion;
use App\Models\Statut;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends APIBaseController
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $comment = new Comment();

        $validator = Validator::make($request->all(), [
            "book_version_id" => "required",
            "user_id" => "required",
            "note" => "required",
            "comment" => "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError("Validation Error, form incomplete .");
        }

        $bookVersion = $this->validationObject(
            BookVersion::class,
            $request->book_version_id
        );

        $user = $this->validationObject(User::class, $request->user_id);

        if ($request->statut_id) {
            $statut = $this->validationObject(
                Statut::class,
                $request->statut_id
            );

            $comment->statut()->associate($statut);
        }

        $comment->bookVersion()->associate($bookVersion);
        $comment->user()->associate($user);
        $comment->comment = $request->comment;
        $comment->note = $request->note;
        $comment->save();

        return $this->sendResponse($comment, "Comment Created Successfully.");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $userId, int $bookVersionId)
    {
        $this->validationObject(User::class, $request->user_id);

        $this->validationObject(BookVersion::class, $request->book_version_id);

        $comment = Comment::where(
            ["user_id", $userId],
            ["book_version_id", $bookVersionId]
        )->get();

        $validator = Validator::make($request->all(), [
            "note" => "required",
            "comment" => "required",
        ]);

        if ($validator->fails()) {
            return $this->sendError("Validation Error, form incomplete .");
        }

        $comment->note = $request->note;
        $comment->comment = $request->comment;

        if ($request->statut_id) {
            $statut = $this->validationObject(
                Statut::class,
                $request->statut_id
            );
            $comment->statut()->associate($statut);
        }

        $comment->save();

        return $this->sendResponse($comment, "Comment updated Successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $comment = $this->validationObject(Comment::class, $id);
        return $this->sendResponse(
            $comment->delete(),
            "Comment deleted Successfully."
        );
    }
}
