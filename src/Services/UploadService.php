<?php

namespace SwanFlutter\PayPing\Services;

use CURLFile;

class UploadService extends BaseService
{
    /**
     * آپلود عکس پروفایل کاربری (JPG, PNG, JPEG)
     */
    public function profilePic(string $filePath): array
    {
        return $this->client->upload($this->buildUrl('v1', 'upload/ProfilePic'), [
            'file' => new CURLFile($filePath),
        ]);
    }

    /**
     * آپلود عکس یک آیتم مالی (JPG, PNG, JPEG)
     */
    public function item(string $filePath): array
    {
        return $this->client->upload($this->buildUrl('v1', 'upload/Item'), [
            'file' => new CURLFile($filePath),
        ]);
    }

    /**
     * آپلود فایل ضمیمه یک فاکتور
     */
    public function invoiceAttachment(string $filePath): array
    {
        return $this->client->upload($this->buildUrl('v1', 'upload/InvoiceAttachment'), [
            'file' => new CURLFile($filePath),
        ]);
    }
}
