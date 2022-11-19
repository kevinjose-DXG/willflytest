<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Vendor;

class ApiController extends BaseController
{
    /**
     * 
     */
    public function vendorLogin(Request $request){
        $mobile         = $request->mobile;
        $vendor         = Vendor::where('status','active')->where('mobile',$mobile)->first();
        $random         = random_int(100000, 999999);
        if($vendor){
            if($vendor->is_vendor=='1'){
                if($request->otp!=""){
                    if($vendor->otp==$request->otp){ 
                        Auth::login($vendor);
                        // get new token
                        $tokenResult = $vendor->createToken('MyApp');
                        $token = $tokenResult->accessToken;
                        return response()->json(['success' => ['token' => $token]], 200);
                    }else{
                        return $this->sendError('OTP Miss Match','',200);
                    }
        
                    // // if($vendor->otp==$request->otp){
                    //     $credentials = ['mobile' => $request->mobile,
                    //                       'otp' => $request->otp,
                    //                       'password'=>'123456789'];
                    // if(Auth::guard('web')->attempt($credentials)){
                    //     $token = auth('web')->user()->createToken('MyApp')->accessToken;
                    //     return response()->json(['token' => $token], 200);
                    // }else{
                    //     return $this->sendError('OTP Miss Match','',200);
                    // }
                }else{
                    if($vendor->verified=="1"){
                        $vendor->otp        = $random;
                        $vendor->save();
                        $data = [
                            'otp'           => $random,
                            'verified'      => 1,
                        ];
                        return $this->sendResponse($data, 'Success');
                    }else{
                        $vendor->otp        = $random;
                        $vendor->save();
                        $data               = [
                            'otp'           => $random,
                            'verified'      => 0,
                        ];
                        return $this->sendResponse($data, 'false');
                    }
                }
            }else{
                return $this->sendError('No Vendor Found','',200);
            }
        }else{
            $vendor                     = new Vendor();
            $vendor->mobile             = $request->mobile;
            $vendor->otp                = $random;
            $vendor->is_vendor          = '1';
            $vendor->save();
            $data = [
                'otp'           => $random,
                'verified'      => 0,
                'vendor_id'     => $vendor->id,
            ];
            return $this->sendResponse($data, 'false');
        }
    }
    /**
     * 
     */
    /**
     * 
     */
    public function vendorDetail(Request $request){ 
        dd("KK");
        $user   = Auth::guard('api')->user();
    }
}
