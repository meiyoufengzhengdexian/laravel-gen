<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Model\Permission;
use App\Model\Role;
use App\Providers\TestServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Debug\Dumper;
use Lib\Fz\src\Test;

class TestController extends Controller
{
    //创建角色
    public function test1()
    {
        $owner = new Role();
        $owner->name = 'owner';
        $owner->display_name = 'Project Owner';
        $owner->description = 'User is the owner of a given project';
        $owner->save();

        $admin = new Role();
        $admin->name = 'admin';
        $admin->display_name = 'User Administrator';
        $admin->description = 'User is allowed to manage and edit other users';
        $admin->save();
    }

    //角色赋权
    public function test2()
    {
        $admin = Role::where('name', 'admin')->first();
        $user = Admin::where('name', 'admin')->first();

        $user->attachRole($admin); // 参数可以是Role对象，数组或id

    }

    //管理员赋角色
    public function test3()
    {
        $createPost = new Permission();
        $createPost->name = 'create-post';
        $createPost->display_name = 'Create Posts';
        $createPost->description = 'create new blog posts';
        $createPost->save();

        $editUser = new Permission();
        $editUser->name = 'edit-user';
        $editUser->display_name = 'Edit Users';
        $editUser->description = 'edit existing users';
        $editUser->save();

        $owner = Role::where('name', 'owner')->first();
        $admin = Role::where('name', 'admin')->first();
        $owner->attachPermission($createPost);

        $admin->attachPermissions(array($createPost, $editUser));
    }

    //检查权限
    public function test4()
    {
        $admin = Admin::where('name', 'admin')->first();
        $hasAdminRole = $admin->hasRole('admin');

        (new Dumper())->dump($hasAdminRole);

        $adminCanEditUser = $admin->can('create-post');
        (new Dumper())->dump($adminCanEditUser);
    }

    //服务提供者
    public function test5(Test $t)
    {
        $t->getServer();
    }
}
