<?="<?php"?>

namespace App\Http\Controllers\<?php echo e($conf['namespace']); ?>;

use App\Http\Controllers\Controller;
use App\Model\<?php echo e($conf['namespace']); ?>\<?php echo e($conf['tableCamel']); ?>;
use Auth;
use DB;
use App\Sf;
use Illuminate\Http\Request;

class <?php echo e($conf['tableCamel']); ?>Controller extends Controller {

	public function index(Request $request) {
		if (!$plant = Sf::isPlant()) {
			return Sf::selectPlant();
		}

		Sf::log("<?php echo e($conf['route']); ?>", "<?php echo e($conf['tableCamel']); ?>Controller@" . __FUNCTION__, "Open Page  ", "link");

		return view('<?php echo e(str_replace('\\','.',$conf['pathLower'])); ?><?php echo e($conf['tableLower']); ?>.<?php echo e($conf['tableLower']); ?>_frm', compact(['request','plant']));
	}

	public function getList(Request $request) {
		if (!Sf::allowed('<?php echo e(strtoupper($conf['route'])); ?>_R')) {
			return response()->json(Sf::reason(), 401);
		}
		$request->q = str_replace(" ", "%", $request->q);
		$data = <?php echo e($conf['tableCamel']); ?>::where(function ($q) use ($request) {
<?php foreach ($s as $k => $v): ?>
<?php if (in_array($v->DATA_TYPE, ['varchar', 'char', 'text', 'int']) && !in_array($v->COLUMN_NAME, ['created_by', 'updated_by', 'text', 'int'])): ?>
			$q->orWhere('<?php echo e($v->COLUMN_NAME); ?>', 'like', "%" . @$request->q . "%");
<?php endif?>
<?php endforeach?>
		})
			//->where('plant',$request->plant)
			->orderBy(isset($request->order_by) ? substr($request->order_by, 1) : '<?php echo e($h->pk); ?>', substr(@$request->order_by, 0, 1) == '-' ? 'desc' : 'asc');
			if ($request->trash == 1) {
				$data = $data->onlyTrashed();
			}
			$data = $data->paginate(isset($request->limit) ? $request->limit : 10);
		return response()->json(compact(['data']));
	}

	public function getLookup(Request $request) {
	$request->q = str_replace(" ", "%", $request->q);
		$data = <?php echo e($conf['tableCamel']); ?>::where(function ($q) use ($request) {
<?php foreach ($s as $k => $v): ?>
<?php if (in_array($v->DATA_TYPE, ['varchar', 'char', 'text', 'int']) && !in_array($v->COLUMN_NAME, ['created_by', 'updated_by', 'text', 'int'])): ?>
			$q->orWhere('<?php echo e($v->COLUMN_NAME); ?>', 'like', "%" . @$request->q . "%");
<?php endif?>
<?php endforeach?>
		})
			//->where('plant',$request->plant)
			->orderBy(isset($request->order_by) ? substr($request->order_by, 1) : '<?php echo e($h->pk); ?>', substr(@$request->order_by, 0, 1) == '-' ? 'desc' : 'asc');
			$data = $data->paginate(isset($request->limit) ? $request->limit : 10);
		return view('sys.system.dialog.sflookup', compact(['data', 'request']));
	}

	public function store(Request $request) {
		$req = json_decode(request()->getContent());
		$h = $req->h;
		$f = $req->f;

		try {
			$arr = array_merge((array) $h, ['plant'=>$f->plant,'updated_at' => date('Y-m-d H:i:s')]);
			if ($f->crud == 'c') {
				if (!Sf::allowed('<?php echo e(strtoupper($conf['route'])); ?>_C')) {
					return response()->json(Sf::reason(), 401);
				}
				$data = new <?php echo e($conf['tableCamel']); ?>();
				$arr = array_merge($arr, ['created_by' => Auth::user()->userid, 'created_at' => date('Y-m-d H:i:s')]);
				$data->create($arr);
<?php if ($h->ai == 1): ?>
				$id = DB::getPdo()->lastInsertId();
<?php else: ?>
				$id=$h-><?php echo e($h->pk); ?>;
<?php endif?>
				Sf::log("<?php echo e($conf['route']); ?>", $id, "Create <?php echo e($h->title); ?> (<?php echo e($conf['tableLower']); ?>) <?php echo e($h->pk); ?> : " . $id, "create");
				return 'created';
			} else {
				if (!Sf::allowed('<?php echo e(strtoupper($conf['route'])); ?>_U')) {
					return response()->json(Sf::reason(), 401);
				}
				$data = <?php echo e($conf['tableCamel']); ?>::find($h-><?php echo e($h->pk); ?>);
				$data->update($arr);
				$id = $data-><?php echo e($h->pk); ?>;
				Sf::log("<?php echo e($conf['route']); ?>", $id, "Update <?php echo e($h->title); ?> (<?php echo e($conf['tableLower']); ?>) <?php echo e($h->pk); ?> : " . $id, "update");
				return 'updated';
			}

		} catch (\Exception $e) {
			return response()->json($e->getMessage(), 500);
		}
	}

	public function edit($id) {
		$h = <?php echo e($conf['tableCamel']); ?>::where('<?php echo e($h->pk); ?>', $id)->withTrashed()->first();
		return response()->json(compact(['h']));
	}

	public function destroy($id,Request $request) {
		try {
			$data = <?php echo e($conf['tableCamel']); ?>::where('<?php echo e($h->pk); ?>', $id)->withTrashed()->first();
			if ($request->restore == 1) {
				if (!Sf::allowed('<?php echo e(strtoupper($conf['route'])); ?>_S')) {
					return response()->json(Sf::reason(), 401);
				}
				$data->restore();
				Sf::log("<?php echo e($conf['route']); ?>", $id, "Restore <?php echo e($h->title); ?> (<?php echo e($conf['tableLower']); ?>) <?php echo e($h->pk); ?> : " . $id, "restore");
				return 'restored';
			} else {
				if (!Sf::allowed('<?php echo e(strtoupper($conf['route'])); ?>_D')) {
					return response()->json(Sf::reason(), 401);
				}
				$data->delete();
				Sf::log("<?php echo e($conf['route']); ?>", $id, "Delete <?php echo e($h->title); ?> (<?php echo e($conf['tableLower']); ?>) <?php echo e($h->pk); ?> : " . $id, "delete");
				return 'deleted';
			}
		} catch (\Exception $e) {
			return response()->json($e->getMessage(), 500);
		}
	}
}<?php /**PATH C:\xampp\htdocs\tatonas\besai\backend\resources\views/sys/sycrud/sycrud_template_controller.blade.php ENDPATH**/ ?>