<?php
namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;

use Auth;
use App\User;
use App\Branche;

class BrancheController extends \App\Http\Controllers\Controller
{
    protected $request;
    protected $user;
    protected $branche;
    protected $authUser;

    public function __construct(
        Request $request,
        User $user,
        Branche $branche
    ) {
        $this->request = $request;
        $this->user = $user;
        $this->branche = $branche;
    }

    public function index()
    {
        $this->authUser = Auth::user();
        $response = [
            'bad' => [
                'item_1' => 'Home',
                'item_2' => 'Branche'
            ]
        ];

        $conditions = [];
        $conditions[] = ['user_id', $this->authUser['id']];
        $branches = $this->branche
            ->where($conditions)
            ->orderBy('id', 'desc')
            ->paginate(20);
        
        $response['branches'] = $branches;

        return view('backend.branche.elements.table_list', $response);
    }

    public function add()
    {
        $this->authUser = Auth::user();
        $response = [
            'status' => false,
            'message' => "Errors can't save data.",
            'token' => csrf_token()
        ];

        $params = $this->request->all();
        $this->branche->user_id = $this->authUser['id'];
        $this->branche->province_id = $params['province_id'];
        $this->branche->district_id = $params['district_id'];
        $this->branche->name = $params['name'];

        if ($this->branche->save()) {
            $response = [
                'status' => true,
                'message' => "บันทึกข้อมูลแล้ว"
            ];
        }

        return response()->json($response);
    }

    public function edit($brancheId)
    {
        $this->authUser = Auth::user();
        $response = [
            'status' => false,
            'message' => "Errors can't save data.",
            'token' => csrf_token()
        ];

        $branche = $this->branche->find($brancheId);
        $params = $this->request->all();
        $branche->province_id = $params['province_id'];
        $branche->district_id = $params['district_id'];
        $branche->name = $params['name'];

        if ($branche->save()) {
            $response = [
                'status' => true,
                'message' => "บันทึกข้อมูลแล้ว"
            ];
        }

        return response()->json($response);
    }

    public function delete($brancheId)
    {
        $this->authUser = Auth::user();
        $response = [
            'status' => false,
            'message' => "Errors can't delete data.",
            'token' => csrf_token()
        ];

        $branche = $this->branche->find($brancheId);
        if ($branche['user_id'] !== $this->authUser['id']) {
            return response()->json($response);
        }

        if ($branche->delete()) {
            $response = [
                'status' => true,
                'message' => "ลบข้อมูล " . $branche['name'] . " แล้ว"
            ];
        }

        return response()->json($response);
    }
}