<?php
require_once __DIR__.'/../vendor/autoload.php';
use Silex\Application;
use AmazonS3\AmazonS3;

$app = new Application();
$app['debug'] = true;

$app->get('/', function(){
    $s3 = new AmazonS3();
    
    return 'Hello darkness, my old friend.';
});

$app->get('/list-buckets', function() {
        $s3 = new AmazonS3();
        $buckets = $s3->listBuckets();
        
        foreach ($buckets as $bucket) {
            $links[] = sprintf('<a href="/list-objects/%s">%s</a>', $bucket, $bucket);
        }

        $links[] = '<a href="javascript:history.back()">Back</a>';

        return implode('<br/>', $links);
    }
);

$app->get('/list-objects/{bucketName}/{path}', function($bucketName, $path) {
        $s3 = new AmazonS3();
                
        $objects = $s3->listObjects($bucketName, $path);

        foreach ($objects['content'] as $object) {
            if ($objects['type'] == AmazonS3::TYPE_DIR) {
                $link = sprintf('%s/%s', $bucketName, $object);
                $links[] = sprintf('<a href="/list-objects/%s">%s</a>', $link, $link);
            } else {
                $link = sprintf('%s.%s/%s', $bucketName, AmazonS3::DOMAIN_S3, $object);
                $links[] = sprintf('<a href="https://%s" target="_blank">%s</a>', $link, $link);
            }
        }

        $links[] = '<a href="javascript:history.back()">Back</a>';
        
        return implode('<br/>', $links);
    }
)->value('path', '')->assert('path', '.*');

$app->run();
