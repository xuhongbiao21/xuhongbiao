<?php
namespace app\admin\controller;//定义命名空间autoload会自动引入文件
use houdunwang\core\Controller;//使用这个目录下的类 工具类
use houdunwang\view\View;//自动找到模版的类
use system\model\Material as MaterialModel;//自动找到类的方法
use app\admin\controller\Common;
class Material extends Common
{
    /**
     * 显示素材列表
     */
    public function lists()//图片类
    {
        $data = MaterialModel::get();//就是查询数据库的数据 为了分配变量
        //返回自己 调出模版
        return View::make()->with(compact('data'));//
    }

    /**
     * 增加素材
     * @return $this
     */
    public function store()
    {
        if (IS_POST) {//是否为post提交
            //上传，返回上传的信息
            $info = $this->upload();
            //把上传之后的信息保存到数据库
            $data = [
                'path' => $info['path'],
                'create_time' => time()
            ];
            MaterialModel::save($data);//先查询字段在添加
            //调用工具类的方法 跳转和提示
            return $this->setRedirect("?s=admin/material/lists")->success('上传成功');
        }
        //返回自己 调出模版
        return View::make();
    }

    private function upload()//上传模型类
    {
        //创建上传目录
        $dir = 'upload/' . date('ymd');
        is_dir($dir) || mkdir($dir, 0777, true);
        //设置上传目录
        $storage = new \Upload\Storage\FileSystem($dir);
        $file = new \Upload\File('upload', $storage);
        //设置上传文件名字唯一
        // Optionally you can rename the file on upload
        $new_filename = uniqid();
        $file->setName($new_filename);

        //设置上传类型和大小
        // Validate file upload
        // MimeType List => http://www.iana.org/assignments/media-types/media-types.xhtml
        $file->addValidations(array(
            // Ensure file is of type "image/png"
            new \Upload\Validation\Mimetype(['image/png', 'image/gif', 'image/jpeg']),

            //You can also add multi mimetype validation
            //new \Upload\Validation\Mimetype(array('image/png', 'image/gif'))

            // Ensure file is no larger than 5M (use "B", "K", M", or "G")
            new \Upload\Validation\Size('2M')
        ));

        //组合数组
        // Access data about the file that has been uploaded
        $data = array(
            'name' => $file->getNameWithExtension(),
            'extension' => $file->getExtension(),
            'mime' => $file->getMimetype(),
            'size' => $file->getSize(),
            'md5' => $file->getMd5(),
            'dimensions' => $file->getDimensions(),
            //自己组合的上传之后的完整路径
            'path' => $dir . '/' . $file->getNameWithExtension(),
        );


        // Try to upload file
        try {//捕获异常错误
            // Success!
            $file->upload();//上传方法

            return $data;//返回当前对象
        } catch (\Exception $e) {//如果有异常错误
            // Fail!
            $errors = $file->getErrors();//就早到异常错误
            foreach ($errors as $e) {//同时遍历错误 有多少错误 就会输出多少条错误
                throw new \Exception($e);
            }

        }
    }

    /**
     * 删除
     */
    public function remove()
    {    //要删除的当前数据
        $mid = $_GET['mid'];
        //找到当前绕删除的那条数据
        $data = MaterialModel::find($mid);
        //删除文件
        is_file($data['path']) && unlink($data['path']);
        //删除数据库信息
        MaterialModel::where("mid={$mid}")->destory();
        //调用工具类的方法 跳转和提示
        return $this->setRedirect("?s=admin/material/lists")->success('删除成功');

    }
}








