<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
{
    /**
     * バリデーションルールをセット
     */
    private $wordMax = 255;
    private $commentMax = 255;
    private $photoSizeMax = 10000;
    private $photoMimes = 'jpeg';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->path() === 'post' ? true : false;
    }

    /**
     * messagesメソッドをオーバーライドしエラー文を設定
     *
     * @return array
     */
    public function messages()
    {
        return [
            'word.string' => '「書いた文字」は、文字列を入力してください',
            'word.max' => '「書いた文字」は、' . $this->wordMax . '文字以内で入力してください',
            'comment.string' => '「コメント」は、文字列を入力してください',
            'comment.max' => '「コメント」' . $this->commentMax . '文字以内で入力してください',
            'photo.required' => '画像は必須です',
            'photo.mines' => $this->photoMimes . 'のいずれかの画像を選択してください',
            'photo.max' => '画像サイズは、' . $this->photoSizeMax . '以下にして投稿してください',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'word' => 'string|max:' . $this->wordMax,
            'comment' => 'string|max:' . $this->commentMax,
            'photo' => 'required|mimes:' . $this->photoMimes . '|max:' . $this->photoSizeMax,
        ];
    }
}
