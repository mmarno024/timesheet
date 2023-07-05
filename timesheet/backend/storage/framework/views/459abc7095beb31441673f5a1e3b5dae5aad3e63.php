<?="<?php"?>

namespace App\Model\<?php echo e($conf['namespace']); ?>;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class <?php echo e($conf['tableCamel']); ?> extends Model {

	use SoftDeletes;

	protected $connection = '<?php echo e(isset($h->conn)?$h->conn:'mysql'); ?>';
	public $incrementing = <?php echo e($h->ai==1?'true':'false'); ?>;
	public $timestamps = <?php echo e($h->timestamps==1?'true':'false'); ?>;
	protected $hidden = [];
	protected $dates = ['deleted_at'];
	protected $table = '<?php echo e($conf['tableLower']); ?>';
	protected $primaryKey = "<?php echo e($h->pk); ?>";
	protected $fillable = [
<?php foreach ($s as $key => $v): ?>
		'<?php echo e($v->COLUMN_NAME); ?>',
<?php endforeach?>
	];

	public function rel_created_by() {
		return $this->belongsTo('App\Model\Sys\Syuser', 'created_by');
	}

}
<?php /**PATH C:\xampp\htdocs\tatonas\webmon\backend\resources\views/sys/sycrud/sycrud_template_model.blade.php ENDPATH**/ ?>