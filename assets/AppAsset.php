<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        //'css/style.css'
    ];
    // свойства в классе задаются через метод registerJsFile()
    public $js = [
        //'js/scripts.js'
    ];

    // указываюися зависимости
    // если наши скрипты зависят от других скриптов (jquery)
    // в св-ве depends можем указать от чего зависит наш срипт
    // это значит, что наш скрипт будет подключен после скрипта от которого он зависит
    public $depends = [
        'yii\web\YiiAsset',
        // подключаем bootstrap.css и bootstrap.js
        'yii\bootstrap\BootstrapPluginAsset',
    ];
    
    // Позволяет управлять позицией подключение файлов
    // По умолчанию файлы подкючены в футере
    public $jsOptions = [
        // Подключим файл в футере
        'position' => \yii\web\View::POS_END
    ];

    /**
    * registerJs() public method - Registers a JS code block (позволяет зарегистрировать блок кода )
    * метод registerJsFile() - подключает файл
    **/

    /**
    * public void registerJsFile ( $url, $options = [], $key = null )
    * public void registerJsFile ( путь к файлу, $options = [], $key = null )
    **/

    /**   
        The HTML attributes for the script tag. The following options are specially handled and are not treated as HTML attributes:
        depends: array, specifies the names of the asset bundles that this JS file depends on.
        position: specifies where the JS script tag should be inserted in a page. The possible values are:
        POS_HEAD: in the head section
        POS_BEGIN: at the beginning of the body section
        POS_END: at the end of the body section. This is the default value.
    **/
}
