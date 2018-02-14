<?php

namespace Jetwaves\LaravelExplorer;

// only used for laravel 5.5
class LaravelDirUtil55
{

    public static function showFolders($returnStringAndNoEcho = false){
        $appFolderInfo = '';
        $appFolderInfo = $appFolderInfo.'appRoot               = '.self::getAppRoot()             ."\n";   // 项目根目录
        $appFolderInfo = $appFolderInfo.'appPath               = '.self::getAppPath()             ."\n";   // app目录
        $appFolderInfo = $appFolderInfo.'controllerDir         = '.self::getControllerPath()      ."\n";   // 控制器目录
        $appFolderInfo = $appFolderInfo.'modelDir              = '.self::getModelPath()           ."\n";   // 模型目录
        $appFolderInfo = $appFolderInfo.'transformerDir        = '.self::getTransformerPath()     ."\n";   // transformer目录
        $appFolderInfo = $appFolderInfo.'unitTestDir           = '.self::getUnitTestPath()        ."\n";   // 单元测试目录
        $appFolderInfo = $appFolderInfo.'unitTestOutputDir     = '.self::getUnitTestOutputPath()  ."\n";   // 单元测试输出目录
        $appFolderInfo = $appFolderInfo.'migrationDir          = '.self::getMigrationPath()       ."\n";   // 数据迁移文件所在目录
        $appFolderInfo = $appFolderInfo.'routerFile            = '.print_r(self::getRouterFile(), true)          ."\n";   // 路由文件
        $appFolderInfo = $appFolderInfo.'controllerTemplate    = '.self::getControllerTemplate()  ."\n";   // 控制器模板
        $appFolderInfo = $appFolderInfo.'modelTemplate         = '.self::getModelTemplate()       ."\n";   // 模型模板
        $appFolderInfo = $appFolderInfo.'transformerTemplate   = '.self::getTransformerTemplate() ."\n";   // transformer模板
        $appFolderInfo = $appFolderInfo.'unitTestTemplate      = '.self::getUnitTestTemplate()    ."\n";   // 单元测试模板
        $appFolderInfo = $appFolderInfo.'migrationTemplate     = '.self::getMigrationTemplate()   ."\n";   // 数据迁移文件模板
        $appFolderInfo = $appFolderInfo.'seederDir             = '.self::getSeederPath()          ."\n";   // 测试数据种子目录
        $appFolderInfo = $appFolderInfo.'seederFile            = '.self::getSeederTemplate()      ."\n";   // 测试数据种子文件
        if($returnStringAndNoEcho) {
            return $appFolderInfo;
        } else {
            echo $appFolderInfo;
            return '';
        }
    }

    public static function getAppRoot(){
        $packageDir = dirname(dirname(__FILE__));   // dir of this composer package   ( laravelProject/vendor/jetwaves/laravel-explorer)
        $vendorDir = dirname($packageDir);              // dir of the vendor[developper]  (  laravelProject/vendor/jetwaves_github_user)
        $vendorBaseDir = dirname($vendorDir);       // dir of the vendors base (   laravelProject /vendor )
        $baseDir = dirname($vendorBaseDir);             //  dir of the Laravel project (which contains App, vendor, config etc)
//        return compact('packageDir','vendorDir','vendorBaseDir','baseDir');
        return $baseDir;
    }

    public static function getDirSeperator(){
        return DIRECTORY_SEPARATOR;
    }

    public static function getAppPath(){
        return implode(self::getDirSeperator(),[self::getAppRoot(),'app']);
    }

    public static function getConfigPath(){
        return implode(self::getDirSeperator(),[self::getAppRoot(),'config']);
    }

    public static function getControllerPath(){
        return implode(self::getDirSeperator(),[self::getAppRoot(),'app','Http','Controllers']); // 控制器目录
    }

    public static function getModelPath(){
        return implode(self::getDirSeperator(),[self::getAppRoot(),'app','Models']);                  // 模型目录
    }

    public static function getMiddlewarePath(){
        return implode(self::getDirSeperator(),[self::getAppRoot(),'app','Http', 'Middleware']);      // 中间件目录
    }

    public static function getTransformerPath(){
        return implode(self::getDirSeperator(),[self::getAppRoot(),'app','Transformers']);      // transformer目录
    }

    public static function getUnitTestPath(){
        return implode(self::getDirSeperator(),[self::getAppRoot(),'tests']);                      // 单元测试目录
    }

