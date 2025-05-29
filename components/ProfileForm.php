<?php namespace ExtendUsers\Components;

use Cms\Classes\ComponentBase;
use RainLab\User\Models\User as UserModel;
use Flash;
use Input;
use Auth;
use ValidationException;
use Validator;

class ProfileForm extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'Profile Form',
            'description' => 'Form for users to update their extended profile information'
        ];
    }

    public function onRun()
    {
        $this->page['user'] = Auth::getUser();
    }

    public function onUpdateProfile()
    {
        if (!$user = Auth::getUser()) {
            return;
        }

        $data = Input::only([
            'organization',
            'city_state',
            'reason_for_joining'
        ]);

        $rules = [
            'organization' => 'required|min:2|max:255',
            'city_state' => 'required|min:2|max:255',
            'reason_for_joining' => 'required|min:10'
        ];

        $validation = Validator::make($data, $rules);
        if ($validation->fails()) {
            throw new ValidationException($validation);
        }

        $user->fill($data);
        $user->save();

        Flash::success('Profile updated successfully!');
    }
} 