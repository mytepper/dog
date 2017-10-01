<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\User;
use App\Dog;
use App\Type;
use App\Province;
use App\District;

class DogController extends Controller
{
    protected $request;
    protected $user;
    protected $dog;
    protected $type;
    protected $province;
    protected $district;

    public function __construct(
        Request $request,
        User $user,
        Dog $dog,
        Type $type,
        Province $province,
        District $district
    ) {
        $this->request = $request;
        $this->user = $user;
        $this->dog = $dog;
        $this->type = $type;
        $this->province = $province;
        $this->district = $district;
    }

    public function store()
    {
        $response = [];
        $conditions = [];
        $districts = ['' => 'เลือกอำเภอ'];
        $typeId = $this->request->input('type_id') ?? '';
        $provinceId = $this->request->input('province_id') ?? '';
        $districtId = $this->request->input('district_id') ?? '';
        $ageMin = $this->request->input('age_min') ?? '';
        $ageMax = $this->request->input('age_max') ?? '';
        $pMin = $this->request->input('p_min') ?? '';
        $pMax = $this->request->input('p_max') ?? '';
        
        if ($typeId !== '') {
            $conditions[] = ['type_id', $typeId];
        }
        
        if ($districtId !== '') {
            $conditions[] = ['district_id', $districtId];
        }

        if ($provinceId != '') {
            $conditions[] = ['province_id', $provinceId];
            $districts = array_merge($districts ,$this->district->getList($provinceId));
        }

        if ($ageMin !== '') {
            $conditions[] = ['age', '>=', $ageMin];
            $conditions[] = ['age', '<=', $ageMax];
        }

        if ($pMin !== '') {
            $conditions[] = ['price', '>=', $pMin];
            $conditions[] = ['price', '<=', $pMax];
        }
        
        $dogs = $this->dog
            ->where($conditions)
            ->orderBy('id', 'desc')
            ->paginate(20);

        $response['max_price'] = $this->dog->max('price');
        $response['max_age'] = $this->dog->max('age');
        $response['types'] = $this->type->getList();
        $response['provinces'] = $this->province->getList();
        $response['districts'] = $districts;
        $response['dogs'] = $dogs;

        return view('dog.store', $response);
    }

    public function index()
    {
        $response = [];

        return view('dog.index');
    }

    public function create()
    {
        $message = [
            'status' => false,
            'message' => "ลงประกาศไม่สำเร็จ"
        ];
        $response = [];
        $response['types'] = $this->type->getList();
        $response['provinces'] = $this->province->getList();

        $user = $this->user->find(auth()->user()->id);
        if ($this->request->isMethod('post')) {
            $this->validate($this->request, [
                'image' => "required|image",
                'type_id' => "required",
                'district_id' => "required",
                'province_id' => "required",
                'name' => "required",
                'age' => "required",
                'weight' => "required",
                'height' => "required",
                'price' => "required",
                'description' => "required"
            ]);

            if ($this->request->hasFile('image')) {
                $upload = $this->uploadFileAsp($this->request->file('image'), 'dogs', 600);
                if ($upload['status'] == false) {
                    $message['message'] = $upload['error_message'];
                    return redirect('dog/create')->with('message', $message);
                }

                $this->dog->image = $upload['file_name'];
            }

            $params = $this->request->all();
            $this->dog->type_id = $params['type_id'];
            $this->dog->district_id = $params['district_id'];
            $this->dog->province_id = $params['province_id'];
            $this->dog->name = $params['name'];
            $this->dog->age = $params['age'];
            $this->dog->weight = $params['weight'];
            $this->dog->height = $params['height'];
            $this->dog->price = $params['price'];
            $this->dog->description = $params['description'];
            $this->dog->user_id = $user['id'];
            $this->dog->sale = 0;

            if ($this->dog->save()) {
                $message['status'] = true;
                $message['message'] = "ลงประกาศสำเร็จ";
            }

            return redirect('dog/user/profile/' . $user['id'])->with('message', $message);
        }

        return view('dog.create', $response);
    }

    public function update($dogId)
    {
        $message = [
            'status' => false,
            'message' => "อัพเดทข้อมูลประกาศไม่สำเร็จ"
        ];
        $response = [];
        $dog = $this->dog->find($dogId);
        if ($dog['user_id'] !== auth()->user()->id) {
            abort(404);
        }
        
        $response['types'] = $this->type->getList();
        $response['provinces'] = $this->province->getList();
        $response['districts'] = $this->district->getList($dog['province_id']);
        $response['dog'] = $dog;

        if ($this->request->isMethod('post')) {
            $this->validate($this->request, [
                'type_id' => "required",
                'district_id' => "required",
                'province_id' => "required",
                'name' => "required",
                'age' => "required",
                'weight' => "required",
                'height' => "required",
                'price' => "required",
                'description' => "required"
            ]);

            if ($this->request->hasFile('image')) {
                $upload = $this->uploadFileAsp($this->request->file('image'), 'dogs', 600);
                if ($upload['status'] == false) {
                    $message['message'] = $upload['error_message'];
                    return redirect()->back()->with('message', $message);
                }

                $dog->image = $upload['file_name'];
            }

            $params = $this->request->all();
            $dog->type_id = $params['type_id'];
            $dog->district_id = $params['district_id'];
            $dog->province_id = $params['province_id'];
            $dog->name = $params['name'];
            $dog->age = $params['age'];
            $dog->weight = $params['weight'];
            $dog->height = $params['height'];
            $dog->price = $params['price'];
            $dog->description = $params['description'];
            $dog->sale = $params['sale'];

            if ($dog->save()) {
                $message['status'] = true;
                $message['message'] = "อัพเดทข้อมูลประกาศสำเร็จ";
            }

            return redirect('dog/user/profile/' . $dog['user_id'])->with('message', $message);
        }

        return view('dog.update', $response);
    }

    public function delete($dogId)
    {
        $message = [
            'status' => false,
            'message' => "ไม่สามารถลบข้อมูลนี้ได้"
        ];

        $dog = $this->dog->find($dogId);
        if ($dog['user_id'] !== auth()->user()->id) {
            abort(404);
        }

        if ($dog->delete()) {
            $message['status'] = true;
            $message['message'] = "ลบข้อมูลประกาศหมายเลข : " . $dog['id'] . " แล้ว";
        }

        return redirect()->back()->with('message', $message);
    }

    public function detail($dogId)
    {
        $response = [];
        $dog = $this->dog->find($dogId);
        if (!$dog) {
            abort(404);
        }

        $response['dog'] = $dog;

        return view('dog.detail', $response);
    }
}
