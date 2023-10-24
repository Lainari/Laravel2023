<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    // test 메서드
    public function test() : View{
        return view('welcome');
    }

    public function create() : View{
        return view('register_form');
    }

    public function store(Request $req) : View{
        $name = $req->input("name");
        $email = $req->input("email");
        $birthDate = $req->input("birthDate");
        $organization = $req->input("organization");
        return view('register', ['name'=>$name, 'email'=>$email,'birthDate'=>$birthDate, 'organization'=>$organization]);
    }

    public function edit(Request $req) : View{
        $name = $req->input("name");
        $birthDate = $req->input("birthDate");
        return View('update_form', ['name'=>$name, 'birthDate'=>$birthDate]);
    }

    public function update(Request $req) : View{
        $name = $req->input("name");
        $email = $req->input("email");
        $birthDate = $req->input("birthDate");
        $organization = $req->input("organization");
        return View('update', ['name'=>$name, 'email'=>$email,'birthDate'=>$birthDate, 'organization'=>$organization]);
    }

    public function index() : View{
        return View('list');
    }

    public function destroy(Request $req) : View{
        $deleted_name = $req->input("deleted_name");

        return view('remove', ['deleted_name'=>$deleted_name]);
    }
}