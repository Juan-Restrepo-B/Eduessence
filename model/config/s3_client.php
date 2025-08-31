<?php
require __DIR__ . '/../../vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$s3Client = new S3Client([
    'version' => 'latest',
    'region' => 'us-east-1', // tu región
    'credentials' => [
        'key' => '',
        'secret' => '',
    ],
]);

$bucketName = "tu-bucket";

// ✅ Esta reemplaza a la anterior, pero devuelve URL pública
function generarUrlFirmada($bucket, $key)
{
    return "https://{$bucket}.s3.amazonaws.com/{$key}";
}

function listarArchivos($s3Client, $bucketName, $prefix = "")
{
    try {
        $result = $s3Client->listObjectsV2([
            'Bucket' => $bucketName,
            'Prefix' => $prefix
        ]);

        $archivos = [];
        if (isset($result['Contents'])) {
            foreach ($result['Contents'] as $objeto) {
                $archivos[] = [
                    'key' => $objeto['Key'],
                    'url' => generarUrlFirmada($bucketName, $objeto['Key']) // ✅ usamos la nueva
                ];
            }
        }
        return $archivos;
    } catch (AwsException $e) {
        echo "Error al listar archivos: " . $e->getMessage();
        return [];
    }
}
?>