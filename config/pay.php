<?php

declare(strict_types=1);

use Yansongda\Pay\Pay;

return [
    'alipay' => [
        'default' => [
            // 必填-支付宝分配的 app_id
            'app_id' => env('ALIPAY_APP_ID','9021000132621645'),
            // 必填-应用私钥 字符串或路径
            'app_secret_cert' => env('ALIPAY_APP_SECRET_CERT','MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQCUcEBIW/xtQbE3TfJCEi5Tn5j9Xiw9TtWjHM7e0sKIPYV3YDQa9zhAgla4GV98zL58vT0yECRIoi8EuolVDOhUqcnAA42wUm8BWm203IgRywmDNs+igpXjd0Vwcx88TLtgL1RQz+Gj8h/53SUHxMMRR26VWhdU7tbp5euPEKCDThgQv6Yr0hhc+JqVvjVuLCtFC8bz4o/VLp5kwtYUQMKVngPq5uy3FTEoEKY/gWiEg4PtcuWAWxc0dYzI8xRbHb92VXA9K5C3U3FLv8xalHlZsLI3yA+l6UeSoKoRQUdRLWCgCJnfroitYQ2AqkUkWolWhHQL3rr4CObjN/XshGmHAgMBAAECggEAchoLP9P9qNpraBCxnRoupDc1OeXO6d2UmQqG9n9Z67ImywmXY/cPNX87O869OMiF0IsC5F3GFlMdA2yELm16lcHiBIh2vMfQ7mBdnj47FjpVeJiEaO4qW6yOIw9LPmXZTulyzZ/OWeC/tajJUzxrmfenyIR1FON3Llp/hPyJ9gO3AteSqcqz5SKm3MgGHVtb7j3EiH+CcCHlgBaha/Puy9IHYz1oS+e0GHFDyBN6pQl5xclfgCCR0YXami5QKJfLjqpyA+zMRHly28rQArRIsnZrDw5++udeENwckpBKP9nWn8vJ+XR8cJRFAAQ83C6N3cfYEECp5Ezqfoj4dLLdqQKBgQD8St8VelwHAKUhV+f3aX8bhqBbXgcdAhlWL9Ss0qcUD1Fw6BUBuUm24ClvnUkfJhI01JEXRpnSDOurwu72oa3+YuELhACi/kuJ865CKVt/eXvMHMOf/2JfC2CbFWL/JyKc8P3rMw1va3OUPZeXf9xgqO4RQh0GWuXV2reFddAkBQKBgQCWnq3gv4pqnb1kIpbnmOLRtWqZIZPxyYM7Mp4TiL9G/dtWiaDBR4J+mC/W9tLRI4PJdS4QoBwhhCDn8ILFMRXEWKRLhsS8JkncvMDrfmWHvhKHXYNv+UPkJt6/RjLjRt64EaJsLePGpjs8WfrgVdYeFg2Xw6EpZB8X/Ny/hrW5GwKBgCnVdGZIUsgqeDcuL12cFaKH0UE1NzK9LVxYNAiwKVovLA7vvMP7aFi1lMlYKE7M7knqUWCtqUXmNJHXke49Yu+Cj9Rr//sG9ZmbWXLJDs31Y+y1fE6kdzhRV6R/iFnMsHWblE8SuRCXnaOgDunlHrK8cDVWZB+wpNmwGaw8m9XNAoGBAIHDZ64vlwLPr3Fr03LoZtGhaJtRMHKo1+TScRoHQDPbVXKy08pw315NozmiIHKKFGomCG/OYS4G9YqdzSwyY7xrWfCvxSMMIaqI+/RnSvWtraztxeVcbT9Mta84vXLNhegzWSm2R3zHjlUqeFd53CTDfyZ3JovQdHFoKo7fcgRtAoGBAOOmcO0YaIvE3kDTrembHtA+Fyp1ERqJdeNpGVT5osKaQFkWWoHEmFRSlHD2TNEI4DefkHXI6hcvkgMwqmY+AGHjRAm/ZA9e66T0Gl3paIUCttNJCZjz7EjUcuY6w7wKgIs9lgThU/tU4hIuq5wAdV6YOn9fzWgGJgS3e7k0DTu0'),
            // 必填-应用公钥证书 路径
            'app_public_cert_path' => env('APP_PUBLIC_CERT_PATH',storage_path('alipaycert/appPublicCert.crt')),
            // 必填-支付宝公钥证书 路径
            'alipay_public_cert_path' =>  env('ALIPAY_PUBLIC_CERT_PATH',storage_path('alipaycert/alipayPublicCert.crt')),
            // 必填-支付宝根证书 路径
            'alipay_root_cert_path' =>  env('APP_PUBLIC_ROOT_CERT_PATH',storage_path('alipaycert/alipayRootCert.crt')),
            // 'return_url' => '',
            // 'notify_url' => '',
            // 选填-第三方应用授权token
            'app_auth_token' => '',
            // 选填-服务商模式下的服务商 id，当 mode 为 Pay::MODE_SERVICE 时使用该参数
            'service_provider_id' => '',
            // 选填-默认为正常模式。可选为： MODE_NORMAL, MODE_SANDBOX, MODE_SERVICE
            'mode' => Pay::MODE_NORMAL,
        ],

    ],
    'wechat' => [
        'default' => [
            // 必填-商户号，服务商模式下为服务商商户号
            'mch_id' => '',
            // 选填-v2商户私钥
            'mch_secret_key_v2' => '',
            // 必填-商户秘钥
            'mch_secret_key' => '',
            // 必填-商户私钥 字符串或路径
            'mch_secret_cert' => '',
            // 必填-商户公钥证书路径
            'mch_public_cert_path' => '',
            // 必填
            'notify_url' => '',
            // 选填-公众号 的 app_id
            'mp_app_id' => '',
            // 选填-小程序 的 app_id
            'mini_app_id' => '',
            // 选填-app 的 app_id
            'app_id' => '',
            // 选填-合单 app_id
            'combine_app_id' => '',
            // 选填-合单商户号
            'combine_mch_id' => '',
            // 选填-服务商模式下，子公众号 的 app_id
            'sub_mp_app_id' => '',
            // 选填-服务商模式下，子 app 的 app_id
            'sub_app_id' => '',
            // 选填-服务商模式下，子小程序 的 app_id
            'sub_mini_app_id' => '',
            // 选填-服务商模式下，子商户id
            'sub_mch_id' => '',
            // 选填-微信公钥证书路径, optional，强烈建议 php-fpm 模式下配置此参数
            'wechat_public_cert_path' => [
                '45F59D4DABF31918AFCEC556D5D2C6E376675D57' => __DIR__.'/Cert/wechatPublicKey.crt',
            ],
            // 选填-默认为正常模式。可选为： MODE_NORMAL, MODE_SERVICE
            'mode' => Pay::MODE_NORMAL,
        ],
    ],
    'unipay' => [
        'default' => [
            // 必填-商户号
            'mch_id' => '',
            // 必填-商户公私钥
            'mch_cert_path' => '',
            // 必填-商户公私钥密码
            'mch_cert_password' => '000000',
            // 必填-银联公钥证书路径
            'unipay_public_cert_path' => '',
            // 必填
            'return_url' => '',
            // 必填
            'notify_url' => '',
        ],
    ],
    'http' => [ // optional
        'timeout' => 5.0,
        'connect_timeout' => 5.0,
        // 更多配置项请参考 [Guzzle](https://guzzle-cn.readthedocs.io/zh_CN/latest/request-options.html)
    ],
    // optional，默认 warning；日志路径为：sys_get_temp_dir().'/logs/yansongda.pay.log'
    'logger' => [
        'enable' => false,
        'file' => null,
        'level' => 'debug',
        'type' => 'single', // optional, 可选 daily.
        'max_file' => 30,
    ],
];