    public static function getUnitTestOutputPath($dirName = 'testOutput'){
        return implode(self::getDirSeperator(),[self::getAppRoot(), $dirName]);                      // 单元测试目录
    }

    public static function getMigrationPath(){
        return implode(self::getDirSeperator(),[self::getAppRoot(),'database','migrations']);     // 数据迁移文件目录
    }

    public static function getControllerTemplate(){
        return implode(self::getDirSeperator(), [self::getControllerPath(),'EntityController.php']);     // 控制器模板
    }

    public static function getModelTemplate(){
        return implode(self::getDirSeperator(), [self::getModelPath(),'EntityModel.php']);                    // 模型模板
    }

    public static function getTransformerTemplate(){
        return implode(self::getDirSeperator(), [self::getTransformerPath(),'EntityTransformer.php']);  // transformer模板
    }

    public static function getUnitTestTemplate(){
        return implode(self::getDirSeperator(), [self::getUnitTestPath(),'EntityTest.php']);               // 单元测试模板
    }

    public static function getMigrationTemplate(){
        return implode(self::getDirSeperator(), [self::getMigrationPath(),'EntityMigration.php']);        // 数据迁移文件模板
    }

    public static function makeControllerFullName($entityName){
        $entityName = self::convertUnderscoreToUcFirst(strtolower($entityName));        // 驼峰命名的实体名称
        return implode(self::getDirSeperator(), [self::getControllerPath(), $entityName.'Controller.php']);   // 新实体的控制器文件
    }

    public static function makeModelFullName($entityName){
        $entityName = self::convertUnderscoreToUcFirst(strtolower($entityName));        // 驼峰命名的实体名称
        return implode(self::getDirSeperator(), [self::getModelPath(), $entityName.'Model.php']);                  // 新实体的模板文件
    }

    public static function makeTransformerFullName($entityName){
        $entityName = self::convertUnderscoreToUcFirst(strtolower($entityName));        // 驼峰命名的实体名称
        return implode(self::getDirSeperator(), [self::getTransformerPath(), $entityName.'Transformer.php']);// 新实体的transformer文件
    }

    public static function makeUnitTestFullName($entityName){
        $entityName = self::convertUnderscoreToUcFirst(strtolower($entityName));        // 驼峰命名的实体名称
        return implode(self::getDirSeperator(), [self::getUnitTestPath(), $entityName.'Test.php']);             // 新实体的单元测试文件
    }

    public static function getSeederPath(){
        return implode(self::getDirSeperator(),[self::getAppRoot(),'database','seeds']);                                 // 测试数据种子目录
    }

    public static function getSeederTemplate(){
        return implode(self::getDirSeperator(),[self::getAppRoot(),'database','seeds','DatabaseSeeder.php']);            // 测试数据种子文件
    }

    public static function getRouterFile($customName =''){
        $routerPath = self::getRouterPath();
        $routes =  [
            'web'              =>  implode(DIRECTORY_SEPARATOR,[$routerPath,'web.php']),
            'api'                =>  implode(DIRECTORY_SEPARATOR,[$routerPath,'api.php']),
            'channels'      =>  implode(DIRECTORY_SEPARATOR,[$routerPath,'channels.php']),
            'console'       =>  implode(DIRECTORY_SEPARATOR,[$routerPath,'console.php'])
        ];
        if($customName){
            $routes[$customName] = implode(DIRECTORY_SEPARATOR,[$routerPath, $customName.'.php']);
        }
        return $routes;
    }

    public static function getRouterPath(){
        return implode(self::getDirSeperator(),[self::getAppRoot(),'routes']);          // 路由文件
    }

    public static function getCaptchasDirectoryPath(){
        return implode(self::getDirSeperator(),[self::getAppRoot(),'temp','captchas']);         // 验证码输出目录
    }

    public static function getTempPath(){
        return implode(self::getDirSeperator(),[self::getAppRoot(),'temp']);                // 临时文件目录
    }


    /**
     * 把下划线分隔的字符串转换成首字母大写的驼峰命名法
     *    var_name_like_a_snake  =>   VarNameLikeASnake
     * @param  $varNameLikeSnake [string] [variable name like a snake]
     * @return string
     */
    private static function convertUnderscoreToUcFirst($varNameLikeSnake){
        $arr = explode('_',$varNameLikeSnake);
        foreach($arr as $idx => $ele){
            $arr[$idx] = ucfirst($ele);
        }

        $res = implode('',$arr);
        return $res;
    }

}