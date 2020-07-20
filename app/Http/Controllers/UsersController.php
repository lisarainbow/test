<?php

namespace App\Http\Controllers;

use App\Http\Models\User\User;
use App\Http\Requests\EatUsersRequest;
use App\Http\Requests\SaveProfileRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class UsersController extends Controller
{
    /**
     * init
     */
    public function init()
    {
        $this->middleware('auth');
    }

    /**
     * @param EatUsersRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function eatUsers(EatUsersRequest $request)
    {
        User::markingEatenUsers($request->post('eaten'));

        return response()->json(['message' => 'All users were eaten!']);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sortAllUsers(Request $request)
    {
        $name = $request->post('name');
        $lastName = $request->post('last_name');
        $location = $request->post('location');
        $sort = $request->post('sort');

        return response()->json(['users' => User::getSortedUsers($name, $lastName, $location, $sort)]);
    }

     /**
     * @param Request $request
     * @return array|string
     * @throws \Throwable
     */
    public function getProfile(Request $request)
    {
        $model = User::find($request->user()->id);

        if (!$model) {
            throw new UnprocessableEntityHttpException('User not found!');
        }

        return view('profile.profile', ['model' => $model])->render();
    }

    /**
     * @param SaveProfileRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveProfile(SaveProfileRequest $request)
    {
        $model = User::find($request->user()->id);

        if (empty($model)) {
            throw new UnprocessableEntityHttpException('User not found!');
        }

        $model->name = $request->post('name');
        $model->last_name = $request->post('last_name');
        $model->dob = $request->post('dob');
        $model->location = $request->post('location');
        $model->phone = $request->post('phone');
        $model->save();

        return response()->json(['message' => 'Profile has been saved!']);
    }
}
