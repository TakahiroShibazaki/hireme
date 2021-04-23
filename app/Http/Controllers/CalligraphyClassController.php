<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{District, Prefecture, Area, CalligraphyClassList, ClassImg, ClassSiteUrl, ContactType, Contact, ImgType, ImageFactory};

class CalligraphyClassController extends Controller
{
    public function __construct()
    {
        // $this->middleware('verified')->except(['index', 'show', 'search', 'popular', 'searchWord', 'searchComment', 'userSearch']);
    }

    public function create()
    {
        $areas = Area::where('prefecture_code', 13)->get();
        $imageTypes = ImgType::get();
        $contactTypes = ContactType::get();

        return view('calligraphy-class.create', [
            'areas' => $areas,
            'imageTypes' => $imageTypes,
            'contactTypes' => $contactTypes,
        ]);
    }

    public function store(Request $request)
    {
        // CalligraphyClassList
        $class = new CalligraphyClassList();
        $class->class_name = $request->class_name;
        $class->area_code = $request->area;
        $class->address = $request->address;
        $class->access = $request->access;
        $class->save();

        // class_id取得
        $classId = $class->id;

        // ClassImg
        $classImage = new ClassImg();
        $classImage->class_id = $classId;
        $classImage->img_type_id = $request->img_type;
        //画像を保存し、ファイル名を返す
        $ImageFactory = new ImageFactory;
        $classImage->file_name = $ImageFactory->store_img($request->file('photo'), 'classImages');
        $classImage->save();

        // ClassSiteUrl
        $siteUrl = new ClassSiteUrl();
        $siteUrl->class_id = $classId;
        $siteUrl->url = $request->url;
        $siteUrl->save();

        // Contact
        for ($i=1; $i < 4; $i++) {
            $contactType = 'contact_type_' . $i;
            $contactInfo = 'contact_info_' . $i;
            if (empty($request->$contactType) || empty($request->$contactInfo)) {
                continue;
            }
            $contact = new Contact();
            $contact->class_id = $classId;
            $contact->contact_type_id = $request->$contactType;
            $contact->registration_id = $request->$contactInfo;
            $contact->save();
        }
        d('db確認');
    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function showClassList(Request $request)
    {
        // 書道教室情報を取得
        $calligraphyClasses = CalligraphyClassList::where('area_code', $request->area_code)->get();

        return view('calligraphy-class.show-class-list', [
            'calligraphyClasses' => $calligraphyClasses,
        ]);

    }

    public function showClass()
    {

    }

    public function selectArea(Request $request)
    {
        if (is_null($request->district_code)) {
            return back();
        }

        // 指定地区内のエリアを取得
        $prefectures = District::find($request->district_code)->Prefectures()->get();
        $classAreas = [];
        // SQLで、市区町村を別々に取得する場合と、市区町村全て取り出してから、PHPで分割する場合のPMを検証
        $count = count($prefectures);
        for ($i=0; $i < $count; $i++) {
            $classAreas[$i]['district_code'] = $prefectures[$i]['district_code'];
            $classAreas[$i]['prefecture_code'] = $prefectures[$i]['prefecture_code'];
            $classAreas[$i]['prefecture_name'] = $prefectures[$i]['prefecture_name'];
            $classAreas[$i][0] = Prefecture::find($prefectures[$i]['prefecture_code'])->Areas()->where('municipality_type', '区')->get();
            $classAreas[$i][1] = Prefecture::find($prefectures[$i]['prefecture_code'])->Areas()->where('municipality_type', '市')->get();
            $classAreas[$i][2] = Prefecture::find($prefectures[$i]['prefecture_code'])->Areas()->where('municipality_type', '町')->get();
            $classAreas[$i][3] = Prefecture::find($prefectures[$i]['prefecture_code'])->Areas()->where('municipality_type', '村')->get();
        }

        return view('calligraphy-class.select-area', [
            'classAreas' => $classAreas,
        ]);
    }

}
