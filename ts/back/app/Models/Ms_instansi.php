<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ms_instansi extends Model
{
    protected $connection = 'wmdb';
    public $incrementing = true;
    protected $table = 'ms_instansi';
    protected $primaryKey = "rowid";
    protected $fillable = [
        'rowid',
        'id_instansi_new',
        'id_instansi',
        'id_dinas',
        'nm_instansi',
        'center_y',
        'center_x',
        'zoom',
        'header',
        'judul_1',
        'judul_2',
        'logo_1',
        'logo_2',
        'colorize_label',
        'rt_mode',
        'rt_text',
        'enabled',
        'identity',
        'f_default',
        'deleted_at'
    ];
    protected $hidden = [
        'rowid',
        'id_instansi_new',
        'id_dinas',
        'center_y',
        'center_x',
        'zoom',
        'header',
        'judul_1',
        'judul_2',
        'logo_1',
        'logo_2',
        'colorize_label',
        'rt_mode',
        'rt_text',
        'enabled',
        'identity',
        'f_default',
        'deleted_at'
    ];
}
