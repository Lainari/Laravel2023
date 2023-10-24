<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected static $users = [
        ['id'=>1, 'name'=>'김민재', 'birthDate'=>'1996/11/15','email'=>'mjkim4@gmail.com', 'organization'=>'바이에른 뮌헨'],
        ['id'=>2, 'name'=>'大谷', 'birthDate'=>'1994/07/05','email'=>'ohtanishohey@gmail.com', 'organization'=>'로스엔젤레스 에인절스'],
        ['id'=>3, 'name'=>'손흥민', 'birthDate'=>'1992/07/08','email'=>'hmson7@gmail.com', 'organization'=>'토트넘 핫스퍼'],
        ['id'=>4, 'name'=>'渡辺', 'birthDate'=>'1994/10/13','email'=>'watanabe@gmail.com', 'organization'=>'피닉스 선스'],
        ['id'=>5, 'name'=>'Kane', 'birthDate'=>'1993/07/28','email'=>'kane10@gmail.com', 'organization'=>'바이에른 뮌헨'],
        ['id'=>6, 'name'=>'Ronaldo', 'birthDate'=>'1985/02/05','email'=>'ronaldo7@gmail.com', 'organization'=>'알 나스르'],
        ['id'=>7, 'name'=>'Messi', 'birthDate'=>'1987/06/24','email'=>'messi10@gmail.com', 'organization'=>'인터 마이에미']
    ];

    public function index()
    {
        /*
            1. DB에서 사용자 정보를 가져온다
            2. 가져온 사용자 정보를 blade 파일에 넘겨주면서 실행한다
         */
        // $users = [
        //     ['id'=>1, 'name'=>'김민재', 'birthDate'=>'1996/11/15','email'=>'mjkim4@gmail.com'],
        //     ['id'=>2, 'name'=>'大谷', 'birthDate'=>'1994/07/05','email'=>'ohtanishohey@gmail.com'],
        //     ['id'=>3, 'name'=>'손흥민', 'birthDate'=>'1992/07/08','email'=>'hmson7@gmail.com'],
        //     ['id'=>4, 'name'=>'渡辺', 'birthDate'=>'1994/10/13','email'=>'watanabe@gmail.com'],
        //     ['id'=>5, 'name'=>'Kane', 'birthDate'=>'1993/07/28','email'=>'kane10@gmail.com'],
        //     ['id'=>6, 'name'=>'Ronaldo', 'birthDate'=>'1985/02/05','email'=>'ronaldo7@gmail.com'],
        //     ['id'=>7, 'name'=>'Messi', 'birthDate'=>'1987/06/24','email'=>'messi10@gmail.com']
        // ]; // DB에서 읽어온 정보를 $users 변수에 할당했다고 가정
        return View('welcome', ['users'=>UserController::$users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return View('register_form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        /*
            1. Request 객체로부터 사용자가 폼에 입력한 값을 꺼낸다
            2. 1.에서 꺼낸 값을 DB에 넣는다
            3. 등록결과 페이지를 만들어서 반환한다
        */
        $name = $req -> input('name');
        $email = $req -> input('email');
        $organization = $req -> input('organization');
        $birthDate = $req -> input('birthDate');
        return View('register', ['name'=>$name, 'email'=>$email, 'organization'=>$organization, 'birthDate'=>$birthDate]);
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $name)
    public function show(string $id)
    {
        /*
            1. $name을 가지고 DB에서 레코드 하나를 인출한다
                // select * from users where id = $id
            2. 인출된 그 정보를 변수 $user에 할당
            3. 그 $user 값을 blade 에 전달하면서 실행
        */
        // return View('user',['name'=>$name]);

        $userFound = null;
        foreach(UserController::$users as $user){
            if($user['id']==$id){
                $userFound = $user;
                break;
            }
        }
        // $userFound : ['id'=>1, 'name'=>'고길동', ...]
        // 못 찾았으면 $userFound는 null 값을 가질텐데,
        // 이 때 null 대신에 빈 배열 [] 를 블레이드 파일에 넘겨주자.
        $userFound = $userFound != null ? $userFound : [];
        
        return view('user_info',['user'=>$userFound]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        /*
            1. $id 값에 해당하는 사용자 정보를 DB에서 읽어온다
            2. 읽어온 그 사용자 정보를 blade 파일에 넘겨주고 그 blade를 실행
        */
        $userFound = null;
        foreach(UserController::$users as $user){
            if($user['id']==$id){
                $userFound = $user;
                break;
            }
        }
        // $userFound : ['id'=>1, 'name'=> ...]
        return view('update_form', ['user'=>$userFound]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, string $id)
    {
        /*
            1. Request 객체에서 사용자가 입력한 값을 빼와야 된다
            2. 위에서 빼온 값으로 $id에 해당하는 DB 레코드를 찾아서 update를 한다
            3. 사용자 상세보기 view로 연결시켜 준다
        */
        $name = $req -> input('name');
        $email = $req -> input('email');
        $birthDate = $req -> input('birthDate');
        $organization = $req -> input('organization');

        $updatedUser = null;
        // foreach(UserController::$users as $user){
        //     if ($user["id" == $id]) {
        //         # code...
        //         $user["name"] = $name;
        //         $user["birthDate"] = $birthDate;
        //         $user["email"] = $email;
        //         $updatedUser = $user;
        //         break;
        //     }
        // }
        for ($i = 0; $i < sizeof(static::$users); $i++){
            if(static::$users['id'] == $id){
                static::$users["name"] = $name;
                static::$users["birthDate"] = $birthDate;
                static::$users["email"] = $email;
                $updatedUser = static::$users;
                break;
            }
        }

        return View('user_info', ['user'=>$updatedUser]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        /*
            1. PRIMARY KEY 칼럼 값으로 $id 값을 가지는 레코드를 DB에서 찾아서 삭제
            2. 리스트 페이지를 생성해 반환
        */
        for ($i = 0; $i < sizeof(static::$users); $i++){
            if(static::$users[$i]['id'] == $id){
                unset(static::$users[$i]);
            }
        }
        return view('welcome', ['users'=>static::$users]);
    }
}
