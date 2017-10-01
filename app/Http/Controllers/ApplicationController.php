<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\User;
use App\Province;
use App\District;

class ApplicationController extends Controller
{
    protected $request;
    protected $user;
    protected $province;
    protected $district;

    public function __construct(
        Request $request,
        User $user,
        Province $province,
        District $district
    ) {
        $this->request = $request;
        $this->user = $user;
        $this->province = $province;
        $this->district = $district;
    }

    public function dashboard()
    {
        $response = [];

        return view('backend.dashboard', $response);
    }
    
    public function getProvinces()
    {
        $provinces = $this->province
            ->orderBy('name_th', 'asc')
            ->get();
        
        return response()->json($provinces);
    }

    public function getDistricts($provinceId)
    {
        $districts = $this->district
            ->where('province_id', $provinceId)
            ->orderBy('name_th', 'asc')
            ->get();
        
        return response()->json($districts);
    }
}