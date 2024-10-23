<?php

namespace App\Http\Controllers;
use App\Models\Device;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DeviceController extends Controller
{
    //
    function list(){
        return [Device::all(), User::all()]; // simply we can get all data from the database and here is the example how can we import data from two tables at once
    }

    function list_params($name=null){
        $result = DB::table('devices')->where('name', $name)->first(); //we can et like this by just using {name} in params
        // retun $id?Device:find($id):Device.all();  this way we can get dat by just using {id}
        return $name?$result: Device::all();
    }

        //POST API RESOURCE
    function add(Request $req){
        $device = new Device;
        $device->name = $req->name;
        $device->email = $req->email;
        $result=$device->save();
        if($result){
            return ["result"=> "data has been Saved"];
        }else{
            return ["result"=>"Data Is Not saved"];
        }

    }
        // PUT API RESOURCE
    function update(Request $req){
        $device=Device::find($req->id);
        $device->name = $req->name;
        $device->email = $req->email;
        $result=$device->save();
        if($result){
            return ["result=> data updated"];
        }else{
            return ["result=>data not updataed"];
        }
    }

    function search($name){
        // return Device::where("name", $name)->get();
        $result = Device::where("name", "like", "%".$name."%")->get();
        if(Device::where("name", "like", "%".$name."%")->exists()){
            return $result;
        }else{

            return "No Data Found";
        }

    }

    function delete($id){

        $res = Device::where("id", $id)->delete();
        if($res){
            return ["result=> Data Has Been Deleted"];
        }else{
            return ["result=>Data has been Not found"];
        }
    }

    //Api Validation
    function testData(Request $req){
        $rules=array(
            "name"=>"required",
            "email"=>"required"

        );
        $validator = Validator::make($req->all(), $rules);
        if($validator->fails()){
            return $validator->errors();
        }else{
            $device = new Device;
            $device->name = $req->name;
            $device->email = $req->email;
            $result=$device->save();
            if($result){
                return ["result"=> "data has been Saved"];
            }else{
                return ["result"=>"Data Is Not saved"];
            }
        }

    }


}
