<?php

interface S3RepositoryInterface
{
    public function uploadFile($filePath, $fileName, $mimeType);

    public function getFileUrl($fileId);
}