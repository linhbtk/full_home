<?php
    $web  = dirname(dirname(__FILE__));
    $base = dirname($web);
    Yii::setPathOfAlias('web', $web);
    $baseArray = require($base . '/config/main.php');
    $webArray  = array(
        'basePath'          => $base,
        'preload'           => array(
            'log',
            'yiibooster',
        ),
        'controllerPath'    => $web . '/controllers',
        'viewPath'          => $web . '/views',
        'runtimePath'       => $web . '/runtime',
        'defaultController' => 'site',
        'import'            => array(
            'web.models.*',
            'web.components.*',
            'application.models.*',
            'application.components.*',
            'application.extensions.*',
            'application.extensions.loadConfigXML.*',
            'web.components.MSISDN_DETECT.*',
        ),
        'language'          => 'vi',
        'params'            => require(dirname(__FILE__) . '/params.php'),
        'components'        => array(
            'errorHandler' => array(
                'errorAction' => 'site/error',
            ),

            'yiibooster'   => array(
                'class' => 'ext.yiibooster.components.Booster', // assuming you extracted bootstrap under extensions
            ),
            'user'         => array(
                'class'          => 'WebUser',
                // enable cookie-based authentication
                'allowAutoLogin' => TRUE,
                'identityCookie' => array(
                    'httpOnly' => TRUE,
                )
            ),
            // uncomment the following to enable URLs in path-format
            'urlManager'   => array(
                'urlFormat'      => 'path', // 'path' or 'get'
                'showScriptName' => FALSE, // show index.php
                'caseSensitive'  => TRUE, // case sensitive
                'rules'          => array(

                    ''                              => 'site/index',
                    '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                ),
            ),
        ),

        'theme'             => 'default',
    );
    if (!function_exists('w3_array_union_recursive')) {
        /**
         * This function does similar work to $array1+$array2,
         * except that this union is applied recursively.
         *
         * @param array $array1 - more important array
         * @param array $array2 - values of this array get overwritten
         *
         * @return array
         */
        function w3_array_union_recursive($array1, $array2)
        {
            $retval = $array1 + $array2;
            foreach ($array1 as $key => $value) {
                if (isset($array2[$key]) && isset($array2[$key]) && is_array($array1[$key]) && is_array($array2[$key])) {
                    $retval[$key] = w3_array_union_recursive($array1[$key], $array2[$key]);
                }
            }

            return $retval;
        }

    }

    return w3_array_union_recursive($webArray, $baseArray);
?>