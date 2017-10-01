<?php
namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;

use Auth;
use App\User;
use App\Car;
use App\Type;
use App\Brand;
use App\Province;

class CarController extends \App\Http\Controllers\Controller
{
    protected $request;
    protected $user;
    protected $car;
    protected $type;
    protected $brand;
    protected $province;

    protected $authUser;
    protected $rules = [
        'add' => [
            'brand_id' => 'required',
            'type_id' => 'required',
            'code' => 'required',
            'generation_name' => 'required',
            'year' => 'required',
            'cc' => 'required',
            'gear' => 'required',
            'price' => 'required|numeric'
        ]
    ];

    public function __construct(
        Request $request,
        User $user,
        Car $car,
        Type $type,
        Brand $brand,
        Province $province
    ) {
        $this->request = $request;
        $this->user = $user;
        $this->car = $car;
        $this->type = $type;
        $this->brand = $brand;
        $this->province = $province;
    }

    public function index()
    {
        $this->authUser = Auth::user();
        $response = [
            'bad' => [
                'item_1' => '',
                'item_2' => ''
            ]
        ];

        $message = [
            'status' => false,
            'message' => 'ไม่สามารถบันทึกข้อมูลได้'
        ];
        $conditions = [];
        $brand = $this->request->query('brand_id') ?? null;
        $type = $this->request->query('type_id') ?? null;
        $code = $this->request->query('code') ?? null;
        $conditions[] = ['cars.user_id', $this->authUser['id']];
        if ($brand != null) {
            $conditions[] = ['brand_id', $brand];
        }

        if ($type != null) {
            $conditions[] = ['type_id', $type];
        }

        if ($code != null) {
            $conditions[] = ['code', $code];
        }

        $response['types'] = $this->type->getList();
        $response['brands'] = $this->brand->getList();
        $response['provinces'] = $this->province->getList();
        $cars = $this->car
            ->where($conditions)
            ->orderBy('id', 'desc')
            ->paginate(20);
        
        $response['cars'] = $cars;
        if ($this->request->isMethod('post')) {
            $this->validate($this->request, $this->rules['add']);
            $message = $this->add($this->request);
            return redirect('backend/car')->with('message', $message);
        }

        return view('backend.car.index', $response);
    }

    public function add($request)
    {
        $this->authUser = Auth::user();
        $message = [
            'status' => false,
            'message' => "Errors can't save data."
        ];

        if ($request->hasFile('image')) {
            $upload = $this->uploadFileAsp($request->file('image'), 'cars', 500);
            if ($upload['status'] == false) {
                return [
                    'status' => false,
                    'message' => $upload['error_message']
                ];
            }

            $this->car->image = $upload['file_name'];
        }

        $params = $request->all();
        $this->car->user_id = $this->authUser['id'];
        $this->car->brand_id = $params['brand_id'];
        $this->car->type_id = $params['type_id'];
        $this->car->generation_name = $params['generation_name'];
        $this->car->year = $params['year'];
        $this->car->cc = $params['cc'];
        $this->car->gear = $params['gear'];
        $this->car->price = $params['price'];
        $this->car->description = $params['description'];
        $this->car->code = $params['code'];

        if ($this->car->save()) {
            $message = [
                'status' => true,
                'message' => "บันทึกข้อมูลแล้ว"
            ];
        }

        return $message;
    }

    public function edit($carId)
    {
        $this->authUser = Auth::user();
        $message = [
            'status' => false,
            'message' => "Errors can't save data."
        ];

        $car = $this->car->find($carId);
        if ($car['user_id'] !== $this->authUser['id']) {

            return redirect()->back()->with('message', $message);
        }

        if ($this->request->hasFile('image')) {
            $upload = $this->uploadFileAsp($this->request->file('image'), 'cars', 500);
            if ($upload['status'] == false) {
                return [
                    'status' => false,
                    'message' => $upload['error_message']
                ];
            }

            $car->image = $upload['file_name'];
        }

        $params = $this->request->all();
        $car->brand_id = $params['brand_id'];
        $car->type_id = $params['type_id'];
        $car->generation_name = $params['generation_name'];
        $car->year = $params['year'];
        $car->cc = $params['cc'];
        $car->gear = $params['gear'];
        $car->price = $params['price'];
        $car->description = $params['description'];
        $car->code = $params['code'];

        if ($car->save()) {
            $message = [
                'status' => true,
                'message' => "บันทึกการแก้ไขข้อมูลแล้ว"
            ];
        }

        return redirect()->back()->with('message', $message);
    }

    public function delete($carId)
    {
        $this->authUser = Auth::user();
        $message = [
            'status' => false,
            'message' => "Errors can't delete data."
        ];
        $car = $this->car->find($carId);
        if ($car['user_id'] !== $this->authUser['id']) {
            return redirect()->back()->with('message', $message);
        }

        if ($car->delete()) {
            $message = [
                'status' => true,
                'message' => "ลบข้อมูลแล้ว"
            ];
        }

        return redirect()->back()->with('message', $message); 
    }
}