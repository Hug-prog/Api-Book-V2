<?php

namespace App\Http\Controllers;
use App\Http\Controllers\API\BaseController as APIBaseController;
use App\Models\BookVersion;
use App\Models\User;
use Illuminate\Http\Request;
use PharIo\Manifest\Library;

class LibraryController extends APIBaseController
{
    public function getbooks(int $id)
    {
        $user = $this->validationObject(User::class, $id);

        return $this->sendResponse(
            $user
                ->bookVersions()
                ->with("book.author", "edition", "publisher")
                ->get(),
            "Successfully."
        );
    }

    public function store($userId, $bookVersionId)
    {
        /** @var BookVersion $book */
        $bookVersion = $this->validationObject(
            BookVersion::class,
            $bookVersionId
        );

        $user = $this->validationObject(User::class, $userId);

        $bookVersion->users()->attach($user);

        return $this->sendResponse(
            $bookVersion,
            "BookVersion is in library, Successfully."
        );
    }

    public function getInfoByBookVersion(int $bookVersionId, int $userId)
    {
        $user = $this->validationObject(User::class, $userId);

        $this->validationObject(BookVersion::class, $bookVersionId);

        return $this->sendResponse(
            $user
                ->comments()
                ->with("statut")
                ->get(),
            "Successfully."
        );
    }

    public function getNumberBooksVersions(int $userId)
    {
        $user = $this->validationObject(User::class, $userId);

        $nbBookVersions = $user->bookVersions()->count();

        return $this->sendResponse($nbBookVersions, "Successfully.");
    }
}
