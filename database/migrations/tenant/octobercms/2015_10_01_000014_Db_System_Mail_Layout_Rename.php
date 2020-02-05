<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DbSystemMailLayoutRename extends Migration
{
    public function up()
    {
        foreach (MailLayout::all() as $layout) {
            try {
                $layout->content_html = preg_replace("/({{\s*message\s*[|]raw\s*}})/i", "{{ content|raw }}", $layout->content_html);
                $layout->content_text = preg_replace("/({{\s*message\s*[|]raw\s*}})/i", "{{ content|raw }}", $layout->content_text);
                $layout->forceSave();
            }
            catch (Exception $ex) {
            }
        }
    }

    public function down()
    {
    }
}
