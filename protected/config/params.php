<?php
    /** Lấy tên domain gốc
     * @param null $name: tên nối domain hiện tại
     *
     * @return string
     */
    function getCurrentDomain($name = null){
        $pageURL = 'http';
        if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"] . $name;
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"] . $name;
        }
        return $pageURL;
    }

    return array(
        'elastic_config'    =>  array(
            'index' =>  'citv2',           //<=> DB in mysql
            'hosts' =>  array(
                'http://localhost:9200', //default host:ip
//                'http://10.2.0.107:8694'

                //'192.168.1.1:9200',                 // IP + Port
                //'192.168.1.2',                      // Just IP
                //'mydomain.server.com:9201',         // Domain + Port
                //'mydomain2.server.com',             // Just Domain
                //'https://localhost',                // SSL to localhost
                //'https://192.168.1.3:9200',         // SSL to IP + Port
                //'http://user:pass@localhost:9200',  // HTTP Basic Auth
                //'https://user:pass@localhost:9200',  // SSL + HTTP Basic Auth
            ),
        ),
        'allows_ips_search' =>  array(          //ip allows Api search
//            //localhost
//            '::1' => '::1',
//            '127.0.0.' => '1|1',
//
//            //server dev
//            '10.2.0.' => '107|107,179|179',
//
//            //vovthethao.vn
//            '113.191.248.'   =>  '185|185',
//
//            // centech
//            '118.70.177.' =>  '77|77',
//            '222.252.19.'   =>  '197|197',
        ),
        'xml_folder'      => dirname(dirname(__FILE__)) . '/xml/',
        'image_ext'       => array('gif', 'jpg', 'jpeg', 'pjpeg', 'png'),
        'status'          => array(
            '1' => 'Kích hoạt',
            '0' => 'Tạm ngừng',
        ),
        'time_cache' => 120,
        'text_add' => "Add favorite",
        'text_remove' => "",
        'time_count_view' => "10",
//        'url_root' => "http://10.2.0.107:8694/citv",
        'url_root' => getCurrentDomain("/citv"),
//        'upload_url'          => getCurrentDomain("/citv"),
        'upload_dir_path' => '../uploads/',
        'dir_videos'      => 'videos/',
        'dir_categories'  => 'categories',
        //--------------> IP_MAP_3G <--------------//
        'IP_MAP_3G'       => array(
            // Last Update : 2015/03/09
            'VIETTEL'   => array(
                //---- Centech IP ----//
//                '118.70.177.77/32',
//                '222.252.19.197/32',
//                '113.190.242.153/32',
                //---- Opera Mini ----//
                ' 37.228.104.0/21',
                ' 58.67.157.0/24',
                ' 59.151.95.128/25',
                ' 59.151.98.128/27',
                ' 59.151.106.224/27',
                ' 59.151.120.32/27',
                ' 80.84.1.0/24',
                ' 82.145.208.0/20',
                ' 107.167.96.0/19',
                ' 107.167.102.0/23',
                ' 107.167.104.0/22',
                ' 107.167.108.0/23',
                ' 107.167.111.0/25',
                ' 107.167.112.0/25',
                ' 107.167.126.0/25',
                ' 107.167.126.128/26',
                ' 107.167.127.0/25',
                ' 91.203.96.0/22',
                ' 123.103.58.0/24',
                ' 141.0.8.0/21',
                ' 185.26.180.0/22',
                ' 195.189.142.0/23',
                ' 209.170.68.0/24',
                //---- Opera Mini ----//
                '27.64.0.0/16',
                '27.64.0.0/17',
                '27.64.128.0/17',
                '27.65.0.0/16',
                '27.66.0.0/16',
                '27.66.0.0/17',
                '27.66.128.0/17',
                '27.67.0.0/16',
                '27.68.0.0/16',
                '27.68.0.0/17',
                '27.68.128.0/17',
                '27.69.0.0/16',
                '27.70.0.0/16',
                '27.71.0.0/16',
                '27.71.0.0/20',
                '27.71.16.0/20',
                '27.71.32.0/20',
                '27.71.48.0/20',
                '27.71.64.0/20',
                '27.71.80.0/20',
                '27.71.96.0/20',
                '27.71.112.0/20',
                '27.71.128.0/17',
                '27.72.0.0/16',
                '27.73.0.0/16',
                '27.74.0.0/16',
                '27.75.0.0/16',
                '27.76.0.0/16',
                '27.77.0.0/16',
                '27.78.0.0/16',
                '27.79.0.0/16',
                '171.224.0.0/16',
                '171.225.0.0/16',
                '171.226.0.0/16',
                '171.227.0.0/16',
                '171.227.0.0/17',
                '171.227.128.0/18',
                '171.227.192.0/19',
                '171.227.224.0/19',
                '171.228.0.0/16',
                '171.229.0.0/16',
                '171.230.0.0/16',
                '171.231.0.0/16',
                '171.232.0.0/16',
                '171.233.0.0/16',
                '171.234.0.0/16',
                '171.235.0.0/16',
                '171.235.0.0/18',
                '171.235.64.0/19',
                '171.235.96.0/19',
                '171.235.128.0/17',
                '171.236.0.0/16',
                '171.237.0.0/16',
                '171.237.0.0/17',
                '171.237.128.0/17',
                '171.238.0.0/16',
                '171.239.0.0/16',
                '171.239.0.0/17',
                '171.239.128.0/17',
                '171.240.0.0/16',
                '171.241.0.0/16',
                '171.241.0.0/17',
                '171.241.128.0/17',
                '171.242.0.0/16',
                '171.243.0.0/16',
                '171.243.0.0/18',
                '171.243.64.0/19',
                '171.243.96.0/20',
                '171.243.112.0/20',
                '171.243.128.0/17',
                '171.244.0.0/16',
                '171.245.0.0/16',
                '171.245.0.0/17',
                '171.245.128.0/19',
                '171.245.160.0/20',
                '171.245.176.0/20',
                '171.245.192.0/18',
                '171.246.0.0/16',
                '171.246.0.0/17',
                '171.246.128.0/17',
                '171.247.0.0/16',
                '171.248.0.0/16',
                '171.249.0.0/16',
                '171.250.0.0/16',
                '171.251.0.0/16',
                '171.251.0.0/18',
                '171.251.64.0/18',
                '171.251.128.0/18',
                '171.251.192.0/18',
                '171.252.0.0/16',
                '171.253.0.0/16',
                '171.254.0.0/16',
                '171.254.0.0/17',
                '171.254.128.0/17',
                '171.255.0.0/16',
                '171.255.0.0/20',
                '171.255.16.0/20',
                '171.255.32.0/20',
                '171.255.48.0/20',
                '171.255.64.0/18',
                '171.255.128.0/17',
                '125.235.49.0/22',
                '125.235.49.0/23',
                '125.235.50.0/24',
                '125.235.51.0/24',
                '125.235.153.0/22',
                '125.235.153.0/23',
                '125.235.154.0/24',
                '125.235.155.0/24',
                '125.234.49.0/22',
                '125.234.49.0/23',
                '125.234.50.0/24',
                '125.234.51.0/24',
                '125.235.64.0/20',
            ),
            'VINAPHONE' => array(
                '10.149.57.142/32',
                '10.149.57.145/32',
                '10.149.57.34/32',
                '10.149.57.35/32',
                '10.149.57.36/32',
                '10.149.57.37/32',
                '10.149.57.38/32',
                '10.149.57.39/32',
                '10.149.57.40/32',
                '10.149.57.41/32',
                '10.149.57.42/32',
                '10.149.57.43/32',
                '10.149.57.44/32',
                '10.149.57.45/32',
                '10.149.57.46/32',
                '10.149.57.46/32',
                '10.149.57.47/32',
                '10.149.57.48/32',
                '10.149.57.49/32',
                '10.149.57.50/32',
                '10.149.57.51/32',
                '10.149.57.52/32',
                '10.149.57.53/32',
                '10.149.57.54/32',
                '10.149.57.55/32',
                '10.149.57.56/32',
                '10.149.57.57/32',
                '10.149.57.58/32',
                '10.149.57.59/32',
                '10.149.57.60/32',
                '10.149.57.61/32',
                '10.149.57.62/32',
                '10.149.57.66/32',
                '10.83.34.134/32',
                '101.99.13.43/32',
                '101.99.53.121/32',
                '113.160.16.118/32',
                '113.160.183.100/32',
                '113.161.100.171/32',
                '113.161.100.217/32',
                '113.161.161.162/32',
                '113.161.176.10/32',
                '113.161.198.1/32',
                '113.161.220.10/32',
                '113.161.74.121/32',
                '113.161.80.108/32',
                '113.161.80.132/32',
                '113.161.80.227/32',
                '113.162.230.110/32',
                '113.162.237.60/32',
                '113.163.187.102/32',
                '113.163.202.99/32',
                '113.169.218.154/32',
                '113.169.235.105/32',
                '113.170.127.5/32',
                '113.172.193.164/32',
                '113.172.194.18/32',
                '113.172.3.7/32',
                '113.185.0.10/32',
                '113.185.0.107/32',
                '113.185.0.11/32',
                '113.185.0.12/32',
                '113.185.0.13/32',
                '113.185.0.14/32',
                '113.185.0.15/32',
                '113.185.0.16/32',
                '113.185.0.191/32',
                '113.185.0.27/32',
                '113.185.0.34/32',
                '113.185.0.36/32',
                '113.185.0.74/32',
                '113.185.2.167/32',
                '113.185.5.155/32',
                '113.185.7.247/32',
                '113.190.170.116/32',
                '113.190.244.6/32',
                '113.21.147.87/32',
                '113.22.210.85/32',
                '115.78.11.41/32',
                '117.3.101.181/32',
                '117.3.5.17/32',
                '117.3.68.69/32',
                '117.6.0.1/32',
                '117.6.132.170/32',
                '117.6.132.184/32',
                '117.6.99.247/32',
                '118.69.34.12/32',
                '118.70.0.241/32',
                '118.70.184.157/32',
                '118.70.6.1/32',
                '123.16.191.19/32',
                '123.16.191.22/32',
                '123.21.118.98/32',
                '123.21.188.200/32',
                '123.21.195.231/32',
                '123.21.34.229/32',
                '123.21.58.143/32',
                '123.24.230.150/32',
                '123.25.238.111/32',
                '123.30.12.99/32',
                '123.30.76.52/32',
                '125.234.1.154/32',
                '183.91.29.169/32',
                '203.162.92.139/32',
                '203.210.208.123/32',
                '203.210.208.123/32',
                '221.132.36.234/32',
                '222.252.21.23/32',
                '222.252.250.137/32',
                '222.253.182.139/32',
                '222.253.216.239/32',
                '222.255.129.43/32',
            ),
            'MOBIFONE'  => array(
                '59.153.252.0/22',
                '59.153.248.0/22',
                '59.153.244.0/22',
                '59.153.240.0/22',
                '59.153.236.0/22',
                '59.153.232.0/22',
                '59.153.228.0/22',
                '59.153.224.0/22',
                '59.153.220.0/22',
                '222.255.209.0/28',
                '222.255.209.0/24',
                '222.255.208.0/28',
                '222.255.208.0/24',
                '183.91.191.0/24',
                '183.91.190.0/24',
                '123.30.165.0/24',
                '113.191.8.128/25',
                '113.191.8.0/24',
                '113.187.8.0/24',
                '113.187.7.0/24',
                '113.187.6.0/24',
                '113.187.4.0/24',
                '113.187.31.0/24',
                '113.187.3.0/24',
                '113.187.25.0/27',
                '113.187.25.0/24',
                '113.187.24.0/27',
                '113.187.24.0/24',
                '113.187.23.0/25',
                '113.187.23.0/24',
                '113.187.22.0/27',
                '113.187.22.0/24',
                '113.187.21.0/24',
                '113.187.20.0/24',
                '113.187.2.0/24',
                '113.187.19.0/24',
                '113.187.18.0/24',
                '113.187.17.128/25',
                '113.187.17.0/25',
                '113.187.16.128/25',
                '113.187.16.0/25',
                '113.187.1.224/27',
                '113.187.1.0/28',
                '113.187.0.0/24',
                '103.237.67.0/24',
                '103.237.66.0/24',
                '103.237.65.0/24',
                '103.237.64.0/24',
                '103.234.89.0/24',
                '103.234.88.0/24',
                '103.199.72.0/22',
                '103.199.68.0/22',
                '103.199.64.0/22',
                '103.199.60.0/22',
                '103.199.56.0/22',
                '103.199.52.0/22',
                '103.199.48.0/22',
                '103.199.44.0/22',
                '103.199.40.0/22',
                '103.199.36.0/22',
                '103.199.32.0/22',
                '103.199.28.0/22',
                '103.199.24.0/22',
                '103.199.20.0/22',
                '101.99.9.128/25',
                '101.99.9.0/25',
                '101.99.8.128/25',
                '101.99.8.0/25',
                '101.99.46.0/24',
                '101.99.29.0/24',
                '101.99.10.128/25',
                '101.99.10.0/25',
                '10.99.0.0/16',
                '10.98.0.0/16',
                '10.96.0.0/16',
                '10.95.0.0/16',
                '10.94.0.0/16',
                '10.93.0.0/16',
                '10.92.0.0/16',
                '10.91.0.0/16',
                '10.90.0.0/16',
                '10.89.0.0/16',
                '10.88.0.0/16',
                '10.87.0.0/16',
                '10.79.0.0/16',
                '10.78.0.0/16',
                '10.77.0.0/16',
                '10.76.0.0/16',
                '10.244.0.0/16',
                '10.242.0.0/15',
                '10.240.0.0/15',
                '10.238.0.0/15',
                '10.236.0.0/15',
                '10.234.0.0/15',
                '10.232.0.0/15',
                '10.230.0.0/15',
                '10.228.0.0/15',
                '10.226.0.0/15',
                '10.224.0.0/15',
                '10.222.0.0/15',
                '10.220.0.0/15',
                '10.218.0.0/15',
                '10.216.0.0/15',
                '10.214.0.0/15',
                '10.212.0.0/15',
                '10.210.0.0/15',
                '10.208.0.0/15',
                '10.206.0.0/15',
                '10.204.0.0/15',
                '10.203.0.0/16',
                '10.202.0.0/16',
                '10.201.0.0/16',
                '10.200.0.0/16',
                '10.199.0.0/16',
                '10.192.0.0/16',
                '10.182.0.0/16',
                '10.181.0.0/16',
                '10.152.0.0/15',
                '10.150.0.0/16',
                '10.148.0.0/15',
                '10.122.0.0/15',
                '10.120.0.0/15',
                '10.110.0.0/15',
                '10.109.0.0/16',
                '10.107.0.0/16',
                '10.106.0.0/16',
                '10.105.0.0/16',
                '10.104.0.0/16',
                '10.103.0.0/16',
                '10.102.0.0/16',
                '10.101.0.0/16',
                '10.100.0.0/16',
            ),
        ),
        //--------------> IP_MAP_3G <--------------//

        'os_content'            => array(
            'ios'        => array(
                'game'      => FALSE,
                'video'     => FALSE,
                'ebook'     => TRUE,
                'wallpaper' => FALSE,
            ),
            'android'    => array(
                'game'      => TRUE,
                'video'     => FALSE,
                'ebook'     => TRUE,
                'wallpaper' => FALSE,
            ),
            'symbian_os' => array(
                'game'      => TRUE,
                'video'     => TRUE,
                'ebook'     => FALSE,
                'wallpaper' => TRUE,
            ),
            'desktop' => array(
                'game'      => TRUE,
                'video'     => FALSE,
                'ebook'     => TRUE,
                'wallpaper' => TRUE,
            ),
        ),
        'google_analytics_code' => 'UA-40742671-14',
        'is_link_sms'           => FALSE, // true : đóng đăng ký qua wap
    );
?>