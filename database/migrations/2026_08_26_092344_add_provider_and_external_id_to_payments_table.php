<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->string('provider')->nullable()->after('type'); // 'fedapay', 'kkiapay' ou 'cash'
            $table->string('external_id')->nullable()->after('provider'); // ID de transaction FedaPay/KikiPay
        });
    }

    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn(['provider', 'external_id']);
        });
    }
};
