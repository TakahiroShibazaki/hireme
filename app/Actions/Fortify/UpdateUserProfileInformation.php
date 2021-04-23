<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'image', 'max:1024'],
            'introduction' => ['nullable', 'string', 'max:255'],
            'prefecture' => ['nullable', 'string', 'max:255'],
            'user_website_url' => ['nullable', 'string', 'max:255'],
            'prefectureFlag' => ['required', 'boolean'],
            'birthdayFlag' => ['required', 'boolean'],
            'websiteFlag' => ['required', 'boolean'],
            'bd_year' => ['nullable', 'integer'],
            'bd_month' => ['nullable', 'integer'],
            'bd_day' => ['nullable', 'integer'],
            'birthyearFlag' => ['required', 'boolean'],
            'belonging_group' => ['nullable', 'string', 'max:255'],
            'belonging_groupFlag' => ['required', 'boolean'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }
        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
                'introduction' => $input['introduction'],
                'prefecture' => $input['prefecture'],
                'user_website_url' => $input['user_website_url'],
                'prefectureFlag' => $input['prefectureFlag'],
                'birthdayFlag' => $input['birthdayFlag'],
                'websiteFlag' => $input['websiteFlag'],
                'bd_year' => $input['bd_year'],
                'bd_month' => $input['bd_month'],
                'bd_day' => $input['bd_day'],
                'birthyearFlag' => $input['birthyearFlag'],
                'belonging_group' => $input['belonging_group'],
                'belonging_groupFlag' => $input['belonging_groupFlag'],
            ])->save();
        }
        
    }
    

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
