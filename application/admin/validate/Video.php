<?php
namespace app\admin\validate;

use think\Validate;

class Video extends Validate
{
    protected $rule = [
        'videoname'  =>  'require|max:9',
    ];

}
