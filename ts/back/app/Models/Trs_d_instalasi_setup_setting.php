<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trs_d_instalasi_setup_setting extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $dates = ['deleted_at'];
    protected $table = 'trs_d_instalasi_setup_setting';
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'h_id',
        'solar_panel',
        'solar_panel_note',
        'accu',
        'accu_note',
        'solar_charge',
        'solar_charge_note',
        'box_panel',
        'box_panel_note',
        'logger',
        'logger_note',
        'gsm_modem',
        'gsm_modem_note',
        'interval_simpan',
        'interval_simpan_note',
        'kalibrasi_resolusi',
        'kalibrasi_resolusi_note',
        'level_awal',
        'level_awal_note',
        'aktivasi_alarm',
        'aktivasi_alarm_note',
        'cek_pembacaan',
        'cek_pembacaan_note',
        'sms_server',
        'sms_server_note',
        'web_server',
        'web_server_note',
        'mail_server',
        'mail_server_note',
        'jwt_ftp_http_server',
        'jwt_ftp_http_server_note',
        'capture_mms',
        'capture_mms_note',
        'no_user1',
        'no_user2',
        'no_user3',
        'no_user4',
        'no_user5',
        'updated_at',
        'deleted_at'
    ];
    protected $hidden = [
        'deleted_at'
    ];
}
